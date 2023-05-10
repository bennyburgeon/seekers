<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name:  FPDF
 * 
 * Author: Jd Fiscus
 * 	 	  jdfiscus@gmail.com
 *         @iamfiscus
 *          
 *
 * Origin API Class: http://www.fpdf.org/
 * 
 * Location: http://github.com/iamfiscus/Codeigniter-FPDF/
 *          
 * Created:  06.22.2010 
 * 
 * Description:  This is a Codeigniter library which allows you to generate a PDF with the FPDF library
 * 
 */
class imapemail {

    public function __construct($params = array()) {//print_r($params);
        $reqPath = '.' . $_SERVER['DOCUMENT_ROOT'] . '/' . APPPATH . 'libraries/ImapMailbox.php';
        $reqPath = './' . APPPATH . 'libraries/ImapMailbox.php';

        require_once($reqPath); //BASEPATH
        //print_r($params);die;
        /*
          To get email from gmail server
          define('GMAIL_EMAIL', 'some@gmail.com');
          define('GMAIL_PASSWORD', '*********');
          define('ATTACHMENTS_DIR', dirname(__FILE__) . '/attachments');

          $mailbox = new ImapMailbox('{imap.gmail.com:993/imap/ssl}INBOX', GMAIL_EMAIL, GMAIL_PASSWORD, ATTACHMENTS_DIR, 'utf-8');
         */

        define('HOST', '{'.$params['smtp_incoming_server'].'}INBOX');
        define('EMAIL',$params['smtp_username']);
        define('PASSWORD',$params['smtp_password']);		
        //define('ATTACHMENTS_DIR', $_SERVER['DOCUMENT_ROOT'] . '/mylandlord.in/users/uploads/attachment');
        define('ATTACHMENTS_DIR', false);

        //define('ATTACHMENTS_DIR','');		

        try {
		    //$mailbox = new ImapMailbox();
            $mailbox = new ImapMailbox(HOST, EMAIL, PASSWORD, ATTACHMENTS_DIR, 'utf-8');
        } catch (Exception $e) {
            echo '<pre>';
            print_r($e);
            die;
        }

        $CI = & get_instance();
        $CI->mailbox = $mailbox;
    }

}
