<?php 
class University extends CI_Controller {

	function University()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
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
	function index($offset = 0)
	{	
		$this->load->library('pagination');

		$this->data["sort_by"] = 'asc';
		$this->data["rows"] = 0;
		$this->data["searchterm"]='';
		$this->data["univ_type"]=1;
		$this->data["limit"]=25;
				
		$this->load->model('universitymodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
			$this->data["sort_by"]=$this->input->get("sort_by");
		}

		if($this->input->get('searchterm')!='')
		{
			$this->data["searchterm"]=$this->input->get("searchterm");
		}

		if($this->input->get('univ_type')!='')
		{
			$this->data["univ_type"]=$this->input->get("univ_type");
		}
				
		if($this->input->get("rows")!='')
		{
			$this->data["rows"]=$this->input->get("rows");
		}
		if($this->input->get("limit")!='')
		{
			$this->data["limit"]=$this->input->get("limit");
		}
		
		$this->data['total_rows']= $this->universitymodel->record_count($this->data["searchterm"],$this->data["univ_type"]);
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."index.php/university/?sort_by=".$this->data["sort_by"]."&limit=".$this->data["limit"]."&searchterm=".$this->data["searchterm"]."&univ_type=".$this->data["univ_type"]."&rows=".$this->data["rows"];
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data["limit"];
		$config['num_links'] = $this->data['total_rows'];
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
		
		// paging ends here
		$this->data["records"] = $this->universitymodel->get_list($this->data["rows"],$this->data["limit"],$this->data["searchterm"],$this->data["sort_by"],$this->data["univ_type"]);
		
		
       if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
        $this->data['page_head']='Manage University ';
		$this->load->view('include/header',$this->data);
		$this->load->view('university/universitylist',$this->data);				
		$this->load->view('include/footer',$this->data);
		
	}	
	function add()
	{	
		$this->data['formdata']=array(
		'univ_name'=> '',
		'univ_details' => '',
		'univ_address'=> '',
		'univ_phone'=> '',
		'univ_mobile'=> '',
		'univ_email'=> '',
		'country_id'=> '',
		'univ_map'=> '',
		'univ_logo'=> '',
		'univ_banner'=> '',
		'univ_website'=> '',
		'univ_type'=> '1',
		'univ_grade'=> '1'	
		);
		
		$this->load->model('universitymodel');
		$this->load->model('countrymodel');		
		$this->data["country_list"] = $this->countrymodel->country_list_only();

		if($this->input->post('univ_type'))
		{
			$this->form_validation->set_rules('univ_name', 'university name', 'required');
			$this->form_validation->set_rules('check_dups', 'university name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->universitymodel->insert_record();
				redirect('university/?ins=1');
			}
				// load page again for validation
				$this->data['formdata']=array(
				'univ_name'=>$this->input->post('univ_name'),
				'univ_details'=>$this->input->post('univ_details'),
				'univ_address'=>$this->input->post('univ_address'),
				'country_id'=>$this->input->post('country_id'),
				'univ_logo'=>$this->input->post('univ_logo'),
				'univ_type'=>$this->input->post('univ_type'),
				'univ_grade'=> $this->input->post('univ_type')
				);
		}
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->data['page_head']= 'Add University';
				$this->load->view('include/header',$this->data);
				$this->load->view('university/adduniversity',$this->data);	
				$this->load->view('include/footer',$this->data);
	}

	function add_campus()
	{	
		$this->load->model('campusmodel');
		if($this->input->post('univ_id'))
		{
			if($this->input->post('campus_name')!='')$id=$this->campusmodel->insert_campus();
				redirect('university/?ins=1');
		}
	}


// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			
			$this->data['page_head']= 'Edit University';
			$this->db->where('univ_id', $id);
			$query=$this->db->get('pms_university');
			$this->data['formdata']=$query->row_array();
			$this->load->model('countrymodel');	
			$this->data["country_list"] = $this->countrymodel->country_list_only();
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view('include/header',$this->data);
			$this->load->view('university/edituniversity',$this->data);	
			$this->load->view('include/footer',$this->data);
		}
	}

	function update($id=null)
	{
		$id=$this->input->post('univ_id');
		$this->data['page_head']= 'Edit state';
		if(!empty($id))
		{
			if($this->input->post('univ_type'))
			{
				$this->form_validation->set_rules('univ_name', 'university Name', 'required');
			    $this->form_validation->set_rules('check_dups', 'university name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('universitymodel');
						$id=$this->universitymodel->update_record($id);
						redirect('university/?update=1');
					}else{
						// load page again for validation
						$this->data['formdata']=array(
						'univ_id'=> $this->input->post('univ_id'),
						'univ_name'=>$this->input->post('univ_name'),
						'univ_details'=>$this->input->post('univ_details'),
						'univ_address'=>$this->input->post('univ_address'),
						'country_id'=>$this->input->post('country_id'),
						'univ_logo'=>$this->input->post('univ_logo'),
						'univ_type'=>$this->input->post('univ_type'),	
						'univ_grade'=> $this->input->post('univ_type')						
						);
						$path = '../js/ckfinder';
			            $width = '700px';
			             $this->editor($path, $width);
						$this->data['page_head']= 'Edit University';
						$this->load->view('include/header',$this->data);
						$this->load->view('university/edituniversity',$this->data);	
						$this->load->view('include/footer',$this->data);
					}
			}else
			{
				redirect('university');
			}			
		}else
		{
			redirect('university');
		}
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('universitymodel');
			$result= $this->universitymodel->get_all_records($id_arr);
			if(!empty($result))
			{
				redirect('university/?multi=2');
			}
			else
			{
				redirect('university/?multi=1');}
		}
		else{
			redirect('university');
		}
	}
	
	
	function delete($id=0)
	{
		$this->load->model("universitymodel");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate_education WHERE univ_id ="'.$id.'" ' )->result();
			if(empty($result))
			{
				$this->universitymodel->delete_record($id);
				redirect('university/?del=1');
			}
			else
			{
				redirect('university/?del=2');
			}
		}
		if($this->input->post("checkbox"))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate_education WHERE univ_id ="'.$this->input->post("checkbox").'" ' )->result();
			if(empty($result))
			{
			 	foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->universitymodel->delete_record($val);
				}
				redirect('university/?del=1');
			}
			else
			{
				redirect('university/?del=2');
			}
		}
		else
		{
			redirect('university');
		}
	}
	
	function check_dups()
	{
		$this->db->where('univ_name', $this->input->post('univ_name'));
		if($this->input->post('univ_id') > 0)	$this->db->where('univ_id !=', $this->input->post('univ_id'));
		$query = $this->db->get('pms_university');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'university name already used.');
			return false;
		}
	}

}
?>
