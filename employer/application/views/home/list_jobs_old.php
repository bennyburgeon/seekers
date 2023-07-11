
<div class="container-fluid searchbox ">
  <div class="container">
    <form id="search_form" action="<?php echo site_url('home/'); ?>" name="search_form" method="get" enctype="multipart/form-data" >
      <div class="form-group row">
        <div class="col-lg-2 col-md-3 col-sm-4">
          <label style="color:#f5f5fb;">Search</label>
          <input type="text" value="<?php echo $search_text?>" placeholder="S e a r c h ... " name="search_text" class="form-control form-control-sm input-sm">
        </div>
        <div class="col-lg-1 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;">Industry</label>
          <?php echo form_dropdown('job_cat_id',  $industry_list, $job_cat_id,' class="form-control form-control-sm input-sm"');?> </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;">Department</label>
          <?php echo form_dropdown('func_id',  $functional_list, $func_id,' class="form-control input-sm"');?> </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;">Designation</label>
          <?php echo form_dropdown('desig_id',  $roles_list, $desig_id,' class="form-control input-sm"');?> </div>
        <div class="col-lg-1 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;">Experience</label>
          <?php echo form_dropdown('total_exp_needed',  $experience, $total_exp_needed,' class="form-control input-sm"');?> </div>
        <div class="col-lg-1 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;" >Salary</label>
          <?php echo form_dropdown('salary_id',  $salary_list, $salary_id,' class="form-control input-sm"');?> </div>
        <div class="col-lg-1 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;">State</label>
          <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?> </div>
        <div class="col-lg-1 col-md-2 col-sm-3">
          <label style="color:#f5f5fb;">City</label>
          <?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?> </div>
        <div class="col-lg-1 col-md-2 col-sm-3" style="padding-top: 23px;">
          <button class="btn btn-primary " type="submit" >Search</button>
        </div>
      </div>
    </form>
  </div>
</div>
<br/>
<div class="container-fluid">
  <div class="container">
    <div class="panel panel-default"> <?php echo $pagination;?>
      <div class="panel-heading"><strong>
        <h4><i class="fa fa-files-o" aria-hidden="true"></i><strong> All Jobs</strong> <span class="badge "> <?php echo $total_rows;?> </span>
          <button style="margin-right: 15px; height: 33px;" type="button" onClick="window.location='<?php echo site_url('home/'); ?>';" class="btn btn-primary pull-right btn-sm"><strong>Reset All Search Filters</strong></button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row box">
          <?php //echo $left_search_form;?>
          <div class="col-sm-12">
            <?php 
				if(isset($jobs) && !empty($jobs))
				{
				 foreach($jobs as $job)
				 {
		  ?>
            <div class="panel panel-primary">
              <div class="panel-heading"><strong><a style="color:white;" href="<?php echo $this->config->base_url();?>home/job_details?job_id=<?php echo md5($job['job_id']); ?><?php if($hrcode!='')echo '&hrcode='.$hrcode;?>"><?php echo $job['job_title']; ?>
                <div style="float:right;">Job ID: <?php echo $this->config->item('job_prefix')?>-<?php echo $job['job_id']; ?></div>
                </strong> </a> </div>
                <div class="row" style="margin-left:20px;">
                <div style="float: left;width: 50%;padding: 10px;">
                    <div><i class="fa fa-industry icon_color" aria-hidden="true"></i> <strong>Designation:</strong>
                  <?php if($job['desig_name']!='')echo $job['desig_name'];else echo 'NA' ?>
                </div>
                    <div><i class="fa fa-industry icon_color" aria-hidden="true"></i> <strong>Industry:</strong>
                  <?php if($job['job_cat_name']!='')echo $job['job_cat_name'];else echo 'NA' ?>
                </div>
                   <div> <i class="fa fa-map-marker icon_color" aria-hidden="true"></i><strong> Location:</strong>&nbsp;
                  <?php if($job['job_loc']!='' && $job['job_loc']!='0'){ ?>
                  <?php echo $job['job_loc']; ?>
                  <?php }else{ ?>
                  NA
                  <?php } ?>
                </div> 
                    <div> <i class="fa fa-usd icon_color" aria-hidden="true"></i><strong> Salary:</strong>&nbsp;
                    <?php if($job['min_salary']!='' && $job['min_salary']!=0 || $job['max_salary']!='' && $job['max_salary']!=0) {?>
                    <?php echo $this->config->item('currency_symbol');?>
          <?php if($job['min_salary']!='' && $job['min_salary']!=0){ ?>
                   <?php echo $job['min_salary']; }?>
                     <?php if($job['max_salary']!='' && $job['max_salary']!=0){
                    echo " To ".$job['max_salary']; }?>
                      <?php }else{ ?>
                  NA
                  <?php } ?>              
                </div>
                    </div>
                    <div style="float: left;width: 50%;padding: 10px;">
                    <div> <i class="fa fa-graduation-cap icon_color" aria-hidden="true"></i><strong> Eligibility:</strong>&nbsp;
                  <?php if($job['level_name']!=''){ ?>
                  <?php echo $job['level_name']; ?>
                  <?php }else{ ?>
                  NA
                  <?php } ?>
                </div>
                        <div><i class="fa fa-user icon_color" aria-hidden="true"></i> Course Name: <strong>
                  <?php if($job['course_name']!='' && $job['course_name']!='0') echo $job['course_name']; else echo 'NA';?>
                  </strong> </div>
                                     
   
                    <div> <i class="fa fa-flask icon_color" aria-hidden="true"></i><strong> Experience:</strong>&nbsp;
                  <?php if($job['exp_range']!=''){ ?>
                  <?php echo $job['exp_range']; ?>
                  <?php }else{ ?>
                  NA
                  <?php } ?>
                </div>      
                <div> <i class="fa fa-user icon_color" aria-hidden="true"></i><strong> Gender:</strong>&nbsp;
                  <?php if($job['gender']=='0')echo 'No Preference'; ?>
                  <?php if($job['gender']=='1')echo 'Female'; ?>
                  <?php if($job['gender']=='2')echo 'Male'; ?>
                    </div>
                   </div> 
                    
                      <div>
                  <?php if($job['job_desc']!=''){ ?>
                          Description : </br><?php echo $job['job_desc']; ?>
                  <?php }else{ ?>
            
                  <?php } ?>
                </div>
                </div>
              
              <div class="panel-body">
   
                <div class="col-sm-12 "> 
                  
                  
                  <?php if(isset($job['job_applied']) && $job['job_applied']>0){ ?>
                  <a href="javascript:;" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Applied</a>
                  <?php }else{ ?>
                  <button type="button" onClick="window.location='<?php echo $this->config->base_url();?>home/job_details?job_id=<?php echo md5($job['job_id']); ?><?php if($hrcode!='')echo '&hrcode='.$hrcode;?>'" class="btn btn-primary pull-right btn-sm"><strong>Apply</strong></button>
                  <?php } ?>
                  
                  
                </div>
              </div>
            </div>
            <?php } }else{ ?>
            <div class="panel panel-primary">
              <div class="panel-heading"><strong>Empty Search Result....</strong> </div>
              <div class="panel-body"> <br>
                <br>
                Your search shows an empty result. Please try with other options.<br>
                <br>
                <button type="button" style="margin-right: 6px; padding-bottom: 8px;" onClick="window.location='<?php echo site_url('home/'); ?>';" class="btn btn-primary pull-right btn-sm"><strong>Reset All Search Filters</strong></button>
                <br>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php echo $pagination;?> </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('scripts/jquery-2.1.3.min.js');?>"></script> 
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script> 
<script src="<?php echo base_url('scripts/jquery-1.11.3.min.js');?>"></script> 
<script src="<?php echo base_url('scripts/bootstrap.min.js');?>"></script> 
<script type="text/javascript">
	var job_id = 0;

	$( '#search_form_ajax' ).submit( function ( evt ) {
		evt.preventDefault();
		if ( !isContactValid ) {
			return false;
		}

		$.ajax( {
			type: "post",
			url: "<?php echo $this->config->site_url();?>home/get_result",
			cache: false,
			data: {
				username: $( '#username' ).val()
			},
			success: function ( data ) {
				try {
					var ret = jQuery.parseJSON( data );
					if ( ret[ 'status' ] == '1' ) {
						alert( 'Email already exist. Please change.' );
						return false;
					} else {
						$( '#register_form' ).submit();
						return true;
					}
				} catch ( e ) {
					alert( 'Exception occured while chekcing email duplication' );
					return false;
				}
			},
			error: function () {
				alert( 'An Error has been found on Ajax request from duplicate check [Email]' );
				return false;
			}
		} ); //end ajax
	} );
</script> 

<!-- Facebook like button --> 
<script>
	window.fbAsyncInit = function () {
		FB.init( {
			appId: '1843679489200752',
			cookie: true,
			xfbml: true,
			version: 'v2.8'
		} );
		FB.AppEvents.logPageView();
	};

	( function ( d, s, id ) {
		var js, fjs = d.getElementsByTagName( s )[ 0 ];
		if ( d.getElementById( id ) ) {
			return;
		}
		js = d.createElement( s );
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore( js, fjs );
	}( document, 'script', 'facebook-jssdk' ) );
</script> 
<script>
	$( '.shareBtn' ).click( function ( e ) {
		FB.ui( {
			method: 'feed',
			link: $( this ).attr( 'data-url' ),
			caption: $( this ).attr( 'title' ),
			description: $( this ).attr( 'caption' ),
		}, function ( response ) {} );
	} );


	<!-- Facebook like button -->
</script> 
<script type="in/Login"></script> 

<!--  Linkedin Butoon --> 

<script>
	function linkedin( job_url, job_title, job_summary, link_source ) {
		window.open( 'http://www.linkedin.com/shareArticle?mini=true&url=' + job_url + '&title=' + job_title + '&summary=' + job_summary + '&source=' + link_source, '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0' );
	}
</script> 
<!--  Linkedin Butoon end here --> 

<!--  Twitter Butoon --> 
<script>
	window.twttr = ( function ( d, s, id ) {
			var js, fjs = d.getElementsByTagName( s )[ 0 ],
				t = window.twttr || {};
			if ( d.getElementById( id ) ) return t;
			js = d.createElement( s );
			js.id = id;
			js.src = "https://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore( js, fjs );

			t._e = [];
			t.ready = function ( f ) {
				t._e.push( f );
			};
			return t;
		}
		( document, "script", "twitter-wjs" ) );
	twttr.widgets.load();
</script> 
<script type="text/javascript">
	$( '#country_id' ).change( function () {

		jQuery( '#state_id' ).html( '' );
		jQuery( '#state_id' ).append( '<option value="">Select State</option' );

		jQuery( '#city_id' ).html( '' );
		jQuery( '#city_id' ).append( '<option value="">Select City</option' );

		if ( $( '#country_id' ).val() == '' ) return;

		$.ajax( {
			type: 'POST',
			url: '<?php echo $this->config->site_url();?>home/getstate/',
			data: {
				country_id: $( '#country_id' ).val()
			},
			dataType: 'json',

			beforeSend: function () {
				jQuery( '#state_id' ).html( '' );
				jQuery( '#state_id' ).append( '<option value="">Loading...</option' );
			},

			success: function ( data ) {
				if ( data.success == true ) {
					jQuery( '#state_id' ).html( '' );
					$.each( data.state_list, function ( index, value ) {
						if ( index == '' )
							jQuery( '#state_id' ).append( '<option value="' + index + '" selected="selected">' + value + '</option' );
						else
							jQuery( '#state_id' ).append( '<option value="' + index + '">' + value + '</option' );
					} );

				}
			},

			error: function () {
				alert( 'Problem with server. Pelase try again' );
				jQuery( '#state_id' ).html( '' );
				jQuery( '#state_id' ).append( '<option value="">Select State</option' );
			}
		} );
	} );
	$( '#state_id' ).change( function () {

		jQuery( '#city_id' ).html( '' );
		jQuery( '#city_id' ).append( '<option value="">Select City</option' );

		if ( $( '#state_id' ).val() == '' ) return;

		$.ajax( {
			type: 'POST',
			url: '<?php echo $this->config->site_url();?>home/getcity/',
			data: {
				state_id: $( '#state_id' ).val()
			},
			dataType: 'json',

			beforeSend: function () {
				jQuery( '#city_id' ).html( '' );
				jQuery( '#city_id' ).append( '<option value="">Loading...</option' );
			},

			success: function ( data ) {
				if ( data.success == true ) {
					jQuery( '#city_id' ).html( '' );
					$.each( data.city_list, function ( index, value ) {
						if ( index == '' )
							jQuery( '#city_id' ).append( '<option value="' + index + '" selected="selected">' + value + '</option' );
						else
							jQuery( '#city_id' ).append( '<option value="' + index + '">' + value + '</option' );
					} );
				} else {
					alert( data.success );
				}
			},

			error: function () {
				alert( 'Problem with server. Pelase try again' );
				jQuery( '#city_id' ).html( '' );
				jQuery( '#city_id' ).append( '<option value="">Select City</option' );
			}
		} );
	} );
</script> 

<!--  Twitter Butoon -->