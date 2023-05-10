<?php 
class Socialmedia extends CI_Controller {

	function socialmedia()
	{
		parent::__construct();
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
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
		$limit=5;
		}
		$rows='';
		$this->load->model('socialmodel');
		
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
		$this->data['total_rows']= $this->socialmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."socialmedia/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->socialmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->model('branchmodel'); 
		
		$this->data['page_head']= 'Manage Socialmedia';		
		$config['base_url'] = base_url().'socialmedia/?';
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('socialmedia/listmedia',$this->data);				
		$this->load->view('include/footer');		
	}
	
	function add()
	{	
		$data['formdata']=array(
		'media_name'=> '',
		'media_link'=> ''
		);
		$this->load->model('socialmodel');
	
		if($this->input->post('media_link'))
		{
			$this->form_validation->set_rules('media_name', 'Social Media name', 'required');
			$this->form_validation->set_rules('cert_dup', 'Social Media name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->socialmodel->insert_record();
				redirect('socialmedia/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'media_name'=>$this->input->post('media_name'),
				'media_link'=>$this->input->post('media_link')
				);
		}
				$data['page_head']= 'Add socialmedia name';
				$this->load->view('include/header');
				$this->load->view('socialmedia/addmedia',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('socialmodel');

			$data['page_head']= 'Edit socialmedia name';
			$this->db->where('media_id', $id);
			$query=$this->db->get('pms_social_media');
			$data['formdata']=$query->row_array();

			$this->load->view('include/header');
			$this->load->view('socialmedia/editmedia',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$data['page_head']= 'Edit socialmedia name';
		$this->load->model('socialmodel');
		$id=$this->input->post('media_id');
		if(!empty($id))
		{
			if($this->input->post('media_link'))
			{
				$this->form_validation->set_rules('media_name', 'Social Media name', 'required');
				$this->form_validation->set_rules('cert_dup', 'Social Media name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->socialmodel->update_record($id);
						redirect('socialmedia/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'media_id'=>$id,
						'media_name'=>$this->input->post('media_name'),
						'media_link'=>$this->input->post('media_link')
						);
						
						$this->load->view('include/header');
						$this->load->view('socialmedia/editmedia',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('socialmedia');
			}			
		}else
		{
			redirect('socialmedia');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('media_id', $id);
			$this->db->delete('pms_social_media'); 
			redirect('socialmedia/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('media_id', $val);
					$this->db->delete('pms_social_media'); 
				}
			redirect('socialmedia/?del=1');
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
			$this->load->model('socialmodel');
			$this->socialmodel->delete_multiple_record($id_arr);
			redirect('socialmedia/?multi=1');
		}
		else{
			redirect('branch');
		}
	}
	function check_dups()
	{
		$this->db->where('media_name', $this->input->post('media_name'));
		if($this->input->post('media_id') > 0)	$this->db->where('media_id !=', $this->input->post('media_id'));
		$query = $this->db->get('pms_social_media');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Social Media name already used.');
			return false;
		}
	}
}
?>
