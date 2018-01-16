<?php

# Custom slider post type
add_action('init', 'create_slider_post_type');

function create_slider_post_type(){
    $args = array(
        'labels' => array(
            'name' => __('Sliders', SHORT_NAME),
            'singular_name' => __('Sliders', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Slider', SHORT_NAME),
            'new_item' => __('New Slider', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Slider', SHORT_NAME),
            'view' => __('View Slider', SHORT_NAME),
            'view_item' => __('View Slider', SHORT_NAME),
            'search_items' => __('Search Sliders', SHORT_NAME),
            'not_found' => __('No Slider found', SHORT_NAME),
            'not_found_in_trash' => __('No Slider found in trash', SHORT_NAME),
        ),
        'public' => false,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 11,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title',
        ),
        'rewrite' => array('slug' => 'slider', 'with_front' => false),
        'can_export' => true,
        'description' => __('Slider description here.', SHORT_NAME)
    );
    
    register_post_type('slider', $args);
}

# Custom slider taxonomies
/*add_action('init', 'create_slider_taxonomies');

function create_slider_taxonomies(){
    register_taxonomy('slider_category', 'slider', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Slider Categories'),
            'singular_name' => __('Slider Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
    ));
}*/

# slider meta box
$slider_meta_box = array(
    'id' => 'slider-meta-box',
    'title' => 'Thông tin',
    'page' => 'slider',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Hình ảnh',
            'desc' => '',
            'id' => 'slide_img',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Liên kết',
            'desc' => '',
            'id' => 'slide_link',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Sắp xếp',
            'desc' => '',
            'id' => 'slide_order',
            'type' => 'text',
            'std' => '',
        ),
));

// Add slider meta box
add_action('admin_menu', 'slider_add_box');
add_action('save_post', 'slider_add_box');

function slider_add_box(){
    global $slider_meta_box;
    add_meta_box($slider_meta_box['id'], $slider_meta_box['title'], 'slider_show_box', $slider_meta_box['page'], $slider_meta_box['context'], $slider_meta_box['priority']);
}

// Callback function to show fields in slider meta box
function slider_show_box() {
    // Use nonce for verification
    global $slider_meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="slider_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table width="100%">';
    foreach ($slider_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
        '<th style="text-align: left; width: 20%;"><label for="', $field['id'], '">', $field['name'], '</label></th>',
        '<td>';
        switch ($field['type']) {
            case 'text':
                if($field['id'] == 'slide_img'){
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', htmlspecialchars($meta) ? htmlspecialchars($meta) : htmlspecialchars($field['std']), '" size="30" style="width:90%" />';
                    echo '<input type="button" id="upload_slide_img_button" class="button button-upload" value="Upload" />', '<br />', $field['desc'];
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

add_action('save_post', 'slider_save_data');

// Save data from slider meta box
function slider_save_data($post_id) {
    global $slider_meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['slider_meta_box_nonce'], basename(__FILE__))) {
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
    foreach ($slider_meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
