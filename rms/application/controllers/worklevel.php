<?php 
class Worklevel extends CI_Controller {

	function worklevel()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	
	}

	function index($offset = 0)
	{$this->load->library('pagination');
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
		$this->load->model('worklevelmodel');
		
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
		$this->data['total_rows']= $this->worklevelmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/worklevel/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->worklevelmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage Worklevel';		
		$config['base_url'] = base_url().'index.php/worklevel/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('worklevel/listworklevel',$this->data);				
		$this->load->view('include/footer');		
	}
	
	function add()
	{	
		$data['formdata']=array(
		'work_level'=> ''
		);
		$this->load->model('worklevelmodel');		
		if($this->input->post('addrec'))
		{
			$this->form_validation->set_rules('work_level', 'Work Level name', 'required');
			$this->form_validation->set_rules('cert_dup', 'Work Level name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->worklevelmodel->insert_record();
				redirect('worklevel/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'work_level'=>$this->input->post('work_level')
				);
		}
				$data['page_head']= 'Add work level';
				$this->load->view('include/header');
				$this->load->view('worklevel/addworklevel',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('worklevelmodel');

			$data['page_head']= 'Edit work level';
			$this->db->where('work_level_id', $id);
			$query=$this->db->get('pms_job_work_level');
			$data['formdata']=$query->row_array();
			$data['page_head']= 'Edit work level';
			$this->load->view('include/header');
			$this->load->view('worklevel/editworklevel',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit work level';
		$this->load->model('worklevelmodel');
		if(!empty($id))
		{
			if($this->input->post('updpage'))
			{
				$this->form_validation->set_rules('work_level', 'Work Level name', 'required');
				$this->form_validation->set_rules('cert_dup', 'Work Level name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->worklevelmodel->update_record($id);
						redirect('worklevel/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'work_level_id'=>$id,
						'work_level'=>$this->input->post('work_level')
						);
				        $data['page_head']= 'Edit work level';
						$this->load->view('include/header');
						$this->load->view('worklevel/editworklevel',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('worklevel');
			}			
		}else
		{
			redirect('worklevel');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('work_level_id', $id);
			$this->db->delete('pms_job_work_level'); 
			redirect('worklevel/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('work_level_id', $val);
					$this->db->delete('pms_job_work_level'); 
				}
			redirect('worklevel/?del=1');
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
			$this->load->model('worklevelmodel');
			$this->worklevelmodel->delete_multiple_record($id_arr);
			redirect('worklevel/?multi=1');
		}
		else{
			redirect('branch');
		}
	}
	function check_dups()
	{
		$this->db->where('work_level', $this->input->post('work_level'));
		if($this->input->post('work_level_id') > 0)	$this->db->where('work_level_id !=', $this->input->post('work_level_id'));
		$query = $this->db->get('pms_job_work_level');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Work Level name already used.');
			return false;
		}
	}
}
?>
