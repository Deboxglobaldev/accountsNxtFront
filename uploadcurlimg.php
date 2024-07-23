<?php
include("inc.php");
include "logincheck.php";
include 'CommonFiles/Liberary/vendor7/autoload.php';

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
$ErrorMessage = "[Error] - File location ".$_SERVER['PHP_SELF']." Message:- " ;


logger($InfoMessage."*********FILE UPLOAD STARTS IMAGE  WISE*********");

$filecount = count($_FILES['doc_other']['name']);
logger($InfoMessage." Total File count :  ".$filecount);

logger($InfoMessage."DATA SENT VIA POST: ".json_encode($_POST).' & ITS PRODUCT TYPE: '.$_GET['ProductType']);
// Set postdata array
$postData ='';

if($_REQUEST["ProductType"]=="PAN"){
	$url = $serverurlapi."BulkUpload/bulkaction_img.php";
	$target = $targetImagePath.'panimages/';
}

if($_REQUEST["ProductType"]=="TAN"){
	$url = $serverurlapi."BulkUpload/bulkactiontan_img.php";
	$target = $targetImagePath.'tanimages/';
}

if(copy($_FILES["doc_0"]['tmp_name'], $target.$_REQUEST['aid'].'_0.jpg')){
	logger('Copy doc_0 Success: ');
}else{
	logger('Copy doc_0 Failed: ');
}

if(copy($_FILES["doc_1"]['tmp_name'], $target.$_REQUEST['aid'].'_1.jpg')){
		logger('Copy doc_1 Success: ');
	}else{
		logger('Copy doc_1 Failed: ');
	}

if($_GET['FormType']=="49A" || $_GET['FormType']=="49AA"){
	$seq = 3;
	if(copy($_FILES["doc_2"]['tmp_name'], $target.$_REQUEST['aid'].'_2.jpg')){
		logger('Copy doc_2 Success: ');
	}else{
		logger('Copy doc_2 Failed: ');
	}
}else{
	$seq = 2;
}









logger($InfoMessage."*******Loop Starts From Here doument other****** ");   
for($i=0; $i<$filecount; $i++){
	//post array data
	
	
	$file = $_FILES["doc_other"]['tmp_name'][$i];
	$mimeType = $_FILES["doc_other"]['type'][$i];
	$fname = $_FILES["doc_other"]['name'][$i];
	
	//$name = explode('.',$fname);
	$namecount = $seq+$i;
	$basename = $_REQUEST['aid'].'_'.$namecount.'.jpg';
	
	
	
	//Copy pdf file to upolads
	if(copy($file, $target.$basename)){
		logger('Copy Success: '.$basename);
	}else{
		logger('Copy Failed: '.$basename);
	}
	
	
	
}
logger($InfoMessage."*********FILE UPLOAD ENDS doument other*********");

$postData = ['UserType' => strtoupper($_SESSION["Type"]), 'UserId' => strtoupper($_SESSION["UID"]), 'ip' => $_SERVER["REMOTE_ADDR"], 'RegionId' => $_SESSION["REGIONID"], 'BranchId' => $_SESSION["branchId"], 'uploadType' => $_SESSION["DIGIFlAG"], 'fileName' => $_REQUEST["aid"],'CurrentFileUpload' => '1'];
	
	//$headers = array("Content-Type" => "multipart/form-data");
	
	//Curl to send data
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$url);
	curl_setopt($curl_handle, CURLOPT_POST, TRUE);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);
	echo $returned_data = curl_exec($curl_handle);
	
	/*if(!curl_errno($curl_handle))
	{
		$info = curl_getinfo($curl_handle);
		if ($info['http_code'] == 200)
			$errmsg = 'File uploaded successfully';
			echo $returned_data;
			
	}
	else
	{
		$errmsg = curl_error($curl_handle);
		$namearr = explode('.',$basename);
		echo $returned_data = json_encode(['AckNumber'=>$namearr[0],'status'=>'Non-Complience','remark'=>'Unable to pass the Color Toll-Gate','SequenceNo'=>$_POST['CurrentFileUpload']], JSON_PRETTY_PRINT);
	}*/

	logger($InfoMessage." Return Value from API :  ".$returned_data);
	logger($InfoMessage." Response Curl message :  ".$errmsg.' and status code: '.$info['http_code']);
	logger($InfoMessage."*******Loop Ends Here****** ");   
	
	curl_close($curl_handle);
	
?>