<?php
//ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//error_reporting(E_ALL); 
?>
<?php include_once 'library.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SICR</title>
	<?php include "head-includes.php"?>
</head>
<body class="navy">
	<header>
		<div class="header_box">
			<div class="container">
				<div class="row">
					<div class="grid_12">
						<!--======================== logo ============================-->
						<h1>
							<a class="logo" href="<?php echo get_home_url();?>"><img src="<?php echo sicr_image_dir();?>/sicr_logo_large_transparent.png" alt="" style="height: 120px; width: 100x;">
								<h6 class="logo">
								Scots International<br/>&nbsp;&nbsp;Church <span class="logo">Rotterdam</span></h6>
							</a>													
						</h1>						
						<!--======================== menu ============================-->
						<?php
						$menu_options = array(
							'theme_location'  => 'main-menu',
							'container'       => 'nav',
							'container_class' => 'menu',
							'container_id'    => '',
							'menu_class'      => 'sf-menu clearfix',
							'menu_id'         => 'sc-main-menu',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => ''
						);
						wp_nav_menu($menu_options);
						?>						
					</div>
				</div>
			</div>
		</div>
		

<?php
// Code to hide the extra menu item for the second service sheet
$extraServiceMenuItem = get_menu_from_title("Service Sheet (2)"); // see functions.php
$ss2_display = "none";
if (have_two_service_sheets()) {
	$ss2_display = "";
}

// If they have the same date, then dont hide the second item!
?>
<style>
  li.menu-item-<?php echo $extraServiceMenuItem->ID?> {display: <?php echo $ss2_display?>;}
</style>


		<?php
		// code to show the images slider only on the home page
		$page_template = get_page_template_slug(  );
		if ($page_template == "pages/home.php") {
			include "header_slideshow.php";
		}
		?>
	</header>
	<!--======================== content ===========================-->
	<div id="content">
		<div class="container">
			<div class="row">					
				

		