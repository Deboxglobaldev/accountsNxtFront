<?php
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." data post from ajax ".$_REQUEST['form'].$_REQUEST['product'].$_REQUEST['id'].$_REQUEST['RejectionReason']); 

$editId = $_REQUEST['id'];
$RejectionReason = $_REQUEST['RejectionReason'];

$jsonPost = '{
		"id":"'.$editId.'",
		"RejectionReason":'.$RejectionReason.'
}';



logger("JSON to post for rejection reason form ----".$jsonPost);
$urlPost = $serverurlapi."General/saveRejectionReason.php";
$chp = curl_init();
curl_setopt($chp, CURLOPT_URL,$urlPost);
curl_setopt($chp, CURLOPT_POST,1);
curl_setopt($chp, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
echo $response = curl_exec($chp); 
curl_close($chp);
$res = json_decode($response);



?>