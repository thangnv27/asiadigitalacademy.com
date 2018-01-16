<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_tintuc_user"> 
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><span></span></h1>
        </div>

        <!-- left -->
        <div class="left">
            <?php 
            $author = get_queried_object(); 
            $cat_slug = 'blog';
            ?>
            <div class="author_info">
                <div class="author_info_top">
                    <span class="thumb"><?php echo get_avatar( $author->ID, 142 ); ?></span>
                    <div class="text">
                        <h2><?php echo $author->display_name; ?></h2>
                        <p><?php echo $author->regency; ?></p>
                        <span><?php _e('Số bài viết', SHORT_NAME) ?>: <?php 
                        //the_author_posts(); 
                        $query = new WP_Query( array(
                                'author' => $author->ID,
                                'post_type' => 'post',
                                'category_name' => $cat_slug,
                            ));
                        echo $query->post_count;
                        ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <?php _e('Ngày tham gia', SHORT_NAME) ?>: 
                            <?php
                            $timestamp = strtotime($author->user_registered);
                            echo date('d/m/Y', $timestamp);
                            ?></span>
                    </div>
                    <div class="clrb"></div>
                </div>
                <h3 class="title"><?php _e('Giới thiệu', SHORT_NAME) ?></h3>
                <div class="intro_ct"><p><?php echo $author->description; ?></p></div>
            </div>

            <div class="news_lst">
                <h2><?php _e('Bài viết của tôi', SHORT_NAME) ?></h2>
                <ul>
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $loop = new WP_Query(array(
                                'post_type' => 'post',
                                'category_name' => $cat_slug,
                                'posts_per_page' => '5',
                                'paged' => $paged
                            ));
                    while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb220x132'); ?>
                            <img alt="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=220&h=132" />
                        </a>
                        <div class="text">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <span><?php the_time('d/m/Y'); ?></span>
                            <p><?php echo get_short_content(get_the_content(), 300); ?></p>
                        </div>
                        <div class="clrb"></div>
                    </li>
                    <?php endwhile;?>
                    <?php //wp_reset_query(); ?>
                </ul>
            </div>

            <?php getpagenavi(array( 'query' => $loop )); ?>

            <?php get_template_part('courses-other');?>
        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>