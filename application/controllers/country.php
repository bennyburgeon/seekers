<?php 
class Country extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			  if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');

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
	{
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=50;
		 }
		$rows='';
		$this->load->model('countrymodel');
		
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
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->countrymodel->record_count($searchterm);
		
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/country/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
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
		$this->data["records"] = $this->countrymodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
			
		$this->load->model('countrymodel');
		$this->data['page_head']= 'Manage Country';		
		$config['base_url'] = base_url().'index.php/country/?';	
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->load->view('include/header');
		$this->load->view('country/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('country');
		if($this->input->get('stat')=='')redirect('country');
		$this->db->query("update pms_country set status=".$this->input->get('stat')." where country_id=".$id);
		redirect('country?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'country_name'=> '',
		'sort_order'=> '0',
		'status'=> '1',
		'visa'=> '',
		'medical'=>'',
		'docs_required'=>'',
		'visa_process'=>''
		);
		
		$this->load->model('countrymodel');		

		
		if($this->input->post('country_name'))
		{
			$this->form_validation->set_rules('country_name', 'Country Name', 'required');
			$this->form_validation->set_rules('check_dups', 'Country Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$id=$this->countrymodel->insert_record();
				redirect('country/?ins=1');
			}
				$this->data['formdata']=array(
				'country_name'=> $this->input->post('country_name'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status'),
				'visa'   => $this->input->post('visa'),
				'medical'=> $this->input->post('medical'),
				'docs_required'=> $this->input->post('docs_required'),
				'visa_process'=> $this->input->post('visa_process')
				
				);				
			}
			$this->data['page_head']= 'Add Country';
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			
			$this->load->view('include/header');
			$this->load->view('country/add',$this->data);	
			$this->load->view('include/footer');
	}

	//exit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'country_name'=> '',
		'sort_order'=> '0',
		'status' => '1',
		'visa'=> '',
		'medical'=>'',
		'docs_required'=>'',
		'visa_process'=>''
		);
		
		
		if(!empty($id))
		{
			$this->load->model('countrymodel');	

		
			$data['page_head']= 'Edit Country';
			
			$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id where a.country_id=".$id);
			$data['formdata']=$query->row_array();			
			
			
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			
			$this->load->view('include/header');
			$this->load->view('country/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Country';
		
			if($this->input->post('country_id'))
			{
				$this->load->model('countrymodel');	
		
				$this->form_validation->set_rules('country_name', 'Country Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Country Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('countrymodel');
					$id=$this->countrymodel->update_record($id);
					redirect('country/?update=1');
				}

				$data['formdata']=array(
				'country_id'=> $this->input->post('country_id'),
				'country_name'=> $this->input->post('country_name'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status'),
				'visa'   => $this->input->post('visa'),
				'medical'=> $this->input->post('medical'),
				'docs_required'=> $this->input->post('docs_required'),
				'visa_process'=> $this->input->post('visa_process')
				);				
				
				$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id where a.country_id=".$this->input->post('country_id'));
				$data['formdata']=$query->row_array();
				
		
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
			
				
				$this->load->view('include/header');
				$this->load->view('country/edit',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('country');
			}			
	}

	function check_dups()
	{
		$this->db->where('country_name', $this->input->post('country_name'));
		if($this->input->post('country_id') > 0)	$this->db->where('country_id !=', $this->input->post('country_id'));
		$query = $this->db->get('pms_country_description');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Country name already used, please change');
			return false;
		}
	}	

	
	function delete($id=null)
	{
		$this->load->model('countrymodel');
		if(!empty($id))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE nationality ="'.$id.'" ' )->result();
			if(empty($result))
			{
				$this->countrymodel->delete($id);
				redirect('country/?del=1');
			}
			else
			{
				redirect('country/?del=2');
			}
		
		}
		
		else if(is_array($this->input->post('delete_rec')))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE nationality ="'.$this->input->post("checkbox").'" ' )->result();
			if(empty($result))
			{
				foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->countrymodel->delete($val);
				}
			
				redirect('country/?del=1');
			}
			else
			{
				redirect('state/?del=2');
			}
		}
		
		else
		{
			redirect('country');
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
			$this->load->model('countrymodel');
			$result= $this->countrymodel->get_all_records($id_arr);
			if(!empty($result))
			{
				redirect('country/?multi=2');
			}
			else
			{
				redirect('country/?multi=1');}
		}
		else{
			redirect('country');
		}
	}
	
	
}
?>
