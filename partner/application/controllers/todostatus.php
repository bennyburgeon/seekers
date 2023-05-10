<?php 
class Todostatus extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	}

	
	function index($offset = 0)
	{	
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		$limit=5;
		$rows='';
		$this->load->model('todostatusmodel');
		
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
		$this->data['total_rows']= $this->todostatusmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."todostatus/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->todostatusmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
	
		$this->load->model('todostatusmodel');
		$this->data['page_head']= 'Manage Lead Source';
		
		$config['base_url'] = base_url().'todostatus/?';
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		
		$this->load->view('todo/status',$this->data);				
		$this->load->view('include/footer');
	}	

	function add()
	{	
		$this->data['formdata']=array(
		'status_id'=> '',
		'status_name'=> '',
		'active'=> ''
		
		);
		
		$this->load->model('todostatusmodel');		
		//$this->data["parent_list"] = $this->categorymodel->parent_list();
		
		$this->data["leadfolder_list"] = $this->todostatusmodel->leadfolder_array();
		
		
		if($this->input->post('status_name'))
		{
			$this->form_validation->set_rules('status_name', 'Source Name', 'required');
			$this->form_validation->set_rules('check_dups', 'Source Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->todostatusmodel->insert_record();
				redirect('todostatus/?ins=1');
			}
				$this->data['formdata']=array(
				'status_id'=> $this->input->post('status_id'),
				'status_name'=> $this->input->post('status_name'),
				'active' =>    $this->input->post('active')
				
				);				
		}
				$this->data['page_head']= 'Add Lead Source';
				
				$this->load->view('include/header');
					
				$this->load->view('todo/addstatus',$this->data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'status_id'=> '',
		'status_name'  => '',
		'active'=> ''
		);
		
		
		
		if(!empty($id))
		{
			
			
			
			$this->load->model('todostatusmodel');	
			
			$data["leadfolder_list"] = $this->todostatusmodel->leadfolder_array($id);
		
			$data['page_head']= 'Edit Lead Source';
			
			$query=$this->db->query("SELECT * FROM pms_todo_status where status_id =".$id);
			$data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('todo/editstatus',$data);	
			$this->load->view('include/footer');
		}
		{
			//redirect('categories');	
		}
	}

	function changestat($id=null)
	{
		if($id=='')redirect('todostatus');
		if($this->input->get('stat')=='')redirect('todostatus');
		$this->db->query("update pms_todo_status set active=".$this->input->get('stat')." where status_id =".$id);
		redirect('todostatus?stat=1');

	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Lead Source';
		$this->load->model('todostatusmodel');
		
			if($this->input->post('status_id'))
			{

				//$data["parent_list"] = $this->leadfoldermodel->parent_list();	
		
				$this->form_validation->set_rules('status_id', 'Source Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Source Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->todostatusmodel->update_record($id);
					redirect('todostatus/?update=1');
				}
				
				$query=$this->db->query("SELECT * FROM pms_todo_status where status_id =".$this->input->post('status_id'));
				$data['formdata']=$query->row_array();	
				
				$this->load->view('include/header');
				$this->load->view('todo/editstatus',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('todostatus');
			}			
	}

	function check_dups()
	{
		$this->db->where('status_name', $this->input->post('status_name'));
		if($this->input->post('status_id') > 0)	$this->db->where('status_id  !=', $this->input->post('status_id'));
		$query = $this->db->get('pms_todo_status');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Todo status name already used, pelase change');
			return false;
		}
	}	

	function delete($id=null)
	{
		$this->load->model('todostatusmodel');
		$error_msg=true;
		if(!empty($id))
		{
			$del_status=$this->todostatusmodel->delete($id);

			if($del_status==true)
				$_SESSION['del_error']='Lead Source deleted successfully.';
			/*else
				$_SESSION['del_error']='Cannot delete '.$del_status.', Lead Folder used in products. Delete products under this category.';*/
				
			redirect('todostatus/?del=1');
			
		}elseif(is_array($this->input->post('delete_rec')))
		{
			$_SESSION['del_error']=array();
			
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$del_status=true;
				$del_status=$this->todostatusmodel->delete($val);
				if($del_status==false)$_SESSION['del_error'][]=$del_status;
			}
			
			if($del_status==true && count($_SESSION['del_error'])==0)
				$_SESSION['del_error']='Lead Source deleted successfully.';
			/*else
				$_SESSION['del_error'].='Cannot delete '.implode(',',$_SESSION['del_error']).'. Delete products under this category.';*/				
				
			redirect('todostatus/?del=1');
		}else
		{
			redirect('todostatus');
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
			$this->load->model('todostatusmodel');
			$this->todostatusmodel->delete_multiple_record($id_arr);
			redirect('todostatus/?multi=1');
		}
		else{
			redirect('todostatus');
		}
	}
}
?>