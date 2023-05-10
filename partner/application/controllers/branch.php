<?php 
class Branch extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');

	}
	
	function index()
	{
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=15;
		 }
		$rows='';
		$this->load->model('branchmodel');
		
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
		$this->data['total_rows']= $this->branchmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."branch/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->branchmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage Branch';		
		$config['base_url'] = base_url().'branch/?';	
		  
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->load->view('include/header');
		$this->load->view('branch/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('branch');
		if($this->input->get('stat')=='')redirect('branch');
		$this->db->query("update pms_branch set status=".$this->input->get('stat')." where branch_id=".$id);
		redirect('branch?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'branch_name'=> '',
		'branch_code'=> '',
		'status'=> '1',
		);
		
		$this->load->model('branchmodel');		

		
		if($this->input->post('branch_name'))
		{
			$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
			$this->form_validation->set_rules('branch_code', 'Branch Code', 'required');
			$this->form_validation->set_rules('check_dups', 'Branch Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$id=$this->branchmodel->insert_record();
				redirect('branch/?ins=1');
			}
				$this->data['formdata']=array(
				'branch_name'=> $this->input->post('branch_name'),
				
				'status'=> $this->input->post('status'),
				);				
			}
				$this->data['page_head']= 'Add Branch';
				
				$this->load->view('include/header');
				$this->load->view('branch/add',$this->data);	
				$this->load->view('include/footer');
	}

	//exit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'branch_name'=> '',
		'branch_code'=> '',
		'status' => '1'
		);
		
		
		if(!empty($id))
		{
			$this->load->model('branchmodel');	

		
			$data['page_head']= 'Edit Branch';
			
			$query=$this->db->query("select * from pms_branch where branch_id=".$id);
			$data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('branch/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Branch';
		
			if($this->input->post('branch_id'))
			{
				$this->load->model('branchmodel');	
		
				$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Branch Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('branchmodel');
					$id=$this->branchmodel->update_record($id);
					redirect('branch/?update=1');
				}

				$data['formdata']=array(
				'branch_id'=> $this->input->post('branch_id'),
				'branch_name'=> $this->input->post('branch_name'),
				'branch_code'=> $this->input->post('branch_code'),
				'sort_order'=> $this->input->post('sort_order'),
				'status'=> $this->input->post('status')
				);				
				
				$query=$this->db->query("select * from pms_branch where branch_id=".$this->input->post('branch_id'));
				$data['formdata']=$query->row_array();
				$this->load->view('include/header');
				$this->load->view('branch/edit',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('branch');
			}			
	}

	function check_dups()
	{
		$this->db->where('branch_name', $this->input->post('branch_name'));
		$this->db->where('branch_code', $this->input->post('branch_code'));
		if($this->input->post('branch_id') > 0)	$this->db->where('branch_id !=', $this->input->post('branch_id'));
		$query = $this->db->get('pms_branch');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Branch name already used, pelase change');
			return false;
		}
	}	

	
	function delete($id=null)
	{
		
		$this->load->model('branchmodel');
		if(!empty($id))
		{
			$id=$this->branchmodel->delete($id);
			redirect('branch/?del='.$id);
		}elseif(is_array($this->input->post('delete_rec')))
		{ 
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->branchmodel->delete($val);
				}
			redirect('branch/?del='.$id);
		}else
		{
			redirect('branch');
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
			$this->load->model('branchmodel');
			$this->branchmodel->delete_multiple_record($id_arr);
			redirect('branch/?rows='.$rows.'&del=1');
		}
		else{
			redirect('branch');
		}
	}
}
?>
