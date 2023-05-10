<?php 
class Salesperson extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');

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
		 	 $limit=15;
		 }
		 
		$rows='';
		$this->load->model('salespersonmodel');
		
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
		$this->data['total_rows']= $this->salespersonmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/salesperson/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->salespersonmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('salespersonmodel'); 
		
		$this->data['page_head']= 'Manage Sales Person';		
		$config['base_url'] = base_url().'index.php/salesperson/?';	
		  
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->load->view('include/header');
		$this->load->view('sales_person/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('branch');
		if($this->input->get('stat')=='')redirect('branch');
		$this->db->query("update tally_sales_man set user_status=".$this->input->get('stat')." where user_id=".$id);
		redirect('branch?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'user_name'=> '',
		'user_login'=> '',
		'user_password'=> '',
		'user_status'=> '1',
		);
		
		$this->load->model('salespersonmodel');		

		
		if($this->input->post('user_name'))
		{
			$this->form_validation->set_rules('user_name', 'Sales Person Name', 'required');
			$this->form_validation->set_rules('user_login', 'Sales Person Code', 'required');
			$this->form_validation->set_rules('check_dups', 'Sales Person Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$id=$this->salespersonmodel->insert_record();
				redirect('salesperson/?ins=1');
			}
				$this->data['formdata']=array(
				'user_name'=> $this->input->post('user_name'),
				
				'user_status'=> $this->input->post('user_status'),
				);				
			}
				$this->data['page_head']= 'Add Sales Person';
				
				$this->load->view('include/header');
				$this->load->view('sales_person/add',$this->data);	
				$this->load->view('include/footer');
	}

	//exit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'user_name'=> '',
		'user_login'=> '',
		'user_password'=> '',
		'user_status' => '1'
		);
		
		
		if(!empty($id))
		{
			$this->load->model('salespersonmodel');	

		
			$data['page_head']= 'Edit Sales Person';
			
			$query=$this->db->query("select * from tally_sales_man where user_id=".$id);
			$data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('sales_person/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Sales Person';
		
			if($this->input->post('user_id'))
			{
				$this->load->model('salespersonmodel');	
		
				$this->form_validation->set_rules('user_name', 'Sales Person Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Sales Person Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('salespersonmodel');
					$id=$this->salespersonmodel->update_record($id);
					redirect('salesperson/?update=1');
				}

				$data['formdata']=array(
				'user_id'=> $this->input->post('user_id'),
				'user_name'=> $this->input->post('user_name'),
				'user_login'=> $this->input->post('user_login'),
				'user_password'=> $this->input->post('user_password'),
				'sort_order'=> $this->input->post('sort_order'),
				'user_status'=> $this->input->post('user_status')
				);				
				
				$query=$this->db->query("select * from tally_sales_man where user_id=".$this->input->post('user_id'));
				$data['formdata']=$query->row_array();
				$this->load->view('include/header');
				$this->load->view('sales_person/edit',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('branch');
			}			
	}

	function check_dups()
	{
		$this->db->where('user_name', $this->input->post('user_name'));
		$this->db->where('user_login', $this->input->post('user_login'));
		if($this->input->post('user_id') > 0)	$this->db->where('user_id !=', $this->input->post('user_id'));
		$query = $this->db->get('tally_sales_man');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Sales Person name already used, pelase change');
			return false;
		}
	}	

	
	function delete($id=null)
	{
		
		$this->load->model('salespersonmodel');
		if(!empty($id))
		{
			$id=$this->salespersonmodel->delete($id);
			redirect('salesperson/?del='.$id);
		}elseif(is_array($this->input->post('delete_rec')))
		{ 
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->salespersonmodel->delete($val);
				}
			redirect('salesperson/?del='.$id);
		}else
		{
			redirect('branch');
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
			$this->load->model('salespersonmodel');
			$this->salespersonmodel->delete_multiple_record($id_arr);
			redirect('salesperson/?rows='.$rows.'&del=1');
		}
		else{
			redirect('branch');
		}
	}
}
?>
