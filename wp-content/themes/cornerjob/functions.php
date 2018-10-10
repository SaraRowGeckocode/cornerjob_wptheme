<?php
require_once 'includes/theme_customizer.php';
include_once 'includes/metaboxes.php';
include_once 'includes/gc-customize-jetpack.php';

/*------------------------------------*\
	Theme Support
\*------------------------------------*/
if (function_exists('add_theme_support')){
    // Add Menu Support
    add_theme_support('menus');

    // html5
    add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('grid-thumb',    370,180,true);
    add_image_size('grid-thumb-2x', 740,360,true);
    add_image_size('featured-thumb', 635,610,true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('cornerjob', get_template_directory() . '/languages');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to provide it for us.
     */
    add_theme_support( 'title-tag' );
}



/*------------------------------------*\
    Custom Taxonomies
\*------------------------------------*/
function GC_custom_taxonomies() {
    // Featured
    $labels = array(
        'name'              => _x( 'Posts groups', 'Taxonomy General Name', 'cornerjob' ),
        'singular_name'     => _x( 'Posts group', 'Taxonomy Singular Name', 'cornerjob' ),
        'new_item_name'     => __( 'New posts group', 'cornerjob' ),
        'add_new_item'      => __( 'Add posts group', 'cornerjob' )
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_nav_menus' => true,
        'publicly_queryable'=> true,
        'show_admin_column' => true,
        'show_tagcloud'     => false,
        'show_in_quick_edit'=> true,
        'rewrite'           => array('slug' => 'posts')
    );
    register_taxonomy( 'featured-posts', array( 'post' ), $args );

}
add_action('init', 'GC_custom_taxonomies', 0);

function GC_unregister_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'GC_unregister_tags' );


/*------------------------------------*\
	Functions
\*------------------------------------*/

// Load scripts (header.php)
function GC_header_scripts(){
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        $template = get_template_directory_uri();

        wp_register_script('modernizr', $template .'/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1',true);
        wp_enqueue_script('modernizr');


        if(is_page_template('tpl-landing-ebook.php')){
            wp_enqueue_script('landing-ebook-js', $template .'/js/landing-ebook.js', array('jquery', 'nf-front-end'), '1.0.1', true);
        } else {
            wp_register_script('materialize', $template .'/js/lib/materialize.min.js', array('jquery'), '0.97.7', true);
            wp_register_script('slick', $template .'/js/lib/slick/slick.min.js', array('jquery'), '1.5.7', true);

            wp_register_script('cornerjob', $template .'/js/scripts.min.js', array('jquery','materialize','slick'), '1.1.0', true); // Custom scripts
            wp_enqueue_script('cornerjob');
        }
    }
}


// Load styles
function GC_styles() {
    $template = get_template_directory_uri();

    wp_register_style('cornerjob-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,600|Open+Sans:300,300i,400,600,700', array(), '1.0', 'all');
    //wp_register_style('material-icons',         '//fonts.googleapis.com/icon?family=Material+Icons', array(), '1.0', 'all');
    wp_register_style('materialize',            $template .'/css/materialize.css', array(), '1.0.0', 'all');
    wp_register_style('slick',                  $template .'/js/lib/slick/slick.css', array(), '1.5.7', 'all');
    //wp_register_style('cornerjob-icons',        $template .'/fonts/cornerjob-icons/style.css', array(), '1.0', 'all');

    wp_register_style('cornerjob', $template .'/style.css', 
        array(
            'cornerjob-google-fonts',
            //'material-icons',
            'materialize',
            'slick',
            //'cornerjob-icons'
        ), '1.2.3', 'all');

    wp_enqueue_style('cornerjob');

    if(is_page_template('tpl-landing-ebook.php')){
        wp_enqueue_style('cornerjob-google-fonts2', '//fonts.googleapis.com/css?family=Oswald:500', array(), '1.0', 'all');
        wp_enqueue_style('landing-ebook', $template .'/css/landing-ebook.css', array(), '1.0.2', 'all');
    }
}

function GC_defer_scripts($tag, $handle) {
    // add script handles to the array below
    $scripts_to_defer = array(
        'modernizr',
        'materialize', 
        'slick',
        'cornerjob'
    );

    foreach($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}
add_filter('script_loader_tag', 'GC_defer_scripts', 10, 2);

// Register Navigation
function GC_register_menus(){
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'cornerjob'),
        //'legal-menu' => __('Legal Menu', 'cornerjob')
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var){
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove wp_head() injected Recent Comment styles
function GC_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Custom Excerpts
function GC_excerpt_loop($length) {
    return 15;
}

// Create the Custom Excerpts callback
function GC_excerpt($length_callback = 'GC_excerpt_loop', $more_callback = ''){
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function GC_view_article($more){
    //global $post;
    //return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'cornerjob') . '</a>';
    return '...';
}

// Content imagen format
function GC_html5_content_image($html, $id, $caption, $title, $align, $url, $size, $alt) {
    $html = sprintf( '<figure class="fig-'.$align.'">%s</figure>', $html );
    return $html;
}

// Remove 'text/css' from our enqueued stylesheet
function GC_style_type_remove($tag){
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ){
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Categories images
function GC_category_image($id, $size = 'full'){
    if (function_exists('z_taxonomy_image_url')) 
        return z_taxonomy_image_url($id, $size);
}

// share buttons
function GC_addtoany_sharebuttons($share_title = false, $page_title = false, $url = false){
    if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { 
        $custom_atts = array(); 
        if($page_title) $custom_atts['linkname'] = $page_title;
        if($url) $custom_atts['linkurl'] = $url;
        ?>
        <div class="share-btns">
            <?php 
            if($title) echo '<strong>'.$title.'</strong>';
            ADDTOANY_SHARE_SAVE_KIT($custom_atts); ?>
        </div>
    <?php }
}



// post views
function GC_set_post_views($postID) {
    $count_key = 'GC_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if(! $count || $count === 0){
        $count = 1;
        add_post_meta($postID, $count_key, $count, true);
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count;
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function GC_track_post_views($post_id) {
    if ( !is_single() || is_user_logged_in()) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    GC_set_post_views($post_id);
}
add_action( 'wp_head', 'GC_track_post_views');


/* ==================
    Custom Admin Columns
   ================= */
add_filter( 'manage_post_posts_columns',            'RT_posts_admincolumns_head' );
add_action( 'manage_post_posts_custom_column',      'RT_admincolumns_content', 10, 2 );

function RT_posts_admincolumns_head($columns) {
    // Put the Thumbnail column before the Title column
    $columns['views'] = __('Post views','cornerjob');
    return $columns;
}
function RT_admincolumns_content( $column, $post_id ) {
    switch ( $column ) {
        case 'views':
            echo get_post_meta($post_id, 'GC_post_views_count', true);
            break;
    }
}


/* ==================
    Favicon
   ================= */
function favicon(){
    $template = get_template_directory_uri(); ?>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $template; ?>/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $template; ?>/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $template; ?>/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $template; ?>/images/favicon/manifest.json">
    <link rel="mask-icon" href="<?php echo $template; ?>/images/favicon/safari-pinned-tab.svg" color="#0097c4">
    <meta name="theme-color" content="#0097c4">
    <!-- / favicon -->
<?php }






/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts','GC_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts','GC_styles'); // Add Theme Stylesheet
add_action('init',              'GC_register_menus'); // Add Menu Hooks
add_action('widgets_init',      'GC_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Remove Actions
remove_action('wp_head',        'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head',        'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head',        'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head',        'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head',        'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head',        'rel_canonical');

// Add Filters
add_filter('body_class',        'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text',       'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text',       'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args',  'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category',      'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt',       'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt',       'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more',      'GC_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag',  'GC_style_type_remove'); // Remove 'text/css' from enqueued stylesheet
//add_filter('post_thumbnail_html','remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor','GC_html5_content_image', 10, 9 );

// Remove Filters
remove_filter('the_excerpt',    'wpautop'); // Remove <p> tags from Excerpt altogether



?>
