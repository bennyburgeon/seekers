<?php 
class Compliantstatus extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->data['cur_page_name']=config_item('page_title').' Compliant Status ';	
	    $this->data['current_page_head']='Status';
		$this->data['page'] = 'lead_source';
		$this->data['module_head'] = 'Manage Compliant Status';
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	}

	
	function index($offset = 0)
	{	
		$this->load->model('compliantstatusmodel');
		$this->data['page_head']= 'Manage Compliant Status';
		$this->data['module_action'] = 'List All Status';
		
		$config['base_url'] = base_url().'leads/?';
		
		$this->data['records']=$this->compliantstatusmodel->get_all();
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		
		$this->data['module_action'] = 'List All Status';
		$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);

		$this->load->view('includes/header_masters',$this->data);
		$this->load->view('compliantstatus/list',$this->data);				
		$this->load->view('includes/footer_masters');
	}	

	function add()
	{	
		$this->data['formdata']=array(
			'ticket_status_id'=> '',
		'ticket_status_name'=> '',
		'status'=> ''
		
		);
		
		$this->load->model('compliantstatusmodel');		
		
		
		if($this->input->post('ticket_status_name'))
		{
			$this->form_validation->set_rules('ticket_status_name', 'Status Title', 'required');
		
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->compliantstatusmodel->insert_record();
				redirect('compliantstatus/?ins=1');
			}
				$this->data['formdata']=array(
				'ticket_status_id'=> $this->input->post('ticket_status_id'),
				'ticket_status_name'=> $this->input->post('ticket_status_name'),
				'status' =>    $this->input->post('status')
				
				);				
		}
				$this->data['page_head']= 'Add Compliant Status';
				
				$this->data['module_action'] = 'Add Compliant Status';
		$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);

		$this->load->view('includes/header_masters',$this->data);
		$this->load->view('compliantstatus/add',$this->data);				
		$this->load->view('includes/footer_masters');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'ticket_status_id'=> '',
		'ticket_status_name'=> '',
		'status'=> ''
		);
		
		
		
		if(!empty($id))
		{
			
			
			
			$this->load->model('compliantstatusmodel');	
			
			
			$data['page_head']= 'Edit Compliant Status';
			
			$query=$this->db->query("SELECT * FROM pms_tickets_status where ticket_status_id=".$id);
			$data['formdata']=$query->row_array();			
			$this->data['module_action'] = 'Edit Compliant Status';
		$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);

		$this->load->view('includes/header_masters',$this->data);
		$this->load->view('compliantstatus/edit',$data);				
		$this->load->view('includes/footer_masters');
		}
		{
			//redirect('categories');	
		}
	}

	function changestat($id=null)
	{
		if($id=='')redirect('compliantstatus');
		if($this->input->get('stat')=='')redirect('compliantstatus');
		$this->db->query("update pms_tickets_status set status=".$this->input->get('stat')." where ticket_status_id=".$id);
		redirect('compliantstatus?stat=1');

	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Compliant Status';
		$this->load->model('compliantstatusmodel');
		
			if($this->input->post('ticket_status_id'))
			{

				//$data["parent_list"] = $this->leadfoldermodel->parent_list();	
		
				$this->form_validation->set_rules('ticket_status_name', 'Status Title', 'required');
				//$this->form_validation->set_rules('check_dups', 'Folder Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->compliantstatusmodel->update_record($id);
					redirect('compliantstatus/?update=1');
				}
				
		
				
				$this->data['module_action'] = 'Edit Compliant Status';
		$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);

		$this->load->view('includes/header_masters',$this->data);
		$this->load->view('compliantstatus/edit',$this->data);				
		$this->load->view('includes/footer_masters');				
			}else
			{
				redirect('compliantstatus');
			}			
	}

	function check_dups()
	{
		$this->db->where('ticket_status_name', $this->input->post('ticket_status_name'));
		if($this->input->post('ticket_status_name') > 0)	$this->db->where('ticket_status_id !=', $this->input->post('ticket_status_id'));
		$query = $this->db->get('pms_tickets_status');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Status name already used, pelase change');
			return false;
		}
	}	

	function delete($id=null)
	{
		
		if(!empty($id))
		{
			if(!empty($id))
		{
			$this->db->where('ticket_status_id', $id);
			$this->db->delete('pms_tickets_status'); 
			redirect('compliantstatus/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('ticket_status_id', $val);
					$this->db->delete('pms_tickets_status'); 
				}
			redirect('compliantstatus/?del=1');
		}
	   }
	   }
	   
}
?>
