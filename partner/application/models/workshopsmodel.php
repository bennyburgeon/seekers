<?php
class Workshopsmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->table_name = "pms_walkins";
	}
	
	function record_count($searchterm)
	{
			$sql="select count(*)as total_count from pms_walkins where event_type=4";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['total_count'];		
	}
	
	
	function walkin_list($start,$limit,$searchterm,$sort_by)
	{		
		$sql="SELECT a.*,b.job_title,c.company_name FROM pms_walkins a left join pms_jobs b on a.job_id=b.job_id left join pms_company c on b.company_id=c.company_id where a.event_type=4 ";
		$sql.=" order by a.interview_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->table_name,array('interview_id'=>$id));
		return $query->row_array();
	}
	
	function single_adminByobj_contact_phone($id)
	{
		$query = $this->db->get_where($this->table_name,array('walkin_title'=>$id));
		return $query->row_array();
	}
	
	
	function insert_record()
	{ 
		$upload_file_name='';
		if (is_uploaded_file($_FILES['file_name']['tmp_name'])) 
		{            
			$config['upload_path']   = 'uploads/';
			$config['allowed_types'] = 'jpg|png|jpeg|bmp';
			
			$config['max_size']	     = '0';
			
			$config['file_name']     = md5(uniqid(mt_rand()));
			
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('file_name'))
				{
					$data =  $this->upload->data();	
					$upload_file_name=$data['file_name'];
				}
				else
				{
					$upload_file_name='';
				}
		}
		
			$data= array(
				"walkin_title"                => $this->input->post("walkin_title"),
				"contact_name"                => $this->input->post("contact_name"),
				"contact_email"               => $this->input->post("contact_email"),
				"contact_phone"               => $this->input->post("contact_phone"),
				"job_id"                      => $this->input->post("job_id"),
				"duration"                    => $this->input->post("duration"),
				"venue"                       => $this->input->post("venue"),
				"interview_date_from"         => $this->input->post("interview_date_from"),
				"interview_time_from"         => $this->input->post("interview_time_from"),
				"interview_date_to"           => $this->input->post("interview_date_to"),
				"interview_time_to"           => $this->input->post("interview_time_to"),
				"office_latitude"             => $this->input->post("office_latitude"),
				"office_longitude"            => $this->input->post("office_longitude"),
				"int_status_id"               => "1",
				"int_status"                  => "1",
				"materials"                   => $this->input->post("materials"),
				"report_time"                 => $this->input->post("report_time"),
				"event_type"                 => $this->input->post("event_type"),
				"interview_type_id"          => $this->input->post("interview_type_id"),
				"user_id"                    => $_SESSION['vendor_session']
				);
									
		$this->db->insert($this->table_name,$data);
		$interview_id = $this->db->insert_id();
		
		if($upload_file_name!='')
	   {
			$data= array(
			"file_name"                => $upload_file_name,
			);
			$this->db->where('interview_id', $interview_id);
			$this->db->update('pms_walkins', $data);
	   }
		return $interview_id;
	}
	
	function update_record()
	{
		$upload_file_name='';
		if (is_uploaded_file($_FILES['file_name']['tmp_name'])) 
		{            
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|png|jpeg|bmp';
			
			$config['max_size']	= '0';
			
			$config['file_name'] = md5(uniqid(mt_rand()));
			
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('file_name'))
				{
					$data =  $this->upload->data();	
					$upload_file_name=$data['file_name'];
				}
				else
				{
					$upload_file_name='';
				}
		}
		
			$data = array(
				"walkin_title"                => $this->input->post("walkin_title"),
				"contact_name"                => $this->input->post("contact_name"),
				"contact_email"               => $this->input->post("contact_email"),
				"contact_phone"               => $this->input->post("contact_phone"),
				"job_id"                      => $this->input->post("job_id"),
				"duration"                    => $this->input->post("duration"),
				"venue"                       => $this->input->post("venue"),
				"interview_date_from"         => $this->input->post("interview_date_from"),
				"interview_time_from"         => $this->input->post("interview_time_from"),
				"interview_date_to"           => $this->input->post("interview_date_to"),
				"interview_time_to"           => $this->input->post("interview_time_to"),
				"office_latitude"             => $this->input->post("office_latitude"),
				"office_longitude"            => $this->input->post("office_longitude"),
				"int_status_id"               => "1",
				"int_status"                  => "1",
				"materials"                   => $this->input->post("materials"),
				"report_time"                 => $this->input->post("report_time"),
				"event_type"                 => $this->input->post("event_type"),
				"interview_type_id"                 => $this->input->post("interview_type_id"),
				"user_id"                    => $_SESSION['vendor_session']
				);

			   $this->db->where('interview_id', $this->input->post('interview_id'));
			   $this->db->update($this->table_name, $data);
			   if($upload_file_name!='')
			   {
				   $data= array(
					"file_name"                => $upload_file_name,
					);
			   		$this->db->where('interview_id', $this->input->post('interview_id'));
			   		$this->db->update('pms_walkins', $data);
			   }

		return;
	}

	function get_job_list()
	{
		$query = $this->db->query('select a.job_id, a.job_title,b.company_name from pms_jobs a inner join pms_company b on a.company_id=b.company_id order by a.job_title asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Job';
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_id] = $dropdown->job_title.' || '.$dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
	function delete_record($id)
	{
		if($id=='')return;
		$this->db->delete('pms_walkins',array('interview_id'=>$id));
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) 
		{			
			$this->db->where('interview_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
}
?>
