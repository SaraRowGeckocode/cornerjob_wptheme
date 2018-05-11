<?php
/*------------------------------------*\
        GC CUSTOM JETPACK FUNTIONS
\*------------------------------------*/


/*------------------------------------*\
    Removing widgets
\*------------------------------------*/

function GC_jetpack_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action('loop_start', 'GC_jetpack_remove_share' );


/*------------------------------------*\
    Custom integration
\*------------------------------------*/

/* infinite scroll */
add_theme_support( 'infinite-scroll', array(
    'container'     => 'posts-list',
    'type'          => 'click',
    'footer'        => false,
    'wrapper'       => false,
    'render'        => 'GC_jetpack_custom_infinite_scroll_render'
) );
function GC_jetpack_custom_infinite_scroll_render() {
    get_template_part('template-parts/content');
}
function GC_jetpack_custom_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = __( 'Load more', 'cornerjob' );
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'GC_jetpack_custom_infinite_scroll_js_settings' );

?>