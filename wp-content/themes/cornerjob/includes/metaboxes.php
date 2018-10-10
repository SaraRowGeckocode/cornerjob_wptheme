<?php

add_filter( 'rwmb_meta_boxes', 'GC_meta_boxes' );
function GC_meta_boxes( $meta_boxes ) {
    $prefix = 'GC_';

    
    // posts
    $meta_boxes[] = array(
        'id'         => 'author-info',
        'title'      => __('Author information','cornerjob'),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id'        => $prefix . 'name',
                'name'      => __('Name','cornerjob'),
                'type'      => 'text',
                'size'      => 60
            ),
            array(
                'id'        => $prefix . 'position',
                'name'      => __('Position','cornerjob'),
                'type'      => 'text',
                'size'      => 60
            ),
            array(
                'id'        => $prefix . 'twitter',
                'name'      => __('Twitter name','cornerjob'),
                'type'      => 'text',
                'size'      => 60,
                'std'       => '@'
            ),
            array(
                'name'      => __('Picture','cornerjob'),
                'id'        => $prefix . 'image',
                'type'      => 'image_advanced',
                'max_file_uploads' => 1,
                'image_size'=> 'thumbnail'
            )
        )
    );
    $meta_boxes[] = array(
        'id'         => 'banner',
        'title'      => __('Banner','cornerjob'),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'      => __('Image','cornerjob'),
                'id'        => $prefix . 'banner-image',
                'type'      => 'image_advanced',
                'max_file_uploads' => 1
            ),
            array(
                'id'        => $prefix . 'banner-title',
                'name'      => __('Link title','cornerjob'),
                'type'      => 'text',
                'size'      => 60
            ),
            array(
                'id'        => $prefix . 'banner-url',
                'name'      => __('Link URL','cornerjob'),
                'type'      => 'text',
                'size'      => 60
            )
        )
    );


    // TPL landing ebook
    $meta_boxes[] = array(
        'id'         => 'form',
        'title'      => __('Form Column','cornerjob'),
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'form-column',
                'name' => __( 'Form Column', 'elmacare' ),
                'type' => 'wysiwyg'
            ),
        ),
        'only_on' => array(
            'template' => array( 'tpl-landing-ebook.php')
        )
    );


    // TPL unsubscribe
    $meta_boxes[] = array(
        'id'         => 'unsubscribe-fields',
        'title'      => __('Unsubscription Settings','cornerjob'),
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id' => $prefix . 'emails',
                'name' => __( 'Administrator Emails', 'elmacare' ),
                'type' => 'email',
                'clone'       => true,
                'placeholder' => 'name@domain.com',
            ),
        ),
        'only_on' => array(
            'template' => array( 'tpl-unsubscribe.php')
        )
    );
    



    foreach ( $meta_boxes as $k => $meta_box ){
        if ( isset( $meta_box['only_on'] ) && ! rw_maybe_include( $meta_box['only_on'] ) ){
            unset( $meta_boxes[$k] );
        }
    }

    return $meta_boxes;
}

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions )
{
    // Always include in the frontend to make helper function work
    if ( ! is_admin() ) return true;
    // Always include for ajax
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return true;

    if ( isset( $_GET['post'] ) ){
        $post_id = intval( $_GET['post'] );
    } elseif ( isset( $_POST['post_ID'] ) ){
        $post_id = intval( $_POST['post_ID'] );
    } else {
        $post_id = false;
    }
    $post_id = (int) $post_id;
    $post    = get_post( $post_id );
    foreach ( $conditions as $cond => $v ) {
        // Catch non-arrays too
        if ( ! is_array( $v ) ) {
            $v = array( $v );
        }
        switch ( $cond ) {

            case 'template':
                $template = get_post_meta( $post_id, '_wp_page_template', true );
                if ( in_array( $template, $v ) ) return true;
                break;

        }
    }
    // If no condition matched
    return false;
}
?>