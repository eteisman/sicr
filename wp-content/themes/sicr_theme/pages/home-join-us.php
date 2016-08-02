<?php
  try {
  	$services = get_services_data(2);
  	$future_services = $services["future-events"];
  	$past_services 	 = $services["past-events"];
  	$other_events 	 = $services["other-events"];
  } catch(Exception $e) {
  	$future_services = null;
  	$past_services = null;  	
  }  	
  try {  	
    $dienst_gemist = get_dienst_gemist_data();
  } catch(Exception $e) {
  	$dienst_gemist = null;
  }
  
  // TEST CODE
  //$future_services[2] = $future_services[1];
  //$other_events[1] = $other_events[0];
  //unset($other_events);
  
  // if we dont have enough other events, fill the space with future events
  $maxFutureEvents = 1;
  if (!$other_events || count($other_events) < 1) {
  		$maxFutureEvents = 3;
  } else  if (count($other_events) < 2) {
  	$maxFutureEvents = 2;
  }  
  
?>
<div class="box1">
	<div style="padding: 0px; margin: 0px;min-height: 524px">
		<div class="title_box">
			<h4>Join <span>Us</span></h4>
		</div>
		<div class="title_box" style="">
			<h6 class="icon_title">
				<a href="<?php echo $future_services[0]["link"]?>">
					Upcoming Services
				</a>
			</h6>
			<?php
			for ($i = 0; $i < count($future_services); $i++) {
				if ($i >= $maxFutureEvents) {
					break; // no more than two events, else pages becomes to tall
				}
			?>
			<p class="m_0">
				<div>			
					<i class="fa fa-check-square-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo $future_services[$i]["name"]; ?>			 
				</div>							
				<div>
					<i class="fa fa-clock-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo date("l j F Y", $future_services[$i]["date"])."&nbsp;".$future_services[$i]["time"]; ?>
				</div>
				<!-- 
				<?php //if (strlen($future_services[$i]["preacher"]) > 0) : ?>
				<div>			
					<i class="fa fa-user" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo "Preacher:&nbsp;" . $future_services[$i]["preacher"]; ?>			 
				</div>
				<?php //endif;?>
				-->
				
				<?php if (strlen($future_services[$i]["scripture"]) > 0) : ?>
					<div style="margin-right: -24px;"> <!-- negative right margin set to make more room for overflow -->
						<i class="fa fa-book" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>					
						<?php echo $future_services[$i]["scripture"]; ?>					
					</div>
				<?php endif;?>
					
			</p>
			<?php
			} 
			?>
		</div>
		
		<div class="title_box"  style="xmargin-bottom: 16px;">
			<h6 class="icon_title">
				<a href="">
					Upcoming <span>Events</span> 
				</a>
			</h6>
			<h6 class="italic m_01"></h6>
			<div>
			<?php 
			if ($other_events && !empty($other_events)) {
				for ($i = 0; $i < count($other_events); $i++) {
					if ($i >1) {
						break; // no more than two events, else pages becomes to tall
					}
				?>
				<div style="margin-bottom: 8px;">
						<div>
							<i class="fa fa-bookmark-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
							<?php echo $other_events[$i]["name"]; ?>											
						</div>
						<div>
							<i class="fa fa-clock-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						  	<?php echo date("l j F Y", $other_events[$i]["date"]); ?>
							<?php if ($other_events[$i]["time"]) { ?>							
								<?php echo $other_events[$i]["time"]; ?>
							<?php } ?>						
						</div>
						<div>
							<i class="fa fa-map-marker" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
							<?php echo $other_events[$i]["location"]; ?>					
						</div>
				</div>
				<?php 
				}
			} else {
			?>
				<i class="fa fa-clone" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
				There are no upcoming events.
				<div style="height: 8px;"></div>
			<?php
			}
			?>
			</div>
		</div>	
	
		<?php $online_service = get_online_service($future_services, $past_services);?>
		<div class="title_box" style="margin-bottom: 20px;">
			<h6 class="icon_title">
				<a href="<?php echo $online_service["link"]?>">
					Listen Online
				</a>
			</h6>
			<h6 class="italic m_01"></h6>
			
			<div>
			<?php 
			//var_dump($past_services);
			if ($online_service) {?>
				<div>			
					<i class="fa fa-check-square-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo $online_service["name"]; ?>			 
				</div>										
				<div>
					<i class="fa fa-clock-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo date("l j F Y", $online_service["date"])." ".$online_service["time"]; ?>
				</div>
				<?php if (strlen($online_service["preacher"]) > 0) :?>
				<div>			
					<i class="fa fa-user" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo "Preacher:&nbsp" . $online_service["preacher"];?>
				</div>
				<?php endif;?>
				<?php if (strlen($online_service["scripture"]) > 0) :?>
				<div style="margin-right: -24px;"> <!-- negative right margin set to make more room for overflow -->
					<i class="fa fa-book" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
					<?php echo $online_service["scripture"]; ?> 
				</div>
				<?php endif;?>
				<div>
					<?php
						$url = "http://kerkdienstgemist.nl/streams/733518.mp3?refresh=1436686335";
						if (!$online_service["current"]) { 
							if (strlen($online_service["dienst_gemist_url"]) > 0) {
								$url = $online_service["dienst_gemist_url"];
							}
						}
					?>
					<audio controls>
						<source src="<?php echo $url; ?>" type="audio/mpeg">
					(Your browser does not support the audio element.)
					</audio>											
				</div>
				<?php
			} else {
				echo "An error occured.";		
			}	?>
			</div>
		</div>	
	</div>		
	<a href="<?php echo sicr_slug_page("calendar"); ?>" class="btn" style="xmargin-top: 16px;">
		<span>Church Events</span>
	</a>
		
</div>