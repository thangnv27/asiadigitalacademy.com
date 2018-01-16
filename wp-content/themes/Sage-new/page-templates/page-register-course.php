<?php
/*
  Template Name: Register Course
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
                <form action="" method="post" id="frmRegCourse">
                    <h3><?php _e('Thông tin chung', SHORT_NAME) ?></h3>
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
                    <div class="delegate">
                        <span class="close"><?php _e('Xóa', SHORT_NAME) ?></span>
                        <h3><?php _e('Người tham dự', SHORT_NAME) ?> <span class="count">1</span></h3>
                        <div class="form-group">
                            <label><?php _e('Quý danh*', SHORT_NAME) ?></label>
                            <select name="salutation[]" required>
                                <option value="Mr. ">Mr.</option>
                                <option value="Mrs. ">Mrs.</option>
                                <option value="Ms. ">Ms.</option>
                                <option value="Dr. ">Dr.</option>
                                <option value="Prof. ">Prof.</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php _e('Họ và tên*', SHORT_NAME) ?></label>
                            <input type="text" name="fullname[]" value="" required />
                        </div>
                        <div class="form-group">
                            <label><?php _e('Địa chỉ Email*', SHORT_NAME) ?></label>
                            <input type="email" name="email[]" value="" required />
                        </div>
                        <div class="form-group">
                            <label><?php _e('Số điện thoại*', SHORT_NAME) ?></label>
                            <input type="text" name="phone[]" value="" required />
                        </div>
                        <div class="form-group">
                            <label for="company"><?php _e('Công ty*', SHORT_NAME) ?></label>
                            <input type="text" name="company[]" value="" required />
                        </div>
                        <div class="form-group">
                            <label><?php _e('Chức vụ', SHORT_NAME) ?></label>
                            <input type="text" name="position[]" value="" />
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn" id="btnDuplicateDelegate"><?php _e('+ Thêm Đại biểu', SHORT_NAME) ?></button>
                        </div>
                    </div>
                    <h3><?php _e('Thông tin liên hệ', SHORT_NAME) ?></h3>
                    <div class="form-group">
                        <label><?php _e('Quý danh*', SHORT_NAME) ?></label>
                        <select name="salutation_contact" required>
                            <option value="Mr. ">Mr.</option>
                            <option value="Mrs. ">Mrs.</option>
                            <option value="Ms. ">Ms.</option>
                            <option value="Dr. ">Dr.</option>
                            <option value="Prof. ">Prof.</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Họ và tên*', SHORT_NAME) ?></label>
                        <input type="text" name="fullname_contact" value="" required />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Địa chỉ Email*', SHORT_NAME) ?></label>
                        <input type="email" name="email_contact" value="" required />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Số điện thoại*', SHORT_NAME) ?></label>
                        <input type="text" name="phone_contact" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="company"><?php _e('Công ty*', SHORT_NAME) ?></label>
                        <input type="text" name="company_contact" value="" required />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Chức vụ', SHORT_NAME) ?></label>
                        <input type="text" name="position_contact" value="" />
                    </div>
                    <div class="form-group">
                        <label><?php _e('Lĩnh vực/Ngành nghề*', SHORT_NAME) ?></label>
                        <select name="nature_of_business" required>
                            <option value="Advertising/PR/Media/Events/Design/Animation">Advertising/PR/Media/Events/Design/Animation</option>
                            <option value="Banking/Finance/Insurance/Audit">Banking/Finance/Insurance/Audit</option>
                            <option value="Community/Social Services/ Charity">Community/Social Services/ Charity</option>
                            <option value="Consumer Electronics/I.T/Telecom">Consumer Electronics/I.T/Telecom</option>
                            <option value="Cosmetics/Fashion/Jewelleries">Cosmetics/Fashion/Jewelleries</option>
                            <option value="Education/Training/Workforce/Consultancy">Education/Training/Workforce/Consultancy</option>
                            <option value="Entertainment/Travel/Tourism/Culture/Theme Parks">Entertainment/Travel/Tourism/Culture/Theme Parks</option>
                            <option value="FMCG/Retail">FMCG/Retail</option>
                            <option value="Food/Beverage/Ingredient">Food/Beverage/Ingredient</option>
                            <option value="Healthcare/Pharma/BioScience/Life Sciences/Medical">Healthcare/Pharma/BioScience/Life Sciences/Medical</option>
                            <option value="Hospitality/Hotels/Resorts/Clubs/Restaurants">Hospitality/Hotels/Resorts/Clubs/Restaurants</option>
                            <option value="Legal/Regulatory/Authority">Legal/Regulatory/Authority</option>
                            <option value="Property/Real Estate/Building/Construction">Property/Real Estate/Building/Construction</option>
                            <option value="Raw Materials/Components/Engineering/Manufacturing">Raw Materials/Components/Engineering/Manufacturing</option>
                            <option value="Security/Defence">Security/Defence</option>
                            <option value="Trade/Economic/Business Management">Trade/Economic/Business Management</option>
                            <option value="Transportation/Automotive/Aviation/Shipping/Logistics">Transportation/Automotive/Aviation/Shipping/Logistics</option>
                            <option
                            value="Utilities/Chemicals/Water/Energy/Petroleum/Gas/Power">Utilities/Chemicals/Water/Energy/Petroleum/Gas/Power</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Bạn biết tới khóa học này qua nguồn nào?*', SHORT_NAME) ?></label>
                        <select name="how_do_you_know" required>
                            <option value="Email from Pacific Conferences ">Email from Pacific Conferences</option>
                            <option value="Invitation Letter from Pacific Conferences">Invitation Letter from Pacific Conferences</option>
                            <option value="Email from Professional Association/Publication">Email from Professional Association/Publication</option>
                            <option value="Speaker’s Referral">Speaker’s Referral</option>
                            <option value="Colleague’s Referral ">Colleague’s Referral</option>
                            <option value="Search Engine">Search Engine</option>
                            <option value="Social Media Networks ">Social Media Networks</option>
                            <option value="Press Releases">Press Releases</option>
                            <option value="Other Website ">Other Website</option>
                            <option value="Publications/Magazines">Publications/Magazines</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-reg"><?php _e('Đăng ký', SHORT_NAME) ?></button>
                    </div>
                    <input type="hidden" name="action" value="register_course" />
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