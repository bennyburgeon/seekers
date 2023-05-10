<script src="<?php echo base_url();?>assets/js/inbox.js" type="text/javascript"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			
             <?php //echo $menu_flow;?>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo $this->config->site_url()?>/dashboard">Home</a>
				</li>
				<li>
					<li> <a href="<?php echo $this->config->site_url()?>/my_inbox"><?php echo $module_head?></a>  </li>
									</li>
				<li class="active">
					My Inbox
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<div class="portlet light">
				<div class="portlet-body">
					<div class="row inbox">
						<div class="col-md-2">
							<ul class="inbox-nav margin-bottom-10">
								<li class="compose-btn">
									<a href="javascript:;" data-title="Compose" class="btn green">
									<i class="fa fa-edit"></i> Compose </a>
								</li>
								<li class="inbox active">
									<a href="javascript:;" class="btn" data-title="Inbox">
									Inbox(<?php if($inbox_count > 0)echo $inbox_count;else echo '0';?>) </a>
									<b></b>
								</li>
								<li class="sent">
									<a class="btn" href="javascript:;" data-title="Sent">
									Sent (<?php if($sent_count > 0)echo  $sent_count;else echo '0';?>)</a>
									<b></b>
								</li>
								<li class="draft">
									<a class="btn" href="javascript:;" data-title="Draft">
									Draft (<?php if($draft_count > 0) echo $draft_count; else echo '0';?>)</a>
									<b></b>
								</li>
								<li class="trash">
									<a class="btn" href="javascript:;" data-title="Trash">
									Trash (<?php if($trash_count > 0)echo $trash_count; else echo '0';?>)</a>
									<b></b>
								</li>
								<li class="starred">
									<a class="btn" href="javascript:;" data-title="Starred">
									Starred (<?php if($starred_count > 0)echo $starred_count;else echo '0';?>)</a>
									<b></b>
								</li>
								                                                         
							</ul>
						</div>
						<div class="col-md-10">
							<div class="inbox-header">
								<!--<h1 class="pull-left">Inbox</h1>-->
								<form class="form-inline pull-right" action="<?php echo site_url();?>/my_inbox/inbox_search">
									<div class="input-group input-medium">
										<input type="text" class="form-control" placeholder="Search Text">
										<span class="input-group-btn">
										<button type="submit" class="btn green"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							</div>
                            <?php
							if ($this->session->flashdata('success')){    						
								echo '<div class="success">'.$this->session->flashdata('success').'</div>';
							}
							?>                            
    						<div class="inbox-loading">
								 <!--Loading...-->
							</div>
							<div class="inbox-content">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<script language="javascript" type="text/javascript">

var Inbox = function () {
//var $j = $.noConflict();
    var content = $('.inbox-content');
    var loading = $('.inbox-loading');
    var listListing = '';

    var loadInbox = function (el, name) { 
	
    var url = '<?php echo site_url();?>/my_inbox/inbox_view/'+name;
	 	
		//var url = 'inbox_inbox.html';
        var title = $('.inbox-nav > li.' + name + ' a').attr('data-title');
        listListing = name;

        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-nav > li.' + name).addClass('active');
                $('.inbox-header > h1').text(title);

                loading.hide();
                content.html(res);
                if (Layout.fixContentHeight) {
                    Layout.fixContentHeight();
                }
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });

        // handle group checkbox:
        jQuery('body').on('change', '.mail-group-checkbox', function () {
            var set = jQuery('.mail-checkbox');
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                $(this).attr("checked", checked);
            });
            jQuery.uniform.update(set);
        });
    }
	
    var loadMessage = function (el, name, resetMenu) {
        var url = '<?php echo site_url();?>/my_inbox/inbox_load_msg';
		
        loading.show();
        content.html('');
        toggleButton(el);

        var message_id = el.parent('tr').attr("data-messageid");  
		
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            data: {'message_id': message_id},
            success: function(res) 
            {
                toggleButton(el);

                if (resetMenu) {
                    $('.inbox-nav > li.active').removeClass('active');
                }
                $('.inbox-header > h1').text('View Message');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }
	

	 var loadEditDraft = function (el, name, resetMenu) {
        var url = '<?php echo site_url();?>/my_inbox/draft_compose';
		
        loading.show();
        content.html('');
        toggleButton(el);

        var message_id = el.parent('tr').attr("data-messageid");  
		
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            data: {'message_id': message_id},
            success: function(res) 
            {
                toggleButton(el);

                if (resetMenu) {
                    $('.inbox-nav > li.active').removeClass('active');
                }
                $('.inbox-header > h1').text('View Message');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }
	
    

	var initWysihtml5 = function () {
        $('.inbox-wysihtml5').wysihtml5({
            "stylesheets": ["<?php echo base_url();?>/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
        });
    }

    var initFileupload = function () {

        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: '<?php echo base_url();?>/assets/global/plugins/jquery-file-upload/server/php/',
            autoUpload: true
        });

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '<?php echo base_url();?>/assets/global/plugins/jquery-file-upload/server/php/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                    new Date())
                    .appendTo('#fileupload');
            });
        }
    }

    var loadCompose = function (el) {
		
        var url = '<?php echo site_url();?>/my_inbox/inbox_compose';

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Compose');

                loading.hide();
                content.html(res);

                initFileupload();
                initWysihtml5();

                $('.inbox-wysihtml5').focus();
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadReply = function (el) {
        var url = '<?php echo site_url();?>/my_inbox/inbox_reply';
	
        loading.show();
        content.html('');
        toggleButton(el);
		 
		 var message_id = el.attr("messageid");

        // load the form via ajax
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
			data: {'message_id': message_id},
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Reply');
                loading.hide();
                content.html(res);
              
                handleCCInput(); // init "CC" input field
                initFileupload();
                initWysihtml5();
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadForward = function (el) {
        var url = '<?php echo site_url();?>/my_inbox/forward';
	
        loading.show();
        content.html('');
        toggleButton(el);
		 
		 var message_id = el.attr("messageid");

        // load the form via ajax
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
			data: {'message_id': message_id},
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Forward');
                loading.hide();
                content.html(res);
               
                handleCCInput(); // init "CC" input field
                initFileupload();
                initWysihtml5();
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadSearchResults = function (el, searchString) {
		var url = '<?php echo site_url();?>/my_inbox/inbox_search';
		
        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
			data: {'searchTerm': searchString},
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Search');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
				//alert(xhr.responseText);
                toggleButton(el);
            },
            async: false
        });
    }

    var handleCCInput = function () {
        var the = $('.inbox-compose .mail-to .inbox-cc');
        var input = $('.inbox-compose .input-cc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var handleBCCInput = function () {

        var the = $('.inbox-compose .mail-to .inbox-bcc');
        var input = $('.inbox-compose .input-bcc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

   
 var toggleButton = function(el) {
        if (typeof el == 'undefined') {
            return;
        }
        if (el.attr("disabled")) {
            el.attr("disabled", false);
        } else {
            el.attr("disabled", true);
        }
    }
	

    return {
        //main function to initiate the module
        init: function () { 

            // handle compose btn click
            $('.inbox').on('click', '.compose-btn a', function () {
                loadCompose($(this));
            });

            // handle discard btn
            $('.inbox').on('click', '.inbox-discard-btn', function(e) { 
                e.preventDefault();
                loadInbox($(this), listListing);
            });

            // handle reply and forward button click
            $('.inbox').on('click', '.reply-btn', function () {
				//alert('');
                loadReply($(this));
            });
            // handle reply and forward button click
            $('.inbox').on('click', '#reply_to', function () {
				//alert('');
                loadReply($(this));
            });			

            // handle forward button click
            $('.inbox').on('click', '#forward_to', function () {
				//alert('');
                loadForward($(this));
            });	
						
            // handle view message
            $('.inbox-content').on('click', '.view-message', function () { 
                loadMessage($(this));
            });

            // handle edit/send draft message
            $('.inbox-content').on('click', '.view-messages', function () { 
                loadEditDraft($(this));
            });
			
            // handle inbox listing
            $('.inbox-nav > li.inbox > a').click(function () {
                loadInbox($(this), 'inbox');
            });

            // handle sent listing
            $('.inbox-nav > li.sent > a').click(function () {
                loadInbox($(this), 'sent');
            });

            // handle draft listing
            $('.inbox-nav > li.draft > a').click(function () {
                loadInbox($(this), 'draft');
            });

            // handle trash listing
            $('.inbox-nav > li.trash > a').click(function () {
                loadInbox($(this), 'trash');
            });
			
            //handle compose/reply cc input toggle
            $('.inbox-content').on('click', '.mail-to .inbox-cc', function () {
                handleCCInput();
            });

            //handle compose/reply bcc input toggle
            $('.inbox-content').on('click', '.mail-to .inbox-bcc', function () {
                handleBCCInput();
            });
		
		
		
            //handle loading content based on URL parameter
			
			/*************************** ideology commented 17-aug-2015 *********************************/
			
			
        /*  if (Metronic.getURLParameter("a") === "view") {
                loadMessage();
            } else if (Metronic.getURLParameter("a") === "compose") {
                loadCompose();
            } else {
               $('.inbox-nav > li.inbox > a').click();
            }
			
			*/
			 $('.inbox-nav > li.inbox > a').click();
			 
			 
			 
			 
			//Handle Search button
			$('.inbox').on('click', '#searchBtn', function () {
				var searchString = $('#searchField').val();
				if($.trim(searchString) != '')
				{
					loadSearchResults($(this), searchString);
				} else {
					alert('Please enter the search term!');
					return false;
				}
            });	
			//Handle Search on Enter key down
			$('#searchField').on('keydown', function(e) {
				var key = e.which;
				if (key == 13) { // As ASCII code for ENTER key is "13"
					var searchString = $('#searchField').val();
					if($.trim(searchString) != '')
					{
						var Element = $(this).next().next();
						loadSearchResults(Element, searchString);
					} else {
						alert('Please enter the search term!');
						return false;
					}
				}
			});

			/*$('.pagination').on('click', function (event) {
				//alert('sss');
				var paginationVal = $(event.target).text();
				//var clickedElement = $(event.currentTarget === this);
				event.preventDefault();
				loadpagincation(paginationVal);
            });	
             

			 var loadpagincation = function (paginationVal) {

				var url = '<?php echo site_url();?>/my_inbox/inbox_view/inbox';
				    loading.show();
					content.html('');
					//toggleButton(el);

					$.ajax({
						type: "POST",
						cache: false,
						url: url,
						data: {'pageID': paginationVal},
						dataType: "html",
						success: function(res) 
						{
							//toggleButton(el);

							$('.inbox-nav > li.active').removeClass('active');
							$('.inbox-header > h1').text('Search');

							loading.hide();
							content.html(res);
							Layout.fixContentHeight();
							Metronic.initUniform();
						},
						error: function(xhr, ajaxOptions, thrownError)
						{
							//alert(xhr.responseText);
							//toggleButton(el);
						},
						async: false
					});
				}*/
			//AJAX EMAIL INBOX PAGINATION
			$('.pagination').on('click', function(event) {
				//event.stopImmediatePropagation(); 
				//event.preventDefault();
				var clickedElement = $(event.currentTarget);
				var paginationVal = $(event.target).text();
				//alert(paginationVal);
				var url = '<?php echo site_url();?>/my_inbox/inbox_view/inbox';
		
				loading.show();
				content.html('');
				toggleButton(clickedElement);

				$.ajax({
					type: "POST",
					cache: false,
					url: url,
					data: {'pageID': paginationVal},
					dataType: "html",
					success: function(res) 
					{
						toggleButton(clickedElement);

						$('.inbox-nav > li.active').removeClass('active');
						//$('.inbox-header > h1').text('Search');
						loading.hide();
						content.html(res);
						if (Layout.fixContentHeight) {
							Layout.fixContentHeight();
						}
						Metronic.initUniform();
						event.preventDefault();
						return false;
					},
					error: function(xhr, ajaxOptions, thrownError)
					{
						//alert(xhr.responseText);
						toggleButton(clickedElement);
					},
					async: false
				});
			});
        }

    };

}();
</script>

<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins jQuery
    //Metronic.init(); // init metronic core components
	//Layout.init(); // init current layout
	//Demo.init(); // init demo features
    Inbox.init();

	$('.fa-star').click(function() {
		var tableid = $(this).attr('id');	
		$.post("<?php echo site_url();?>/my_inbox/starred",{'tableid':tableid},function(data){			
			if(data){	 
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	});

	/*$('#readall').click(function() {
		var chkId = '';
		$('.mail-checkbox:checked').each(function() {
		  chkId += $(this).val() + ",";
		});
		chkId = chkId.slice(0,-1);			
		$.post("<?php echo site_url();?>/my_inbox/makeMsgread",{'tableid':chkId},function(data){			
			if(data){	 
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	});

	$('#unreadall').click(function() {
		var chkId = '';
		$('.mail-checkbox:checked').each(function() {
		  chkId += $(this).val() + ",";
		});
		chkId = chkId.slice(0,-1);			
		$.post("<?php echo site_url();?>/my_inbox/makeMsgUnread",{'tableid':chkId},function(data){			
			if(data){	 
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	});

	$('#deleteall').click(function() {
		var chkId = '';
		$('.mail-checkbox:checked').each(function() {
		  chkId += $(this).val() + ",";
		});
		chkId = chkId.slice(0,-1);

		$.post("<?php echo site_url();?>/my_inbox/delete",{'tableid':chkId},function(data){			
			if(data){
				alert(data);
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	});*/
		
});

</script>
<script>
	function deleteMail(){
		var chkId = '';
		$('.mail-checkbox:checked').each(function() {
		  chkId += $(this).val() + ",";
		});
		chkId = chkId.slice(0,-1);

		$.post("<?php echo site_url();?>/my_inbox/delete",{'tableid':chkId},function(data){			
			if(data){
				
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	}
	function readAll(){
		var chkId = '';
		$('.mail-checkbox:checked').each(function() {
		  chkId += $(this).val() + ",";
		});
		chkId = chkId.slice(0,-1);			
		$.post("<?php echo site_url();?>/my_inbox/makeMsgread",{'tableid':chkId},function(data){			
			if(data){	 
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	}
	function unreadAll(){
		var chkId = '';
		$('.mail-checkbox:checked').each(function() {
		  chkId += $(this).val() + ",";
		});
		chkId = chkId.slice(0,-1);			
		$.post("<?php echo site_url();?>/my_inbox/makeMsgUnread",{'tableid':chkId},function(data){			
			if(data){	 
				 window.location.href='<?php echo site_url();?>/my_inbox';					
			}else{
				$("#divError").html(data).show();											
				$('#loading_main').hide(); 
			}	
		});
	}

</script>