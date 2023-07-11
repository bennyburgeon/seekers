<?php 
class Account_vouchermodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_vouchers';
    }
	function record_count($searchterm,$account_id,$admin_id) 
	{
	
		$sql	= "select count(*)as voucher_id from pms_vouchers a" ;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" voucher_date like '%" . $searchterm . "%'";
			}	
		}
		if($account_id!='')
		{
			if($cond!=''){
				$cond.=" and account_id=" . $account_id;
			} 
			else{
				$cond=" account_id=" . $account_id;
			}  
		}
		
		if($admin_id!='')
		{
			if($cond!=''){
				$cond.=" and admin_id=" . $admin_id;
			} 
			else{
				$cond=" admin_id=" . $admin_id;
			}  
		}
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['voucher_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by,$account_id,$admin_id)
    {
		$sql="select a.*, (select firstname from pms_admin_users ab where a.approved_by=ab.admin_id) as approved_by_name, (select firstname from pms_admin_users cb where a.prepared_by=cb.admin_id) as prepared_by_name, (select account_name from pms_accounts ad where a.debit=ad.account_id) as debit_account, (select account_name from pms_accounts ac where a.credit=ac.account_id) as credit_account from pms_vouchers a ";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" voucher_date like '%" . $searchterm . "%'";
			}		
		} 
		
		if($account_id!='')
		{
			if($cond!=''){
				$cond.=" and a.account_id=" . $account_id;
			} 
			else{
				$cond=" a.account_id=" . $account_id;
			}  
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by voucher_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	function insert_record()
    {
		$data=array(
		'voucher_code'=>$this->input->post('voucher_code'),
		'voucher_amount'=>$this->input->post('voucher_amount'),
		'voucher_date'=>$this->input->post('voucher_date'),
		'debit' =>$this->input->post('debit'),
		'amount'=>$this->input->post('amount'),
		'credit'=>$this->input->post('credit'),
		'narration'=>$this->input->post('voucher_code'),
		'approved_by'=>$this->input->post('approved_by'),
		'prepared_by'=>$this->input->post('prepared_by'));
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'voucher_code'=>$this->input->post('voucher_code'),
		'voucher_amount'=>$this->input->post('voucher_amount'),
		'voucher_date'=>$this->input->post('voucher_date'),
		'debit' =>$this->input->post('debit'),
		'amount'=>$this->input->post('amount'),
		'credit'=>$this->input->post('credit'),
		'narration'=>$this->input->post('voucher_code'),
		'approved_by'=>$this->input->post('approved_by'),
		'prepared_by'=>$this->input->post('prepared_by')
		);
       $this->db->where('voucher_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('voucher_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function get_account_list()
	{
		$query = $this->db->query('select distinct account_id, account_name from pms_accounts order by account_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Account Name';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->account_id] = $dropdown->account_name;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function get_admin_list()
	{
		$query = $this->db->query('select distinct admin_id, firstname from pms_admin_users order by firstname asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select User';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->admin_id] = $dropdown->firstname;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	
	
}
?>