<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_tintuc">
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><span>Tag: "<?php single_cat_title(); ?>"</span></h1>
        </div>

        <!-- left -->
        <div class="left">

            <div class="news_lst">
                <ul>
                    <?php while (have_posts()) : the_post();  ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb220x132');?>
                            <img alt="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=220&h=132" />
                        </a>
                        <div class="text">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <span><?php the_time('d/m/Y'); ?> &nbsp;&nbsp; | &nbsp;&nbsp; <?php the_author(); ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
                                    <?php 
                                    $post_categories = wp_get_post_categories( get_the_ID() );
                                    foreach($post_categories as $k => $c){
                                        $cat = get_category( $c );
                                        if((count($post_categories) == 1) or ($k == count($post_categories) - 1 and $k > 0)){
                                            echo $cat->name;
                                        }else{
                                            echo $cat->name . ', ';
                                        }
                                    }
                                    ?></span>
                            <p><?php echo get_short_content(get_the_content(), 300); ?></p>
                        </div>
                        <div class="clrb"></div>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div>

            <?php getpagenavi(); ?>

            <?php get_template_part('courses-other');?>
        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>