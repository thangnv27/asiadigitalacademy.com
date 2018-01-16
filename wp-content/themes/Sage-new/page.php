<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_about" <?php
if(get_option("bg_about") != ""){
    $url = get_option("bg_about");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h2><?php _e('Về ADA', SHORT_NAME) ?></h2>
        </div>

        <!-- left -->
        <div class="left">

            <div class="about">
                <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php if (has_post_thumbnail()): ?>
                <div class="banner"><img alt="" src="<?php get_image_url(); ?>" /></div>
                <?php endif; ?>
                <div class="about_ct">
                    <?php the_content();?>
                </div>
                <?php endwhile; ?>
            </div>

        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>