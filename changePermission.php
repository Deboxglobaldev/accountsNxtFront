<?php
include "inc.php";

if(trim($_REQUEST['action'])=="changepermission"){
$status = trim($_REQUEST['status']);
if($status=='true'){
$sentstatus = 1;
}else{
$sentstatus = 0;
}
$groupid = trim($_REQUEST['groupid']);
$pageid = trim($_REQUEST['pageid']);

$jsonPost = '{
	"Status" : "single",
	"listOfData" : [{
		"Status" : "'.$sentstatus.'",
		"userGroupId" : "'.$groupid.'",
		"userPageId" : "'.$pageid.'"
	}]
}';

$url = $serverurlapi."General/userManageAPI.php";
$response = postCurlData($url,$jsonPost);
logger("Response return CHANGE PERMISSION API: ". $response); 

}


?>
