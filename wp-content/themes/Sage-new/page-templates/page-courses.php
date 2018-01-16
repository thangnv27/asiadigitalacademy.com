<?php
/*
  Template Name: Page Courses
 */
?>
<?php get_header(); ?>
<style>
    .layout_2col .left {
        padding-top: 20px !important; 
    }
</style>
<!-- WRAPPER -->
<div id="wrapper" class="bgr_khoahoc" <?php
if(get_option("bg_course") != ""){
    $url = get_option("bg_course");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><?php the_title(); ?></h1>
        </div>
        
        <div class="list_kh">
            <h2 class="hd"><?php _e('Khóa học đã qua', SHORT_NAME) ?></h2>
            <ul>
                <?php
                $args = array(
                    'post_type'=> 'courses',
                    'showposts'     => -1,
                );
                $advance = new WP_Query( $args );
                while ($advance->have_posts()) : $advance->the_post();
                    $date = new DateTime(get_field('date_to_open_course',get_the_ID()));
                    $khaigiang = $date->format('m/d/Y');
                    $date2 = new DateTime(get_field('date_close_course',get_the_ID()));
                    $ketthuc = $date2->format('m/d/Y');
                    
                    $dateKG = new DateTime(date('m/d/Y', strtotime($khaigiang)));
                    $dateCur = new DateTime(date('m/d/Y'));
                    if($dateKG < $dateCur):
                ?>
                    <li>
                        <a href="<?php the_permalink();?>" class="thumb" title="">
                            <img alt="<?php the_title();?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID));?>&w=220&h=132" onerror="this.src=no_image_src" />
                        </a>
                        <div class="text">
                            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <?php the_excerpt();?>
                        </div>
                        <div class="meta">
                            <ul>
                                <li class="cal">
                                    <div class="startdate"><?php echo date('d M', strtotime($khaigiang)); ?></div> 
                                    <i class="fa fa-arrow-down"></i>
                                    <div class="enddate"><?php echo date('d M', strtotime($ketthuc)); ?></div>
                                </li>
                                <li>
                                    <p class="tdate"><?php echo date('d M', strtotime($khaigiang)); ?> - <?php echo date('d M', strtotime($ketthuc)); ?></p>
                                    <?php echo get_field('dia_diem_hoc_course',get_the_ID());?>
                                </li>
                            </ul>
                        </div>
                        <div class="clrb"></div>
                    </li>
                <?php endif; ?>
                <?php endwhile;wp_reset_query();?>
            </ul>
        </div>
    </div>
</div>
<!-- end:WRAPPER -->
<?php get_footer(); ?>