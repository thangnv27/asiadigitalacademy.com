<div class="right">
    <?php include 'box-hotline.php'; ?>
    <?php include 'box-subscribe.php'; ?>

    <div class="r_box">
        <div class="hd"><?php _e('Sự kiện', SHORT_NAME) ?></div>
        <div class="r_box_ct event">
            <ul>
                <?php
                $loop = new WP_Query(array(
                    'post_type' => 'events',
                    'posts_per_page' => 2,
                    'orderby' => 'rand',
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
                        <p class="time"><?php echo get_post_meta(get_the_ID(), "thoi_gian", true);?></p>
                        <p class="location"><?php echo get_post_meta(get_the_ID(), "dia_diem", true);?></p>
                    </div>
                    <div class="clrb"></div>
                </li>
                <?php endwhile; wp_reset_query();?>
            </ul>
        </div>
    </div>

    <?php if ( is_active_sidebar( 'sidebar_courses' ) ) { dynamic_sidebar( 'sidebar_courses' ); } ?>
</div>