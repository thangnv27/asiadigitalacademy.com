<?php

add_action('after_setup_theme', 'courses_install');
add_action('admin_menu', 'add_courses_page');

/* ----------------------------------------------------------------------------------- */
# Create table in database
/* ----------------------------------------------------------------------------------- */
if (!function_exists('courses_install')) {
    function courses_install() {
        global $wpdb;
        
        $courses = $wpdb->prefix . 'courses';

        $sql = "CREATE TABLE IF NOT EXISTS $courses (
                ID int AUTO_INCREMENT PRIMARY KEY,
                general_info longtext character set utf8 NOT NULL,
                contact_info longtext character set utf8 NOT NULL,
                delegate_info longtext character set utf8 NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        );";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

/* ----------------------------------------------------------------------------------- */
# Add courses page menu
/* ----------------------------------------------------------------------------------- */
function add_courses_page(){
    add_menu_page(__('Register Course', SHORT_NAME), // Page title
            __('Register Course', SHORT_NAME), // Menu title
            'manage_options', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            'nvt_courses', // menu id - Unique id of the menu
            'theme_courses_page',// render output function
            null, // URL icon, if empty default icon
            null // Menu position - integer, if null default last of menu list
        );
}
/* ----------------------------------------------------------------------------------- */
# Courses layout
/* ----------------------------------------------------------------------------------- */
function theme_courses_page() {
    if(isset($_GET['action']) and $_GET['action'] == 'view-detail'){
        require_once 'class-courses-detail-list-table.php';

        echo <<<HTML
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <h2>Chi tiết đăng ký</h2>
HTML;

        //Prepare Table of elements
        $wp_list_table = new WPCourses_Detail_List_Table();
        $wp_list_table->prepare_items();
        //Table of elements
        $wp_list_table->display();

        echo '</div>';
    }else{
        require_once 'class-courses-list-table.php';

        echo <<<HTML
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <h2>Danh sách đăng ký khóa học</h2>
HTML;
        echo <<<HTML
            <form action="" method="get">
            <input type="hidden" name="page" value="nvt_courses" />
HTML;

        //Prepare Table of elements
        $wp_list_table = new WPCourses_List_Table();
        $wp_list_table->prepare_items();
        //Table of elements
        $wp_list_table->display();

        echo '</form></div>';
    }
}