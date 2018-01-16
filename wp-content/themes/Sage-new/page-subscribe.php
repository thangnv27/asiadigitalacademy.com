<?php
/*
  Template Name: Page Subscribe
 */
?>
<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper">
    <div class="real_w layout_2col homepage">
        <!-- left -->
        <div class="left">
            <div class="intro_box">
                <h1><?php the_title(); ?></h1>
                <div class="intro_box_ct">
<?php
$action = getRequest("action");
$code = getRequest("code");
$homeURL = home_url();
switch ($action) {
    case "sending":
        echo <<<HTML
<p>Chúng tôi cần xác nhận địa chỉ email của bạn.</p>
<p>Rất đơn giản, bạn chỉ cần click vào link trong mail chúng tôi vừa gửi cho bạn.</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
        break;
    case "subscribe":
        if($code != null and $code != ""){
            $email = base64_decode($code);
            if (!is_email( $email )) {
                echo <<<HTML
<p>Code không hợp lệ!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
            }else if(email_exists( $email )){
                echo <<<HTML
<p>Địa chỉ email này đã được xác nhận!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
            }else{
                // TODO: Generate a better login (or ask the user for it)
                $login = explode('@', $email);
                $login = $login[0];

                // TODO: Generate a better password (or ask the user for it)
                $password = wp_generate_password();

                // Create the WordPress User object with the basic required information
                $user_id = wp_create_user($login, $password, $email);

                if (!$user_id || is_wp_error($user_id)) {
                    echo "<p>Xác nhận lỗi. Vui lòng liên hệ <a href='mailto:" . get_option( 'admin_email' ) . "'>quản trị web</a>!</p>";
                    echo <<<HTML
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
                }else{
                    echo <<<HTML
<p>Xác nhận thành công!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
                }

                //Set up the Password change nag.
                //update_user_option( $user_id, 'default_password_nag', true, true ); 
                // notification for user
                //wp_new_user_notification( $user_id, $password );
            }
        }else{
            echo <<<HTML
<p>Code không hợp lệ!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
        }
        break;
    case "unsubscribe":
        if($code != null and $code != ""){
            $email = base64_decode($code);
            if (!is_email( $email )) {
                echo <<<HTML
<p>Code không hợp lệ!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
            }else if(email_exists( $email )){
                $subscriber = get_user_by( 'email', $email );
                if(!$subscriber){
                    echo <<<HTML
<p>Email không tồn tại trong hệ thống của ADA!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
                }else{
                    require_once(ABSPATH . 'wp-admin/includes/user.php' );
                    if (wp_delete_user( $subscriber->ID )) {
                        echo <<<HTML
<p>Hủy đăng ký theo dõi thành công!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
                    }else{
                        echo "<p>Hủy đăng ký bị lỗi. Vui lòng liên hệ <a href='mailto:" . get_option( 'admin_email' ) . "'>quản trị web</a>!</p>";
                        echo <<<HTML
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
                    }
                }
            }else{
                echo <<<HTML
<p>Email không tồn tại trong hệ thống của ADA!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
            }
        }else{
            echo <<<HTML
<p>Code không hợp lệ!</p>
<br /><br />
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
        }
        break;
    default:
        echo <<<HTML
<p><a href="{$homeURL}"><< Quay về trang chủ</a></p>
HTML;
        break;
}
?>
                </div>
            </div>
        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>