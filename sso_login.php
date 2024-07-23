<?php

//error_reporting('E_ALL');
//ini_set('display_errors', 1);
include "inc.php";
//echo 'key---- '. $params = $_REQUEST['key'];
$params = str_replace(' ', '+', $_REQUEST['key']);

// Now $params contains the modified string
//echo 'params------- '. $params; // Output for demonstration


//die;
$decryptedData = decryptData($params, $key, $iv);

//var_dump($decryptedData);die;


//$decryptedData = decryptData('cF8zM09ObfFynHhDslWOdlhSKlOSPslvGthVaJQCvSgIiOuiZe60Tvc1lw8viSrjgXnfYuxi8Juj2QxLyxIBlfR/+AuYkRRms8xIt5f8lPUcmvXi0TSc4HMai4l6L3f753QQaH43/epBSJqiSeY8S9udE2oqffORk2hvCHj/CBUs4SKEm7rfu/46UJ7EFd++7bNvdAsJCzdWUyvt1znDyJMa6p1xzUvtM+ooaxjF7Z9ZVsMyUrjGGnb+bUumEInc3+00mnRrVnTzCSrO4n8EH3aAwKUEpJqpGeSB97twvNH50yghZji77psPwnUH+t3Xgwd/E0tqb3C+P/YePI5gAg==', $key, $iv);
//echo "Decrypted ddd: " . $decryptedData . "\n";    die;         
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
//$response_data['code'] = 'SC001s';
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
   // echo '<pre>'; print_r($_SESSION);die;
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
elseif (strtoupper($userlogin->Type) == "") {
        echo '        
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-header, .modal-footer {
            background: #ff4444; /* A strong red background for header and footer */
            color: white;
        }
        .modal-body {
            background: #fff3f3; /* A softer red tint for the body background */
        }
        .modal-content {
            border-radius: 8px; /* Rounded corners for the modal */
        }
        .modal-title {
            font-weight: bold;
        }
        .icon-box {
            color: #ff4444; /* Matching the header color */
            font-size: 25px; /* Larger icon size */
            vertical-align: middle;
            margin-right: 10px;
        }
    </style>
</head>
<body>
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel"><span class="icon-box">&#9888;</span>Important Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Unfortunately, the SSO login has failed as your user details are not present in our system. You will be redirected in 3 seconds to the login page to attempt signing in differently or to seek further assistance.
      </div>
      
    </div>
  </div>
</div>
</body>
</html>
';
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>';
        echo "<script type='text/javascript'>        
       $('#myModal').modal('show');
      
        // Automatically close the modal after 3 seconds and redirect
        setTimeout(function() {

            //$('#myModal').modal('hide'); // You can remove this line if you don't need to hide it explicitly
            window.location.href = 'login.php'; // Redirect
        }, 4000); // 3000 milliseconds equals 3 seconds
        </script>";
    }
} else {

    // Start output buffering to avoid header issues
    ob_start();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-header, .modal-footer {
            background: #ff4444; /* A strong red background for header and footer */
            color: white;
        }
        .modal-body {
            background: #fff3f3; /* A softer red tint for the body background */
        }
        .modal-content {
            border-radius: 8px; /* Rounded corners for the modal */
        }
        .modal-title {
            font-weight: bold;
        }
        .icon-box {
            color: #ff4444; /* Matching the header color */
            font-size: 25px; /* Larger icon size */
            vertical-align: middle;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel"><span class="icon-box">&#9888;</span>Important Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Unfortunately, the SSO login has failed as your user details are not present in our system. You will be redirected in 3 seconds to the login page to attempt signing in differently or to seek further assistance.
      </div>
      
    </div>
  </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        // Show the modal
        $('#myModal').modal('show');

        // Automatically close the modal after 3 seconds and redirect
        setTimeout(function() {
            $('#myModal').modal('hide'); // You can remove this line if you don't need to hide it explicitly
            window.location.href = "<?php echo $tinfcURL; ?>"; // Redirect
        }, 4000); // 3000 milliseconds equals 3 seconds
    });
</script>

</body>
</html>
    <?php
    // End output buffering and flush the output
    ob_end_flush();
    exit; // Ensure no further script execution
        }
?>
