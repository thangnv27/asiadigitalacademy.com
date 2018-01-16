<?php
/**
 * Custom photo post type
 */

add_action('init', 'create_photo_post_type');

function create_photo_post_type(){
    register_post_type('photo', array(
        'labels' => array(
            'name' => __('Photos', SHORT_NAME),
            'singular_name' => __('Photos', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Photo', SHORT_NAME),
            'new_item' => __('New Photo', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Photo', SHORT_NAME),
            'view' => __('View Photo', SHORT_NAME),
            'view_item' => __('View Photo', SHORT_NAME),
            'search_items' => __('Search Photos', SHORT_NAME),
            'not_found' => __('No Photo found', SHORT_NAME),
            'not_found_in_trash' => __('No Photo found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'thumbnail',
            //'custom-fields', 'comments', 'editor', 'excerpt', 'author', 
        ),
        'rewrite' => array('slug' => 'photo', 'with_front' => false),
        'can_export' => true,
        'description' => __('Photo description here.', SHORT_NAME)
    ));
}

# Custom photo taxonomies
/*add_action('init', 'create_photo_taxonomies');

function create_photo_taxonomies(){
    register_taxonomy('photo_category', 'photo', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Photo Categories'),
            'singular_name' => __('Photo Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}*/