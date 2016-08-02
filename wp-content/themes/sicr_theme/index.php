<?php 
get_header();
 ?>
 <style>
 body.navy span.entry-date  	{margin-right: 4px;}
 body.navy a.post-edit-link 	{margin-left: 4px; color: white;}
 body.navy a.more-link 			{}
 img.attachment-thumbnail		{margin-right: 28px; margin-bottom: 8px;} 
 </style>
 <div class="grid_8">	
	<?php if ( $wp_query->post_count === 0) :?>
	<div class="box1 large-text">
		<div class="m_14">
			<h4><span>There are no posts available.</a></span></h4>
		</div>
	</div>
	<?php endif;?>
	
	<?php /* The Loop — with comments! */ ?>
	<?php while ( have_posts() ) : the_post() ?>
		<?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>
		<?php $postDatum = get_post_meta($post->ID, "Date", true);?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('box1 large-text');?>>
			<div class="ribbon blue-ribbon">
				<div class="entry-meta" style="float: left;">
					<span class="entry-date"><?php echo $postDatum; ?></span>
				</div>				    	
				<div class="entry-meta" style="float: right; margin-right: 36px;">
					<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'sicr_theme'); ?></span>
					<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-dTH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
					<?php edit_post_link( __( 'Edit', 'sicr_theme' ), '<span class="meta-sep">|</span><span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-meta -->
				<div style="clear: both;"></div>				
			</div>			
			<div class="m_14">
				<h4><span><?php the_title(); ?></a></span></h4>
			</div>
			
			<div class="title_box m_13">
				<div class="wrapper">
					<a href="<?php the_permalink(); ?>">
					<?php 
					if ( has_post_thumbnail() && (!is_post_with_images($post))) :
						echo "<div class='img_fleft'>";
						the_post_thumbnail("thumbnail");
						echo "</div>";
					elseif (!is_post_with_images($post)) :
						echo "<img class='attachment-thumbnail wp-post-image' src='".sicr_image_dir()."/church-news-312x175.jpg' alt='' align='LEFT'>";
					endif;
					?>
					</a>
					<?php the_content(__( '<span>Read more</span>', 'sicr_theme' )); ?>					
				</div>
			<?php 
			if (is_user_logged_in()):
				echo "<div style='margin-bottom: 8px; margin-top: 8px; font-style: italic; font-size: 0.86em;'>";
			 	printf( 'This entry was posted under %1$s.', get_the_category_list(', ') );
			 	echo "</div>";
			else:
				echo "<br/>"; 
			endif;
			?>
			
			</div>
			<!-- #post-<?php the_ID(); ?> -->
							
	 
	       
		</div>
	 
	<?php /* Close up the post div and then end the loop with endwhile */ ?>
	 
	<?php endwhile; ?>
	 
	<?php /* begin bottom post navigation */ ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
		<div id="nav-below" class="navigation">
	    	<?php next_posts_link('<div class="nav-previous button-link"><span class="meta-nav">&lt; Older Posts</span></div>') ?>
	        <?php previous_posts_link('<div class="nav-next button-link"><span class="meta-nav">Newer Posts &gt;</span></div>') ?>
		</div><!-- #nav-below -->
	<?php } ?>
	<?php /* end bottom post navigation */ ?>
	<br/>
</div><!-- class="grid_8" -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>