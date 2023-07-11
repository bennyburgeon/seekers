<?php 
class Todogroup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}

	
	function index($offset = 0)
	{
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		$limit=5;
		$rows='';
		$this->load->model('todogroupmodel');
		
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
		$searchterm=$this->input->get("searchterm");
		$this->data['total_rows']= $this->todogroupmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/todogroup/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->todogroupmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
			
		$this->load->model('todogroupmodel');
		$this->data['page_head']= 'Manage Group';
		
		$config['base_url'] = base_url().'index.php/projects/?';
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
			
		$this->load->view('todo/group',$this->data);				
		$this->load->view('include/footer');
	}	

	function add()
	{	
		$this->data['formdata']=array(
		'todo_group_id'=> '',
		'todo_group_name'=> '',
		'status'=> '',
		'is_default' => ''
		
		);
		
		$this->load->model('todogroupmodel');		
		//$this->data["parent_list"] = $this->categorymodel->parent_list();
		
		//$this->data["leadgroup_list"] = $this->todogroupmodel->leadgroup_array();
		
		
		if($this->input->post('todo_group_name'))
		{
			$this->form_validation->set_rules('todo_group_name', 'group Name', 'required');
			$this->form_validation->set_rules('check_dups', 'group Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->todogroupmodel->insert_record();
				redirect('todogroup/?ins=1');
			}
				$this->data['formdata']=array(
				'todo_group_id'=> $this->input->post('todo_group_id'),
				'todo_group_name'=> $this->input->post('todo_group_name'),
				'status' =>    $this->input->post('status'),
				'is_default'=> $this->input->post('is_default')
				
				);				
		}
				$this->data['page_head']= 'Add Group';
				
				$this->load->view('include/header');
					
				$this->load->view('todo/addgroup',$this->data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'todo_group_id'=> '',
		'todo_group_name'  => '',
		'status'=> '',
		'is_default'=> ''
		);
		
		
		
		if(!empty($id))
		{
			
			
			
			$this->load->model('todogroupmodel');	
			
			//$data["leadgroup_list"] = $this->todogroupmodel->leadgroup_array($id);
		
			$data['page_head']= 'Edit Group';
			
			$query=$this->db->query("SELECT * FROM pms_todo_group where todo_group_id=".$id);
			$data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('todo/editgroup',$data);	
			$this->load->view('include/footer');
		}
		{
			//redirect('categories');	
		}
	}

	function changestat($id=null)
	{
		if($id=='')redirect('todogroup');
		if($this->input->get('stat')=='')redirect('todogroup');
		$this->db->query("update pms_todo_group set status=".$this->input->get('stat')." where todo_group_id=".$id);
		redirect('todogroup?stat=1');

	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Group';
		$this->load->model('todogroupmodel');
		
			if($this->input->post('todo_group_id'))
			{

				//$data["parent_list"] = $this->todogroupmodel->parent_list();	
		
				$this->form_validation->set_rules('todo_group_name', 'group Name', 'required');
				$this->form_validation->set_rules('check_dups', 'group Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->todogroupmodel->update_record($id);
					redirect('todogroup/?update=1');
				}
				
				$query=$this->db->query("SELECT * FROM pms_todo_group where todo_group_id=".$this->input->post('todo_group_id'));
				$data['formdata']=$query->row_array();	
				
				$this->load->view('include/header');
				$this->load->view('todo/editgroup',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('todogroup');
			}			
	}

	function check_dups()
	{
		$this->db->where('todo_group_name', $this->input->post('todo_group_name'));
		if($this->input->post('todo_group_id') > 0)	$this->db->where('todo_group_id !=', $this->input->post('todo_group_id'));
		$query = $this->db->get('pms_todo_group');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'group name already used, pelase change');
			return false;
		}
	}	

	function delete($id=null)
	{
		$this->load->model('todogroupmodel');
		$error_msg=true;
		if(!empty($id))
		{
			$del_status=$this->todogroupmodel->delete($id);

			/*if($del_status==true)
				$_SESSION['del_error']='Group deleted successfully.';
			else
				$_SESSION['del_error']='Cannot delete '.$del_status.', Group used in products. Delete products under this category.';*/
				
			redirect('todogroup/?del=1');
			
		}elseif(is_array($this->input->post('delete_rec')))
		{
			$_SESSION['del_error']=array();
			
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				//$del_status=true;
				$del_status=$this->todogroupmodel->delete($val);
				//if($del_status==false)$_SESSION['del_error'][]=$del_status;
			}
			
			/*if($del_status==true && count($_SESSION['del_error'])==0)
				$_SESSION['del_error']='Group deleted successfully.';
			else
				$_SESSION['del_error'].='Cannot delete '.implode(',',$_SESSION['del_error']).'. Delete products under this category.';*/				
				
			redirect('todogroup/?del=1');
		}else
		{
			redirect('todogroup');
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
			$this->load->model('todogroupmodel');
			$this->todogroupmodel->delete_multiple_record($id_arr);
			redirect('todogroup/?multi=1');
		}
		else{
			redirect('todogroup');
		}
	}
}
?>