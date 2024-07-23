<?php
include "inc.php";
include "logincheck.php";
$dataJson = $_POST['dataJson'];

logger("JSON POST TO ACK RECEIVING: ".$dataJson);
$urlPost = $serverurlapi."General/BunchReceivedAPI.php";
logger("URL TO HIT: ".$urlPost);
$chp = curl_init();
curl_setopt($chp, CURLOPT_URL,$urlPost);
curl_setopt($chp, CURLOPT_POST,1);
curl_setopt($chp, CURLOPT_POSTFIELDS, $dataJson);
curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
echo $response = curl_exec($chp); 
curl_close($chp);
//$res = json_decode($response);
logger("RESPONSE RETURN FROM ACK RECEIVING API: ".$response);

?>