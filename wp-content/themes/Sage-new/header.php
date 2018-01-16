<!DOCTYPE html>
<html lang="vi_VN" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" 
      prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<?php get_the_pages_title(); ?>
<meta name="robots" content="index, follow" /> 
<meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />
<!--<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">-->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="author" content="By Admin" />

<?php get_favicon(); ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- CSS -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/common.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:500,100|Roboto+Condensed|Open+Sans:700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/sage.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.lightbox-0.5.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.css" media="screen" />
<!-- JS -->
<script>
    var siteUrl = "<?php bloginfo('siteurl'); ?>";
    var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
    var is_home = <?php echo is_home() ? 'true' : 'false'; ?>;
    var is_user_logged_in = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
    var no_image_src = themeUrl + "/images/no_image_available.jpg";
    var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
</script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.expander.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/app.js"></script>
<?php 
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head();
?>
<?php get_google_analytics(); ?>
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body <?php body_class(); ?>>
<div id="ajax_loading" style="display: none;z-index: 9999999" class="ajax-loading-block-window">
    <div class="loading-image"></div>
</div>
<!--Alert Message-->
<div id="nNote" class="nNote" style="display: none;"></div>
<!--END: Alert Message-->
    
<!-- HEADER -->
<div id="header">
    <div class="real_w">
        <a href="<?php bloginfo( 'siteurl' ); ?>" class="logo" title="<?php bloginfo( 'name' ); ?>">
            <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_option('sitelogo'); ?>" />
        </a>
        <div class="top_box">
            <div class="fl_box">
<!--                <span>Follow us</span>
                <a href="<?php echo get_option('sage_fbURL'); ?>" class="icon_face">facebook</a>
                <a href="<?php echo get_option('sage_youtubeURL'); ?>" class="icon_twitter">twitter</a>
                <a href="<?php echo get_option('sage_googleURL'); ?>" class="icon_google">google</a>-->
                <?php do_action('wpml_add_language_selector'); ?>
                <img alt="" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/line.png" class="line">
            </div>
            <div class="search_box">
                <?php include 'searchform.php'; ?>
                <!--<input type="text" class="txt" />
                <input type="submit" value="" class="btn_search" />-->
            </div>
            <div class="clrb"></div>
        </div>

        <?php 
            wp_nav_menu(array(
                'container' => '',
                'theme_location' => 'primary',
                'menu_class' => 'navi_bar',
                'menu_id' => '',
            )); 
        ?>
    </div>

    <?php if ( is_active_sidebar( 'menuapp' ) ) { dynamic_sidebar( 'menuapp' ); } ?>
    <div class="bgr_repeat"></div>
</div>
<!-- end:HEADER -->