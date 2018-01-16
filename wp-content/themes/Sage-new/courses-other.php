<div class="kh_other">
    <h2><?php _e('Các khóa học tại ADA', SHORT_NAME) ?></h2>
    <ul>
        <?php
        $loop = new WP_Query(array(
            'post_type' => 'courses',
            'showposts' => 4,
            'meta_key' => 'date_to_open_course',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        ));
        while ($loop->have_posts()) : $loop->the_post();
            $date = new DateTime( get_field('date_to_open_course',$post->ID));
            $date_course = $date->format('Y-m-d');

            $year = date('Y', strtotime($date_course));
            $month = date('m', strtotime($date_course));
            $date_curent = date('Y', time());       
            $month_curent = date('m', time());

            $day_curent = date('d', time());
            $date_a = get_field('date_to_open_course',$post->ID);
            $arr_post_date = explode('-', $date_course);

            //if((int)$date_curent < (int)$year || (int)$date_curent == (int)$year):
            //if($month_curent < $arr_post_date[1] || $arr_post_date[1] == $month_curent):
            ?>
            <li>
                <a href="<?php the_permalink(); ?>" class="thumb">
                    <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb140x84'); ?>
                    <img alt="<?php the_title(); ?>" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&w=140&h=84" onerror="this.src=no_image_src" />
                </a>
                <div class="text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                <div class="clrb"></div>
            </li>
        <?php //endif; endif; 
        endwhile; ?>
    </ul>
    <div class="clrb"></div>
</div>