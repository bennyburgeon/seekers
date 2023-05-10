<?php 
class Account_module extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
			   $this->data['page']=array("admin","admingroup","jobarea","courses","salary","industry","specialisation","visatype","country","state","languages","city","account_module","worklevel");
	
	}
	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor Account 
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
		$account_type_id='';
		
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=15;
		 }
		$rows='';
		$this->load->model('account_modulemodel');
		
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
		
		
		if($this->input->get("account_type_id")!='')
		{
			$account_type_id=$this->input->get("account_type_id");
		}
		
		if($this->input->post("account_type_id")!='')
		{
			$account_type_id=$this->input->post("account_type_id");
		}
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		
		if(isset($_GET['searchterm']))
		{
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->account_modulemodel->record_count($searchterm, $account_type_id);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."account_module/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str&account_type_id=".$account_type_id;
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
		$this->data["records"] = $this->account_modulemodel->get_list($start,$limit,$searchterm,$sort_by,$account_type_id);
		$this->data["acc_type_list"] = $this->account_modulemodel->get_account_type();	
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["account_type_id"]=$account_type_id;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage Accounts';		
		$config['base_url'] = base_url().'account_module/?';

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('account_module/list',$this->data);				
		$this->load->view('include/footer',$this->data);		
	}	
	function add()
	{	
		$data['formdata']=array(
		'account_code'=> '',
		'account_name'=> '',
		'account_type_id'=> '',
		);
		$this->load->model('account_modulemodel');	
		$this->data["acc_type_list"] = $this->account_modulemodel->get_account_type();	
		if($this->input->post('account_name'))
		{
			$this->form_validation->set_rules('account_name', 'Account Name', 'required');
			$this->form_validation->set_rules('job_folder_name_dup', 'Account Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->account_modulemodel->insert_record();
				redirect('account_module/?ins=1');
			}
				// load page again for validation
				$this->data["acc_type_list"]=$this->account_modulemodel->get_account_type($this->input->post('account_type_id'));
				$data['formdata']=array(
				'account_code'=>$this->input->post('account_code'),
				'account_name'=>$this->input->post('account_name'),
				'account_type_id'=>$this->input->post('account_type_id')
				);
		}
		$data['page_head']= 'Add Account Name';
		$this->load->view('include/header',$this->data);
		$this->load->view('account_module/add',$data);	
		$this->load->view('include/footer',$this->data);
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('account_modulemodel');

			$data['page_head']= 'Edit Account Name';
			$this->db->where('account_id', $id);
			$query=$this->db->get('pms_accounts');
			$data['formdata']=$query->row_array();
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	
			$this->data["acc_type_list"] = $this->account_modulemodel->get_account_type();	
			

			$this->load->view('include/header',$this->data);
			$this->load->view('account_module/edit',$data);	
			$this->load->view('include/footer',$this->data);
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Account';
		$this->load->model('account_modulemodel');
		$id=$this->input->post('account_id');
		$this->data["acc_type_list"] = $this->account_modulemodel->get_account_type();	
		if(!empty($id))
		{
			if($this->input->post('account_name') && $this->input->post('account_name'))
			{
				
				$this->form_validation->set_rules('account_name', 'Account Name Name', 'required');
				$this->form_validation->set_rules('job_folder_name_dup', 'Account Name Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->account_modulemodel->update_record($id);
						redirect('account_module/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'account_id'=>$id,
						'account_code'=>$this->input->post('account_code'),
						'account_name'=>$this->input->post('account_name'),
						'account_type_id'=>$this->input->post('account_type_id'),
						
						);

						$this->load->view('include/header',$this->data);
						$this->load->view('account_module/edit',$data);	
						$this->load->view('include/footer',$this->data);
					}
			}else
			{
				redirect('account_module');
			}			
		}else
		{
			redirect('account_module');
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
			$this->db->where('account_id', $id);
			$this->db->delete('pms_accounts'); 
			redirect('account_module/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('account_id', $val);
					$this->db->delete('pms_accounts'); 
				}
			redirect('account_module/?rows='.$rows.'&del=1');
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
			$this->load->model('account_modulemodel');
			$this->account_modulemodel->delete_multiple_record($id_arr);
			redirect('account_module/?rows='.$rows.'&del=1');
		}
		else{
			redirect('account_module');
		}
	}
	function check_dups()
	{
		$this->db->where('account_name', $this->input->post('account_name'));
		$this->db->where('account_type_id =', $this->input->post('account_type_id'));
		if($this->input->post('account_id') > 0)	$this->db->where('account_id !=', $this->input->post('account_id'));
		$query = $this->db->get('pms_accounts');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Account name already used.');
			return false;
		}
	}
	
}
?>
