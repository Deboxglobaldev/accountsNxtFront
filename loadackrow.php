<?php 
session_start();
include "inc.php";

$ackNo = $_REQUEST['ackno'];
$assignto = $_REQUEST['assignto'];
$userid = $_REQUEST['userid'];
$productType = $_REQUEST['productType'];

$jsonPost = '{
	"listofAck":[
		{
			"acknowledgmentno":"'.$ackNo.'",
			"assignTo":"'.$assignto.'",
			"userId":"'.$userid.'",
			"productType":"'.trim($productType).'"
		}
	]
}';

$hiturl = $serverurlapi."General/subscribeAPI.php";
$response = postCurlData($hiturl,$jsonPost);
$responseData = json_decode($response);

//echo $responseData->Message;

if($assignto==""){
	$msg = 'Queued';
}elseif($assignto==$userid){
	$msg = 'Me';
}else{
	$msg = 'Other';
}
?>
<script>
alert('<?php echo $responseData->Message; ?>');
ss();
//parent.$('#btn_1_<?php echo $ackNo; ?>').text('<?php echo $msg; ?>');
</script>
