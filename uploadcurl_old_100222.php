<?php
include("inc.php");
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
$ErrorMessage = "[Error] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

logger($InfoMessage."*********FILE UPLOAD STARTS*********");

$filecount = count($_FILES['attachment']['name']);
//logger($InfoMessage." Total File count :  ".$filecount);
logger($InfoMessage."DATA SENT VIA POST: ".json_encode($_POST).' & ITS PRODUCT TYPE: '.$_GET['ProductType']);
// Set postdata array
$postData ='';
logger($InfoMessage."*******Loop Starts From Here****** ");   
for($i=0; $i<$filecount; $i++){
	//post array data
	$postData = ['UserType' => strtoupper($_SESSION["Type"]), 'UserId' => strtoupper($_SESSION["UID"]), 'RegionId' => $_SESSION["REGIONID"], 'BranchId' => $_SESSION["branchId"], 'uploadType' => $_SESSION["DIGIFlAG"], 'TotalFileUpload' => $_POST["TotalFileUpload"], 'CurrentFileUpload' => $_POST["CurrentFileUpload"]];
	
	$file = $_FILES["attachment"]['tmp_name'][$i];
	$mimeType = $_FILES["attachment"]['type'][$i];
	$basename = $_FILES["attachment"]['name'][$i];
	$postData['file[0]'] = curl_file_create(
		realpath($file),
		$basename,
		basename($basename)
	);
	//logger($InfoMessage."File details for ".$i." - RealPath:  ".realpath($file).'----TempName: '.$file.'----BaseName: '.basename($basename).' & ERROR IS: '.$_FILES["attachment"]['error'][$i]);
    


	logger($InfoMessage."Send File Array TO JSON: ".json_encode($postData));

	//$headers = array("Content-Type" => "multipart/form-data");
	if($_REQUEST["ProductType"]=="PAN"){
		$url = $serverurlapi."BulkUpload/bulkaction.php";
	}
	
	if($_REQUEST["ProductType"]=="TAN"){
		$url = $serverurlapi."BulkUpload/bulkactiontan.php";
	}
	
	logger($InfoMessage." API URL :  ".$url);

	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$url);
	//curl_setopt($curl_handle, CURLOPT_HTTPHEADER, [
	//    'Content-Type: multipart/form-data'
	//]);
	curl_setopt($curl_handle, CURLOPT_POST, TRUE);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
	$returned_data = curl_exec($curl_handle);

	if(!curl_errno($curl_handle))
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
	}

	logger($InfoMessage." Return Value from API :  ".$returned_data);
	logger($InfoMessage." Response Curl message :  ".$errmsg.' and status code: '.$info['http_code']);
	logger($InfoMessage."*******Loop Ends Here****** ");   
	
}
	
	
	logger($InfoMessage."*********FILE UPLOAD ENDS*********");
	curl_close($curl_handle);
	
?>