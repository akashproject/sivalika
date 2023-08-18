(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
     
    // Initiate the wowjs
    new WOW().init();
    
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    
    $("#total_guest").on('keyup',function(){
      fnUpdateBooking();
    });
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    $("#customer_login_form").validate({
      messages: {
        mobile: {
          required: "Please enter valid mobile number",
          min: "Please enter valid mobile number",
          max: "Please enter valid mobile number",
        },
      },
      submitHandler: function(form) {
        let formId = $(form).attr('id');
        jQuery("#" + formId + " .checkout_loader").show();
        if(jQuery("#" + formId + " .formFieldOtpResponse").val() == ""){
          sendMobileOtp(formId);
          countDown()
          return false;
        }
    
        if(jQuery("#" + formId + " .verify_otp").val() != '' && jQuery("#" + formId + " .formFieldOtpResponse").val() == jQuery("#" + formId + " .verify_otp").val()){
          form.submit();
        } else {
          jQuery("#" + formId + " .response_status").html("OTP is Invalid");
          jQuery("#" + formId + " .checkout_loader").hide();
          return false;
        }
        return false; // required to block normal submit since you used ajax
      }
    });

    $('#customer_ragistration_form input').on('keyup', function() {
      if ($("#customer_ragistration_form").valid()) {
          $('#customer_ragistration_form .submit_classroom_lead_generation_form').prop('disabled', false);  
      } else {
          $('#customer_ragistration_form .submit_classroom_lead_generation_form').prop('disabled', 'disabled');
      }
  });

    $("#customer_ragistration_form").validate({
      messages: {
        firstname: {
          required: "Please enter First Name",
        },
        lastname: {
          required: "Please enter Last Name",
        },
        email: {
          required: "Please enter valid email address",
          email_rule: "Please enter valid email address",
        },
        mobile: {
          required: "Please enter valid mobile number",
          min: "Please enter valid mobile number",
          max: "Please enter valid mobile number",
        },
      },
      submitHandler: function(form) {
        bookingConfirmProcess(form);
        return false; // required to block normal submit since you used ajax
      }
    });

    jQuery(".changeGivenNumber").on("click",function(){
      let formId = jQuery(this).closest("form").attr("id");
      jQuery("#" + formId + " .formFieldOtpResponse").val("");
      jQuery("#" + formId + " .registration_process").removeClass("active");
      jQuery("#" + formId + " .registration_process.step-1").addClass("active");
    });
    
    jQuery(".resendOtp").on('click',function(){
      jQuery(this).addClass('display-none');
      jQuery('.countdown_label').removeClass('display-none');
      let form = jQuery(this).closest("form");
      let formId = $(form).attr('id');
      jQuery("#" + formId + " .checkout_loader").show();
      countDown();
      sendMobileOtp(formId);
    });

    function bookingConfirmProcess(form){
      let formId = $(form).attr('id');
      jQuery("#" + formId + " .checkout_loader").show();
      if(jQuery("#" + formId + " .formFieldOtpResponse").val() == ""){
        sendMobileOtp(formId);
        countDown()
        return false;
      }
  
      if(jQuery("#" + formId + " .verify_otp").val() != '' && jQuery("#" + formId + " .formFieldOtpResponse").val() == jQuery("#" + formId + " .verify_otp").val()){
        form.submit();
      } else {
        jQuery("#" + formId + " .response_status").html("OTP is Invalid");
        jQuery("#" + formId + " .checkout_loader").hide();
        return false;
      }
    }
  
    function sendMobileOtp(formId) {
      var mobileNo = jQuery("#" + formId + " input[name='mobile']").val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: `${globalUrl}submit-mobile-otp`,
        type: "post",
        data: {
          mobile: mobileNo,
        },
        success: function(result) {
          if (result) {
            jQuery("#" + formId + " .formFieldOtpResponse").val(result.otp_value);
            jQuery("#" + formId + " .lastDigit").text(result.lastdigit);
            jQuery("#" + formId + " .registration_process").removeClass("active");
            jQuery("#" + formId + " .registration_process.step-2").addClass("active");
            jQuery(".checkout_loader").hide();
            return true;
          } else {
            jQuery("#" + formId + " .response_status").html("OTP Sent Failed! Please Try Again Later");
            jQuery(".checkout_loader").hide();
            return true;
          }
        }
      });
    }

    function countDown(){
      var timer2 = "0:59";
      var interval = setInterval(function() {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) {
          clearInterval(interval)
          jQuery('.countdown_label').addClass("display-none");
          jQuery('.resendOtp').removeClass("display-none");
        };
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        jQuery('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
      }, 1000);
    }


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })

       

        let currentDate = new Date();
        let nextDay = new Date().setDate(new Date().getDate() + 1);
        
        if(jQuery.cookie("filterData")){
          let filterData = JSON.parse(jQuery.cookie("filterData"))
           currentDate = filterData.checkin;
           nextDay = filterData.checkout;
        }

        $('.t-datepicker').tDatePicker({
          // options here
          iconDate: '<i class="fa fa-calendar" aria-hidden="true"></i>',
          dateCheckIn: currentDate,
          dateCheckOut: nextDay,
        }).on('clickDateCI',function(e, dateCI) {
            fnUpdateBooking();
        }).on('clickDateCO',function(e, dateCO) {
            fnUpdateBooking();
        });
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        // autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            }
        }
    });
    
    jQuery('.open-popup-link').magnificPopup({
      type: 'inline',
      midClick: true,
      mainClass: 'mfp-fade'
    });

    $(document).ready(function() {
        var bigimage = $("#big");
        var thumbs = $("#thumbs");
        //var totalslides = 10;
        var syncedSecondary = true;
      
        bigimage
          .owlCarousel({
          items: 1,
          slideSpeed: 2000,
          nav: true,
          autoplay: true,
          dots: false,
          loop: true,
          responsiveRefreshRate: 200,
          navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
          ]
        })
          .on("changed.owl.carousel", syncPosition);
      
        thumbs
          .on("initialized.owl.carousel", function() {
          thumbs
            .find(".owl-item")
            .eq(0)
            .addClass("current");
        })
        .owlCarousel({
          items: 5,
          dots: true,
          nav: false,
          
          smartSpeed: 200,
          slideSpeed: 500,
          slideBy: 4,
          responsiveRefreshRate: 100
        })
          .on("changed.owl.carousel", syncPosition2);
      
        function syncPosition(el) {
          //if loop is set to false, then you have to uncomment the next line
          //var current = el.item.index;
      
          //to disable loop, comment this block
          var count = el.item.count - 1;
          var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
      
          if (current < 0) {
            current = count;
          }
          if (current > count) {
            current = 0;
          }
          //to this
          thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
          var onscreen = thumbs.find(".owl-item.active").length - 1;
          var start = thumbs
          .find(".owl-item.active")
          .first()
          .index();
          var end = thumbs
          .find(".owl-item.active")
          .last()
          .index();
      
          if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
          }
          if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
          }
        }
      
        function syncPosition2(el) {
          if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
          }
        }
      
        thumbs.on("click", ".owl-item", function(e) {
          e.preventDefault();
          var number = $(this).index();
          bigimage.data("owl.carousel").to(number, 300, true);
        });
    });

    $(document).on("click",".remove-room", function(){
      $(this).parent().parent().remove();
      calculate_totalGuest();
      fnBookingByAjax()
    })

    $(".update_booking").on("click",function(){
      $(".checkout_loader").show();
      $.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: `${globalUrl}check-availability`,
				type: "post",
				data: {
          't-start':$('input[name="t-start"]').val(),
          't-end':$('input[name="t-end"]').val(),
          'total_guest':$('input[name="total_guest"]').val(),
          'hotel':$('input[name="hotel_id"]').val(),
          'submitBy':"ajax",
        },
				success: function(result) {
          $(".checkout_loader").hide();
          if (result == true) {
            location.reload();
          }
					
				}
			});
    });

    $('.addNewRoom').on("click",function(){
      let count = $(this).attr("data-roomcount"),max=$(this).attr("data-max");
      
      let parentElement = $(this).attr("id");
      let next = parseInt($("."+parentElement+" .row").length) + parseInt("1");

      if(next <= count) {
          let id = $(this).attr("data-id");

          let element = '<div class="d-flex mb-3 row" data-min="1" data-max="'+max+'"><div class="col-md-3"><span> Room </span></div><div class="col-md-4"><span class="quantity-down"> <i class="fa fa-minus-circle text-primary"></i> </span><span class="guestCount quantity"> <input type="text" class="guestCount_input" value="1" name="rooms['+id+']['+next+'][adult]" readonly> </span><span class="quantity-up"> <i class="fa fa-plus-circle text-primary"></i> </span>  Adult</div><div class="col-md-4"><span class="quantity-down"> <i class="fa fa-minus-circle text-primary"></i> </span><span class="guestCount quantity"> <input type="text" value="0" name="rooms['+id+']['+next+'][child]" min="0" max="2"> </span><span class="quantity-up"> <i class="fa fa-plus-circle text-primary"></i> </span>  Child</div><div class="col-md-1"><span class="remove-room"> <i class="fa fa-trash text-primary"></i> </span></div></div>';

         
          $("."+$(this).attr("id")).append(element);
          calculate_totalGuest();
          fnBookingByAjax();
      }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 850) {
            $('.submenu').addClass('fixed');
        } else {
            $('.submenu').removeClass('fixed');
        }
    });

    $(".clear_selection").on("click",function(){
        let id = $(this).attr("data-id");
        $("."+id).html("");
    });

    $('.add-guest').on("click",function(){
      let max = $(this).attr("data-max");
      let min = $(this).attr("data-min");

      //$(this).parent().
    });

    $(document).on('click',".quantity-up",function() {
      var spinner = jQuery(this),input = spinner.parent().find('input[type="number"]'),max = jQuery(this).parent().parent().attr('data-max');
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      input.val(newVal);
     
      calculate_totalGuest();
      
    });

    $(document).on('click',".quantity-down",function() {
      var spinner = jQuery(this),input = spinner.parent().find('input[type="number"]'),min = jQuery(this).parent().parent().attr('data-min');
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      input.val(newVal);
      calculate_totalGuest();
    });

    function calculate_totalGuest(){
      var numberInputs = $(".guestCount_input"),sum = 0;
      numberInputs.each(function() {
        sum += parseInt($(this).val()) || 0;
      });
      $("#total_guest").val(sum);
      //fnUpdateBooking();
    }  

    function fnUpdateBooking(){
      $(".update_booking").show();
      $('#book_now').prop('disabled', true);
    }

    function fnBookingByAjax(){
      console.log($('#encoded_cost').val());
      
      $('#book_now').prop('disabled', true);
      // $(".checkout_loader").show();
      $.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: `${globalUrl}update-booking`,
				type: "post",
				data: jQuery("#proceed-to-checkout").serialize(),
				success: function(result) {
          console.log(result);
          $(".checkin_amount h5").text(result.cost);
          $('#encoded_cost').val(result.encodedCost);
          $('.review_room').html(result.roomLabel);
          $('#book_now').prop('disabled', false);
				}
			});
    }

})(jQuery);

// jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
//     jQuery.each('.quantity',function() {
//       var spinner = jQuery(this),
//         input = spinner.find('input[type="number"]'),
//         btnUp = spinner.find('.quantity-up'),
//         btnDown = spinner.find('.quantity-down'),
//         min = input.attr('min'),
//         max = input.attr('max');

//       btnUp.on('click',function() {
//         var oldValue = parseFloat(input.val());
//         if (oldValue >= max) {
//           var newVal = oldValue;
//         } else {
//           var newVal = oldValue + 1;
//         }
//         spinner.find("input").val(newVal);
//         spinner.find("input").trigger("change");
//       });

//       btnDown.on('click',function() {
//         var oldValue = parseFloat(input.val());
//         if (oldValue <= min) {
//           var newVal = oldValue;
//         } else {
//           var newVal = oldValue - 1;
//         }
//         spinner.find("input").val(newVal);
//         spinner.find("input").trigger("change");
//       });

//     });

