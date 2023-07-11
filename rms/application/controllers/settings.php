<?php 
class Settings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		$this->load->model("admingroupmodel");
		$this->data['cur_page_name']=config_item('page_title').' settings ';
		$this->data['current_page_head']='Settings';
		$this->data['page'] = 'settings';
		$this->data['module_head'] = 'Manage Settings';
		$this->data['module_explanation'] = 'edit settings from here.';
		
		$this->load->model("generalmodel");
		//$this->load->model('workquotemodel');

		$this->data['tasks'] =$this->generalmodel->getTasks();
		$this->data['todos'] = $this->generalmodel->getTodos();
		$this->data['messages'] = $this->generalmodel->getMessages();
		$this->data['emails'] = $this->generalmodel->getEmails();
		
		
	}
	
	function index($start = 0)
	{
		
		$query=$this->db->query("select * from pms_settings");
		$this->data['result']=$query->result_array();
		//$query=$this->db->query("select smtp_outgoing_server,smtp_incoming_server,smtp_username,smtp_password,smtp_port from pms_admin_users WHERE `admin_id`=".$_SESSION["admin_session"]);
		$query=$this->db->query("select smtp_outgoing_server,smtp_incoming_server,smtp_username,smtp_password,smtp_port from pms_candidate WHERE `candidate_id`=".$_SESSION["admin_session"]);
		$c=$query->result_array();
		$this->data['emailsettings']=$c[0];
		if(($this->input->get('submit')==1))
		{
			$count=count($this->data['result']);
			for($i=0;$i<$count;$i++){
				$id	=	$this->input->post('txtId'.$i);
				$value	=	$this->input->post('txtValue'.$i);
				if(trim($value)==''){
					redirect('settings/?del=1');		
				}
				else{
					
				$query="UPDATE `pms_settings` SET `value`='".$value."' where settings_id=$id";
        $this->db->query($query);	
					
				}
				
			}
			
			redirect('settings/?upd=1');
			
			
		}
	
		$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);
		
		$this->load->view("includes/header",$this->data);
		$this->load->view('settings/list',$this->data);				
		$this->load->view("settings/incomes_footer",$this->data);
		
				
		
	}	
	
	
	function email($start = 0)
	{
		
		
		//$query=$this->db->query("select smtp_outgoing_server,smtp_incoming_server,smtp_username,smtp_password,smtp_port from pms_admin_users WHERE `admin_id`=".$_SESSION["admin_session"]);
		
		$query=$this->db->query("select smtp_outgoing_server,smtp_incoming_server,smtp_username,smtp_password,smtp_port from pms_candidate WHERE `candidate_id`=".$_SESSION["admin_session"]);
		$c=$query->result_array();
		$this->data['emailsettings']=$c[0];
		
		if(($this->input->get('submit')==2))
		{
			$count=count($this->data['result']);			
			//$query="UPDATE pms_admin_users SET smtp_outgoing_server='".$this->input->post('smtp_outgoing_server')."',smtp_incoming_server='".$this->input->post('smtp_incoming_server')."',smtp_username='".$this->input->post('smtp_username')."',smtp_password='".$this->input->post('smtp_password')."',smtp_port='".$this->input->post('smtp_port')."'  WHERE `admin_id`=".$_SESSION["admin_session"];
			$query="UPDATE pms_candidate SET smtp_outgoing_server='".$this->input->post('smtp_outgoing_server')."',smtp_incoming_server='".$this->input->post('smtp_incoming_server')."',smtp_username='".$this->input->post('smtp_username')."',smtp_password='".$this->input->post('smtp_password')."',smtp_port='".$this->input->post('smtp_port')."'  WHERE `candidate_id`=".$_SESSION["admin_session"];
        	$this->db->query($query);		
			
			redirect('settings/email/?upd=1');
			
			
		}
		$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);
		
		$this->load->view("includes/header",$this->data);
		$this->load->view('settings/list',$this->data);				
		$this->load->view("settings/incomes_footer",$this->data);
		
				
		
	}	
	
	
	
}
?>
