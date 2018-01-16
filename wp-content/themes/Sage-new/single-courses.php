<?php get_header(); ?>

<?php  while(have_posts()) : the_post(); ?>
<!-- WRAPPER -->
<div id="wrapper" class="bgr_khoahoc" <?php
$banner_course = get_field('banner_course', get_the_ID());
if(empty($banner_course)){
    $banner_course = get_option("bg_course");
} else {
    $banner_course = $banner_course['url'];
}
echo "style=\"background:url('{$banner_course}') no-repeat center top transparent;\"";
?>>
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h2><?php _e('Khóa học', SHORT_NAME) ?></h2>
        </div>

        <!-- left -->
        <div class="left">
            <div class="kh_detail">
                <h1 class="kh_name"><?php the_title(); ?></h1>
                <div class="kh_detail_ct">
                    <?php
                    $pageRegCourse = get_page_link(get_option('sage_pageRegCourseID'));
                    $pageBrochure = get_page_link(get_option('sage_pageBrochureID'));
                    $hocphi = get_post_meta(get_the_ID(), "hoc_phi_course_full", true);
                    $testimonials = get_post_meta(get_the_ID(), "testimonials_course", true);
                    ?>
                    <ul class="kh_detail_tabs">
                        <li><a href="#tabs-tq"><?php _e('Tổng quan', SHORT_NAME) ?></a></li>
                        <li><a href="#tabs-Noi-dung"><?php _e('Nội dung', SHORT_NAME) ?></a></li>
                        <?php if(isset($hocphi) and !empty($hocphi)){?>
                        <li><a href="#tabs-Hoc_phi"><?php _e('Học phí', SHORT_NAME) ?></a></li>
                        <?php }?>
                        <?php if(isset($testimonials) and !empty($testimonials)){?>
                        <li><a href="#tabs-Testimonials"><?php _e('Testimonials', SHORT_NAME) ?></a></li>
                        <?php }?>
                        <li class="t-dk" data-url="<?php echo $pageRegCourse ?>"><a href="#tabs-dk"><?php _e('Đăng ký học', SHORT_NAME) ?></a></li>
                        <li class="t-brochure" data-url="<?php echo $pageBrochure ?>" style="border-right: none;"><a href="#tabs-brochure"><?php _e('Brochure', SHORT_NAME) ?></a></li>
                        <div class="clrb"></div>
                    </ul>
                    <div id="tabs-tq">
                        <?php echo get_post_meta(get_the_ID(), "tong_quan_course", true);?>
                        <div class="reg_content">
                            <a class="btn_reg" href="<?php echo $pageRegCourse ?>" id="btn-reg"><?php _e('Đăng ký học', SHORT_NAME) ?></a>
                        </div>
                    </div>
                    <div id="tabs-Noi-dung" style="padding-top: 15px; " class="cus-tab">
                        <?php echo get_post_meta(get_the_ID(), "noi_dung_course", true);?>
                        <div class="reg_content">
                            <a class="btn_reg" href="<?php echo $pageRegCourse ?>" id="btn-reg"><?php _e('Đăng ký học', SHORT_NAME) ?></a>
                        </div>
                    </div>

                    <?php if(isset($hocphi) and !empty($hocphi)){?>
                    <div id="tabs-Hoc_phi" style="padding-top: 15px; " class="cus-tab">
                        <?php echo $hocphi;?>
                        <div class="reg_content">
                            <a class="btn_reg" href="<?php echo $pageRegCourse ?>" id="btn-reg"><?php _e('Đăng ký học', SHORT_NAME) ?></a>
                        </div>
                    </div>
                    <?php }?>

                    <?php if(isset($testimonials) & !empty($testimonials)){?>
                    <div id="tabs-Testimonials" style="padding-top: 15px; " class="cus-tab">
                        <?php echo $testimonials;?>
                        <div class="reg_content">
                            <a class="btn_reg" href="<?php echo $pageRegCourse ?>" id="btn-reg"><?php _e('Đăng ký học', SHORT_NAME) ?></a>
                        </div>
                    </div>
                    <?php }?>
                    
                    <div id="tabs-dk">Loading...</div>
                    <div id="tabs-brochure">Loading...</div>
                </div>
            </div>
        </div>
        
        <!-- right -->
        <div class="right">
            <?php include 'box-hotline.php'; ?>
            <div id="r_fixed" class="r_fixed_limit">
                <div class="kh_info">
                    <h2><?php _e('Thông tin chung', SHORT_NAME) ?></h2>
                    <ul>
                        <?php if (get_field('date_to_open_course',get_the_ID()) != ""):?>
                        <li><?php _e('Ngày khai giảng', SHORT_NAME) ?>: <span><?php							
                                $date = new DateTime(get_field('date_to_open_course',get_the_ID()));				
                                echo $date->format('d/m/Y');
                            ?></span>
                        </li>
                        <?php endif;
                        if (get_field('date_close_course',get_the_ID()) != ""):?>
                        <li><?php _e('Ngày kết thúc', SHORT_NAME) ?>: <span><?php							
                                $date2 = new DateTime(get_field('date_close_course',get_the_ID()));				
                                echo $date2->format('d/m/Y');
                            ?></span>
                        </li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "thoi_luong_course", true) != ""):?>
                        <li><?php _e('Thời lượng', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "thoi_luong_course", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "gio_hoc_course", true) != ""):?>
                        <li><?php _e('Thời gian', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "gio_hoc_course", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "hoc_phi_course", true) != ""):?>
                        <li><?php _e('Học phí', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "hoc_phi_course", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "dia_diem_hoc_course", true) != ""):?>
                        <li><?php _e('Địa điểm', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "dia_diem_hoc_course", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "uu_dai_course", true) != ""):?>
                        <li><?php _e('Uu đãi', SHORT_NAME) ?>: <span><?php echo wpautop(get_post_meta(get_the_ID(), "uu_dai_course", true));?></span></li>
                        <?php endif;?>
                    </ul>
                    <div><a class="btn_reg" href="<?php echo $pageRegCourse ?>" id="btn-reg"><?php _e('Đăng ký học', SHORT_NAME) ?></a></div>					
                </div>

                <?php get_template_part('courses-soon') ?>
            </div>

        </div>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->
<?php endwhile; ?>

<?php get_footer(); ?>