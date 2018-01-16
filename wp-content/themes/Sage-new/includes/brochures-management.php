<?php

add_action('after_setup_theme', 'brochures_install');
add_action('admin_menu', 'add_brochures_page');

/* ----------------------------------------------------------------------------------- */
# Create table in database
/* ----------------------------------------------------------------------------------- */
if (!function_exists('brochures_install')) {
    function brochures_install() {
        global $wpdb;
        
        $brochures = $wpdb->prefix . 'brochures';

        $sql = "CREATE TABLE IF NOT EXISTS $brochures (
                ID int AUTO_INCREMENT PRIMARY KEY,
                course_id int NOT NULL,
                salutation varchar(255) character set utf8 NOT NULL,
                fullname varchar(255) character set utf8 NOT NULL,
                email varchar(255) character set utf8 NOT NULL,
                phone varchar(255) character set utf8 NOT NULL,
                company varchar(255) character set utf8 NOT NULL,
                position varchar(255) character set utf8 NOT NULL,
                address varchar(255) character set utf8 NOT NULL,
                zip_code varchar(255) character set utf8 NOT NULL,
                country varchar(255) character set utf8 NOT NULL,
                comments longtext character set utf8 NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        );";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

/* ----------------------------------------------------------------------------------- */
# Add brochures page menu
/* ----------------------------------------------------------------------------------- */
function add_brochures_page(){
    add_menu_page(__('Request Brochure', SHORT_NAME), // Page title
            __('Request Brochure', SHORT_NAME), // Menu title
            'manage_options', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            'nvt_brochures', // menu id - Unique id of the menu
            'theme_brochures_page',// render output function
            null, // URL icon, if empty default icon
            null // Menu position - integer, if null default last of menu list
        );
}
/* ----------------------------------------------------------------------------------- */
# Brochures layout
/* ----------------------------------------------------------------------------------- */
function theme_brochures_page() {
    if(isset($_GET['action']) and $_GET['action'] == 'view-detail'){
        require_once 'class-brochures-detail-list-table.php';

        echo <<<HTML
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <h2>Chi tiết đăng ký</h2>
HTML;

        //Prepare Table of elements
        $wp_list_table = new WPBrochures_Detail_List_Table();
        $wp_list_table->prepare_items();

        echo '</div>';
    }else{
        require_once 'class-brochures-list-table.php';

        echo <<<HTML
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <h2>Danh sách yêu cầu Brochure</h2>
HTML;
        echo <<<HTML
            <form action="" method="get">
            <input type="hidden" name="page" value="nvt_brochures" />
HTML;

        //Prepare Table of elements
        $wp_list_table = new WPBrochures_List_Table();
        $wp_list_table->prepare_items();
        //Table of elements
        $wp_list_table->display();

        echo '</form></div>';
    }
}