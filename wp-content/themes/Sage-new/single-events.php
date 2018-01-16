<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_sukien" <?php
if(get_option("bg_event") != ""){
    $url = get_option("bg_event");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h2><?php _e('Sự kiện', SHORT_NAME) ?></h2>
        </div>

        <!-- left -->
        <div class="left">
            <?php  while(have_posts()) : the_post(); ?>
            <div class="kh_detail">
                <h1 class="kh_name"><?php the_title(); ?></h1>
                <div class="kh_banner"><img alt="" src="<?php echo get_post_meta(get_the_ID(), "post_banner", true);?>" /></div>
                <div class="kh_detail_ct">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endwhile; ?>
            
            <?php get_template_part('courses-other');?>
        </div>
        <!-- right -->
        <div class="right">
            <?php include 'box-hotline.php'; ?>

            <div id="r_fixed" class="r_fixed_limit">
                <div class="kh_info">
                    <h2><?php _e('Thông tin chung', SHORT_NAME) ?></h2>
                    <ul>
                        <?php  while(have_posts()) : the_post(); ?>
                        <?php if (get_post_meta(get_the_ID(), "thoi_gian", true) != ""):?>
                        <li><?php _e('Thời gian', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "thoi_gian", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "dia_diem", true) != ""):?>
                        <li><?php _e('Địa điểm', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "dia_diem", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "thoi_luong", true) != ""):?>
                        <li><?php _e('Thời lượng', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "thoi_luong", true);?></span></li>
                        <?php endif;
                        if (get_post_meta(get_the_ID(), "phi_tham_gia", true) != ""):?>
                        <li><?php _e('Phí tham dự', SHORT_NAME) ?>: <span><?php echo get_post_meta(get_the_ID(), "phi_tham_gia", true);?></span></li>
                        <?php endif;?>
                        <?php endwhile;?>
                    </ul>
                </div>

                <?php include 'courses-soon.php'; ?>
            </div>

        </div>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>