
<style>
	body.navy h6.btn-action {
		margin-bottom: 3px;
	}
	div.btn-action-after {
		height: 5px;
	}
	div.btn-action {
		width: 100%;
		margin: 0px;
		padding: 0px;
		font-family: 'Open Sans', sans-serif;		
	}
    a.btn-action {
		border: solid 1px white;
		padding: 12px 4px 12px 4px;
		display: block;		
		background-color: white;		
		transition: 0.3s;
	}
	a.btn-action:hover {
		text-decoration: none;
	}
	span.btn-action-title {		
		font-weight: 600;
		white-space: nowrap;
		display: block;
		text-align: center;
	}
	span.btn-action-label {
		font-weight: 500;		
		color: white;				
		white-space: nowrap;		
		display: block;
		text-align: center;
	}
	div.btn-action-outer {
		padding: 2px 0px 2px 0px;
	}	
	
	/* orange = RGB(254,132,1); */
	div.orange div {
		border: solid 1px rgba(255,112,0,1);
	}
	div.orange div a {		
		background-color: rgba(255,112,0,0.6);
	}	
	div.orange div a:hover {
		background-color: rgba(255,112,0,0.7);
	}
	div.orange div a span.btn-action-title {
		color: rgba(255,112,0,1);
	}	
	/* blue = RGB(47,151,198); */
	div.blue div {
		border: solid 1px rgba(0,114,198,1);
	}
	div.blue div a {		
		background-color: rgba(0,114,198,0.6);
	}	
	div.blue div a:hover {
		background-color: rgba(0,114,198,0.7);
	}
	div.blue div a span.btn-action-title {
		color: rgba(0,114,198,1);
	}
	/* navy = RGB(1,1,137); */
	div.navy div {
		border: solid 1px rgba(1,1,137,1);
	}
	div.navy div a {		
		background-color: rgba(1,1,137,0.6);
	}	
	div.navy div a:hover {
		background-color: rgba(1,1,137,0.7);
	}
	div.navy div a span.btn-action-title {
		color: rgba(1,1,137,1);
	}	
	/* green = RGB(57,151,98); */
	div.green div {
		border: solid 1px rgba(57,151,98,1);
	}
	div.green div a {		
		background-color: rgba(57,151,98,0.6);
	}	
	div.green div a:hover {
		background-color: rgba(57,151,98,0.7);
	}
	div.green div a span.btn-action-title {
		color: rgba(57,151,98,1);
	}
	/* purple = RGB(154,1,154); */
	div.purple div {
		border: solid 1px rgba(154,1,154,1);
	}
	div.purple div a {		
		background-color: rgba(154,1,154,0.6);
	}	
	div.purple div a:hover {
		background-color: rgba(154,1,154,0.7);
	}
	div.purple div a span.btn-action-title {
		color: rgba(154,1,154,1);
	}

	/* media default, max width */	
	span.btn-action-title {font-size: 2.2em; margin-bottom: 12px;}
	span.btn-action-label {font-size: 1.1em; margin-top: 12px;}
				
	@media only screen and (max-width: 1200px) {
		span.btn-action-title {font-size: 1.65em; margin-bottom: 6px;}
		span.btn-action-label {font-size: 0.86em; margin-top: 6px;}		
	}
	@media only screen and (max-width: 980px) {
		span.btn-action-title {font-size: 1.20em; margin-bottom: 0px;}
		span.btn-action-label {font-size: 0.68em; margin-top: 0px;}			
	}
	@media only screen and (max-width: 767px) {
		span.btn-action-title {font-size: 2.2em; margin-bottom: 12px;}
		span.btn-action-label {font-size: 1.2em; margin-top: 12px;}			
	}
	@media only screen and (max-width: 480px) {
		span.btn-action-title {font-size: 1.6em; margin-bottom: 12px;}
		span.btn-action-label {font-size: 0.86em; margin-top: 12px;}			
	}
</style>
<div class="box1">
	<div class="title_box">
		<h4>
			What's<span> Next</span>
		</h4>
	</div>
	<div class="title_box">
	<h6 class="italic btn-action">
		<div class="btn-action-outer blue">
			<div class="btn-action">
				<a href="<?php echo sicr_slug_page('sunday-service'); ?>" class="btn-action">
					<span class="btn-action-title">Sunday Services</span>
					<span class="btn-action-label">Sundays 10:30 a.m. till 12:00</span>
				</a>			
			</div>
		</div>
	<h6>
	<h6 class="italic btn-action">
		<div class="btn-action-outer purple">
			<div class="btn-action">
				<a target="_blank" href="http://kerkdienstgemist.nl/assets/733518" class="btn-action">
					<span class="btn-action-title"><span style="font-size:0.92em;">Kerkdienst Gemist</span></span>
					<span class="btn-action-label">Live broadcast and replay</span>
				</a>			
			</div>
		</div>		
	</h6>
	<h6 class="italic btn-action">
		<div class="btn-action-outer orange">
			<div class="btn-action">
				<a href="<?php echo sicr_slug_page('giving-financial-information'); ?>" class="btn-action">
					<span class="btn-action-title">Giving</span>
					<span class="btn-action-label">Financial gifts and donations</span>
				</a>			
			</div>
		</div>		
	</h6>
	<h6 class="italic btn-action">
		<div class="btn-action-outer green">
			<div class="btn-action">
				<a href="<?php echo sicr_slug_page('volunteering'); ?>" class="btn-action">
					<span class="btn-action-title">Volunteering</span>
					<span class="btn-action-label">Becoming a volunteer</span>
				</a>			
			</div>
		</div>		
	</h6>
	<h6 class="italic btn-action">
		<div class="btn-action-outer navy">
			<div class="btn-action">
				<a href="<?php echo sicr_slug_page('rentals'); ?>" class="btn-action">
					<span class="btn-action-title">Rentals</span>
					<span class="btn-action-label">Church hall and Sanctuary for rent</span>
				</a>			
			</div>
		</div>		
	</h6>
	<div class="btn-action-after"></div>
	</div>
	
</div>