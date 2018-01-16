<?php
$generalInfo = $attributes['genernal'];
$contactInfo = $attributes['contact'];
$delegateInfo = $attributes['delegate'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div style="margin: 0 auto;width: 1056px;font-family: Calibri,sans-serif;line-height: 13px;font-size: 14px;">
    <div style="border-bottom: 2px solid #000;padding-bottom: 10px;margin-bottom: 10px">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: none;width: 100%">
            <tr>
                <td valign="top" style="vertical-align: top">
                    <p><?php _e('Đại diện', SHORT_NAME) ?>: <?php echo $contactInfo->salutation . $contactInfo->fullname ?></p>
                    <p><?php _e('Địa chỉ Email', SHORT_NAME) ?>: <?php echo $contactInfo->email ?></p>
                    <p><?php _e('Điện thoại', SHORT_NAME) ?>: <?php echo $contactInfo->phone ?></p>
                    <p><?php _e('Công ty', SHORT_NAME) ?>: <?php echo $contactInfo->company ?></p>
                    <p><?php _e('Chức vụ', SHORT_NAME) ?>: <?php echo $contactInfo->position ?></p>
                </td>
                <td valign="top" style="vertical-align: top;padding-left: 30%">
                    <p>ASIA DIGITAL ACADEMY</p>
                    <p><?php _e('Địa chỉ', SHORT_NAME) ?>: <?php echo get_option('sage_address'); ?></p>
                    <p><?php _e('Điện thoại', SHORT_NAME) ?>: <?php echo get_option('sage_hotline') ?></p>
                    <p><?php _e('Địa chỉ Email', SHORT_NAME) ?>: <?php echo $attributes['admin_email'] ?></p>
                    <p><?php _e('Ngày đăng ký', SHORT_NAME) ?>: <?php echo date("d/m/Y") ?></p>
                </td>
            </tr>
        </table>
    </div>
    <div style="overflow: hidden;">
        <h1 style="text-align: center; font-size: 20px;text-transform: uppercase;margin-top: 5px;padding-top: 5px">
            <?php _e('DANH SÁCH ĐẠI BIỂU ĐĂNG KÝ', SHORT_NAME) ?>
        </h1>
        <div style="margin-bottom: 15px;padding-bottom: 15px">
            <table border="1" cellpadding="5" cellspacing="0" style="width:100%" width="100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th><?php _e('Họ và tên', SHORT_NAME) ?></th>
                        <th><?php _e('Địa chỉ Email', SHORT_NAME) ?></th>
                        <th><?php _e('Điện thoại', SHORT_NAME) ?></th>
                        <th><?php _e('Công ty', SHORT_NAME) ?></th>
                        <th><?php _e('Chức vụ', SHORT_NAME) ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                foreach ($delegateInfo as $p) :
                ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $p->salutation . " " . $p->fullname; ?></td>
                        <td><?php echo $p->email ?></td>
                        <td><?php echo $p->phone ?></td>
                        <td><?php echo $p->company ?></td>
                        <td><?php echo $p->position ?></td>
                    </tr>
                <?php
                $count++;
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: none;width: 100%">
                <tr>
                    <td style="vertical-align: top" valign="top">
                        <p><strong><?php _e('Người đăng ký', SHORT_NAME) ?></strong></p>
                        <h3 style="text-transform: uppercase"><?php echo $contactInfo->salutation . $contactInfo->fullname ?></h3>
                    </td>
                    <td style="text-align: right;vertical-align: top" align="right" valign="top">
                        <p style="text-align: right;">Hà Nội, <?php echo date("d/m/Y") ?></p>
                        <h3>ASIA DIGITAL ACADEMY</h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>