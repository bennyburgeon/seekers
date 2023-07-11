<?php 
class Doc_parser extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	}

	function index()
	{	
		$this->data['page_title']='';
		$this->load->view('doc_parser/upload_file',$this->data);	
			

		if (isset($_FILES['cv_file']) && is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
		{         
			$csv['upload_path'] = 'uploads/samples/';
			$csv['allowed_types'] = 'pdf|doc|docx|txt';
			$csv['max_size']	= '0';
			$csv['file_name'] = md5(uniqid(mt_rand()));
			$this->upload->initialize($csv);

			if ($this->upload->do_upload('cv_file'))
			{
				$data_agreement = $this->upload->data();
				
				//print_r($data_agreement);
				
				if($data_agreement['file_ext']=='.doc')
				{
					$file_text=$this->read_doc('uploads/samples/'.$data_agreement['file_name']);
					print_r($file_text);
					exit();
				}
				
				if($data_agreement['file_ext']=='.docx')
				{

					
					$file_text=$this->read_docx('uploads/samples/'.$data_agreement['file_name']);
					echo $file_text;
					exit();
					
					print_r($_FILES);
					
					exit();
				}

				/*
				$data=array(
				'date_uploaded'     => $this->input->post('date_uploaded') ,
				'company_id'        => $this->input->post('company_id') ,
				'agreement_note'    => $this->input->post('agreement_note') ,
				'agreement_file'    => $data_agreement['file_name'],
				'admin_id'          => $_SESSION['admin_session'],
				);
				
				$agreement_id=$this->company_agreementsmodel->add_agreement($data);
				redirect('company_agreements?agreement=1');
				*/
				
			}
			
		}

	}

	function get_cv_content()
	{	
			if ($this->upload->do_upload('cv_file'))
			{
				$data_agreement = $this->upload->data();
				
				if($data_agreement['file_ext']=='.doc')
				{
					$file_text=$this->read_doc('uploads/samples/'.$data_agreement['file_name']);
					print_r($file_text);
					exit();
				}else if($data_agreement['file_ext']=='.docx')
				{

					
					$file_text=$this->read_docx('uploads/samples/'.$data_agreement['file_name']);
					echo $file_text;
					exit();
					
					print_r($_FILES);
					
					exit();
				}

				/*
				$data=array(
				'date_uploaded'     => $this->input->post('date_uploaded') ,
				'company_id'        => $this->input->post('company_id') ,
				'agreement_note'    => $this->input->post('agreement_note') ,
				'agreement_file'    => $data_agreement['file_name'],
				'admin_id'          => $_SESSION['admin_session'],
				);
				
				$agreement_id=$this->company_agreementsmodel->add_agreement($data);
				redirect('company_agreements?agreement=1');
				*/
				
			}
	}
		
	function read_doc($file_name)  
	{
		
		$fileHandle = fopen($file_name, "r");
		$line = @fread($fileHandle, filesize($file_name));   
		$lines = explode(chr(0x0D),$line);
		$outtext = array();
		foreach($lines as $thisline)
		  {
			$pos = strpos($thisline, chr(0x00));
			if (($pos !== FALSE)||(strlen($thisline)==0))
			  {
			  } else {
				$outtext[]= trim(htmlspecialchars(strip_tags($thisline))).nl2br(' ');
			  }
		  }
		  $line_array= implode("<br>", $outtext);
		return $line_array;
	}

	function read_docx($file_name)
	{
			$striped_content = '';
			$content = '';
	
			$zip = zip_open($file_name);
	
			if (!$zip || is_numeric($zip)) return false;
	
			while ($zip_entry = zip_read($zip)) {
	
				if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
	
				if (zip_entry_name($zip_entry) != "word/document.xml") continue;
	
				$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
	
				zip_entry_close($zip_entry);
			}// end while
	
			zip_close($zip);
	
			$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
			$content = str_replace('</w:r></w:p>', "\r\n", $content);
			$striped_content = strip_tags($content);
			$striped_content = nl2br($striped_content);
			return $striped_content;
		}
}
?>