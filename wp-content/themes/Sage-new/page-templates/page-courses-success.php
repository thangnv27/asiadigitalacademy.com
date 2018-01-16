<?php
/*
  Template Name: Courses success
 */
?>
<!DOCTYPE html>

<html lang="vi_VN" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" 

      prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">

<head>
<!-- Code google analytics bo sung -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-21698322-2', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<div id="header">
    
</div>
<style>
	.td-title a:hover {
		color:#F7941E !important;
	}
	.td-title a {
  padding-left: 0 !important;
}
.about_courses{text-align: center;max-width: 60%;margin: 0 auto; padding: 50px 40px 40px 40px;border: 1px solid #033675;color:#033675;margin-top: 100px; }
.successMsg{z-index: 999;background: #fff;width: 100%;height: 100%;top: 150px;}
.successMsg .title{ font-size: 25px;margin-top: 50px;}
.successMsg p{font-size: 17px;margin-bottom: 30px;}
.successMsg p a{font-size: 17px;color: #F7941E;text-decoration: none;}
.successMsg p a:hover{text-decoration: underline;}
body{font-family: 'Roboto Condensed', sans-serif;}
</style>
<div class
<div id="wrapper" class="bgr_khoahoc">
    <script type="text/javascript">
        function goback() {
            history.back(-1);
        }
    </script>
    <div class="real_w layout_2col">
        <!-- left -->
        <?php while (have_posts()) : the_post(); ?>
                <div class="about_courses">
                    <a href="<?php bloginfo( 'siteurl' ); ?>" class="logo" title="<?php bloginfo( 'name' ); ?>">
                        <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_option('sitelogo'); ?>" />
                    </a>
                    <?php the_content();?>
                </div>
                <?php endwhile; ?>
            <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MCQZRB"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MCQZRB');</script>
    <!-- End Google Tag Manager -->
        <!-- right -->
        <div class="clrb"></div>
    </div>
    <!-- Facebook Conversion Code for CTO- Register Online -->
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
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6022865559501', {'value':'0.00','currency':'VND'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6022865559501&amp;cd[value]=0.00&amp;cd[currency]=VND&amp;noscript=1" /></noscript>
</div>
<!-- end:WRAPPER -->
<!-- Google Code for SMB MCC Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 993040638;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "aWVECO_p-1YQ_rHC2QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/993040638/?label=aWVECO_p-1YQ_rHC2QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>