<?php 
class Products extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');	
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
	function index($offset = 0)
	{	
		$this->data['cur_page']=$this->router->class;
		$this->load->model('productsmodel');
		$this->load->library('pagination');
		
		$this->data["searchterm"]='';
		$this->data["international"]='';
		$this->data["level_study"]='';

		$searchterm='';
		$start=0;
		 if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=55;
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

		if($this->input->get("international")!='')
		{
			$this->data["international"]=$this->input->get("international");
		}

		if($this->input->get("level_study")!='')
		{
			$this->data["level_study"]=$this->input->get("level_study");
		}
						
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$this->data["searchterm"]= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->productsmodel->record_count($this->data["searchterm"],$this->data["international"],$this->data["level_study"]);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."products/?sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."&international=".$this->data["international"]."&level_study=".$this->data["level_study"]."&$query_str";
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
		
		$this->data["page_head"]= "Manage Products";
		// paging ends here
		$this->data["records"] = $this->productsmodel->get_list($start,$limit,$this->data["searchterm"],$sort_by,$this->data["international"],$this->data["level_study"]);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		
		
		$this->load->view('include/header',$this->data);
		$this->load->view('products/listproducts',$this->data);				
		$this->load->view('include/footer',$this->data);
	}
	
	function add()
	{	
		$this->data['cur_page']=$this->router->class;
		$this->data['formdata']=array(
		'product_name'=> '' ,
		'company_id' => '' ,
		'product_details' => '' ,
		'product_url' => '' ,
		'product_image' => '' ,
		
		);
		
		$this->load->model('productsmodel');	
					
		$this->data["company_list"] = $this->productsmodel->company_list();
		
		if($this->input->post('product_name'))
		{
			$this->form_validation->set_rules('product_name', 'product name', 'required');
			$this->form_validation->set_rules('product_name_dup', 'ducplicate product name', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->productsmodel->insert_record();
				redirect('products/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'product_name'=>$this->input->post('product_name'),
				'company_id'=>$this->input->post('company_id'),
				'product_details' => $this->input->post('product_details'),
				'product_url'=>$this->input->post('product_url'),
				);
		}
		
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->data['page_head']= 'Add Products';
				$this->load->view('include/header',$this->data);
				$this->load->view('products/addproducts',$this->data);	
				$this->load->view('include/footer',$this->data);
	}

	function edit($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']= 'Edit Products';
		$this->load->model('productsmodel');	
		$this->data['upload_root']=$this->config->item('base_url');
		$this->db->where('product_id', $id);
		$query=$this->db->get('pms_products');
		$this->data['formdata']=$query->row_array();
		
		$this->data["company_list"] = $this->productsmodel->company_list();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view('include/header',$this->data);
		$this->load->view('products/editproducts',$this->data);	
		$this->load->view('include/footer',$this->data);

	}

	
		
	function update($id=null)
	{
         $id=$this->input->post('product_id');		 
	if(!empty($id))
		{
			
				$this->form_validation->set_rules('product_name', 'Products Name', 'required');
				$this->form_validation->set_rules('product_name_dup', 'Products Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('productsmodel');
						$id=$this->productsmodel->update_record($id);
						redirect('products/?update=1');
					}
					else{
					
						// load page again for validation
						$data['formdata']=array(
						'product_name'=>$this->input->post('product_name'),
				'company_id'=>$this->input->post('company_id'),
				'product_details' => $this->input->post('product_details'),
				'product_url'=>$this->input->post('product_url'),
						);
		$this->load->model('productsmodel');

     	$this->data["company_list"] = $this->productsmodel->company_list();	
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->data['page_head']= 'Edit Products';

		$this->load->view('include/header',$this->data);
		$this->load->view('products/editproducts',$this->data);	
		$this->load->view('include/footer',$this->data);
					}
			
		}else{
			redirect('products');
			}
	}
	function delete($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->load->model('productsmodel');
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if(!empty($id))
		{		
			$delete_rec=array('0' => $id);
			$id=$this->productsmodel->delete_records($delete_rec);
		}elseif(is_array($this->input->post('checkbox')))
		{
			$id=$this->productsmodel->delete_records($this->input->post('checkbox'));
		}
		if($id==true)
			redirect('products/?rows='.$rows.'&del=1');
		else
			redirect('products/?rows='.$rows.'&del=0');
		
	}
	
	function check_dups()
	{
		$this->db->where('product_name', $this->input->post('product_name'));
		
		if($this->input->post('product_id') > 0)	    $this->db->where('product_id !=', $this->input->post('product_id'));
		
		$query = $this->db->get('pms_products');
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'product name already used.');
			return false;
		}
	}

	function do_upload()
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size']	= '0';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		//print_r($_FILES);
//		echo $this->input->post('product_image');
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($this->input->post('product_image')))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			exit();
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			return $data;
		}
	}

}
?>
