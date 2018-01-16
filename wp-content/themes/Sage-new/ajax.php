<?php

add_action('wp_ajax_nopriv_' . getRequest('action'), getRequest('action'));
add_action('wp_ajax_' . getRequest('action'), getRequest('action'));
add_action( 'wp_enqueue_scripts', 'ppoajax_enqueue_scripts' );

/**
 * Enqueue scripts and styles for the front end.
 */
function ppoajax_enqueue_scripts() {
    if(!is_admin()){
        wp_enqueue_script('ajax.js', get_bloginfo('template_directory') . "/js/ajax.js", array('jquery'), false, true);
    }
}

/**
 * Register Course
 * @global type $wpdb
 */
function register_course() {
    $generalInfo = json_encode(array(
        'course_id' => getRequest('course_id'),
    ));
    $contactInfo = json_encode(array(
        'salutation' => getRequest('salutation_contact'),
        'fullname' => getRequest('fullname_contact'),
        'email' => getRequest('email_contact'),
        'phone' => getRequest('phone_contact'),
        'company' => getRequest('company_contact'),
        'position' => getRequest('position_contact'),
        'nature_of_business' => getRequest('nature_of_business'),
        'how_do_you_know' => getRequest('how_do_you_know'),
    ));
    $delegateInfo = array();
    $salutation = getRequest('salutation');
    $fullname = getRequest('fullname');
    $email = getRequest('email');
    $phone = getRequest('phone');
    $company = getRequest('company');
    $position = getRequest('position');
    for($i = 0; $i < count($salutation); $i++){
        $delegateInfo[] = array(
            'salutation' => $salutation[$i],
            'fullname' => $fullname[$i],
            'email' => $email[$i],
            'phone' => $phone[$i],
            'company' => $company[$i],
            'position' => $position[$i],
        );
    }
    $delegateInfo = json_encode($delegateInfo);

    global $wpdb;
    $tblCourses = $wpdb->prefix . 'courses';
    $result = $wpdb->query($wpdb->prepare("INSERT INTO $tblCourses SET general_info = '%s', contact_info = '%s', delegate_info = '%s'", 
                    $generalInfo, $contactInfo, $delegateInfo));
    if($result){
        sendMailRegisterCourse($generalInfo, $contactInfo, $delegateInfo);
        echo get_page_link(get_option("sage_pageRegCourseSuccessID"));
    }
    exit;
}

function request_brochure() {
    $course_id = getRequest('course_id');
    $salutation = getRequest('salutation');
    $fullname = getRequest('fullname');
    $email = getRequest('email');
    $phone = getRequest('phone');
    $company = getRequest('company');
    $position = getRequest('position');
    $address = getRequest('address');
    $zip_code = getRequest('zip_code');
    $country = getRequest('country');
    $comments = getRequest('comments');
    $msg = "";
    if(empty($course_id)){
        $msg = __("Vui lòng chọn 1 Khóa học!", SHORT_NAME);
    } elseif (empty ($salutation)) {
        $msg = __("Vui lòng chọn Quý danh!", SHORT_NAME);
    } elseif (empty ($fullname)) {
        $msg = __("Vui lòng nhập họ tên!", SHORT_NAME);
    } elseif (empty ($email)) {
        $msg = __("Vui lòng nhập địa chỉ Email!", SHORT_NAME);
    } elseif (!is_email ($email)) {
        $msg = __("Vui lòng nhập địa chỉ Email hợp lệ!", SHORT_NAME);
    } elseif (empty ($phone)) {
        $msg = __("Vui lòng nhập số điện thoại!", SHORT_NAME);
    } elseif (empty ($company)) {
        $msg = __("Vui lòng nhập công ty bạn đang làm việc!", SHORT_NAME);
    } elseif (empty ($country)) {
        $msg = __("Vui lòng chọn Quốc gia bạn đang sinh sống!", SHORT_NAME);
    }
    
    if(empty($msg)){
        $customer = array(
            'course_id' => $course_id,
            'salutation' => $salutation,
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'company' => $company,
            'position' => $position,
            'address' => $address,
            'zip_code' => $zip_code,
            'country' => $country,
            'comments' => $comments,
        );
        
        global $wpdb;
        $tblBrochures = $wpdb->prefix . 'brochures';
        $result = $wpdb->query($wpdb->prepare("INSERT INTO $tblBrochures SET course_id = '%d', salutation = '%s', fullname = '%s',
                email='%s', phone='%s', company='%s', position='%s', address='%s', zip_code='%s', country='%s', comments='%s'", 
                        $course_id, $salutation, $fullname, $email, $phone, $company, $position, $address, $zip_code, $country, $comments));
        if($result){
            sendMailRequestBrochure($customer);
            echo json_encode(array(
                'status' => 'success',
                'url' => get_page_link(get_option("sage_pageBrochureSuccessID")),
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'msg' => __("Gửi yêu cầu lỗi, vui lòng liên hệ với chúng tôi qua ", SHORT_NAME) . get_settings('admin_email'),
            ));
        }
    } else {
        echo json_encode(array(
                'status' => 'error',
                'msg' => $msg,
            ));
    }
    exit;
}

function request_be_our_trainer() {
    $salutation = getRequest('salutation');
    $fullname = getRequest('fullname');
    $email = getRequest('email');
    $phone = getRequest('phone');
    $company = getRequest('company');
    $position = getRequest('position');
    $address = getRequest('address');
    $zip_code = getRequest('zip_code');
    $country = getRequest('country');
    $comments = getRequest('comments');
    $msg = "";
    if (empty ($salutation)) {
        $msg = __("Vui lòng chọn Quý danh!", SHORT_NAME);
    } elseif (empty ($fullname)) {
        $msg = __("Vui lòng nhập họ tên!", SHORT_NAME);
    } elseif (empty ($email)) {
        $msg = __("Vui lòng nhập địa chỉ Email!", SHORT_NAME);
    } elseif (!is_email ($email)) {
        $msg = __("Vui lòng nhập địa chỉ Email hợp lệ!", SHORT_NAME);
    } elseif (empty ($phone)) {
        $msg = __("Vui lòng nhập số điện thoại!", SHORT_NAME);
    } elseif (empty ($company)) {
        $msg = __("Vui lòng nhập công ty bạn đang làm việc!", SHORT_NAME);
    } elseif (empty ($country)) {
        $msg = __("Vui lòng chọn Quốc gia bạn đang sinh sống!", SHORT_NAME);
    }
    
    if(empty($msg)){
        $trainer = array(
            'salutation' => $salutation,
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'company' => $company,
            'position' => $position,
            'address' => $address,
            'zip_code' => $zip_code,
            'country' => $country,
            'comments' => $comments,
        );
        
        sendMailBeOurTrainer($trainer);
        echo json_encode(array(
            'status' => 'success',
            'msg' => __("Gửi đơn thành công!", SHORT_NAME),
        ));
    } else {
        echo json_encode(array(
                'status' => 'error',
                'msg' => $msg,
            ));
    }
    exit;
}

function request_be_our_partner() {
    $salutation = getRequest('salutation');
    $fullname = getRequest('fullname');
    $email = getRequest('email');
    $phone = getRequest('phone');
    $company = getRequest('company');
    $position = getRequest('position');
    $address = getRequest('address');
    $zip_code = getRequest('zip_code');
    $country = getRequest('country');
    $comments = getRequest('comments');
    $msg = "";
    if (empty ($salutation)) {
        $msg = __("Vui lòng chọn Quý danh!", SHORT_NAME);
    } elseif (empty ($fullname)) {
        $msg = __("Vui lòng nhập họ tên!", SHORT_NAME);
    } elseif (empty ($email)) {
        $msg = __("Vui lòng nhập địa chỉ Email!", SHORT_NAME);
    } elseif (!is_email ($email)) {
        $msg = __("Vui lòng nhập địa chỉ Email hợp lệ!", SHORT_NAME);
    } elseif (empty ($phone)) {
        $msg = __("Vui lòng nhập số điện thoại!", SHORT_NAME);
    } elseif (empty ($company)) {
        $msg = __("Vui lòng nhập công ty bạn đang làm việc!", SHORT_NAME);
    } elseif (empty ($country)) {
        $msg = __("Vui lòng chọn Quốc gia bạn đang sinh sống!", SHORT_NAME);
    }
    
    if(empty($msg)){
        $partner = array(
            'salutation' => $salutation,
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'company' => $company,
            'position' => $position,
            'address' => $address,
            'zip_code' => $zip_code,
            'country' => $country,
            'comments' => $comments,
        );
        
        sendMailBeOurPartner($partner);
        echo json_encode(array(
            'status' => 'success',
            'msg' => __("Gửi thư thành công!", SHORT_NAME),
        ));
    } else {
        echo json_encode(array(
                'status' => 'error',
                'msg' => $msg,
            ));
    }
    exit;
}