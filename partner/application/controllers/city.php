<?php 
class City extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');

		$this->load->model('statmodel');
		$this->load->model('countrymodel');
	}
	
	function index($offset = 0)
	{
		$this->load->library('pagination');
		$country_id='';
		$state_id='';
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
		$this->load->model('cittymodel');
		
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
		
		//searchinf terms
		
		if(isset($_GET['country'])){
			if($_GET['country']!='')
			$country_id= $_GET['country'];
		}
		
		if(isset($_GET['state'])){
			if($_GET['state']!='')
			$state_id= $_GET['state'];
		}
		
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		
		$this->data['total_rows']= $this->cittymodel->record_count($country_id,$state_id,$searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."city/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->cittymodel->get_list($start,$limit,$country_id,$state_id,$searchterm,$sort_by);
		$this->data["country_list"] = $this->countrymodel->country_list_add_city();
		$this->data["state_list"] = $this->statmodel->state_list_add_city('');
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["country_id"]=$country_id;
		$this->data["state_id"]=$state_id;
		$this->data["searchterm"]=$searchterm;
			
		$this->load->model('cittymodel');
		$this->data['page_head']= 'Manage City';
		
		$config['base_url'] = base_url().'city/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('city/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('city');
		if($this->input->get('stat')=='')redirect('city');
		$this->db->query("update pms_city set status=".$this->input->get('stat')." where city_id=".$id);
		redirect('city?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'city_name'=> '',
		'country_id'=> '',
		'state_id'=> '0',
		'sort_order'=> '0',
		'status'=> '1',
		);
		
		$this->load->model('cittymodel');
				
		//$this->data["state_list"] = $this->statmodel->state_list(0);
		$this->data["state_list"] = array(''=>'Select State');
		
		$this->data["country_list"] = $this->countrymodel->country_list_add_city();
		
		if($this->input->post('city_name'))
		{
			$this->form_validation->set_rules('city_name', 'City Name', 'required');
			$this->form_validation->set_rules('check_dups', 'City Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->cittymodel->insert_record();
				redirect('city/?ins=1');
			}
				$this->data['formdata']=array(
				'city_name'=> $this->input->post('city_name'),
				'state_id'=> $this->input->post('state_id'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status'),
				'country_id'=> $this->input->post('country_id'),
				);				
			}
				$this->data['page_head']= 'Add City';
				
				$this->load->view('include/header');
				$this->load->view('city/add',$this->data);	
				$this->load->view('include/footer');
	}


// edxit and update pages here 

	function edit($id=null)
	{
		$this->data['site_url']=$this->config->item('site_url');
		
		$this->data['formdata']=array(
		'city_name'=> '',
		'country_id'=> '',
		'state_id'=> '',		
		'sort_order'=> '0',
		'status' => '1'
		);

		$this->load->model('cittymodel');

		$this->data["state_list"] = array('' => 'Select State');
		
		$this->data["country_list"] = $this->countrymodel->country_list_add_city();

		
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit City';
			
			$query=$this->db->query("select a.*,b.*,d.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id inner join pms_state c on a.state_id=c.state_id inner join pms_country d on c.country_id=d.country_id where a.city_id=".$id);

			$this->data['formdata']=$query->row_array();			
			
			$this->data["state_list"] = $this->statmodel->state_list_add_city($this->data['formdata']['country_id']);
			
			$this->load->view('include/header');
			$this->load->view('city/edit',$this->data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit City';
		
			if($this->input->post('city_id'))
			{
				$this->load->model('cittymodel');							
				$this->data["state_list"] = $this->statmodel->state_list($this->input->post('country_id'));		                                
				$this->data["country_list"] = $this->countrymodel->country_list_by_state();		
				$this->form_validation->set_rules('city_name', 'City Name', 'required');
				$this->form_validation->set_rules('check_dups', 'City Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('cittymodel');
					$id=$this->cittymodel->update_record($id);
					redirect('city/?update=1');
				}

				$data['formdata']=array(
				'city_id'=> $this->input->post('city_id'),
				'city_name'=> $this->input->post('city_name'),
				'state_id'=> $this->input->post('state_id'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status')
				);				
				
				$query=$this->db->query("select a.*,b.*,d.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id inner join pms_state c on a.state_id=c.state_id inner join pms_country d on c.country_id=d.country_id where a.city_id=".$this->input->post('city_id'));
				$this->data['formdata']=$query->row_array();
							$this->data['page_head']= 'Edit City';

				$this->load->view('include/header');
				$this->load->view('city/edit',$this->data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('city');
			}			
	}

	function check_dups()
	{
		$this->db->where('city_name', $this->input->post('city_name'));
		$this->db->where('state_id', $this->input->post('state_id'));
		if($this->input->post('city_id') > 0)	$this->db->where('city_id !=', $this->input->post('city_id'));
		$query = $this->db->get('pms_city');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'City name already used, please change');
			return false;
		}
	}	

	public function getstate()
	{
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statmodel->state_list_add_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{
		$this->load->model('cittymodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->cittymodel->city_list($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	
	function delete($id=0)
	{
		$this->load->model("cittymodel");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE city_id ="'.$id.'" ' )->result();
			if(empty($result))
			{
				$this->cittymodel->delete_record($id);
				redirect('city/?del=1');
			}
			else
			{
				redirect('city/?del=2');
			}
			
		}
		if($this->input->post("checkbox"))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE city_id ="'.$this->input->post("checkbox").'" ' )->result();
			if(empty($result))
			{
			 	 foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->cittymodel->delete_record($val);
				}
				redirect('city/?del=1');
				
			}
			else
			{
				redirect('city/?del=2');
			}
			
		}
		else
		{
			redirect('city');
		}
	}
	
	function multidelete()
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		
		if(count($id_arr)>0){
			$this->load->model('cittymodel');
			$result= $this->cittymodel->get_all_records($id_arr);
			if(!empty($result))
			{
				redirect('city/?multi=2');
			}
			else
			{
				redirect('city/?multi=1');}
		}
		else{
			redirect('city');
		}
	}
	
	
}
?>
