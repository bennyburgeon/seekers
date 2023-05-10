<?php
if(isset($replyof['email_status']) && $replyof['email_status']=='inbox'){
	$to=(isset($replyof['sender_email']) && $replyof['sender_email']!='') ? $replyof['sender_email']:((isset($replyof['to_emailid']) && $replyof['to_emailid']!='') ? $replyof['to_emailid']:'');
}elseif(isset($replyof['email_status']) && $replyof['email_status']=='sent'){
	$to=(isset($replyof['to_emailid']) && $replyof['to_emailid']!='') ? $replyof['to_emailid']:((isset($replyof['sender_email']) && $replyof['sender_email']!='') ? $replyof['sender_email']:'');
}else{
	$to=(isset($replyof['to_emailid']) && $replyof['to_emailid']!='') ? $replyof['to_emailid']:'';
}
?>
<form class="inbox-compose form-horizontal" id="fileupload" action="<?php echo $this->config->site_url();?>/my_inbox/send_message" method="POST" enctype="multipart/form-data">

	<div class="inbox-compose-btn">
		<button class="btn blue" type="submit" name="send" value="sendmsg" id="send"><i class="fa fa-check"></i>Send</button>
		<button class="btn" type="submit" name="discard" value="discardmsg" id="discard">Discard</button>
		<button class="btn" type="submit" name="draft" value="draftmsg" id="draft">Draft</button>
		<input type="hidden" name="message_id" value="<?php echo (isset($replyof['message_id']) && $replyof['message_id']>0) ? $replyof['message_id']:''?>">
		<input type="hidden" name="email_status" value="<?php echo (isset($replyof['email_status']) && $replyof['email_status']!='') ? $replyof['email_status']:''?>">
	</div>
	<div class="inbox-form-group mail-to">
		<label class="control-label">To:</label>
		<div class="controls controls-to">
			
            <input type="text" class="form-control required multiemails" name="to" value="<?php echo $to;?>" id="to">
			<span class="inbox-cc-bcc">
			<span class="inbox-cc" <?php echo (isset($replyof['cc']) && $replyof['cc']!='') ? "style='display:none'":''?>>
			Cc </span>
			<span class="inbox-bcc" <?php echo (isset($replyof['bcc']) && $replyof['bcc']!='') ? "style='display:none'":''?>>
			Bcc </span>
			</span>
		</div>
	</div>
	<div class="inbox-form-group input-cc <?php echo (isset($replyof['cc']) && $replyof['cc']=='') ? "display-hide":''?>">
		<a href="javascript:;" class="close">
		</a>
		<label class="control-label">Cc:</label>
		<div class="controls controls-cc">
			<input type="text" name="cc" class="form-control multiemails" value="<?php echo (isset($replyof['sender_email']) && $replyof['sender_email']!='') ? $replyof['sender_email']:''?>">
		</div>
	</div>
	<div class="inbox-form-group input-bcc <?php echo (isset($replyof['bcc']) && $replyof['bcc']=='') ? "display-hide":''?>">
		<a href="javascript:;" class="close">
		</a>
		<label class="control-label">Bcc:</label>
		<div class="controls controls-bcc">
			<input type="text" name="bcc" class="form-control multiemails" value="<?php echo (isset($replyof['bcc']) && $replyof['bcc']!='') ? $replyof['bcc']:''?>">
		</div>
	</div>
	<div class="inbox-form-group">
		<label class="control-label">Subject:</label>
		<div class="controls">
			<input type="text" class="form-control" name="subject" value="Re: <?php echo (isset($replyof['subject']) && $replyof['subject']!='') ? $replyof['subject']:''?>" id="subject">
		</div>
	</div>
	<div class="inbox-form-group">
		<div class="controls-row">
			<textarea class="inbox-editor inbox-wysihtml5 form-control required" name="message_text" rows="12" id="message_text">
           <br /><br />
	    <?php echo (isset($replyof['message_text']) && $replyof['message_text']!='') ? $replyof['message_text']:''?>            
            </textarea>	
		</div>
	</div>
    
	<div class="inbox-compose-attachment">
		 <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7" style="width:70%">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
	</div>
    <!-- The template to display files available for upload -->
	<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload fade">
			<td>
				<span class="preview"></span>
			</td>
			<td>
				<p class="name">{%=file.name%}</p>
				<strong class="error text-danger"></strong>
			</td>
			<td>
				<p class="size">Processing...</p>
				<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
			</td>
			<td>
				{% if (!i && !o.options.autoUpload) { %}
					<button class="btn btn-primary start" disabled>
						<i class="glyphicon glyphicon-upload"></i>
						<span>Start</span>
					</button>
				{% } %}
				{% if (!i) { %}
					<button class="btn btn-warning cancel">
						<i class="glyphicon glyphicon-ban-circle"></i>
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>
	<!-- The template to display files available for download -->
	<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download fade">
			<td>
				<span class="preview">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
				</span>
			</td>
			<td>
				<p class="name">
					{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
						<input type="hidden" name="attachfiles[]" value="{%=file.name%}">
					{% } else { %}
						<span>{%=file.name%}</span>
					{% } %}
				</p>
				{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
				{% } %}
			</td>
			<td>
				<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td>
				{% if (file.deleteUrl) { %}
					<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<i class="glyphicon glyphicon-trash"></i>
						<span>Delete</span>
					</button>
					<input type="checkbox" name="delete" value="1" class="toggle">
				{% } else { %}
					<button class="btn btn-warning cancel">
						<i class="glyphicon glyphicon-ban-circle"></i>
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>
	<div class="inbox-compose-btn">
		<button class="btn blue" type="submit" name="send" value="sendmsg" id="send"><i class="fa fa-check"></i>Send</button>
		<button class="btn" type="submit" name="discard" value="discardmsg" id="discard">Discard</button>
		<button class="btn" type="submit" name="draft" value="draftmsg" id="draft">Draft</button>
	</div>
</form>
<script>	
$(function() {  
	$('.inbox-wysihtml5').wysihtml5();	
	
	/*jQuery.validator.addMethod(
		"multiemails",
		 function(value, element) {		 
			 if (this.optional(element)) // return true on optional element
				 return true;
			 var emails = value.split(/[;,\n]+/); // split element by , and ;
			 valid = true;			 
			 for (var i in emails) {
				 value = $.trim(emails[i]);
				 if(value!=''){
				 valid = valid &&
						 jQuery.validator.methods.email.call(this, $.trim(value), element);
				 }
			 }
			 return valid;
		 },

	   "Please enter valid email id."
	);*/
	
	
	$("#fileupload").validate({   
		submitHandler: function(form) {		
			queryString = $('#fileupload').serializeArray();
			document.getElementById("fileupload").submit();		
		}
	});	
	$("#draft,#discard").click(function(){
		$('input,textarea').removeClass('required');
	});
	$("#send").click(function(){
		$('#to,#subject,#message_text').addClass('required');
	});
});  
</script>