<?php get_header(); ?>

<!-- WRAPPER -->
<div id="wrapper" class="bgr_tintuc" <?php
if(get_option("bg_news") != ""){
    $url = get_option("bg_news");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>  <!-- left -->
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><span><?php single_cat_title(); ?></span></h1>
        </div>

        <!-- left -->
        <div class="left">

            <div class="news_lst">
                <ul>
                    <?php while (have_posts()) : the_post();  ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb220x132');
                                    $thumb                  = get_post_thumbnail_id(); //get img ID
                                    $img_url                = wp_get_attachment_url($thumb, 'full'); //get img URL
                                    $img_url_thumbnail      = aq_resize($img_url, 220, 132, true); //resize & crop img
                                    $img_url_full           = aq_resize($img_url, 2000, 2000, false); //resize & crop img 
                            ?>
                            <img alt="<?php the_title(); ?>" src="<?php echo $img_url_thumbnail;?>" />
                        </a>
                        <div class="text">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <span><?php the_time('d/m/Y'); ?> &nbsp;&nbsp; | &nbsp;&nbsp; <?php the_author(); ?></span>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <div class="clrb"></div>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div>

            <?php getpagenavi(); ?>

        </div>
        <!-- right -->
        <?php get_sidebar('news'); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>