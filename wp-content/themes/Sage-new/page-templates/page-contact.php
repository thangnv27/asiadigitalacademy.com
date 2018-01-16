<?php
/*
  Template Name: Page Contact
 */
?>
<?php get_header(); ?>
<!-- WRAPPER -->
<div id="wrapper" class="bgr_lienhe" <?php
if(get_option("bg_contact") != ""){
    $url = get_option("bg_contact");
    echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
}
?>>
    <div class="real_w contact_page">
        <div class="left">
            <div class="add_box">
                <h1><?php the_title(); ?></h1>
                <?php while (have_posts()) : the_post(); ?>
                <div class="add_box_ct">
                    <?php the_content();?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="right">
            <div class="map_box"><?php echo stripslashes(get_option('sage_gmaps')); ?></div>
        </div>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>