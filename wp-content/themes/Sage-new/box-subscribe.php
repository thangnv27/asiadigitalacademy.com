<?php
global $current_user, $shortname;
get_currentuserinfo();
if (!is_user_logged_in()) :
?>
<div class="email_box">
    <h3><?php _e('Đăng ký nhận bài viết của ADA', SHORT_NAME) ?></h3>
    <?php
    if(getRequestMethod() == "POST"){
        $email = getRequest('user_email');
        $emailEncrypt = base64_encode($email);
        $subscribeURL = get_page_link(get_option($shortname . "_pageSubscribeID")) . 
                "?action=sending&code=" . $emailEncrypt;
        $activateURL = get_page_link(get_option($shortname . "_pageSubscribeID")) . 
                "?action=subscribe&code=" . $emailEncrypt;
        
        if (!is_email( $email )) {
            echo "<div class='t_red'>".__("Địa chỉ email không hợp lệ!", SHORT_NAME)."</div>";
        }else if(email_exists( $email )){
            echo "<div class='t_red'>".__("Địa chỉ email này đã được đăng ký!", SHORT_NAME)."</div>";
        }else{
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
            
            add_filter( 'wp_mail_content_type', 'set_html_content_type' );
            wp_mail( $email, $subject, $message);
            // reset content-type to avoid conflicts
            remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
            
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
<?php endif; ?>

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
				for (var i=0; i < frm.length; i++)
				{
					fldObj = frm.elements[i];
					fldId = fldObj.id;
					if (fldId) {
						var fieldnamecheck=fldObj.id.indexOf(name);
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
