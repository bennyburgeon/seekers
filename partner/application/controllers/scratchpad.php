<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scratchpad extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');

		date_default_timezone_set('Asia/Calcutta');

		$this->data['cur_page_name']=config_item('page_title').' Groups ';
		$this->data['current_page_head']='Groups';
		$this->data['page'] = 'admin_groups';
		$this->data['module_head'] = 'Manage Groups';
		$this->data['module_explanation'] = 'add/edit/activate user groups from here.';

		// $this->data['left_nav']=$this->load->view('public/left-menu',$this->data,true);

		$this->load->model("generalmodel");
		$this->load->model('workordermodel');
		$this->load->model("mytasksmodel");
		$this->load->model('scratchmodel');
	}
	
	public function index()
	{	

	   	$this->data['message']='';
		
		if($this->input->get('update')=='1')
		{
			$this->data['message']='Scratchpad updated successfully ';
		}

		if($this->input->get('del')=='1')
		{
			$this->data['message']='Note item deleted successfully';
		}
				
		if($this->input->get('update')=='2')
		{
			$this->data['message']=' Updated successfully';
		}

		if($this->input->get('add_lead')=='1')
		{
			$this->data['message']=' Lead created sucessfully.';
		}		

		if($this->input->get('err_lead')=='1')
		{
			$this->data['message']=' Unable to add contact, something went wrong.';
		}
		
		if($this->input->get('add_task')=='1')
		{
			$this->data['message']=' Task created sucessfully.';
		}

		if($this->input->get('err_task')=='1')
		{
			$this->data['message']=' Unable to add task, something went wrong.';
		}
								
		$this->load->model('scratchmodel');

		$this->data["course_list"] = array();
		$this->data["level_list"] = $this->scratchmodel->fill_levels();

		$this->data["edu_level_list"] = $this->scratchmodel->edu_fill_levels();
		$this->data["edu_course_list"] = array();
				
		$this->data["branch_list"] = $this->scratchmodel->branch_list();
		$this->data['admin_users_lists']= $this->scratchmodel->get_admin_users_lists();

		$this->data['formdata']=array(
			'scratch_content' => '',
		);

		$this->data["taskinfo"] = array(
				"task_title" => "",
				"candidate_id" => "",
				"start_date" =>"",
				"due_date" =>"",
				"task_priority_id"=>  "1",
				"task_status_id" => "1",
				"task_desc" => "",
				"admin_id" =>"",
				"status" => "1"				
				);
				
		$this->data["admin_list"]=$this->mytasksmodel->admin_list();
		
		$query = $this->db->query("SELECT scratch_id,scratch_content, UNIX_TIMESTAMP(datetime)as datetime,status,user_id from  pms_scratchpad where user_id=".$_SESSION['vendor_session']." order by UNIX_TIMESTAMP(datetime) desc");

		$this->data['scratch_list']=array();
		if ($query->num_rows() > 0)
		{
		   $this->data['scratch_list']=$query->result_array();	
		}	

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
					
		$this->data['ckeditor']=$this->_setup_ckeditor('page_content'); // your model property's HTML for CKEditor textarea)	
		
		$this->data['cur_page']=$this->router->class;
		$this->load->view('include/header',$this->data);
		
		$this->load->view('scratchpad/scratchpad',$this->data);
		$this->load->view('include/footer');		
	}

	


	function update()	
	{
		if(($this->input->post('scratch_content'))!='')
		{
		if($this->input->post('scratch_content'))
		{ 
			$data=array(
				'user_id' => $_SESSION['vendor_session'],	
				'scratch_content' => $this->input->post('scratch_content'),	
				'datetime' => date('Y-m-d- h:i:s'),				
			);
	   		$this->db->insert('pms_scratchpad', $data);	
			$this->data['error_msg']=' Cannot empty description';
			redirect('scratchpad/?update=1');				
		}
	}else{
			redirect('scratchpad/?update=2');	
		}
	}

	function create_lead()	
	{
		
		if($this->input->post('username')!='' && $this->input->post('first_name')!='' && $this->input->post('mobile')!='')
		{
			$this->form_validation->set_rules("first_name","Candidate Name","required");
			$this->form_validation->set_rules('check_dups', 'Email Address', 'callback_check_dups');
			$this->form_validation->set_rules('check_dups', 'Mobile Number', 'callback_check_mobile');		
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->scratchmodel->insert_contact_from_scratch_pad();
			
				if ($id != '') { //success
					redirect('scratchpad/?add_lead=1');
				} 
				else { //failure
					redirect('scratchpad/?err_lead=1');
				}
			}else
			{
				redirect('scratchpad/?err_lead=1');
			}
		}else
		{
			redirect('scratchpad/?err_lead=1');	 // error 1 means unable to add candidate. 
		}
	}

	function create_task()
	{
		if($this->input->post("task_title"))
		{
			$this->form_validation->set_rules("task_title","Task Title","required");
			if ($this->form_validation->run() == TRUE)
				{
					$id = $this->scratchmodel->create_task();
					redirect('scratchpad/?add_task=1');
				}else
				{
					redirect('scratchpad/?err_task=1');
				}
		}else
		{
			redirect('scratchpad/?err_task=1');
		}
	}
	
	function check_dups()
	{
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('pms_candidate');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Username/Email already used.');
			return false;
		}
	}

	function check_mobile()
	{
		$this->db->where('mobile', $this->input->post('mobile'));
		$query = $this->db->get('pms_candidate');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Mobile already used.');
			return false;
		}
	}	
			
    private function _setup_ckeditor($id)
    {
        $this->load->helper('url');
    	$this->load->helper('ckeditor');
 
        $ckeditor = array(
            'id' => $id,
            'path' => 'ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '800px',
                'height' => '400px',
                'filebrowserImageUploadUrl' => $this->config->site_url().'/form/upload'));
        return $ckeditor;
    }

	function delete($id)
	{
		if($id=='')redirect('scratchpad');
		if(!empty($id))
		{
			$this->db->query("delete from pms_scratchpad where scratch_id=".$id);
			redirect('scratchpad?del=1');
		}
		redirect('scratchpad');
	}

	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }
	
}
?>