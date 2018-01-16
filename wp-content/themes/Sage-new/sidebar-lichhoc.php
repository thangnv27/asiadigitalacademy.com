<div class="right">
    <?php include 'box-hotline.php'; ?>    

    <link href="<?php echo get_stylesheet_directory_uri() . '/js/datetimepicker/jquery.datetimepicker.css' ?>" rel="stylesheet">    
    <script src="<?php echo get_stylesheet_directory_uri() . '/js/datetimepicker/jquery.datetimepicker.js' ?>"></script>
    <div class="search-course">
        <div class="title-box-search"><?php _e('Tìm khóa học', SHORT_NAME) ?></div>        
        <div class="content-s-course">
            <div class="s-from" id="s-from">
                <p><?php _e('Từ ngày', SHORT_NAME) ?></p>
                <span id="date-from">09</span>
                <div class="bl-year-month">
                    <p class="d1">Dec</p>
                    <p class="y1"><?php echo date('Y') ?></p>
                </div>
                <a class="date-picker" id="date-from-pick" href="javascript:void(0);">&nbsp;</a> 
                <input type="text"  id="date-hidden-from" value="02/12/2012"></input>				
            </div>
            <div class="s-to" id="s-to">
                <p><?php _e('Đến ngày', SHORT_NAME) ?></p>
                <span id="date-to">09</span>
                <div class="bl-year-month">
                    <p class="d2">Dec</p>
                    <p class="y2"><?php echo date('Y') ?></p>
                </div>
                <a class="date-picker" id="date-to-pick" href="javascript:void(0);">&nbsp;</a>
                <input type="text" id="date-hidden-to" value="02/12/2012"></input>
            </div>
            <select id="select-course">
                <option value="all"><?php _e('Tất cả các khóa học', SHORT_NAME) ?></option>
                <?php
                $categories = get_categories('taxonomy=courses_category&type=courses');
                foreach ($categories as $category) {
                    echo '<option value="' . $category->term_id . '">';
                    echo $category->name;
                    echo '</option>';
                }
                ?>
            </select>
            <button class="reset_form_searh"><?php _e('Xóa lựa chọn', SHORT_NAME) ?></button>
            <button class="submit_search"><?php _e('Tìm khóa học', SHORT_NAME) ?></button>
        </div>

        <script type="text/javascript">
            jQuery("#date-from-pick").click(function ()
            {
                jQuery('#date-hidden-from').datetimepicker('show'); //support hide,show and destroy command
                return false;
            });
            jQuery('#date-hidden-from').datetimepicker({
                format: 'd/F/Y',
                lang: 'en',
                timepicker: false,
                onChangeDateTime: function (dp, $input) {
                    var date_from = $input.val();
                    var res = date_from.split("/");
                    var day = res[0];
                    var mouth = res[1];
                    var year = res[2];
                    mouth = mouth.substring(0, 3);
                    //bind
                    jQuery("#date-from").text(res[0]);
                    jQuery(".y1").text(year);
                    jQuery(".d1").text(mouth);
                }
            });
            //-------------------------
            jQuery('#date-hidden-to').datetimepicker({
                format: 'd/F/Y',
                lang: 'en',
                timepicker: false,
                onChangeDateTime: function (dp, $input) {
                    var date_from = $input.val();
                    var res = date_from.split("/");
                    var day = res[0];
                    var mouth = res[1];
                    var year = res[2];
                    mouth = mouth.substring(0, 3);
                    //bind
                    jQuery("#date-to").text(res[0]);
                    jQuery(".y2").text(year);
                    jQuery(".d2").text(mouth);
                }
            });
            jQuery("#date-to-pick").on('click', function ()
            {
                jQuery('#date-hidden-to').datetimepicker('show'); //support hide,show and destroy command
                return false;
            });
        </script>

    </div>
    <div class="r_box">
        <h4><?php _e('Khóa học nên học', SHORT_NAME) ?></h4>
        <div class="r_box_ct skg">
            <ul>
                <?php get_courses_soon(); ?>
            </ul>
        </div>
    </div>
    <script>
        jQuery(".reset_form_searh").on('click', function ()
        {
            jQuery('#date-from,#date-to').text('09');
            jQuery(".y1,.y2").text('2013');
            jQuery(".d2,.d1").text('Dec');
            jQuery("#select-course").val("all");
            jQuery("#search-course").hide();

            jQuery(".title-lichhoc").show();
            jQuery(".lh_home").show();
            jQuery("#search-course").hide();
        });
        jQuery('.submit_search').on('click', function ()
        {
            var course_id = jQuery("#select-course").val();
            var date_from = jQuery("#date-hidden-from").val();
            var date_to = jQuery("#date-hidden-to").val();
            var url = "<?php echo get_stylesheet_directory_uri() . '/filter_course.php'; ?>";
            jQuery.post(url,
                    {
                        dateto: date_to,
                        datefrom: date_from,
                        cate_course: course_id
                    },
            function (data, status) {
                jQuery(".title-lichhoc").hide();
                jQuery(".lh_home").hide();
                jQuery(".layout_2col .left").append(data);
            });
        });
    </script>
</div>