<?php

/**
 * Courses Menu Page
 */

# Custom courses post type
add_action('init', 'create_courses_post_type');

function create_courses_post_type(){
    register_post_type('courses', array(
        'labels' => array(
            'name' => __('Courses', SHORT_NAME),
            'singular_name' => __('Courses', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Course', SHORT_NAME),
            'new_item' => __('New Course', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Course', SHORT_NAME),
            'view' => __('View Course', SHORT_NAME),
            'view_item' => __('View Course', SHORT_NAME),
            'search_items' => __('Search Courses', SHORT_NAME),
            'not_found' => __('No Course found', SHORT_NAME),
            'not_found_in_trash' => __('No Course found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 7,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'excerpt', 'thumbnail',
//            'custom-fields', 'comments', 'editor', 'author', 
        ),
        'rewrite' => array('slug' => 'courses', 'with_front' => false),
        'can_export' => true,
        'description' => __('Course description here.', SHORT_NAME)
    ));
}

# Custom courses taxonomies
/*add_action('init', 'create_courses_taxonomies');

function create_courses_taxonomies(){
    register_taxonomy('courses_category', 'courses', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Course Categories', SHORT_NAME),
            'singular_name' => __('Course Categories', SHORT_NAME),
            'add_new' => __('Add New', SHORT_NAME),
            'add_new_item' => __('Add New Category', SHORT_NAME),
            'new_item' => __('New Category', SHORT_NAME),
            'search_items' => __('Search Categories', SHORT_NAME),
        ),
    ));
}
*/