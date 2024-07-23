<?php
include("inc.php");
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
$ErrorMessage = "[Error] - File location ".$_SERVER['PHP_SELF']." Message:- " ;


//$fileName = array();
//$tempFileName = array();
//$mimeType = array();

// Count total files
$filecount = count($_FILES['attachment']['name']);
logger($InfoMessage." Total File count :  ".$filecount);
// Set postdata array
$postData = ['UserType' => strtoupper($_SESSION["Type"]), 'UserId' => strtoupper($_SESSION["UID"]), 'RegionId' => $_SESSION["REGIONID"], 'BranchId' => $_SESSION["branchId"], 'uploadType' => $_GET["action"]];
for($i=0; $i<$filecount; $i++){
   //$fileName[] = $_FILES["attachment"]['name'][$i];
  // $tempFileName[] = $_FILES["attachment"]['tmp_name'][$i];
  // $mimeType[] = $_FILES["attachment"]['type'][$i];
  $file = $_FILES["attachment"]['tmp_name'][$i];
   $mimeType = $_FILES["attachment"]['type'][$i];
   $basename = $_FILES["attachment"]['name'][$i];
  	$postData['file[' . $i . ']'] = curl_file_create(
        realpath($file),
        $basename,
        basename($basename)
    );
} 

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
$headers = array("Content-Type" => "multipart/form-data");

$url = $serverurlapi."BulkUpload/bulkactiontan.php?action=bulkupload";
logger($InfoMessage." API URL :  ".$url);

$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL,$url);
//curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_handle, CURLOPT_POST, TRUE);
curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $postData);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);

$returned_data = curl_exec($curl_handle);
logger($InfoMessage." Return Value from API :  ".$returned_data);

curl_close($curl_handle);
echo $returned_data;

?>