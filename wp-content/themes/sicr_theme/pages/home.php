<?php
/*
Template Name: Home Page
*/
?>
<?php 
get_header();

global $includeChrismasImage;
$includeChrismasImage = FALSE;
 
if (!$includeChrismasImage) :
	include 'home-normal.php';
else :
	include 'home-christmas.php';
endif;

?>
<div class="grid_4 floatright"  style="margin: 0px;">
	<?php include 'home-news.php';?>
</div>

<?php
get_footer();
?>