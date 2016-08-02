<?php
/*
Template Name: The Herald Popup
*/
?>
<?php include_once "library.php" ?>
<?php
	$list = get_the_herald_list( get_sicr_root_dir() );
	$latestItem = $list[1]["items"][1];
	
	header('location: ' . $latestItem["link"]);
?>