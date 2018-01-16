<?php

/**
 * Trainers Menu Page
 */

# Custom trainer post type
add_action('init', 'create_trainer_post_type');

function create_trainer_post_type(){
    register_post_type('trainer', array(
        'labels' => array(
            'name' => __('Trainers', SHORT_NAME),
            'singular_name' => __('Trainers', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Trainer', SHORT_NAME),
            'new_item' => __('New Trainer', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Trainer', SHORT_NAME),
            'view' => __('View Trainer', SHORT_NAME),
            'view_item' => __('View Trainer', SHORT_NAME),
            'search_items' => __('Search Trainers', SHORT_NAME),
            'not_found' => __('No Trainer found', SHORT_NAME),
            'not_found_in_trash' => __('No Trainer found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 9,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'comments', 'author', 'excerpt', 'thumbnail',
//            'custom-fields'
        ),
        'rewrite' => array('slug' => 'trainer', 'with_front' => false),
        'can_export' => true,
        'description' => __('Trainer description here.', SHORT_NAME)
    ));
}

# Custom trainer taxonomies
/*add_action('init', 'create_trainer_taxonomies');

function create_trainer_taxonomies(){
    register_taxonomy('trainer_category', 'trainer', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Trainer Categories'),
            'singular_name' => __('Trainer Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}*/

# trainer meta box
$trainer_meta_box = array(
    'id' => 'trainer-meta-box',
    'title' => 'Thông tin huấn luyện viên',
    'page' => 'trainer',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Chức vụ',
            'desc' => '',
            'id' => 'chuc_vu',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Giới tính',
            'desc' => '',
            'id' => 'gioi_tinh',
            'type' => 'radio',
            'std' => '',
            'options' => array(
                '1' => 'Nam',
                '0' => 'Nữ'
            )
        ),
        array(
            'name' => 'Sắp xếp (Integer)',
            'desc' => '',
            'id' => 'trainer_order',
            'type' => 'text',
            'std' => '1',
        ),
));

// Add trainer meta box
add_action('admin_menu', 'trainer_add_box');
add_action('save_post', 'trainer_add_box');

function trainer_add_box(){
    global $trainer_meta_box;
    add_meta_box($trainer_meta_box['id'], $trainer_meta_box['title'], 'trainer_show_box', $trainer_meta_box['page'], $trainer_meta_box['context'], $trainer_meta_box['priority']);
}

// Callback function to show fields in trainer meta box
function trainer_show_box() {
    // Use nonce for verification
    global $trainer_meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="trainer_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table width="100%">';
    foreach ($trainer_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
        '<th style="text-align: left;"><label for="', $field['id'], '">', $field['name'], '</label></th>',
        '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', htmlspecialchars($meta) ? htmlspecialchars($meta) : htmlspecialchars($field['std']), '" size="30" style="width:97%" />', '<br />', $field['desc'];
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

add_action('save_post', 'trainer_save_data');

// Save data from trainer meta box
function trainer_save_data($post_id) {
    global $trainer_meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['trainer_meta_box_nonce'], basename(__FILE__))) {
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
    foreach ($trainer_meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

// ADD NEW COLUMN  
function trainer_columns_head($defaults) {
    $defaults['trainer_order'] = 'Order';
    return $defaults;
}

// SHOW THE COLUMN
function trainer_columns_content($column_name, $post_id) {
    if ($column_name == 'trainer_order') {
        $trainer_order = get_post_meta( $post_id, 'trainer_order', true );
        if ($trainer_order) {
            echo $trainer_order;
        }
    }
}

add_filter('manage_trainer_posts_columns', 'trainer_columns_head');  
add_action('manage_trainer_posts_custom_column', 'trainer_columns_content', 10, 2);  