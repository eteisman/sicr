<?php
/*
Template Name: News - Calendar
*/
?>
<?php 
get_header();

try {
  	$services = get_services_data(7);
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


//var_dump($future_services);
?>

<style>
div.calendar_row {
	min-height: 150px;
}
div. class="box-inner" {
	padding: 0px; margin: 0px;
}
a.calendar-link {
	font-size: 1.1em;
	font-style: italic;
	text-decoration: underline;
}
</style>

<div class="grid_4">
	<div class="box1">
		<div class="ribbon blue-ribbon">
			News &nbsp;&nbsp;&gt;&nbsp;&nbsp; Church Events
		</div>								
		<div class="title_box">
			<h4 id="services-title">
				Upcoming <span>Services</span>
			</h4>
		</div>	
		<div style="min-height: 1050px;">
			<div class="box-inner">	
			<?php 		
			if ($future_services) {
				$n =0;
				for ($i = 0; $i < count($future_services); $i++) {?>
				<div class="title_box calendar_row">
					<h6 class="icon_title">
						<a href="<?php echo $future_services[$i]["link"]?>">
						  <?php echo date("l j F Y", $future_services[$i]["date"]); ?>
						</a>
					</h6>
					<p>
						<i class="fa fa-clock-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						<?php echo $future_services[$i]["name"]." ".$future_services[$i]["time"]; ?><br/>			
						<i class="fa fa-user" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>			
						Preacher: <?php echo $future_services[$i]["preacher"]; ?><br/>
						<i class="fa fa-book" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						<?php echo $future_services[$i]["scripture"]; ?><br/>
						<?php if (strlen($future_services[$i]["comment"]) > 0) {?>
							<i class="fa fa-star" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
							<?php echo $future_services[$i]["comment"]; 
						}?>
					</p>
				</div>
			<?php
				$n++;
				if ($n>=7) break; 
				}		
			} else {
				echo "An error occured.";			
			}?>
			</div>
			<a target="_blank" href="http://www.scotsintchurch.com/events/?page_id=13" class="calendar-link" style="margin-top: 20px;">
				<span>View Events Calendar</span>
			</a>
		</div>			
	</div>		
</div>

<div class="grid_4">
	<div class="box1">
		<div class="ribbon blue-ribbon">
			News &nbsp;&nbsp;&gt;&nbsp;&nbsp; Church Events
		</div>									
		<div class="title_box">		
			<h4 id="services-title">
				Past <span>Services</span>
			</h4>
		</div>	
		<div style="min-height: 1050px;">
			<div class="box-inner">	
			<?php 
			if ($past_services) {
				$n =0;
				for ($i = 1; $i < count($past_services); $i++) {?>
				<div class="title_box calendar_row">
						<h6 class="icon_title">
						<a href="<?php echo $past_services[$i]["link"]?>">
						  <?php echo date("l j F Y", $past_services[$i]["date"]); ?>
						</a>
					</h6>
					<p>
						<i class="fa fa-clock-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						<?php echo $past_services[$i]["name"]." ".$past_services[$i]["time"]; ?><br/>			
						<i class="fa fa-user" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>			
						Preacher: <?php echo $past_services[$i]["preacher"]; ?><br/>
						<i class="fa fa-book" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						<?php echo $past_services[$i]["scripture"]; ?><br/>
						<?php if (strlen($past_services[$i]["dienst_gemist_url"]) > 0) {?>
							<audio controls>
								<source src="<?php echo $past_services[$i]["dienst_gemist_url"] ?>" type="audio/mpeg">
							(Your browser does not support the audio element.)
							</audio>											
						<?php }?>
					</p>
				</div>
				<?php
				$n++;
				if ($n>=6) break; 			
				}
			} else {
				echo "An error occured.";		
			}?>
			</div>
			<a target="_blank" href="http://kerkdienstgemist.nl/assets/733518" class="calendar-link" style="margin-top: 20px;">
				<span>View "Kerkdienst Gemist" website</span>
			</a>						
		</div>
	</div>		
</div>

<div class="grid_4">
	<div class="box1">
		<div class="ribbon blue-ribbon">
			News &nbsp;&nbsp;&gt;&nbsp;&nbsp; Church Events
		</div>									
		<div class="title_box">
			<h4 id="services-title">
				Upcoming <span>Events</span>
			</h4>
		</div>	
		<div style="min-height: 1054px;">
			<div class="box-inner">	
			<?php 		
			if ($other_events) {
				$n =0;
				for ($i = 0; $i < count($other_events); $i++) {?>
				<div class="title_box calendar_row">
					<h6 class="icon_title">
						<a href="<?php echo $other_events[$i]["link"]?>">
						  <?php echo date("l j F Y", $other_events[$i]["date"]); ?>
						</a>
					</h6>
					<p>
						<i class="fa fa-bookmark-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						<?php echo $other_events[$i]["name"]; ?><br/>
						<?php if ($other_events[$i]["time"]) { ?>
							<i class="fa fa-clock-o" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
							<?php echo $other_events[$i]["time"]; ?><br/>
						<?php } ?>
						
						<i class="fa fa-map-marker" style="font-size: 1.1em; margin-left: 8px; margin-right: 8px;"></i>
						<?php echo $other_events[$i]["location"]; ?><br/>											
					</p>
				</div>
			<?php
				$n++;
				if ($n>=7) break; 
				}		
			} else {
				echo "An error occured.";			
			}?>
			</div>
			<a target="_blank" href="http://www.scotsintchurch.com/events/?page_id=13" class="calendar-link" style="margin-top: 20px;">
				<span>View Events Calendar</span>
			</a>
		</div>
	</div>		
</div>


<?php get_footer(); ?>