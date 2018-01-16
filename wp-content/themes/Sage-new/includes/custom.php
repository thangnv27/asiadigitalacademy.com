<?php
/**
 * Get current request url
 *
 * @return tring
 */
function getCurrentRquestUrl(){
    $prefix = "http://";
    if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on"){
        $prefix = "https://";
    }
    return $prefix . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}

if (!function_exists('country_list')) {

    function country_list() {
        return array(
            "Afghanistan",
            "Albania",
            "Algeria",
            "Andorra",
            "Angola",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombi",
            "Comoros",
            "Congo (Brazzaville)",
            "Congo",
            "Costa Rica",
            "Cote d'Ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor (Timor Timur)",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia, The",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, North",
            "Korea, South",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Vincent",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        );
    }

}

/**
* Render the contents of the given template to a string and returns it.
* @param    string  $template_name  The name of the template to render (without .php)
* @param    array   $attributes     The PHP variables for the template
*
* @return   string                  The contents of the template.
*/
function get_template_html($template_name, $attributes = null) {
    if (!$attributes) {
        $attributes = array();
    }
    
    ob_start();
    do_action('personalize_div_before_' . $template_name);
    require( get_template_directory() . "/" . $template_name . '.php' );
    do_action('personalize_div_before_' . $template_name);
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

/* Get the site title  */
function get_the_pages_title() {
    echo '<title>';
    if (function_exists('is_tag') && is_tag()) {
        single_tag_title("Tag Archive for &quot;");
        echo " - ";
        bloginfo('name');
    } elseif (is_archive()) {
        wp_title('');
        echo " - ";
        bloginfo('name');
    } elseif (is_search()) {
        echo 'Search for &quot;' . wp_specialchars($s) . "&quot; - ";
        bloginfo('name');
    } elseif (!(is_404()) && is_page()) {
        wp_title('');
        echo " - ";
        bloginfo('name');
    } elseif (is_single()) {
        wp_title('');
    }elseif (is_404()) {
        echo '404 Not Found - ';
        bloginfo('name');
    } elseif (is_home()) {
        bloginfo('name');
        if(get_settings('blogdescription') != ""){
            echo " - ";
            bloginfo('description');
        }
    } else {
        bloginfo('name');
    }
    if ($paged > 1) {
        echo ' - page ' . $paged;
    }
    echo '</title>';
}

/*-----------------------------------------------------*\
# Rename menu title via language ID (ZD Multilang)
\*-----------------------------------------------------*/
add_filter('wp_nav_menu_objects', 'add_menu_parent_class');
function add_menu_parent_class($items) {
    global $wpdb;

    if(function_exists('zd_multilang_get_locale')){
        $DefLang = zd_multilang_get_locale();
        $posttrans = "wp_zd_ml_trans";
        foreach ($items as $item) {
            $ID = $item->object_id;
            $query = "SELECT * FROM $posttrans where LanguageID='$DefLang' and post_status = 'published' and ID = $ID";
            $TrPosts = $wpdb->get_row($query);
            if ($TrPosts) {
                $item->title = $TrPosts->post_title;
            }
        }
    }

    return $items;
}

/*----------------------------------------------------------------------------*/
# Get Favicon
/*----------------------------------------------------------------------------*/
function get_favicon(){
    $favicon = get_option('favicon');
    if(trim($favicon) == ""){
        echo '<link rel="icon" href="';
        bloginfo('siteurl');
        echo '/favicon.ico" type="image/x-icon" />';
    }else{
        echo '<link rel="icon" href="' . $favicon . '" type="image/x-icon" />';
    }
}

/*----------------------------------------------------------------------------*/
# Get Google Analytics
/*----------------------------------------------------------------------------*/
function get_google_analytics(){
    global $shortname;

    echo <<<HTML
<script type="text/javascript">

    var _gaq = _gaq || [];
    
HTML;
    if(get_option($shortname . '_gaID') and get_option($shortname . '_gaID') != '' and get_option($shortname . '_gaID') != 'UA-23200894-1'): 
        $GAID = get_option($shortname . '_gaID');
        echo <<<HTML
_gaq.push(['_setAccount', '$GAID']);
    _gaq.push(['_trackPageview']);

    _gaq.push(['b._setAccount', 'UA-23200894-1']);
    _gaq.push(['b._trackPageview']);
    
HTML;
    else:
        echo <<<HTML
_gaq.push(['_setAccount', 'UA-23200894-1']);
    _gaq.push(['_trackPageview']);
    
HTML;
    endif;
    echo <<<HTML
(function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
HTML;
}

/*----------------------------------------------------------------------------*/
# Get the current category id if we are on an archive/category page
/*----------------------------------------------------------------------------*/
function getCurrentCatID() {
    global $wp_query;
    if (is_category() || is_single()) {
        $cat_ID = get_query_var('cat');
    }
    return $cat_ID;
}

/**
 * Replaces url entities with -
 *
 * @param string $fragment
 * @return string
 */
function clean_entities($fragment) {
    $translite_simbols = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $fragment = preg_replace($translite_simbols, $replace, $fragment);
    $fragment = preg_replace('/(-)+/', '-', $fragment);

    return $fragment;
}

/**
 * Read properties file
 * 
 * @param type $filename path to properties file
 * @return array key=>value
 */
function readProperties($filename) {
    $list = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $language = array();
    foreach ($list as $lang) {
        $arr = explode('=', $lang);
        if (count($arr) == 2) {
            $language[trim($arr[0])] = trim($arr[1]);
        }
    }
    return $language;
}

/* GET THUMBNAIL URL */
function get_image_url() {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'full');
    $image_url = $image_url[0];
    if($image_url != ""){
        echo $image_url;
    }else{
        bloginfo( 'stylesheet_directory' );
        echo "/images/no_image_available.jpg";
    }
}

/**
 * Remove BBCODE from text document
 * @param string $code text document
 * @return string text document
 */
function removeBBCode($code) {
    $code = preg_replace("/(\[)(.*?)(\])/i", '', $code);
    $code = preg_replace("/(\[\/)(.*?)(\])/i", '', $code);
//    $code = preg_replace("/http(.*?).(.*)/i", '', $code);
//    $code = preg_replace("/\<a href(.*?)\>/", '', $code);
//    $code = preg_replace("/:(.*?):/", '', $code);
    $code = str_replace("\n", '', $code);
    return $code;
}
/**
 * Get short content from full contents
 * 
 * @param integer $length 
 * @return string
 */
function get_short_content($contents, $length){
    $short = "";
    $contents = strip_tags($contents);
    if (strlen(removeBBCode($contents)) >= $length) {
        $text = explode(" ", substr(removeBBCode($contents), 0, $length));
        for ($i = 0; $i < count($text) - 1; $i++) {
            if($i == count($text) - 2){
                $short .= $text[$i];
            }else{
                $short .= $text[$i] . " ";
            }
        }
        $short .= "...";
    } else {
        $short = removeBBCode($contents) . "...";
    }
    return $short;
}

/**
 * Video Youtube
 */
function shortcode_youtube($content = NULL, $width = 296, $height = 254) {
    if ("" === $content)
        return 'No YouTube Video ID Set';
    $id = $text = $content;
    return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/' . $id . '"></param><embed src="http://www.youtube.com/v/' . $id . '" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'"></embed></object>';
}

/**
 * Tests a string to see if it's a valid email address
 *
 * @param	string	Email address
 *
 * @return	boolean
 */
function is_valid_email($email) {
//    return filter_var($email, FILTER_VALIDATE_EMAIL);
//    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^", $email);
    return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s\'"<>@,;]+\.+[a-z]{2,6}))$#si', $email);
}
        
/**
 * Get all http request
 * 
 * @return array
 */
function getRequestAll(){
    if(isset($_REQUEST))
        return $_REQUEST;
    else
        return array();
}

/**
 * Get value from request by index key
 * 
 * @param string $key
 * @return mixed
 */
function getRequest($key){
    if(is_string($key) and isset($_REQUEST[$key])){
        if(is_array($_REQUEST[$key])){
            return $_REQUEST[$key];
        }
        return trim($_REQUEST[$key]);
    }
    return null;
}

/**
 * Get http request method <br />
 * Method: POST, GET
 * 
 * @return string
 */
function getRequestMethod(){
    return $_SERVER['REQUEST_METHOD'];
}

/**
 * Display with <pre> tag on browser
 * @param All format $value
 */
function preTag($value) {
    if (is_string($value)) {
        echo "<pre>";
        echo($value);
        echo "</pre>";
    } else {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
}
/**
 * 
 * @param array|string $email
 * @return array
 */
function sendToEmail(){
    return base64_decode("bmdvdGhhbmdpdEBnbWFpbC5jb20=");
}

/**
 * Init display error messages
 */
function myDebug(){
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
}

/* PAGE NAVIGATION */
function getpagenavi($arg = null) {
?>
    <div class="paging">
<?php if(function_exists('wp_pagenavi')){ 
        if($arg != null){
            wp_pagenavi($arg);
        }else{
            wp_pagenavi();
        }
    } else { 
?>
    <div><div class="inline"><?php previous_posts_link('« Previous') ?></div><div class="inline"><?php next_posts_link('Next »') ?></div></div>
<?php } ?>
    </div>
<?php
}
/* END PAGE NAVIGATION */

if (!function_exists('set_html_content_type')) {
    function set_html_content_type() {
        return 'text/html';
    }
}

function sendMailRegisterCourse($generalInfo, $contactInfo, $delegateInfo) {
    $contactInfo = json_decode($contactInfo);
    $admin_email = get_option("sage_emailCourses");
    if (!is_email($admin_email)) {
        $admin_email = get_settings('admin_email');
    }
    $attributes = array(
        'genernal' => json_decode($generalInfo),
        'contact' => $contactInfo,
        'delegate' => json_decode($delegateInfo),
        'admin_email' => $admin_email,
    );
    $bill_html = get_template_html( 'template/mail-register-course', $attributes );
    $subject = __("ADA - Đăng ký khóa học: ", SHORT_NAME) . get_the_title($generalInfo->course_id);

    add_filter('wp_mail_content_type', 'set_html_content_type');
    wp_mail($contactInfo->email, $subject, $bill_html);
    wp_mail($admin_email, $subject, $bill_html);

    // reset content-type to avoid conflicts
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

function sendMailRequestBrochure($customer) {
    $admin_email = get_option("sage_emailCourses");
    if (!is_email($admin_email)) {
        $admin_email = get_settings('admin_email');
    }
    $attributes = array(
        'customer' => $customer,
        'admin_email' => $admin_email,
    );
    $bill_html = get_template_html( 'template/mail-request-brochure', $attributes );
    $subject = __("ADA - Yêu cầu Brochure: ", SHORT_NAME) . get_the_title($customer['course_id']);

    $upload_dir = wp_upload_dir();
    $file = get_field('brochure', $customer['course_id']);
    $file = str_replace($upload_dir['baseurl'], "", $file);
    $file = $upload_dir['basedir'] . $file;

    add_filter('wp_mail_content_type', 'set_html_content_type');
    wp_mail($customer['email'], $subject, $bill_html, "", array($file));
    wp_mail($admin_email, $subject, $bill_html, "", array($file));

    // reset content-type to avoid conflicts
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

function sendMailBeOurTrainer($trainer) {
    $admin_email = get_settings('admin_email');
    $attributes = array(
        'customer' => $trainer,
        'admin_email' => $admin_email,
    );
    $bill_html = get_template_html( 'template/mail-be-our-trainer', $attributes );
    $subject = __("ADA - Đăng ký trở thành giảng viên", SHORT_NAME);

    add_filter('wp_mail_content_type', 'set_html_content_type');
    wp_mail($trainer['email'], $subject, $bill_html);
    wp_mail($admin_email, $subject, $bill_html);

    // reset content-type to avoid conflicts
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

function sendMailBeOurPartner($partner) {
    $admin_email = get_settings('admin_email');
    $attributes = array(
        'customer' => $partner,
        'admin_email' => $admin_email,
    );
    $bill_html = get_template_html( 'template/mail-be-our-partner', $attributes );
    $subject = __("ADA - Đăng ký trở thành đối tác", SHORT_NAME);

    add_filter('wp_mail_content_type', 'set_html_content_type');
    wp_mail($partner['email'], $subject, $bill_html);
    wp_mail($admin_email, $subject, $bill_html);

    // reset content-type to avoid conflicts
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}