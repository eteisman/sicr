<?php 
the_post();
get_header();
?>
<div class="box1">
	<div class="title_box m_14">
		<h4>
			<a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment">
				&lt;&lt; <?php echo get_the_title($post->post_parent) ?>
			</a>
		</h4>
	</div>

	<div id="nav-above" class="navigation">
	    <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&amp;laquo;</span> %title' ) ?></div>
	    <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&amp;raquo;</span>' ) ?></div>
	</div><!-- #nav-above -->

	<div class="title_box m_14">
		<div class="wrapper">
			<h6><?php the_title(); ?></h6>
			
			<div class="entry-content">
            	<div class="entry-attachment">
					<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "medium"); ?>
                        <p class="attachment">
                        	<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
                        		<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" />
                        	</a>
                        </p>
					<?php else : ?>
                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
					<?php endif; ?>
                </div>
                <div class="entry-caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt() ?></div>
 					<?php the_content( 'Continue reading ' ); ?>
					<?php wp_link_pages('before=<div class="page-link">Pages:&amp;after=</div>') ?>
 
			</div><!-- .entry-content -->
		</div>
	</div>
	
 
        <div id="container">
            <div id="content">
 
                <div id="nav-above" class="navigation">
                </div><!-- #nav-above -->
 
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                </div><!-- #post-<?php the_ID(); ?> -->
 
                <div id="nav-below" class="navigation">
                </div><!-- #nav-below -->
 
            </div><!-- #content -->
        </div><!-- #container -->

 <div class="entry-utility">
                    <?php printf( __( 'This entry was posted in %1$s%2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'your-theme' ),
                        get_the_category_list(', '),
                        get_the_tag_list( __( ' and tagged ', 'your-theme' ), ', ', '' ),
                        get_permalink(),
                        the_title_attribute('echo=0'),
                        get_post_comments_feed_link() ) ?>
 
<?php if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Comments and trackbacks open ?>
                        <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'your-theme' ), get_trackback_url() ) ?>
<?php elseif ( !('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Only trackbacks open ?>
                        <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'your-theme' ), get_trackback_url() ) ?>
<?php elseif ( ('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Only comments open ?>
                        <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'your-theme' ) ?>
<?php elseif ( !('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Comments and trackbacks closed ?>
                        <?php _e( 'Both comments and trackbacks are currently closed.', 'your-theme' ) ?>
<?php endif; ?>
<?php edit_post_link( __( 'Edit', 'your-theme' ), "nttttt<span class='edit-link'>", "</span>" ) ?>
</div><!-- .entry-utility -->
                    
	<div id="nav-below" class="navigation">
	    <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&amp;laquo;</span> %title' ) ?></div>
	    <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&amp;raquo;</span>' ) ?></div>
	</div><!-- #nav-below --> 
</div> <!-- box1 -->
<?php get_footer(); ?>