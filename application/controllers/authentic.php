<?php class Authentic extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('homemodel');
	}

	function index()
	{
		echo 'Index function';
	}


	function oauth_primary()
	{

		$jobId = $this->input->get('job_id');
		$_SESSION['job_id'] = $jobId;

		$client_id = $this->config->item('CLIENT_ID');
		$client_secret = $this->config->item('CLIENT_SECRET');
		$redirect_url = urlencode($this->config->item('REDIRECT_URL'));
		$base_url = urlencode($this->config->item('base_url'));
		$scope = $this->config->item('SCOPES');

		if (isset($_GET['code'])) {

			/* -- AccessToken request-- */
			$url    = 'https://www.linkedin.com/oauth/v2/accessToken';
			$param  = 'grant_type=authorization_code&code=' . $_GET['code'] .
				'&redirect_uri=' . $redirect_url . '&client_id=' . $client_id .
				'&client_secret=' . $client_secret;

			$response = (json_decode($this->get_token($url, $param), true));
			$access_token = $response['access_token'];
			if (isset($_GET['state'])) $_SESSION['job_code'] = $_GET['state'];

			if (isset($response['error'])) {

				/* -- Response error block -- */
				echo 'Some error occured<br><br>' . $response['error_description'] . '<br><br>Please Try again.';
			} else {

				$response = $this->get_profile_data($access_token);
				$fname = $response['firstName']['localized']['en_US'];
				$lname = $response['lastName']['localized']['en_US'];
				$id = $response['id'];
				$profileImage = ($response && isset($response['profilePicture'])) ?
					$response['profilePicture']['displayImage~']['elements'][0]['identifiers'][0]['identifier'] : '';

				$url    = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))';
				$param = '';
				$headers  = 'Authorization: Bearer ' . $access_token;
				$emailresponse = (json_decode($this->post_curl($url, $param, $headers), true));
				$emailAddress = $emailresponse['elements'][0]['handle~']['emailAddress'];

				$id             = isset($id) ? $id : '';
				$firstName      = isset($fname) ? $fname : '';
				$lastName       = isset($lname) ? $lname : '';
				$emailAddress 	= isset($emailAddress) ? $emailAddress : '';
				$pictureUrls    = isset($profileImage) && $profileImage != '' ? "<img src='" . $profileImage . "' width='100' />" : '';
				$location = '';
				$headline = '';
				$positions = '';
				$positionstitle = '';
				$publicProfileUrl = '';

				$data_array = array(
					'emailAddress'         => $emailAddress,
					'positions'         => $positions,
					'first_name'       => $firstName,
					'last_name'        => $lastName
				);

				if (isset($_SESSION['job_code']) && $_SESSION['job_code'] != '') {
					$this->save_registration($data_array);
				}

				echo "
					<table border='1' cellpadding='7' style='border-collapse: collapse;'>
					<tr style='text-align: center;'>
							<td colspan='2'>Thank you. Your Application Received.</td>
						</tr>
						<tr style='text-align: center;'>
							<td colspan='2'>" . $pictureUrls . "<br>" . $headline . "</td>
						</tr>
						<tr>
							<td>ID: </td>
							<td>" . $id . "</td>
						</tr>
						<tr>
							<td>First Name: </td>
							<td>" . $firstName . "</td>
						</tr>
						<tr>
							<td>last Name: </td>
							<td>" . $lastName . "</td>
						</tr>
						<tr>
							<td>Email: </td>
							<td>" . $emailAddress . "</td>
						</tr>
						<tr>
							<td>Job Position: </td>
							<td>" . $positionstitle . ": " . $positions . "</td>
						</tr>
						<tr>
							<td>Location: </td>
							<td>" . $location . "</td>
						</tr>
						<tr>
							<td>Profile Link: </td>
							<td><a href='" . $publicProfileUrl . "' target='_blank'>" . $publicProfileUrl . "</a></td>
						</tr>
					</table>
					";
			}
		} elseif (isset($_GET['error'])) {
			print_r($_GET['error']);
			die();
			/* -- Authentication error block -- */
			echo 'Some error occured<br><br>' . $_GET['error_description'] . '<br><br>Please Try again.';
		} else {
			$this->load->helper('url'); 

			$url = 'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=' . $client_id . '&redirect_uri=' . $redirect_url . '&scope=' . $scope;
			redirect($url, 'refresh');

			/* -- Authentication block-- 
			$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&
			client_id=" . $client_id . "&
			redirect_uri=" . $redirect_url . "&scope=" . $scope;

			echo '<a href="'.$url.'">
				<img src="' . $base_url . 'images/linkedin_connect_button.png" alt="Sign 
				in with LinkedIn"/>
			</a>';*/
		}
	}

	function content_share()
	{
		$client_id = $this->config->item('CLIENT_ID');
		$client_secret = $this->config->item('CLIENT_SECRET');
		$redirect_url = urlencode($this->config->item('REDIRECT_URL'));
		$base_url = $this->config->item('base_url');
		$scope = $this->config->item('SCOPES');


		if (isset($_SESSION['job_id']) && $_SESSION['job_id'] != '' && isset($_GET['code'])) {
			$jobId = $_SESSION['job_id'];

			$job_details = $this->homemodel->job_details_by_id($jobId);

			/* -- AccessToken request-- */
			$url    = 'https://www.linkedin.com/oauth/v2/accessToken';
			$param  = 'grant_type=authorization_code&code=' . $_GET['code'] .
				'&redirect_uri=' . $redirect_url . '&client_id=' . $client_id .
				'&client_secret=' . $client_secret;

			$response = (json_decode($this->get_token($url, $param), true));

			if (isset($response['error'])) {

				/* -- Response error block -- */
				echo 'Some error occured<br><br>' . $response['error_description'] . '<br><br>Please Try again.';
			} else {
				$access_token = $response['access_token'];
				/* -- Response success: Function to share details-- */
				$data = $this->get_profile_data($access_token);
				$linkedin_id = $data['id'];

				/* -- Share content details-- */
				$link = $base_url.'index.php/home/job_details?job_id='.$jobId;
				$body = new \stdClass();
				$body->content = new \stdClass();
				$body->content->contentEntities[0] = new \stdClass();
				$body->text = new \stdClass();
				$body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
				$body->content->contentEntities[0]->entityLocation = $link;
				$body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = $base_url.'images/logo.png';
				$body->content->title = $job_details['job_title'];
				$body->owner = 'urn:li:person:' . $linkedin_id;
				$body->text->text = $job_details['short_content'];
				$body_json = json_encode($body, true);

				try {
					$url    = 'https://api.linkedin.com/v2/shares';
					$headers  = 'Authorization: Bearer ' . $access_token;

					$response = json_decode($this->post_curl_content($url, $body_json, $headers));

					if (!$response) {
						echo 'Error: Something went wrong';
					}

					echo 'Content shared on LinkedIn successfully. Thanks !!!';
				} catch (Exception $e) {
					echo $e->getMessage() . ' for link ' . $link;
				}
			}
		} elseif (isset($_GET['error'])) {

			/* -- Authentication error block -- */
			echo 'Some error occured<br><br>' . $_GET['error_description'] . '<br><br>Please Try again.';
		} else {

			/* -- Authentication block-- */
			$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&
			client_id=" . $client_id . "&
			redirect_uri=" . $redirect_url . "&scope=" . $scope;

			echo '<a href="' . $url . '">
				<img src="' . $base_url . 'images/linkedin_connect_button.png" alt="Sign 
				in with LinkedIn"/>
			</a>';
		}
	}

	function accept_url()
	{
		echo 'accept_url function';
	}

	function cancel_url()
	{
		echo 'cancel_url function';
	}

	function get_profile_data($access_token = '')
	{
		$url    = 'https://api.linkedin.com/v2/me?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))';
		$param = '';
		$headers  = 'Authorization: Bearer ' . $access_token;
		$response = (json_decode($this->post_curl($url, $param, $headers), true));
		return $response;
	}

	function post_curl($url, $param = "", $headers)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($headers));
		curl_setopt($ch, CURLOPT_URL, $url);
		if ($param != "") curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	function get_token($url, $param = "")
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if ($param != "") curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	function post_curl_content($url, $body = "", $headers)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,            $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST,           1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,     $body);
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array($headers, 'Content-Type: application/json', 'x-li-format: json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
	}

	function save_registration($data_array = array())
	{
		$this->load->model('registermodel');

		$id = '';
		$course_id = '';
		$company_id = '';

		if (isset($_SESSION['job_code']) && $_SESSION['job_code'] != '') {
			$this->data['job_details'] = $this->homemodel->job_details_by_key($_SESSION['job_code']);

			if (count($this->data['job_details']) > 0) {
				$this->db->where('username', $data_array['emailAddress']);
				$query = $this->db->get('pms_candidate');
				$row = $query->row_array();

				if (count($row) == 0) {
					$data = array(
						'username'         => $data_array['emailAddress'],
						'password'         => md5('reset123'),
						'first_name'       => $data_array['firstName'],
						'last_name'        => $data_array['lastName'],
						'mobile'           => '',
						'reg_date'         => date("Y-m-d"),
						'lead_source'      => 1,
						'reg_status'       => 1,
						'lead_opportunity' => 1,
						'allow_mobile'     => 1
					);
					$id = $this->registermodel->insert_candidate_from_linkedin($data);
				} else {
					$id = $row['candidate_id'];
				}
			}

			$data = array(
				'job_id' => $this->data['job_details']['job_id'],
				'candidate_id' => $id,
				'applied_on'  => date('Y-m-d'),
				'app_status_id'  => 1,
				'admin_id'   => '',
			);
			$this->db->insert('pms_job_apps', $data);

			// create company or take company id from existing	
			if (isset($data_array['positions']['values']) && is_array($data_array['positions']['values'])) {
				foreach ($data_array['positions']['values'] as $key => $val) {
					$this->db->where('company_name', $val['company']['name']);
					$query = $this->db->get('pms_company');

					$row_company = $query->row_array();
					if (count($row_company) == 0) {
						$data_company = array(
							'company_name'    => $val['company']['name'],
							'company_size'    => '0'
						);
						$this->db->insert('pms_company', $data_company);
						$company_id = $this->db->insert_id();
					} else {
						$company_id = $row_company['company_id'];
					}
					// create job profile
					if ($company_id != '') {
						$data_designation = array(
							'company_id'       => $company_id,
							'organization'     => $val['company']['name'],
							'designation'      => $val['title'],
							'candidate_id'     => $id,
						);
						$this->db->insert('pms_candidate_job_profile', $data_designation);
					}
				} // loop ends here
			}
		}
	}
}
