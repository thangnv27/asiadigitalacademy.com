<?php if(get_the_ID() != get_option('sage_pageTeacherID')): ?>
<!-- TEACHER BOX -->
<div id="teacher_box" class="slide">
    <div class="real_w">
        <h4><?php _e('Huấn luyện viên tại ADA', SHORT_NAME) ?></h4>
        <div class="teacher_slide">
            <ul>
                <?php
                query_posts(array(
                        'post_type' => 'trainer',
                        'orderby' => 'meta_value', 
                        'meta_key' => 'trainer_order',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                    ));
                while (have_posts()) : the_post(); 
                ?>
                <li>
                    <a href="<?php the_permalink() ?>" class="thumb">
                        <?php //echo get_the_post_thumbnail(get_the_ID(), 'thumb80x80'); ?>
                        <img alt="<?php the_title(); ?>" src="<?php get_image_url(); ?>" style="width:90px;" />
                    </a>
                    <div class="text">
                        <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo get_post_meta(get_the_ID(), "chuc_vu", true);?></p>
                    </div>
                    <div class="clrb"></div>
                </li>
                <?php endwhile;?>
                <?php wp_reset_query(); ?>
            </ul>
            <div class="clrb"></div>
        </div>
    </div>
</div>
<!-- TEACHER BOX -->
<?php endif; ?>

<?php if(is_home() or is_front_page()): ?>
<!--CLIENT BOX-->
<div class="client-box">
    <div class="real_w">
        <h3><?php _e('Khách hàng của chúng tôi', SHORT_NAME) ?></h3>
        <ul class="client-ids">
            <?php
            $loop = new WP_Query(array(
                'post_type' => 'client',
                'showposts' => 20,
            ));
            while ($loop->have_posts()) : $loop->the_post(); 
            ?>
            <li>
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
        <a class="read-more" href="<?php echo get_page_link(get_option('sage_pageClientID')) ?>"><?php _e('Xem thêm +', SHORT_NAME) ?></a>
    </div>
</div>
<!--/CLIENT BOX-->
<?php endif; ?>

<!-- FOOTER -->
<div id="footer" class="slide">
    <div class="footer_top">
        <div class="real_w">
            <div class="column">
                <div class="f_title"><?php _e('Truy cập nhanh', SHORT_NAME) ?></div>
                <div class="column_ct">
                    <?php
                    wp_nav_menu(array(
                        'container' => '',
                        'theme_location' => 'footer1',
                        'menu_class' => 'menu-footer1',
                        'menu_id' => '',
                    )); 
                    ?>
                </div>
            </div>
            <div class="column">
                <div class="f_title"><?php _e('Liên hệ', SHORT_NAME) ?></div>
                <div class="column_ct contact">
                    <?php 
                    $contactPost = get_page(icl_object_id(get_option('sage_contactID'), 'page'));
                    echo wpautop($contactPost->post_content);
                    ?>
                </div>
            </div>
            <div class="column">
                <div class="fb-like-box" data-href="<?php echo (get_option('sage_fbPage') == '') ? 'https://www.facebook.com/ppo.vn' : get_option('sage_fbPage'); ?>" data-height="200" data-show-faces="true" data-stream="false" data-show-border="true" data-header="false"></div>
            </div>
            <div class="clrb"></div>
        </div>
    </div>
    <div class="footer_bot slide">Copyright &COPY; ADA. All Right Reserved. <a style="float:right;" href="http://sage.edu.vn/lien-he/privacy-policy/">Privacy Policy</a></div>
</div>

<!-- end:FOOTER -->  
 

<?php wp_footer(); ?>

<!--Coded by Ngo Van Thang, ngothangit@gmail.com-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-21698322-2', 'auto');
  ga('send', 'pageview');
</script>
<!-- remaketing face nhe-->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '873969449292498']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=873969449292498&amp;ev=PixelInitialized" /></noscript>
<!--END remaketing face nhe-->
<!--Tiep thi lai cua Google-->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 981003464;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;"class="slide">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/981003464/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- chat power esnc.net -->
<script type="text/javascript" src="http://sage.linkplaza.net:3007/javascripts/jquery.cookie.js">
</script><script type="text/javascript" src="http://sage.linkplaza.net:3007/javascripts/esnc-client-wp-1.0.0.js"></script>
<div id="esn_chat_boder" style="display:none;"><div id="esnc_chat" style="display:none"></div></div>
<!-- end chat power esnc.net --> 
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
---------------------------------------------------->
<script type="text/javascript">
var google_tag_params = {
edu_pid: 'REPLACE_WITH_VALUE',
edu_plocid: 'REPLACE_WITH_VALUE',
edu_pagetype: 'REPLACE_WITH_VALUE',
edu_totalvalue: 'REPLACE_WITH_VALUE',
};
</script>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 952884684;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/952884684/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>