<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile1 extends CI_Controller {

	function __construct()
	{
//		parent::__construct();
//		$this->load->model('webservicemodel');
//		$this->load->model('locationmodel');
//		$this->load->model('statmodel');
//		$this->load->model('campusmodel');		
	}
	
	function index($offset = 0)
	{
		exit();
	}

	public function check_dups()
	{
		$data = array('success' => false, 'username' => 'false', 'mobile' => 'not-checked');		
		$postdata = file_get_contents("php://input");
		$vars=json_decode($postdata);

		if(is_object($vars) && $vars->username!='')
		{
			if($this->check_admin_permission($vars->username,$vars->mobile)==true)
			{
				$this->db->where('username', $vars->username);
				$this->db->where('mobile', $vars->mobile);
				$query = $this->db->get('pms_candidate');
				$row=$query->row_array();				
				$data = array('success' => 'override', 'candidate_id' => $row['candidate_id'], 'encypt_key' => md5($row['candidate_id']));
				$this->send_sms($row['mobile'],$row['candidate_id']); // send otp for registered already, added by admin and they can use the mobileapp.
				echo json_encode($data);
				exit();
			}

			$this->db->where('username', $vars->username);
			$query = $this->db->get('pms_candidate');
			if ($query->num_rows() == 0)
			{
				$this->db->where('mobile', $vars->mobile);
				$query = $this->db->get('pms_candidate');
				if ($query->num_rows() == 0)
				{
					$data = array('success' => 'true', 'mobile' => 'true',  'username' => 'true');
					echo json_encode($data);
					exit();
				}else
				{
					$data = array('success' => 'false', 'username' => 'true', 'mobile' => 'false');
					echo json_encode($data);
					exit();
				}
			}else{
				$data = array('success' => 'false', 'username' => 'false', 'mobile' => 'not-checked');
				echo json_encode($data);
				exit();
			}
		}else
		{
				echo json_encode($data);
				exit();
		}
	}
		
}
?>
