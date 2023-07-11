<?php
class Test extends CI_controller{
	function Test ()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');

		$this->data['cur_page_name']=config_item('page_title').' AFET Futures';
		$this->data['current_page_head']='Date';
		$this->data['page'] = '';
		
		$this->data['module_explanation'] = 'add/edit/activate';

		$this->data['tasks'] =0;
		$this->data['todos'] = 0;
		$this->data['messages'] = 0;
		$this->data['emails'] = 0;	
	}

	function index()
	{

		//$this->load->model("afetfuturesmodel");
		$this->load->library('pagination');
		$this->data['module_head'] = 'Manage - AFET Futures';
		$this->data['module_action'] = 'List All';		
		$this->data['graph_data']=array();
		
		$start=0;
		$rows_per_page=30;
		// paging starts here

		$this->data['date_from']='';
		$this->data['date_to']='';
		$this->data['sort']='desc';
		
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}

		if($this->input->post("date_from")!='')
		{
			$this->data['date_from']=$this->input->post("date_from");
		}

		if($this->input->post("date_to")!='')
		{
			$this->data['date_to']=$this->input->post("date_to");
		}

		if($this->input->get("date_from")!='')
		{
			$this->data['date_from']=$this->input->get("date_from");
		}

		if($this->input->get("date_to")!='')
		{
			$this->data['date_to']=$this->input->get("date_to");
		}

		if($this->input->get("sort")!='')
		{
			$this->data['sort']=$this->input->get("sort");
		}
				
		//$this->data['total_rows']= $this->afetfuturesmodel->record_count($this->data['date_from'],$this->data['date_to']);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		
		if($query_str=='')$query_str='date_from='.$this->data['date_from'].'&'.'date_to='.$this->data['date_to'].'&sort='.$this->data['sort'];
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."index.php/test/?$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = 100;
		$config['query_string_segment'] = 'rows';
		$config['per_page'] = 30;
		$config['num_links'] = 10;
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=true;
		$config['last_link']=true;
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';	
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
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

		//$this->data["records"] = $this->afetfuturesmodel->get_list($start,$rows_per_page,$this->data['date_from'],$this->data['date_to'],$this->data['sort']);

		if($this->data['sort']=='desc')
			$this->data['sort']='asc';
		else
			$this->data['sort']='desc';
					
		$this->data["page_head"]= "Manage SHEFutures";
		$this->data['menu_flow_visted']=0;
		$this->data['menu']='';

		//$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);
//		print_r($this->data["records"]);
//		exit();
//		$this->load->view("includes/header",$this->data);	
		$this->load->view("test/test",$this->data);
//		$this->load->view("afetfutures/footer",$this->data);
		
	}

  public function image_create() 
  {
        $path = dirname(__FILE__);
        $finalPath = dirname($path) . '/assets/graph_data';
		$chartnum=$_POST['chartnum'];
        $a = $_POST[$chartnum];
        if ($a != '') 
		{
            $imageData1 = file_get_contents($a);
            file_put_contents($finalPath . '/'.$_POST['chartnum'].'.png', $imageData1);
        }
    }
}
?>