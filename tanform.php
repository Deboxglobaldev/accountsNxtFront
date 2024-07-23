<?php
include("inc.php");
include "logincheck.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Tan From</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<style type="text/css">
.error{
color: red;
}
.selectize-dropdown{
text-align: left;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script>
$(document).ready(function () {
$('#AOJSON').selectize({
sortField: 'text'
});
});
</script>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<div class="hk-pg-wrapper"  style="margin-left: 0;">
<!-- <div style="background:transparent;">

</div> -->
<!-- Row -->
<div class="row conta">
<div class="col-xl-12" >
<section class="hk-sec-wrapper">
<div class="container-fluid">
<form name="curl_form" method="post" action="" enctype="multipart/form-data">
<table class="table table-bordered">
<thead>
<tr>
<th scope="col" style="text-align: center;color:#79c117;" colspan="2">Search : (Area Code)-(AO Type)-(Range Code)-(AO No)-(Desc.)-(City)</th>
<th scope="col" style="text-align: center;color:#79c117;" colspan="2"> <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<select name="AOJSON" id="AOJSON" class="form-control " onChange="funcSelecetAo(this.value);" placeholder="Search..." autocomplete="false">
<option value="">Select</option>
<?php
$AoJson = file_get_contents($serverurlapi."Dashboards/masterscache/aoMaster.json");
$AoJson = json_decode($AoJson,true);
foreach($AoJson['List'] as $AOJSONData){
?>
<option value="<?php echo $AOJSONData['AreaCode'].'-'.$AOJSONData['AoType'].'-'.$AOJSONData['RangeCode'].'-'.$AOJSONData['AoNo']; ?>"><?php echo $AOJSONData['AreaCode'].'-'.$AOJSONData['AoType'].'-'.$AOJSONData['RangeCode'].'-'.$AOJSONData['AoNo'].'-'.$AOJSONData['Description'].'-'.$AOJSONData['City']; ?></option>
<?php } ?>
</select>
<script type="text/javascript">
function funcSelecetAo(id){
let result=id.split('-');
$('#AreaCode').val(result[0]);
$('#AoType').val(result[1]);
$('#RangeCode').val(result[2]);
$('#AoNumber').val(result[3]);
}
</script>
</th>
</tr>
<tr>
<th scope="col" style="text-align: center;color:#79c117;">Area Code</th>
<th scope="col"  style="text-align: center;color:#79c117;">AO Type</th>
<th scope="col"  style="text-align: center;color:#79c117;">Range Code</th>
<th scope="col"  style="text-align: center;color:#79c117;">AO Number</th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row"><input type="text" class="form-control inputborder gc-xc" name="AREACODE" value="<?php echo $AreaCode; ?>" id="AreaCode" required readonly ></td>
<td><input type="text" class="form-control inputborder gc-xc" name="AOTYPPE" value="<?php echo $AoType; ?>" id="AoType" required readonly ></td>
<td><input type="text" class="form-control inputborder gc-xc" name="RANGECODE" value="<?php echo $RangeCode; ?>" id="RangeCode" required readonly ></td>
<td><input type="text" class="form-control inputborder gc-xc" name="AONO" value="<?php echo $AoNumber; ?>" id="AoNumber" required readonly ></td>
</tr>
</tbody>
</table>
<div class="row">
<div class="col-md-4 gc-xc">
<!--<div class="form-group">
<p class="para " for="first">Permanent&nbsp;Account&nbsp;Number(PAN)</p>
</div>-->
</div>
<div class="col-md-3">
</div>
</div>
<div class="row">
<div class="col-md-5">
<div class="row">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Category of Deductor</p>
</div>
</div>
<div class="col-md-7">
<select name="STATUSOFAPPLICANT" id="ApplicationStatus" class="form-control inputborder" onChange="funcCheckAddType();">
<option value="">Select</option>
<?php
$ApplicationStatusJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/applicantStatus_pan.json");
$ApplicationStatusJson = json_decode($ApplicationStatusJson,true);
foreach($ApplicationStatusJson['List'] as $ApplicationStatusData){
?>
<option value="<?php echo $ApplicationStatusData['Code']; ?>" <?php if($ApplicationStatusData['Code']==$ApplicationStatus){ echo 'selected'; }?> ><?php echo $ApplicationStatusData['Status'].' ['.$ApplicationStatusData['Code'].']'; ?></option>
<?php } ?>
</select>
<label id="" style="color: red; display: none;"></label>
</div>
</div>
<div class="row drr">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Sub category of Deductor</p>
</div>
</div>
<div class="col-md-7">
<select name="STATUSOFAPPLICANT" id="ApplicationStatus" class="form-control inputborder" onChange="funcgetcategory(this.value);" >
<option value="">Select</option>
<option value="1">Central Government</option>
<option value="2">State Government</option>
<option value="3">Local Authority (Central Govt.)</option>
<option value="4">Local Authority ( State Govt.)</option>
<option value="4">Statutory Body</option>
<option value="4">Autunomous Body</option>
<option value="4">Central Govt Co./ Corporation estd.by Central act.</option>
<option value="4">State Govt Co./ Corporation estd.by State act.</option>
<option value="4">Other Company.</option>
<option value="4">Individual</option>
<option value="4">HUF</option>
<option value="4">Branch of Individual Business</option>
<option value="4">Branch of HUF Business</option>
</select>
<label id="" style="color: red; display: none;"></label>
</div>
</div>
<div class="row drr inputborder1">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Title of Deductor</p>
</div>
</div>
<div class="col-md-7">
<select name="STATUSOFAPPLICANT" id="ApplicationStatus" class="form-control inputborder">
<option value="">Select</option>
<option value="1">M/S</option>
<option value="2">Shri</option>
<option value="3">Smt</option>
<option value="4">Kumari</option>
</select>
<label id="" style="color: red; display: none;"></label>
</div>
</div>
<div class="row drr inputborder2">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Last Name</p>
</div>
</div>
<div class="col-md-7">
<input type="text" name="" class="form-control">
<label id="" style="color: red; display: none;"></label>
</div>
</div>
<div class="row drr inputborder2">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">First Name</p>
</div>
</div>
<div class="col-md-7">
<input type="text" name="" class="form-control">
<label id="" style="color: red; display: none;"></label>
</div>
</div>
<div class="row drr inputborder2">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Middle Name</p>
</div>
</div>
<div class="col-md-7">
<input type="text" name="" class="form-control">
<label id="" style="color: red; display: none;"></label>
</div>
</div>
</div>
<script type="text/javascript">
function funcgetcategory(id){
var category = id;
if(category =='1' || category =='2'){
$(".inputborder1").css('display','block');
$(".inputborder2").css('display','none');	
}
else{
$(".inputborder1").css('display','none');
$(".inputborder2").css('display','block');	
	}
}
</script>
<!--  col-md-6   -->
</div>
<!--  row   -->
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>Name</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>1</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>(a) Central State (Government)</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick&nbsp;the&nbsp;approriate Entry*</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Central Government:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
State Government:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Local Authority (Central Govt):
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Local Authority (State Govt):
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Office.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Organisation.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Department.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Ministry.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Designation of person responsible for * <br>(making payment/collecting tax).</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(b) Statutory/Autonomous Bodles</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick&nbsp;the&nbsp;approriate Entry*</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Statutory Body:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Autonomous Body:
</div>
</div>
<div class="col-md-4">
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Office.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Organisation.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Designation of person responsible for * <br>(making payment/collecting tax).</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(c) Company(See Note 1)</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick&nbsp;the&nbsp;approriate Entry*</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Government Company/Corporation established by a Central Act:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Government Company/Corporation established by a State Act:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Other Company:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
Title (M/s)
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
(Tick if applicable):
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Company.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Designation of person responsible for * <br>(making payment/collecting tax).</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(d)Branch/Division of a Company</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick&nbsp;the&nbsp;approriate Entry*</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Government Company/Corporation established by a Central Act:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Government Company/Corporation established by a State Act:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Other Company:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
Title (M/s)
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
(Tick if applicable):
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Company.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Division.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name/Location of Branch.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Designation of person responsible for * <br>(making payment/collecting tax).</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(e)Individual/Hindu Undivided Family (Karta)-(See Note 2):</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick&nbsp;the&nbsp;approriate Entry*</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Individual:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Hindu Undivided Family:
</div>
</div>
<div class="col-md-4">
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick (tick the appropriate entry for individual)</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Shri:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Smt:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Kumari:
</div>
</div>
<div class="col-md-2">
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Last Name/Surname.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">First Name.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Middle Name.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(f)Branch of Individual  Business (Sole proprietorship concern)/Hindu Undivided Family(Karta):</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Tick&nbsp;the&nbsp;approriate Entry*</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-4">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Branch of Individual Business:
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Branch of Hindu Undivided Family:
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Individual/Hindu Undivided Family (karta) 
Title (tick the appropriate entry for individual)</p>
</div>
</div>
<!-- <div class="col-md-1">
<div class="form-group"> -->
<div class="col-md-3">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Shri:
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Smt:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Kumari:
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Last Name/Surname.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">First Name.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Middle Name.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name Location o branch.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(g)Firm/Association of Persons/Association of Persons(Trust)/Body of Individuals/Artificial Juridical Person(See Note 3):</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"></div>
<h5>(h)Branch of Firm/Association of Persons/Association of Persons(Trust)/Body of Individuals/Artificial Juridical Person:</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Firm/Association of Persons/Association of Persons(Trust)/Body of Individuals/Artificial Juridical Person:</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name/Location of branch:</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>Address</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>2</h5>
<div class="lostas1"> </div>
</div>
</div>
<h4 class="para br-ffr" for="first">Address for Communication</h4>
<label id="addFieldError" style="display:none; color: red;"></label>
<!--Residence address div-->
<div id="ResidenceAddress" style="display:block;">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<h4 class="para br-ffr" for="first">Residence Address</h4>
</div>
</div>
<div class="col-md-7"> </div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Flat/Room/Door/Block No.</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" onBlur="return validateForm();" id="FlatDoorBlock">
<label id="FlatDoorBlockError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Name of Premises/Building/Village</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resibuildingorvillage"  value="<?php if($BuildingPremises!=''){ echo trim($BuildingPremises); } ?>" onBlur="return validateForm();" id="BuildingPremises">
<label id="BuildingPremisesError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Road/Street/Lane/Post office</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resipostoffice" value="<?php if($RoadStreetLane!=''){ echo trim($RoadStreetLane); } ?>" onBlur="return validateForm();" id="RoadStreetLane">
<label id="RoadStreetLaneError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Area/Locality/Taluka/Sub-Division</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiareasubdivision" value="<?php if($AreaLocalityTaluka!=''){ echo trim($AreaLocalityTaluka); } ?>" onBlur="return validateForm();" id="AreaLocalityTaluka">
<label id="AreaLocalityTalukaError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Town/City/District</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="text" class="form-control inputborder fg-gt" name="resitownorcountry" id="TownCityDistrict"  value="<?php if($TownCityDistrict!=''){ echo trim($TownCityDistrict); } ?>" onBlur="return validateForm();" >
<label id="TownCityDistrictError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">State Union Territory</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<select class="form-control inputborder fg-gt" name="resistatecode" id="StateUnion" onBlur="return validateForm();">
<option value="">Select</option>
<?php
$StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$StateJson = json_decode($StateJson,true);
foreach($StateJson['List'] as $StateData){
?>
<option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$StateUnion){ echo 'selected'; }?> ><?php echo $StateData['Name']; ?></option>
<?php } ?>
</select>
<label id="StateUnionError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">PIN/Zip Code</p>
</div>
</div>
<div class="col-md-7">
<div class="form-group">
<input type="number" class="form-control inputborder fg-gt" name="resipincode"  value="<?php echo $Zip; ?>" id="Zip" onBlur="return validateForm();">
<label id="ZipError" style="display:none; color: red;"></label>
</div>
</div>
<!--  col-md-6   -->
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Mobile/Telephone</p>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="countryisd" id="countryisd" class="form-control inputborder">
<option value="91">+91</option>
<?php
$mobileisd = file_get_contents("".$serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
$mobileisd = json_decode($mobileisd,true);
foreach($mobileisd['List'] as $mobileisdData){
?>
<option value="<?php echo $mobileisdData['ISDcode']; ?>" <?php if($mobileisdData['Code']==$countryisd && $countryisd!=''){ echo 'selected'; }?> ><?php echo '+'.$mobileisdData['ISDcode']; ?></option>
<?php } ?>
</select>

<label id="countryisdError" style="display:none; color: red;"></label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input type="number" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($StdCode!='' && $StdCode!=0){ echo $StdCode; } ?>" placeholder="Std Code" onBlur="return validateForm();" >
<label id="StdCodeError" style="display:none; color: red;"></label>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<input type="number" name="TELPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo $MobileNumber; ?>" placeholder="Enter Number" onBlur="return validateForm();">
<label id="MobileNumberError" style="display:none; color: red;"></label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Email</p>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="email" name="EMAIL" id="Email" class="form-control inputborder yter" value="<?php if($Email!=''){ echo $Email; } ?>" style="width: 61%;" onBlur="return validateForm();">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>3</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">National of Deductor(Tick the appropriate entry)</p>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Indian:
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<input class="jiy " type="radio" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
Foreign:
</div>
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>4</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Permanent Account Number (PAN)</p>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" name="EMAIL" id="Email" class="form-control inputborder yter" value="<?php if($Email!=''){ echo $Email; } ?>" style="width: 61%;" onBlur="return validateForm();">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>5</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Exiting Tax Deduction Account Number</p>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" name="EMAIL" id="Email" class="form-control inputborder yter" value="<?php if($Email!=''){ echo $Email; } ?>" style="width: 61%;" onBlur="return validateForm();">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>6</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Exiting Tax Collection Account Number</p>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" name="EMAIL" id="Email" class="form-control inputborder yter" value="<?php if($Email!=''){ echo $Email; } ?>" style="width: 61%;" onBlur="return validateForm();">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<div class="dostas">
<div style="display: flex;" class="arr">
<div class="lostas2"> </div>
<h5>7</h5>
<div class="lostas1"> </div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Date(DD-MM-YY)</p>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<input type="text" name="DOB" id="DateAgreement" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr  datepicker isdobupdateflagCls" value="<?php if($DOB!=''){ echo date('d-m-Y',strtotime($DOB)); } ?>" style="width: 61%;">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div>
<h4 class="para br-ffr vtd" for="first">Verification</h4>
<div class="row">
<div class="col-md-12">
<div class="form-group ks-trek">
<p class="para rew" for="first">I/We</p>
<input type="text" class="form-control inputborder" placeholder="" name="verifiername" id="VerifierName" value="<?php echo $VerifierName; ?>" onBlur="return validateForm2();"  required >
<label id="VerifierNameError" style="color: red; display: none;"></label>
<p class="para rew" for="first">,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of</p>
<select class="form-control inputborder " name="verifiercapcitycode" id="CVerifier" onBlur="return validateForm2();" required >
<?php
$CVerifierJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/verifierMaster_pan.json");
$CVerifierJsondec = json_decode($CVerifierJson,true);
foreach($CVerifierJsondec['ApplicationStatus'] as $CVerifierJson){

if($CVerifierJson['Category']==$ApplicationStatus){
foreach($CVerifierJson['List'] as $CVerifierData){
?>
<option value="<?php echo $CVerifierData['Code']; ?>" <?php if($CVerifierData['Code']==$CVerifier){ echo 'selected'; }?> ><?php echo $CVerifierData['Name']; ?></option>
<?php } } } ?>
</select>
<label id="CVerifierError" style="color: red; display: none;"></label>
<p class="para rew" for="first">do&nbsp;hereby</p>
</div>
<div>
<p class="para rew" for="first">declare that what is stated above is true to the best of my/ourinformation and belief</p>
</div>
</div>
</div>
<div class="row hg-op">
<div class="col-md-6">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Place</p>
</div>
</div>
<div class="col-md-9">
<input type="text" class="form-control " placeholder="" name="verificationplace" id="VerifierPlace" value="<?php echo $verificationplace; ?>" onBlur="return validateForm2();">
<label id="VerifierPlaceError" style="color: red; display: none;"></label>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Date</p>
</div>
</div>
<div class="col-md-7">

<p class="para" for="first"> <input type="text" name="verificationdate" id="verificationdate" value="<?php if($AcknowledgementDate!=''){ echo date('d-m-Y',strtotime($AcknowledgementDate)); }else{ echo ''; } ?>" class="form-control datepicker inputborder datepicker" ></p>
</div>
</div>
</div>
</div>
</div>
<button type="submit" id="formsubmit" class="next"> Save and move to next section <i class="fa fa-angle-right" ></i></button>
</form>
</section>
</div>
</div>
</div>
</div>
<script src="js/dataentryfromvalidate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
$( function() {
$( ".datepicker" ).datepicker({ 
dateFormat: 'dd-mm-yy',
maxDate: 0
});
} );
</script>
<script>
function funcCheckAddType(){
var ApplicationStatus = $('#ApplicationStatus').val();
var IncomeFromSalary = $('#IncomeFromSalary').is(':checked');
var BusinessProfessional = $('#BusinessProfessional').val();
if(ApplicationStatus=='P' || ApplicationStatus=='A' || ApplicationStatus=='H' || ApplicationStatus=='B' || ApplicationStatus=='J'){
$("#AddressType").val('R').change();
$("#ResidenceAddress").css('display','block');
$("#OfficeAddress").css('display','none');
if(IncomeFromSalary==true || BusinessProfessional!=''){
$("#OfficeAddress").css('display','block');
}else{
$("#OfficeAddress").css('display','none');
}
}else if(ApplicationStatus=='F' || ApplicationStatus=='E' || ApplicationStatus=='C' || ApplicationStatus=='L' || ApplicationStatus=='G'){
$("#AddressType").val('O').change();
$("#ResidenceAddress").css('display','none');
$("#OfficeAddress").css('display','block');
}
}

funcCheckAddType();
</script>
<?php include 'footer.php'; ?>
</body>
</html>
<style>
.fr-rew{
padding: 5px;
margin-right: 5px;
}.gio-yt{
display: flex;
column-gap: 26px;
}
.nbvu-test{
width: 47%;
}
.gh-nbv{
border: 1px solid #79c117;
border-radius: 5px;
width: 22%;
}
.fd-dyt{
padding: 3px;
}
.hk-pg-wrapper{
padding-top: 0;
margin-left: 0;
}
.gc-xc{
margin-top: auto;
margin-bottom: auto;

}
.lostas1{
background: #efefef;
height: 19px;
width: 10%;
margin-left: 5px;
margin-top: 3px;
}
.lostas2{
background: #efefef;
height: 19px;
width: 30px;
margin-left: 5px;
margin-top: 3px;
margin-right: 5px;
}
}
</style>
