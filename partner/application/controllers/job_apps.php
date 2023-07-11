<?php 
class Job_apps extends CI_Controller {

	function job_apps()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
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
		$limit=25;
		}
		$rows='';
		$this->load->model('job_apps_model');
		
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
		
		if(isset($_GET['searchterm']))
		{
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->job_apps_model->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."job_apps/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->job_apps_model->get_list($start,$limit,$searchterm,$sort_by);//echo $this->db->last_query();
		$this->data['detail_list'] = $this->job_apps_model->job_details();
		$this->data['admin_user_list']=$this->job_apps_model->admin_user_list();		
		$this->data['status_list']=$this->job_apps_model->status_list();
		$this->data['jobs_list']       =$this->job_apps_model->get_all_jobs();
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Job Application';
				
				
		$this->load->view('include/header');
		$this->load->view('job_apps/list_job_apps',$this->data);				
		$this->load->view('include/footer');

		
	}	

	function multidelete()
	{
		$this->load->model('job_apps_model');
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('job_apps_model');
			$this->job_apps_model->delete_multiple_record($id_arr);
			redirect('job_apps/?multi=1');
		}
		else{
			redirect('job_apps');
		}
	}

	function job_view()
	{	

		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='Job Followup';
		$this->load->model('job_apps_model');
		$this->load->model('coursemodel');
		
		$job_id       = $this->input->get('job_id');
		$app_id       = $this->input->get('app_id');
		$candidate_id = $this->input->get('candidate_id');
		
		$this->data['detail_list2'] = $this->job_apps_model->detail_list2($candidate_id);
		$this->data['detail_list'] = $this->job_apps_model->detail_list($app_id);
		//echo $this->db->last_query();

		if($this->input->post('job_id')!='')
			{
				$data=array(
				'reg_status'      => $this->input->post('reg_status'),
				'fee_comments'        => $this->input->post('fee_comments'),
				'fee_date'        => $this->input->post('fee_date'),
				'fee_amount'        => $this->input->post('fee_amount')
				);
				
 			   $this->db->where('job_id', $job_id);
			   $this->db->update('pms_candidate', $data);
			   redirect('job_apps/job_view/'.$job_id);
		}
						
		$this->data['list']=$this->job_apps_model->follow_record($app_id);
		$this->data['note_list']=$this->job_apps_model->notes_record($app_id);				
		
		$this->data['admin_user_list']=$this->job_apps_model->admin_user_list();
		
		$this->data['status_list']=$this->job_apps_model->status_list();

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("job_apps/job_view",$this->data);
		$this->load->view("include/footer",$this->data);
	
	}
	
	function followup()
	{
		//echo $_POST['candidate_id'];
		$this->load->model('job_apps_model');
		if(isset($_POST['candidate_id']))
		{
			//date_default_timezone_set("Asia/Kolkata"); 
			
			$data=array(
			'candidate_id'   =>$_POST['candidate_id'],
			'job_id'         =>$_POST['job_id'],
			'title'          =>$_POST['title'],
			'status_id'      =>$_POST['status_id'],
			'app_id'         =>$_POST['app_id'],
			'admin_id'       => $_SESSION['vendor_session'],
			'description'    =>$_POST['desc'],
			'flp_date'       => date('Y-m-d h:m:s A')
			);
			
			if($this->input->post('future_followup')==1)
			{
				$data['flp_date_reminder']=$_POST['flp_date_reminder'];
				$data['flp_time_reminder']=$_POST['flp_time_reminder'];
				$data['assigned_to']      =$_POST['assigned_to'];
			}

			$query1=$this->db->insert('pms_job_followup',$data);
			$id=$this->db->insert_id();
			
			if($this->input->post('future_followup')==1)
			{
				// insert into tasks table
				$data=array(
					'task_title'          =>  $_POST['title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'start_date'          =>  date('Y-m-d'),
					'due_date'            =>  $_POST['flp_date_reminder'],
					'task_desc'           =>  $_POST['desc'],
					'admin_id'            =>  $_POST['assigned_to'],
					'project_id'          =>  $_POST['app_id'],
					'candidate_id'        =>  $_POST['candidate_id'],
					'candidate_follow_id' => $id,
				);			
				$query_task=$this->db->insert('pms_tasks',$data);				
			}
			
		}	
	}
	
	function notes()
	{
		
		$data=array(
		'candidate_id'   =>$_POST['candidate_id'],
		'job_id'         =>$_POST['job_id'],
		'job_app_id'     =>$_POST['app_id'],
		'title'          =>$_POST['title'],
		'notes'          =>$_POST['note'],
		'note_date'       => date('Y-m-d h:m:s A')
		);
		
		$this->db->insert('pms_job_notes',$data);
		$id=$this->db->insert_id();
		$this->load->model('job_apps_model');
		$this->data['note_list']=$this->job_apps_model->select_notes_record($id);
		$dataArr = $this->load->view('candidates_all/candidatenotes_list', $this->data,TRUE);
		echo $dataArr;
	
	}

	function followup_only()
	{
		
		$this->load->model('job_apps_model');
		$ids=explode(',',$_POST['app_id']);
			
		if(isset($_POST['app_id']))
		{
			
			$data=array(
			'candidate_id'   =>$ids[2],
			'job_id'         =>$ids[1],
			'title'          =>$_POST['title'],
			'status_id'      =>$_POST['status_id'],
			'app_id'         =>$ids[0],
			'admin_id'       => $_SESSION['vendor_session'],
			'description'    =>$_POST['desc'],
			'flp_date'       => date('Y-m-d h:m:s A')
			);
			
			if($this->input->post('future_followup')==1)
			{
				$data['flp_date_reminder']=$_POST['flp_date_reminder'];
				$data['flp_time_reminder']=$_POST['flp_time_reminder'];
				$data['assigned_to']      =$_POST['assigned_to'];
			}

			$query1=$this->db->insert('pms_job_followup',$data);
			$id=$this->db->insert_id();
			
			
			
			if($this->input->post('future_followup')==1)
			{
				// insert into tasks table
				$data=array(
					'task_title'          =>  $_POST['title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'start_date'          =>  date('Y-m-d'),
					'due_date'            =>  $_POST['flp_date_reminder'],
					'task_desc'           =>  $_POST['desc'],
					'admin_id'            =>  $_POST['assigned_to'],
					'project_id'          =>  $ids[0],
					'candidate_id'        =>  $ids[2],
					'candidate_follow_id' => $id,
				);			
				$query_task=$this->db->insert('pms_tasks',$data);				
			}
			
		}	
	}
	
	function notes_only()
	{
		$job_id=$this->job_apps_model->get_job_ids($_POST['app_id']);
		$candidate_id=$this->job_apps_model->get_c_ids($_POST['app_id']);
		$data=array(
		'candidate_id'   =>$candidate_id,
		'job_id'         =>$job_id,
		'job_app_id'     =>$_POST['app_id'],
		'title'          =>$_POST['title'],
		'notes'          =>$_POST['note'],
		'note_date'       => date('Y-m-d h:m:s A')
		);
		
		$this->db->insert('pms_job_notes',$data);
		$id=$this->db->insert_id();
		
	}

}
?>
