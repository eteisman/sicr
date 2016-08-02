<?php 
// Make theme available for translation
// Translations can be filed in the /languages/ directory
//load_theme_textdomain( 'your-theme', TEMPLATEPATH . '/languages' );

add_theme_support( 'menus' );

add_theme_support( 'post-thumbnails' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);

function register_my_menu() {
register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_my_menu' );
    
/*
function custom_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
*/
    
/** Plugin Name: (#63748) Modify the »more«-link. */
//add_action( 'the_content_more_link', 'wpse63748_add_morelink_class', 10, 2 );
function wpse63748_add_morelink_class( $link, $text )
{
    return str_replace(
        'more-link',
        'more-link btn',
        $link
    );
}
    
// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number

function is_post_with_images($post) {
	if (get_post_gallery()) {
		return TRUE;
	}
	
 	$posttext = $post->post_content;
 
	// We will search for the src="" in the post content
	$regular_expression = '~src="[^"]*"~';
	$regular_expression1 = '~<img alt="" />]*\ />~';
	 
	// WE will grab all the images from the post in an array $allpics using preg_match_all
	preg_match_all( $regular_expression, $posttext, $allpics );
	 
	// Count the number of images found
	$NumberOfPics = count($allpics[0]);
	return ($NumberOfPics > 0); 	
}
function is_gallery_post($post) {
   return (count(get_post_gallery_images( $post )) > 0);	
}

/**
 * Returns the permalink for a page based on the incoming slug.
 *
 * @param   string  $slug   The slug of the page to which we're going to link.
 * @return  string          The permalink of the page
 * @since   1.0
 */
function sicr_slug_url( $slug, $post_type = '' ) {

    // Initialize the permalink value
    $permalink = null;

    // Build the arguments for WP_Query
    $args = array(
        'name'          => $slug,
        'max_num_posts' => 1
    );
    

    // If the optional argument is set, add it to the arguments array
    if( '' != $post_type ) {
        $args = array_merge( $args, array( 'post_type' => $post_type ) );
    }

    // Run the query (and reset it)
    $query = new WP_Query( $args );
    if( $query->have_posts() ) {
        $query->the_post();
        $permalink = get_permalink( get_the_ID() );
    }
    wp_reset_postdata();

    return $permalink;
}
function sicr_slug_page( $slug ) {
	return sicr_slug_url($slug, 'page');
}
function sicr_image_dir() {
	return get_template_directory_uri()."/images";
}
function sicr_template_dir() {
	//return get_template_directory();
	return ".";
}
function sicr_pages_dir() {
	return get_template_directory()."\pages";
}

function sicr_root_dir() {
    $base = dirname(__FILE__);
    $path = false;

    if (@file_exists(dirname(dirname($base))."/wp-config.php"))
    {
        $path = dirname(dirname(dirname($base)));
    }
    else
    if (@file_exists(dirname(dirname(dirname($base)))."/wp-config.php"))
    {
        $path = dirname(dirname(dirname(dirname($base))));
    }
    else
    $path = false;

    if ($path != false)
    {
        $path = str_replace("\\", "/", $path);
    }
    return $path;
}
function sicr_blog_dir() {
    $base = dirname(__FILE__);
    $path = false;

    if (@file_exists(dirname(dirname($base))."/wp-config.php"))
    {
        $path = dirname(dirname($base));
    }
    else
    if (@file_exists(dirname(dirname(dirname($base)))."/wp-config.php"))
    {
        $path = dirname(dirname(dirname($base)));
    }
    else
    $path = false;

    if ($path != false)
    {
        $path = str_replace("\\", "/", $path);
    }
    return $path;
}

function my_excerpt($excerpt_length = 55, $id = false, $echo = true) {
	  
    $text = '';
    
	  if($id) {
	  	$the_post = & get_post( $my_id = $id );
	  	$text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
	  } else {
	  	global $post;
	  	$text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
    }
	  
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
	  $text = strip_tags($text);
	
		$excerpt_more = ' ' . '[...]';
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	if($echo)
  echo apply_filters('the_content', $text);
	else
	return $text;
}

function get_my_excerpt($excerpt_length = 55, $id = false, $echo = false) {
 return my_excerpt($excerpt_length, $id, $echo);
}

function get_menu_from_title($Title) {
	return get_page_by_title($Title, OBJECT, "nav_menu_item");
}
?>