<?php
//print_r($_POST);die;
//error_reporting('E_ALL');
//ini_set('display_errors', 1);
include "inc.php";
$params = $_REQUEST['key'];
$decryptedData = decryptData($params, $key, $iv);
//$decryptedData = decryptData('cF8zM09ObfFynHhDslWOdlhSKlOSPslvGthVaJQCvSgIiOuiZe60Tvc1lw8viSrjgXnfYuxi8Juj2QxLyxIBlfR/+AuYkRRms8xIt5f8lPUcmvXi0TSc4HMai4l6L3f753QQaH43/epBSJqiSeY8S9udE2oqffORk2hvCHj/CBUs4SKEm7rfu/46UJ7EFd++7bNvdAsJCzdWUyvt1znDyJMa6p1xzUvtM+ooaxjF7Z9ZVsMyUrjGGnb+bUumEInc3+00mnRrVnTzCSrO4n8EH3aAwKUEpJqpGeSB97twvNH50yghZji77psPwnUH+t3Xgwd/E0tqb3C+P/YePI5gAg==', $key, $iv);
//echo "Decrypted ddd: " . $decryptedData . "\n";  die;           
// Validate JSON
$jsonData = json_decode($decryptedData, true);
//print_r($jsonData);die;
$userId = $jsonData['loginId'];  //// this value will come from url
//$userId = '2553601';
$sessionToken = $jsonData['sessionToken'];

$validateRequest = '{
                    "loginId": "' . $userId . '",  
                    "appId": "'.$appId.'",       
                    "sessionToken": "' . $sessionToken . '"
                    }';
                    //echo $validateRequest;
                    //echo '<br>';
$response_data =    sendPostRequest($apiUrlValidate, $validateRequest);
//print_r($response_data);die;

//die;
$response_data['code'] = 'SC001';
if (isset($response_data['code']) && $response_data['code'] === 'SC001') {
   
    
    logger('ui ' . $userId . ' and pas ' . $password);
    $data = array(
        'userId' => $userId,
        'sso_flag' => 1
    );
    logger("Response from url data jaypal " . json_encode($data));
    $url = $serverurlapi . "General/userlogin.php";
    $result = postCurlData($url, $data);
    //var_dump($result);die;
    logger("Response from url " . $url . " is: " . $result);
    $userlogin = json_decode($result);
    //print_r($userlogin);
    //echo 'status------- '.$userlogin->Status;
    //die;
    logger("Json parting value" . $userlogin->BranchId);
    ////////// SSO started ////////////
    if ($userlogin->Status == 'Success') {
        //// Login API Call ///////
        // Define the input text
        $plainRequest = '{
"loginId": "' . $userId . '",
"appId":"' . $appId . '"
}';
        try {
            $encryptedResponse = sendLoginRequest($plainRequest, $key, $iv, $apiUrl);
            $decryptedResponse = handleResponse($encryptedResponse, $key, $iv);
            $authToken = $decryptedResponse['authToken'];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $_SESSION["jwtauthToken"] = $authToken;
    }
    $_SESSION['sessionToken'] = $jsonData['sessionToken'];
    $_SESSION["UserName"] = $userlogin->UserName;
    $_SESSION["userId"] =  $userId;
    $_SESSION["Type"] = strtoupper($userlogin->Type);
    $_SESSION["UID"] = $userlogin->Id;
    $_SESSION["REGIONID"] = $userlogin->RegionId;
    $_SESSION["DIGIFlAG"] = $userlogin->SelfDigFlag;
    $_SESSION["DIGIFlAGTAN"] = $userlogin->SelfDigFlagTan;
    $_SESSION["BID"] = $userlogin->BranchId;
    $_SESSION['sessionid'] = session_id();
    $_SESSION["ROLE"] = $userlogin->Role;
    //echo '<pre>'; print_r($_SESSION);die;
    if (strtoupper($userlogin->Type) == 'BRANCH') {
        $_SESSION["branchId"] = $userlogin->BranchId;
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == 'QCP') {
        $_SESSION["branchId"] = $userlogin->Type;
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == 'QCF') {
        $_SESSION["branchId"] = $userlogin->Type;
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == 'BCP') {
        $_SESSION["branchId"] = $userlogin->Type;
        echo "<script type='text/javascript'>window.location.href = 'selecttoexport.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == "VENDOR") {
        $_SESSION["branchId"] = $userlogin->Type;
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == "HOUSER") {
        $_SESSION["branchId"] = $userlogin->Type;


        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == "NSD") {
        $_SESSION["branchId"] = $userlogin->Type;
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == "BACKHO") {
        $_SESSION["branchId"] = $userlogin->Type;
        echo "<script type='text/javascript'>window.location.href = 'backofficedashboard.php';</script>";
        exit();
    } elseif (strtoupper($userlogin->Type) == "SUPER") {
        echo "<script type='text/javascript'>window.location.href = 'backofficeindex.php';</script>";
        exit();
    }
} else {
    header('Location: ' . $tinfcURL);
}
