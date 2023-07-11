<?php 
class Productsmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_products';
		$this->upload_file_name='';
    }

	function record_count($searchterm,$international,$level_study) 
	{
		$sql="select count(*)as product_id from pms_products a left join pms_jobs b on a.product_id=b.product_id ";
		$cond	= '';

		
			
		if($searchterm!='')
		{
			if($cond!='')
			{
			  $cond .=" and a.product_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.product_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['product_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$international,$level_study)
    {
		$sql="select a.*, c.company_name from ".$this->table_name." a left join pms_jobs b on a.product_id=b.product_id left join pms_company c on a.company_id=c.company_id";
		
		$cond	= '';

		
		if($searchterm!='')
		{
			if($cond!=''){
			  $cond .=" and a.product_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.product_name like '%" . $searchterm . "%'";
			}	
		} 
				
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		$sql.=" order by a.product_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	
	function insert_record()
    {
		
		if (isset($_FILES['product_image']) && is_uploaded_file($_FILES['product_image']['tmp_name'])) 
		{            
			$config['upload_path'] = 'uploads/products';
			$config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg|gif';
			$config['max_size']	= '0';
			$config['file_name'] = md5(uniqid(mt_rand()));
			
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('product_image'))
				{
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];
				}
				else
				{
					$this->upload_file_name='';
				}
		}
		
		$data=array(
		'product_name'        =>$this->input->post('product_name'),
		'company_id'          =>$this->input->post('company_id'),
		'product_details'     => $this->input->post('product_details'),
		'product_url'         =>$this->input->post('product_url'),
		'product_image'       =>$this->upload_file_name		
		);
		
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		
		
		return $this->new_id;		
    }
	
	function update_record($id)
	{
		
		$data=array(
		'product_name'        =>$this->input->post('product_name'),
		'company_id'          =>$this->input->post('company_id'),
		'product_details'     => $this->input->post('product_details'),
		'product_url'         =>$this->input->post('product_url'),
		);

       $this->db->where('product_id', $id);
	   $this->db->update($this->table_name, $data);
		
		if (isset($_FILES['product_image']) &&  is_uploaded_file($_FILES['product_image']['tmp_name'])) 
		{            
			$config['upload_path'] = 'uploads/products';
			$config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg|gif';
			$config['max_size']	= '0';
			$config['file_name'] = md5(uniqid(mt_rand()));			
			$this->load->library('upload', $config);		
			
			if ($this->upload->do_upload('product_image'))
			{
				$data =  $this->upload->data();	
				$this->upload_file_name=$data['file_name'];
				$query = $this->db->query("select product_image from pms_products where product_id=".$id);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					if(file_exists('uploads/products'.$row['product_image']) && $row['product_image']!='')
					unlink('uploads/products'.$row['product_image']);
				}
			$query = $this->db->query("update pms_products set product_image='".$this->upload_file_name."' where product_id=".$id);
				
			}
		}

			
	}

	function company_list()
	{
		
		$query = $this->db->query('select distinct company_id, company_name from  pms_company order by company_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	    }
		
		
		function delete_records($delete_rec=array())	
	{
		if(is_array($delete_rec))
		{
			 foreach ($delete_rec as $key => $val)
 				{
					$query = $this->db->query("select product_image from pms_products where product_id=".$val);
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('uploads/products'.$row['product_image']) && $row['product_image']!='')
						unlink('uploads/products'.$row['product_image']);
					}
					$this->db->where('product_id', $val);
					$this->db->delete('pms_products'); 
				}
			return true;
		}else
		{
			return false;
		}
	}
		
	}
?>