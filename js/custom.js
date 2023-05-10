$('body').on("click", ".dropdown-menu", function (e) {
    $(this).parent().is(".open") && e.stopPropagation();
});

$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('.option').prop('checked', true);
        var total = $('input[name="options[]"]:checked').length;
        $(".dropdown-text").html('(' + total + ') Selected');
        $(".select-text").html(' Deselect');
    } else {
        $('.option').prop('checked', false);
        $(".dropdown-text").html('(0) Selected');
        $(".select-text").html(' Select');
    }
});

$("input[type='checkbox'].justone").change(function(){
    var a = $("input[type='checkbox'].justone");
    if(a.length == a.filter(":checked").length){
        $('.selectall').prop('checked', true);
        $(".select-text").html(' Deselect');
    }
    else {
        $('.selectall').prop('checked', false);
        $(".select-text").html(' Select');
    }
  var total = $('input[name="options[]"]:checked').length;
  $(".dropdown-text").html('(' + total + ') Selected');
});


jQuery(document).ready(function() {
	
	"use strict";

	$(window).on("resize", function() {
			
			if ($(window).width() >= 1200) {
				$('.scroll-to a').addClass("scroll-click");
			} else {
				$('.scroll-to a').removeClass("scroll-click");
			}
		
	}).resize();
	
	$(".scroll-to a").on("click", function(e) {
		e.preventDefault();

		var scrollAttrTop = $( $(this).attr('href') ).offset().top,
			fullscreenTop = $(".hero-banner").offset().top;
				
        if ($(this).hasClass("scroll-click")){
			$("body, html").animate({
				scrollTop: scrollAttrTop - fullscreenTop
			}, 500);
		} else {
			$("body, html").animate({
				scrollTop: scrollAttrTop
			}, 500);
		}
	});

	$('.thumbnail-wrapper').each(function(){
		$(this).on("mouseenter", function () {
			$(this).addClass('thumbnail-active');
		});
		$(this).on("mouseleave", function () {
			$(this).removeClass('thumbnail-active');
		});
	});

	/* =======================================================
	Subscribe submit settings
	========================================================== */
	$("form.subscribe").each(function(){
		var subscribeEmail = $(this).find(".subscribe-email"),
			subscribeButton = $(this).find(".subscribe-button"),
			subscribeReply = $(this).find(".reply-message"),
			subscribeLoading = $(this).find(".form-loading");
		
		subscribeButton.on("click", function() {
			subscribeReply.removeClass();
			subscribeReply.html('');
			var regEx = "";
			
			// validate Email
			var emailVal = subscribeEmail.val();
			regEx=/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
			if (emailVal == "" || emailVal == "Email" || !regEx.test(emailVal)) {
				subscribeEmail.val('');
				subscribeEmail.focus();
				return false;
			}
			
			var dataString = 'email=' + subscribeEmail.val();
		
			subscribeLoading.fadeIn(500);
			
			// Send form data to subscribe.php
			$.ajax({
				type: "POST",
				url: "subscribe.php",
				data: dataString,
				success: function() {
					subscribeLoading.hide();
					subscribeReply.addClass('list3');
					subscribeReply.html("<span>You have successfully subscribed</span>")
					.hide()
					.fadeIn(1500);
					$("form.subscribe").trigger("reset");
				}
			});
			return false;
		});
	});

});