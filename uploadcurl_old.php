<?php
include("inc.php");
session_start();
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
$ErrorMessage = "[Error] - File location ".$_SERVER['PHP_SELF']." Message:- " ;


//$fileName = array();
//$tempFileName = array();
//$mimeType = array();
//$image_upload_val = array();
//print_r($_FILES); die;
// Count total files
//$uploadPath = 'uploads/';
$filecount = count($_FILES['attachment']['name']);
logger($InfoMessage." Total File count :  ".$filecount);
logger($InfoMessage." Json of files: ".json_encode($_FILES['attachment']['name']));

// Set postdata array
$postData = ['UserType' => strtoupper($_SESSION["Type"]), 'UserId' => strtoupper($_SESSION["UID"]), 'RegionId' => $_SESSION["REGIONID"], 'BranchId' => $_SESSION["branchId"], 'uploadType' => $_GET["action"]];
for($i=0; $i<$filecount; $i++){
logger($InfoMessage." Inside for loop to post file :  ".$i."....".$_GET['action']);
   //$fileName[] = $_FILES["attachment"]['name'][$i];
   //$tempFileName[] = $_FILES["attachment"]['tmp_name'][$i];
   //$mimeType[] = $_FILES["attachment"]['type'][$i];
   $file = $_FILES["attachment"]['tmp_name'][$i];
   $mimeType = $_FILES["attachment"]['type'][$i];
   $basename = $_FILES["attachment"]['name'][$i];
  	$postData['file[' . $i . ']'] = curl_file_create(
        realpath($file),
        $basename,
        basename($basename)
    );
	//logger($InfoMessage."File details for ".$i." - RealPath:  ".realpath($file).'----TempName: '.$file.'----BaseName: '.basename($basename).' & ERROR IS: '.$_FILES["attachment"]['error'][$i]);
   //copy($_FILES['attachment']['tmp_name'][$i], $uploadPath.$_FILES["attachment"]['name'][$i]);
   
   /*$request = curl_init('http://192.168.210.82/BulkUpload/uploads/panpdf/');
	// send a file
	curl_setopt($request, CURLOPT_POST, true);
	curl_setopt(
		$request,
		CURLOPT_POSTFIELDS,
		array(
		  'file' => '@' . realpath($_FILES["attachment"]['tmp_name'][$i])
		));
	
	curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
	echo curl_exec($request);
	
	curl_close($request);*/
	
	
} 
logger($InfoMessage."*******Loop Ends Here****** ");   
//print_r($image_upload_val);
//$postField = array();
//$postFields['user'] = $user; //postdata

/*foreach ($tempFileName as $index => $file) {
  if (function_exists('curl_file_create')) { // For PHP 5.5+
    $file = curl_file_create($file, $mimeType[$index], $fileName[$index]);
   logger($InfoMessage." Curlfile -- ".$fileName[$index]);
  }else{
    $file = '@' . realpath($file);
  }
  $postFields["upload_file_$index"] = $file;
}*/

logger($InfoMessage."Send File Array TO JSON: ".json_encode($postData));

$headers = array("Content-Type" => "multipart/form-data");

$url = $serverurlapi."BulkUpload/bulkaction.php?action=bulkupload";
logger($InfoMessage." API URL :  ".$url);

$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL,$url);
//curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_handle, CURLOPT_POST, TRUE);
curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $postData);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);

$returned_data = curl_exec($curl_handle);


logger($InfoMessage." Return Value from API :  ".$returned_data);

if(!curl_errno($curl_handle))
{
	$info = curl_getinfo($curl_handle);
	if ($info['http_code'] == 200)
		$errmsg = 'File uploaded successfully';
}
else
{
	$errmsg = curl_error($curl_handle);
}
logger($InfoMessage." Response Curl message :  ".$errmsg.' and status code: '.$info['http_code']);

curl_close($curl_handle);
echo $returned_data;

?>