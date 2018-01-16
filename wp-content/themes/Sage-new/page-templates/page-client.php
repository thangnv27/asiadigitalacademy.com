<?php
/*
  Template Name: Page Clients
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
        <?php while (have_posts()) : the_post(); ?>
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><?php the_title(); ?></h1>
        </div>

        <div class="pdt40">
            <div class="mb30"><?php the_content(); ?></div>
            <ul class="client-cats">
                <li data-cat="all" class="active"><?php _e('Tất cả', SHORT_NAME) ?></li>
                <?php
                $terms = get_terms(array(
                    'hide_empty' => 0,
                    'taxonomy' => 'client_category',
                ));
                foreach ($terms as $term) {
                    echo '<li data-cat="' . $term->slug . '">' . $term->name . '</li>';
                }
                ?>
            </ul>
            <ul class="client-ids">
                <?php
                $loop = new WP_Query(array(
                    'post_type' => 'client',
                    'posts_per_page' => -1,
                ));
                while ($loop->have_posts()) : $loop->the_post(); 
                    $cats = get_the_terms(get_the_ID(), 'client_category');
                    $cat_slugs = array();
                    foreach ($cats as $cat) {
                        $cat_slugs[] = $cat->slug;
                    }
                    $cat_slugs = implode(" ", $cat_slugs);
                ?>
                <li class="<?php echo $cat_slugs ?>">
                    <a href="<?php the_permalink() ?>" target="_blank">
                        <?php the_post_thumbnail('full') ?>
                    </a>
                </li>
                <?php 
                endwhile;
                wp_reset_query();
                ?>
                <div class="clear"></div>
            </ul>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>