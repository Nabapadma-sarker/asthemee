<?php

 register_nav_menus( array(
'header_menu' => 'it is for header menu',
'blog_sidebar' => 'it is for blog sidebar menu',
'news_sidebar' => 'it is for news sidebar menu',
'footer_primary_menu' => 'it is for footer primary menu',
'footer_secondary_menu' => 'it is for footer secondary menu',
)
 ); 

function wpdocs_custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

add_action( 'after_setup_theme', 'logo_support' );
function logo_support() {
	 $args = array(
	
	'default-image' => get_template_directory_uri() . '/images/logo.png',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );
}

function astheme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {  
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'astheme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'astheme_wp_title', 10, 2 );
 
function Schulthess_widgets_init() {
  register_sidebar( array(
  'name'          => 'Home Subscribe and Login',
  'id'            => 'home_subscribe_and_login',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => '',
 ) );

 register_sidebar( array(
  'name'          => 'Footer area Follow US',
  'id'            => 'follow_us',
  'before_widget' => '',
  'after_widget'  => '',
  'before_title'  => '',
  'after_title'   => '',
 ) ); 
}
add_action( 'widgets_init', 'Schulthess_widgets_init' );




//----------------------------------------------
//--------------add theme support for thumbnails
//----------------------------------------------
if ( function_exists( 'add_theme_support')){
    add_theme_support( 'post-thumbnails' );
}
add_image_size( 'admin-list-thumb', 80, 80, true); //admin thumbnail
add_image_size( 'event_thumb', 660, 330, false);
add_image_size( 'company_thumb', 150, 130, false);
add_image_size( 'news_thumb', 304, 162, false);
//----------------------------------------------
//----------register and label Banners post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Banners', 'post type general name'),
    'singular_name' => _x('Banner', 'post type singular name'),
    'add_new' => _x('Add New', 'Banners'),
    'add_new_item' => __("Add New Banner"),
    'edit_item' => __("Edit Banner"),
    'new_item' => __("New Banner"),
    'view_item' => __("View Banner"),
    'search_items' => __("Search Banners"),
    'not_found' =>  __('No Banners found'),
    'not_found_in_trash' => __('No Banners found in Trash'), 
	'featured_image'        => __( 'Banner image', 'Banners' ),
	'set_featured_image'    => __( 'Set Banner image', 'Banners'),
	'remove_featured_image' => __( 'Remove Banner image', 'Banners' ),
	'use_featured_image'    => __( 'Use Banner image', 'Banners' ),
        
);
$Banners_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor' ),
    'menu_icon' => 'dashicons-format-gallery' //16x16 png if you want an icon
); 
register_post_type('banners', $Banners_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_bannertype_taxonomies', 0);
 
function jss_create_bannertype_taxonomies(){
    register_taxonomy(
        'bannertype', 'banners', 
        array(
            'hierarchical'=> true, 
            'label' => 'banner Types',
            'singular_label' => 'banner Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-banners_columns', 'jss_add_new_banners_columns');
 
function jss_add_new_banners_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb4'    =>        'Thumbnail',		
        'title'                =>        'Banners Title',
		'description4'    =>        'Description',
        'bannertype'            =>        'Banners Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns4');
function jss_custom_columns4( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb4' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description4' : the_excerpt(); break;
        case 'bannertype' : echo get_the_term_list( $post->ID, 'bannertype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------

//----------------------------------------------
//----------register and label gallery post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Company Logos', 'post type general name'),
    'singular_name' => _x('Company Logos', 'post type singular name'),
    'add_new' => _x('Add New', 'Company Logo'),
    'add_new_item' => __("Add New Company Logo"),
    'edit_item' => __("Edit Company Logo"),
    'new_item' => __("New Company Logo"),
    'view_item' => __("View Company Logo"),
    'search_items' => __("Search Company Logo"),
    'not_found' =>  __('No Company Logo found'),
    'not_found_in_trash' => __('No Company Logos found in Trash'), 
	'featured_image'        => __( 'Company Logo image', 'Company Logos' ),
	'set_featured_image'    => __( 'Set Company Logo image', 'Company Logos'),
	'remove_featured_image' => __( 'Remove Company Logo image', 'Company Logos' ),
	'use_featured_image'    => __( 'Use Company Logo image', 'Company Logos' ),
        
);
$company_logos_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail'),
    'menu_icon' => 'dashicons-building' //16x16 png if you want an icon
); 
register_post_type('company_logos', $company_logos_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_company_logos_taxonomies', 0);
 
function jss_create_company_logos_taxonomies(){
    register_taxonomy(
        'company_logos_type', 'company_logos', 
        array(
            'hierarchical'=> true, 
            'label' => 'Company Logo Types',
            'singular_label' => 'Company Logo Type',
            'rewrite' => true
        )
    );    
}

//----------------------------------------------
//--------------------------admin custom columns
//----------------------------------------------
//admin_init
add_action('manage_posts_custom_column', 'jss_custom_columns');
add_filter('manage_edit-company_logos_columns', 'jss_add_new_company_logos_columns');
 
function jss_add_new_company_logos_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
        'jss_post_thumb'    =>        'Company logo',
        'title'                =>        'Company logo link',
        'company_logos_type'            =>        'Company logo Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
 
function jss_custom_columns( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description' : the_excerpt(); break;
        case 'company_logos_type' : echo get_the_term_list( $post->ID, 'company_logos_type', '', ', ',''); break;
    }
}
 
//add thumbnail images to column
add_filter('manage_posts_columns', 'jss_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'jss_add_post_thumbnail_column', 5);
add_filter('manage_custom_post_columns', 'jss_add_post_thumbnail_column', 5);
 
// Add the column
function jss_add_post_thumbnail_column($cols){
    $cols['jss_post_thumb'] = __('Thumbnail');
    return $cols;
}
 
function jss_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'jss_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in this theme';
      break;
  }
}


//----------------------------------------------
//----------register and label Events post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Events', 'post type general name'),
    'singular_name' => _x('Event', 'post type singular name'),
    'add_new' => _x('Add New', 'Event'),
    'add_new_item' => __("Add New Event"),
    'edit_item' => __("Edit Event"),
    'new_item' => __("New Event"),
    'view_item' => __("View Event"),
    'search_items' => __("Search Events"),
    'not_found' =>  __('No Events found'),
    'not_found_in_trash' => __('No Events found in Trash'), 
	'featured_image'        => __( 'Event image', 'Events' ),
	'set_featured_image'    => __( 'Set Event image', 'Events'),
	'remove_featured_image' => __( 'Remove Event image', 'Events' ),
	'use_featured_image'    => __( 'Use Event image', 'Events' ),
        
);
$Events_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor','excerpt' ),
    'menu_icon' => 'dashicons-calendar-alt' //16x16 png if you want an icon
); 
register_post_type('events', $Events_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_eventtype_taxonomies', 0);
 
function jss_create_eventtype_taxonomies(){
    register_taxonomy(
        'eventtype', 'events', 
        array(
            'hierarchical'=> true, 
            'label' => 'Event Types',
            'singular_label' => 'Event Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-events_columns', 'jss_add_new_events_columns');
 
function jss_add_new_events_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb2'    =>        'Thumbnail',		
        'title'                =>        'events Title',
		'description2'    =>        'Description',
        'eventtype'            =>        'event Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns2');
function jss_custom_columns2( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb2' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description2' : the_excerpt(); break;
        case 'eventtype' : echo get_the_term_list( $post->ID, 'eventtype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------

//----------------------------------------------
//----------register and label News post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('News', 'post type general name'),
    'singular_name' => _x('News', 'post type singular name'),
    'add_new' => _x('Add New', 'News'),
    'add_new_item' => __("Add New News"),
    'edit_item' => __("Edit News"),
    'new_item' => __("New News"),
    'view_item' => __("View News"),
    'search_items' => __("Search News"),
    'not_found' =>  __('No News found'),
    'not_found_in_trash' => __('No News found in Trash'), 
	'featured_image'        => __( 'News image', 'News' ),
	'set_featured_image'    => __( 'Set News image', 'News'),
	'remove_featured_image' => __( 'Remove News image', 'News' ),
	'use_featured_image'    => __( 'Use News image', 'News' ),
        
);
$News_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor','excerpt' ),
    'menu_icon' => 'dashicons-media-text' //16x16 png if you want an icon
); 
register_post_type('news', $News_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_newstype_taxonomies', 0);
 
function jss_create_newstype_taxonomies(){
    register_taxonomy(
        'newstype', 'news', 
        array(
            'hierarchical'=> true, 
            'label' => 'news Types',
            'singular_label' => 'news Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-news_columns', 'jss_add_new_news_columns');
 
function jss_add_new_news_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb3'    =>        'Thumbnail',		
        'title'                =>        'News Title',
		'description3'    =>        'Description',
        'newstype'            =>        'News Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns3');
function jss_custom_columns3( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb3' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description3' : the_excerpt(); break;
        case 'newstype' : echo get_the_term_list( $post->ID, 'newstype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------

// Add the Events Meta Boxes add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );

function news_metaboxes() {
	add_meta_box('social_links', 'Social links', 'social_links', 'news', 'normal', 'low');
}

 add_action( 'add_meta_boxes', 'news_metaboxes' );
 
 // The Event Location Metabox

function social_links() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . wp_create_nonce( 'status_nonce'.$post->ID ) . '" />';
	
	// Get the location data if its already been entered
	$link1 = get_post_meta($post->ID, 'link1', true);
	$link2 = get_post_meta($post->ID, 'link2', true);
	$link3 = get_post_meta($post->ID, 'link3', true);
	
	// Echo out the field
	echo '<input type="text" value="'.$link1.'"  name="link1" placeholder="Facebook link" style="width: 100%; margin: 10px 0px;"/>';
	echo '<input type="text" value="'.$link2.'"  name="link2" placeholder="Linkedin link" style="width: 100%; margin: 10px 0px;"/>';
	echo '<input type="text" value="'.$link3.'"  name="link3" placeholder="Twitter link" style="width: 100%; margin: 10px 0px;"/>';

}

// Save the Metabox Data

function wpt_save_news_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], 'status_nonce'.$post_id )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$events_meta['link1'] = $_POST['link1'];
	$events_meta['link2'] = $_POST['link2'];
	$events_meta['link3'] = $_POST['link3'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpt_save_news_meta', 1, 2); // save the custom fields

//----------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------

function company_logos($atts) {
   extract(shortcode_atts(array(
		"id" => '10'
	), $atts));
	
   $output='<div class="company_logo hide_one_div">
   <div class="container">
     <div class="row">
		<ul>';
			 $args = array( 'post_type' => 'company_logos', 'order'   => 'ASC','posts_per_page'=>-1 );
			$loop = new WP_Query( $args );
			$count_pages =$loop->post_count;
			$i=0;
			while ( $loop->have_posts() ) : $loop->the_post();
			 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'company_thumb', false, '' );
			 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);

			 $output.= ' <li><a href="'.get_the_title().'"><img src="'.$src[0].'" alt="'.$alt.'" /></a></li>';

			endwhile;

		 $output.= '</ul>
     </div>
   </div>
  </div>
  
  <div class="company_logo hide_one_div1">
   <div class="container">
       <div class="col-md-12">
            <div id="myCarousel'.$id.'" class="carousel slide">
                
                <!-- Carousel items -->
                <div class="carousel-inner">
				   <div class="item active">
                       <div class="row">
							<ul>';

					 $args = array( 'post_type' => 'company_logos', 'order'   => 'ASC','posts_per_page'=>-1 );
					$loop = new WP_Query( $args );
					$count_pages =$loop->post_count;
					$i=0;
					while ( $loop->have_posts() ) : $loop->the_post();
					 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'company_thumb', false, '' );
					 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);

                    
							 $output.= ' <li><a href="'.get_the_title().'"><img src="'.$src[0].'" alt="'.$alt.'" /></a></li>';

					$i=$i+1;
					if($i%4==0&&$i!=0&&$i!=$count_pages)	
                      {				
						 $output.= '   </ul>
					</div> 
					</div> 
					<div class="item">
                       <div class="row">
							<ul>';

					}
					if($i==$count_pages)
					{
					 $output.= '  </ul>
					</div> 
				</div> ';
                       }
					endwhile;
				
              $output.= '</div>
<a class="left carousel-control" href="#myCarousel'.$id.'" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel'.$id.'" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
     </div>
     </div>
   </div>
  </div>  
  

  <script>
$(document).ready(function() {
	$("#myCarousel'.$id.'").carousel({
	interval: false;
	})
    
    $("#myCarousel'.$id.'").on("slid.bs.carousel", function() {
    	//alert("slid");
	});
    
    
});


</script>';
    return $output;
}
add_shortcode('company_logo', 'company_logos');

//------------------------------shortcode-----------------------------------

function social_icons_shortcode($attrs) {
    extract(shortcode_atts(array(
		"facebook" => 'http://facebook.com/',
		"linkedin" => 'http://linkedin.com/',
		"twitter" => 'https://twitter.com/',
		"mail"=> 'mailto:mail.google.com',
	), $attrs));
    $output='  <div class="social_icons">
				  <div class="container">
				   <div class="row template_social_link">
					<ul>';
	foreach($attrs as $attr=>$value)
	   {
		switch ($attr) {
        case 'facebook':
            $output.='<li><a href="'.$value.'" style="padding: 10px 17px; color: #3c5a99;border-color: #3c5a99;"><i class="fa fa-facebook"></i></a></li>';
            break;
        case 'linkedin':
            $output.= '<li><a href="'.$value.'" style="color: #007bb5;border-color: #007bb5;"><i class="fa fa-linkedin"></i></a></li>';
            break;
        case 'twitter':
            $output.= '<li><a href="'.$value.'" style="color: #28aae1;border-color: #28aae1;"><i class="fa fa-twitter"></i></a></li>';
            break;
        case 'mail':
            $output.= '<li><a href="'.$value.'" style="color: #2ca7e5;border-color: #2ca7e5;"><i class="fa fa-envelope"></i></a></li>';
            break;
        }
	   }
	$output.='	</ul>
				</div>
			   </div>
			   </div>';   
	   
            return $output;
}
add_shortcode('social_icons', 'social_icons_shortcode');

function social_link_footer_shortcode($attrs) {
    extract(shortcode_atts(array(
		"facebook" => 'http://facebook.com/',
		"linkedin" => 'http://linkedin.com/',
		"twitter" => 'https://twitter.com/',
		"mail"=> 'mailto:mail.google.com',
	), $attrs));
    $output='  <div class="social_link_footer">
		        <ul>';
	foreach($attrs as $attr=>$value)
	   {
		switch ($attr) {
        case 'facebook':
            $output.='<li><a href="'.$value.'" style="padding: 10px 17px;"><i class="fa fa-facebook"></i></a></li>';
            break;
        case 'linkedin':
            $output.= '<li><a href="'.$value.'"><i class="fa fa-linkedin"></i></a></li>';
            break;
        case 'twitter':
            $output.= '<li><a href="'.$value.'"><i class="fa fa-twitter"></i></a></li>';
            break;
        case 'mail':
            $output.= '<li><a href="'.$value.'"><i class="fa fa-envelope"></i></a></li>';
            break;
        }
	   }
	$output.='</ul>
		  </div>';   
	   
            return $output;
}
add_shortcode('follow_us', 'social_link_footer_shortcode');

add_filter('widget_text', 'do_shortcode');

//---------------------------------------------------------------------
function news_articles($atts) {
   extract(shortcode_atts(array(
		"id" => '10'
	), $atts));
	
   $output='<div class="row">
	  <div class="related_articles_post">';
                    $args = array( 'post_type' => 'news', 'order'   => 'ASC','posts_per_page'=>3 );
					$loop = new WP_Query( $args );
					$count_pages =$loop->post_count;
					$i=0;
					while ( $loop->have_posts() ) : $loop->the_post();
					 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'news_thumb', false, '' );
					 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);
                      $output.= '<div class="col-sm-4 related_articles_post_part">
						<img src="'.$src[0].'"  alt="'.$alt.'"/>
						<a href="'.get_permalink ().'"><h3>'. get_the_title().'</h3></a>
					   </div>';
									
					endwhile;
				
              $output.= '</div>
	         </div>';
    return $output;
}
add_shortcode('news_articles', 'news_articles');

// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');

function news_tag($atts) {
   extract(shortcode_atts(array(
		"postid" => '10'
	), $atts));
$t = wp_get_post_tags($postid);
$output='<div class="tag_here"><span class="active_location">Tags:</span> <span class="tags">';
$numItems = count($t);
$i = 0;
foreach($t as $tt)
{
if(++$i === $numItems) {
$output.=$tt->name;
}
else{
 $output.=$tt->name.", ";
}
}
$output.='</span></div>';
return $output;
}

add_shortcode('news_tag', 'news_tag');

//----------------------------------------------
//----------register and label Academics post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Academics', 'post type general name'),
    'singular_name' => _x('Academic', 'post type singular name'),
    'add_new' => _x('Add New', 'Academics'),
    'add_new_item' => __("Add New Academic"),
    'edit_item' => __("Edit Academic"),
    'new_item' => __("New Academic"),
    'view_item' => __("View Academic"),
    'search_items' => __("Search Academics"),
    'not_found' =>  __('No Academics found'),
    'not_found_in_trash' => __('No Academics found in Trash'), 
	'featured_image'        => __( 'Academic image', 'Academics' ),
	'set_featured_image'    => __( 'Set Academic image', 'Academics'),
	'remove_featured_image' => __( 'Remove Academic image', 'Academics' ),
	'use_featured_image'    => __( 'Use Academic image', 'Academics' ),
        
);
$Academics_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor','excerpt' ),
    'menu_icon' => 'dashicons-book-alt' //16x16 png if you want an icon
); 
register_post_type('academics', $Academics_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_academicstype_taxonomies', 0);
 
function jss_create_academicstype_taxonomies(){
    register_taxonomy(
        'academicstype', 'academics', 
        array(
            'hierarchical'=> true, 
            'label' => 'Academics Types',
            'singular_label' => 'Academics Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-academics_columns', 'jss_add_new_academics_columns');
 
function jss_add_new_academics_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb6'    =>        'Thumbnail',		
        'title'                =>        'Academics Title',
		'description6'    =>        'Description',
        'academicstype'            =>        'Academics Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns6');
function jss_custom_columns6( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb6' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description6' : the_excerpt(); break;
        case 'academicstype' : echo get_the_term_list( $post->ID, 'academicstype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------

//----------------------------------------------
//----------register and label Careers post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Careers', 'post type general name'),
    'singular_name' => _x('Career', 'post type singular name'),
    'add_new' => _x('Add New', 'Careers'),
    'add_new_item' => __("Add New Career"),
    'edit_item' => __("Edit Career"),
    'new_item' => __("New Career"),
    'view_item' => __("View Career"),
    'search_items' => __("Search Careers"),
    'not_found' =>  __('No Careers found'),
    'not_found_in_trash' => __('No Careers found in Trash'), 
	'featured_image'        => __( 'Career image', 'Careers' ),
	'set_featured_image'    => __( 'Set Career image', 'Careers'),
	'remove_featured_image' => __( 'Remove Career image', 'Careers' ),
	'use_featured_image'    => __( 'Use Career image', 'Careers' ),
        
);
$Careers_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor','excerpt' ),
    'menu_icon' => 'dashicons-businessman' //16x16 png if you want an icon
); 
register_post_type('careers', $Careers_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_careerstype_taxonomies', 0);
 
function jss_create_careerstype_taxonomies(){
    register_taxonomy(
        'careerstype', 'careers', 
        array(
            'hierarchical'=> true, 
            'label' => 'Careers Types',
            'singular_label' => 'Careers Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-careers_columns', 'jss_add_new_careers_columns');
 
function jss_add_new_careers_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb7'    =>        'Thumbnail',		
        'title'                =>        'Careers Title',
		'description7'    =>        'Description',
        'careerstype'            =>        'Careers Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns7');
function jss_custom_columns7( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb7' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description7' : the_excerpt(); break;
        case 'careerstype' : echo get_the_term_list( $post->ID, 'careerstype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------
//----------------------------------------------
//----------register and label Miscellaneous post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Miscellaneous', 'post type general name'),
    'singular_name' => _x('Miscellaneous', 'post type singular name'),
    'add_new' => _x('Add New', 'Miscellaneous'),
    'add_new_item' => __("Add New Miscellaneous"),
    'edit_item' => __("Edit Miscellaneous"),
    'new_item' => __("New Miscellaneous"),
    'view_item' => __("View Miscellaneous"),
    'search_items' => __("Search Miscellaneous"),
    'not_found' =>  __('No Miscellaneous found'),
    'not_found_in_trash' => __('No Miscellaneous found in Trash'), 
	'featured_image'        => __( 'Miscellaneous image', 'Miscellaneous' ),
	'set_featured_image'    => __( 'Set Miscellaneous image', 'Miscellaneous'),
	'remove_featured_image' => __( 'Remove Miscellaneous image', 'Miscellaneous' ),
	'use_featured_image'    => __( 'Use Miscellaneous image', 'Miscellaneous' ),
        
);
$Miscellaneous_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor','excerpt' ),
    'menu_icon' => 'dashicons-list-view' //16x16 png if you want an icon
); 
register_post_type('miscellaneous', $Miscellaneous_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_miscellaneoustype_taxonomies', 0);
 
function jss_create_miscellaneoustype_taxonomies(){
    register_taxonomy(
        'miscellaneoustype', 'miscellaneous', 
        array(
            'hierarchical'=> true, 
            'label' => 'Miscellaneous Types',
            'singular_label' => 'Miscellaneous Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-miscellaneous_columns', 'jss_add_new_miscellaneous_columns');
 
function jss_add_new_miscellaneous_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb8'    =>        'Thumbnail',		
        'title'                =>        'Miscellaneous Title',
		'description8'    =>        'Description',
        'miscellaneoustype'            =>        'Miscellaneous Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns8');
function jss_custom_columns8( $column ){
    global $post;
    
    switch ($column) {
        case 'jss_post_thumb8' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description8' : the_excerpt(); break;
        case 'miscellaneoustype' : echo get_the_term_list( $post->ID, 'miscellaneoustype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------
//----------------------------------------------
//----------register and label Blog post type
//----------------------------------------------
$gallery_labels = array(
    'name' => _x('Blogs', 'post type general name'),
    'singular_name' => _x('Blog', 'post type singular name'),
    'add_new' => _x('Add New', 'Blogs'),
    'add_new_item' => __("Add New Blog"),
    'edit_item' => __("Edit Blog"),
    'new_item' => __("New Blog"),
    'view_item' => __("View Blog"),
    'search_items' => __("Search Blogs"),
    'not_found' =>  __('No Blogs found'),
    'not_found_in_trash' => __('No Blogs found in Trash'), 
	'featured_image'        => __( 'Blog image', 'Blogs' ),
	'set_featured_image'    => __( 'Set Blog image', 'Blogs'),
	'remove_featured_image' => __( 'Remove Blog image', 'Blogs' ),
	'use_featured_image'    => __( 'Use Blog image', 'Blogs' ),
        
);
$Blogs_args = array(
    'labels' => $gallery_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'capability_type' => 'post',
    'supports' => array('title',  'thumbnail','editor','excerpt' ),
    'menu_icon' => 'dashicons-desktop' //16x16 png if you want an icon
); 
register_post_type('blogs', $Blogs_args);

//----------------------------------------------
//------------------------create custom taxonomy
//----------------------------------------------
add_action( 'init', 'jss_create_blogstype_taxonomies', 0);
 
function jss_create_blogstype_taxonomies(){
    register_taxonomy(
        'blogstype', 'blogs', 
        array(
            'hierarchical'=> true, 
            'label' => 'Blogs Types',
            'singular_label' => 'Blog Type',
            'rewrite' => true
        )
    );    
}

add_filter('manage_edit-blogs_columns', 'jss_add_new_blogs_columns');
 
function jss_add_new_blogs_columns( $columns ){
    $columns = array(
        'cb'                =>        '<input type="checkbox">',
		'jss_post_thumb9'    =>        'Thumbnail',		
        'title'                =>        'Blogs Title',
		'description9'    =>        'Description',
        'miscellaneoustype'            =>        'Blogs Type',
        'author'            =>        'Author',
        'date'                =>        'Date'
        
    );
    return $columns;
}
add_action('manage_posts_custom_column', 'jss_custom_columns8');
function jss_custom_columns9( $column ){
    global $post;    
    switch ($column) {
        case 'jss_post_thumb9' : echo the_post_thumbnail('admin-list-thumb'); break;
        case 'description9' : the_excerpt(); break;
        case 'blogstype' : echo get_the_term_list( $post->ID, 'blogstype', '', ', ',''); break;
    }
}
//---------------------------------------------------------
//---------------------------------------------------------

//---------------------------------------------------------------------
function multitab_accord($atts) {
   extract(shortcode_atts(array(
		"tab1" => 'academics',
		"tab2" => 'careers',
		"tab3" => 'miscellaneous',
		"id"=> '10',
		"items"=> '3'
	), $atts));
	
   $output='  <div class="container">
     <div class="row">
		<div class="advance_tab">
          <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist" id="pills-first'.$id.'">';
		   for($j=1;$j<=$items;$j++)
		   {
		     $u='tab'.$j;
			 $u1=$$u;
			$output.='<li role="presentation"';  
			if($j==1){
			$output.=' class="active"';
			}
			$output.='><a href="#'.$u1.''.$id.'" aria-controls="'.$u1.''.$id.'" role="tab" data-toggle="tab">'.$u1.'</a></li>';
		   }				
	 $output.='<li class="minimise" role="presentation" style="float: right;cursor: pointer;"><a href="" aria-controls="minimise'.$id.'" role="tab" style="padding: 0px 15px; font-size: 2.3em;pointer-events: none; cursor: default;">-</a></li>
		  </ul>
          <!-- Tab panes -->
		  <div class="tab-content">';
		    for($j=1;$j<=$items;$j++)
		   {
		     $u='tab'.$j;
			 $u1=$$u;
			$output.='<div role="tabpanel" class="tab-pane';  
			if($j==1){
			$output.=' active';
			}
			 $output.='" id="'.$u1.''.$id.'">';
			 
			  $args = array( 'post_type' => $u1, 'order'   => 'ASC', 'posts_per_page'=>-1 );
					$loop = new WP_Query( $args );
					$count_pages =$loop->post_count;
					$t=1;
					while ( $loop->have_posts() ) : $loop->the_post();
					if($t%3==1){$output.= '<div class="row">'; }
					 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'full', false, '' );
					 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);
                      $output.= '<div class="col-sm-4">
			    <div class="advance_tab_part">
				  <div class="advance_tab_upper">
			      <h3>'. get_the_title().'</h3>
				  <p>'.get_the_excerpt().'</p>
				  </div>
				  <div class="find_out_more"><a href="'.get_permalink ().'">FIND OUT MORE</a></div>
			    </div>
			   </div>';
									
					$t=$t+1;
			 if($t%3==1 && $t!=1){$output.= '</div>'; }
            endwhile; 
            if($t%3!=1 && $t!=1){$output.= '</div>'; }
			 
			 
			$output.='</div>';
		   }
			$output.='</div>
		  </div>
    </div>
  </div>
  <script>
   $("#pills-first'.$id.' a").click(function (e) {
  e.preventDefault();
  $(this).tab("show");
})



  </script>';
    return $output;
}
add_shortcode('multitab', 'multitab_accord');
?>
