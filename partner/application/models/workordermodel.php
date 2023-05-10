<?php 
class workordermodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_work_orders';
    }
	
	function record_count() 
	{
        return $this->db->count_all($this->table_name);
    }
    
	function get_list()
    {
		$query = $this->db->query("select * from pms_work_orders Order by work_order_id Desc");
		return $query->result_array();
    }
	

	function delete($id=null)
	{
	
		$this->db->where('work_order_id', $id);
		$this->db->delete('pms_work_orders'); 
		
	}
	function get_workorder($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select * from pms_work_orders where work_order_id = ".$id);
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	function getName($tbl,$dispFld,$IdFld,$val)
	{
		if($val==0)
			$myN = "Site Admin";
		else
		{
			$myN = "Unknown";
		
			$qry = "SELECT $dispFld FROM $tbl WHERE $IdFld=$val";
			$result = mysql_query($qry);
		
			if($arow = mysql_fetch_array($result))
				$myN = $arow[0];
		
			mysql_free_result($result);
		
		}
	
		return $myN;	
	
	}
	
}
?>