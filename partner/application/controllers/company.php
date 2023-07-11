<?php 
class Company extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//redirect('dashboard');
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		//$_SESSION['vendor_session']=1;
		$this->load->model('statemodel');
		$this->load->model('countrymodel');
		$this->load->model('citymodel');
		$this->load->model('companymodel');
		$this->data['cur_page']=$this->router->class;
	}
	
	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }
	
	function index()
	{	$this->load->library('pagination');
		$searchterm='';
		$search_designation='';
		$start=0;
		
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
			$limit= $_GET['limit'];
		}
		else{
			$limit=100;
		}
		
		$flp_status='';
		$status='';
		$company_priority='';
		$company_rating='';
		$this->data["ind_id"]='';
		$ind_id='';
		$rows='';
		$flp_next_date='';
		$date_added='';
		$user_id='';
		$unassigned='';
		
		$country_id='';
		$state_id='';
		$city_id='';
		$building_location='';
		

		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
			$sort_by=$this->input->get("sort_by");
		}
		else
		{
			$sort_by = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		
		if($this->input->get('searchterm')!='')
		{
			$searchterm= $this->input->get('searchterm');
		}

		if($this->input->post('searchterm')!='')
		{
			$searchterm= $this->input->post('searchterm');
		}
		if($this->input->get('search_designation')!='')
		{
			$search_designation= $this->input->get('search_designation');
		}

		if($this->input->post('search_designation')!='')
		{
			$search_designation= $this->input->post('search_designation');
		}
		
		if($this->input->get('ind_id')!='')
		{
			$ind_id= $this->input->get('ind_id');
		}

		if($this->input->post('ind_id')!='')
		{
			$ind_id= $this->input->post('ind_id');
		}

		if($this->input->get('flp_status')!='')
		{
			$flp_status= $this->input->get('flp_status');
		}

		if($this->input->post('flp_status')!='')
		{
			$flp_status= $this->input->post('flp_status');
		}		

		if($this->input->post('flp_next_date')!='')
		{
			$flp_next_date= $this->input->post('flp_next_date');
		}
		
		if($this->input->get('flp_next_date')!='')
		{
			$flp_next_date= $this->input->get('flp_next_date');
		}

		if($this->input->post('date_added')!='')
		{
			$date_added= $this->input->post('date_added');
		}
		
		if($this->input->get('date_added')!='')
		{
			$date_added= $this->input->get('date_added');
		}

		if($this->input->post('user_id')!='')
		{
			$user_id= $this->input->post('user_id');
		}
		
		if($this->input->get('user_id')!='')
		{
			$user_id= $this->input->get('user_id');
		}
						
		if($this->input->get('status')!='')
		{
			$status= $this->input->get('status');
		}
		
		if($this->input->post('status')!='')
		{
			$status= $this->input->post('status');
		}
		if($this->input->get('company_priority')!='')
		{
			$company_priority= $this->input->get('company_priority');
		}

		if($this->input->post('company_priority')!='')
		{
			$company_priority= $this->input->post('company_priority');
		}	

		if($this->input->get('company_rating')!='')
		{
			$company_rating= $this->input->get('company_rating');
		}

		if($this->input->post('company_rating')!='')
		{
			$company_rating= $this->input->post('company_rating');
		}	

		if($this->input->get('unassigned')!='')
		{
			$unassigned= $this->input->get('unassigned');
		}

		if($this->input->post('unassigned')!='')
		{
			$unassigned= $this->input->post('unassigned');
		}

		if($this->input->post('country_id')!='')
		{
			$country_id= $this->input->post('country_id');
		}

		if($this->input->get('country_id')!='')
		{
			$country_id= $this->input->get('country_id');
		}

		if($this->input->post('state_id')!='')
		{
			$state_id= $this->input->post('state_id');
		}

		if($this->input->get('state_id')!='')
		{
			$state_id= $this->input->get('state_id');
		}

		if($this->input->post('city_id')!='')
		{
			$city_id= $this->input->post('city_id');
		}

		if($this->input->get('city_id')!='')
		{
			$city_id= $this->input->get('city_id');
		}

		if($this->input->post('building_location')!='')
		{
			$building_location= $this->input->post('building_location');
		}

		if($this->input->get('building_location')!='')
		{
			$building_location= $this->input->get('building_location');
		}
									
		$this->data['total_rows']= $this->companymodel->record_count($searchterm,$search_designation,$ind_id,$flp_status,$company_priority,$company_rating,$status,$flp_next_date,$date_added,$user_id,$unassigned,$city_id,$building_location);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."company/?sort_by=$sort_by&searchterm=$searchterm&search_designation=$search_designation$query_str&ind_id=".$ind_id."&flp_status=$flp_status&company_priority=$company_priority&company_rating=$company_rating&status=$status&flp_next_date=$flp_next_date&date_added=$date_added&user_id=$user_id&unassigned=$unassigned&country_id=$country_id&state_id=$state_id&city_id=$city_id&building_location=$building_location";
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = 10;
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		
		$this->data['pagination']=$this->pagination->create_links();
		$this->data["records"] = $this->companymodel->get_list($start,$limit,$searchterm,$search_designation,$ind_id,$flp_status,$sort_by,$company_priority,$company_rating,$status,$flp_next_date,$date_added,$user_id,$unassigned,$city_id,$building_location);

		$this->data["industry_list"] = $this->companymodel->industry_list_search();
		
		/*
		$this->data["lead_status_list"] = array('' => 'Call Status',
												'1' => 'We Have Openings', 
											   '2' => 'No Openings', 
											   '3' => 'Call after a month', 
											   '4' => 'Already have vendor', 
											   '5' => 'We have in house team', 
											   '6' => 'Became Client', 
											   '7' => 'Do not Disturb');
		*/	

		
		$this->data["lead_status_list"] = array('' => 'Call Status',
												'1' => 'We Have Openings', 
											   '2' => 'No Openings', 
											   '3' => 'Call after a month', 
											   '4' => 'Already have vendor', 
											   '5' => 'We have in house team', 
											   '6' => 'Became Client', 
											   '7' => 'Do not Disturb');
			
											   
		$this->data["company_priority_list"] = array('' => 'Priority',
												'1' => 'High', 
											    '2' => 'Medium', 
											    '3' => 'Low', 
												);
		$this->data["status_list"] = array('' => 'Lead Folder',
												'1' => 'Feed', 
											    '2' => 'Leads', 
											    '3' => 'Clients', 
												'4' => 'Unqualified', 
												);
		$this->data["company_rating_list"] = array('' => 'Rating',
												'1' => '1 Star', 
											    '2' => '2 Star', 
											    '3' => '3 Star', 
											    '4' => '4 Star', 
											    '5' => '5 Star', 
											    '6' => '6 Star',
											    '7' => '7 Star',
												'8' => '8 Star',
												'9' => '9 Star', 
												'10' =>  '10 Star');
											   											   											   
		$this->data["admin_list"]=$this->companymodel->admin_list();
		$this->data["bde_list"]=$this->companymodel->bde_list();

		$this->data["building_loc_list"] = $this->companymodel->building_loc_list($state_id);
		
		$this->data["city_list"] = $this->citymodel->city_list($state_id);
		$this->data["state_list"] = $this->statemodel->state_list($country_id);	
		$this->data["country_list"] = $this->companymodel->country_list();

		$this->data["flp_status"] = $flp_status;
		$this->data["status"] = $status;
		$this->data["company_priority"] = $company_priority;
		$this->data["company_rating"] = $company_rating;
		$this->data["flp_next_date"] = $flp_next_date;
		$this->data["date_added"] =$date_added;		
		$this->data["user_id"] =$user_id;	
		$this->data["unassigned"] =$unassigned;		

		$this->data["ind_id"] = $ind_id;
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["search_designation"]=$search_designation;

		$this->data["country_id"] = $country_id;
		$this->data["state_id"] = $state_id;
		$this->data["city_id"]=$city_id;
		$this->data["building_location"]=$building_location;
		$this->data["query_string"]=$_SERVER['QUERY_STRING'];
		
		$this->data['page_head'] = 'Manage Company';				
				
		$this->load->view('include/header',$this->data);
		$this->load->view('company/companylist',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	
	function import_csv()
    {    
        $this->load->model('companymodel');
		$this->load->library('upload');
        $this->data['page_head'] = 'Import CSV';

		if(isset($_FILES['userfile']))
		{	
			if (is_uploaded_file($_FILES['userfile']['tmp_name'])) 
			{         
				$csv['upload_path'] = 'uploads/';
				$csv['allowed_types'] = 'csv';
				$csv['max_size']	= '0';
				$csv['file_name'] = md5(uniqid(mt_rand()));
			
				$this->upload->initialize($csv);
				if ($this->upload->do_upload('userfile'))
				{
					$data = $this->upload->data();
					$this->fileName = $data['file_name'];
					$pathToFile = $csv['upload_path'].$this->fileName;
					if( !file_exists( $pathToFile ) ) die( 'File could not be found at: ' . $pathToFile );
       				 
					$file = fopen($pathToFile,"r");
					$keys = fgetcsv($file);
					while (!feof($file)) 
					{
						$company_data = fgetcsv($file);
						if(is_array($keys) && count($keys)!=count($company_data))
						{
							continue;
						}
						else
						{
							if(!empty($company_data))
							{
								$company_row=array_combine($keys, $company_data);
								$company[] = $company_row;
							}
						}
					}
					
					
					for($i=0;$i<count($company);$i++)
					{
						if(isset($company[$i]['city_id']) && $company[$i]['city_id'])
						{
							$query = $this->db->query("select city_id from pms_city where city_name='".$company[$i]['city_id']."'");					
							if ($query->num_rows() > 0)
							{
								$row = $query->row_array();
								$row1=$company[$i];
								$row1['city_id']=$row['city_id'];
								
								$company[$i]=$row1;
							}
						}
					}

					for($i=0;$i<count($company);$i++)
					{
						if(isset($company[$i]['admin_id']) && $company[$i]['admin_id'])
						{
							$query = $this->db->query("select admin_id from pms_admin_users  where username='".$company[$i]['admin_id']."'");					
							if ($query->num_rows() > 0)
							{
								$row = $query->row_array();
								$row1=$company[$i];
								$row1['admin_id']=$row['admin_id'];
								$row1['user_id']=$row['admin_id'];
								$row1['status']=1;
								$company[$i]=$row1;
							}
						}
					}
					
					/*
					echo '<pre>';
					print_r($company);
					echo '</pre>';
					exit();
					*/
					
					for($i=0;$i<count($company);$i++)
					{
						$data = $company[$i];
						$this->companymodel->insert_csv_records($data);
					}
					redirect('company');
				}
			}
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('company/upload-csv',$this->data);
		$this->load->view('include/footer',$this->data);		
    }
	
	
		
	function add()
	{
		$this->data['formdata']=array(
		'company_name'       => '',
		'type_id'            => '',
		'company_priority'   => '',
		'company_rating'     => '',
		'ind_id'             => '',
		'company_address'    => '',
		'company_email'      => '',
		'company_phone'      => '',		
		'company_profile'    => '',
		'specialties'        => '',
		'company_size'       => '',
		'founded'            => '',
		'contact_name'       => '',
		'designation'       => '',
		'contact_name_notes'=> '',
		'contact_email'      => '',
		'country_id'         => '',
		'state_id'           => '',
		'city_id'            => '',
		'building_location'            => '',
		'opportunity'        => '',
		'contact_phone'      => '',
		'contact_phone_1'    => '',
		'contact_phone_2'    => '',
		'contact_facebook'   => '',		
		'contact_linkedin'   => '',
		'contact_twitter'    => '',
		'location_map'   => '',
		'google_map'    => '',		
		'contact_phone_ext'  => '',
		'company_website'    => '',
		'twitter'            => '',
		'facebook'           => '',
		'linkedin'           => '',
		'googleplus'         => '',
		'company_hash'       => '',
		);
		
		$this->data['opportunity']=array();
		
		$this->load->model('companymodel');	
		
		$this->data["type_list"] = $this->companymodel->type_list();
		$this->data["industry_list"] = $this->companymodel->industry_list();
		
		$this->data["company_priority_list"] = array('' => 'Priority',
												'1' => 'High', 
											    '2' => 'Medium', 
											    '3' => 'Low', 
												);

		$this->data["company_rating_list"] = array('' => 'Rating',
												'1' => '1 Star', 
											    '2' => '2 Star', 
											    '3' => '3 Star', 
											    '4' => '4 Star', 
											    '5' => '5 Star', 
											    '6' => '6 Star',
											    '7' => '7 Star',
												'8' => '8 Star',
												'9' => '9 Star', 
												'10' =>  '10 Star');
												
		$this->data["city_list"] = array(''=>'Select City');//$this->citymodel->city_list();	
		$this->data["state_list"] = array(''=>'Select State');//$this->statemodel->state_list(0);		
		$this->data["country_list"] = $this->companymodel->country_list();
		
		if($this->input->post('company_name'))
		{
			$this->form_validation->set_rules('company_name', 'company name', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->companymodel->insert_record();
				redirect('company/?ins=1&'.$_SERVER['QUERY_STRING']);
			}

				$this->data["city_list"] = $this->citymodel->city_list($this->input->post('state_id'));	
				$this->data["state_list"] = $this->statemodel->state_list($this->input->post('country_id'));		
				$this->data["country_list"] = $this->countrymodel->country_list();
					
				// load page again for validation
				$this->data['formdata'] =	array(
				'company_name'       =>$this->input->post('company_name'),
				'type_id'            => $this->input->post('type_id'),
				'ind_id'            => $this->input->post('ind_id'),
				'company_rating'        => $this->input->post('company_rating'),
				'company_priority'   => $this->input->post('company_priority'),				
				'company_address'    =>$this->input->post('company_address'),
				'company_email'      =>$this->input->post('company_email'),
				'company_phone'      =>$this->input->post('company_phone'),				
				'company_profile'    =>$this->input->post('company_profile'),
				'specialties'        => $this->input->post('specialties'),
				'company_size'       => $this->input->post('company_size'),
				'founded'            => $this->input->post('founded'),
				'contact_name'       =>$this->input->post('contact_name'),
				'designation'       => $this->input->post('designation'),
				'contact_name_notes'=> $this->input->post('contact_name_notes'),
				'opportunity'        => $this->input->post('opportunity'),
				'country_id'         =>$this->input->post('country_id'),
				'state_id'           =>$this->input->post('state_id'),
				'city_id'            =>$this->input->post('city_id'),
				'building_location'  =>$this->input->post('building_location'),
				'contact_email'      =>$this->input->post('contact_email'),
				'contact_phone'      => $this->input->post('contact_phone'),
				'contact_phone_1'    => $this->input->post('contact_phone_1'),
				'contact_phone_2'    => $this->input->post('contact_phone_2'),
				'contact_facebook'   => $this->input->post('contact_facebook'),		
				'contact_linkedin'   => $this->input->post('contact_linkedin'),
				'contact_twitter'    => $this->input->post('contact_twitter'),
				'location_map'       => $this->input->post('location_map'),
				'google_map'         => $this->input->post('google_map'),
				'contact_phone_ext'  => $this->input->post('contact_phone_ext'),
				'company_website'    =>$this->input->post('company_website'),
				'twitter'            =>$this->input->post('twitter'),
				'facebook'           =>$this->input->post('facebook'),
				'linkedin'           =>$this->input->post('linkedin'),
				'googleplus'         =>$this->input->post('googleplus'),
				'company_hash'       =>$this->input->post('company_hash'),			
				);
		}
		$this->data["query_string"]=$_SERVER['QUERY_STRING'];
		     $path = '../js/ckfinder';
		     $width = '100%';
		    $this->editor($path, $width);
		$this->data['page_head'] = 'Add Company';
		$this->load->view('include/header',$this->data);
		$this->load->view('company/addcompany',$this->data);				
		$this->load->view('include/footer',$this->data);
				
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$this->load->model('companymodel');	
		
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Company';

			$this->data['formdata']=$this->companymodel->get_single_company($id);			
			
			if(intval($this->data['formdata']['city_id'])>0)
			{
				$query = $this->db->query("select a.*,b.* from pms_city a join pms_state b on a.state_id = b.state_id where a.city_id = ".intval($this->data['formdata']['city_id']));
				if ($query->num_rows() >0)
				{
					$row= $query->row_array();
					$this->data['formdata']['country_id'] = $row['country_id'];
					$this->data['formdata']['state_id'] = $row['state_id'];
				}else{
					$this->data['formdata']['country_id'] = 0;
					$this->data['formdata']['state_id'] = 0;
				}
			}else
			{
				$this->data['formdata']['country_id'] = 0;
				$this->data['formdata']['state_id'] = 0;
			}
			
			$this->data["type_list"] = $this->companymodel->type_list();
			$this->data["industry_list"] = $this->companymodel->industry_list();

			$this->data["company_priority_list"] = array('' => 'Priority',
												'1' => 'High', 
											    '2' => 'Medium', 
											    '3' => 'Low', 
												);

			$this->data["company_rating_list"] = array('' => 'Rating',
												'1' => '1 Star', 
											    '2' => '2 Star', 
											    '3' => '3 Star', 
											    '4' => '4 Star', 
											    '5' => '5 Star', 
											    '6' => '6 Star',
											    '7' => '7 Star',
												'8' => '8 Star',
												'9' => '9 Star', 
												'10' =>  '10 Star');
															
			$this->data["city_list"] = $this->citymodel->city_list($this->data['formdata']['state_id']);	
			$this->data["state_list"] = $this->statemodel->state_list($this->data['formdata']['country_id']);		
			$this->data["country_list"] = $this->countrymodel->country_list();
			
		    $path = '../js/ckfinder';
		    $width = '100%';
			$this->data["query_string"]=$_SERVER['QUERY_STRING'];
		    $this->editor($path, $width);
			$this->load->view('include/header',$this->data);
			$this->load->view('company/editcompany',$this->data);				
			$this->load->view('include/footer',$this->data);
		}
	}

	function update()
	{
		$this->data['page_head']= 'Edit Company';
		$this->load->model('companymodel');
				
		if($this->input->post('company_name'))
		{
			$this->data["type_list"] = $this->companymodel->type_list();

			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->companymodel->update_record($this->input->post('company_id'));
					redirect('company/?upd=1&'.$_SERVER['QUERY_STRING']);
				}else{
				
				$this->data["type_list"] = $this->companymodel->type_list();
				$this->data["industry_list"] = $this->companymodel->industry_list();

				$this->data["city_list"] = $this->citymodel->city_list($this->input->post('state_id'));	
				$this->data["state_list"] = $this->statemodel->state_list($this->input->post('country_id'));		
				$this->data["country_list"] = $this->countrymodel->country_list();	

				$this->data["lead_status_list"] = array('' => 'Lead Status',
													'1' => 'We Have Openings', 
												   '2' => 'No Openings', 
												   '3' => 'Call after a month', 
												   '4' => 'Already have vendor', 
												   '5' => 'We have in house team', 
												   '6' => 'Became Client', 
												   '7' => 'Do not Disturb');
												   
				$this->data["company_priority_list"] = array('' => 'Priority',
													'1' => 'High', 
													'2' => 'Medium', 
													'3' => 'Low', 
													);
	
				$this->data["company_rating_list"] = array('' => 'Rating',
													'1' => '1 Star', 
													'2' => '2 Star', 
													'3' => '3 Star', 
													'4' => '4 Star', 
													'5' => '5 Star', 
													'6' => '6 Star',
													'7' => '7 Star',
													'8' => '8 Star',
													'9' => '9 Star', 
													'10' =>  '10 Star');
																						
					$this->data['formdata'] =	array(
					'company_id'            =>$this->input->post('company_id'),
					'company_name'          =>$this->input->post('company_name'),
					'type_id'               => $this->input->post('type_id'),
					'company_priority'   => $this->input->post('company_priority'),
					'company_rating'     => $this->input->post('company_rating'),					
					'ind_id'            => $this->input->post('ind_id'),
					'company_address'       =>$this->input->post('company_address'),
					'company_email'         =>$this->input->post('company_email'),
					'company_phone'         =>$this->input->post('company_phone'),					
					'company_profile'       =>$this->input->post('company_profile'),
					'specialties'           => $this->input->post('specialties'),
					'company_size'          => $this->input->post('company_size'),
					'founded'               => $this->input->post('founded'),
					'opportunity'           => $this->input->post('opportunity'),
					'country_id'            =>$this->input->post('country_id'),
					'state_id'              =>$this->input->post('state_id'),
					'city_id'               =>$this->input->post('city_id'),
					'building_location'  =>$this->input->post('building_location'),						
					'contact_name'          =>$this->input->post('contact_name'),
					'designation'       => $this->input->post('designation'),
					'contact_name_notes'=> $this->input->post('contact_name_notes'),
					'contact_email'         =>$this->input->post('contact_email'),
					'contact_phone'         =>$this->input->post('contact_phone'),
					'contact_phone_1'    => $this->input->post('contact_phone_1'),
					'contact_phone_2'    => $this->input->post('contact_phone_2'),
					'contact_facebook'   => $this->input->post('contact_facebook'),		
					'contact_linkedin'   => $this->input->post('contact_linkedin'),
					'contact_twitter'    => $this->input->post('contact_twitter'),					
					'contact_phone_ext'  => $this->input->post('contact_phone_ext'),
					'company_website'       =>$this->input->post('company_website'),
					'twitter'               =>$this->input->post('twitter'),
					'facebook'              =>$this->input->post('facebook'),
					'linkedin'              =>$this->input->post('linkedin'),
					'googleplus'            =>$this->input->post('googleplus'),
					);						

					     $path = '../js/ckfinder';
		     $width = '700px';
			 $this->data["query_string"]=$_SERVER['QUERY_STRING'];
		    $this->editor($path, $width);
			$this->load->view('include/header',$this->data);
			$this->load->view('company/editcompany',$this->data);				
			$this->load->view('include/footer',$this->data);
				}
		
		}else
		{
			redirect('company');
		}
	}
	
	function delete($id=null)
	{
		redirect('company/?delete=stop');
			if(!empty($id))
			{
				
				if($this->is_related($id)){

					redirect('company/?del=2');
				}else{
					$this->db->where('company_id', $id);
					$this->db->delete('pms_company_opportunity');
									
					$this->db->where('company_id', $id);
					$this->db->delete('pms_company'); 
					redirect('company/?del=1');
				}
			}
		
		if(is_array($this->input->post('delete_rec')))
			{
				 foreach ($this->input->post('delete_rec') as $key => $val)
					{
						if($this->is_related($val)){
							redirect('company/?del=2');
							break;
						}else{
							$this->db->where('company_id', $val);
							$this->db->delete('pms_company_opportunity');
											
							$this->db->where('company_id', $val);
							$this->db->delete('pms_company'); 
						}
					}
				redirect('company/?del=1');
			}		
	}

	function add_calls()
	{
		$id =$this->input->post('company_id');
		$this->load->model('companymodel');

		if($this->input->post('company_id')!='')
		{
			$job_id=$this->companymodel->add_calls();	
			
			if($this->input->post('create_task')!='')
			{
				$task_id=$this->companymodel->add_task();
			}
			
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}

	function get_calls_history()
	{
		$this->data["records"] = $this->companymodel->get_calls_history($this->input->post('company_id'));
		$output_str='
		<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody>
				<tr class="pop_tr">
				  <td>#</td>
				  <td>Call Date</td>
				  <td>Follow up Date</td>				  
				  <td>Notes</td>
				  <td>Updated By</td>
				  </tr>';
				 if(count($this->data["records"]>0))
				 {
					 $i=0;
					 foreach($this->data["records"] as $key => $val)
					 {
						 $i+=1;
						$output_str.='<tr>';
						$output_str.='<td>'.$i.'</td>';
						
						if($val['flp_date']=='0000-00-00')
						{
							$output_str.='<td>Nill</td>';
						}else
						{
								$output_str.='<td>'.$val['flp_date'].'</td>';	
						}

						if($val['flp_next_date']=='0000-00-00')
						{
							$output_str.='<td>Nill</td>';
						}else
						{
							$output_str.='<td>'.$val['flp_next_date'].'</td>';	
						}

						if($val['flp_notes']=='')
						{
							$output_str.='<td>Nill</td>';
						}else
						{
							$output_str.='<td>'.$val['flp_notes'].'</td>';	
						}
						$output_str.='<td>'.$val['firstname'].'</td>';
						$output_str.='</tr>';
					 }
				 }else
				 {
					 exit();
				 }
			 $output_str.='</tbody></table>';
		echo $output_str;
		exit();
	}

	function get_all_contacts()
	{
		$row = $this->company_callsmodel->get_all_contacts($this->input->post('company_id'));
		$output_str='';
		$output_str.='<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody>
				<tr class="pop_tr">
				  <td width="16%">Company Name</td>
				  <td width="36%">'.$row['company_name'].'</td>				  
				  <td width="10%">Contact Name</td>
				  <td width="38%">'.$row['contact_name'].'</td>
				  </tr>
				<tr class="pop_tr">
				  <td>Designation</td>
				  <td>'.$row['designation'].'</td>
				  <td>Notes From BDM</td>
				  <td>'.$row['contact_name_notes'].'</td>
			    </tr>
				<tr class="pop_tr">
				  <td>Main Contact No</td>
				  <td>'.$row['contact_phone'].' -Ext. '.$row['contact_phone_ext'].'</td>
				  <td>Contact Number 1</td>
				  <td>'.$row['contact_phone_1'].'</td>
			    </tr>
				<tr class="pop_tr">
				  <td>Contact No 2</td>
				  <td>'.$row['contact_phone_2'].'</td>
				  <td>Email</td>
				  <td>'.$row['contact_email'].'</td>
			    </tr></tbody></table>';
		echo $output_str;
		exit();
	}
		
	function add_jobs()
	{
		$id =$this->input->post('company_id');
		$this->load->model('companymodel');

		if($this->input->post('company_id')!='')
		{
			$job_id=$this->companymodel->add_jobs();	
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}

	function assign_requirement()
	{
		$this->load->model('companymodel');

		$output_str='<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">BD Executives List</td></tr><tr><td colspan="3">&nbsp;</td></tr>';
			  
			  $this->data["records"]=array();
			  $this->data["records"] = $this->companymodel->get_assignment_recruiter($this->input->post('company_id'));

			  $output_str='<tr>
				  <td width="10%">#</td>
				  <td width="40%">BD Executives</td>
				  <td width="50%">Comments</td>
				  </tr>';
				  
				 if(count($this->data["records"]>0))
				 {
					 $i=0;
					 foreach($this->data["records"] as $key => $val)
					 {
						$i+=1;
						$output_str.='<tr>';					
						if($val['company_id']!='')	
							$output_str.='<td width="10%"><input type="checkbox" name="admin_id[]" value="'.$key.'" checked></td>';
						else
							$output_str.='<td width="10%"><input type="checkbox" name="admin_id[]" value="'.$key.'"></td>';
							
						$output_str.='<td width="40%">'.$val['username'].'</td>';
						$output_str.='<td width="50%"><input type="text" name="comments['.$key.']" value=""></td>';
						$output_str.='</tr>';
					 }
				 }
			$output_str.='</tbody></table>';
			
		echo $output_str;
		exit();
	}
	
	function save_assignment()
	{
		$this->load->model('companymodel');
		$response=array(
						'success'   => 'false',
						); 	
		
		if($this->input->post('company_id')!='')
		{
				$company_name=$this->companymodel->get_company_name($this->input->post('company_id'));
				
				$this->db->query('delete from pms_company_to_recruiter where company_id='.$this->input->post('company_id'));			
				if($this->input->post('admin_id')!='')
				{	
					$comments[]=$this->input->post('comments');
					if(count($comments>0))$comments=$comments[0];
					foreach($this->input->post('admin_id') as $key => $val)
					{
						 $return_val = $this->companymodel->add_recruiter_to_company($this->input->post('company_id'),$val);
						 if($comments[$val]!='')
						 {
							 $data = array(
							"task_title"          => $comments[$val].' | Company -'.$company_name.'| Assigned by - '.$_SESSION['firstname'],
							"company_id"          => $this->input->post('company_id'),
							"start_date"          => date('Y-m-d'),
							"due_date"            =>date('Y-m-d',strtotime("+7 day")),
							"admin_id"            => $val,
							"assigned_by"         => $_SESSION['vendor_session'],
							"task_priority_id"    => '1',
							"task_status_id"      => '1',
							"task_desc"           => $company_name.'<br>'.$comments[$val].'<br><br><br>'.$_SESSION['firstname'],
							"status"              => 1				
							);
							
							$return_val = $this->companymodel->add_task_assignment($data);
						 }
					}
				}

			$response=array(
						'status'   => 'success',
						); 	
    		header('Content-type: application/json');    					
			echo json_encode($response);				
		}
	}
		
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_jobs','key' => 'company_id','Module'=>'Projects'));
		$is_related = false;
		foreach($master_tables as $table){
			$query=$this->db->query("select * from ".$table['table']." where ".$table['key']."=".$id);
			$num_rows = (int) $query->num_rows();
			if($num_rows){
				$is_related = TRUE;
				$_SESSION['related_module'] = $table['Module'];
				break;
			}
		}
		return $is_related;
	}

	function check_dups()
	{
		$this->db->where('company_name', $this->input->post('company_name'));
		if($this->input->post('company_id') > 0)	$this->db->where('company_id !=', $this->input->post('company_id'));
		$query = $this->db->get('pms_company');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Company name already used.');
			return false;
		}
	}
	
	public function getstate()
	{
		$this->load->model('companymodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->companymodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('companymodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->companymodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	function multidelete()
	{
		$id_arr = $this->input->post('checkbox');
		if(is_array($id_arr))
		{
			foreach ($id_arr as $key => $val)
			{
				if($this->is_related($val)){
					redirect('company/?del=2');
					break;
				}else{
					$this->db->where('company_id', $val);
					$this->db->delete('pms_company_opportunity');
									
					$this->db->where('company_id', $val);
					$this->db->delete('pms_company'); 
				}
			}
		}
		redirect('company/?del=1');
	}

	function multiple_assignment()
	{
		$id_arr = $this->input->post('company_id');
		if(is_array($id_arr))
		{
			foreach ($id_arr as $key => $val)
			{
				$this->db->query('delete from pms_company_to_recruiter where company_id='.$val.' and admin_id='.$this->input->post('user_id'));			
				$this->companymodel->add_recruiter_to_company($val,$this->input->post('user_id'));
			}
		}
		redirect('company/?assigned=1');
	}
	
	
 public function sentmail($ch = '',$id = '')
	{
		$ch       = $this->input->get('ch');
		//echo $ch; exit();
		
		   /* $this->db->where('company_id',$id);
			$this->db->delete('pms_company_email');
			
			$data =array(
			'company_id' => $id,
			'email_date'   => date('Y-m-d'),
			'email_status' =>1
			);
		$this->db->insert('pms_company_email', $data); */
		
	$query = $this->db->query("select * from pms_company where company_hash='".$ch."'");
		$row = $query->row_array();
			
		$subject = ' Candidate List for '.$row['company_name'];
		
		$mail_body='<!DOCTYPE html>
			<head><title>'.$this->config->item('websites').' - Reset Password</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />			
			<style type="text/css">			
			body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
			html{width: 100%; }
			img {border:0px;text-decoration:none;display:block; outline:none;}
			a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
			table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
			
			img[class=imageScale]			{}
			
			.main-bg{ background:#3b3b3b;}
			.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
			.space1{padding:35px 35px 35px 35px;}
			.contact-space{padding:15px 24px 15px 24px;}
			table[class=social]{ text-align:right;}
			.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
			.border-bg{ border-top:#67bd3c solid 4px;}
			.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
			.borter-inner-top{ border-top:#37a166 solid 1px;}
			.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
			.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
			.header-space{padding:0px 20px 0px 20px;}
			
			@media only screen and (max-width:640px)
			{
				body{width:auto!important;}
				.main{width:440px !important;margin:0px; padding:0px;}
				.two-left{width:440px !important; text-align: center!important;}
				.two-left-inner{width: 376px !important; text-align: center!important;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			
			@media only screen and (max-width:479px)
			{
				 body{width:auto!important;}
				.main{width:280px !important;margin:0px; padding:0px;}
				.two-left{width: 280px !important; text-align: center!important;}
				.two-left-inner{width: 216px !important; text-align: center!important;}
				.space1{padding:35px 0px 35px 0px;}
				table[class=social]{ width:100%; text-align:center; margin-top:20px;}
				table[class=contact]{ width:100%; text-align:center; font:12px;}
				.contact-space{padding:15px 0px 15px 0px;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			</style>
			</head>			
			<body>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
			  <tr>
				<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
				
			  <!--  Main Table Start-->
				
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top">
					
					<!--  Header Part Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
							<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
						  </tr>
						</table></td>
					  </tr>
					  </table>					  
					  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					   <tr>
			
						 <td align="center" valign="top">

					
					<!--  Call Part Start-->
					<table  border="0" align="right" cellpadding="0" cellspacing="0" class="two-left">
			  <tr>
				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">Call Us :</span> Phone:+91 799 485 2225 </td>
			  </tr>
			</table>
			<!--  Call Part End-->
						 
						 </td>
					   </tr>
					 </table></td>
					</tr>
				</table></td>
				</tr>
			</table>			
			<!--  Banner Part Start-->
			<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top">&nbsp;</td>
				</tr>
			  <tr>
				<td align="left" valign="top">
				
				<!--  Banner Text Start-->
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['company_name'].',</strong><br />
							<p>
						  	Please Click here to View Applied Candidate:<br>'.$this->config->item('website').'/candidates?ch='.$row['company_hash'].'
						  </p>
						  <p>Thank You ! <br>
						 '.$this->config->item('web_site').'</p></td>
						</tr>
					  </table></td>
				  </tr>
				  </table>
				<!--  Banner Text End-->			
				</td>
			  </tr>
			</table>			
			<!--  Banner Part End-->			
			<!--  Header Part End-->					  
					  </td>
				  </tr>				  
				  <tr>
					<td align="left" valign="top">
					<!--  Footer Part Start-->
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
					 <p style="text-align:center; font-weight:bold;">'.$this->config->item('web_site').'</p>

			<center>
			'.$this->config->item('company_name').' || '.$this->config->item('powered_by_address').' '.$this->config->item('powered_by_address1').' || Telephone: '.$this->config->item('phone_number').' || Email: '.$this->config->item('company_gmail').'</center></p></td>
					  </tr>

					</table>
					<!--  Footer Part End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Main Table End-->
				
				</td>
			  </tr>
			</table>
			</body>
			
			</html>
		';
	    //echo $mail_body;
		//exit();
		
		$headers='From: '.$this->config->item('company_name').' \r\n';
		$headers.='Reply-To: '.$this->config->item('web_site').'\r\n';
		$headers.='X-Mailer: PHP/' . phpversion().'\r\n';
		$headers.= 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1 \r\n';
		//mail($row['contact_email'], $subject, $mail_body, $headers);
		mail('athiratk21@gmail.com', $subject, $mail_body, $headers);
			
			redirect('company/');
			exit();
			
		
	}	
	
	
			
}
?>
