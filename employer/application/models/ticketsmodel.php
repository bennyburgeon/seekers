<?php 
class ticketsmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_tickets';
    }
	
	/*function record_count() 
	{
        return $this->db->count_all($this->table_name);
    }
    
	function get_list()
    {
		$query = $this->db->query("select a.*,b.ticket_status_id,b.ticket_status_name,c.ticket_priority_name,c.ticket_priority_id from pms_tickets a inner join pms_tickets_status b on a.ticket_status_id = b.ticket_status_id  
inner join pms_tickets_priority c on c.ticket_priority_id = a.ticket_priority_id");
		return $query->result_array();
    }*/
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as ticket_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" ticket_title like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['ticket_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select a.*,b.ticket_status_id,b.ticket_status_name,c.ticket_priority_name,c.ticket_priority_id from pms_tickets a left join pms_tickets_status b on a.ticket_status_id = b.ticket_status_id  
left join pms_tickets_priority c on c.ticket_priority_id = a.ticket_priority_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" a.ticket_title like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.ticket_title ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }

	
	
	
    function get_company_name($id)
	{
		if($id < 1) return '';
		$query = $this->db->query("select company_name from pms_contacts where contact_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['company_name'];
			}else
			{
				return '';
			}
	}
	    
	function insert_record()
    {	

		$data =	array(
		                'project_id' => '7',
						'ticket_title' => $this->input->post('ticket_title'),
						'ticket_description' => $this->input->post('ticket_description'),
						'ticket_date' => date("Y-m-d"),
						'ticket_time' => $this->input->post('ticket_time'),
						'ticket_status_id' => $this->input->post('ticket_status_id'),
						'ticket_priority_id' => $this->input->post('ticket_priority_id'),
						'candidate_id' => $this->input->post('candidate_id'),
						'admin_user_id' => '',
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'status' => $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);
		$id=$this->db->insert_id();
		return $id;
    }
	
	
	function update_record($id=NULL)
	{

		$data =	array(
		                'project_id' => '7',
						'ticket_title' => $this->input->post('ticket_title'),
						'ticket_description' => $this->input->post('ticket_description'),
						'ticket_date' => date("Y-m-d"),
						'ticket_time' => $this->input->post('ticket_time'),
						'ticket_status_id' => $this->input->post('ticket_status_id'),
						'ticket_priority_id' => $this->input->post('ticket_priority_id'),
						'candidate_id' => $this->input->post('candidate_id'),
						'admin_user_id' => $_SESSION['company_session'],
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'status' => $this->input->post('status')
		);

       $this->db->where('ticket_id', $id);
	   $this->db->update($this->table_name, $data);
	   
	}
	
	function status_list()
	{
		$query = $this->db->query('select distinct ticket_status_id, ticket_status_name from pms_tickets_status where status = 1 order by ticket_status_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Status';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->ticket_status_id] = $dropdown->ticket_status_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function priority_list()
	{
		$query = $this->db->query('select distinct ticket_priority_id, ticket_priority_name from pms_tickets_priority where status = 1 order by ticket_priority_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Priority';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->ticket_priority_id] = $dropdown->ticket_priority_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function folder_list()
	{
		$query = $this->db->query('select distinct folder_id, folder_name from pms_contact_folder order by folder_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Folder';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->folder_id] = $dropdown->folder_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function products_list()
	{
		$query = $this->db->query('select distinct product_id, product_name from pms_contact_products order by product_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Products';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->product_id] = $dropdown->product_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function source_list()
	{
		$query = $this->db->query('select distinct source_id, source_name from pms_contact_source order by source_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Source';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->source_id] = $dropdown->source_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	
	function opp_list()
	{
		$query = $this->db->query('select distinct opp_id, opp_name from pms_opportunity order by opp_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Oppotunity';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->opp_id] = $dropdown->opp_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function country_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}		

	function cur_business($id)
	{
		$query = $this->db->query('select business_id, contact_id from pms_contact_to_business where contact_id='.$id);
		$dropdowns = $query->result();
		$dropDownList=array();
		$i=0;
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$i] = $dropdown->business_id;
			 $i++;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	

	function cur_products($id)
	{
		$query = $this->db->query('select product_id, contact_id from pms_contact_to_products where contact_id='.$id);
		$dropdowns = $query->result();
		$dropDownList=array();
		$i=0;
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$i] = $dropdown->product_id;
			 $i++;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_extras($id)
	{
			if($id!='')
			{
				$query = $this->db->query("SELECT b.city_name, c.state_name,c.state_id,d.country_id FROM `pms_contacts` a inner join pms_city b on a.city_id=b.city_id inner join pms_state c on b.state_id=c.state_id inner join pms_country d on c.country_id=d.country_id where a.contact_id=".$id);					
				
				if ($query->num_rows()> 0)
				{
					$row = $query->row_array();
					return $row;
				}else
				{
					return array();
				}
			}
	}
	function delete($id=null)
	{
	
		$this->db->where('ticket_id', $id);
		$this->db->delete('pms_tickets'); 
		
	}
	function get_ticket($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.*,c.* from pms_tickets a inner join pms_tickets_status b ON a.ticket_status_id=b.ticket_status_id inner join pms_tickets_priority c ON a.ticket_priority_id=c.ticket_priority_id where a.ticket_id = ".$id);
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	function get_ticket_followup($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.* from pms_tickets_followup a inner join pms_tickets_status b ON a.tkt_status_id=b.ticket_status_id where a.tkt_fp_id = ".$id);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	
	function select_record($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.* from pms_tickets_followup a inner join pms_tickets_status b ON a.tkt_status_id=b.ticket_status_id where a.tkt_fp_id = ".$id);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	
	function get_followup_list($id){
		$query = $this->db->query("select a.*,b.* from pms_tickets_followup a inner join pms_tickets_status b ON a.tkt_status_id=b.ticket_status_id
where a.ticket_id = $id order by tkt_fp_id   ASC ");
		return $query->result_array();
	}
	function candidate_ddl(){
		$query=$this->db->query("select candidate_id,first_name,last_name from pms_candidate");
		$candidate_list = $query->result();
		
		foreach($candidate_list as $dropdown)
		{
			$dropDownList[$dropdown->candidate_id] = $dropdown->first_name.' '.$dropdown->last_name;
		}
		return $dropDownList;
	}
	function logged_user_details(){
		$query = $this->db->query("select firstname,lastname,email from pms_admin_users where admin_id=".$_SESSION['company_session']);
		return $query->row_array();
	}
	
	
	function getTicketCandidate($ticket_id){
		$query = $this->db->query('select candidate_id from pms_tickets where ticket_id='.$ticket_id);
		return $query->row_array();
	}
	function getcandidateMail($candidate_id){
	
		$query = $this->db->query("select username,first_name,last_name from pms_candidate where candidate_id=".$candidate_id);
		return $query->row_array();
		 

	}
}
?>