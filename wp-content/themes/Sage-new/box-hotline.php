<div class="tv_box">
    <p><?php _e('Tư vấn', SHORT_NAME) ?></p>
    <?php
    $hotline = get_option('sage_hotline');
    if(trim($hotline) == ""){
        echo '<h4>096.4747.046</h4>';
    }else{
        echo "<h4>$hotline</h4>";
    }
    ?>
</div>