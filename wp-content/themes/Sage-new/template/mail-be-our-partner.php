<?php
$customer = $attributes['customer'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div style="font-family: Calibri,sans-serif;line-height: 13px;font-size: 14px;">
    <h1 style="text-align: center; font-size: 20px;text-transform: uppercase;margin-top: 5px;padding-top: 5px">
        <?php _e('XÁC NHẬN THÔNG TIN ĐĂNG KÝ ĐỐI TÁC', SHORT_NAME) ?>
    </h1>
    <div style="margin-bottom: 15px;padding-bottom: 15px">
        <p><strong><?php _e('Họ và tên', SHORT_NAME) ?></strong>: <?php echo $customer['salutation'] . " " . $customer['fullname'] ?></p>
        <p><strong><?php _e('Địa chỉ Email', SHORT_NAME) ?></strong>: <?php echo $customer['email'] ?></p>
        <p><strong><?php _e('Số điện thoại', SHORT_NAME) ?></strong>: <?php echo $customer['phone'] ?></p>
        <p><strong><?php _e('Công ty', SHORT_NAME) ?></strong>: <?php echo $customer['company'] ?></p>
        <p><strong><?php _e('Chức vụ', SHORT_NAME) ?></strong>: <?php echo $customer['position'] ?></p>
        <p><strong><?php _e('Địa chỉ', SHORT_NAME) ?></strong>: <?php echo $customer['address'] ?></p>
        <p><strong><?php _e('Zip/Postal Code', SHORT_NAME) ?></strong>: <?php echo $customer['zip_code'] ?></p>
        <p><strong><?php _e('Quốc gia', SHORT_NAME) ?></strong>: <?php echo $customer['country'] ?></p>
        <p><strong><?php _e('Lời nhắn', SHORT_NAME) ?></strong>: <?php echo $customer['comments'] ?></p>
    </div>
    <div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: none;width: 100%">
            <tr>
                <td style="vertical-align: top" valign="top">
                    <p><strong><?php _e('Người đăng ký', SHORT_NAME) ?></strong></p>
                    <h3 style="text-transform: uppercase"><?php echo $customer['salutation'] . " " . $customer['fullname'] ?></h3>
                </td>
                <td style="text-align: right;vertical-align: top" align="right" valign="top">
                    <p style="text-align: right;">Hà Nội, <?php echo date("d/m/Y") ?></p>
                    <h3>ASIA DIGITAL ACADEMY</h3>
                </td>
            </tr>
        </table>
    </div>
</div>