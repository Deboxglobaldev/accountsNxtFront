<?php
include "inc.php";
include "logincheck.php";
$searching = '{
		"courier":"'.$_REQUEST['courierNumber'].'"
	}';

$url = $serverurlapi."Dashboards/courierDashboard.php";
logger($InfoMessage." URL for API - ".$url); 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
echo $responseData1 = curl_exec($ch);
logger("Response return from courier list API: ". $responseData1); 
$dashDatanew = json_decode($responseData1);
curl_close($ch);

?>

<option value="">Select</option>
<?php
foreach($dashDatanew->CourierList as $courierno){
if($courierno->Courier==$_REQUEST['courierNumber']){
foreach($courierno->BunchList as $resultList){
?>
<option value="<?php echo $resultList->Bunch; ?>" ><?php echo $resultList->Bunch; ?></option>
<?php } } } ?>	