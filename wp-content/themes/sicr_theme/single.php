<?php 
the_post();
get_header();
$postDatum = get_post_meta($post->ID, "Date", true);
?>
<style>
 body.navy span.entry-date  	{margin-right: 4px;}
 body.navy a.post-edit-link 	{margin-left: 4px; color: white;}
 body.navy a.more-link 			{}
 img.attachment-thumbnail		{margin-right: 28px; margin-bottom: 8px;}
 </style>
<div class="grid_12">
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
			<h4><span><?php the_title(); ?></span></h4>
		</div>
		
	
		<div class="title_box m_14">
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
			
				<?php /* The entry content */ ?>
	        	<div class="entry-content">
					<?php the_content(__( '<span>Read more</span>', 'sicr_theme' )); ?>
				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sicr_theme' ) . '&amp;after=</div>') ?>        </div><!-- .entry-content -->
			</div>
			
		</div>
		
	 
	        <div id="container">
	            <div id="content">
	 
	                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                </div><!-- #post-<?php the_ID(); ?> -->
	
					<?php 
					if (is_user_logged_in()):
						echo "<div style='margin-bottom: 8px; font-style: italic; font-size: 0.86em;'>";
					 	printf( 'This entry was posted under %1$s.', get_the_category_list(', ') );
					 	echo "</div>";
					endif;
					?>
					<!--
	                <div id="nav-below" class="navigation">
		    			<?php previous_post_link( '%link', '<div class="nav-previous button-link"><span class="meta-nav">&lt; %title</span></div>' ) ?>
		    			<?php next_post_link( '%link', '<div class="nav-next button-link"><span class="meta-nav">%title &gt;</span></div>' ) ?>                
	                </div>
					-->
					<!-- #nav-below -->
	            </div><!-- #content -->
	        </div><!-- #container -->
	</div> <!-- box1 -->
</div><!-- class="grid_12" -->

<?php get_footer(); ?>