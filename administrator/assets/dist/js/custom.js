let imageId;
let imagePath;
let fieldId;
let BulkSelect = false
let lectureField;
$(function() {
    "use strict";
    $(".preloader").fadeOut();
    $(".left-sidebar").hover(
        function() {
            $(".navbar-header").addClass("expand-logo");
        },
        function() {
            $(".navbar-header").removeClass("expand-logo");
        }
    );

    $(".nav-tabs li.nav-item nav-link.disabled").click(function() {
        alert();
        return false;
      });

    // this is for close icon when navigation open in mobile view

    $(".nav-toggler").on('click', function() {
        $("#main-wrapper").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
    });

    $(".nav-lock").on('click', function() {
        $("body").toggleClass("lock-nav");
        $(".nav-lock i").toggleClass("mdi-toggle-switch-off");
        $("body, .page-wrapper").trigger("resize");
    });

    $(".search-box a, .search-box .app-search .srh-btn").on('click', function() {

        $(".app-search").toggle(200);

        $(".app-search input").focus();

    });



    // ============================================================== 

    // Right sidebar options

    // ==============================================================

    $(function() {
        $(".service-panel-toggle").on('click', function() {
            $(".customizer").toggleClass('show-service-panel');
        });

        $('.page-wrapper').on('click', function() {
            $(".customizer").removeClass('show-service-panel');
        });

    });

    // ============================================================== 

    // This is for the floating labels

    // ============================================================== 

    $('.floating-labels .form-control').on('focus blur', function(e) {

        $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));

    }).trigger('blur');



    // ============================================================== 

    //tooltip

    // ============================================================== 

    $(function() {

        $('[data-toggle="tooltip"]').tooltip()

    })

    // ============================================================== 

    //Popover

    // ============================================================== 

    $(function() {

        $('[data-toggle="popover"]').popover()

    })



    // ============================================================== 

    // Perfact scrollbar

    // ============================================================== 

    $('.message-center, .customizer-body, .scrollable').perfectScrollbar({

        wheelPropagation: !0

    });

    // ============================================================== 

    // Resize all elements

    // ============================================================== 

    $("body, .page-wrapper").trigger("resize");

    $(".page-wrapper").delay(20).show();

    // ============================================================== 

    // To do list

    // ============================================================== 

    $(".list-task li label").click(function() {

        $(this).toggleClass("task-done");

    });



    //****************************

    /* This is for the mini-sidebar if width is less then 1170*/

    //**************************** 

    var setsidebartype = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        if (width < 1170) {
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
        } else {
            $("#main-wrapper").attr("data-sidebartype", "full");
        }
    };

    $(window).ready(setsidebartype);

    $(window).on("resize", setsidebartype);
    //****************************
    /* This is for sidebartoggler*/
    //****************************

    $('.sidebartoggler').on("click", function() {
        $("#main-wrapper").toggleClass("mini-sidebar");
        if ($("#main-wrapper").hasClass("mini-sidebar")) {
            $(".sidebartoggler").prop("checked", !0);
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
        } else {
            $(".sidebartoggler").prop("checked", !1);
            $("#main-wrapper").attr("data-sidebartype", "full");
        }
    });

    $('#searchMedia').on('keyup',function(){
        let keyword = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `${globalUrl}administrator/search-media`,
            type: "post",
            data: {
                keyword: keyword,
            },
            success: function(result) {
                $(".image-thumbnail-container").html(result); 
            }
        });
    });

    $('#tags').on('keyup',function(){
        let keyword = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `${globalUrl}administrator/get-tags`,
            type: "post",
            data: {
                keyword: keyword,
            },
            success: function(result) {
                $(".tag-content").html(result)
            }
        });
    });

    $(document).on("click",".tag-content ul li", function(){
        let tagValue = $(".tag-values").html();
        let nTagValue = '<a href="javascript:void(0)" ><input type="hidden" name="tags[]" value="'+$(this).attr("data-id")+'"><span class="mdi mdi-tag-remove"></span>'+$(this).text()+'</a>';
        let result = tagValue.concat(nTagValue);
        $(".tag-values").html(result);
        $(".tag-content").html("");
    });
    
    $(document).on("click",".tag-values a .mdi-tag-remove", function(){
        $(this).parent().remove();
    });

    jQuery('.open-popup-link').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
    });
    
    
    $(".image-thumbnail-container").on("click",'.image-thumbnail',function(){
        imageId = $(this).attr("data-id");
        imagePath = $(this).children("img").attr("src");
        if (!BulkSelect) {
            $(".image-thumbnail").removeClass("active");
        }
        $(this).toggleClass("active");
    });

    $(".image-profile").on("click",function(){
        fieldId = $(this).children("input").attr("id");
    });

    $(".removeImage").on("click",function(){
        $(this).parent().children().children("img").attr("src","https://dummyimage.com/150x150?text=Add%20Image");
        $(this).parent().children().children("input").val("");
    });

    $(document).on("click",".addLecture",function() {
        lectureField = $(this).parent().parent().clone();
        $(this).parents(".lecturelist").append(lectureField);
    })

    $(document).on("click",".removeLecture",function() {
        $(this).parent().parent().remove();
    })

    $(document).on("click",".remove-room", function(){
        $(this).parent().parent().remove();
    })

    $(document).on("click",".addNewItem", function(){
        let elem = $(".item_content .row:first").clone();
        $(".item_content").append(elem);
    })

    $(document).on("click",".removeDiningItem", function(){
        $(this).parent().parent().remove();
    })

    

    $(document).on("click",".addNewRoom", function(){
        let count = $(this).attr("data-roomcount");
        let parentElement = $(this).attr("id");
        let next = parseInt($("."+parentElement+" .row").length) + parseInt("1");

        if(next <= count) {
            let id = $(this).attr("data-id");
            
            let element = '<div class="row mt-2"><div class="col-sm-5"><span class="room-label"> Adult </span><span class="room-guest"><input class="form-control" type="number" name="rooms['+id+']['+next+'][adult]" value="1"></span></div><div class="col-sm-5"><span class="room-label">Child </span><span class="room-guest"><input class="form-control" name="rooms['+id+']['+next+'][child]" type="number" value="0" max="2"></span></div><div class="col-sm-2"><button type="button" class="btn btn-danger btn remove-room"><i class="mdi mdi-delete"></i></button></div></div>';
        
        
            $("."+$(this).attr("id")).append(element);
        }
    })

    $(document).on("click",".updateImageType", function(){
        $(this).parent().children(".form-control").attr('type','file')
    })

    // $(document).on('keyup',"#bookingMobile",function(){
    //     console.log("here");
    // })

});

;(function($){
    
    $.fn.extend({
        donetyping: function(callback,timeout){
           
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    $(".loading").show();
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    
                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });


})(jQuery);

$('#bookingMobile').donetyping(function(){
    $(".loading").hide();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `${globalUrl}administrator/get-customer-info`,
        type: "post",
        data: {
            mobile: $(this).val(),
        },
        success: function(result) {
            console.log(result);
            $("#bookingName").val(result.name);
            $("#bookingEmail").val(result.email);
            $("#bookingEmail").val(result.gender);
        }
    });
});
  

function setMedia(){
    $("#"+fieldId).val(imageId);
    $("#"+fieldId).parent().children("img").attr("src",imagePath)
    $.magnificPopup.close();
}

function getCitiesByStateId(event){
    let state_id = event.value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `${globalUrl}administrator/get-city-by-state-id`,
        type: "post",
        data: {
            state_id: state_id,
        },
        success: function(result) {
            let htmlContent = '<option value="">Select City</option>';
            $.each(result, function (key, data) {
                htmlContent += '<option value="'+data.id+'"> '+data.name+' </option>';
            });
            $("#city_id").html(htmlContent);  
        }
    });
}

function changeBookingStatus(event,booking_id){
    let status = event.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `${globalUrl}administrator/change-status/`+booking_id,
        type: "get",
        data: {
            status: status,
        },
        success: function(result) {
           alert(result.message);
           console.log(result);
            location.reload();
        },
    });
}

function getRoomsByHotelId(event){
    let hotel_id = event.value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `${globalUrl}administrator/get-rooms-by-hotel-id`,
        type: "post",
        data: {
            hotel_id: hotel_id,
        },
        success: function(result) {
           $(".hotelRooms").html(result);
            //$("#city_id").html(result);  
        }
    });
}

