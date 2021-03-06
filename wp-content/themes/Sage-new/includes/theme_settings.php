<?php
/**
 * Cutstom Theme Panel
 */
$menuname = $shortname . "_settings"; // Required
$pages = get_pages();
$page_list = array();
foreach ($pages as $page) {
    $page_list[$page->ID] = $page->post_title;
}

$options = array(
    array("name" => "Theo dõi trên mạng xã hội",
        "type" => "title",
        "desc" => "Tùy chỉnh Follow us.",
    ),
    array("type" => "open"),
    array("name" => "Facebook",
        "desc" => "Nhập URL page của bạn trên facebook.",
        "id" => $shortname . "_fbURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Youtube",
        "desc" => "Nhập URL page của bạn trên Youtube.",
        "id" => $shortname . "_youtubeURL",
        "std" => "",
        "type" => "text"),
    array("name" => "Google",
        "desc" => "Nhập URL page của bạn trên google.",
        "id" => $shortname . "_googleURL",
        "std" => "",
        "type" => "text"),
    array("type" => "close"),
    
    array("name" => "Post - Page",
        "type" => "title",
        "desc" => "Tìm chọn bài viết.",
    ),
    array("type" => "open"),
    array("name" => "Photo album",
        "desc" => "Gallery ảnh ở trang chủ",
        "id" => $shortname . "_homeGallery",
        "std" => "",
        "type" => "text"),
    array("name" => "Tại sao chọn chúng tôi",
        "desc" => "",
        "id" => $shortname . "_introID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    
    array("name" => "Giới thiệu",
        "desc" => "",
        "id" => $shortname . "_aboutID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Page giảng viên",
        "desc" => "",
        "id" => $shortname . "_pageTeacherID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Page liên hệ",
        "desc" => "",
        "id" => $shortname . "_contactID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Page Subscribe",
        "desc" => "",
        "id" => $shortname . "_pageSubscribeID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Register Course",
        "desc" => "Trang đăng ký khóa học",
        "id" => $shortname . "_pageRegCourseID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Register Course Success",
        "desc" => "Trang đăng ký khóa học thành công",
        "id" => $shortname . "_pageRegCourseSuccessID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Brochure",
        "desc" => "Trang đăng ký tải Brochure",
        "id" => $shortname . "_pageBrochureID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Request Brochure Success",
        "desc" => "Trang đăng ký tải Brochure thành công",
        "id" => $shortname . "_pageBrochureSuccessID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Clients",
        "desc" => "Trang hiển thị danh sách khách hàng",
        "id" => $shortname . "_pageClientID",
        "std" => '',
        "type" => "select",
        "options" => $page_list),
    array("name" => "Số tin khóa học sắp khai giảng",
        "desc" => "Nhập số lượng tin khóa học sắp khai giảng, hiển thị ở trang chủ.",
        "id" => $shortname . "_maxPostCourseSoon",
        "std" => '',
        "type" => "text"),
    array("name" => "Số tin sự kiện",
        "desc" => "Nhập số lượng tin sự kiện, hiển thị ở trang chủ.",
        "id" => $shortname . "_maxPostEvent",
        "std" => '',
        "type" => "text"),
    array("name" => "Số tin Blog",
        "desc" => "Nhập số lượng tin Blog, hiển thị ở trang chủ.",
        "id" => $shortname . "_maxPostSageCafe",
        "std" => '',
        "type" => "text"),
    array("type" => "close"),
    
    array("name" => "Tùy chọn Email",
        "type" => "title",
        "desc" => "Tìm chọn email.",
    ),
    array("type" => "open"),
    array("name" => "Email đăng ký khóa học",
        "desc" => "Nhập địa chỉ email sẽ nhận tin đăng ký, brochure khóa học.",
        "id" => $shortname . "_emailCourses",
        "std" => '',
        "type" => "text"),
    array("name" => "Email đăng ký sự kiện",
        "desc" => "Nhập địa chỉ email sẽ nhận tin đăng ký tham gia sự kiện.",
        "id" => $shortname . "_emailEvents",
        "std" => "",
        "type" => "text"),
    array("type" => "close"),
    
    array("name" => "Tùy chọn khác",
        "type" => "title",
        "desc" => "Tìm chỉnh website.",
    ),
    array("type" => "open"),
    array("name" => "Address",
        "desc" => "Địa chỉ liên hệ hoặc trụ sở",
        "id" => $shortname . "_address",
        "std" => '',
        "type" => "text"),
    array("name" => "Hotline",
        "desc" => "Nhập số điện thoại hỗ trợ. Ví dụ: 096.4747.046",
        "id" => $shortname . "_hotline",
        "std" => '',
        "type" => "text"),
    array("name" => "Link Fanpage trên facebook",
        "desc" => "URL page facebook. Ví dụ: https://www.facebook.com/WeAreBuzz",
        "id" => $shortname . "_fbPage",
        "std" => '',
        "type" => "text"),
    array("name" => "Google Analytics",
        "desc" => "Google Analytics. Ví dụ: UA-23200894-1",
        "id" => $shortname . "_gaID",
        "std" => "UA-23200894-1",
        "type" => "text"),
    array("name" => "Google maps",
        "desc" => "Dán đoạn mã của Google maps vào đây. Kích thước 620 x 460",
        "id" => $shortname . "_gmaps",
        "std" => '<iframe width="470" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=vi&amp;geocode=&amp;q=385+Ho%C3%A0ng+Qu%E1%BB%91c+Vi%E1%BB%87t&amp;aq=&amp;sll=21.027266,105.855451&amp;sspn=0.043262,0.084543&amp;ie=UTF8&amp;hq=&amp;hnear=385+Ho%C3%A0ng+Qu%E1%BB%91c+Vi%E1%BB%87t,+Ngh%C4%A9a+T%C3%A2n,+C%E1%BA%A7u+Gi%E1%BA%A5y,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;t=m&amp;ll=21.046055,105.793018&amp;spn=0.036047,0.040255&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=vi&amp;geocode=&amp;q=385+Ho%C3%A0ng+Qu%E1%BB%91c+Vi%E1%BB%87t&amp;aq=&amp;sll=21.027266,105.855451&amp;sspn=0.043262,0.084543&amp;ie=UTF8&amp;hq=&amp;hnear=385+Ho%C3%A0ng+Qu%E1%BB%91c+Vi%E1%BB%87t,+Ngh%C4%A9a+T%C3%A2n,+C%E1%BA%A7u+Gi%E1%BA%A5y,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;t=m&amp;ll=21.046055,105.793018&amp;spn=0.036047,0.040255&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Xem Bản đồ cỡ lớn hơn</a></small>',
        "type" => "textarea"),
    array("type" => "close"),
);

$fields = array(
    "keywords_meta", "description_meta", "favicon", "sitelogo",
    "bg_about", "bg_course", "bg_event", "bg_news", "bg_sagecafe", "bg_contact"
);

/**
 * Add actions
 */
add_action('admin_init', 'theme_settings_init');
add_action('admin_menu', 'add_settings_page');

/**
 * Register settings
 */
function theme_settings_init(){
    register_setting( "theme_settings", "theme_settings");
}

/**
 * Add settings page menu
 */
function add_settings_page(){
    global $themename, $shortname, $menuname, $options, $fields;
    
    add_menu_page(__($themename . ' Settings'), // Page title
            __($themename.' Settings'), // Menu title
            'manage_options', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            $menuname, // menu id - Unique id of the menu
            'theme_settings_page',// render output function
            '', // URL icon, if empty default icon
            null // Menu position - integer, if null default last of menu list
        );
    
    //Add submenu page
    add_submenu_page($menuname, //Menu ID – Defines the unique id of the menu that we want to link our submenu to. 
                                    //To link our submenu to a custom post type page we must specify - 
                                    //edit.php?post_type=my_post_type
            __('Theme Options'), // Page title
            __('Theme Options'), // Menu title
            'manage_options', // Capability - see: http://codex.wordpress.org/Roles_and_Capabilities#Capabilities
            'theme_options', // Submenu ID – Unique id of the submenu.
            'theme_options_page' // render output function
        );
    
    //add_theme_page("$themename Options", "$themename Options", 'edit_themes', 'theme_options', 'theme_options_page');

    /*-------------------------------------------------------------------------*/
    # Theme general settings
    /*-------------------------------------------------------------------------*/
    if ($_GET['page'] == $shortname . '_settings') {
        if (isset($_REQUEST['action']) and 'save' == $_REQUEST['action']) {
            foreach ($fields as $field) {
                update_option($field, $_REQUEST[$field]);
            }
            foreach ($fields as $field) {
                if (isset($_REQUEST[$field])) {
                    update_option($field, $_REQUEST[$field]);
                } else {
                    delete_option($field);
                }
            }
            header("Location: {$_SERVER['REQUEST_URI']}&saved=true");
            die();
        } 
    }
    /*-------------------------------------------------------------------------*/
    # Theme options processing
    /*-------------------------------------------------------------------------*/
    if ($_GET['page'] == 'theme_options') {
        if (isset($_REQUEST['action']) and 'save' == $_REQUEST['action']) {
            foreach ($options as $value) {
                update_option($value['id'], $_REQUEST[$value['id']]);
            }
            foreach ($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            header("Location: {$_SERVER['REQUEST_URI']}&saved=true");
            die();
        } else if (isset($_REQUEST['action']) and 'reset' == $_REQUEST['action']) {
            foreach ($options as $value) {
                delete_option($value['id']);
                update_option($value['id'], $value['std']);
            }
            header("Location: {$_SERVER['REQUEST_URI']}&reset=true");
            die();
        }
    }
    
    /*-------------------------------------------------------------------------*/
    # Retitle for first sub-menu
    /*-------------------------------------------------------------------------*/
    global $submenu;
    if(isset($submenu[$shortname . '_settings'][0][0]) and $submenu[$shortname . '_settings'][0][0] == $themename . ' Settings'){
        $submenu[$shortname . '_settings'][0][0] = 'General Settings';
    }
}

/**
 * Remove an Existing Sub-Menu
 */
function remove_settings_submenu($menu_name, $submenu_name) {
    global $submenu;
    $menu = $submenu[$menu_name];
    if (!is_array($menu)) return;
    foreach ($menu as $submenu_key => $submenu_object) {
        if (in_array($submenu_name, $submenu_object)) {// remove menu object
            unset($submenu[$menu_name][$submenu_key]);
            return;
        }
    }          
}

/**
 * Theme general settings ouput
 * 
 * @global string $themename
 */
function theme_settings_page() {
    global $themename;
?>
    <div class="wrap">
        <div class="opwrap" style="margin-top: 10px;" >
            <h2 class="wraphead" style="margin:10px 0px; padding:15px 10px; font-family:arial black; font-style:normal; background:#B3D5EF;"><b><?php echo $themename; ?> theme general settings</b></h2>
    <?php
    if (isset($_REQUEST['saved']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';
    ?>
            <form method="post">
                <h3>Site Options</h3>
                <table class="form-table">
                    <tr>
                        <th><label for="keywords_meta">Keywords meta</label></th>
                        <td>
                            <input type="text" name="keywords_meta" id="keywords_meta" value="<?php echo stripslashes(get_settings('keywords_meta'));?>" class="regular-text" />
                            <br />
                            <span class="description">Enter the meta keywords for all pages. These are used by search engines to index your pages with more relevance.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="description_meta">Description meta</label></th>
                        <td>
                            <input type="text" name="description_meta" id="description_meta" value="<?php echo stripslashes(get_settings('description_meta'));?>" class="regular-text" />
                            <br />
                            <span class="description">Enter the meta description for all pages. This is used by search engines to index your pages more relevantly.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="favicon">Favicon</label></th>
                        <td>
                            <input type="text" name="favicon" id="favicon" value="<?php echo stripslashes(get_settings('favicon'));?>" class="regular-text" />
                            <input type="button" id="upload_favicon_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">An icon associated with a particular website, and typically displayed in the address bar of a browser viewing the site.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="sitelogo">Logo</label></th>
                        <td>
                            <input type="text" name="sitelogo" id="sitelogo" value="<?php echo stripslashes(get_settings('sitelogo'));?>" class="regular-text" />
                            <input type="button" id="upload_sitelogo_button" class="button button-upload" value="Upload" /><br />
                            <span class="description">Logo of the site.</span>
                        </td>
                    </tr>
                </table>
                <h3>Background Options</h3>
                <table class="form-table">
                    <tr>
                        <th><label for="bg_about">About Us</label></th>
                        <td>
                            <input type="text" name="bg_about" id="bg_about" value="<?php echo stripslashes(get_settings('bg_about'));?>" class="regular-text" />
                            <input type="button" id="upload_bg_about_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">Background of about page. Size: 1600x150</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bg_course">Khóa học</label></th>
                        <td>
                            <input type="text" name="bg_course" id="bg_course" value="<?php echo stripslashes(get_settings('bg_course'));?>" class="regular-text" />
                            <input type="button" id="upload_bg_course_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">Hình nền các trang khóa học. Size: 1600x150</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bg_event">Sự kiện</label></th>
                        <td>
                            <input type="text" name="bg_event" id="bg_event" value="<?php echo stripslashes(get_settings('bg_event'));?>" class="regular-text" />
                            <input type="button" id="upload_bg_event_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">Hình nền các trang sự kiện. Size: 1600x150</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bg_news">Tin tức</label></th>
                        <td>
                            <input type="text" name="bg_news" id="bg_news" value="<?php echo stripslashes(get_settings('bg_news'));?>" class="regular-text" />
                            <input type="button" id="upload_bg_news_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">Hình nền các trang tin tức. Size: 1600x150</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="bg_contact">Liên hệ</label></th>
                        <td>
                            <input type="text" name="bg_contact" id="bg_contact" value="<?php echo stripslashes(get_settings('bg_contact'));?>" class="regular-text" />
                            <input type="button" id="upload_bg_contact_button" class="button button-upload" value="Upload" />
                            <br />
                            <span class="description">Hình nền trang liên hệ. Size: 1600x500</span>
                        </td>
                    </tr>
                </table>
                <div class="submit">
                    <input name="save" type="submit" value="Save changes" class="button button-large button-primary" />
                    <input type="hidden" name="action" value="save" />
                </div>
            </form>
        </div>
    </div>
<?php
}

/**
 * Theme options ouput
 * 
 * @global string $themename
 * @global array $options
 */
function theme_options_page(){
    global $themename, $options;
?>
    <div class="wrap">
        <div class="opwrap" style="background:#fff; margin:20px auto; width: 80%;" >
            <h2 class="wraphead" style="margin:10px 0px; padding:15px 10px; font-family:arial black; font-style:normal; background:#B3D5EF;"><b><?php echo $themename; ?> theme options</b></h2>
    <?php
    if (isset($_REQUEST['saved']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings saved.</strong></p></div>';
    if (isset($_REQUEST['reset']))
        echo '<div id="message" class="updated fade"><p><strong>' . $themename . ' settings reset.</strong></p></div>';
    ?>
            <form method="post">
    <?php
    foreach ($options as $value) {
        switch ($value['type']) {
            case "image":
                ?>
                            <tr>
                                <td width="30%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                <td width="70%"><img src="<?php echo $value['id']; ?>" /></td>
                            </tr>
                            <tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case "open":
                ?>
                            <table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">
                <?php
                break;
            case "close":
                ?>
                            </table><br />
                <?php
                break;
            case "break":
                ?>
                            <tr><td colspan="2" style="border-top:1px solid #C2DCEF;">&nbsp;</td></tr>
                <?php
                break;
            case "title":
                ?>
                            <table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>
                                    <td colspan="2"><h3 style="font-size:18px;font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
                                </tr>
                <?php
                break;
            case 'text':
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (get_settings($value['id']) != "") {
                    echo get_settings($value['id']);
                } else {
                    echo $value['std'];
                } ?>" /></td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case 'textarea':
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if (get_settings($value['id']) != "") {
                    echo stripslashes(get_settings($value['id']));
                } else {
                    echo $value['std'];
                } ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case 'select':
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                                        <?php foreach ($value['options'] as $key => $option) { ?>
                                            <option<?php if (get_settings($value['id']) == $key) {
                        echo ' selected="selected"';
                    } elseif ($key == $value['std']) {
                        echo ' selected="selected"';
                        } ?> value="<?php echo $key;?>"><?php echo $option; ?></option><?php } ?></select></td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
            case "checkbox":
                ?>
                                <tr>
                                    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                                    <td width="80%"><? if (get_settings($value['id'])) {
                    $checked = "checked=\"checked\"";
                } else {
                    $checked = "";
                } ?>
                                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                                    </td>
                                </tr>
                                <tr>
                                    <td><small><?php echo $value['desc']; ?></small></td>
                                </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ffffff;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
                <?php
                break;
        }
    }
    ?>
                <p class="submit">
                    <input name="save" type="submit" value="Save changes" class="button button-large button-primary" />
                    <input type="hidden" name="action" value="save" />
                </p>
            </form>
            <form method="post">
                <input name="reset" type="submit" value="Reset" class="button button-large" />
                <input type="hidden" name="action" value="reset" />
            </form>
        </div>
    </div>
<?php
}