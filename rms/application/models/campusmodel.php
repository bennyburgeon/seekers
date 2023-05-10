<?php 
class Campusmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_campus';
		$this->upload_file_name='';
    }

	function record_count($searchterm,$univ_id)
    {
		$sql="select count(a.campus_id) as campus_id from ".$this->table_name." a inner join pms_university b on a.univ_id=b.univ_id ";
		$cond='';
		
		if($univ_id!='')
		{
			$cond.=" a.univ_id=".$univ_id;
		}
		
		if($searchterm!='')
		{
			if($cond!='')
				$cond.=" and a.campus_name like '%".$searchterm."%' ";
			else
				$cond.=" a.campus_name like '%".$searchterm."%' ";
		}
		
		if($cond!='')
		{
			$sql=$sql.' where '.$cond;
		}	
		
		$query=$this->db->query($sql);
		$row=$query->row_array();
		return $row['campus_id'];
    }

	function get_list($start,$limit,$searchterm,$sort_by,$univ_id)
    {
		$sql="select a.*,b.univ_name from ".$this->table_name." a inner join pms_university b on a.univ_id=b.univ_id ";
		$cond='';
		
		if($univ_id!='')
		{
		
			$cond.=" a.univ_id=".$univ_id;
		}
		
		if($searchterm!='')
		{
			if($cond!='')
				$cond.=" and a.campus_name like '%".$searchterm."%' ";
			else
				$cond.=" a.campus_name like '%".$searchterm."%' ";
		}
		
		if($cond!='')
		{
			$sql=$sql.' where '.$cond;
		}	
		

		
		$sql.=" order by a.campus_name ".$sort_by." limit ".$start.",".$limit;
		$query=$this->db->query($sql);
		return $query->result_array();
    }
	
	function insert_record()
    {
		$data=array(
			'campus_name'=>$this->input->post('campus_name'),
			'address'=>$this->input->post('address'),
			'univ_id'=>$this->input->post('univ_id'),
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }

	// add from university controller
	function insert_campus()
    {
		$data=array(
			'campus_name'=>$this->input->post('campus_name'),
			'univ_id'=>$this->input->post('univ_id'),
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }
		
	function update_record($id)
	{
		$data=array(
		'campus_name'=>$this->input->post('campus_name'),
		'address'=>$this->input->post('address'),
		'univ_id'=>$this->input->post('univ_id'),
		);
		
       $this->db->where('campus_id', $id);
	   $this->db->update($this->table_name, $data);
	}


	function fill_university()
	{
		$query = $this->db->query('select distinct univ_id, univ_name from pms_university order by univ_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Slect University';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_campus_list($university_id)
	{
		$query = $this->db->query('select campus_id, campus_name from pms_campus where univ_id='.$university_id.' order by campus_name');
		$dropdowns = $query->result();
		$dropDownList['']='Slect Campus';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->campus_id] = $dropdown->campus_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_campus_info($campus_id)
	{
		if($campus_id=='')return array();
		$query = $this->db->query('select a.*,b.* from pms_campus a inner join pms_university b on a.univ_id=b.univ_id where a.campus_id='.$campus_id);
		$row = $query->row_array();
		return $row;
	}

	function get_course_list($campus_id)
	{
		if($campus_id=='')return;

		$query = $this->db->query('select level_id,level_name from pms_education_level order by disp_order');
		$levels_list=array();
		$course_list=array();
		$levels_list = $query->result_array();
		foreach($levels_list as $levels => $level)
		{	
			$query = $this->db->query('select course_name,course_id from pms_courses where international=2 and level_study='.$level['level_id'].' and course_id not in (select course_id from pms_campus_courses where campus_id='.$campus_id.') order by course_name');
			$courses = $query->result_array();
			if(count($courses)>0)$course_list[$level['level_name']]=$courses;
			
		}
		return $course_list;
	}

	function get_cur_course_list($campus_id)
	{
		if($campus_id=='')return;

		$query = $this->db->query('select level_id,level_name from pms_education_level order by disp_order');
		$levels_list=array();
		$course_list=array();
		$levels_list = $query->result_array();
		foreach($levels_list as $levels => $level)
		{	
		$query = $this->db->query('select a.course_name,a.course_id from pms_courses a inner join pms_campus_courses b on a.course_id=b.course_id where a.international=2 and a.level_study='.$level['level_id'].' and b.campus_id='.$campus_id.' order by a.course_name');
			$courses = $query->result_array();
			if(count($courses)>0)$course_list[$level['level_name']]=$courses;
			
		}
		return $course_list;
	}
	
	

	function get_cur_fees_list($campus_id)
	{
		if($campus_id=='')return;
		
		$query = $this->db->query('select a.course_name,a.course_id as course_id_temp,c.* from pms_courses a inner join pms_campus_courses b on a.course_id=b.course_id left join pms_campus_courses_fees c on b.campus_id=c.campus_id and b.course_id=c.course_id where a.international=2 and b.campus_id='.$campus_id.' order by a.course_name');
		$dropdowns = $query->result_array();
		$dropDownList=array();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown['course_id_temp']] = $dropdown;
		}

		return $dropDownList;
	}
		
	function delete_records($delete_rec=array())	
	{
		if(is_array($delete_rec))
		{
			 foreach ($delete_rec as $key => $val)
 				{
					$this->db->where('campus_id', $val);
					$this->db->delete('pms_campus'); 
				}
			return true;
		}else
		{
			return false;
		}
	}
	
	
}
?>