function displayBarNotification(n,c,m){
    var nNote = jQuery("#nNote");
    if(n){
        nNote.attr('class', '').addClass("nNote " + c).fadeIn().html(m);
        setTimeout(function(){
            nNote.attr('class', '').hide("slow").html("");
        }, 10000);
    }else{
        nNote.attr('class', '').hide("slow").html("");
    }
}
function displayAjaxLoading(n){
    n?jQuery(".ajax-loading-block-window").show():jQuery(".ajax-loading-block-window").hide("slow");
}
jQuery(function (){
    $("#nNote").click(function(){
        $(this).attr('class', '').hide("slow").html("");
    });
    jQuery("#frmRegCourse").submit(function (){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "html", cache: false,
            data: jQuery(this).serialize(),
            success: function(response, textStatus, XMLHttpRequest){
                if(response && response.length > 0){
                    window.location = response;
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
            },
            complete:function(){
                displayAjaxLoading(false);
            }
        });
        return false;
    });
    jQuery("#frmRequestBrochure").submit(function (){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "json", cache: false,
            data: jQuery(this).serialize(),
            success: function(response, textStatus, XMLHttpRequest){
                if(response && response.status === 'success'){
                    window.location = response.url;
                } else if(response.status === 'error'){
                    displayBarNotification(true, "nWarning", response.msg);
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
            },
            complete:function(){
                displayAjaxLoading(false);
            }
        });
        return false;
    });
    jQuery("#frmBeOurTrainer, #frmBeOurPartner").submit(function (){
        displayAjaxLoading(true);
        jQuery.ajax({
            url: ajaxurl, type: "POST", dataType: "json", cache: false,
            data: jQuery(this).serialize(),
            success: function(response, textStatus, XMLHttpRequest){
                if(response && response.status === 'success'){
                    displayBarNotification(true, "nSuccess", response.msg);
                    setTimeout(function (){
                        window.location = siteUrl;
                    }, 5000);
                } else if(response.status === 'error'){
                    displayBarNotification(true, "nWarning", response.msg);
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
            },
            complete:function(){
                displayAjaxLoading(false);
            }
        });
        return false;
    });
});