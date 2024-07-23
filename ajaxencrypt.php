<?php
//echo 'jaypal';die;
include "inc.php";
function decodeaes($encoded)
{
    $encoded = base64_decode($encoded);
    $decoded = "";
    for ($i = 0; $i < strlen($encoded); $i++) {
        $b = ord($encoded[$i]);
        $a = $b ^ 10;
        $decoded .= chr($a);
    }
    return base64_decode(base64_decode($decoded));
}
 $userJS = decodeaes($_POST['userId']); //echo '<br>';
 $passwordJS = decodeaes($_POST['password']);

 $useraes = encryptData($userJS, $key, $iv);
 $passwordaes = encryptData($passwordJS, $key, $iv); 
 $responseData = array(
    "useraes" => $useraes,
    "passwordaes" => $passwordaes
); 
//header('Content-Type: application/json');
// Encoding the array to a JSON string and echoing it
echo json_encode($responseData);
 //echo $decryptedUsername = decryptData($useraes, $key, $iv);
 //echo $decryptedPAss = decryptData($passwordaes, $key, $iv);

 // echo  'decryptedResponsedd--- '. $decryptedData = decryptData($encryptedData, $keytinfc, $ivtinfc); 


