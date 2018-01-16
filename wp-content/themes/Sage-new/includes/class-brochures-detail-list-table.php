<?php
if (!class_exists('WP_List_Table'))
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class WPBrochures_Detail_List_Table extends WP_List_Table {

    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */
    function __construct() {
        parent::__construct(array(
            'singular' => 'wp_brochures_detail', //Singular label
            'plural' => 'wp_brochures_details', //plural label, also this well be one of the table css class
            'ajax' => false //We won't support Ajax for this table
        ));
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    function prepare_items() {
        global $wpdb;
        $tblBrochures = $wpdb->prefix . 'brochures';
        $brochure_id = intval($_GET['brochure_id']);
        
        /* -- Preparing your query -- */
        $query = "SELECT * FROM $tblBrochures WHERE ID = $brochure_id ";

        /* -- Register the Columns -- */
        $columns = array();
        $hidden = array();
        $sortable = array();
        $this->_column_headers = array($columns, $hidden, $sortable);

        /* -- Fetch the items -- */
        $brochuresRow = $wpdb->get_row($query);
        $orderDate = date('d-m-Y', strtotime($brochuresRow->created_at));
        $brochure_name = get_the_title($brochuresRow->course_id);
        $this->items = array();
        
        $deleteLink = '?page=nvt_brochures&action=delete&brochure_id=' . $brochure_id;

        echo <<<HTML
        <h3>Khóa học: {$brochure_name}</h3>
        <h3>Ngày đăng ký: {$orderDate}</h3>
        <h3>Thông tin liên hệ:</h3>
        <table>
            <tr>
                <td width="100">Họ và Tên:</td>
                <td>{$brochuresRow->salutation} {$brochuresRow->fullname}</td>
            </tr>
            <tr>
                <td>Địa chỉ Email:</td>
                <td>{$brochuresRow->email}</td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td>{$brochuresRow->phone}</td>
            </tr>
            <tr>
                <td>Công ty:</td>
                <td>{$brochuresRow->company}</td>
            </tr>
            <tr>
                <td>Chức vụ:</td>
                <td>{$brochuresRow->position}</td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td>{$brochuresRow->address}</td>
            </tr>
            <tr>
                <td>Zip/Postal Code:</td>
                <td>{$brochuresRow->zip_code}</td>
            </tr>
            <tr>
                <td>Quốc gia:</td>
                <td>{$brochuresRow->country}</td>
            </tr>
            <tr>
                <td>Lời nhắn:</td>
                <td>{$brochuresRow->comments}</td>
            </tr>
        </table>
        <br /><br />
        <a class="button" onclick="return confirm('Bạn có chắc chắn không?')" href="{$deleteLink}">Xóa</a>
HTML;
    }

}