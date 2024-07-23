<?php 
include "inc.php"; 
/* sso start */
$deleteRequest = '{
                    "loginId": "' . $_SESSION["userId"] . '",  
                    "appId": "'.$appId.'",         
                    "sessionToken": "' . $_SESSION['sessionToken'] . '"
                    }';
          /* sso start */         

//print_r($response_data);die;

session_regenerate_id();
error_reporting(0); 
unset($_SESSION['sessionid']); 
session_destroy(); 
//echo $deleteRequest;
$response_data =    sendPostRequest($apiUrlDelete, $deleteRequest);
//print_r($response_data);die;
header('Location: login'); 
exit;  
?>