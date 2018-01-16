<?php get_header(); ?>

<!-- WRAPPER -->
<?php 
$cat = get_the_category();
?>
<div id="wrapper" <?php
    echo "class=\"bgr_tintuc\" ";
    if(get_option("bg_news") != ""){
        $url = get_option("bg_news");
        echo "style=\"background:url('{$url}') no-repeat center top transparent;\"";
    }
?>>
    <div class="real_w layout_2col">
        <!-- breadcrum -->
        <div class="breadcrum">
            <h1><?php echo "<span>{$cat[0]->name}<span>"; ?></h1>
        </div>

        <!-- left --> 
        <div class="left">
            <?php $excludeID = array(); ?>
            <?php  while(have_posts()) : the_post(); ?>
            <?php array_push($excludeID, get_the_ID()); ?>
            <div class="news_detail">
                <div class="news_detail_top">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_time('d/m/Y'); ?> &nbsp;&nbsp;|&nbsp;&nbsp; <b><?php the_author(); ?></b></p>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('.detail_ct img').each(function(){
                            $(this).attr('href', $(this).attr('src')).css({
                                'cursor': 'pointer'
                            });
                        }).lightBox({
                            imageLoading: themeUrl + '/images/lightbox-ico-loading.gif',
                            imageBtnPrev: themeUrl + '/images/lightbox-btn-prev.gif',
                            imageBtnNext: themeUrl + '/images/lightbox-btn-next.gif',
                            imageBtnClose: themeUrl + '/images/lightbox-btn-close.gif',
                            imageBlank: themeUrl + '/images/lightbox-blank.gif'
                        });
                    });
                </script>
                <div class="detail_ct"><?php the_content();?></div>
            </div>

            <div class="social_box">
                <div style="display: inline; float: left;">
		<a href="javascript://" onclick="window.open(
                      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
                      'facebook-share-dialog', 
                      'width=626,height=436'); 
                      return false;" class="share-fb-button">Share on Facebook</a>
                    
		<!-- <div class="fb-share-button" data-href="<?php global $post; echo get_permalink($post->ID);?>" data-type="button"></div>-->
                </div>
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                <a class="addthis_counter addthis_pill_style"></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e5a517830ae061f"></script>
                <!-- AddThis Button END -->
            </div>

            <div class="tags_box"><p><?php the_tags( '<b>TAGS: </b>', ', ', ''); ?></p></div>
            <?php endwhile; ?>

            <div class="comment_box">
                <h2><?php _e('Bình luận', SHORT_NAME) ?></h2>
                <div class="comment_box_ct">
                    <div class="fb-comments" data-href="<?php echo getCurrentRquestUrl(); ?>" data-width="620" data-num-posts="10"></div>
                </div>
            </div>
			
            <div class="nav-buttons">
                <?php
                $prev_post = get_previous_post($in_same_term = true, $excluded_terms = '', $taxonomy = 'category' );
                if($prev_post) {
                        $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                        echo '<a href="' . get_permalink($prev_post->ID) . '" class="prev-article " title="">';
                        echo '<span class="cta">Bài trước</span><p>'.$prev_post->post_title.'</p>';
                        echo '</a>';
                }else{
                        echo '<a class="prev-article inactive" title="">';
                        echo '<span class="cta">Bài trước</span>';
                        echo '</a>';
                }

                $next_post = get_next_post($in_same_term = true, $excluded_terms = '', $taxonomy = 'category' );
                if($next_post) {
                        $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                        echo '<a class="nright" href="' . get_permalink($next_post->ID) . '" class="next-article " title="">';
                        echo '<span class="cta">Bài sau</span><p>'.$next_post->post_title.'</p>';
                        echo '</a>';
                }else{
                        echo '<a class="nright" class="next-article inactive" title="">';
                        echo '<span class="cta">Bài sau</span>';
                        echo '</a>';
                }
                ?>
            </div>
            <div class="clrb"></div>
        </div>
        <!-- right -->
        <?php get_sidebar(); ?>
        <div class="clrb"></div>
    </div>
</div>
<!-- end:WRAPPER -->

<?php get_footer(); ?>