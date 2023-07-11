<?php class Skill_based_placements extends CI_Controller {

	function Skill_based_placements()
	{
		parent::__construct();
		$this->load->library('csvimport');
	  	if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		if(!isset($_SESSION['reg_status']) || $_SESSION['reg_status']=='')$_SESSION['reg_status']=1;
		
	}
	

	
	function index()
	{	
	
		$this->load->library('pagination');
		$this->data['limit']='';
		
		$this->data['start']=0;
		$this->data['skills']='';
		$this->data['rows']='';
		$this->load->model('candidateallmodel');
		
		 

		if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =100;
		}

		if($this->input->get('sort_by')!='')
		{
			$this->data['sort_by']=$this->input->get("sort_by");
		}
		else
		{
			$this->data['sort_by'] = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['rows']=$this->input->get("rows");
		}
		
		
		if($this->input->get('skills'))
		{
			
			
			$this->data['skills']	=	$this->input->get('skills');
		}	
		
		if($this->input->post('skills'))
		{

			$this->data['skills']	=	$this->input->post('skills');
		}

		$this->data['total_rows']= $this->candidateallmodel->placement_count($this->data['skills']);
		$this->data['cur_page']=$this->router->class;
		
		
		
		$config['base_url'] = $this->config->item('base_url')."skill_based_placements/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&skills=".$this->data["skills"];
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data['limit'];
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$this->data['pagination']=$this->pagination->create_links();
	
		$this->data["records"] = $this->candidateallmodel->get_placement_result($this->data['start'],$this->data['limit'],$this->data['sort_by'],$this->data['skills']);

		$this->load->model('candidateallmodel'); 
		
		$this->data['page_head']= 'Skill Based Placements';		
		$this->data['formdata']=array('admin_id' =>'');
		$this->data['admin_users_lists']= $this->candidateallmodel->get_admin_users_lists();
		
		
// Technical Skilss

		
		$this->data['skill_list']=$this->candidateallmodel->get_parent_skills();
		
		$skills=array();
		
		if(!empty($this->data['skills']))
		{
			$this->data['skills']	=	explode(',',$this->data['skills']);
		}
		else{
				$this->data['skills']	= array();
			}
		
		foreach($this->data['skills'] as $skill)
		{
			$skills[]=$skill;
		}
		$this->data['candidate_skills']	=	$skills;

		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
		$qry	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$skill);
		$this->data['res']	= $res	=	$qry->result_array();
		
		$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
		$this->data['res1']	= $res1 =	$qry1->result_array();
		
		$this->data['child_skills']	=	$this->candidateallmodel->get_child_skills($res1[0]['skill_id']);
		}

		
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates_all/skill_placements',$this->data);				
		$this->load->view('include/footer',$this->data);
	
	}
		
	
}

