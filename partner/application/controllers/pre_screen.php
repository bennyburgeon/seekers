<?php 
class Pre_screen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	}
	
	
	function index(){
		$this->load->library('pagination');
		$searchterm='';
		$pre_screen_date='';
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
		$this->load->model('pre_screen_model');
		
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
		
		if(isset($_POST['pre_screen_date']))
		{
			if($_POST['pre_screen_date']!='')
			$pre_screen_date= $_POST['pre_screen_date'];
		}
		
			
		$this->data['total_rows']= $this->pre_screen_model->record_count($searchterm,$pre_screen_date);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."pre_screen/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		
		$this->data["records"] = $this->pre_screen_model->get_list($start,$limit,$searchterm,$pre_screen_date,$sort_by);
	
		//print_r($this->data["records"]);
		//exit();

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["pre_screen_date"]=$pre_screen_date;
		
		$this->data['page_head'] = 'Interview list';
		$this->load->view('include/header');
		$this->load->view('pre_screen/list',$this->data);				
		$this->load->view('include/footer');		
	}	

	function calendar(){
		$this->load->library('pagination');
		$searchterm='';
		$pre_screen_date='';
		$start=0;
		$sort_by='';
		if(isset($_GET['limit']))
		{
			if($_GET['limit']!='')
				$limit= $_GET['limit'];
			}
			else{
				$limit=25;
			}
		
		$rows='';
		$this->load->model('pre_screen_model');
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["pre_screen_date"]=$pre_screen_date;
		
		$this->data['page_head'] = 'Interview list';
		$this->load->view('include/header');
		$this->load->view('pre_screen/calendar',$this->data);				
		$this->load->view('include/footer');		
	}	
	
	function calendar_ci(){
		
		$this->load->model('pre_screen_model');
		
		$prefs = array(
        'start_day'    => 'saturday',
        'month_type'   => 'long',
        'day_type'     => 'long',
		'template'     =>  '{table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="#">Applied &nbsp;&nbsp;<input type="checkbox" name="avail_id[]" value="{day}" checked="checked">&nbsp;&nbsp;{day}</a>{/cal_cell_content}
        {cal_cell_content_today}Today&nbsp;&nbsp;<div class="highlight"><a href="#"><input type="checkbox" name="avail_id[]" value="{day}"  checked="checked">&nbsp;&nbsp;{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}Vacant&nbsp;&nbsp;<input type="checkbox" name="avail_id[]" value="{day}">&nbsp;&nbsp;{day}{/cal_cell_no_content}
		
        {cal_cell_no_content_today}<div class="highlight"><input type="checkbox" name="avail_id[]" value="{day}">&nbsp;&nbsp;{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}
        {table_close}</table>{/table_close}'
		);

		
		
		$this->data['cur_year']=date('Y');
		$this->data['cur_month']=date('m');
		$this->data['prev_month']= date('m')-1;
		$this->data['next_month']= date('m')+1;
		$this->data['cur_year']=date('Y');
		
		if($this->input->get("year")!='')
		{
			$this->data['cur_year']=$this->input->get("year");
		}

		if($this->input->get("month")!='')
		{
			$this->data['cur_month']=$this->input->get("month");
		}		
		
		$data = array();
		
		$data=$this->pre_screen_model->get_current_schedule(1,$this->data['cur_month'],$this->data['cur_year']);
	
		$this->load->library('calendar',$prefs);
		$this->data['calendar']= $this->calendar->generate($this->data['cur_year'],$this->data['cur_month'],$data);
	
		$this->data['prev_month']= $this->data['cur_month']-1;
		$this->data['next_month']= $this->data['cur_month']+1;
		
		if($this->data['prev_month']< date('m'))
		{
			$this->data['prev_month']=date('m');
			$this->data['prev_year']=$this->data['cur_year'];
		}else
		{
			$this->data['prev_year']=$this->data['cur_year'];
		}
	
		if($this->data['next_month']>12)
		{
			$this->data['next_month']=1;
			$this->data['next_year']=$this->data['cur_year']+1;
		}else
		{
			$this->data['next_year']=$this->data['cur_year'];
		}
				
		$this->data['page_head'] = 'Interview List';
		//$this->load->view('include/header');
		$this->load->view('pre_screen/ci_calendar',$this->data);				
		//$this->load->view('include/footer');		
	}	

	function calendar_ci_open(){
		
		$this->load->model('pre_screen_model');
	
		$this->data['candidate_id']=1;
		$this->data['month']=date('m');
		$this->data['year']=date('Y');
		
		if($this->input->get("candidate_id")!='')
		{
			$this->data['candidate_id']=$this->input->get("candidate_id");
		}

		if($this->input->post("candidate_id")!='')
		{
			$this->data['candidate_id']=$this->input->post("candidate_id");
		}		
						
		$this->data['page_head'] = 'Interview List';
		$this->load->view('include/header');
		$this->load->view('pre_screen/open_cal',$this->data);				
		$this->load->view('include/footer');		
	}	
	
	function update_shift_vacancy()
	{
		$this->load->model('pre_screen_model');
		if($this->input->post("avail_id")!='')
		{
			$avail_id=$this->input->post("avail_id");
			$candidate_id=$this->input->post("candidate_id");
			$month=$this->input->post("month");
			$year=$this->input->post("year");
			
			if(is_array($avail_id))
			{
				$this->db->where('candidate_id', $candidate_id);
				$this->db->where('month(avail_date)', $month);
				$this->db->where('year(avail_date)', $year);				
				$this->db->delete('pms_candidate_available_dates');
	
				foreach ($avail_id as $key => $val)
 				{
					$this->pre_screen_model->update_shift_vacancy($candidate_id,$val,$month,$year);
				}
				
				$response = array(
			    'data' => '',
				'status'=>'success',
				);			
				header('Content-type: application/json');
				echo json_encode($response);				
				exit();
			}	
				$response = array(
			    'data' => '',
				'status'=>'failure',
				);
				header('Content-type: application/json');
				echo json_encode($response);	
				exit();		
		}
		
		$response = array(
			'data' => '',
			'status'=>'failure',
			);
			header('Content-type: application/json');
			echo json_encode($response);	
			exit();
	}
	
	function selected($id = null)
	{
		if(!empty($id))
		{
			$this->load->model('pre_screen_model');
			$id = $this->pre_screen_model->update_status_select($id);
			redirect('pre_screen');
		}
	}
	
	function rejected($id = null)
	{
		
		if(!empty($id))
		{

			$this->load->model('pre_screen_model');
			$id = $this->pre_screen_model->update_status_reject($id);
			redirect('pre_screen');
		}
	}
}

