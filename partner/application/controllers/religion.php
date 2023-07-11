<?php 
class Religion extends CI_Controller {

	function religion()
	{
		parent::__construct();
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
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
		$this->load->model('religionmodel');
		
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
		$this->data['total_rows']= $this->religionmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."religion/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->religionmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->data['page_head']= 'Manage Religion';	

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('religion/listreligion',$this->data);				
		$this->load->view('include/footer');		
	}
	
	function add()
	{	
		$data['formdata']=array(
		'rel_name'=> ''
		);
		$this->load->model('religionmodel');		
		if($this->input->post('rel_name'))
		{
			$this->form_validation->set_rules('rel_name', 'Religion name', 'required');
			$this->form_validation->set_rules('cert_dup', 'Religion name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->religionmodel->insert_record();
				redirect('religion/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata']=array(
				'rel_name'=>$this->input->post('rel_name')
				);
		}
				$data['page_head']= 'Add religion name';
				$this->load->view('include/header');
				$this->load->view('religion/addreligion',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('religionmodel');

			$data['page_head']= 'Edit religion name';
			$this->db->where('rel_id', $id);
			$query=$this->db->get('pms_religion');
			$data['formdata']=$query->row_array();

			$this->load->view('include/header');
			$this->load->view('religion/editreligion',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit religion name';
		$this->load->model('religionmodel');
		$id=$this->input->post('rel_id');
		if(!empty($id))
		{
			if($this->input->post('rel_name'))
			{
				$this->form_validation->set_rules('rel_name', 'Religion name', 'required');
				$this->form_validation->set_rules('cert_dup', 'Religion name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->religionmodel->update_record($id);
						redirect('religion/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'rel_id'=>$id,
						'rel_name'=>$this->input->post('rel_name')
						);
						
						$this->load->view('include/header');
						$this->load->view('religion/editreligion',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('religion');
			}			
		}else
		{
			redirect('religion');
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
			$this->db->where('rel_id', $id);
			$this->db->delete('pms_religion'); 
			redirect('religion/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('rel_id', $val);
					$this->db->delete('pms_religion'); 
				}
			redirect('religion/?rows='.$rows.'&del=1');
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
			$this->load->model('religionmodel');
			$this->religionmodel->delete_multiple_record($id_arr);
			redirect('religion/?rows='.$rows.'&del=1');
		}
		else{
			redirect('branch');
		}
	}
	function check_dups()
	{
		$this->db->where('rel_name', $this->input->post('rel_name'));
		if($this->input->post('rel_id') > 0)	$this->db->where('rel_id !=', $this->input->post('rel_id'));
		$query = $this->db->get('pms_religion');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Religion name already used.');
			return false;
		}
	}
}
?>
