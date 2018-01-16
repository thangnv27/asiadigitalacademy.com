<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_cafe">
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><?php single_cat_title(); ?></h1>
        </div>

        <!-- left -->
        <div class="left">
		 
            <div class="sage_cafe_lst">
                <ul>
                    <?php while (have_posts()) : the_post();  ?>
                    <li>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="author_box">
                            <a href="<?php bloginfo( 'siteurl' ); ?>/author/<?php the_author_meta( 'user_login', $post->post_author ); ?>" class="thumb"><?php echo get_avatar( $post->post_author, 50 ); ?></a>
                            <div class="text">
                                <h4><?php the_author_posts_link(); ?></h4>
                                <p><?php the_time('d/m/Y'); ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <span><?php _e('Chuyên mục', SHORT_NAME) ?></span>: 
                                   <?php the_category(", ") ?></p>
                            </div>
                            <div class="clrb"></div>
                        </div>
                        <div class="post_ct">
                            <img alt="" src="<?php get_image_url(); ?>" />
                            <?php the_excerpt(); ?>
                        </div>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div>

            <?php getpagenavi(); ?>

        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>