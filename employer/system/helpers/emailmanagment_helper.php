<?php

/**
 * Mail Settings
 *
 * @access	Global
 * @param	string ,String,string ,String,string ,String,string
 * @return	boolean
 */
function send_mails($to,$subject,$message,$headers,$cc='',$bcc='',$filetoattach='',$sendarname){
	//print_r($filetoattach);die;
	$CI = get_instance();	
	/*if(HOWTO_SENDMAIL=='mail'){
	$config = Array(
			'protocol' =>  HOWTO_SENDMAIL,
			'smtp_host' => SMTPHOST,
			'smtp_port' => 465,
			'smtp_user' => SMTPUSERNAME,
			'smtp_pass' => SMTPPASSWORD,
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1',
			'wordwrap'=> true,
		);
		$CI->load->library('email', $config);	
	}else{	
		$CI->load->library('email');
	}*/

	$CI->load->library('email');
	
	$CI->email->set_newline("\r\n");
	//$CI->email->from(SENDER_EMAIL_ADDRESS, SENDER_NAME);
	$CI->email->from($headers,$sendarname);
	//$CI->email->from('noreply@coursedirectory.com', 'Course Directory');
	$CI->email->to($to); 
	if(!empty($cc)){
		$CI->email->cc($cc); 
	}else{
		//$CI->email->cc(ADMIN_EMAIL_ADDRESS); 
	}
	if(!empty($bcc)){
		$CI->email->bcc($bcc); 
	}	
	$CI->email->subject($subject);
	$CI->email->message($message);
	if(!empty($filetoattach) && count($filetoattach)>0){
		foreach($filetoattach as $file){
			$attach=FCPATH.'server/php/files/' .$file;
			$CI->email->attach($file);
			print_r($file);
		}
	}
	if($CI->email->send())
	{
		return true;
	}
	else
	{
		return show_error($CI->email->print_debugger());
	}
}

//function send_mails_new($to, $subject, $from, $message, $headers, $cc = '', $bcc = '', $filetoattach = '', $sendarname) {
function send_mails_new($to, $from, $subject, $message, $files = array(),$bcc = '',$cc = '') {

//print_r($files);die;
    $htmlbody = $message;
    //$to = "name@domain.com"; //Recipient Email Address
    //$subject = "Test email with attachment"; //Email Subject
    $headers = "From: $from\r\nReply-To: $from";
    $random_hash = md5(date('r', time()));
    $headers .= "\r\nContent-Type: multipart/mixed; 
                boundary=\"PHP-mixed-" . $random_hash . "\"";
	//$headers  = 'MIME-Version: 1.0' . "\r\n";
		//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	if($bcc != ''){ 
	$headers .= "Bcc:".$bcc;
	}
	if($cc != ''){
	$headers .= "CC:".$cc;
	}
    
    $message = "--PHP-mixed-$random_hash\r\n" . "Content-Type: multipart/alternative; 
                boundary=\"PHP-alt-$random_hash\"\r\n\r\n";
    //define the body of the message.
    $message .= "--PHP-alt-$random_hash\r\n" . "Content-Type: text/html; 
                charset=\"iso-8859-1\"\r\n" . "Content-Transfer-Encoding: 7bit\r\n\r\n";

    //Insert the html message.
    $message .= $htmlbody;
    $message .="\r\n\r\n--PHP-alt-$random_hash--\r\n\r\n";
	
    if(is_array($files) && count($files) > 0){
		foreach ($files as $key=>$file){
				// Set your file path here
			//$attachment = chunk_split(base64_encode(file_get_contents('http://isc.stuorg.iastate.edu/wp-content/uploads/sample.jpg')));
			$attachment = chunk_split(base64_encode(file_get_contents($file)));
			
			$fileName = basename($file);
			//include attachment
			$message .= "--PHP-mixed-$random_hash\r\n" . "Content-Type: application/octet-stream; 
						name=\"$fileName\"\r\n" . "Content-Transfer-Encoding: base64\r\n" 
					  . "Content-Disposition: attachment\r\n\r\n";
	
			$message .= $attachment;
			
		}
	}    
    $message .= "/r/n--PHP-mixed-$random_hash--";


//send the email
    $mail = mail($to, $subject, $message, $headers);

	if($mail)
		return true;
	else
		return false;
   
}

function getDateFormat($date) {
    $today = strtotime('Y-m-d');
    $givendate = strtotime($date);
    if ($today == $givendate) {
        return date('H:i A');
    } elseif ($today == $givendate) {
        return date('F d', $givendate);
    } else {
        return date('m/d/Y', $givendate);
    }
}

function getDateTimeFormat($date) {
    $today = time();
    if ($today == $date) {
        return date('H:i A');
    } elseif ($today == $date) {
        return date('F d', $date);
    } else {
        return date('m/d/Y', $date);
    }
}

function getToName($toname, $param = true) {
    $toemail = explode(',', $toname);
    $array = array();
    foreach ($toemail as $email) {
        if ($param) {
            $array[] = '<a title="' . $email . '">' . strstr($email, "@", true) . '</a>';
        } else {
            $array[] = strstr($email, "@", true);
        }
    }
    return implode(',', $array);
}

function getToName1($toname, $param = true) {
    $toemail = explode(',', $toname);
    $array = array();
    foreach ($toemail as $email) {
        if ($param) {
            $array[] = '<a title="' . $email . '">' . strstr($email, "@", true) . '</a>';
        } else {
            $array[] = strstr($email, "@", true) . '&#60;' . $email . '&#62;';
        }
    }
    return implode(',', $array);
}

function formatbytes($file, $type) {
    switch ($type) {
        case "KB":
            $filesize = filesize($file) * .0009765625; // bytes to KB
            break;
        case "MB":
            $filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB
            break;
        case "GB":
            $filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB
            break;
    }
    if ($filesize <= 0) {
        return $filesize = 'unknown file size';
    } else {
        return round($filesize, 2) . ' ' . $type;
    }
}

?>