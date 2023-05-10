/*nav*/
$(document).ready(function(){
$('.toggle').click(function(){
 $("nav").toggleClass("open", 500);
 });
 }); 
/*nav*/

/*Footer*/
$(window).load(function() {
$("#footer").stickyFooter();
});
/*Footer*/

/*open-tab*/
$(document).ready(function(){
$('.toggle-top').click(function(){
 $(".top-right-section").toggleClass("open-tab", 500);
 });
 }); 
/*open-tab*/

/*sidebar*/
$(document).ready(function(){
$('.side-btn').click(function(){
 $(".sidebar-area").toggleClass("opens", 500);
 });
 }); 
/*sidebar*/

/*page*/
$(document).ready(function()
{
	 $("#visa_approval").show();
	 $("#tab_1").show();
	 $("#notes,#interviews,#registration").hide(); 
	 $("#tab_2,#tab_3,#tab_4").hide();
 
	$('#followup_btn').click(function()
	{
		$("#notes,#interviews,#registration").hide();
		$("#tab_2,#tab_3,#tab_4").hide();
		$("#followup").show();
		$("#tab_1").show();
	}); 

	$('#notes_btn').click(function()
	{
	 $("#followup,#interviews,#registration").hide();
	 $("#tab_1,#tab_3,#tab_4").hide();
	 $("#notes").show();
	 $("#tab_2").show();
	});
  
	$('#interviews_btn').click(function()
	{
		$("#followup,#notes,#registration").hide();
		$("#tab_1,#tab_2,#tab_4").hide();
		$("#interviews").show();
		$("#tab_3").show();
	});
 
 	$('#registration_btn').click(function()
	{
		$("#followup,#notes,#interviews").hide();
		$("#tab_1,#tab_2,#tab_3").hide();
		$("#registration").show();
		$("#tab_4").show();
	});


});
 
 
$(document).ready(function(){
 var $targetElement = $(".profile_top_right li");
            $(".profile_top_right li:nth-child(1)").addClass("active");
            $targetElement.click(function () {
                $targetElement.removeClass("active");
                $(this).addClass("active");
				
    });
});	
/*page*/

/*page*/
$(document).ready(function(){

	$("#tab_1").show();
	$("#followup").show();
	$("#tab_2,#tab_3,#tab_4").hide();
	$("#notes,#interviews,#registration").hide(); 
  
	$('#tab_1btn').click(function()
	{
		$("#tab_1").show();
		$("#followup").show();
		$("#tab_2,#tab_3,#tab_4").hide();
		$("#notes,#interviews,#registration").hide();
	});

 
	$('#tab_2btn').click(function()
	{
		$("#tab_2").show();
		$("#notes").show();
		$("#tab_1,#tab_3,#tab_4").hide();
		$("#followup,#interviews,#registration").hide();
	}); 
 
	$('#tab_3btn').click(function()
	{
		$("#tab_3").show();
		$("#interviews").show();
		$("#tab_1,#tab_2,#tab_4").hide();
		$("#followup,#notes,#registration").hide();
	});

	$('#tab_4btn').click(function()
	{
		$("#tab_4").show();
		$("#registration").show();
		$("#tab_1,#tab_2,#tab_3").hide();
		$("#followup,#notes,#interviews").hide();
	});

}); 
$(document).ready(function(){
 var $targetElement = $(".notes li");
            $(".notes li:nth-child(1)").addClass("active");
            $targetElement.click(function () {
                $targetElement.removeClass("active");
                $(this).addClass("active");
    });
});	
/*page*/



/*chart*/
$(function () {
	//Better to construct options first and then pass it as a parameter
	var options = {
		title: {
			text: ""
		},
                animationEnabled: true,
		data: [
		{
			type: "spline", //change it to line, area, column, pie, etc
			dataPoints: [
				{ x: 10, y: 10 },
				{ x: 20, y: 12 },
				{ x: 30, y: 8 },
				{ x: 40, y: 14 },
				{ x: 50, y: 6 },
				{ x: 60, y: 24 },
				{ x: 70, y: -4 },
				{ x: 80, y: 10 }
			]
		}
		]
	};

	$("#chartContainer").CanvasJSChart(options);

});
/*chart*/

/*scollbar*/		
(function($){
			$(window).load(function(){
				
				$(".profile_bottom").mCustomScrollbar({
					scrollButtons:{
						enable:true
					},
					callbacks:{
						onScrollStart:function(){ myCallback(this,"#onScrollStart") },
						onScroll:function(){ myCallback(this,"#onScroll") },
						onTotalScroll:function(){ myCallback(this,"#onTotalScroll") },
						onTotalScrollOffset:60,
						onTotalScrollBack:function(){ myCallback(this,"#onTotalScrollBack") },
						onTotalScrollBackOffset:50,
						whileScrolling:function(){ 
							myCallback(this,"#whileScrolling"); 
							$("#mcs-top").text(this.mcs.top);
							$("#mcs-dragger-top").text(this.mcs.draggerTop);
							$("#mcs-top-pct").text(this.mcs.topPct+"%");
							$("#mcs-direction").text(this.mcs.direction);
							$("#mcs-total-scroll-offset").text("60");
							$("#mcs-total-scroll-back-offset").text("50");
						},
						alwaysTriggerOffsets:false
					}
				});
				
				function myCallback(el,id){
					if($(id).css("opacity")<1){return;}
					var span=$(id).find("span");
					clearTimeout(timeout);
					span.addClass("on");
					var timeout=setTimeout(function(){span.removeClass("on")},350);
				}
				
				$(".callbacks a").click(function(e){
					e.preventDefault();
					$(this).parent().toggleClass("off");
					if($(e.target).parent().attr("id")==="alwaysTriggerOffsets"){
						var opts=$(".content").data("mCS").opt;
						if(opts.callbacks.alwaysTriggerOffsets){
							opts.callbacks.alwaysTriggerOffsets=false;
						}else{
							opts.callbacks.alwaysTriggerOffsets=true;
						}
					}
				});
				
			});
		})(jQuery);
/*scollbar*/



	