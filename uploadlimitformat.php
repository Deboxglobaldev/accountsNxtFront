<?php
//get url
include "inc.php";
include "logincheck.php";
require_once 'reader.php';


if($_POST['action']=="importfiledata"){
$file_name=$_FILES['attachmentFile']['name'];
$file_name= $file_name;
copy($_FILES['attachmentFile']['tmp_name'],"uploads/".$file_name);
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$path="uploads/".$file_name;
$data->read($path);


$VoucherDataList = '';
for($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) {
    $BranchCode = trim(addslashes($data->sheets[0]["cells"][$x][1]));
    $SecurityDepositAmount = trim(addslashes($data->sheets[0]["cells"][$x][2]));
    $LimitApproved = trim(addslashes($data->sheets[0]["cells"][$x][3]));
    $OtherAmountonhold = trim(addslashes($data->sheets[0]["cells"][$x][4]));
  
    $VoucherDataList .= '{
      "BranchCode" : "'.$BranchCode.'",
      "SecurityDepositAmount" : "'.$SecurityDepositAmount.'",
      "LimitApproved" : "'.$LimitApproved.'",
      "OtherAmountonhold" : "'.$OtherAmountonhold.'"
    },';
    
}

 $jsonData = '{
  "UserId" : "'.$_SESSION['UID'].'",
  "JsonData" : ['.rtrim($VoucherDataList,',').']
}';

$postURL = $serverurlapi."General/limituploadAPI.php";
logger('POST URL: '.$postURL);
//logger('Json post data limit import: '.$jsonData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$postURL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length:' . strlen($jsonData)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
echo $result = curl_exec($ch);
logger('responce return from Limit import api: '.$result);
/*echo $result = '{
  "Status" : true,
  "Total Record" : 150,
  "Successfull" : 125,
  "Failed" : 25
}';*/

}
?>