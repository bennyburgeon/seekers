<?php 
class Jobs_report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		//$_SESSION['admin_session']=1;
		$this->load->model('statemodel');
		$this->load->model('countrymodel');
		$this->load->model('citymodel');
		$this->load->model('jobs_reportmodel');
		$this->data['cur_page']=$this->router->class;
	}
	
	function editor($path,$width) 
	{
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
	
	function index()
	{	
		$this->load->library('pagination');
		$admin_id='';
		$start=0;
		$limit=50;
		
		$this->data["ind_id"]='';
		$ind_id='';
		$rows='';
		$call_date_from='';
		$call_date_to='';
		$candidate_id='';
		$company_id='';
		$job_id='';
        $searchterm='';
				
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
		
		if($this->input->get('admin_id')!='')
		{
			$admin_id= $this->input->get('admin_id');
		}

		if($this->input->post('admin_id')!='')
		{
			$admin_id= $this->input->post('admin_id');
		}

		if($this->input->post('company_id')!='')
		{
			$company_id= $this->input->post('company_id');
		}
		
		if($this->input->get('company_id')!='')
		{
			$company_id= $this->input->get('company_id');
		}
        
        if($this->input->get('searchterm')!='')
		{
			$searchterm= $this->input->get('searchterm');
		}

		$this->data['total_rows']= $this->jobs_reportmodel->record_count($admin_id,$company_id,$searchterm);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."index.php/jobs_report/?sort_by=$sort_by&admin_id=$admin_id$query_str&company_id=$company_id";
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = 10;
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
		$this->data["records"] = $this->jobs_reportmodel->get_list($start,$limit,$admin_id,$sort_by,$company_id,$searchterm);
		
		$this->data["industry_list"] = $this->jobs_reportmodel->industry_list();
   
		$this->data['bde_list']= $this->jobs_reportmodel->bde_lists();
		$this->data['candidate_list']= $this->jobs_reportmodel->candidate_list();
        
		$this->data['candidate_list']= $this->jobs_reportmodel->candidate_list();
		$this->data['jobs_list']= $this->jobs_reportmodel->jobs_list();
		$this->data['company_list']= $this->jobs_reportmodel->company_list();
		
		$this->data["call_date_from"] = $call_date_from;		
		$this->data["call_date_to"] = $call_date_to;		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["admin_id"]=$admin_id;
		
		$this->data["candidate_id"] = $candidate_id;
		$this->data["company_id"] = $company_id;
		$this->data["job_id"] = $job_id;
		
		$this->data['page_head'] = 'Activity Report';				

		// graph data //		
	
		// leads collected by BDEs
		$this->data["bde_calls_list"]=$this->jobs_reportmodel->bde_to_lead_collection();
						
		//lead status summary
		$this->data["call_status_summary"]=$this->jobs_reportmodel->call_status_summary();
	
		// my follow ups
		$this->data["followup_history"]=$this->jobs_reportmodel->followup_history();
		$this->data["process_status_percentage"]=$this->jobs_reportmodel->process_status_percentage();

		// summary of lead opportunity
		$this->data["job_process_summary"]=$this->jobs_reportmodel->job_process_summary();
		// graph data end here 
		
		//print_r($this->data["job_process_summary"]);
		//exit();
		$this->load->view('include/header',$this->data);
		$this->load->view('jobs_report/jobslist',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	


	function get_calls_history()
	{
		$this->data["records"] = $this->jobs_reportmodel->get_calls_history($this->input->post('app_id'));
		$output_str='
		<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody>
				<tr class="pop_tr">
				  <td>#</td>
				  <td>Date</td>
				  <td>Next Date</td>
				  <td>Updated By</td>
				  <td>Details</td>
				  </tr>';
				 if(count($this->data["records"]>0))
				 {
					 $i=0;
					 foreach($this->data["records"] as $key => $val)
					 {
						 $i+=1;
						$output_str.='<tr>
						  <td>'.$i.'</td>
						  <td>'.$val['call_date'].'</td>
						  <td>'.$val['job_status'].'</td>
						   <td>'.$val['firstname'].'</td>
						  <td>'.$val['call_notes'].'</td>
						</tr>';
					 }
				 }else
				 {
					 exit();
				 }
			 $output_str.='</tbody></table>';
		echo $output_str;
		exit();
	}


	function check_dups()
	{
		$this->db->where('company_name', $this->input->post('company_name'));
		if($this->input->post('app_id') > 0)	$this->db->where('app_id !=', $this->input->post('app_id'));
		$query = $this->db->get('pms_job_apps');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Company name already used.');
			return false;
		}
	}
	
	public function getstate()
	{
		$this->load->model('statemodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statemodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('citymodel');
		
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->citymodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

}
?>
