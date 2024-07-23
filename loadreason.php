<?php
include "inc.php"; 
include "logincheck.php";
if($_REQUEST['action']=="loadreason"){
$fieldId = trim($_REQUEST['id']);
$formType = trim($_REQUEST['formType']);
$rid = trim($_REQUEST['rid']);
?>
<option value="">Select</option>
<?php
$url = $serverurlapi."General/rejectioninfoList.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$data = json_decode($result);
curl_close($ch);

foreach($data->Rejectionlist as $RejectionlistArr){
if($RejectionlistArr->FormType==$formType){
foreach($RejectionlistArr->FieldList as $FieldNameData){
if($FieldNameData->Masterid==$fieldId){
foreach($FieldNameData->RejectionReason as $RejectionReasonArr){
$rejVal = $RejectionReasonArr->description.'['.$RejectionReasonArr->NsdlId.']';
$rejVal = str_replace('"',"",$rejVal);
$rejVal = str_replace("'","",$rejVal);
?>
<option value="<?php echo $rejVal; ?>" mytag="<?php echo $RejectionReasonArr->id; ?>" <?php if($RejectionReasonArr->description==$rid){ echo "selected"; }?> ><?php echo $RejectionReasonArr->description; ?>[<?php echo $RejectionReasonArr->NsdlId; ?>]</option>
<?php
}
}
}
}
}


}

?>