<?php 
class Stdmode extends CI_Controller {

	function Stdmode()
	{
		parent::__construct();
			  if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');
		
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
		$this->load->model('stdmodel');
		
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
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->stdmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/stdmode/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->stdmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage StudyMode';		
		$config['base_url'] = base_url().'index.php/stdmode/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('stdmode/liststdmode',$this->data);				
		$this->load->view('include/footer');
	}	
	function add()
	{	
		$data['formdata']=array(
		'mode_name'=> '',
		'mode_desc'=> ''
		);
		$data['page_head']= 'Add Study Mode';
		$this->load->model('stdmodel');
		if($this->input->post('addrec'))
		{
			$this->form_validation->set_rules('mode_name', 'Study Mode Name', 'required');
			$this->form_validation->set_rules('mode_name_dup', 'Study Mode Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				
				$id=$this->stdmodel->insert_record();
				redirect('stdmode/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata']=array(
				'mode_name'=>$this->input->post('mode_name'),
				'mode_desc'=>$this->input->post('mode_desc')
				);
		}
				$this->load->view('include/header');
				$this->load->view('stdmode/addstdmode',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$data['page_head']= 'Edit Study Mode';
			$this->db->where('mode_id', $id);
			$query=$this->db->get('pms_study_mode');
			$data['formdata']=$query->row_array();			

			$this->load->view('include/header');
			$this->load->view('stdmode/editstdmode',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Study Mode';
		if(!empty($id))
		{
			if($this->input->post('updpage'))
			{
				$this->form_validation->set_rules('mode_name', 'Study Mode Name', 'required');
				$this->form_validation->set_rules('mode_name_dup', 'Study Mode Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('stdmodel');
						$id=$this->stdmodel->update_record($id);
						redirect('stdmode/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'mode_id'=>$id,
						'mode_name'=>$this->input->post('mode_name'),
						'mode_desc'=>$this->input->post('mode_desc')
						);
	
						$this->load->view('include/header');
						$this->load->view('stdmode/editstdmode',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('country');
			}			
		}else
		{
			redirect('country');
		}
	}
	
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id))
		{
			$this->db->where('mode_id', $id);
			$this->db->delete('pms_study_mode'); 
			redirect('stdmode/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('mode_id', $val);
					$this->db->delete('pms_study_mode'); 
				}
			redirect('stdmode/?rows='.$rows.'&del=1');
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
			$this->load->model('stdmodel');
			$this->stdmodel->delete_multiple_record($id_arr);
			redirect('stdmode/?rows='.$rows.'&del=1');
		}
		else{
			redirect('branch');
		}
	}
	function check_dups()
	{
	
		$this->db->where('mode_name', $this->input->post('mode_name'));
		if($this->input->get('id') > 0)	$this->db->where('mode_id !=', $this->input->get('id'));
		$query = $this->db->get('pms_study_mode');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'That name already used.');
			return false;
		}
	}

}
?>
