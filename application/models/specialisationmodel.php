<?php 
class Specialisationmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_course_specialisation';
		$this->upload_file_name='';
    }

	function record_count($searchterm,$course_id)
    {
		$sql="select count(a.spcl_id) as spcl_id from ".$this->table_name." a left join pms_courses b on a.course_id=b.course_id ";
		$cond='';
		
		if($course_id!='')
		{
			$cond.=" a.course_id=".$course_id;
		}
		
		if($searchterm!='')
		{
			if($cond!='')
				$cond.=" and a.spcl_name like '%".$searchterm."%' ";
			else
				$cond.=" a.spcl_name like '%".$searchterm."%' ";
		}
		
		if($cond!='')
		{
			$sql=$sql.' where '.$cond;
		}	
		
		$query=$this->db->query($sql);
		$row=$query->row_array();
		return $row['spcl_id'];
    }

	function get_list($start,$limit,$searchterm,$sort_by,$course_id)
    {
		$sql="select a.*,b.course_name from ".$this->table_name." a left join pms_courses b on a.course_id=b.course_id ";
		$cond='';
		
		if($course_id!='')
		{
		
			$cond.=" a.course_id=".$course_id;
		}
		
		if($searchterm!='')
		{
			if($cond!='')
				$cond.=" and a.spcl_name like '%".$searchterm."%' ";
			else
				$cond.=" a.spcl_name like '%".$searchterm."%' ";
		}
		
		if($cond!='')
		{
			$sql=$sql.' where '.$cond;
		}	
		

		
		$sql.=" order by a.spcl_name ".$sort_by." limit ".$start.",".$limit;
		$query=$this->db->query($sql);
		return $query->result_array();
    }
	
	function insert_record()
    {
		$data=array(
			'spcl_name'=>$this->input->post('spcl_name'),
			'spcl_name'=>$this->input->post('spcl_name'),
			'course_id'=>$this->input->post('course_id'),
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }

	// add from course controller
	function insert_specialisation()
    {
		$data=array(
			'spcl_name'=>$this->input->post('spcl_name'),
			'course_id'=>$this->input->post('course_id'),
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }
		
	function update_record($id)
	{
		$data=array(
		'spcl_name'=>$this->input->post('spcl_name'),
		'spcl_name'=>$this->input->post('spcl_name'),
		'course_id'=>$this->input->post('course_id'),
		);
		
       $this->db->where('spcl_id', $id);
	   $this->db->update($this->table_name, $data);
	}

	function fill_course()
	{
		$query = $this->db->query('select distinct course_id, course_name from pms_courses order by course_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Slect Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_specialisation_list($course_id)
	{
		$query = $this->db->query('select spcl_id, spcl_name from pms_course_specialisation where course_id='.$course_id.' order by spcl_name');
		$dropdowns = $query->result();
		$dropDownList['']='Slect spcl_name';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->spcl_id] = $dropdown->spcl_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}


	function delete_records($delete_rec=array())	
	{
		if(is_array($delete_rec))
		{
			 foreach ($delete_rec as $key => $val)
 				{
					$this->db->where('spcl_id', $val);
					$this->db->delete('pms_course_specialisation'); 
				}
			return true;
		}else
		{
			return false;
		}
	}
	
	
}
?>