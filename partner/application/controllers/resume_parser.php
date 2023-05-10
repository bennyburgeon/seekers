<?php
class Resume_parser extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	}
	
	function RplusAPI($filename, $rfile)
	{	
		$url ="http://rplusparserapi.parseresume.com/rPlusParseResume.asmx?WSDL";
		$secret_key = '0AnDseYCFtb3g5gq'; 
		//$cv_xml_folder = $_SERVER["DOCUMENT_ROOT"]
	
		$server = new SoapClient($url, array('encoding'=>'utf-8','exceptions' => true,'trace' => 1));
		$FilesName = $cv_xml_folder . $rfile . '.xml' ;
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		$base64 =  base64_encode($contents);
		fclose($handle);
		
		$explodemainfilename = explode(".",$filename);
		$countmainexplode = count($explodemainfilename);
		$filterfile = $explodemainfilename[$countmainexplode-1] ;
		
		if($filterfile == "doc")
		{
			$RawXML = $server->Get_HRXML(array("B64FileZippedContent"=>$base64, "FileName"=>$filename,"UserID"=>1,"secretKey"=>$secret_key));
			$RawXML = $RawXML->Get_HRXMLResult;
		}
		else if($filterfile == "docx")
		{
			$RawXML = $server->GetHRXML(array("B64FileZippedContent"=>$base64, "FileName"=>'abc.docx', "InputType"=>'.docx',"UserID"=>1,"secretKey"=>$secret_key));
			$RawXML = $RawXML->GetHRXMLResult;
		}
		else if($filterfile == "rtf")
		{
			$RawXML = $server->GetHRXML(array("B64FileZippedContent"=>$base64, "FileName"=>'abc.rtf', "InputType"=>'.rtf',"UserID"=>1,"secretKey"=>$secret_key));
			$RawXML = $RawXML->GetHRXMLResult;
		}
		else if($filterfile == "pdf")
		{
			$RawXML = $server->GetHRXML(array("B64FileZippedContent"=>$base64, "FileName"=>'abc.pdf', "InputType"=>'.pdf',"UserID"=>1,"secretKey"=>$secret_key));
			$RawXML = $RawXML->GetHRXMLResult;
		}
		else if($filterfile == "html")
		{
			$RawXML = $server->GetHRXML(array("B64FileZippedContent"=>$base64, "FileName"=>'abc.html', "InputType"=>'.html',"UserID"=>1,"secretKey"=>$secret_key));
			$RawXML = $RawXML->GetHRXMLResult;
		}
		else if($filterfile == "txt")
		{
			$RawXML = $server->GetHRXML(array("B64FileZippedContent"=>$base64, "FileName"=>'abc.txt', "InputType"=>'.txt',"UserID"=>1,"secretKey"=>$secret_key));
			$RawXML = $RawXML->GetHRXMLResult;
		} 
	
		// Process to save the XML File
		$doc = new DOMDocument();
		$doc->loadXML($RawXML);
		$doc->saveXML();
		$doc->save("$FilesName");              
	
	}

	function parse_cv()
	{
		$res = $this->RplusAPI('abc.doc', 'uploads/test.xml') ; 
	}	
}

?>		