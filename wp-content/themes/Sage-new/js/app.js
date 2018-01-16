$(document).ready(function(){

    /* Menu */
    $(".navi_bar li").each(function(){
        if($(this).attr('class').lastIndexOf('current-', $(this).attr('class')) != -1){
            $(this).children('a:first').addClass('on');
        }
        if($(this).children('ul.sub-menu').length > 0){
            $(this).append('<div class="submenu"><div class="submenu_ct"><span class="arrow"></span><ul>' + 
                $(this).children('ul.sub-menu').html() +
            '</ul></div></div>');
            $(this).children('ul.sub-menu').remove();
        }
    });
    $(".navi_bar").show('fast');

    // enter line
//    $('.detail_ct div, .about_ct div, .add_box_ct div, .kh_detail_ct  div, .post_ct div').each(function(){
    $('.detail_ct div, .about_ct div, .add_box_ct div, .post_ct div').each(function(){
        if($(this).html().length == 0){
            $(this).css({
                'height': '15px'
            });
        }
    });
    $('.kh_detail_ct div[id^="tabs-"]').each(function(){
        $(this).find('div').each(function(){
            if($(this).html().length == 0){
                $(this).css({
                    'height': '15px'
                });
            }
        });
    });

    /* slide khach hang */
    $('#slider-top').bxSlider({
        nextText: '',
        prevText: '',
        pager: false,
        mode: 'fade',
        auto: true
    });

    /* slide khach hang */
    $('.kh_slider ul').bxSlider({
        nextSelector: '#kh-btn-next',
        prevSelector: '#kh-btn-prev',
        nextText: '',
        prevText: '',
        pager: false,
        minSlides: 2,
        maxSlides: 2,
        slideWidth: 300,
        slideMargin: 20,
		auto : true
    });
	
    /* slide giang vien */
    $('.teacher_slide ul').bxSlider({
        nextText: '',
        prevText: '',
        pager: false,
        minSlides: 3,
        maxSlides: 3,
        slideWidth: 300,
        slideMargin: 30,
        speed: 2000
    });
    
    // Client slide
    if($('.client-slide ul').length > 0){
        $('.client-slide ul').show().bxSlider({
            controls: false,
            adaptiveHeight: true,
            auto: true,
            speed: 1000
        });
    }
	
    /* kh detail tabs */
    $( ".kh_detail_ct" ).tabs({
        beforeActivate: function( event, ui ) {
            if(ui.newTab.hasClass('t-dk') || ui.newTab.hasClass('t-brochure')){
                window.location = ui.newTab.attr('data-url');
            } else {
                $('body,html').animate({
                    scrollTop: $( ".kh_detail_ct" ).offset().top - $('#wpadminbar').outerHeight(true)
                }, 800);
            }
        }
    });

    /* show more less content */
    $('.author_info .intro_ct').expander({
        slicePoint: 300,
        expandText: 'Mở rộng +',
        userCollapseText: 'Thu gọn +',
        expandEffect: 'show',
        expandSpeed: 0,
        collapseEffect: 'hide',
        collapseSpeed: 0
    });
	
    /* append reg form */
    $('#sl-user-reg').change( function () {
        var option = $(this).val();
        appendfrm(option);
    });
	
    /* fixed kh tabs */
    $('.kh_detail_tabs').scrollToFixed({
        marginTop: $('#wpadminbar').outerHeight(true) + 0,
        limit: $('#teacher_box').offset().top
    });
	
    /* fixed column right */
    var summaries = $('.r_fixed_limit');
    summaries.each(function(i) {
        var summary = $(summaries[i]);
        var next = summaries[i + 1];

        summary.scrollToFixed({
            marginTop: $('.header').outerHeight(true) + 10,
            limit: function() {
                var limit = 0;
                if (next) {
                    limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                } else {
                    // footer offset top
                    limit = $('#teacher_box').offset().top - $(this).outerHeight(true) - 10;
                }
                return limit;
            },
            zIndex: 999
        });
    });
    
    // Clone delegate
    $("#btnDuplicateDelegate").click(function (){
        var delegate = $(".reg-form").find(".delegate").eq(0).clone();
        var delegate_count = $(".reg-form").find(".delegate").length;
        delegate.find("button").remove();
        delegate.find("input").val('');
        delegate.find('span.count').text(delegate_count + 1);
        delegate.find(".close").show();
        $(".reg-form").find(".delegate").eq(delegate_count - 1).after(delegate);
        setTimeout(function (){
            $('body,html').animate({
                scrollTop: $(".reg-form").find(".delegate").eq(delegate_count).offset().top - $('#wpadminbar').outerHeight(true)
            }, 800);
            removeDelegate();
        }, 1000);
    });
    
    // Fill contact info
    var first_delegate = $(".reg-form").find(".delegate").eq(0);
    first_delegate.find("input").each(function (){
        $(this).change(function (){
            var name = $(this).attr('name');
            name = name.replace("[]", "");
            $("input[name=" + name + "_contact]").val($(this).val());
        });
    });
    first_delegate.find("select").each(function (){
        $(this).change(function (){
            var name = $(this).attr('name');
            name = name.replace("[]", "");
            $("select[name=" + name + "_contact]").val($(this).val());
        });
    });
    
    // clients filter
    var tabs = jQuery("ul.client-cats li");
    var work = jQuery("ul.client-ids li");
    var prev_tab = 0;

    tabs.on('click', function () {
        tabs.removeClass('active');
        curr_tab = jQuery(this).attr("data-cat");
        jQuery(this).addClass('active');

        work.each(function () {
            if (curr_tab === "all") {
                jQuery(this).show('slow');
            } else {
                if (jQuery(this).hasClass(curr_tab)) {
                    jQuery(this).show('slow');
                } else {
                    jQuery(this).hide('slow');
                }
            }
        });
    });
});

/* function append reg form */
function appendfrm(sl){
    var $temp = $('#frm-reg-temp').val();
    $('#frm-reg').empty();
    for(i=0;i<sl;i++){
        $('#frm-reg').append($temp);
    }
}

function removeDelegate(){
    $(".reg-form").find(".delegate").find(".close").click(function (){
        $(this).parent().remove();
        $(".reg-form").find(".delegate").each(function (index){
            $(this).find('span.count').text(index + 1);
        });
    });
}