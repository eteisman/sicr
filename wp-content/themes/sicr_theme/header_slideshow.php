<script>
	$(document).ready(function(){
		$('#slider').camera({
			height: '37.71%',
			loader: true,
			minHeight: '200px',
			navigation: false,
			navigationHover: false,
			pagination:true,
			playPause: false,
			thumbnails: false,
			fx: 'simpleFade',
			time: 5000
		});
	});
</script>	
<div class="container">
	<div class="row">
		<div class="grid_12">
			<!--=================== slider ==================-->
			<div class="slide_box">
				<div class="camera_wrap" id="slider">
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-1.jpg" data-thumb="images/home-photo-1.jpg">
						<div class="camera_caption">
							<h4></h4>
							<h3> </h3>
							<!-- All are welcome in this place -->
						</div>
					</div>														
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-3.jpg" data-thumb="images/home-photo-3.jpg">
						<div class="camera_caption">
							<h4></h4>
							<h3></h3>
						</div>
					</div>
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-8.jpg" data-thumb="images/home-photo-8.jpg">
						<div class="camera_caption">
							<h4></h4>
							<h3></h3>
							<!-- God is good all the time  -->
						</div>
					</div>										
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-2.jpg" data-thumb="images/home-photo-2.jpg">
						<div class="camera_caption">
							<h4></h4>
							<h3></h3>
							<!-- God is good all the time  -->
						</div>
					</div>					
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-4.jpg" data-thumb="images/home-photo-4.jpg">
						<div class="camera_caption">
							<h4></h4>
							<h3></h3>
						</div>
					</div>
					<?php if (FALSE) :?>					
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-5.jpg" data-thumb="images/home-photo-1.jpg">
						<div class="camera_caption">
							<h4> </h4>
							<h3> </h3>
							<!-- All are welcome in this place -->
						</div>
					</div>
					<?php endif;?>
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-6.jpg" data-thumb="images/home-photo-6.jpg">
						<div class="camera_caption">
							<h4> </h4>
							<h3> </h3>
							<!-- All are welcome in this place -->
						</div>
					</div>
					<div data-src="<?php echo sicr_image_dir();?>/home-photo-7.jpg" data-thumb="images/home-photo-7.jpg">
						<div class="camera_caption">
							<h4> </h4>
							<h3> </h3>
							<!-- All are welcome in this place -->
						</div>
					</div>										
				</div>
			</div>
		</div>
	</div>
</div>
