<?php 
class Jobfolder extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
			   $this->data['page']=array("admin","admingroup","jobarea","courses","salary","industry","specialisation","visatype","country","state","languages","city","jobfolder","worklevel");
	
	}
	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
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
		 	 $limit=15;
		 }
		$rows='';
		$this->load->model('jobfoldermodel');
		
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
		
		if(isset($_GET['searchterm']))
		{
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->jobfoldermodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."jobfolder/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->jobfoldermodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage Folders';		
		$config['base_url'] = base_url().'jobfolder/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('jobfolder/list',$this->data);				
		$this->load->view('include/footer',$this->data);		
	}	
	function add()
	{	
		$data['formdata']=array(
		'job_folder_name'=> '',
		);
		$this->load->model('jobfoldermodel');		
		if($this->input->post('job_folder_name'))
		{
			$this->form_validation->set_rules('job_folder_name', 'Folder Name', 'required');
			$this->form_validation->set_rules('job_folder_name_dup', 'Folder Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->jobfoldermodel->insert_record();
				redirect('jobfolder/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'job_folder_name'=>$this->input->post('job_folder_name'),
				);
		}
		$data['page_head']= 'Add Folder Name';
		$this->load->view('include/header',$this->data);
		$this->load->view('jobfolder/add',$data);	
		$this->load->view('include/footer',$this->data);
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('jobfoldermodel');

			$data['page_head']= 'Edit Folder Name';
			$this->db->where('job_folder_id', $id);
			$query=$this->db->get('pms_job_folder');
			$data['formdata']=$query->row_array();
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	

			$this->load->view('include/header',$this->data);
			$this->load->view('jobfolder/edit',$data);	
			$this->load->view('include/footer',$this->data);
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Folder Name';
		$this->load->model('jobfoldermodel');
		$id=$this->input->post('job_folder_id');
		if(!empty($id))
		{
			if($this->input->post('job_folder_name'))
			{
				
				$this->form_validation->set_rules('job_folder_name', 'Folder Name Name', 'required');
				$this->form_validation->set_rules('job_folder_name_dup', 'Folder Name Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->jobfoldermodel->update_record($id);
						redirect('jobfolder/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'job_folder_id'=>$id,
						'job_folder_name'=>$this->input->post('job_folder_name'),
						);

						$this->load->view('include/header',$this->data);
						$this->load->view('jobfolder/edit',$data);	
						$this->load->view('include/footer',$this->data);
					}
			}else
			{
				redirect('languages');
			}			
		}else
		{
			redirect('languages');
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
			$this->db->where('job_folder_id', $id);
			$this->db->delete('pms_job_folder'); 
			redirect('jobfolder/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('job_folder_id', $val);
					$this->db->delete('pms_job_folder'); 
				}
			redirect('jobfolder/?rows='.$rows.'&del=1');
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
			$this->load->model('jobfoldermodel');
			$this->jobfoldermodel->delete_multiple_record($id_arr);
			redirect('jobfolder/?rows='.$rows.'&del=1');
		}
		else{
			redirect('languages');
		}
	}
	function check_dups()
	{
		$this->db->where('job_folder_name', $this->input->post('job_folder_name'));
		if($this->input->post('job_folder_id') > 0)	$this->db->where('job_folder_id !=', $this->input->post('job_folder_id'));
		$query = $this->db->get('pms_job_folder');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Folder name already used.');
			return false;
		}
	}
}
?>
