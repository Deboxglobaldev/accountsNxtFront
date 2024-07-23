<?php
ob_start();
session_start();
$systemName = "Accounts System | Debox Global";
include 'function.php';
error_reporting(0);

// Program to display URL of current page.
if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='127.0.0.1'){
  $serverurl = "http://";
  $serverurl .= $_SERVER['HTTP_HOST'];
  $serverurl .= "/ReligarePAN/Code/";
  $serverurlapi = "http://".$_SERVER['HTTP_HOST']."/Accounts/";
}else{
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
    $serverurl = "https://";
  }else{
    $serverurl = "http://";
  }

  $serverurl .= $_SERVER['HTTP_HOST'];
  $serverurl .= "/frontend/Accounts/";
  $serverurlapi = $_SERVER['HTTP_HOST']."/backend/";
  //$mountImagePath = "/u01/";
  //$targetImagePath = $mountImagePath."uploads_uat/";

}

/* SSO config Start*/
$apiUrl = 'http://ssouat.religareonline.com:4000/api/v1/user/login';
$apiUrlV2 = 'http://ssouat.religareonline.com:4000/api/v1/user/loginV2/app';
$apiUrlValidate = 'http://ssouat.religareonline.com:4000/api/v1/session/validate';
$apiUrlDelete = 'http://ssouat.religareonline.com:4000/api/v1/session/delete';

$tinfcURL = 'https://tinuat.religareonline.com/TINFC5/wpgSSOLogin.aspx';
$digipayURL = 'digipayurl';
$appId = 'app15';
$appIdtinfc = 'app14';
$appIddigipay = 'app13';

// The secret key and IV
$secretKey = "debox-secret-123";
$secretIV = "debox-secretIV-123";
$key = substr(hash('sha256', $secretKey, true), 0, 32);
$iv = substr(hash('md5', $secretIV, true), 0, 16);


//// tinfc keys
$secretKeytinfc = "tinfc-secret-288";
$secretIVtinfc = "tinfc-secretIV-288";
$keytinfc = substr(hash('sha256', $secretKeytinfc, true), 0, 32);
$ivtinfc = substr(hash('md5', $secretIVtinfc, true), 0, 16);


/// digipay keys
$secretKeydigipay = "digipay-secret-123";
$secretIVdigipay = "digipay-secretIV-123";
$keydigipay = substr(hash('sha256', $secretKeydigipay, true), 0, 32);
$ivdigipay = substr(hash('md5', $secretIVdigipay, true), 0, 16);


/* SSO Config End */
function imageResize($imageSrc,$imageWidth,$imageHeight,$imgType) {

  if($imgType=="Photo"){
    $newImageWidth =204;
    $newImageHeight =204;
  }else{
    $newImageWidth =333;
    $newImageHeight =137;
  }
    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
}


?>
