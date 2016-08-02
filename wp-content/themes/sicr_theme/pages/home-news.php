<div class="box1">
	<div class="title_box m_21">
		<h4>News <span>& Events</span></h4>
	</div>
	
	<?php
	
	$maxPostsToShow = 4;
	if (isset($includeChrismasImage)) {
		if ($includeChrismasImage) {
			$maxPostsToShow = 6;		
		}
	}
	
	// ET: ugly hack to make sticky posts come out on top.
	// we do TWO get_posts, and then merge and slice
	// Correct solution to use WP_Query, but I am already using get_posts instead
	$args = array( 'category_name' => 'sicr-home-page', 'numberposts' => $maxPostsToShow, 'order'=> 'DES', 'orderby' => 'date', 'include' => implode(',', get_option('sticky_posts')) );
	$args2 = array( 'post__not_in'=>get_option('sticky_posts'), 'category_name' => 'sicr-home-page', 'numberposts' => $maxPostsToShow, 'order'=> 'DES', 'orderby' => 'date' );	
	$postslist = get_posts( $args );
	$postslist2 = get_posts( $args2 );
	$postslist = array_merge($postslist, $postslist2);
	$postslist= array_slice($postslist, 0, 6);	
	
	global $post;
	//$args = array( 'numberposts' => $maxPostsToShow, 'category_name' => 'sicr-home-page' );
	//$posts = get_posts( $args );
	$posts = $postslist;
	$idxPost = 0;
	$postDatum = "";
	foreach( $posts as $post ): setup_postdata($post); 
		$idxPost++;
		if ($idxPost <= $maxPostsToShow):
		
		$postDatum = get_post_meta($post->ID, "Date", true);
	?>
	
	<div id="post-<?php the_ID(); ?>" class="title_box m_19" >
		<a  href='<?php the_permalink(); ?>' class='img_to_post'>
			
			<?php 
			//if has_post_thumbnail() && (!is_post_with_images($post))) {
			if (has_post_thumbnail()) {
				the_post_thumbnail("thumbnail");							    	
			} else {
				echo "<img src='".sicr_image_dir()."/church-news-312x175.jpg' alt=''>";
			}?>
			
			<?php if ($postDatum) :?>
			  <span class='img_to_post_date'>
			  <?php echo $postDatum; ?>
			  </span>
			<?php endif;?>
		</a>
		
		<h6 class="italic m_01">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>				
		
		
		
		<?php my_excerpt(25); ?>
				
	</div>
	<?php
		endif; //if ($idxPost < 6):
	endforeach; 
?>

	<?php
	$posts_page_url = site_url(); 
  	if( 'page' == get_option( 'show_on_front' ) ) {
    	$posts_page_id = get_option( 'page_for_posts' );   	
    	$posts_page = get_page( $posts_page_id );
    	$posts_page_url = site_url( get_page_uri( $posts_page_id ) );
  	}
  	?>
	<a href="<?php echo $posts_page_url;?>" class="btn">
		<span>
			Read more
		</span>
	</a>

	
</div>
