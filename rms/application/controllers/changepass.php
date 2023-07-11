<?php 
class Changepass extends CI_controller{
	
	function Changepass()
	{
		
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		$this->load->model("changepassmodel");
		
	}
	
	function index($offset = 0)
	{	
		$this->load->model("changepassmodel");
		$id =1;
		$this->data["page_head"]= "Change Password";
		
		if($this->input->post("old_pass"))
		{ 
			$this->form_validation->set_rules("old_pass","Password","required");
			$this->form_validation->set_rules('check_password', 'Oldpassword', 'callback_check_password');
			
			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->changepassmodel->update_record();
				redirect('changepass/?upd=1');
			}
			
		}
		
			
        $this->data['profile']="Edit Password";
		$this->load->view("include/header",$this->data);
		$this->load->view("changepass/edit",$this->data);
		$this->load->view("include/footer",$this->data);
		
	}
	
	function check_password()
	{ 
		$this->db->where("password",md5($this->input->post("old_pass")));
		$this->db->where('admin_id',$_SESSION['admin_session']);
		$query = $this->db->get("pms_admin_users");
		if($query->num_rows()==1) 
		return true;
		else{
			$this->form_validation->set_message('check_password',"Old password does'nt exists");
			return false;
		}
	}

}
?>