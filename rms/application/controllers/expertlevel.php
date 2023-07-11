<?php 
class Expertlevel extends CI_Controller {

	function expertlevel()
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
		$this->load->model('expertmodel');
		
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
		$this->data['total_rows']= $this->expertmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/expertlevel/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->expertmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('expertmodel'); 
		
		$this->data['page_head']= 'Manage expertlevel';		
		$config['base_url'] = base_url().'index.php/expertlevel/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('expertlevel/expertlist',$this->data);				
		$this->load->view('include/footer');		
	}	
	function add()
	{	
		$data['formdata']=array(
		'exp_level'=> '',
		'exp_level_from'=> ''
		);
		$this->load->model('expertmodel');		
		if($this->input->post('addrec'))
		{
			$this->form_validation->set_rules('exp_level', 'job expert level', 'required');
			$this->form_validation->set_rules('jobexpert_name_dup', 'job expert level', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->expertmodel->insert_record();
				redirect('expertlevel/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'exp_level'=>$this->input->post('exp_level'),
				'exp_level_from'=>$this->input->post('exp_level_from')
				);
		}
				$data['page_head']= 'Add Expert Level';
				$this->load->view('include/header');
				$this->load->view('expertlevel/addexpert',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('expertmodel');

			$data['page_head']= 'Edit Expert Level';
			$this->db->where('exp_level_id', $id);
			$query=$this->db->get('pms_job_exp_level');
			$data['formdata']=$query->row_array();

			$this->load->view('include/header');
			$this->load->view('expertlevel/editexpert',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Expert Level';
		$this->load->model('expertmodel');
		if(!empty($id))
		{
			if($this->input->post('updpage'))
			{
				
				$this->form_validation->set_rules('exp_level', 'Expert Level Name', 'required');
				$this->form_validation->set_rules('expert_name_dup', 'Expert Level Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->expertmodel->update_record($id);
						redirect('expertlevel/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'exp_level_id'=>$id,
						'exp_level'=>$this->input->post('exp_level'),
						'exp_level_from'=>$this->input->post('exp_level_from')
						);
						
						$this->load->view('include/header');
						$this->load->view('expertlevel/editexpert',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('expertlevel');
			}			
		}else
		{
			redirect('expertlevel');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('exp_level_id', $id);
			$this->db->delete('pms_job_exp_level'); 
			redirect('expertlevel/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
				
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('exp_level_id', $val);
					$this->db->delete('pms_job_exp_level'); 
				}
			redirect('expertlevel/?del=1');
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
			$this->load->model('expertmodel');
			$this->expertmodel->delete_multiple_record($id_arr);
			redirect('expertlevel/?multi=1');
		}
		else{
			redirect('branch');
		}
	}
	
	function check_dups()
	{
		$this->db->where('exp_level', $this->input->post('exp_level'));
		if($this->input->post('exp_level_id') > 0)	$this->db->where('exp_level_id !=', $this->input->post('exp_level_id'));
		$query = $this->db->get('pms_job_exp_level');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Expert Level name already used.');
			return false;
		}
	}

}
?>
