<?php 
class Myprofile extends CI_controller{
	
	function Myprifile()
	{
		parent::__construct();
	  if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');
		$this->load->model("myprofilemodel");
	}
	
	function index($offset = 0)
	{	
		$this->load->model("myprofilemodel");
		$id =1;
		$this->data["page_head"]= "My Profile";
		if($this->input->post("lastname"))
		{ 
			$this->form_validation->set_rules("firstname","Manager Name","required");
			$this->form_validation->set_rules("email","Email","required|valid_email");
			$this->form_validation->set_rules("username","Username","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->myprofilemodel->update_record();
				redirect('myprofile/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
				"user_id" => $this->input->post("user_id"),
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"address" => $this->input->post("address"),
				);
			}
		}

		$this->data["formdata"] = $this->myprofilemodel->single_admin($_SESSION['company_session']);

        $this->data['profile']="Edit Profile";
		$this->load->view("include/header");
		$this->load->view("myprofile/edit",$this->data);
		$this->load->view("include/footer",$this->data);
		
	}
	
	function check_dups()
	{ 
		$this->db->where("username",$this->input->post("username"));
		if($this->input->post("user_id"))
		   {
			$this->db->where('user_id !=', $this->input->post("user_id"));
			}
		$query = $this->db->get("pms_company_users");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin username already exists");
			return false;
		}
	}
}
?>