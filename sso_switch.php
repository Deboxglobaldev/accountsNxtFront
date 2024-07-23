<?php
include "inc.php";
if(empty($_SESSION['jwtauthToken'])){
    header('Location: index.php');
}
$authToken = $_SESSION['jwtauthToken'];
$userId = $_SESSION['userId'];
$plainRequest = '{
"loginId": "' . $userId . '",
"appId" : "'.$appId.'",
"newAppId": "'.$appIdtinfc.'",
"jwtToken": "' . $authToken . '"
}';
try {
    $encryptedResponse = sendLoginRequest($plainRequest, $key, $iv, $apiUrlV2);
    //echo 'encryptedResponse--- ' . $encryptedResponse;
    $decryptedResponse = handleResponse($encryptedResponse, $key, $iv);
    //$authTokenV2 = $decryptedResponse['authToken'];
     //print_r($decryptedResponse);  die;  
    if ($decryptedResponse['authToken']) {
        // echo 'redirect-------url '. $decryptedResponse['authToken'];
        $urlValues = '{
            "loginId": "' . $userId . '",           
            "sessionToken": "' . $decryptedResponse['authToken'] . '"
            }';
        // Encrypt the data
        $encryptedData = encryptData($urlValues, $keytinfc, $ivtinfc);
        //echo "Encrypted ddd: " . $encryptedData . "\n";
        // echo  'decryptedResponsedd--- '. $decryptedData = decryptData($encryptedData, $keytinfc, $ivtinfc);      
        session_destroy();
       //$url = $tinfcURL . '?key=' . $encryptedData;die;
        //die;
        header('Location: ' . $tinfcURL . '?key=' . $encryptedData);
    }
    else{
        echo $decryptedResponse['message']; 
        // Redirecion need to do 
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
