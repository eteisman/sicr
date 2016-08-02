<?php
/*
Template Name: The Service Sheet Popup
*/
?>
<?php include_once "library.php" ?>
<?php
	$list = get_service_sheet_list( sicr_root_dir() );
	$latestItem = $list[1]["items"][1];
	
	header('location: ' . $latestItem["link"]);
?>