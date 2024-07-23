<?php
session_start();
include "inc.php";
if($_POST['action']=="subscribe_ack"){
	
	$ackList = '';
	foreach($_POST['acknowledgmentchecksingle'] as $ackData){
		$arrData = explode('~',$ackData);
		$ackNo = $arrData[0];
		$assignto = $arrData[1];
		$userid = $arrData[2];
		$productType = $arrData[3];
		$ackList.= '{
						"acknowledgmentno":"'.$ackNo.'",
						"assignTo":"'.$assignto.'",
						"userId":"'.$userid.'",
						"productType":"'.trim($productType).'"
					},';
	}
	
	$jsonPost = '{
					"listofAck":['.rtrim($ackList,',').']
				}';
				
	$hiturl = $serverurlapi."General/subscribeAPI.php";
	$response = postCurlData($hiturl,$jsonPost);
	echo '1';
	$responseData = json_decode($response);
}
?>