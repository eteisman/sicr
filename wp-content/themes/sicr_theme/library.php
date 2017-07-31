<?php
session_start();

global $_sicr_menu_type;
global $_sicr_active_menu_item;

$_sicr_menu_type = 0; //MENU_TYPE_HOME; // default

function strAsLocalTime($s) {
	$dt = DateTime::createFromFormat("d-m-Y H:i", $s, new DateTimeZone('Europe/Amsterdam'));
	return $dt->format('U');
}
function nowAsLocalTime() {
	$dt = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
	return $dt->format('U');
}
function get_local_datetime() {
	$dt = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
	return $dt->format('U');
}
function get_the_herald_list($dir) {
	$bMustRefresh = true;
	$newTime = time();
	$oldTime = 0;
	if (!isset($_SESSION['heraldlist'])) {
		$bMustRefresh = true;
	} else if (isset($_SESSION['heraldlist_time'])) {
		$oldTime = $_SESSION['heraldlist_time'];
		$bMustRefresh = ($newTime > ($oldTime+60)); // max once every minute. Reload takes 0.3 seconds
	}
	
	if ($bMustRefresh) {
		$_SESSION["heraldlist"] = getTheHeraldsListFromDir($dir, "/herald");
		$_SESSION["heraldlist_time"] = time();
	}
	return $_SESSION["heraldlist"];
}
function get_service_sheet_list($dir) {
	$bMustRefresh = true;
	$newTime = time();
	$oldTime = 0;
	if (!isset($_SESSION['servicesheets'])) {
		$bMustRefresh = true;
	} else if (isset($_SESSION['servicesheets_time'])) {
		$oldTime = $_SESSION['servicesheets_time'];
		$bMustRefresh = ($newTime > ($oldTime+60)); // max once every minute. Reload takes 0.3 seconds
	}
	
	if ($bMustRefresh) {
		$startTime = microtime(true);
		$_SESSION["servicesheets"] = getServiceListFromDir($dir, "/oos");
		//var_dump(100*(microtime(true)-$startTime));
		$_SESSION["servicesheets_time"] = time();
		//var_dump("Reloading sheets....");
	}
	return $_SESSION["servicesheets"];
}

// Check if the next day has two servcie sheets attached
// This would be true for a Christmas service, and maybe Easter
// ON such a sunday there are two servcies, hence two service sheets
function have_two_service_sheets(){
	$list = get_service_sheet_list( sicr_root_dir() );
	$firstItem  = $list[1]["items"][1];
	$secondItem = $list[1]["items"][2];
	//var_dump($list[1]);
	//var_dump($secondItem["name"]);
	if ($firstItem["name"] === $secondItem["name"]) {
		return true;
	} else {
		$b = isServiceSheetThisWeek($secondItem);
		return $b;
	}
	return false;
}

function isServiceSheetThisWeek($serviceSheetItem)	{
	if ($serviceSheetItem) {
		if (in_array("name", $serviceSheetItem)) { 
			$today= new DateTime();	
			try {
				$d = DateTime::createFromFormat('d-m-Y', $serviceSheetItem["name"]);
				$d->setTime(0,0); // truncate date
				if ($d) {			
					if ($d >= $today) {
					  $diff = $today->diff($d);			
					  return ($diff->days >0 ) && ($diff->days < 7);
					} else {
						return false;
					}  
				} else {
					return false;
				}
			} catch (Exception $err) {
				return false;
			}
		}
	}
	return false;
}

function get_dienst_gemist_data() {
	/*
	if (!isset($_SESSION['dienst_gemist_data'])) {
		$_SESSION["dienst_gemist_data"] = load_dienst_gemist_data();
	}
	return $_SESSION["dienst_gemist_data"];
	*/
	return load_dienst_gemist_data();
}
function load_dienst_gemist_data() {
  $dienst_gemist = array();
  try {
	  // fetch data from kerkdienst gemist RSS feed, and parse the XML to get the data
	  $url_dienst_gemist = "http://kerkdienstgemist.nl/playlists/8809.rss";  
	  $xml = new domDocument;
	  $xml->formatOutput = true;
	  $xml->preserveWhiteSpace = false;
	  $xml = simplexml_load_file($url_dienst_gemist);  
	  
	  
	  $n = 0;
	  foreach ($xml->channel->item as $item) {
	    $n++;
	  	if ($n > 20) break;
	  	
		$media = $item->children('http://search.yahoo.com/mrss/');
		$itunes = $item->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
		$pubDate = strtotime($item->pubDate);
		$dienst_gemist[$n] = array();
		$dienst_gemist[$n]["title"]       = $item->title; 
		$dienst_gemist[$n]["link"]        = $item->link;
		$dienst_gemist[$n]["pubDate"]     = date('l j M Y - H:i', $pubDate);
		$dienst_gemist[$n]["date"]        = date('l j M Y', $pubDate);
		$dienst_gemist[$n]["time"]        = date('H:i', $pubDate);
		$dienst_gemist[$n]["guid"]        = $item->guid;
		$dienst_gemist[$n]["description"] = $media->description;
		$dienst_gemist[$n]["author"]      = $itunes->author;
	  };
  } catch (Exception $err) {}	
  return $dienst_gemist;	
}
function get_services_data($max_events) {
	/*
	if (!isset($_SESSION['services_data'])) {
		$_SESSION["services_data"] = load_services_data($max_events);
	}
	return $_SESSION["services_data"];
	*/	
	return load_services_data($max_events);
}
function load_services_data($max_events) {
	$starttime = microtime(true);
	
	$theLocalTime = nowAsLocalTime();
	//$theLocalTime = strtotime("20-12-2015 10:00"); UK TIME!!!
	
	$dienst_gemist_data = get_dienst_gemist_data(); // from kerkdienstgemist.nl
	
	if (!$max_events) {
		$max_events = 25;
	}
	$url_services_events_xml = "http://www.scotsintchurch.com/content/events-xml.php";
	$xml = new DOMDocument;
  	$xml->formatOutput = true;
  	$xml->preserveWhiteSpace = false;
  	$xml = simplexml_load_file($url_services_events_xml);  
	$postUrl = "http://www.scotsintchurch.com/events/?page_id=42&event_id=";
  	$services = array();
  	$services["future-events"] = array();
  	try {
	  	$n = 0;
	  	foreach ($xml->future_events[0] as $event) {
			$eventId = $event["id"]."";
			if ($eventId !== "events-no-events") {  
				$services["future-events"][$n] = array();
				$services["future-events"][$n]["id"] = $event->id;
				$services["future-events"][$n]["name"] = $event->name;
				$services["future-events"][$n]["link"] = $postUrl . $event->id;
				$services["future-events"][$n]["date"] = strtotime($event->date);
				$services["future-events"][$n]["time"] = $event->time;
				$services["future-events"][$n]["when"] = strAsLocalTime($event->date." ".$event->time);
				$services["future-events"][$n]["current"] = FALSE;
				$services["future-events"][$n]["completed"] = FALSE;
	  		
	  		
				// is it > 2.5hours ago?
				if ( $theLocalTime > ($services["future-events"][$n]["when"]+9000)) {
					$services["future-events"][$n]["completed"] = TRUE;
				} else {
					// does the event start in one hour ?
					if ($theLocalTime > ($services["future-events"][$n]["when"]-3600)) {
						$services["future-events"][$n]["current"] = TRUE;
					}
				}
				//$services["future-events"][$n]["before-count"] = ($theLocalTime - ($services["future-events"][$n]["when"]-3600));
				//$services["future-events"][$n]["after-count"] = ($theLocalTime - ($services["future-events"][$n]["when"]+9000));
				//$services["future-events"][$n]["test-count"] = ($services["future-events"][$n]["after-count"]/3600);
				
				$services["future-events"][$n]["comment"] = $event->comment;
				$services["future-events"][$n]["scripture"] = $event->scripture;
				$services["future-events"][$n]["sermon"] = $event->sermon;
				$services["future-events"][$n]["preacher"] = $event->preacher;
				$services["future-events"][$n]["elder"] = $event->elder;
				$services["future-events"][$n]["organist"] = $event->organist;
				$services["future-events"][$n]["childrens_message"] = $event->childrens_message;
				$services["future-events"][$n]["dienst-gemist"] = "";
				
				if (n <2) {
					$event_date = strtotime($event->date);
					$event_time = strtotime($event->time);
					$services["future-events"][$n]["dienst_gemist_url"] = find_service_recording($event_date, $event_time, $dienst_gemist_data, $event->date, $event->time);
				}
				
				$n++;
				if ($n > $max_events) break;
		  	}  		
	  	}
  	} catch (Exception $err){}
	  
	  // If there are not futture events, then just add the next Sunday by default  	
	if (sizeof($services["future-events"]) == 0) {
		$nextSunday = new DateTime('now');
		$nextSunday = $nextSunday->modify('next sunday');
		$whenSunday = $nextSunday->format("d-m-Y")." 10:30";
		
		$services["future-events"][0] = array();
		$services["future-events"][0]["id"] = "";
		$services["future-events"][0]["name"] = "Sunday Service";
		$services["future-events"][0]["date"] = $nextSunday->getTimestamp();  
		$services["future-events"][0]["time"] = "10:30";
		$services["future-events"][0]["when"] = strAsLocalTime($whenSunday);
		$services["future-events"][0]["current"] = FALSE;
		$services["future-events"][0]["completed"] = FALSE;
	}  
	//var_dump($services["future-events"]);
	  // If there are not futture events, then just add the next Sunday by default  		  
	  
  	$services["past-events"] = array();
  	$n = 0;
  	foreach ($xml->past_events[0] as $event) {
  		$services["past-events"][$n] = array();
  		$services["past-events"][$n]["id"] = $event->id;
  		$services["past-events"][$n]["name"] = $event->name;
  		$services["past-events"][$n]["link"] = $postUrl . $event->id;
  		$services["past-events"][$n]["date"] = strtotime($event->date);
  		$services["past-events"][$n]["time"] = $event->time;
  		$services["past-events"][$n]["when"] = strtotime($event->date." ".$event->time);
  		$services["past-events"][$n]["current"] = FALSE;
  		$services["past-events"][$n]["completed"] = TRUE;
  		$services["past-events"][$n]["comment"] = $event->comment;
  		$services["past-events"][$n]["scripture"] = $event->scripture;
  		$services["past-events"][$n]["sermon"] = $event->sermon;
  		$services["past-events"][$n]["preacher"] = $event->preacher;
  		$services["past-events"][$n]["elder"] = $event->elder;
  		$services["past-events"][$n]["organist"] = $event->organist;
  		$services["past-events"][$n]["childrens_message"] = $event->childrens_message;
  		
  		$event_date = strtotime($event->date);
  		$event_time = strtotime($event->time);
  		$services["past-events"][$n]["dienst_gemist_url"] = find_service_recording($event_date, $event_time, $dienst_gemist_data, $event->date, $event->time);
    	$n++;
  		if ($n > $max_events) break;  		
  	}
	  // if there are no past events, then add previous sunday by default
	if (sizeof($services["past-events"]) == 0) {
		$prevSunday = new DateTime('tomorrow');
		$prevSunday = $prevSunday->modify('last sunday');
		$whenSunday2 = $prevSunday->format("d-m-Y")." 10:30";
		
		$services["past-events"][0] = array();
		$services["past-events"][0]["id"] = "";
		$services["past-events"][0]["name"] = "Sunday Service";
		$services["past-events"][0]["date"] = $prevSunday->getTimestamp();  
		$services["past-events"][0]["time"] = "10:30";
		$services["past-events"][0]["when"] = strAsLocalTime($whenSunday2);
		$services["past-events"][0]["current"] = FALSE;
		$services["past-events"][0]["completed"] = TRUE;
	}  
	//var_dump($services["past-events"]);
	  
  	$services["other-events"] = array();
  	$n = 0;
  	foreach ($xml->other_events[0] as $event) {
  		if ($event->id) {
	  		$services["other-events"][$n] = array();
	  		$services["other-events"][$n]["id"] = $event->id;
	  		$services["other-events"][$n]["name"] = $event->name;
	  		$services["other-events"][$n]["link"] = $postUrl . $event->id;
	  		$services["other-events"][$n]["date"] = strtotime($event->date);
	  		$services["other-events"][$n]["time"] = $event->time;
	  		$services["other-events"][$n]["current"] = FALSE;
	  		$services["other-events"][$n]["location"] = $event->location;
	    	$n++;
	  		if ($n > $max_events) break;
  		}
  	}
  	
  	
	$endtime = microtime(true);
	//echo($endtime - $starttime)."<br/>";	
  	
	//$services["future-events"] = array();
	
  	return $services;  	  	
}

function get_online_service($future_services, $past_services) {
	$result = FALSE;
	if ($past_services) {
		$result = $past_services[0];
		// if two events on the same day, then select the second (ie morning service)
		if ($past_services[1]) {
			if ($past_services[0]["date"] == $past_services[1]["date"]) {
				$result = $past_services[1];
			}
		}
	}
	if ($future_services) {
		if ($future_services[0]) {
			if ($future_services[0]["current"]) {
				$result = $future_services[0];
			}
			if ($future_services[0]["completed"]) {
				$result = $future_services[0];
			}
		}
		if ($future_services[1]) {
			if ($future_services[1]["current"]) {
				$result =  $future_services[1];
			}
		}
	}
	return $result;
}

function get_events_data($max_events) {
	/*
	if (!isset($_SESSION['events_dat'])) {
		$_SESSION["events_dat"] = load_events_data($max_events);
	}
	return $_SESSION["events_dat"];
	*/	
	return load_events_data($max_events);
}

function load_events_data($max_events) {
	//$starttime = microtime(true);
	
	if (!$max_events) {
		$max_events = 25;
	}
	$url_services_events_xml = "http://www.scotsintchurch.com/content/calendar-events-xml.php";
	$xml = new DOMDocument;
  	$xml->formatOutput = true;
  	$xml->preserveWhiteSpace = false;
  	$xml = simplexml_load_file($url_services_events_xml);  
	$postUrl = "http://www.scotsintchurch.com/events/?page_id=42&event_id=";
  	$services = array();
  	$services["events"] = array();
  	$n = 0;
  	foreach ($xml->calendar_events[0] as $event) {
  		$services["events"][$n] = array();
  		$services["events"][$n]["id"] = $event->id;
  		$services["events"][$n]["name"] = $event->name;
  		$services["events"][$n]["link"] = $postUrl . $event->id;
  		$services["events"][$n]["date"] = strtotime($event->date);
  		$services["events"][$n]["time"] = $event->time;
  		$services["events"][$n]["location"] = $event->location;
  		$services["events"][$n]["preacher"] = $event->preacher;
    	$n++;
  		if ($n > $max_events) break;  		
  	}
  	
  	
	//$endtime = microtime(true);
	//echo($endtime - $starttime)."<br/>";	
  	
  	return $services;  	  	
}
// used to find the "Kerkdienst gemist" data for a date/time
function find_service_recording($event_date, $event_time, $dienst_gemist_data, $date, $time) {
	$result = null;
	for ($i = 1; $i < count($dienst_gemist_data); $i++) {
		$this_date = strtotime($dienst_gemist_data[$i]["date"]);
		
		if ($this_date == $event_date) {
			if ($result == null) {
				$result = $dienst_gemist_data[$i];
			} else {
				// find out if the time for this record matches better than the result
				// there may be two services in one day, e.g. at 10:30, and at 19:30				
				$this_time = strtotime($dienst_gemist_data[$i]["time"]);
				$that_time = strtotime($result["time"]);
				$this_time_diff = abs($event_time - $this_time);
				$that_time_diff = abs($event_time - $that_time);
				if ($this_time_diff	 < $that_time_diff) {
					$result = $dienst_gemist_data[$i];  // closer in time than old result
				}
			} 
		} 
	}	
	if ($result) {
		$result = $result["guid"];
	}	
	
	return $result;
}

// get "The Herald" files by scanning the directory
function getTheHeraldsListFromDir($dir, $subdir) {
	$arrFileNames = scandir($dir.$subdir);
	rsort($arrFileNames); // sort revers order, most recent first
	
	$base_url = site_url()."/..".$subdir;	
	$arrData = array();
	foreach ($arrFileNames as $file) {
		$lcaseFile = strtolower($file); 
		if (startsWith($lcaseFile,"herald20") && endsWith($file, ".pdf")) {
			$fileInfo = pathinfo($dir."/".$file);
			//var_dump($fileInfo);
			$fileName = $fileInfo["filename"];
			$fileExt = $fileInfo["extension"];
			$year = substr($fileName,6,4);
			$month =  substr($fileName,10,2);
			//$dateObj   = DateTime::createFromFormat('!m', $month);
			//$monthName = $dateObj->format('F');			
			$info = substr($fileName,12,255);
			$info = ucwords(trim($info));
			
			$arrData[$file]  = array();
			$arrData[$file]["groupName"] = $year;
			$arrData[$file]["info"] = $info;
			$arrData[$file]["name"] = "Herald ".$year."/".$month;
			$arrData[$file]["link"] = $base_url."/".$fileName.".".$fileExt;
		}
	}
	
	//now build the correct list
	$arrGroup = array();
	foreach ($arrData as $fileData) {
		$groupName = $fileData["groupName"];
		if (!isset($arrGroup[$groupName])) {
			$arrGroup[$groupName] = array();
			$arrGroup[$groupName]["name"]  = $groupName;
			$arrGroup[$groupName]["items"] = array();
		}
		$idxItem = count($arrGroup[$groupName]["items"]);
		$idxItem++;
		$arrGroup[$groupName]["items"][$idxItem] = array();
		$arrGroup[$groupName]["items"][$idxItem]["name"] = $fileData["name"];
		$arrGroup[$groupName]["items"][$idxItem]["link"] = $fileData["link"];
		$arrGroup[$groupName]["items"][$idxItem]["info"] = $fileData["info"];
	}
	
	// make it a normal array, indexed by number
	$result = array();
	$idxGroup = 0;
	foreach ($arrGroup as $group) {
		$idxGroup++;
		$result[$idxGroup] = $group;
	}
	return $result;
}	

// get the service sheet files by scanning the directory
function getServiceListFromDir($dir, $subdir) {
	$arrFileNames = scandir($dir.$subdir);
	rsort($arrFileNames); // sort revers order, most recent first
	
	$base_url = site_url()."/..".$subdir;	
	$arrData = array();
	foreach ($arrFileNames as $file) {
		if (startsWith($file,"20") && endsWith($file, ".pdf")) {
			$fileInfo = pathinfo($dir."/".$file);
			//var_dump($fileInfo);
			$fileName = $fileInfo["filename"];
			//var_dump($fileName);
			$fileExt = $fileInfo["extension"];
			$year = substr($fileName,0,4);
			$month =  substr($fileName,4,2);
			$dateObj   = DateTime::createFromFormat('!m', $month);
			$monthName = $dateObj->format('F');
			$day = substr($fileName,6,2);
			$info = substr($fileName,8,255);
			$info = str_replace("oos", "", $info);
			$info = str_replace("web", "", $info);
			$info = ucwords(trim($info));
			
			$arrData[$file]  = array();
			$arrData[$file]["groupName"] = $monthName." ".$year;
			$arrData[$file]["info"] = $info;
			$arrData[$file]["name"] = $day."-".$month."-".$year;
			$arrData[$file]["link"] = $base_url."/".$fileName.".".$fileExt;
		}
	}
	
	//now build the correct list
	$arrGroup = array();
	foreach ($arrData as $fileData) {
		$groupName = $fileData["groupName"];
		if (!isset($arrGroup[$groupName])) {
			$arrGroup[$groupName] = array();
			$arrGroup[$groupName]["name"]  = $groupName;
			$arrGroup[$groupName]["items"] = array();
		}
		$idxItem = count($arrGroup[$groupName]["items"]);
		$idxItem++;
		$arrGroup[$groupName]["items"][$idxItem] = array();
		$arrGroup[$groupName]["items"][$idxItem]["name"] = $fileData["name"];
		$arrGroup[$groupName]["items"][$idxItem]["link"] = $fileData["link"];
		$arrGroup[$groupName]["items"][$idxItem]["info"] = $fileData["info"];
	}
	
	// make it a normal array, indexed by number
	$result = array();
	$idxGroup = 0;
	foreach ($arrGroup as $group) {
		$idxGroup++;
		$result[$idxGroup] = $group;
	}
	return $result;
}	

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function get_sicr_root_dir() {
    $base = dirname(__FILE__);
    $path = false;

    if (@file_exists(dirname(dirname($base))."/wp-config.php"))
    {
        $path = dirname(dirname(dirname($base)));
    }
    else
    if (@file_exists(dirname(dirname(dirname($base)))."/wp-config.php"))
    {
        $path = dirname(dirname(dirname(dirname($base))));
    }
    else
    $path = false;

    if ($path != false)
    {
        $path = str_replace("\\", "/", $path);
    }
    return $path;
}

/*obsolete now
function parse_list_items($url_data) {
	$xml = new domDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml = simplexml_load_file($url_data);
	  
	$arrGroup = array();
	$idxGroup = 0;
	foreach ($xml->group as $group) {
		$idxGroup++;
		$arrGroup[$idxGroup] = array();
		$arrGroup[$idxGroup]["name"]  = $group["name"];
		$arrGroup[$idxGroup]["items"] = array();
		
		$idxItem = 0;
		foreach ($group->item as $item) {
			$idxItem++;
			$arrGroup[$idxGroup]["items"][$idxItem]["link"] = $item->link; 
			$arrGroup[$idxGroup]["items"][$idxItem]["name"] = $item->name;			
		}
	}
	return $arrGroup;	
}
*/
