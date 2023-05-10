<?php 
class Level extends CI_Controller {

	function Level()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
			  $this->data['cur_page']=$this->router->class;
		
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
		$this->load->model('levelmodel');
		
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
		$this->data['total_rows']= $this->levelmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		
		$config['base_url'] = $this->config->item('base_url')."index.php/level/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->levelmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('level/levellist',$this->data);				
		$this->load->view('include/footer',$this->data);
	}	
	function add()
	{	
		$data['formdata']=array(
		'level_name'=> '',
		'level_status'=> ''
		);
		$this->load->model('levelmodel');		
		if($this->input->post('addrec'))
		{
			$this->form_validation->set_rules('level_name', 'level name', 'required');
			$this->form_validation->set_rules('level_name_dup', 'level name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->levelmodel->insert_record();
				redirect('level/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'level_name'=>$this->input->post('level_name'),
				'level_status'=>$this->input->post('level_status')
				);
		}
				$this->data['page_head']= 'Add Level';
				$this->load->view('include/header',$this->data);
				$this->load->view('level/addlevel',$data);	
				$this->load->view('include/footer',$this->data);
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$data['page_head']= 'Edit Level';
			$this->db->where('level_id', $id);
			$query=$this->db->get('pms_education_level');
			$data['formdata']=$query->row_array();			

			$this->load->view('include/header',$this->data);
			$this->load->view('level/editlevel',$data);	
			$this->load->view('include/footer',$this->data);
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Level';
		if(!empty($id))
		{
			if($this->input->post('updpage'))
			{
				$this->form_validation->set_rules('level_name', 'Level Name', 'required');
				$this->form_validation->set_rules('level_name_dup', 'Level Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('levelmodel');
						$id=$this->levelmodel->update_record($id);
						redirect('level/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'level_id'=>$id,
						'level_name'=>$this->input->post('level_name'),
						'level_status'=>$this->input->post('level_status')
						);
						$this->load->view('include/header',$this->data);
						$this->load->view('level/editlevel',$data);	
						$this->load->view('include/footer',$this->data);
					}
			}else
			{
				redirect('level');
			}			
		}else
		{
			redirect('level');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('level_id', $id);
			$this->db->delete('pms_education_level'); 
			redirect('level/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('level_id', $val);
					$this->db->delete('pms_education_level'); 
				}
			redirect('level/?del=1');
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
			$this->load->model('levelmodel');
			$this->levelmodel->delete_multiple_record($id_arr);
			redirect('level/?multi=1');
		}
		else{
			redirect('level');
		}
	}
	function check_dups()
	{
		$this->db->where('level_name', $this->input->post('level_name'));
		if($this->input->post('level_id') > 0)	$this->db->where('level_id !=', $this->input->post('level_id'));
		$query = $this->db->get('pms_education_level');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Level name already used.');
			return false;
		}
	}
}
?>
