<?php 
class Manage_leave extends CI_Controller {

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
		$this->load->model('manage_leave_model');
		
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
		$this->data['total_rows']= $this->manage_leave_model->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/manage_leave/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->manage_leave_model->get_list($start,$limit,$searchterm,$sort_by);
		//print_r($this->data["records"]);die;
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('manage_leave_model'); 
		
		$this->data['page_head']= 'Manage Leave';		
		$config['base_url'] = base_url().'index.php/manage_leave/?';	
		
		$this->data['approved_by']=$this->manage_leave_model->get_all_admins();
		
		  //~ print_r($this->data['records']);die;
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->load->view('include/header');
		$this->load->view('manage_leave/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('manage_leave');
		if($this->input->get('stat')=='')redirect('manage_leave');
		$this->db->query("update pms_branch set status=".$this->input->get('stat')." where branch_id=".$id);
		redirect('manage_leave?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'admin_id'=> '',
		'date_from'=> '',
		'date_to'=> '',
		'leave_type'=> '',
		'session_type'=> '',
		'leave_status'=> '',
		'approved_by'=> ''
		);
		
		$this->load->model('manage_leave_model');		

		
		if($this->input->post('name'))
		{ 
			 
				$id=$this->manage_leave_model->insert_record();
				redirect('manage_leave/?ins=1');
			
				$this->data['formdata']=array(
				'branch_name'=> $this->input->post('branch_name'),
				
				'status'=> $this->input->post('status'),
				);				
		}
				$this->data['page_head']= 'Add Leave';
				//call model to show all admins
				$this->data['admins']=$this->manage_leave_model->get_all_admins();
				//~ print_r($this->data['admins']);die;
				$this->load->view('include/header');
				$this->load->view('manage_leave/add',$this->data);	
				$this->load->view('include/footer');
	}

	//exit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'admin_id'=> '',
		'date_from'=> '',
		'date_to'=> '',
		'leave_type'=> '',
		'session_type'=> '',
		'leave_status'=> '',
		'approved_by'=> ''
		);
		
		
		if(!empty($id))
		{
			$this->load->model('manage_leave_model');	

		
			$data['page_head']= 'Edit Leave';
			
			$query=$this->db->query("select * from pms_admin_leave where leave_id=".$id);
			$data['formdata']=$query->row_array();			
			$data['admins']=$this->manage_leave_model->get_all_admins();
			//~ print_r($data['formdata']);die;
			$this->load->view('include/header');
			$this->load->view('manage_leave/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update()
	{
		$data['page_head']= 'Edit Leave';
		
			if($this->input->post('name'))
			{
				
				$this->load->model('manage_leave_model');	
				$this->load->model('manage_leave_model');
				$id=$this->manage_leave_model->update_record();
				redirect('manage_leave/?update=1');
									
			}else
			{
				redirect('manage_leave');
			}			
	}

	function check_dups()
	{
		$this->db->where('branch_name', $this->input->post('branch_name'));
		$this->db->where('branch_code', $this->input->post('branch_code'));
		if($this->input->post('branch_id') > 0)	$this->db->where('branch_id !=', $this->input->post('branch_id'));
		$query = $this->db->get('pms_branch');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Branch name already used, pelase change');
			return false;
		}
	}	

	
	function delete($id=null)
	{
		
		$this->load->model('manage_leave_model');
		if(!empty($id))
		{
			$id=$this->manage_leave_model->delete($id);
			redirect('manage_leave/?del='.$id);
		}
		elseif(is_array($this->input->post('delete_rec')))
		{ 
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->manage_leave_model->delete($val);
				}
			redirect('manage_leave/?del='.$id);
		}
		else
		{
			redirect('manage_leave');
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
			$this->load->model('manage_leave_model');
			$this->manage_leave_model->delete_multiple_record($id_arr);
			redirect('manage_leave/?rows='.$rows.'&del=1');
		}
		else{
			redirect('manage_leave');
		}
	}
	
	function statchange($id)
	{
		$data=array(
		'leave_status'=>2,
		'approved_by'=> $_SESSION['admin_session']
		);
		$this->db->update('pms_admin_leave',$data);
		redirect('manage_leave');
	}
}
?>
