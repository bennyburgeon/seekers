<?php 
class Healthcert extends CI_Controller {

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
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=50;
		}
		$rows='';
		$this->load->model('healthcertmodel');
		
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
			if($_GET['searchterm']!='')	$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->healthcertmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."healthcert/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->healthcertmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		$this->data['page_head']= 'Professional certificate';

		$this->load->view('include/header');
		$this->load->view('healthcert/listprofcert',$this->data);				
		$this->load->view('include/footer');		
	}
	
	function add()
	{	
		$data['formdata']=array(
		'cert_name'=> '',
		'cert_desc'=> ''
		);
		$this->load->model('healthcertmodel');		
		if($this->input->post('cert_name'))
		{
			$this->form_validation->set_rules('cert_name', 'Professional Certificate', 'required');
			$this->form_validation->set_rules('cert_dup', 'Professional Certificate', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->healthcertmodel->insert_record();
				redirect('healthcert/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'cert_name'=>$this->input->post('cert_name'),
				'cert_desc'=>$this->input->post('cert_desc')
				);
		}
		
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);	

				$data['page_head']= 'Add professional certificate';
				$this->load->view('include/header');
				$this->load->view('healthcert/addprofcert',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('healthcertmodel');

			$data['page_head']= 'Edit professional certificate';
			$this->db->where('cert_id', $id);
			$query=$this->db->get('pms_job_prof_certificates');
			$data['formdata']=$query->row_array();
			
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	

			$this->load->view('include/header');
			$this->load->view('healthcert/editprofcert',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Professional Certificate';
		$this->load->model('healthcertmodel');
		$id=$this->input->post('cert_id');
		if(!empty($id))
		{
			if($this->input->post('cert_name'))
			{
				
				$this->form_validation->set_rules('cert_name', 'Professional certificate name', 'required');
				$this->form_validation->set_rules('cert_dup', 'Professiona certificate name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->healthcertmodel->update_record($id);
						redirect('healthcert/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'cert_id'=>$id,
						'cert_name'=>$this->input->post('cert_name'),
						'cert_desc'=>$this->input->post('cert_desc')
						);
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);	
						$this->load->view('include/header');
						$this->load->view('healthcert/editprofcert',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('profcert');
			}			
		}else
		{
			redirect('profcert');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('cert_id', $id);
			$this->db->delete('pms_job_prof_certificates'); 
			redirect('healthcert/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
				
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('cert_id', $val);
					$this->db->delete('pms_job_prof_certificates'); 
				}
			redirect('healthcert/?del=1');
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
			$this->load->model('healthcertmodel');
			$this->healthcertmodel->delete_multiple_record($id_arr);
			redirect('healthcert/?multi=1');
		}
		else{
			redirect('branch');
		}
	}
	function check_dups()
	{
		$this->db->where('cert_name', $this->input->post('cert_name'));
		if($this->input->post('cert_id') > 0)	$this->db->where('cert_id !=', $this->input->post('cert_id'));
		$query = $this->db->get('pms_job_prof_certificates');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Certificate name already used.');
			return false;
		}
	}
}
?>
