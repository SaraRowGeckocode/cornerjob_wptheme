<?php

function GC_wpcustomizer_logo() {
    $defaults = array(
        'height'      => 80,
        'width'       => 440,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );

}
add_action( 'after_setup_theme', 'GC_wpcustomizer_logo' );



/* ++++++++++++++++++++++++++++++++++
                KIRKI 
+++++++++++++++++++++++++++++++++++ */

require_once 'cornerjob-kirki.php';


function GC_theme_customizer_options() {
    $prefix = 'GC_';
    if(function_exists('pll_languages_list')) $langs = pll_languages_list();
    
    CornerJob_Kirki::add_config( 'CJ', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
    ) );


    /* home */
    CornerJob_Kirki::add_section( $prefix.'home', array(
        'title'          => __( 'Home','cornerjob' ),
        'priority'       => 102,
        'capability'     => 'edit_theme_options',
    ) );
    if($langs) {
        foreach ($langs as $lang) {
            $options = array(0 => __('Select','cornerjob'));
            $terms = get_terms('featured-posts', array('hide_empty'=>0, 'lang' => $lang));
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                foreach ( $terms as $term ) {
                    $options[$term->term_id] = $term->name;
                }
            }
            CornerJob_Kirki::add_field( 'CJ', array(
                'settings' => $prefix.'slider-term_'.$lang,
                'label'    => __( 'Select posts group to display in Home Slider', 'cornerjob' ).' ('.$lang.')',
                'section'  => $prefix.'home',
                'type'     => 'select',
                'priority' => 10,
                'default'  => '',
                'multiple' => 0,
                'choices'  => $options
            ) );
        }
    }



    /* footer */
    CornerJob_Kirki::add_section( $prefix.'footer', array(
        'title'          => __( 'Footer','cornerjob' ),
        'priority'       => 102,
        'capability'     => 'edit_theme_options',
    ) );
    CornerJob_Kirki::add_field( 'CJ', array(
    	'settings' => $prefix.'footer-txt_en', // field ID
    	'label'    => __( 'Footer text', 'cornerjob' ).' EN',
    	'section'  => $prefix.'footer',
    	'type'     => 'textarea',
    	'priority' => 10,
    	'default'  => '',
    ) );
    CornerJob_Kirki::add_field( 'CJ', array(
        'settings' => $prefix.'footer-txt_es', // field ID
        'label'    => __( 'Footer text', 'cornerjob' ).' ES',
        'section'  => $prefix.'footer',
        'type'     => 'textarea',
        'priority' => 10,
        'default'  => '',
    ) );
    CornerJob_Kirki::add_field( 'CJ', array(
        'settings' => $prefix.'footer-txt_fr', // field ID
        'label'    => __( 'Footer text', 'cornerjob' ).' FR',
        'section'  => $prefix.'footer',
        'type'     => 'textarea',
        'priority' => 10,
        'default'  => '',
    ) );
    CornerJob_Kirki::add_field( 'CJ', array(
        'settings' => $prefix.'footer-txt_it', // field ID
        'label'    => __( 'Footer text', 'cornerjob' ).' IT',
        'section'  => $prefix.'footer',
        'type'     => 'textarea',
        'priority' => 10,
        'default'  => '',
    ) );
    CornerJob_Kirki::add_field( 'CJ', array(
        'settings' => $prefix.'footer-txt_mx', // field ID
        'label'    => __( 'Footer text', 'cornerjob' ).' MX',
        'section'  => $prefix.'footer',
        'type'     => 'textarea',
        'priority' => 10,
        'default'  => '',
    ) );
}
add_action( 'init', 'GC_theme_customizer_options', 50 );
?>