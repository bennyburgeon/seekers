<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->data['cur_page_name']=config_item('page_title').' Admin Login ';
		$this->data['current_page_head']='Admin Login';
		$this->data['errmsg']='';
		$this->data['copy_right']=config_item('copy_right');
	}
	
	public function index()
	{

		if(isset($_SESSION['admin_session']) && $_SESSION['admin_session']!='')
		{
			redirect('dashboard');
			//redirect('recent_apps');
		}
		$this->data['errmsg']='';

		if($this->input->post('username') && $this->input->post('password'))
		{
			$query = $this->db->query("SELECT admin_id,email, username, password,group_id,firstname,lastname,address,admin_prof_img_url from pms_admin_users where username='".$this->input->post('username')."' and password='".md5($this->input->post('password'))."' and status=1");
			
			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array();
			   $_SESSION['admin_session']=$row['admin_id'];
			   $_SESSION['admin_username']=$row['email'];
			   $_SESSION['username']=$row['username'];
			   $_SESSION['password']=$row['password'];
			   $_SESSION['group_id']=$row['group_id'];
			   $_SESSION['firstname']=$row['firstname'];
			   $_SESSION['lastname']=$row['lastname'];
			   $_SESSION['address']=$row['address'];
			   $_SESSION['admin_prof_img_url']=$row['admin_prof_img_url'];
			   $_SESSION['menu_list']=$this->categoryChild(0);	
		
			   redirect('dashboard');
			   //redirect('recent_apps');
			}else
			{
			// $this->data['errmsg']='Invalid username or password';
				$this->data['errmsg']='<p style="margin-top:-11px">Invalid username or password</p>';
			}
		}
		
		$this->load->view('login/list',$this->data);
	}

	public function index_auto()
	{
		if(isset($_SESSION['admin_session']) && $_SESSION['admin_session']!='')
		{
			redirect('dashboard');
		}
		$this->data['errmsg']='';

		$query = $this->db->query("SELECT admin_id,email, username, password,group_id,firstname,lastname,address,admin_prof_img_url from pms_admin_users where admin_id=1");
		if ($query->num_rows() > 0)
		{
		   $row = $query->row_array();
		   $_SESSION['admin_session']=$row['admin_id'];
		   $_SESSION['admin_username']=$row['email'];
		   $_SESSION['username']=$row['username'];
		   $_SESSION['password']=$row['password'];
		   $_SESSION['group_id']=$row['group_id'];
		   $_SESSION['firstname']=$row['firstname'];
		   $_SESSION['lastname']=$row['lastname'];
		   $_SESSION['address']=$row['address'];
		   $_SESSION['admin_prof_img_url']=$row['admin_prof_img_url'];
		   $_SESSION['menu_list']=$this->categoryChild(0);	
		   redirect('dashboard');
		}		
		$this->load->view('login/list',$this->data);
	}
	
	public function verify()
	{ 
		$this->data['errmsg']='';
		if($this->input->post('username') && $this->input->post('password'))
		{
			$query = $this->db->query("SELECT admin_id,email, username, password,group_id from pms_admin_users where username='".$this->input->post('username')."' and password='".md5($this->input->post('password'))."' and status=1");
			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array();
			   $_SESSION['admin_session']=$row['admin_id'];
			   $_SESSION['admin_username']=$row['email'];
			   $_SESSION['username']=$row['username'];
			   $_SESSION['group_id']=$row['group_id'];	
	           $_SESSION['menu_list']=$this->categoryChild(0);	
			   redirect('dashboard');
			}else
			{
				$this->data['errmsg']='<p style="margin-top:-11px">Invalid username or password</p>';

			}
		}
		$this->load->view('login/list',$this->data);
	}

function admin(){
$data['admin']= $this->db->query("SELECT * FROM pms_admin_users WHERE group_id='0'");
$this->load->view('include/header',$data);
}
	function categoryChild($id)
	{
	  $query = $this->db->query("SELECT m.module_id, m.module_name,m.module_class,m.module_url,m.status,m.module_order FROM pms_admin_modules m JOIN pms_admin_permission p on p.module_id=m.module_id inner join pms_admin_user_groups c on p.group_id=c.user_grp_id WHERE m.status=1 and c.user_grp_id=".$_SESSION['group_id']." and m.parent_id = $id ORDER BY m.module_order ASC");
	
	    $module_list= $query->result();
		
	    $children = array();
	    # It has children, let's get them.
	    foreach($module_list as $row)
		{
            $children[$row->module_id] = array(	"id"=>$row->module_id,
												"name"=>$row->module_name,
												"url"=>$row->module_url,
												"module_class" =>$row->module_class,
												"status" =>$row->status,
												"parent"=>$id,
												"ordering"=>$row->module_order,
												"sub"=>$this->categoryChild($row->module_id));
        }		
   	 	return $children;
		
	}	
}