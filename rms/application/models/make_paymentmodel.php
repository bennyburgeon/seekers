<?php
class Make_paymentmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_company_users";
	}
	
	function record_count($searchterm)
	{
		if($searchterm=='')
		{
			$sql="select count(*)as user_id from pms_company_users";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['user_id'];
		}
		else
		{
			$sql="select count(*)as user_id from pms_company_users where firstname like '%" . $searchterm . "%'";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['user_id'];
		}
	}
	
	function other_admin_list($id)
	{
		$query = $this->db->query("SELECT user_id,firstname,lastname,email,status FROM ".$this->admin_table);
		return $query->result_array();
	}
	
	function admin_list($start,$limit,$searchterm,$sort_by)
	{		
		$sql="select a.*,b.package_name,b.total_job_ads,c.company_name from pms_employer_credits a inner join pms_employer_ad_packages b on a.package_id=b.package_id inner join pms_company c on c.company_id=a.company_id where b.package_name like '%" . $searchterm . "%' ";
		$sql.=" order by b.package_id desc limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin_old($id)
	{
		$query = $this->db->get_where($this->admin_table,array('user_id'=>$id));
		return $query->row_array();
	}
	
	
	function single_admin($id)
	{
		$sql="select a.*,b.company_name from pms_company_users a inner join pms_company b on b.company_id=a.company_id where a.user_id=".$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function single_adminByUsername($id)
	{
		$query = $this->db->get_where($this->admin_table,array('username'=>$id));
		return $query->row_array();
	}
	
	
	function insert_record()
	{ 
		$data = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"password" => md5($this->input->post("password")),
				"company_id" => $this->input->post("company_id"),
				"address" => $this->input->post("address"),
				"mobile"=>$this->input->post("phone"),
				"reg_date"=>date('Y-m-d'),
				"status"=> 1,
				"payment_status" => 1,
				);
				
		$this->db->insert($this->admin_table,$data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	
	function select_values_list($company_id)
    {
       $query=$this->db->query("select a.*,b.company_name from pms_company_users a inner join pms_company b on a.company_id=b.company_id where a.company_id=".$company_id);
		return $query->row_array();
	}
	
	
	function add_package($id)
    {
		//print_r($this->data["select_values"]); exit();
		if($this->input->post('package_id')==1) {
		   $package_exp_date     = date('Y-m-d', strtotime("+30 days"));
		   $package_amount		 = '300';
		   $amount_per_job		 = '300';
	   } 
		 else if($this->input->post('package_id')==2) {
		   $package_exp_date     = date('Y-m-d', strtotime("+90 days"));
		   $package_amount		 = '1250';
		   $amount_per_job		 = '250';
	   } 
		 else if($this->input->post('package_id')==3) {
		   $package_exp_date     = date('Y-m-d', strtotime("+180 days"));
		   $package_amount		 = '2250';
		   $amount_per_job		 = '225';
	   } 
		 else if($this->input->post('package_id')==4) {
		   $package_exp_date     = date('Y-m-d', strtotime("+360 days"));
		   $package_amount		 = '5000';
		   $amount_per_job		 = '200';
	   }  
	   
	    
		$data =	array(
			'company_id'	 		   => $this->input->post('company_id'),
			'user_id'   	 		   => $id,
			'package_id'  	 		   => $this->input->post('package_id'),
			'package_amount' 		   => $package_amount,
			'package_start_date'       => date('Y-m-d'),
			'package_exp_date'         => $package_exp_date,
			'amount_per_job'           => $amount_per_job,
			'emp_package_status'       => 1,
			
			);
//print_r($data); exit();
		$this->db->where('emp_package_status',1);
		$this->db->where('company_id',$this->input->post('company_id'));
		$this->db->where('user_id',$id);
		$this->db->delete('pms_employer_credits');
        $this->db->insert('pms_employer_credits', $data);
		$ins_id = $this->db->insert_id();
		
		
			$firstname = $this->data["select_values"]['firstname'];
			$email = $this->data["select_values"]['email'];
			$phone = $this->data["select_values"]['mobile'];
			$username = $this->data["select_values"]['username'];
		$datas =	array(
			'company_id'   => $this->input->post('company_id'),
			'fname'        => $firstname,
			'email'        => $email,
			'mobile'       => $phone,
			'txnid'        => 'TXN-RMS',
			'amount'       => $package_amount,
			'date'         => date("Y-m-d h:i:s A"),
			'status'       => 1,
			'username'     => $username,
			);
		
        $this->db->insert('pms_payment_summary', $datas);
		
		
		$status =	array(
		'payment_status'       => 1,
		
		);
		$this->db->where('company_id', $this->input->post('company_id'));
		$this->db->where('user_id', $id);
		$this->db->update('pms_company_users', $status);
		
					
		return $ins_id;
    }
	
	function update_record()
	{
		$data = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"company_id" => $this->input->post("company_id"),
				"address" => $this->input->post("address"),
				"payment_status" => 1,
				"package"        =>$this->input->post("package")
				);

	   $this->db->where('user_id', $this->input->post('user_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   if($this->input->post('password')!='')
	   {
		   $data = array(
				"password" =>  md5($this->input->post("password"))
				);
		    $this->db->where('user_id', $this->input->post('user_id'));
	  		$this->db->update($this->admin_table, $data);
	   }
	   
	    
	   $this->db->where('user_id', $this->input->post('user_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   $id = $this->input->post('user_id');
		
	}

	
	
	
	function fill_company()
	{
		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a where a.company_id in(select company_id from pms_company_users) order by a.company_id asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	
	function company_list()
	{
		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a order by a.company_id asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
		
	function delete_record($id)
	{
		if($id=='')return;
		$this->db->delete($this->admin_table,array('user_id'=>$id));
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('user_id',$id);
			$this->db->delete($this->admin_table);
		}	
    }
	
	function list_packages()
    {

        $query=$this->db->query("select * from pms_employer_ad_packages where package_status=1");
		return $query->result_array();
	}
	
	
	function selected_packages($company_id)
    {

        $query=$this->db->query("select a.*,b.package_name,b.total_job_ads from pms_employer_credits a inner join pms_employer_ad_packages b on a.package_id=b.package_id where a.emp_package_status=1 and a.company_id=".$company_id);
		
		return $query->result_array();
	}
	
}
?>
