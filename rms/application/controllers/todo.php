<?php 
class Todo extends CI_Controller {
// image delete is not done, not all delete is not added properly.
	function Todo()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');

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
		$this->load->model('todomodel');
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
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->todomodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/todo/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		
		$this->data["page_head"]= "Manage Todo";
		// paging ends here
		$this->data["records"] = $this->todomodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;



		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view("include/header",$this->data);
		$this->load->view('todo/list',$this->data);				
		$this->load->view('include/footer',$this->data);
		
	}	

	function add()
	{	
		$this->data['formdata']=array(
		'todo_group_id'     => '0',
		'title'             => '',
		'title_ar'          => '',		
		'start_date'        => '',
		'attachment'        => '',
		'end_date'          => '',
		'end_time'          => '',
		'status_id'         => array(),
		'start_time'        => '',
		'created_by'        => '',
		'description'       => '',
		'description_ar'    => '',
		);
		
		$this->load->model('todomodel');		
		$this->data["todo_group_id"] = $this->todomodel->todo_array();
		$this->data["status_list"] = $this->todomodel->todo_status();
		if($this->input->post('title'))
		{
			$this->form_validation->set_rules('title', 'Todo name required', 'required');
				$this->form_validation->set_rules('check_dups', 'Todo Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->todomodel->insert_record();
				redirect('todo/?ins=1');
			}
				$this->data['formdata']=array(
				'todo_group_id'      => $this->input->post('todo_group_id'),
				'title'              => $this->input->post('title'),
				'title_ar'           => $this->input->post('title_ar'),				
				'description'        => $this->input->post('description'),
				'description_ar'     => $this->input->post('description_ar'),				
				'start_date'         => $this->input->post('start_date'),
				'created_by'         => $this->input->post('created_by'),
				'status_id'          => $this->input->post('status_id'),
				'end_date'           => $this->input->post('end_date'),
				'end_time'           => $this->input->post('end_time'),
				'attachment'        => '',
				'start_time'         => $this->input->post('start_time')
				);
			}
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);	
		$this->data['page_head']= 'Add Todo';			
		$this->load->view("include/header",$this->data);
		$this->load->view('todo/add',$this->data);				
		$this->load->view('include/footer',$this->data);
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$this->data['site_url']=$this->config->item('site_url');

		
		if(!empty($id))
		{
			
			if($this->input->get('delimg')=='1' && $this->input->get('order')!='')
			{

				if($this->input->get('order')==1)

				{
					$query = $this->db->query("select attachment from pms_todo where todo_id=".$id);
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('../uploads/todo/'.$row['attachment']) && $row['attachment']!='')
						unlink('../uploads/todo/'.$row['attachment']);
					}
				}
			}
			
			$this->load->model('todomodel');	
			$this->data["todo_group_id"] = $this->todomodel->todo_array();	
			
			$this->data['page_head']= 'Edit Todo';
			
			$query=$this->db->query("select a.*,b.* from pms_todo a inner join pms_todo_description b ON a.todo_id=b.todo_id where a.todo_id=".$id);			
			$this->data['formdata']=$query->row_array();	
				
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view('todo/edit',$this->data);				
			$this->load->view('include/footer',$this->data);			
		}
		{
			//redirect('categories');
		}
	}

	function update($id=null)
	{  
	     $id=$this->input->post('todo_id');
		$this->data['page_head']= 'Edit Todo';
		$this->data['site_url']=$this->config->item('site_url');
		$this->load->model('todomodel');		
		$this->data["todo_group_id"] = $this->todomodel->todo_array();

		if($this->input->post('title'))
		{
			$this->form_validation->set_rules('title', 'Todo name required', 'required');
				$this->form_validation->set_rules('check_dups', 'Todo Name', 'callback_check_dups');

					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('todomodel');
						$id=$this->todomodel->update_record();
						redirect('todo/?update=1');
					}
						$this->load->model('todomodel');	
						$data["todo_group_id"] = $this->todomodel->todo_array();	
						
						$this->data['formdata']=array(
						'todo_id'            =>$this->input->post('todo_id'),
						'todo_group_id'      => $this->input->post('todo_group_id'),
						'title'              => $this->input->post('title'),
						'title_ar'           => $this->input->post('title_ar'),				
						'description'        => $this->input->post('description'),
						'description_ar'     => $this->input->post('description_ar'),				
						'start_date'         => $this->input->post('start_date'),
						'created_by'         => $this->input->post('created_by'),
						'status_id'          => $this->input->post('status_id'),
						'attachment'        => '',
						'end_date'           => $this->input->post('end_date'),
						'end_time'           => $this->input->post('end_time'),
						'start_time'         => $this->input->post('start_time')
						);
						
					$this->load->view("include/header",$this->data);
					$this->load->view('todo/edit',$this->data);				
					$this->load->view('include/footer',$this->data);						
			}else
			{
				redirect('todo');
			}			
	}
	
	function delete($id=null)
	{
		$this->load->model('todomodel');
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}


		if(!empty($id))
		{
			$id=$this->todomodel->delete($id);
			redirect('todo/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
				{
					$id=$this->todomodel->delete($val);
				}
			redirect('todo/?rows='.$rows.'&del=1');
		}else
		{
			redirect('products');
		}
	}

	function check_dups()
	{
		$this->db->where('title', $this->input->post('title'));
		if($this->input->post('todo_id') > 0)	$this->db->where('todo_id !=', $this->input->post('todo_id'));
		$query = $this->db->get('pms_todo_description');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Todo title already used, pelase change');
			return false;
		}
	}	

}
?>
