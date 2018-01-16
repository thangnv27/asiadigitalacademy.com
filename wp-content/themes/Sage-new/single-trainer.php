<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_about" <?php
if(get_option("bg_about") != ""){
    $url = get_option("bg_about");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>
    <div class="real_w layout_2col single-trainer">
        <?php while (have_posts()) : the_post(); ?>
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><?php _e('Huấn luyện viên', SHORT_NAME) ?></h1>
        </div>

        <div class="left">
            <div class="trainer-avatar">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=300&h=300" alt="<?php the_title() ?>" />
            </div>
            <h3><?php echo get_post_meta(get_the_ID(), "chuc_vu", true);?></h3>
        </div>
        <div class="right">
            <h2><?php the_title(); ?></h2>
            <?php the_content() ?>
        </div>
        <?php endwhile;?>
        
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>