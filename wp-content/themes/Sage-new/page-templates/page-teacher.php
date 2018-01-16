<?php
/*
  Template Name: Page Teachers
 */
?>
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
            <h1><?php the_title(); ?></h1>
        </div>

        <!-- left -->
        <div class="left">

            <div class="teacher_lst">
                <ul>
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $loop = new WP_Query(array(
                        'post_type' => 'trainer',
                        'posts_per_page' => 10,
                        'paged' => $paged,
                        'orderby' => 'meta_value_num', 
                        'meta_key' => 'trainer_order',
                        'order' => 'ASC',
                    ));
                    while ($loop->have_posts()) : $loop->the_post(); 
                    ?>
                    <li id="teacher-<?php the_ID(); ?>">
                        <a href="<?php the_permalink() ?>" class="thumb">
                            <?php // the_post_thumbnail(get_the_ID(), 'thumb142x142'); ?>
                            <img alt="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=142&h=142" />
                        </a>
                        <div class="text">
                            <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                            <div class="intro">
                                <p style="font-weight: bold;font-size: 12px;margin-bottom: 10px;">
                                    <?php echo get_post_meta(get_the_ID(), "chuc_vu", true);?>
                                </p>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <div class="clrb"></div>
                    </li>
                    <?php 
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div>

            <?php getpagenavi(array( 'query' => $loop )); ?>
        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>