<?php 
class Attend extends CI_Controller {

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
		$this->load->model('attend_model');
		
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
		$this->data['total_rows']= $this->attend_model->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."attend/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->attend_model->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('attend_model'); 
		
		$this->data['page_head']= 'Manage Leave';		
		$config['base_url'] = base_url().'attend/?';	
		
		$this->data['approved_by']=$this->attend_model->get_all_admins();
		
		  
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->load->view('include/header');
		$this->load->view('attend/list',$this->data);				
		$this->load->view('include/footer');
	}	

	function changestat($id=null)
	{
		if($id=='')redirect('attend');
		if($this->input->get('stat')=='')redirect('attend');
		$this->db->query("update pms_branch set status=".$this->input->get('stat')." where branch_id=".$id);
		redirect('attend?stat=1');
	}

	function add()
	{	
		$this->data['formdata']=array(
		'admin_id'=> '',
		'date'=> '',
		'time_in'=> '',
		'leave_type'=> '',
		'session_type'=> '',
		'leave_status'=> '',
		'approved_by'=> ''
		);
		
		$this->load->model('attend_model');		

		
		if($this->input->post('name'))
		{ 
			 
				
				$id=$this->attend_model->insert_record();
				redirect('attend/?ins=1');
		
				$this->data['formdata']=array(
				'branch_name'=> $this->input->post('branch_name'),
				
				'status'=> $this->input->post('status'),
				);				
		}
				$this->data['page_head']= 'Add Leave';
				//call model to show all admins
				$this->data['admins']=$this->attend_model->get_all_admins();
				$this->load->view('include/header');
				$this->load->view('attend/add',$this->data);	
				$this->load->view('include/footer');
	}

	//exit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'admin_id'=> '',
		'date'=> '',
		'time_in'=> '',
		'time_out'=> '',
		'approved_by'=> ''
		);
		
		
		if(!empty($id))
		{
			$this->load->model('attend_model');	

		
			$data['page_head']= 'Edit Leave';
			
			$query=$this->db->query("select * from pms_admin_attend where atten_id=".$id);
			$data['formdata']=$query->row_array();			
			$data['admins']=$this->attend_model->get_all_admins();
		
			$this->load->view('include/header');
			$this->load->view('attend/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update()
	{
		$data['page_head']= 'Edit Leave';
		
			if($this->input->post('name'))
			{
				
				$this->load->model('attend_model');	
		
			
					$this->load->model('attend_model');
					$id=$this->attend_model->update_record();
					redirect('attend/?update=1');
								
			}else
			{
				redirect('attend');
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
		
		$this->load->model('attend_model');
		if(!empty($id))
		{
			$id=$this->attend_model->delete($id);
			redirect('attend/?del='.$id);
		}
		elseif(is_array($this->input->post('delete_rec')))
		{ 
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$id=$this->attend_model->delete($val);
				}
			redirect('attend/?del='.$id);
		}
		else
		{
			redirect('attend');
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
			$this->load->model('attend_model');
			$this->attend_model->delete_multiple_record($id_arr);
			redirect('attend/?rows='.$rows.'&del=1');
		}
		else{
			redirect('attend');
		}
	}
	
	//punching functions
	
	function punch_in()
    {
		
		$data=array(
		'admin_id'=> $_SESSION['vendor_session'],
		'date'=> date("Y-m-d"),
		'time_in'=> date("H:i"),
		'time_out'=> '',
		'approved_by'=> 0
		);
	  $this->db->insert('pms_admin_attend', $data);		
		$id=$this->db->insert_id();
		$_SESSION['atn_id']=$id;
		
		redirect('home');
		//return $this->db->insert_id();
    }
    
	function punch_out()
    {
		
		$data=array(
		'admin_id'=> $_SESSION['vendor_session'],
		'time_out'=> date("H:i"),
		'approved_by'=> 0
		);
	
        $this->db->where('atten_id',$_SESSION['atn_id']);
        $this->db->update('pms_admin_attend', $data);		
		$id=$this->db->insert_id();
	$_SESSION['atn_id']='';
		redirect('home');
		//~ return $this->db->insert_id();
    }
    
}
?>
