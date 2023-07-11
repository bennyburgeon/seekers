<?php 
class Location extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model('statmodel');
		$this->load->model('countrymodel');
	         $this->load->model('locationmodel');
                   $this->load->model('cittymodel');
        }       
	
	function index($offset = 0)
	{	
		$this->load->library('pagination');
		$country_id='';
		$state_id='';
		$city_id='';
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=100;
		 }
		$rows='';
		$this->load->model('locationmodel');
		
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
		
		if(isset($_GET['city'])){
			if($_GET['city']!='')
			$city_id= $_GET['city'];
		}
		
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->locationmodel->record_count($country_id,$state_id,$city_id,$searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."location/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->locationmodel->get_list($start,$limit,$country_id,$state_id,$city_id,$searchterm,$sort_by);
		$this->data["country_list"] = $this->countrymodel->country_list_add_location();
		$this->data["state_list"] = $this->statmodel->state_list('');
		$this->data["city_list"] = $this->cittymodel->get_city_list('');
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["country_id"]=$country_id;
		$this->data["state_id"]=$state_id;
		$this->data["city_id"]=$city_id;
		$this->data["searchterm"]=$searchterm;
		
	
		$this->load->model('locationmodel');
		$this->data['page_head']= 'Manage Location';		
		$config['base_url'] = base_url().'location/?';		
		               
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('location/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('location');
		if($this->input->get('stat')=='')redirect('location');
		$this->db->query("update pms_locations set status=".$this->input->get('stat')." where location_id=".$id);
		redirect('location?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
			'locaton_name'=> '',
			'country_id'=> '',
			'state_id'=> '0',
			'city_id'=> '0',
			'zipcode'=> '',     
			'sort_order'=> '0',
			'status'=> '1',
		);
		
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');		
		//$this->data["state_list"] = $this->statmodel->state_list(0);
		$this->data["state_list"] = array(''=>'Select State');	
               
		$this->data["country_list"] = $this->countrymodel->country_list();
		
		if($this->input->post('locaton_name'))
		{
			$this->form_validation->set_rules('locaton_name', 'Location Name', 'required');
			$this->form_validation->set_rules('check_dups', 'City Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->locationmodel->insert_record();
				redirect('location/?ins=1');
			}
				$this->data['formdata']=array(
					'locaton_name'=> $this->input->post('locaton_name'),
					'state_id'=> $this->input->post('state_id'),
					'city_id'=> $this->input->post('city_id'),   
					'sort_order'=> $this->input->post('sort_order'),
					'status'=> $this->input->post('status'),
					'zipcode'=> $this->input->post('zipcode'),    
					'country_id'=> $this->input->post('country_id'),
				);				
			}
				$this->data['page_head']= 'Add Location';				
				$this->load->view('include/header');
				$this->load->view('location/add',$this->data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$this->data['site_url']=$this->config->item('site_url');
		
		$this->data['formdata']=array(
		'locaton_name'=> '',
		'country_id'=> '',
		'state_id'=> '',
        'zipcode'=> '',    
		'sort_order'=> '0',
		'status' => '1'
		);

		$this->load->model('locationmodel');

		$this->data["state_list"] = array('' => 'Select State');
		
		$this->data["country_list"] = $this->countrymodel->country_list();
                
                $this->data["city_list"] = $this->cittymodel->city_list();

		
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Locaton';			
			$query=$this->db->query("select a.*,b.*,c.*,d.*,f.* from pms_locations a inner join pms_locations_description b ON b.location_id=a.location_id inner join pms_city c on a.city_id=c.city_id inner join pms_state d on c.state_id=d.state_id inner join pms_country f on f.country_id=d.country_id where a.location_id=".$id);
			$this->data['formdata']=$query->row_array();		
			$this->data["state_list"] = $this->statmodel->state_list_by_city($this->data['formdata']['country_id']);
			$this->data["city_list"] = $this->cittymodel->city_list($this->data['formdata']['state_id']);                        
			$this->load->view('include/header');
			$this->load->view('location/edit',$this->data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$this->data['page_head']= 'Edit Locaton';
		
			if($this->input->post('location_id'))
			{
				$this->load->model('locationmodel');	
				$this->data["state_list"] = $this->statmodel->state_list_by_city($this->input->post('country_id'));
                                $this->data["country_list"] = $this->countrymodel->country_list_by_state_city();
                                $this->data["city_list"] = $this->cittymodel->city_list($this->input->post('state_id'));
				$this->form_validation->set_rules('locaton_name', 'Location Name', 'required');
                                $this->form_validation->set_rules('check_dups', 'City Name', 'callback_check_dups');
                        
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('locationmodel');
					$id=$this->locationmodel->update_record($id);
					redirect('location/?update=1');
				}
                               
				$data['formdata']=array(
				'city_id'=> $this->input->post('city_id'),
				'city_name'=> $this->input->post('city_name'),
				'state_id'=> $this->input->post('state_id'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status')
				);				
				$query=$this->db->query("select a.*,b.*,c.*,d.*,f.* from pms_locations a inner join pms_locations_description b ON b.location_id=a.location_id inner join pms_city c on a.city_id=c.city_id inner join pms_state d on c.state_id=d.state_id inner join pms_country f on f.country_id=d.country_id where a.location_id=".$this->input->post('location_id'));
		
				 $this->data['formdata']=$query->row_array();				
				$this->load->view('include/header');
				$this->load->view('location/edit',$this->data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('location');
			}			
	}

	function check_dups()
	{
               
		$this->db->where('a.location_name', $this->input->post('locaton_name'));
		$this->db->where('p.city_id', $this->input->post('city_id'));
		if($this->input->post('location_id') > 0)	$this->db->where('location_id !=', $this->input->post('location_id'));
		$this->db->join('pms_locations p' , 'p.location_id = a.location_id');
		$query = $this->db->get('pms_locations_description a');		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'City name already used, pelase change');
			return false;
		}
	}	

	public function getlocation()
	{
		$this->load->model('locationmodel');
		if(isset($_POST['city_id']) && $_POST['city_id']!='')
		{
			$data=array();
			$data["location_list"] = $this->locationmodel->location_list($_POST['city_id']);
			$data = array('success' => true, 'location_list' => $data["location_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{
		$this->load->model('locationmodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->cittymodel->city_list($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
   
   public function getstate()
	{
		$this->load->model('statmodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statmodel->state_list($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}	
	
	function delete($id=0)
	{
		$this->load->model("locationmodel");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id)){
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE current_location ="'.$id.'" ' )->result();
			if(empty($result))
			{
				$this->locationmodel->delete_record($id);
				redirect('location/?del=1');
			}
			else
			{
				redirect('location/?del=2');
			}
			
		}
		if($this->input->post("checkbox"))
		{	
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE current_location ="'.$id.'" ' )->result();
			if(empty($result))
			{
			 	foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->locationmodel->delete_record($val);
				}
				redirect('location/?del=1');
			}
			else
			{
				redirect('location/?del=2');
			}
		}
		else
		{
			redirect('location');
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
			$this->load->model('locationmodel');
			$result= $this->locationmodel->get_all_records($id_arr);
			if(!empty($result))
			{
				redirect('location/?multi=2');
			}
			else
			{
				redirect('location/?multi=1');}
		}
		else{
			redirect('city');
		}
	}
	
	
}
?>
