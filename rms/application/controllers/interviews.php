<?php 
class Interviews extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}
	
	
	function index(){
		$this->load->library('pagination');
		$searchterm='';
		$from_date='';
		$to_date ='';
		$start=0;
		
		if(isset($_GET['limit']))
		{
			if($_GET['limit']!='')
				$limit= $_GET['limit'];
			}
			else{
				$limit=25;
			}
		
		$rows='';
		$this->load->model('interview_model');
		
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
		
		if(isset($_POST['searchterm']))
		{
			if($_POST['searchterm']!='')
			$searchterm= $_POST['searchterm'];
		}
		
		if(isset($_POST['from_date']))
		{
			if($_POST['from_date']!='')
			$from_date= $_POST['from_date'];
		}
		
		if(isset($_POST['to_date']))
		{
			if($_POST['to_date']!='')
			$to_date= $_POST['to_date'];
		}
		
		$this->data['total_rows']= $this->interview_model->record_count($searchterm,$from_date,$to_date);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/interviews/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		
		$this->data["records"] = $this->interview_model->get_list($start,$limit,$searchterm,$from_date,$to_date,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["from_date"]=$from_date;
		$this->data["to_date"]=$to_date;
		
		$this->data['page_head'] = 'Interview list';
		$this->load->view('include/header');
		$this->load->view('interview/list',$this->data);				
		$this->load->view('include/footer');		
	}	
	
	function selected($id = null)
	{
		
		if(!empty($id))
		{

			$this->load->model('interview_model');
			$id = $this->interview_model->update_status_select($id);
			redirect('interviews');
		}
	}
	
	function rejected($id = null)
	{
		
		if(!empty($id))
		{

			$this->load->model('interview_model');
			$id = $this->interview_model->update_status_reject($id);
			redirect('interviews');
		}
	}
}

