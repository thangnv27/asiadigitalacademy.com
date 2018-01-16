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

        <div class="client-entry">
            <div class="client-slide">
                <ul style="display: none">
                    <?php
                    $client_images = get_field('client_images', get_the_ID());
                    foreach ($client_images as $image) :
                    ?>
                    <li>
                        <img src="<?php echo $image['sizes']['large'] ?>" alt="<?php echo $image['title'] ?>" />
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <h2 class="client-title"><?php the_title() ?></h2>
            <div class="client-content">
                <?php the_content() ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>