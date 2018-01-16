<?php
include('../../../wp-load.php');
if (isset($_POST['datefrom']) && isset($_POST['dateto']) && isset($_POST['cate_course'])) {
    $dateform = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $calendar_category = $_POST['cate_course'];
    $tax_query = array();
    if ($calendar_category != "all") {
        $tax_query[] = array(
            'taxonomy' => 'calendar-category',
            'field' => 'id',
            'terms' => $calendar_category
        );
    }
    ?>	
    <div class="lh_home" id="search-course">
    <?php
    $datef = explode("/", $dateform);
    $datet = explode("/", $dateto);
    $datefromFinal = $datef[2] . '-' . get_mount_number($datef[1]) . '-' . $datef[0];
    $datetoFinal = $datet[2] . '-' . get_mount_number($datet[1]) . '-' . $datet[0];

    //------------------------------
    $loop_lh = new WP_Query(array(
        'meta_key' => 'date_to_open_course',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'post_type' => 'courses',
        'tax_query' => $tax_query,
        'meta_query' => array(
            array(
                'key' => 'date_to_open_course',
                'value' => array($datefromFinal, $datetoFinal),
                'type' => 'DATE',
                'compare' => 'BETWEEN'
            )
        )
    ));
    if (!($loop_lh->have_posts())) {
        echo '<h3 class="no-course">Không tìm thấy khóa học nào phù hợp</h3>';
    } else {
        ?>
        <h3 class="no-course"><?php _e('Kết quả tìm kiếm khóa học', SHORT_NAME) ?></h3>
            <table class="lh_table">
                <thead>
                    <tr>
                        <th style="width:30px;">STT</th>
                        <th class="lh_t1"><?php _e('Khóa học', SHORT_NAME) ?></th>
                        <th class="lh_t2"><?php _e('Khai giảng', SHORT_NAME) ?></th>
                        <th class="lh_t3"><?php _e('Địa điểm', SHORT_NAME) ?></th>
                    </tr>						
                </thead>
                <tbody>
        <?php
    }
    $stt = 1;
    while ($loop_lh->have_posts()) : $loop_lh->the_post();
        echo '<tr>';
        echo '<td style="text-align:center;"><span>'.$stt.'</span></td>';
        echo '<td>';
        echo '<a href="'.  get_the_permalink().'">';
        the_title();
        echo '</a>';
        echo '</td>';
        echo '<td>';
        $date = new DateTime(get_field('date_to_open_course', get_the_ID()));
        echo $date->format('d/m/Y');
        echo '</td>';
        echo '<td>';
        echo get_field( "dia_diem_hoc_course", get_the_ID());
        echo '</td>';
        echo '</tr>';
        $stt++;
    endwhile;
    ?>
            </tbody>
        </table>					
        <div class="clrb"></div>				
    </div>
<?php
}