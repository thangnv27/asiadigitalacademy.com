<div class="right">
    <?php include 'box-hotline.php'; ?>
    <?php //include 'box-subscribe.php'; ?>

    <?php
    global $current_user, $shortname;
    get_currentuserinfo();
    ?>
    <div class="email_box">
        <h3><?php _e('Đăng ký nhận bài viết của ADA', SHORT_NAME) ?></h3>
        <?php
        if (getRequestMethod() == "POST") {
            $email = getRequest('user_email');
            $emailEncrypt = base64_encode($email);
            $subscribeURL = get_page_link(get_option($shortname . "_pageSubscribeID")) .
                    "?action=sending&code=" . $emailEncrypt;
            $activateURL = get_page_link(get_option($shortname . "_pageSubscribeID")) .
                    "?action=subscribe&code=" . $emailEncrypt;

            if (!is_email($email)) {
                echo "<div class='t_red'>".__("Địa chỉ email không hợp lệ!", SHORT_NAME)."</div>";
            } else if (email_exists($email)) {
                echo "<div class='t_red'>".__("Địa chỉ email này đã được đăng ký!", SHORT_NAME)."</div>";
            } else {
                $subject = __("ADA Academy - Đăng ký theo dõi tin", SHORT_NAME);
                $message = <<<HTML
Chào bạn,<br />
<p>Bạn vui lòng click vào đường link dưới đây để hoàn tất đăng ký theo dõi bản tin của chúng tôi:</p>
<p><a href="{$activateURL}">Xác nhận</a></p>
<p>hoặc</p>
<p><a href="{$activateURL}">{$activateURL}</a></p>
<p>Thank you,<br />
ADA Academy
</p>
HTML;

                add_filter('wp_mail_content_type', 'set_html_content_type');
                wp_mail($email, $subject, $message);
                // reset content-type to avoid conflicts
                remove_filter('wp_mail_content_type', 'set_html_content_type');

                header("location: $subscribeURL");
                exit();
            }
        }
        ?>
        <div class="email_box_ct">
            <form action="" method="post">
                <div class="txt">
                    <input type="text" name="user_email" id="user_email" class="input" 
                           value="<?php echo getRequest('user_email'); ?>" size="25" placeHolder="<?php _e('Địa chỉ email của bạn', SHORT_NAME) ?>" />
                </div>
                <input type="submit" value="<?php _e('Gửi', SHORT_NAME) ?>" class="btn_send" />
                <div class="clrb"></div>
            </form>
        </div>
    </div>

    <div class="email_box" style="display:none;">
        <form method="post" action="http://app.vangxa.com/form.php?form=8" id="frmSS8" onsubmit="return CheckForm8(this);">
            <table border="0" cellpadding="2" class="myForm">
                <tr>
                    <td><input type="text" name="CustomFields[2]" id="CustomFields_2_8" value="" placeHolder="<?php _e('Họ và Tên', SHORT_NAME) ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="email" value="" placeHolder="<?php _e('Địa chỉ email của bạn', SHORT_NAME) ?>" /></td>
                </tr><input type="hidden" name="format" value="h" />
                <tr>
                    <td>
                        <input type="submit" value="<?php _e('Đăng ký', SHORT_NAME) ?>" />
                    </td>
                </tr>
            </table>
        </form>

        <script type="text/javascript">
            // <![CDATA[

            function CheckMultiple8(frm, name) {
                for (var i = 0; i < frm.length; i++)
                {
                    fldObj = frm.elements[i];
                    fldId = fldObj.id;
                    if (fldId) {
                        var fieldnamecheck = fldObj.id.indexOf(name);
                        if (fieldnamecheck != -1) {
                            if (fldObj.checked) {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            function CheckForm8(f) {
                var email_re = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
                if (!email_re.test(f.email.value)) {
                    alert("<?php _e('Vui lòng nhập email của bạn!', SHORT_NAME) ?>");
                    f.email.focus();
                    return false;
                }

                return true;
            }

            // ]]>
        </script>
    </div>


    <div class="r_box">
    <?php
    $maxPost = get_option('sage_maxPostEvent');
    if (!is_numeric($maxPost))
        $maxPost = 4;
    $loop = new WP_Query(array(
        'post_type' => 'events',
        'posts_per_page' => $maxPost,
        'orderby' => 'rand',
    ));
    if ($loop->have_posts()) :
        ?>
        <div class="hd"><?php _e('Sự kiện', SHORT_NAME) ?></div>
        <div class="r_box_ct event">
            <ul>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>" class="thumb">
                    <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb120x160');  ?>
                    <img alt="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=120&h=160" style="width:120px; height:160px;"  />
                </a>
                <div class="text">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="time"><?php echo get_post_meta(get_the_ID(), "thoi_gian", true); ?></p>
                    <p class="location"><?php echo get_post_meta(get_the_ID(), "dia_diem", true); ?></p>
                </div>
                <div class="clrb"></div>
            </li>
            <?php endwhile; ?>
            </ul>
        </div>
    <?php endif; ?>
    </div>
    <?php if ( is_active_sidebar( 'sidebar_home' ) ) { dynamic_sidebar( 'sidebar_home' ); } ?>
</div>