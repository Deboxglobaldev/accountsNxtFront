<?php
//get url
set_time_limit(0);
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
$voucherCount = [];
$tempVoucher = '';
for($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) {
    $TempVouchNo = trim(addslashes($data->sheets[0]["cells"][$x][1]));
    $SubLedgerID = trim(addslashes($data->sheets[0]["cells"][$x][3]));
    $ProductCode = trim(addslashes($data->sheets[0]["cells"][$x][4]));
    $VouchDate = trim(addslashes($data->sheets[0]["cells"][$x][5]));
  ////Date less 1 day 
    $date = DateTime::createFromFormat('d/m/Y', $VouchDate);
    $returndate = $date->format('d-m-Y');
    $date = new DateTime($returndate); // For today/now, don't pass an arg.
    $date->modify("-1 day");
    $VouchDate = $date->format("Y-m-d");


    $DrAmt = trim(addslashes($data->sheets[0]["cells"][$x][6]));
    $CrAmt = trim(addslashes($data->sheets[0]["cells"][$x][7]));
    $ChequeNo = trim(addslashes($data->sheets[0]["cells"][$x][8]));
    $ChequeDate = trim(addslashes($data->sheets[0]["cells"][$x][9]));
    $Narration = trim(addslashes($data->sheets[0]["cells"][$x][10]));
  
    if($tempVoucher!=$TempVouchNo){
      $tempVoucher = $TempVouchNo;
      array_push($voucherCount,$tempVoucher);
    }
    
    $VoucherDataList .= '{
      "TempVouchNo" : "'.$TempVouchNo.'",
      "SubLedgerID" : "'.$SubLedgerID.'",
      "ProductCode" : "'.$ProductCode.'",
      "VouchDate" : "'.$VouchDate.'",
      "DrAmt" : "'.$DrAmt.'",
      "CrAmt" : "'.$CrAmt.'",
      "ChequeNo" : "'.$ChequeNo.'",
      "ChequeDate" : "'.$ChequeDate.'",
      "Narration" : "'.$Narration.'"

    },';
    
}

 $jsonData = '{
  "UserId" : "'.$_SESSION["UID"].'",
  "ip":"'.$_SERVER["REMOTE_ADDR"].'",
  "VoucherCount" : "'.count($voucherCount).'",
  "JsonData" : ['.rtrim($VoucherDataList,',').']
}';

$postURL = $serverurlapi."General/voucherImportAPI.php";
logger('POST URL: '.$postURL);
logger('Json post data voucher import: '.$jsonData);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $postURL,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$jsonData,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


logger('responce return from voucher import api: '.$response);
/*echo $result = '{
  "Status" : "true",
  "Total Record" : 150,
  "Successfull" : 125,
  "Failed" : 25
}';*/

}
?>