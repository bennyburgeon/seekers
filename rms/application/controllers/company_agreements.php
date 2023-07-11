<?php 
class Company_agreements extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		//$_SESSION['admin_session']=1;
		$this->load->model('statemodel');
		$this->load->model('countrymodel');
		$this->load->model('citymodel');
		$this->load->model('company_agreementsmodel');
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
		$start=0;
		
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
			$limit= $_GET['limit'];
		}
		else{
			$limit=10;
		}
		
		$flp_status='';
		$status='';
		$company_priority='';
		$company_rating='';
		$this->data["ind_id"]='';
		$ind_id='';
		$rows='';
		
		
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

		$this->data['total_rows']= $this->company_agreementsmodel->record_count($searchterm,$ind_id,$flp_status,$company_priority,$company_rating,$status);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."index.php/company_agreements/?sort_by=$sort_by&searchterm=$searchterm$query_str&ind_id=".$ind_id."&flp_status=$flp_status&company_priority=$company_priority&company_rating=$company_rating&status=$status";
		
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
		$this->data["records"] = $this->company_agreementsmodel->get_list($start,$limit,$searchterm,$ind_id,$flp_status,$sort_by,$company_priority,$company_rating,$status);

		$this->data["industry_list"] = $this->company_agreementsmodel->industry_list();

/*		
		$this->data["lead_status_list"] = array('' => 'Lead Status',
												'1' => 'We Have Openings', 
											   '2' => 'No Openings', 
											   '3' => 'Call after a month', 
											   '4' => 'Already have vendor', 
											   '5' => 'We have in house team', 
											   '6' => 'Became Client', 
											   '7' => 'Do not Disturb');
*/
		$this->data["lead_status_list"] = array(''       => 'Call Status',
												'1'      => 'Contact Updated & Profile Sent',
												'2'      => 'Followed up - Call Later', 
											    '3'      => 'Positive Response - Need Follow up', 
											    '4'      => 'Meeting Arranged & Proposal Sent', 
											    '5'      => 'Active Client - Have Business', 
											    '6'      => 'Inactive Client - Need Follow up', 
											    '7'      => 'No Need to Follow up');
																							   
		$this->data["company_priority_list"] = array('' => 'Priority',
												'1' => 'High', 
											    '2' => 'Medium', 
											    '3' => 'Low', 
												);
		$this->data["status_list"] = array('' => 'Lead Folder',
												'1' => 'Just a Lead', 
											    '2' => 'In Process', 
											    '3' => 'Clients', 
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
											   											   											   
		$this->data["admin_list"]=$this->company_agreementsmodel->admin_list();
		
		$this->data["flp_status"] = $flp_status;
		$this->data["status"] = $status;
		$this->data["company_priority"] = $company_priority;
		$this->data["company_rating"] = $company_rating;
		
		$this->data["ind_id"] = $ind_id;
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Company';				
				
		$this->load->view('include/header',$this->data);
		$this->load->view('company_agreements/companylist',$this->data);
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
		'contact_email'      => '',
		'country_id'         => '',
		'state_id'           => '',
		'city_id'            => '',
		'opportunity'        => '',
		'contact_phone'      => '',
		'company_website'    => '',
		'twitter'            => '',
		'facebook'           => '',
		'linkedin'           => '',
		'googleplus'         => '',
		);
		
		$this->data['opportunity']=array();
		
		$this->load->model('company_agreementsmodel');	
		
		$this->data["type_list"] = $this->company_agreementsmodel->type_list();
		$this->data["industry_list"] = $this->company_agreementsmodel->industry_list();

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
		$this->data["country_list"] = $this->countrymodel->country_list();
		
		if($this->input->post('company_name'))
		{
			$this->form_validation->set_rules('company_name', 'company name', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->company_agreementsmodel->insert_record();
				redirect('company_agreements/?ins=1');
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
				'opportunity'        => $this->input->post('opportunity'),
				'country_id'         =>$this->input->post('country_id'),
				'state_id'           =>$this->input->post('state_id'),
				'city_id'            =>$this->input->post('city_id'),
				'contact_email'      =>$this->input->post('contact_email'),
				'contact_phone'      =>$this->input->post('contact_phone'),
				'company_website'    =>$this->input->post('company_website'),
				'twitter'            =>$this->input->post('twitter'),
				'facebook'           =>$this->input->post('facebook'),
				'linkedin'           =>$this->input->post('linkedin'),
				'googleplus'         =>$this->input->post('googleplus'),		
				);
		}
		     $path = '../js/ckfinder';
		     $width = '100%';
		    $this->editor($path, $width);
		$this->data['page_head'] = 'Add Company';
		$this->load->view('include/header',$this->data);
		$this->load->view('company_agreements/addcompany',$this->data);				
		$this->load->view('include/footer',$this->data);
				
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$this->load->model('company_agreementsmodel');	
		
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Company';

			$this->data['formdata']=$this->company_agreementsmodel->get_single_company($id);			
			
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
			
			$this->data["type_list"] = $this->company_agreementsmodel->type_list();
			$this->data["industry_list"] = $this->company_agreementsmodel->industry_list();

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
			
		    $this->editor($path, $width);
			$this->load->view('include/header',$this->data);
			$this->load->view('company_agreements/editcompany',$this->data);				
			$this->load->view('include/footer',$this->data);
		}
	}

	function update()
	{
		$this->data['page_head']= 'Edit Company';
		$this->load->model('company_agreementsmodel');
				
		if($this->input->post('company_name'))
		{
			$this->data["type_list"] = $this->company_agreementsmodel->type_list();

			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->company_agreementsmodel->update_record($this->input->post('company_id'));
					redirect('company_agreements/?upd=1');
				}else{
				
				$this->data["type_list"] = $this->company_agreementsmodel->type_list();
				$this->data["industry_list"] = $this->company_agreementsmodel->industry_list();

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
					'contact_name'          =>$this->input->post('contact_name'),
					'contact_email'         =>$this->input->post('contact_email'),
					'contact_phone'         =>$this->input->post('contact_phone'),
					'company_website'       =>$this->input->post('company_website'),
					'twitter'               =>$this->input->post('twitter'),
					'facebook'              =>$this->input->post('facebook'),
					'linkedin'              =>$this->input->post('linkedin'),
					'googleplus'            =>$this->input->post('googleplus'),
					);						

					     $path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
			$this->load->view('include/header',$this->data);
			$this->load->view('company_agreements/editcompany',$this->data);				
			$this->load->view('include/footer',$this->data);
				}
		
		}else
		{
			redirect('company');
		}
	}
	
	function delete($id=null)
	{
		redirect('company_agreements/?delete=stop');
			if(!empty($id))
			{
				
				if($this->is_related($id)){

					redirect('company_agreements/?del=2');
				}else{
					$this->db->where('company_id', $id);
					$this->db->delete('pms_company_opportunity');
									
					$this->db->where('company_id', $id);
					$this->db->delete('pms_company'); 
					redirect('company_agreements/?del=1');
				}
			}
		
		if(is_array($this->input->post('delete_rec')))
			{
				 foreach ($this->input->post('delete_rec') as $key => $val)
					{
						if($this->is_related($val)){
							redirect('company_agreements/?del=2');
							break;
						}else{
							$this->db->where('company_id', $val);
							$this->db->delete('pms_company_opportunity');
											
							$this->db->where('company_id', $val);
							$this->db->delete('pms_company'); 
						}
					}
				redirect('company_agreements/?del=1');
			}		
	}

	function add_calls()
	{
		$id =$this->input->post('company_id');
		$this->load->model('company_agreementsmodel');

		if($this->input->post('company_id')!='')
		{
			$job_id=$this->company_agreementsmodel->add_calls();	
			
			if($this->input->post('create_task')!='')
			{
				$task_id=$this->company_agreementsmodel->add_task();
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

	function add_jobs()
	{
		$id =$this->input->post('company_id');
		$this->load->model('company_agreementsmodel');

		if($this->input->post('company_id')!='')
		{
			$job_id=$this->company_agreementsmodel->add_jobs();	
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

	function add_agreement()
	{
		$this->load->library('upload');
		$id =$this->input->post('company_id');
		$this->load->model('company_agreementsmodel');
		
		if($this->input->post('company_id')!='')
		{
			
			
			if (is_uploaded_file($_FILES['agreement_file']['tmp_name'])) 
			{         
			
				$csv['upload_path'] = 'uploads/agreements';
				$csv['allowed_types'] = 'pdf|doc|docx|jpg|png|gif|jpeg';
				$csv['max_size']	= '0';
				$csv['file_name'] = md5(uniqid(mt_rand()));
				$this->upload->initialize($csv);
				if ($this->upload->do_upload('agreement_file'))
				{
					$data_agreement = $this->upload->data();
					$data=array(
					'date_uploaded'     => $this->input->post('date_uploaded') ,
					'company_id'        => $this->input->post('company_id') ,
					'agreement_note'    => $this->input->post('agreement_note') ,
					'agreement_file'    => $data_agreement['file_name'],
					'admin_id'          => $_SESSION['admin_session'],
					);
					
					$agreement_id=$this->company_agreementsmodel->add_agreement($data);
					redirect('company_agreements?agreement=1');
				}
			}
		}
		redirect('company_agreements?agreement=1');
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
		
//import csv
	function import_csv()
    {    
        $this->load->model('company_agreementsmodel');
            $this->data['module_action'] = 'Import CSV';
            
           // $this->data['module_head']= 'Import CSV';
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']    = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite']  = 'TRUE';
        $config['file_name']  = date('Ymdhis');

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
           // $error=$this->upload->display_errors();
          //  echo $error;
            $this->data['menu_flow_visted']=1;
        $this->data['menu']=$this->load->view('includes/menu',$this->data,true);
        $this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);
        
        
        $this->load->view('includes/header');    
        $this->load->view('company_agreements/import_csv',$this->data);                
        $this->load->view('includes/footer');        
        
        }
        else
        {
            $data = $this->upload->data();
            $this->fileName = $data['file_name'];
            $pathToFile = $config['upload_path'].$this->fileName;

            if( !file_exists( $pathToFile ) ) die( 'File could not be found at: ' . $pathToFile );
            $file = fopen($pathToFile,"r");

            $keys = fgetcsv($file);
      
            while (!feof($file)) {
                $company_data = fgetcsv($file);
                 
                if(count($keys)!=count($company_data))
                {
                    continue;
                }
                else
                {
                    if(!empty($company_data))
                    {
                        $company[] = array_combine($keys, $company_data);
                    
                    }
                }
            }
			
            for($i=0;$i<count($company);$i++){

                $data = $company[$i];
               /* $this->email=$company[$i]['company_email'];
                # Check if mail exists
                $query = $this->db->get_where('pms_company',array('company_email'=>$this->email));
                if($query->num_rows() > 0)
                {
        # E-mail is found in the database
                    $this->company_agreementsmodel->insert_to_temp($data);
                }
                else{*/
                $this->company_agreementsmodel->insert_csv_records($data);
            //}
            }
            $this->session->set_flashdata('msg',$msg_data);
            redirect('company_agreements/');
        }        
    }
	
	function get_calls_history()
	{
		$this->data["records"] = $this->company_agreementsmodel->get_calls_history($this->input->post('company_id'));
		$output_str='<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody>
				<tr>
				  <td>#</td>
				  <td>Call Date</td>
				  <td>Follow up Date</td>
				  <td>Details</td>
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

	function get_agreement_history()
	{
		$this->data["records"] = $this->company_agreementsmodel->get_agreements_history($this->input->post('company_id'));
		$output_str='<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody>
				<tr>
				  <td>#</td>
				  <td>Uploaded On</td>
				  <td>Notes</td>
				  <td>Agreement File</td>
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
						
						if($val['date_uploaded']=='0000-00-00')
						{
							$output_str.='<td>Nill</td>';
						}else
						{
							$output_str.='<td>'.$val['date_uploaded'].'</td>';	
						}

						if($val['agreement_note']=='')
						{
							$output_str.='<td>Nill</td>';
						}else
						{
							$output_str.='<td>'.$val['agreement_note'].'</td>';	
						}

						if($val['agreement_file']=='')
						{
							$output_str.='<td>Nill</td>';
						}else
						{
							$output_str.='<td><a href="'.base_url().'uploads/agreements/'.$val['agreement_file'].'" target="_blank">Download</a></td>';	
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
		$this->load->model('statemodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statemodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('citymodel');
		
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->citymodel->city_list_by_state($_POST['state_id']);
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
					redirect('company_agreements/?del=2');
					break;
				}else{
					$this->db->where('company_id', $val);
					$this->db->delete('pms_company_opportunity');
									
					$this->db->where('company_id', $val);
					$this->db->delete('pms_company'); 
				}
			}
		}
		redirect('company_agreements/?del=1');
	}
}
?>
