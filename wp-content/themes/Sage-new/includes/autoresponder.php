<?php

add_action('publish_post', 'send_mail_to_subscribers');

/* ----------------------------------------------------------------------------------- */
# Insert post id to mail queue
/* ----------------------------------------------------------------------------------- */
function send_mail_to_subscribers($post_ID)  {
    global $wpdb;
    
    if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {
        $mailqueue = $wpdb->prefix . 'mailqueue';
        $wpdb->query($wpdb->prepare("INSERT INTO $mailqueue SET post_id = %d", $post_ID));
    }
    
    return $post_ID;
}

if(!function_exists('set_html_content_type')){
    function set_html_content_type() {
        return 'text/html';
    }
}

//wp_clear_scheduled_hook('ppo_autoresponder_test');

add_filter('cron_schedules', 'filter_cron_schedules');

/**
 * add custom time to cron
 */
function filter_cron_schedules($schedules) {
    $schedules['once_half_hour'] = array(
        'interval' => 1800, // seconds
        'display' => __('Once Half an Hour')
    );
    $schedules['half_part_time'] = array(
        'interval' => 900, // seconds
        'display' => __('Half Part Time')
    );

    return $schedules;
}

/* ----------------------------------------------------------------------------------- */
# Sutoresponder send mail
/* ----------------------------------------------------------------------------------- */
if (!wp_next_scheduled('ppo_autoresponder_test')) {
    wp_schedule_event(time(), 'half_part_time', 'ppo_autoresponder_test'); // hourly, daily and twicedaily
}

add_action('ppo_autoresponder_test', 'ppo_sendMailTask');

function ppo_sendMailTask() {
    global $wpdb, $shortname;
    
    $mailqueue = $wpdb->prefix . 'mailqueue';
    $post_ID = $wpdb->get_var( "SELECT post_id FROM $mailqueue LIMIT 1" );
    
    if($post_ID > 0){
        // get a published post by post_id
        $post = get_post($post_ID);
        // mail settings
        $subject = get_settings('blogname') . ' - ' . $post->post_title;
        $permalink = get_permalink( $post->ID );
        
        // get subscribers's email
        $blogusers = get_users('blog_id=1&role=subscriber');
        foreach ($blogusers as $user) {
            $unsubscribeURL = get_page_link(get_option($shortname . "_pageSubscribeID")) . 
                "?action=unsubscribe&code=" . base64_encode($user->user_email);
            $message = <<<HTML
{$post->post_content}
<p></p>
<p>Thank you,<br />
ADA Academy
</p>
<hr />
<p>
    <a href="{$permalink}#comment_box" style="padding: 8px 16px; background: #0a8dcf; border-radius: 20px; color: #FFFFFF; text-decoration: none;">Bình luận</a> 
    <a href="{$permalink}#comment_box">xem tất cả bình luận</a>
</p>
<p>Để từ chối nhận thư bạn vui lòng click <a href="{$unsubscribeURL}">vào đây</a>.</p>
HTML;
            // send mail
            add_filter( 'wp_mail_content_type', 'set_html_content_type' );
            wp_mail( $user->user_email, $subject, $message);
            // reset content-type to avoid conflicts
            remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
        }
        
        // delete mail queue after send mail done
        $wpdb->query($wpdb->prepare("DELETE FROM $mailqueue WHERE post_id = %d", $post_ID));
    }
}