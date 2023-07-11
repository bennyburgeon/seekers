<?php 
class Account_modulemodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_accounts';
    }
	function record_count($searchterm,$account_type_id) 
	{
	
		$sql	= "select count(*)as account_id from pms_accounts a left join pms_account_types b on a.account_type_id=b.account_type_id" ;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" account_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($account_type_id!='')
		{
			if($cond!=''){
				$cond.=" and a.account_type_id=" . $account_type_id;
			} 
			else{
				$cond=" a.account_type_id=" . $account_type_id;
			}  
		}
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['account_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by,$account_type_id)
    {
		$sql="select a.*,b.* from pms_accounts a left join pms_account_types b on a.account_type_id=b.account_type_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" account_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($account_type_id!='')
		{
			if($cond!=''){
				$cond.=" and a.account_type_id=" . $account_type_id;
			} 
			else{
				$cond=" a.account_type_id=" . $account_type_id;
			}  
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by account_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	function insert_record()
    {
		$data=array(
		'account_code'=>$this->input->post('account_code'),
		'account_name'=>$this->input->post('account_name'),
		'account_type_id'=>$this->input->post('account_type_id'),
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'account_code'=>$this->input->post('account_code'),
		'account_name'=>$this->input->post('account_name'),
		'account_type_id'=>$this->input->post('account_type_id')
		);
       $this->db->where('account_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('account_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function get_account_type()
	{
		$query = $this->db->query('select distinct account_type_id, account_type_name from pms_account_types order by account_type_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Account Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->account_type_id] = $dropdown->account_type_name;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	
	
}
?>