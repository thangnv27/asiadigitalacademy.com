<?php
/**
 * Custom client post type
 */

add_action('init', 'create_client_post_type');

function create_client_post_type(){
    register_post_type('client', array(
        'labels' => array(
            'name' => __('Clients', SHORT_NAME),
            'singular_name' => __('Clients', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Client', SHORT_NAME),
            'new_item' => __('New Client', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Client', SHORT_NAME),
            'view' => __('View Client', SHORT_NAME),
            'view_item' => __('View Client', SHORT_NAME),
            'search_items' => __('Search Clients', SHORT_NAME),
            'not_found' => __('No Client found', SHORT_NAME),
            'not_found_in_trash' => __('No Client found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'thumbnail','editor', 
            //'custom-fields', 'comments', 'excerpt', 'author', 
        ),
        'rewrite' => array('slug' => 'client', 'with_front' => false),
        'can_export' => true,
        'description' => __('Client description here.', SHORT_NAME)
    ));
}

# Custom client taxonomies
add_action('init', 'create_client_taxonomies');

function create_client_taxonomies(){
    register_taxonomy('client_category', 'client', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Client Categories'),
            'singular_name' => __('Client Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
        'rewrite' => array('slug' => 'client_category', 'with_front' => false),
    ));
}