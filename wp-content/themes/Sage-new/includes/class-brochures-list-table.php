<?php
if (!class_exists('WP_List_Table'))
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class WPBrochures_List_Table extends WP_List_Table {

    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */
    function __construct() {
        parent::__construct(array(
            'singular' => 'wp_list_brochure', //Singular label
            'plural' => 'wp_list_brochures', //plural label, also this well be one of the table css class
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
            //echo"Hello, I'm before the table";
        }
        if ($which == "bottom") {
            //The code that goes after the table is there
            //echo"Hi, I'm after the table";
        }
    }

    /**
     * Define the columns that are going to be used in the table
     * @return array $columns, the array of columns to use with the table
     */
    function get_columns() {
        return $columns = array(
            'col_brochures_cb' => '<input type="checkbox" class="cb-brochures-select-all" />',
            'col_brochures_id' => __('ID', SHORT_NAME),
            'col_brochures_course' => __('Khóa học', SHORT_NAME),
            'col_brochures_company' => __('Công ty', SHORT_NAME),
            'col_brochures_date' => __('Ngày', SHORT_NAME),
            'col_brochures_options' => __('Tùy chọn', SHORT_NAME)
        );
    }

    /**
     * Decide which columns to activate the sorting functionality on
     * @return array $sortable, the array of columns that can be sorted by the user
     */
    public function get_sortable_columns() {
        return $sortable = array(
            'col_brochures_id' => array('ID', true),
            'col_brochures_date' => array('created_at', false),
        );
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    function prepare_items() {
        global $wpdb;
        $screen = get_current_screen();
        $tblBrochures = $wpdb->prefix . 'brochures';

        $this->process_bulk_action();
        
        // Delete row
        if (isset($_GET['action'])) {
            $act = $_GET['action'];
            $brochure_id = intval($_GET['brochure_id']);
            switch ($act) {
                case "delete":
                    $query = "DELETE FROM $tblBrochures WHERE ID = $brochure_id";
                    $wpdb->query($query);
                    break;
                default:
                    break;
            }
            header("location: ?page=nvt_brochures");
            exit();
        }

        /* -- Preparing your query -- */
        $query = "SELECT $tblBrochures.* FROM $tblBrochures ";
        
        // Search by keyword
        if(isset($_REQUEST['s']) and !empty($_REQUEST['s'])){
            $search_query = esc_sql($_REQUEST['s']);
            if(strpos($query, "WHERE") !== FALSE){
                $query .= " AND (fullname LIKE '%$search_query%' OR email LIKE '%$search_query%' OR company LIKE '%$search_query%')";
            } else {
                $query .= " WHERE fullname LIKE '%$search_query%' OR email LIKE '%$search_query%' OR company LIKE '%$search_query%'";
            }
        }

        /* -- Brochureing parameters -- */
        //Parameters that are going to be used to order the result
        $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ID';
        $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : 'DESC';
        if (!empty($orderby) & !empty($order)) {
            $query.=' ORDER BY ' . $orderby . ' ' . $order;
        }

        /* -- Pagination parameters -- */
        //Number of elements in your table?
        $totalitems = $wpdb->query($query); //return the total number of affected rows
        //How many to display per page?
        $perpage = 20;
        //Which page is this?
        //$paged = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';
        $paged = $this->get_pagenum();
        //Page Number
        if (empty($paged) || !is_numeric($paged) || $paged <= 0) {
            $paged = 1;
        }
        //How many pages do we have in total?
        $totalpages = ceil($totalitems / $perpage);
        //adjust the query to take pagination into account
        if (!empty($paged) && !empty($perpage)) {
            $offset = ($paged - 1) * $perpage;
            $query.=' LIMIT ' . (int) $offset . ',' . (int) $perpage;
        }

        /* -- Register the pagination -- */
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page" => $perpage,
        ));
        //The pagination links are automatically built according to those parameters

        /* -- Register the Columns -- */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        /* -- Fetch the items -- */
        $this->items = $wpdb->get_results($query);
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
            foreach ($records as $rec) {

                //Open the line
                echo '<tr id="record_' . $rec->ID . '">';
                foreach ($columns as $column_name => $column_display_name) {

                    //Style attributes for each col
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if (in_array($column_name, $hidden))
                        $style = ' style="display:none;"';
                    $attributes = $class . $style;
                    
                    //links
                    $viewlink = '?page=nvt_brochures&action=view-detail&brochure_id=' . (int) $rec->ID;
                    $deleteLink = '?page=nvt_brochures&action=delete&brochure_id=' . (int) $rec->ID;
                        
                    //Display the cell
                    switch ($column_name) {
                        case "col_brochures_cb": echo '<th ' . $attributes . '>' . $this->column_cb($rec) . '</th>';
                            break;
                        case "col_brochures_id": echo '<td ' . $attributes . '>' . $rec->ID . '</td>';
                            break;
                        case "col_brochures_course":
                            echo '<td ' . $attributes . '>' . get_the_title($rec->course_id) . '</td>';
                            break;
                        case "col_brochures_company": echo '<td ' . $attributes . '>' . $rec->company . '</td>';
                            break;
                        case "col_brochures_date": echo '<td ' . $attributes . '>' . $rec->created_at . '</td>';
                            break;
                        case "col_brochures_options":
                            echo '<td ' . $attributes . '>';
                            echo '<a href="' . $viewlink . '">Xem</a> | <a onclick="return confirm(\'Bạn có chắc chắn không?\')" href="' . $deleteLink . '">Xóa</a>';
                            echo '</td>';
                            break;
                    }
                }

                //Close the line
                echo'</tr>';
            }
        }
    }

    function get_bulk_actions() {
        $actions = array(
            'delete' => __('Xóa', SHORT_NAME),
        );

        return $actions;
    }

    function process_bulk_action() {
        global $wpdb;
        $tblBrochures = $wpdb->prefix . 'brochures';

        // security check!
        if (isset($_POST['_wpnonce']) && !empty($_POST['_wpnonce'])) {
            $nonce = filter_input(INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING);
            $action = 'bulk-' . $this->_args['plural'];

            if (!wp_verify_nonce($nonce, $action))
                wp_die('Nope! Security check failed!');
        }

        $action = $this->current_action();
        $wp_list_brochures = getRequest('wp_list_brochure');
        if(is_array($wp_list_brochures)){
            switch ($action) {
                case "delete":
                    foreach ($wp_list_brochures as $id) {
                        $query = "DELETE FROM $tblBrochures WHERE ID = $id";
                        $wpdb->query($query);
                    }
                    break;
                default:
                    break;
            }
        }

        return;
    }

    function column_default($item, $column_name) {
        return '';
    }

    function column_cb($item) {
        return sprintf('<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item->ID);
    }

}

################################################################################
add_action('admin_print_footer_scripts', 'brochures_bulk_actions_select_all', 99);

function brochures_bulk_actions_select_all() {
    echo <<<HTML
<style type="text/css">
    #col_brochures_cb{width: 30px;}
    #col_brochures_id{width: 50px;}
</style>
<script type="text/javascript">/* <![CDATA[ */
jQuery(function($){
    $("input.cb-brochures-select-all").click(function(){
        if($(this).is(':checked')){
            $("input[name='wp_list_brochure[]']").attr('checked', 'checked');
            $("input.cb-brochures-select-all").attr('checked', 'checked');
        }else{
            $("input[name='wp_list_brochure[]']").removeAttr('checked');
            $("input.cb-brochures-select-all").removeAttr('checked');
        }
    });
    $("form#ppo-brochures-form").submit(function(){
        var str_query = $("#search-submit").prev().val().trim();
        if(str_query.length > 0){
            window.location = window.location.href + "&s=" + str_query;
            return false;
        }
    });
});
/* ]]> */
</script>
HTML;
}