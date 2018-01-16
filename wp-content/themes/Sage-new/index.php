<?php get_header(); ?>

<!-- SLIDE TOP -->
<?php 
$loop = new WP_Query(array ( 'post_type' => 'slider', 'orderby' => 'meta_value', 'meta_key' => 'slide_order', 'order' => 'ASC' ));
if($loop->post_count > 0) :
?>
<div id="slide_top"> 
    <ul id="slider-top">
        <?php while ($loop->have_posts()) : $loop->the_post(); ?> 
        <li>
            <a href="<?php echo get_post_meta(get_the_ID(), "slide_link", true);?>" target="_blank">
                <img src="<?php echo get_post_meta(get_the_ID(), "slide_img", true);?>" alt="<?php the_title(); ?>" />
            </a>
        </li>
        <?php endwhile; ?>
    </ul>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
<!-- end:SLIDE TOP -->

<!-- WRAPPER -->
<div id="wrapper">

    <div class="real_w layout_2col homepage">

<?php /* Widgetized sidebar */
//if ( is_active_sidebar( 'apphome' ) ) { dynamic_sidebar( 'apphome' ); } ?>

        <!-- left -->
        <div class="left">
            <?php $aboutPost = get_page(icl_object_id(get_option('sage_aboutID'), 'page')); ?>
            <div class="intro_box">
                <h1><?php echo $aboutPost->post_title; ?></h1>
                <div class="intro_box_ct">
                    <?php echo get_short_content($aboutPost->post_content, 245);?>
                    <a href="<?php the_permalink($aboutPost); ?>"><?php _e('Xem thêm +', SHORT_NAME) ?></a>
                </div>
            </div>

            <div class="box2col">
                <div class="skg">
                    <h2><?php _e('Sắp khai giảng', SHORT_NAME) ?></h2>
                    <ul>
                        <?php get_courses_soon(); ?>
                    </ul>
                    <div class="bottom"><a href="<?php echo get_page_link(3682);?>"><?php _e('Xem toàn bộ khóa học +', SHORT_NAME) ?></a></div>
                </div>
                <div class="sage_cafe">
                    <h2 class="hd">Blog</h2>
                    <ul>
                        <?php
                        $maxPost = get_option('sage_maxPostSageCafe');
                        if(!is_numeric($maxPost)) $maxPost = 4;
                        $loop = new WP_Query(array(
                                    'post_type' => 'post',
                                    'posts_per_page' => $maxPost,
                                    'category_name' => 'blog',
                                ));
                        while ($loop->have_posts()) : $loop->the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="thumb">
                                <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb117x70');
                                    $thumb                  = get_post_thumbnail_id(); //get img ID
                                    $img_url                = wp_get_attachment_url($thumb, 'full'); //get img URL
                                    $img_url_thumbnail      = aq_resize($img_url, 117, 70, true); //resize & crop img
                                    $img_url_full           = aq_resize($img_url, 2000, 2000, false); //resize & crop img 
                                 ?>
                                <img alt="<?php the_title(); ?>" src="<?php echo $img_url_thumbnail; ?>" />
                            </a>
                            <div class="text">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p><?php the_time('d M Y'); ?></p>
                            </div>
                            <div class="clrb"></div>
                        </li>
                        <?php endwhile; wp_reset_query();?>
                    </ul>
                    <div class="bottom"><a href="<?php bloginfo('siteurl');?>/blog"><?php _e('Xem toàn bộ bài viết +', SHORT_NAME) ?></a></div>
                </div>
                <div class="clrb"></div>
            </div>

            <div class="kh_box">
                <div class="hd">
                    <h2><?php _e('Hình ảnh về ADA?', SHORT_NAME) ?></h2>
                    <div id="kh-btn-prev" class="btn_prev"></div>
                    <div id="kh-btn-next" class="btn_next"></div>
                </div>
                <div class="kh_slider">
                    <ul>
                        <?php
                        $homeGallery = get_post(get_option('sage_homeGallery'));
                        $photo_images = get_field('photo_images', $homeGallery);
                        foreach ($photo_images as $image) :
                        ?>
                        <li>
                            <img src="<?php echo $image['sizes']['medium'] ?>" alt="<?php echo $image['title'] ?>" />
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="clrb"></div>
                </div>
            </div>
        </div>
        <!-- right -->
        <?php get_sidebar('home'); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->
<?php get_footer(); ?>