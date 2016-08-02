<?php
$recentPostsArgs = array();
$recentPostsArgs['numberposts'] 		= 5;
$recentPostsArgs['orderby'] 			= 'post_date';
$recentPostsArgs['order'] 				= 'DESC';
$recentPostsArgs['post_type'] 			= 'post';
$recentPostsArgs['post_status'] 		= 'publish';
$recentPostsArgs['suppress_filters'] 	= 'triue';
$recentPostList = wp_get_recent_posts( $recentPostsArgs );

$categoryHomePage = get_category_by_slug('sicr-home-page');
$idCategoryHomePage = $categoryHomePage->term_id;

$categoryArgs = array();
$categoryArgs['number'] = 12; 
$categoryArgs['orderby'] = "ID";
$categoryArgs['show_count'] = false;
$categoryArgs['title_li'] = '';
$categoryArgs['hide_empty'] = false;
$categoryArgs['exclude'] = '1,'.$idCategoryHomePage;

$categoriesList = get_categories( $categoryArgs );
?>

<style>
	div.categories-list h6 					{font-size: 1.2em;}
	div.search-box							{font-size: 1.2em; padding-bottom: 3px;}
	div.search-box label.screen-reader-text {display: none;}
	div.search-box input[type="text"] 		{padding: 6px 8px 6px 8px; width: 50%;}
	div.search-box span						{}
	div.archive-box							{font-size: 1.2em; padding-bottom: 9px;}
	select.archive-dropdown					{xfont-size: 1.12em; padding: 8px 8px 8px 8px; width: 100%;}
</style>
<div class="grid_4">
	<!--  Search box -->
	<div class="box2">
		<div class="title_box">
			<h4><span>Search</span></h4>
		</div>	
		<div class="title_box search-box">
			<?php get_search_form(TRUE); ?>
		</div>
	</div>
	
	<!-- Recent postst -->
	<div class="box1">
		<div class="title_box">
			<h4><span>Recent Posts</span></h4>
		</div>
		<div class="title_box categories-list">
		
		<?php foreach ($recentPostList as $recentPost) {?>
			<h6 class="icon_title">
				<a href="<?php echo home_url('?p='.$recentPost['ID']); ?>">
					<?php echo $recentPost['post_title'];?>
				</a>
			</h6>
			<div><?php get_my_excerpt(15, $recentPost['ID'], true)?>
			</div>
		<?php }?>	
		</div>
	</div> <!-- box2 -->	
		
	<!-- categories list -->
	<div class="box1">
		<div class="title_box">
			<h4><span>Categories</span></h4>
		</div>
		<div class="title_box categories-list" style="padding-bottom: 8px;">
		<?php foreach ($categoriesList as $category) {?>
			<h6 class="icon_title">
				<a href="<?php echo home_url('?cat='.$category->cat_ID); ?>">
					<?php echo $category->name;?>
				</a>
			</h6>
		<?php }?>	
		</div>
	</div> <!-- box2 -->
	
	<div class="box2">
		<div class="title_box">
			<h4><span>News History</span></h4>
		</div>	
		<div class="title_box archive-box">
			<select class="archive-dropdown" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
			<option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
			<?php wp_get_archives('type=monthly&limit=12&format=option&show_post_count=0'); ?></select>
		</div>
	</div>
	
	
                
				
</div><!-- grid_4 -->