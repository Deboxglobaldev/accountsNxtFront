<?php
//get url
include "inc.php";
include "logincheck.php";
require_once 'reader.php';
ini_set('display_errors', 0); 

if($_POST['action']=="import"){
$file_name=$_FILES['attachmentFile']['name'];
$file_name= $file_name;
copy($_FILES['attachmentFile']['tmp_name'],"uploads/".$file_name);
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$path="uploads/".$file_name;
$data->read($path);

$fileHeader = $data->sheets[3]["cells"][1];

//creating csv file name
$delimiter = ","; 
$filename = "ISR_10589762265.csv";

// Create a file  
$fd = fopen ('data/temp/envfilestoupload/'.$filename, "w");
chmod('data/temp/envfilestoupload/'.$filename, 0777);
// Set column headers
$newFileHeader = $fileHeader;
unset($newFileHeader[1]);
//logger(json_encode($newFileHeader));
$fields = array_values($newFileHeader); 
fputcsv($fd, $fields, $delimiter);


$finalAllDataJson = '';
$valforCsv = '';
for($x = 2; $x <= count($data->sheets[3]["cells"]); $x++) {
  /// JSON FOR ALL Data Store

  $headerJson = '';
  $dataValue = '';
  $Headvalue = '';
  $valforCsv = array();
  foreach($fileHeader as $key=>$value){

    $dataValue = $data->sheets[3]["cells"][$x][$key];

    if($key=='11'){
      $excel_date = $dataValue;
      $unix_date = ($excel_date - 25569) * 86400;
      $excel_date = 25569 + ($unix_date / 86400);
      $unix_date = ($excel_date - 25569) * 86400;
      $finaldate = gmdate("Y-m-d", $unix_date); 
      $dataValue=$finaldate;
    }elseif($key=='110' || $key=='111' || $key=='113'){
      $date = DateTime::createFromFormat('d/m/Y', $dataValue);
      $returndate = $date->format('d-m-Y');
      $date = new DateTime($returndate); // For today/now, don't pass an arg.
      $date->modify("-1 day");
      $dataValue = $date->format("Y-m-d");
    }else{
      $dataValue = $dataValue;
    }
    
    $Headvalue = str_replace(' ', '', $value);
    $headerJson.= '"'.$Headvalue.'":"'.$dataValue .'",';
    array_push($valforCsv,$dataValue);
  }

  //set column values
  //$cellVal = $data->sheets[3]["cells"][$x];
  $cellFieldVal = $valforCsv;
  unset($cellFieldVal[0]);
  //logger(json_encode($cellFieldVal));
  $lineData = $cellFieldVal;
  fputcsv($fd, $lineData, $delimiter); 
 
  $finalAllDataJson = '{'.rtrim($headerJson,',').'},';

  $BranchCode = trim(addslashes($data->sheets[3]["cells"][$x][1]));
  $TaxScheme = trim(addslashes($data->sheets[3]["cells"][$x][4]));
  $SupplyType = trim(addslashes($data->sheets[3]["cells"][$x][7]));
  $DocType = trim(addslashes($data->sheets[3]["cells"][$x][9]));
  $DocNumber = trim(addslashes($data->sheets[3]["cells"][$x][10]));
  $DocDate = trim($finaldate);
  $RevCFlag = trim(addslashes($data->sheets[3]["cells"][$x][12]));
  $SupplierGSTIN = trim(addslashes($data->sheets[3]["cells"][$x][13]));
  $SupplierName = trim(addslashes($data->sheets[3]["cells"][$x][15]));
  $CustomerGSTIN = trim(addslashes($data->sheets[3]["cells"][$x][23]));

  $DataList .= $finalAllDataJson;
  
}

fclose($fd);

 $jsonData = '{
  "UserId" : "'.$_SESSION['UID'].'",
  "JsonData" : ['.rtrim($DataList,',').']
}';

$postURL = $serverurlapi."General/gstuploadAPI.php";
logger('POST URL: '.$postURL);
//logger('Json post GST import: '.$jsonData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$postURL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length:' . strlen($jsonData)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo $result = curl_exec($ch);
//logger('responce return from gst import api: '.$result);

/*echo $result = '{
  "Status" : true,
  "Total Record" : 150,
  "Successfull" : 125,
  "Failed" : 25
}';*/

}
if($_POST['action']=="export"){
  $file_name=$_FILES['attachmentFile']['name'];
  $file_name= $file_name;

  // Use a correct ftp server
  $ftp_server = "apparelerp.in";
  // Use correct ftp username
  $ftp_username = 'apparelerp';
  //Use correctftp password
  $ftp_userpass = '#India@2023-ERP';

  // Establishing ftp connection
  $ftp_conn = ftp_connect($ftp_server) or die("Hello Could not connect to $ftp_server");

  if($ftp_conn){

      // Logging in to established connection
      // with ftp username password   
      $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
      ftp_pasv($ftp_conn, true);
      
      if($login){
          //file source path and name on server
          $fileExistsName = "data/temp/envfilestoupload/ISR_10589762265.csv";

          if(file_exists($fileExistsName)){
              //file destination path on server
              $uploadDirectory = "/public_html/apparelerp/env/";
              //Upload to ftp Directory path
              $remotePath = $uploadDirectory."/ISR_10589762265.csv";
              if (ftp_put($ftp_conn,$remotePath, $fileExistsName, FTP_BINARY))
              {
                  $msg = "File Exported TO ENY Successfully!";
              }
          }else{
              $msg = "File not avilable on server.";
          }
      }else{
          $msg = "Login failed on ftp.";
      }
      
  ftp_close($ftp_conn);

  }

  echo $result = '{
    "Status" : true,
    "Type" : "Export",
    "Message" : "'.$msg.'"
  }';
}
?>