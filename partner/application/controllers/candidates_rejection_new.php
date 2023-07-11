<?php 
class Candidates_rejection extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		//$_SESSION['vendor_session']=1;
		$this->load->model('statemodel');
		$this->load->model('countrymodel');
		$this->load->model('citymodel');
		$this->load->model('candidates_rejectionmodel');
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
		$this->load->model('candidates_rejectionmodel');
		
		$this->data['app_rej_search']='';
		$this->data['int_rej_search']='';
		$this->data['offer_rej_search']='';
		
		$this->data['start']=0;
		$this->data['limit']=500;
		$this->data['rows']='';
		
		
        if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =500;
		}

		if($this->input->get('sort_by')!='')
		{
			$this->data['sort_by']=$this->input->get("sort_by");
		}
		else
		{
			$this->data['sort_by'] = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['rows']=$this->input->get("rows");
		}
		
		if($this->input->get('app_rej_search'))
		{
			$this->data['app_rej_search']=$this->input->get('app_rej_search');
		}

		if($this->input->post('app_rej_search'))
		{
			$this->data['app_rej_search']=$this->input->post('app_rej_search');
		}
		
		
		
		if($this->input->get('int_rej_search'))
		{
			$this->data['int_rej_search']=$this->input->get('int_rej_search');
		}

		if($this->input->post('int_rej_search'))
		{
			$this->data['int_rej_search']=$this->input->post('int_rej_search');
		}
		
		
		if($this->input->get('offer_rej_search'))
		{
			$this->data['offer_rej_search']=$this->input->get('offer_rej_search');
		}

		if($this->input->post('offer_rej_search'))
		{
			$this->data['offer_rej_search']=$this->input->post('offer_rej_search');
		}
		
		
		$this->data['app_rej_count']= $this->candidates_rejectionmodel->app_rej_count($this->data['app_rej_search']);
		
		$this->data['int_rej_count']= $this->candidates_rejectionmodel->int_rej_count($this->data['int_rej_search']);
		
		$this->data['offer_rej_count']= $this->candidates_rejectionmodel->offer_rej_count($this->data['offer_rej_search']);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."candidates_rejection/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&app_rej_search=".$this->data['app_rej_search']."&int_rej_search=".$this->data['int_rej_search']."&offer_rej_search=".$this->data['offer_rej_search'];
		
			
		$config['page_query_string'] = TRUE;
		$config['app_rej_count'] = $this->data['app_rej_count'];
		$config['int_rej_count'] = $this->data['int_rej_count'];
		$config['offer_rej_count'] = $this->data['offer_rej_count'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data['limit'];
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
		
	
		$this->data["app_rej"] = $this->candidates_rejectionmodel->app_rej($this->data['start'],$this->data['limit'],$this->data['app_rej_search'],$this->data['sort_by']);
		
		$this->data["int_rej"] = $this->candidates_rejectionmodel->int_rej($this->data['start'],$this->data['limit'],$this->data['int_rej_search'],$this->data['sort_by']);
		
		$this->data["offer_rej"] = $this->candidates_rejectionmodel->offer_rej($this->data['start'],$this->data['limit'],$this->data['offer_rej_search'],$this->data['sort_by']);
		
			
		$this->data['page_head'] = 'Candidates Rejection Report';
		$this->data["candidates_rejection_summary"]=$this->candidates_rejectionmodel->candidates_rejection_summary();				

	
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates_rejection/rejectionlist',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	


	function get_calls_history()
	{
		$this->data["records"] = $this->candidates_rejectionmodel->get_calls_history($this->input->post('app_id'));
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
