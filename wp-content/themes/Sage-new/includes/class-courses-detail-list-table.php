<?php
if (!class_exists('WP_List_Table'))
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class WPCourses_Detail_List_Table extends WP_List_Table {

    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */
    function __construct() {
        parent::__construct(array(
            'singular' => 'wp_courses_detail', //Singular label
            'plural' => 'wp_courses_details', //plural label, also this well be one of the table css class
            'ajax' => false //We won't support Ajax for this table
        ));
    }

    /**
     * Add extra markup in the toolbars before or after the list
     * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
     */
    function extra_tablenav($which) {
        if ($which == "top") {
            //The code that goes before the table is here
            echo "<h3>Danh sách đại biểu:</h3>";
        }
        if ($which == "bottom") {
            $course_id = intval($_GET['course_id']);
            $deleteLink = '?page=nvt_courses&action=delete&course_id=' . $course_id;
            
            echo '<br/>';
            echo '<a class="button" onclick="return confirm(\'Bạn có chắc chắn không?\')" href="' . $deleteLink . '">Xóa</a>';
        }
    }

    /**
     * Define the columns that are going to be used in the table
     * @return array $columns, the array of columns to use with the table
     */
    function get_columns() {
        return $columns = array(
            'col_courses_stt' => __('STT', SHORT_NAME),
            'col_courses_fullname' => __('Họ và tên', SHORT_NAME),
            'col_courses_email' => __('Địa chỉ Email', SHORT_NAME),
            'col_courses_phone' => __('Điện thoại', SHORT_NAME),
            'col_courses_company' => __('Công ty', SHORT_NAME),
            'col_courses_position' => __('Chức vụ', SHORT_NAME),
        );
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    function prepare_items() {
        global $wpdb;
        $tblCourses = $wpdb->prefix . 'courses';
        $order_id = intval($_GET['course_id']);
        
        /* -- Preparing your query -- */
        $query = "SELECT * FROM $tblCourses WHERE ID = $order_id ";

        /* -- Register the Columns -- */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();
        $this->_column_headers = array($columns, $hidden, $sortable);

        /* -- Fetch the items -- */
        $coursesRow = $wpdb->get_row($query);
        $generalInfo = json_decode($coursesRow->general_info);
        $contactInfo = json_decode($coursesRow->contact_info);
        $orderDate = date('d-m-Y', strtotime($coursesRow->created_at));
        $course_name = get_the_title($generalInfo->course_id);
        $this->items = json_decode($coursesRow->delegate_info);
        
        echo <<<HTML
        <h3>Khóa học: {$course_name}</h3>
        <h3>Ngày đăng ký: {$orderDate}</h3>
        <h3>Thông tin liên hệ:</h3>
        <table>
            <tr>
                <td width="240">Họ và Tên:</td>
                <td>{$contactInfo->salutation} {$contactInfo->fullname}</td>
            </tr>
            <tr>
                <td>Địa chỉ Email:</td>
                <td>{$contactInfo->email}</td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td>{$contactInfo->phone}</td>
            </tr>
            <tr>
                <td width="100">Công ty:</td>
                <td>{$contactInfo->company}</td>
            </tr>
            <tr>
                <td>Chức vụ:</td>
                <td>{$contactInfo->position}</td>
            </tr>
            <tr>
                <td>Lĩnh vực/Ngành nghề:</td>
                <td>{$contactInfo->nature_of_business}</td>
            </tr>
            <tr>
                <td>Biết tới khóa học này qua nguồn:</td>
                <td>{$contactInfo->how_do_you_know}</td>
            </tr>
        </table>
HTML;
    }

    /**
     * Display the rows of records in the table
     * @return string, echo the markup of the rows
     */
    function display_rows() {

        //Get the records registered in the prepare_items method
        $records = $this->items;

        //Get the columns registered in the get_columns and get_sortable_columns methods
        list( $columns, $hidden ) = $this->get_column_info();

        //Loop for each record
        if (!empty($records)) {
            $count = 1;
            foreach ($records as $rec) {

                //Open the line
                echo '<tr id="record_' . $rec->id . '">';
                foreach ($columns as $column_name => $column_display_name) {

                    //Style attributes for each col
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if (in_array($column_name, $hidden))
                        $style = ' style="display:none;"';
                    $attributes = $class . $style;

                    //Display the cell
                    switch ($column_name) {
                        case "col_courses_stt": echo '<td ' . $attributes . '>' . $count . '</td>';
                            break;
                        case "col_courses_fullname": echo '<td ' . $attributes . '>' . $rec->fullname . '</td>';
                            break;
                        case "col_courses_email": echo '<td ' . $attributes . '>' . $rec->email . '</td>';
                            break;
                        case "col_courses_phone": echo '<td ' . $attributes . '>' . $rec->phone . '</td>';
                            break;
                        case "col_courses_company": echo '<td ' . $attributes . '>' . $rec->company . '</td>';
                            break;
                        case "col_courses_position": echo '<td ' . $attributes . '>' . $rec->position . '</td>';
                            break;
                    }
                }

                //Close the line
                echo'</tr>';
                $count++;
            }
        }
    }

}