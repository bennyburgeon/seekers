<?php class Contact extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('homepagemodel');
	}

	function index()
	{
		$this->data["left_search_form"]='';
		$this->data["current_controller"]=$this->router->class;
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_description']  = $this->config->item('company_name');
		$this->data['og_image']        = $this->config->item('website').'/assets/img/logo.png';
		$this->data['og_url']          = $this->config->item('website');
		$this->data['service_type']='';
		
		$this->data['industry_menu']=$this->homepagemodel->get_industry_menu();
		$this->data['home_summary']=$this->homepagemodel->get_home_summary();
		$this->data['service_type']=20;
		
		if($this->input->get('service_type')!='')
		{
			$this->data['service_type']=$this->input->get("service_type");
		}

		$this->load->view('homepage-include/header', $this->data);
		$this->load->view('contact/contact',  $this->data);	
		$this->load->view('homepage-include/footer',  $this->data);
	}



	function confirm()

	{	
		$this->data["left_search_form"]='';
		$this->data["current_controller"]=$this->router->class;
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_description']  = $this->config->item('company_name');
		$this->data['og_image']        = $this->config->item('website').'/assets/img/logo.png';
		$this->data['og_url']          = $this->config->item('website');
		$this->data['service_type']='';
		
		$this->data['industry_menu']=$this->homepagemodel->get_industry_menu();
		$this->data['home_summary']=$this->homepagemodel->get_home_summary();

		$this->data['upd_status']='';

		if($this->input->get('upd')!='')
		{
			$this->data['upd_status']=$this->input->get('upd');
		}
				
		if($this->input->post('full_name')!='')
		{
			if($this->input->post("service_type")!='')
				$this->data['service_type']=$this->input->post("service_type");
			else
				$this->data['service_type']=20;
				
			$service_array=array();
		$service_array=array(
				'1'  => 'cvwriting',
				'2'  => 'counselling',
				'3'  => 'interviewtraining',
				'4'  => 'jobsearch',
				'5'  => 'socialmedia',
				'6'  => 'jobalerts',
				'7'  => 'cvhighlight',
				'8'  => 'cvdistribution',
				'9'  => 'webinar',
				'10'  => 'jobposting',
				'11'  => 'cvsearch',
				'12'  => 'rsoftware',
				'13'  => 'ebranding',
				'14'  => 'erecruitment',
				'15'  => 'rpo',
				'16'  => 'emptraining',
				'17'  => 'learning',
				'18'  => 'learningcand',
				'19'  => 'learningemp',
				'20'  => 'contact form',
			);
			
			$email_array=array(
				'email_to'               =>  'info@logis.ae',
				//'email_to'             =>  'shyjo@bournham.in',
				'email_to_name'          =>  'Seekers-Logis.ae',
				'email_from'             =>  'hr@logis.ae',
				'subject'                =>  'Service Request',
				'from_name'              =>  'Seekers-Logis.ae',
				'full_name'              =>  $this->input->post('full_name'),
				'emailid'                =>  $this->input->post('emailid'),
				'mobile'                 =>  $this->input->post('mobile'),
				'comments'               =>  $this->input->post('comments'),
				'service_type'           =>  $service_array[$this->data['service_type']], 
				'date'                   =>  date('d-m-Y'),
				'email_template'         =>  'contact/email_template_job_application',
			);
			//print_r($email_array);
			//exit();
			$response=$this->send_email($email_array);
			
			redirect('contact/confirm/?upd=1');
		}

		$this->load->view('homepage-include/header', $this->data);

		$this->load->view('contact/contact_confirm',  $this->data);	

		$this->load->view('homepage-include/footer',  $this->data);		

	}
	
	function service_array()
	{
		$service_array=array();
		$service_array=array(
				'1'  => 'cvwriting',
				'2'  => 'counselling',
				'3'  => 'interviewtraining',
				'4'  => 'jobsearch',
				'5'  => 'socialmedia',
				'6'  => 'jobalerts',
				'7'  => 'cvhighlight',
				'8'  => 'cvdistribution',
				'9'  => 'webinar',
				'10'  => 'jobposting',
				'11'  => 'cvsearch',
				'12'  => 'rsoftware',
				'13'  => 'ebranding',
				'14'  => 'erecruitment',
				'15'  => 'rpo',
				'16'  => 'emptraining',
				'17'  => 'learning',
				'18'  => 'learningcand',
				'19'  => 'learningemp',
				'20'  => 'contact',
			);
	}
	
	function send_email($email_array=array())
	{
		//print_r($email_array);
		//exit();
		$mail_body=$this->load->view($email_array['email_template'], $email_array,true);
		$headers   = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers.= "From: ".$email_array['from_name']." <".$email_array['email_from'].">\r\n";	
		if(isset($email_array['email_cc']) && $email_array['email_cc']!='')
		$headers.= "CC: Company Name <".$email_array['email_cc'].">\r\n";
		$headers.= "X-Mailer: PHP/".phpversion()."\r\n";
		mail($email_array['email_to'], $email_array['subject'], $mail_body, $headers);

		//echo $headers;
		//echo '<br><br>';
		//echo $mail_body;
		//exit();
		return 1;
	}


}


