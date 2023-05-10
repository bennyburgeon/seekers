<?php 
class Compliantpriority extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->data['cur_page_name']=config_item('page_title').' Compliant Priority ';	
	    $this->data['current_page_head']='Priority';
		$this->data['page'] = 'lead_source';
		$this->data['module_head'] = 'Manage Compliant Priority';
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}

	
	function index($offset = 0)
	{	
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=5;
		}
		$rows='';
		$this->load->model('compliantprioritymodel');
		
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
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->compliantprioritymodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/compliantpriority/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->compliantprioritymodel->get_all($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Compliant Priority';

		$this->load->view('include/header');
		$this->load->view('compliantpriority/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function add()
	{	
		$this->data['formdata']=array(
		'ticket_priority_id'=> '',
		'ticket_priority_name'=> '',
		'status'=> ''
		
		);
		
		$this->load->model('compliantprioritymodel');		
		
		
		if($this->input->post('ticket_priority_name'))
		{
			$this->form_validation->set_rules('ticket_priority_name', 'Priority Title', 'required');
			$this->form_validation->set_rules('priority_name_dup', 'Priority name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->compliantprioritymodel->insert_record();
				redirect('compliantpriority/?ins=1');
			}
				$this->data['formdata']=array(
				'ticket_priority_id'=> $this->input->post('ticket_priority_id'),
				'ticket_priority_name'=> $this->input->post('ticket_priority_name'),
				'status' =>$this->input->post('status')
				
				);				
		}
		$this->data['page_head']= 'Add Compliant Priority';

		$this->load->view('include/header');
		$this->load->view('compliantpriority/add',$this->data);				
		$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'ticket_priority_id'=> '',
		'ticket_priority_name'=> '',
		'status'=> ''
		);

		if(!empty($id))
		{
			$this->load->model('compliantprioritymodel');	
			$data['page_head']= 'Edit Compliant Priority';
			
			$query=$this->db->query("SELECT * FROM pms_tickets_priority where ticket_priority_id=".$id);
			$data['formdata']=$query->row_array();			


		$this->load->view('include/header');
		$this->load->view('compliantpriority/edit',$data);				
		$this->load->view('include/footer');
		}

	}

	function changestat($id=null)
	{
		if($id=='')redirect('compliantpriority');
		if($this->input->get('stat')=='')redirect('compliantpriority');
		$this->db->query("update pms_tickets_priority set status=".$this->input->get('stat')." where ticket_priority_id=".$id);
		redirect('compliantpriority?stat=1');

	}

	function update($id=null)
	{
		$this->load->model('compliantprioritymodel');
		$id=$this->input->post('ticket_priority_id');
			if($this->input->post('ticket_priority_name'))
			{
				$this->form_validation->set_rules('ticket_priority_name', 'Priority Title', 'required');
			    $this->form_validation->set_rules('priority_name_dups', 'Priority name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->compliantprioritymodel->update_record($id);
					redirect('compliantpriority/?upd=1');
				}else{
				     $this->data['formdata'] =	array(
					'ticket_priority_id'=>$this->input->post('ticket_priority_id'),
					'ticket_priority_name'=>$this->input->post('ticket_priority_name'),
					'status'=> $this->input->post('status'),
								
					);
		$this->data['page_head']= 'Edit Compliant Priority';

		$this->load->view('include/header');
		$this->load->view('compliantpriority/edit',$this->data);				
		$this->load->view('include/footer');				
				}
				}else
			{
				redirect('compliantpriority');
			}			
	}

	function check_dups()
	{
		$this->db->where('ticket_priority_name', $this->input->post('ticket_priority_name'));
		if($this->input->post('ticket_priority_id') > 0)	$this->db->where('ticket_priority_id !=', $this->input->post('ticket_priority_id'));
		$query = $this->db->get('pms_tickets_priority');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Priority name already used, please change');
			return false;
		}
	}	

	function delete($id=null)
	{
		
		if(!empty($id))
		{
			if(!empty($id))
		{
			$this->db->where('ticket_priority_id', $id);
			$this->db->delete('pms_tickets_priority'); 
			redirect('compliantpriority/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('ticket_priority_id', $val);
					$this->db->delete('pms_tickets_priority'); 
				}
			redirect('compliantpriority/?del=1');
		}
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
			$this->load->model('compliantprioritymodel');
			$this->compliantprioritymodel->delete_multiple_record($id_arr);
			redirect('compliantpriority/?multi=1');
		}
		else{
			redirect('compliantpriority');
		}
	}
	   
}
?>
