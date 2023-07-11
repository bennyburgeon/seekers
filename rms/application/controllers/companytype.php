<?php 
class Companytype extends CI_Controller {

	function companytype()
	{
		parent::__construct();
		$user = $this->session->userdata('User');		
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		
	}
	
	/*function index($offset = 0)
	{	
		$this->load->model('companytypemodel');
		
		$this->data['total_rows']= $this->companytypemodel->record_count();
		$this->data['page_head']= 'Manage Company Type';
		
		$config['base_url'] = base_url().'index.php/companytype/?';
		$config['total_rows'] = $this->data['total_rows'];		
		$this->pagination->initialize($config);
		
		if($this->input->get('per_page') > 0) $offset=$this->input->get('per_page');
		
		//$this->db->limit();
		$this->data['records']=$this->companytypemodel->get_list();

  	    $this->data['pagination'] = $this->pagination->create_links();

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('common/header');
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view('companytype/ctypelist',$this->data);				
		$this->load->view('common/footer');		
	}*/
	
	function index()
	{	$this->load->library('pagination');
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
		$this->load->model('companytypemodel');
		
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
		$this->data['total_rows']= $this->companytypemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/companytype/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->companytypemodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage All Company Types';
				
				
		$this->load->view('include/header');
		$this->load->view('companytype/ctypelist',$this->data);				
		$this->load->view('include/footer');

		
	}	

	
	
	
	function add()
	{	
		$this->data['formdata']=array(
		'type_name'=> '',
		'type_desc'=> ''
		);
		
		$this->data['page_head']= 'Add Company Type';
		$this->load->model('companytypemodel');
		
		if($this->input->post('type_name'))
		{
			$this->form_validation->set_rules('type_name', 'Company Type Name', 'required');
			$this->form_validation->set_rules('type_name_dup', 'Company Type Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->companytypemodel->insert_record();
				redirect('companytype/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'type_name'=>$this->input->post('type_name'),
				'type_desc'=>$this->input->post('type_desc')
				);
		}

		$this->load->view('include/header');
		$this->load->view('companytype/addctype',$this->data);				
		$this->load->view('include/footer');
		
	}

	// edxit and update pages here 	
	
	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Company Type';			
			$this->db->where('type_id', $id);
			$query=$this->db->get('pms_company_type');
			$this->data['formdata']=$query->row_array();			

			$this->load->view('include/header');
			$this->load->view('companytype/editctype',$this->data);				
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
	
	$id = $this->input->post('type_id'); 
	$this->data['page_head']= 'Edit Company Type';
			if($this->input->post('type_name'))
			{ 
				$this->form_validation->set_rules('type_name', 'Company Type Name', 'required');
				$this->form_validation->set_rules('type_name_dup', 'Company Type Name', 'callback_check_dups');
				
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('companytypemodel');
						$id=$this->companytypemodel->update_record($id);
						redirect('companytype/?update=1');
					}else{
						// load page again for validation
						$this->data['formdata']=array(
						'type_id'=>$id,
						'type_name'=>$this->input->post('type_name'),
						'type_desc'=>$this->input->post('type_desc')
						);
	
						$this->load->view('include/header');
						$this->load->view('companytype/editctype',$this->data);				
						$this->load->view('include/footer');
					}
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
			$this->db->where('type_id', $id);
			$this->db->delete('pms_company_type'); 
			redirect('companytype/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('type_id', $val);
					$this->db->delete('pms_company_type'); 
				}
			redirect('companytype/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
	
		$this->db->where('type_name', $this->input->post('type_name'));
		if($this->input->post('type_id') > 0)	$this->db->where('type_id !=', $this->input->post('type_id'));
		$query = $this->db->get('pms_company_type');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'That name already used.');
			return false;
		}
	}

}
?>
