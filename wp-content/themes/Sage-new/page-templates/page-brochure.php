<?php
/*
  Template Name: Brochure
 */
?>
<?php get_header(); ?>
<!-- WRAPPER -->
<div id="wrapper" class="bgr_khoahoc" <?php
if(get_option("bg_course") != ""){
    $url = get_option("bg_course");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><?php the_title(); ?></h1>
        </div>
        <!-- left -->
        <div class="left">
            <?php the_content() ?>
            
            <p class="t_red"><?php _e('* Là thông tin bắt buộc!', SHORT_NAME) ?></p>
            <div class="reg-form">
                <form action="" method="post" id="frmRequestBrochure">
                    <h3><?php _e('Yêu cầu Brochure', SHORT_NAME) ?></h3>
                    <div class="form-group">
                        <label for="course_id"><?php _e('Chọn khóa học*', SHORT_NAME) ?></label>
                        <select name="course_id" id="course_id" required>
                            <?php
                            $courses = new WP_Query(array(
                                'post_type' => 'courses',
                                'showposts' => -1,
                            ));
                            while ($courses->have_posts()) {
                                $courses->the_post();
                                echo '<option value="'.get_the_ID().'">';
                                the_title();
                                echo '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Quý danh*', SHORT_NAME) ?></label>
                        <select name="salutation" required>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Prof.">Prof.</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Họ và tên*', SHORT_NAME) ?></label>
                        <input type="text" name="fullname" value="" required />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Địa chỉ Email*', SHORT_NAME) ?></label>
                        <input type="email" name="email" value="" required />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Số điện thoại*', SHORT_NAME) ?></label>
                        <input type="text" name="phone" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="company"><?php _e('Công ty*', SHORT_NAME) ?></label>
                        <input type="text" name="company" id="company" value="" required />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Chức vụ', SHORT_NAME) ?></label>
                        <input type="text" name="position" value="" />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Địa chỉ', SHORT_NAME) ?></label>
                        <input type="text" name="address" value="" />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Zip/Postal Code', SHORT_NAME) ?></label>
                        <input type="text" name="zip_code" value="" />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Quốc gia*', SHORT_NAME) ?></label>
                        <select name="country" required>
                            <option value=""><?php _e('Chọn quốc gia', SHORT_NAME) ?></option>
                            <?php
                            $country_list = country_list();
                            foreach ($country_list as $value) {
                                echo '<option value="'.$value.'">'.$value.'</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Lời nhắn', SHORT_NAME) ?></label>
                        <textarea name="comments"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-reg"><?php _e('Gửi yêu cầu', SHORT_NAME) ?></button>
                    </div>
                    <input type="hidden" name="action" value="request_brochure" />
                </form>
            </div>

        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->
<?php get_footer(); ?>