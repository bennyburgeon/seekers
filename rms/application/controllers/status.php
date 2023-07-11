<?php 
class Status extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');

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
		$limit=5;
		}
		$rows='';
		$this->load->model('statusmodel');
		
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
		$this->data['total_rows']= $this->statusmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/status/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->statusmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["limit"]=$limit;
		
		$this->load->model('statusmodel');
		$this->data['page_head']= 'Manage Status';		
		$config['base_url'] = base_url().'index.php/status/?';	
		  
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->load->view('include/header');
		$this->load->view('status/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('status');
		if($this->input->get('stat')=='')redirect('status');
		$this->db->query("update pms_process_status set status=".$this->input->get('stat')." where status_id=".$id);
		redirect('status?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'status_name'=> '',	
		'status'=> '',
		'icon_file_name'=> '',
		'icon_inactive' => '',
		'status_order'=> '',
		);
		
		$this->load->model('statusmodel');
		
		if($this->input->post('status_name'))
		{
			$this->form_validation->set_rules('status_name', 'Status Name', 'required');
			$this->form_validation->set_rules('check_dups', 'Status Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$id=$this->statusmodel->insert_record();
				redirect('status/?ins=1');
			}
				$this->data['formdata']=array(
				'status_name'=> $this->input->post('status_name'),				
				'status'=> $this->input->post('status'),
				'icon_file_name'=> $this->input->post('icon_file_name'),
				'status_order'=> $this->input->post('status_order'),
				'icon_inactive'=> $this->input->post('icon_inactive')

				);				
			}
				$this->data['page_head']= 'Add Status';
				
				$this->load->view('include/header');
				$this->load->view('status/add',$this->data);	
				$this->load->view('include/footer');
	}

	//exit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'status_name'=> '',		
		'status' => '',
		'icon_file_name'=> '',
		'icon_inactive' => '',
		'status_order'=> '',

		);
		
		
		if(!empty($id))
		{
			$this->load->model('statusmodel');	

		
			$data['page_head']= 'Edit Status';
			
			$query=$this->db->query("select * from pms_process_status where status_id=".$id);
			$data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('status/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Status';
		
			if($this->input->post('status_name'))
			{
				$this->load->model('statusmodel');	
		
				$this->form_validation->set_rules('status_name', 'Status Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Status Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$this->load->model('statusmodel');
					$id=$this->statusmodel->update_record($this->input->post('status_id'));
					redirect('status/?upd=1');
				}

				$data['formdata']=array(
				'status_id'=> $this->input->post('status_id'),
				'status_name'=> $this->input->post('status_name'),
				'status'=> $this->input->post('status'),
				'icon_file_name'=> $this->input->post('icon_file_name'),
				'status_order'=> $this->input->post('status_order'),
				'icon_inactive'=> $this->input->post('icon_inactive')
				);				
               $query=$this->db->query("select * from pms_process_status where status_id=".$this->input->post('status_id'));
			   $data['formdata']=$query->row_array();
				$this->load->view('include/header');
				$this->load->view('status/edit',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('status');
			}			
	}

	function check_dups()
	{
		$this->db->where('status_name', $this->input->post('status_name'));
		if($this->input->post('status_id') > 0)	$this->db->where('status_id !=', $this->input->post('status_id'));
		$query = $this->db->get('pms_process_status');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Status name already used, pelase change');
			return false;
		}
	}	

	
	function delete($id=null)
	{
		
		$this->load->model('statusmodel');
		if(!empty($id))
		{
			$id=$this->statusmodel->delete($id);
			redirect('status/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{ 
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->statusmodel->delete($val);
				}
			redirect('status/?del=1');
		}else
		{
			redirect('status');
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
			$this->load->model('statusmodel');
			$this->statusmodel->delete_multiple_record($id_arr);
			redirect('status/?multi=1');
		}
		else{
			redirect('status');
		}
	}
}
?>
