<?php 
class State extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('countrymodel');
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');

	}
	
	function index($offset = 0)
	{	
		$this->load->library('pagination');
		$country_id='';
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
		$this->load->model('statmodel');
		
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
		
		
		if(isset($_GET['country_id'])){
			if($_GET['country_id']!='')
			$country_id= $_GET['country_id'];
		}
		
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->statmodel->record_count($country_id,$searchterm);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/state/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->statmodel->get_list($start,$limit,$country_id,$searchterm,$sort_by);
		$this->data["country_list"] = $this->countrymodel->country_list_add_state();
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["country_id"]=$country_id;
		$this->data["searchterm"]=$searchterm;
			
		$this->load->model('statmodel');
		$this->data['page_head']= 'Manage State';
		
		$config['base_url'] = base_url().'index.php/state/?';
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('state/list',$this->data);				
		$this->load->view('include/footer');

	}	

	function changestat($id=null)
	{
		if($id=='')redirect('state');
		if($this->input->get('stat')=='')redirect('state');
		$this->db->query("update pms_state set status=".$this->input->get('stat')." where state_id=".$id);
		redirect('state?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'state_name'=> '',
		'country_id'=> '0',
		'sort_order'=> '0',
		'status'=> '1',
		);
		
		$this->load->model('statmodel');	
		$this->data["country_list"] = $this->countrymodel->country_list();	
		
		if($this->input->post('state_name'))
			{
				
				$this->form_validation->set_rules('state_name', 'State Name', 'required');
				$this->form_validation->set_rules('check_dups', 'State Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('statmodel');
					$id=$this->statmodel->insert_record();
					redirect('state/?update=1');
				}

				$this->data['formdata']=array(
				'state_name'=> $this->input->post('state_name'),
				'country_id'=> $this->input->post('country_id'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status'),
				);				
			}
				$this->data['page_head']= 'Add State';
				
				$this->load->view('include/header');
				$this->load->view('state/add',$this->data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$this->data['site_url']=$this->config->item('site_url');
		$this->data['formdata']=array(
		'state_name'=> '',
		'country_id'=> '',		
		'sort_order'=> '0',
		'status' => '1'
		);
		$this->data["country_list"] = $this->countrymodel->country_list();
		
		if(!empty($id))
		{
			$this->load->model('statmodel');	
			
		
			$this->data['page_head']= 'Edit State';
			
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id where a.state_id=".$id);
			$this->data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('state/edit',$this->data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit State';
		
			if($this->input->post('state_id'))
			{
				$this->load->model('statmodel');	
				$this->data["country_list"] = $this->countrymodel->country_list();	
		
				$this->form_validation->set_rules('state_name', 'State Name', 'required');
				$this->form_validation->set_rules('check_dups', 'State Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('statmodel');
					$id=$this->statmodel->update_record($id);
					redirect('state/?update=1');
				}

				$data['formdata']=array(
				'state_id'=> $this->input->post('state_id'),
				'state_name'=> $this->input->post('state_name'),
				'country_id'=> $this->input->post('country_id'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status')
				);				
				
							$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id where a.state_id=".$this->input->post('state_id'));
			$this->data['formdata']=$query->row_array();	
						$this->data['page_head']= 'Edit State';

				$this->load->view('include/header');
				$this->load->view('state/edit',$this->data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('state');
			}			
	}

	function check_dups()
	{
		$this->db->where('state_name', $this->input->post('state_name'));
		$this->db->where('country_id', $this->input->post('country_id'));
		if($this->input->post('state_id') > 0)	$this->db->where('state_id !=', $this->input->post('state_id'));
		$query = $this->db->get('pms_state');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'State name already used, please change');
			return false;
		}
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
	
	function delete($id=null)
	{
		$this->load->model('statmodel');
		if(!empty($id))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE state ="'.$id.'" ' )->result();
			if(empty($result))
			{
				$this->statmodel->delete($id);
				redirect('state/?del=1');
			}
			else
			{
				redirect('state/?del=2');
			}
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			$result = $this->db->query('SELECT * FROM pms_candidate WHERE state ="'.$this->input->post("checkbox").'" ' )->result();
			if(empty($result))
			{
				foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->statmodel->delete($val);
				}
				redirect('state/?del=1');
			}
			else
			{
				redirect('state/?del=2');
			}
		}
		else
		{
			redirect('state');
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
			$this->load->model('statmodel');
			$result= $this->statmodel->get_all_records($id_arr);
			if(!empty($result))
			{
				redirect('state/?multi=2');
			}
			else
			{
				redirect('state/?multi=1');}
		}
		else{
			redirect('state');
		}
	}
	
	
}
?>
