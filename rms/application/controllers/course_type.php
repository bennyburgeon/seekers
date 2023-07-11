<?php 
class Course_type extends CI_Controller {

	function Level()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	
	}
	
	function index($offset = 0)
	{	
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=5;
		}
		$rows='';
		$this->load->model('coursetypemodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->coursetypemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/course_type/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
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
		
		// paging ends here
		$this->data["records"] = $this->coursetypemodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('coursetype/coursetypelist',$this->data);				
		$this->load->view('include/footer');
	}	
	function add()
	{	
		$data['formdata']=array(
		'course_type'=> ''
		);
		$this->load->model('coursetypemodel');		
		if($this->input->post('course_type'))
		{
			$this->form_validation->set_rules('course_type', 'Course Type', 'required');
			$this->form_validation->set_rules('check_dups', 'level name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{			
				$id=$this->coursetypemodel->insert_record();
				redirect('course_type/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'course_type'=>$this->input->post('course_type'),
				);
		}
				$this->data['page_head']= 'Add Course Type';
				$this->load->view('include/header');
				$this->load->view('coursetype/addcoursetype',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$data['page_head']= 'Edit Course Type';
			$this->db->where('course_type_id', $id);
			$query=$this->db->get('pms_course_type');
			$data['formdata']=$query->row_array();			

			$this->load->view('include/header');
			$this->load->view('coursetype/editcoursetype',$data);	
			$this->load->view('include/footer');
		}
	}

	function update()
	{
		$id=$this->input->post('course_type_id');
		$data['page_head']= 'Edit Course Type';
		if(!empty($id))
		{
			if($this->input->post('course_type'))
			{
				$this->form_validation->set_rules('course_type', 'Course Type', 'required');
			$this->form_validation->set_rules('check_dups', 'level name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('coursetypemodel');
						$id=$this->coursetypemodel->update_record($id);
						redirect('course_type/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'course_type_id'=>$this->input->post('course_type_id'),
						'course_type'=>$this->input->post('course_type'),
						);
						$this->load->view('include/header');
						$this->load->view('coursetype/editcoursetype',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('course_type');
			}			
		}else
		{
			redirect('course_type');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('course_type_id', $id);
			$this->db->delete('pms_course_type'); 
			redirect('course_type/?del=1');
		}else{
			redirect('course_type');
		}
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
            $this->load->model('coursetypemodel');
			$this->coursetypemodel->delete_multiple_record($id_arr);
			redirect('course_type/?multi=1');
		}
		else{
			redirect('course_type');
		}
	}
	function check_dups()
	{
		$this->db->where('course_type', $this->input->post('course_type'));
		if($this->input->post('course_type_id') > 0)	$this->db->where('course_type_id !=', $this->input->post('course_type_id'));
		$query = $this->db->get('pms_course_type');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Course type already used.');
			return false;
		}
	}
}
?>
