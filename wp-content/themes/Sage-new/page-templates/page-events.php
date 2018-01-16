<?php
/*
  Template Name: Page Events
 */
?>
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
            <h1><span><?php the_title(); ?></span></h1>
        </div>

        <!-- left -->
        <div class="left">

            <div class="event_lst">
                <ul>
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $loop = new WP_Query(array(
                        'post_type' => 'events',
                        'posts_per_page' => '5',
                        'paged' => $paged
                    ));
                    while ($loop->have_posts()) : $loop->the_post(); 
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb120x160'); ?>
                            <img alt="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=120&h=160" />
                        </a>
                        <div class="text">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php the_excerpt(); ?>
                            <p class="time"><?php echo get_post_meta(get_the_ID(), "thoi_gian", true);?></p>
                            <p class="local"><?php echo get_post_meta(get_the_ID(), "dia_diem", true);?></p>
                        </div>
                        <div class="clrb"></div>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div>

            <?php getpagenavi(array( 'query' => $loop )); ?>

            <?php get_template_part('courses-other') ?>
        </div>
        <!-- right -->
        <?php get_sidebar('events'); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>