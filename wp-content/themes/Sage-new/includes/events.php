<?php

/**
 * Events Menu Page
 */

# Custom events post type
add_action('init', 'create_events_post_type');

function create_events_post_type(){
    register_post_type('events', array(
        'labels' => array(
            'name' => __('Events'),
            'singular_name' => __('Events'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Event'),
            'new_item' => __('New Event'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Event'),
            'view' => __('View Event'),
            'view_item' => __('View Event'),
            'search_items' => __('Search Events'),
            'not_found' => __('No Event found'),
            'not_found_in_trash' => __('No Event found in trash'),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 8,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'author', 'excerpt', 'thumbnail',
//            'custom-fields','comments', 
        ),
        'rewrite' => array('slug' => 'events', 'with_front' => false),
        'can_export' => true,
        'description' => __('Event description here.')
    ));
}

# Custom events taxonomies
/*add_action('init', 'create_events_taxonomies');

function create_events_taxonomies(){
    register_taxonomy('events_category', 'events', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Event Categories'),
            'singular_name' => __('Event Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}*/

# events meta box
$events_meta_box = array(
    'id' => 'events-meta-box',
    'title' => 'Thông tin chung',
    'page' => 'events',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Banner <em>(620x250)</em>',
            'desc' => '',
            'id' => 'post_banner',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Thời gian',
            'desc' => '',
            'id' => 'thoi_gian',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Địa điểm',
            'desc' => '',
            'id' => 'dia_diem',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Thời lượng',
            'desc' => '',
            'id' => 'thoi_luong',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Phí tham gia',
            'desc' => '',
            'id' => 'phi_tham_gia',
            'type' => 'text',
            'std' => '',
        ),
));

// Add events meta box
add_action('admin_menu', 'events_add_box');
add_action('save_post', 'events_add_box');

function events_add_box(){
    global $events_meta_box;
    add_meta_box($events_meta_box['id'], $events_meta_box['title'], 'events_show_box', $events_meta_box['page'], $events_meta_box['context'], $events_meta_box['priority']);
}

// Callback function to show fields in events meta box
function events_show_box() {
    // Use nonce for verification
    global $events_meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="events_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table width="100%">';
    foreach ($events_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
        '<th style="text-align: left;"><label for="', $field['id'], '">', $field['name'], '</label></th>',
        '<td>';
        switch ($field['type']) {
            case 'text':
                if($field['id'] == 'post_banner'){
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', htmlspecialchars($meta) ? htmlspecialchars($meta) : htmlspecialchars($field['std']), '" size="30" style="width:90%" />';
                    echo '<input type="button" id="upload_post_banner_button" class="button button-upload" value="Upload" />', '<br />', $field['desc'];
                }else{
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', htmlspecialchars($meta) ? htmlspecialchars($meta) : htmlspecialchars($field['std']), '" size="30" style="width:90%" />', '<br />', $field['desc'];
                }
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option value="', $option , '" ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $key => $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $key, '"', $meta == $key ? ' checked="checked"' : '', ' /> ', $option , ' ';
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo '<td>',
        '</tr>';
    }

    echo '</table>';
}

add_action('save_post', 'events_save_data');

// Save data from events meta box
function events_save_data($post_id) {
    global $events_meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['events_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    foreach ($events_meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
