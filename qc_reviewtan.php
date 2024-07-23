<?php  
include("inc.php");
include "logincheck.php";
$url = $serverurlapi."User1Entry/callAcknowDataTan.php?aid=".$_GET['aid'];
//Fetch data from get curl function
$result = getCurlData($url);
//logger("RESPONSE RETURN FROM CALL ACKNOW API: ". $result); 
$data = json_decode($result, true);


$AREACODE = trim($data['recordlist']['AREACODE']); 
$AOTYPE = trim($data['recordlist']['AOTYPE']);
$RANGECODE = trim($data['recordlist']['RANGECODE']);
$AONO = trim($data['recordlist']['AONO']);
$catofdeductor = trim($data['recordlist']['catofdeductor']);
$subcatofdeductor = trim($data['recordlist']['subcatofdeductor']);
$titledeductor = trim($data['recordlist']['titledeductor']);
$lastname = trim($data['recordlist']['lastname']);
$firstname = trim($data['recordlist']['firstname']);
$middlename = trim($data['recordlist']['middlename']);
$officename = trim($data['recordlist']['officename']);
$orgname = trim($data['recordlist']['orgname']);
$deptname = trim($data['recordlist']['deptname']);
$ministryname = trim($data['recordlist']['ministryname']);
$companyname = trim($data['recordlist']['companyname']);
$divisionname = trim($data['recordlist']['divisionname']);
$namelocbranch = trim($data['recordlist']['namelocbranch']);
$desigpersonforpayment = trim($data['recordlist']['desigpersonforpayment']);
$firmassocname = trim($data['recordlist']['firmassocname']);
$addrflatorblockno = trim($data['recordlist']['addrflatorblockno']);
$addrbuildingorvillage = trim($data['recordlist']['addrbuildingorvillage']);
$addrpostoffice = trim($data['recordlist']['addrpostoffice']);
$addrareasubdivision = trim($data['recordlist']['addrareasubdivision']);
$addrtownorcountry = trim($data['recordlist']['addrtownorcountry']);
$addrstatecode = trim($data['recordlist']['addrstatecode']);
$addrpincode = trim($data['recordlist']['addrpincode']);
$STDCODE = trim($data['recordlist']['STDCODE']);
$TELEPHONE = trim($data['recordlist']['TELEPHONE']);
$NATIONALITY = trim($data['recordlist']['NATIONALITY']);
$applicationdate = trim($data['recordlist']['applicationdate']);
$panapplicant = trim($data['recordlist']['panapplicant']);
$oldtandeduction = trim($data['recordlist']['oldtandeduction']);
$oldtancollection = trim($data['recordlist']['oldtancollection']);
$email1 = trim($data['recordlist']['email1']);
$email2 = trim($data['recordlist']['email2']);
$acknwoledmentdate = trim($data['recordlist']['acknwoledmentdate']);
$verificationdate = trim($data['recordlist']['verificationdate']);
$acknowledmentnumber = trim($data['recordlist']['acknowledmentnumber']);
$verifiername = trim($data['recordlist']['verifiername']);
$verifiercapacitycode = trim($data['recordlist']['verifiercapacitycode']);
$verificationplace = trim($data['recordlist']['verificationplace']);
$rejectionid = trim($data['recordlist']['rejectionid']);
$rejectiondatetime = trim($data['recordlist']['rejectiondatetime']);
$stage = trim($data['recordlist']['stage']);
$Revised = trim($data['formtype']);
$_SESSION['stage'] = $Stage;
?>
<?php
$res='';
if(isset($_POST['action'])=="reviewdatasubmit"){
  
  $acknowledmentnumber = trim($acknowledmentnumber);
  $jsonPost = '{ "UserId": "'.$_SESSION["UID"].'", "UserName": "", "ip": "'.$_SERVER["REMOTE_ADDR"].'", "Stage": "'.$stage.'", "FormType": "'.strtoupper($Revised).'", "AcknowledgementNumber":"'.$acknowledmentnumber.'"}';
  $url2 = $serverurlapi."User1Entry/TanSubmitValidatorAPI.php";
  
  $response = postCurlData($url2,$jsonPost);
  $res = json_decode($response,true);
    logger("Response return from validate TAN review page: ".$response);
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Review</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<style type="text/css">
  .error{
    color: red;
  }


.custom-file-upload{
  
  padding: 8px;
 
  border-radius: 5px; 
 
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}

.gc-xc {
  border: 0px;
  text-align: center;
  pointer-events: none;
}
.inputborder,.js-trek,.jiy,.form-control{
  text-align: left;
  pointer-events: none;

}
select {
  appearance: none;
}
.form-group{
  margin-top: 10px;

}
.rew{
padding-top: 10px;
}  
.selectize-dropdown{
text-align: left;
}
.form-control{
color: #324148;
padding: 0.175rem 0.75rem;
height: calc(1.75rem + 4px);
}
.form-group {
    margin-bottom: 0.50rem;
}
.numHead{
font-size: 14px;
    padding: 4px;
    color: black;
    font-weight: 500;
}
.arr {
    margin-top: 4px !important;
    margin-bottom: 20px !important;
}
.drr {
    margin-top: 7px !important;
}
</style>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <!--  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div> -->
  <div class=""  style="background-image: url(img/Religare-Dashboard-BsG.JPG);">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
    <div class="row">
     <form name="curl_form" method="post" id="dataentry1" action="" enctype="multipart/form-data">
      <div class="col-xl-12" >
      <section class="hk-sec-wrapper con" >
      <!-- <div class="dostas" style="margin-top: 56px;">
        <div style="display: flex;">
          <div class="dostas2"> </div>
          <h3>Review</h3>
          <div class="dostas1">
          </div>
        </div>
      </div> -->
      <div class="container-fluid">
      <?php
    if($res!=''){
  if($res['Validated']=='1'){
  $_SESSION['error']= '['.$res['AcknowledgementNumber'].'] Review Data Submit Succesfully';
  if(substr($Stage,2,3)=="BCP"){
    $location = 'selecttoexport.php';
  }else{
    $location = 'index.php';
  }
  ?>
  <script>
  parent.window.location.href = '<?php echo $location; ?>'; 
  </script>
<?php
  }else{
?>
<div class="errorMessage">
<?php
    if($res!=''){
    if($res['Validated']=='0'){
    if($res['Erorlist']==''){ ?>
      <div style="border: 1px solid #f95858;padding: 10px;margin-top: 10px;margin-bottom: 10px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Failed to validate please check error log file.</div>
        <?php  }else{ ?>
          <div style="border: 1px solid #f95858;padding: 10px;margin-top: 10px;margin-bottom: 10px;">
            <ul>
    <?php
    $explodeRes = explode('|',$res['Erorlist']);
    foreach($explodeRes as $responceRow){
    $explorow = explode('^',$responceRow);
    ?>
              <li>
                <ul>
    <?php foreach($explorow as $newRow){
    if($newRow!=''){
    ?>
                  <li> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo $newRow; ?></li>
         <?php } } ?>
                </ul>
              </li>
         <?php }  ?>
            </ul>
          </div>
         <?php } }
    
    }
    
    ?>
    </div>
    
  <script>
  $('.errorMessage').clone().appendTo(parent.$('#errorDiv'));
  $('.errorMessage').remove();
  parent.window.scrollTo(0,0);
  parent.$("#blkbox").hide();
  </script>
<?php 
} }
?> 
      
 <?php if($Revised!="CR"){ ?>
<table class="table table-bordered">
<thead>
<tr>
<th scope="col" style="text-align: center;color:#79c117;" colspan="2">Search : (Area Code)-(AO Type)-(Range Code)-(AO No)-(Desc.)-(City)</th>
<th scope="col" style="text-align: center;color:#79c117;" colspan="2"> <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<select name="AOJSON" id="AOJSON" class="form-control " onChange="funcSelecetAo(this.value);" placeholder="Search..." autocomplete="false" style="pointer-events: none; display:none;">
<option value="">Select</option>
<?php
$AoJson = file_get_contents($serverurlapi."Dashboards/masterscache/aoMasterTan.json");
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
<td scope="row"><input type="text" class="form-control inputborder gc-xc" name="AREACODE" value="<?php echo $AREACODE; ?>" id="AreaCode"   readonly ></td>
<td><input type="text" class="form-control inputborder gc-xc" name="AOTYPE" value="<?php echo $AOTYPE; ?>" id="AoType"   readonly ></td>
<td><input type="text" class="form-control inputborder gc-xc" name="RANGECODE" value="<?php echo $RANGECODE; ?>" id="RangeCode"   readonly ></td>
<td><input type="text" class="form-control inputborder gc-xc" name="AONO" value="<?php echo $AONO; ?>" id="AoNumber"   readonly ></td>
</tr>
</tbody>
</table>
<div class="row">
<div class="col-md-2">
<div class="form-group">
<p class="para" for="first">Category of Deductor</p>
</div>
</div>
<div class="col-md-10">
<div class="form-group">
<select name="catofdeductor" id="catofdeductor" class="form-control inputborder" onChange="funcCheckAddType();" style="pointer-events:none;">
<option value=""></option>
<option value="a" <?= ($catofdeductor=='a')? 'selected="selected"':'';?>>Central/State Govt/Local Authority[a].</option>
<option value="b" <?= ($catofdeductor=='b')? 'selected="selected"':'';?>>Statutory/Autonomous Bodies[b]</option>
<option value="c" <?= ($catofdeductor=='c')? 'selected="selected"':'';?>>Company[c]</option>
<option value="d" <?= ($catofdeductor=='d')? 'selected="selected"':'';?>>Branch of a Company[d]</option>
<option value="e" <?= ($catofdeductor=='e')? 'selected="selected"':'';?>>Individual/Hindu Undivided Family(Karta)[e]</option>
<option value="f" <?= ($catofdeductor=='f')? 'selected="selected"':'';?>>Branch of Individual Business(Sole proprietorship concern)/Hindu Undivided Family(Karta)[f]</option>
<option value="g" <?= ($catofdeductor=='g')? 'selected="selected"':'';?>>Firm/Association of persons/ Association of persons(Trust)/ Body of Individuals/ Artificial Juridical Person[g].</option>
<option value="h" <?= ($catofdeductor=='h')? 'selected="selected"':'';?>>Branch of Firm/ Association of persons/ Association of persons (Trust) / Body of Individuals/ Artificial Juridical Person[h]. </option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Sub category of Deductor</p>
</div>
</div>
<div class="col-md-9">
<div class="form-group">
<select name="subcatofdeductor" id="subcatofdeductor" class="form-control inputborder" style="pointer-events:none;">
<option value=""></option>
<option value="1" <?= ($subcatofdeductor=='1')? 'selected="selected"':'';?>>Central Government</option>
<option value="2" <?= ($subcatofdeductor=='2')? 'selected="selected"':'';?>>State Government</option>
<option value="3" <?= ($subcatofdeductor=='3')? 'selected="selected"':'';?>>Local Authority (Central Govt.)</option>
<option value="4" <?= ($subcatofdeductor=='4')? 'selected="selected"':'';?>>Local Authority ( State Govt.)</option>
<option value="5" <?= ($subcatofdeductor=='5')? 'selected="selected"':'';?>>Statutory Body</option>
<option value="6" <?= ($subcatofdeductor=='6')? 'selected="selected"':'';?>>Autunomous Body</option>
<option value="7" <?= ($subcatofdeductor=='7')? 'selected="selected"':'';?>>Central Govt Co./ Corporation estd.by Central act.</option>
<option value="8" <?= ($subcatofdeductor=='8')? 'selected="selected"':'';?>>State Govt Co./ Corporation estd.by State act.</option>
<option value="9" <?= ($subcatofdeductor=='9')? 'selected="selected"':'';?>>Other Company.</option>
<option value="10" <?= ($subcatofdeductor=='10')? 'selected="selected"':'';?>>Individual</option>
<option value="11" <?= ($subcatofdeductor=='11')? 'selected="selected"':'';?>>HUF</option>
<option value="12" <?= ($subcatofdeductor=='12')? 'selected="selected"':'';?>>Branch of Individual Business</option>
<option value="13" <?= ($subcatofdeductor=='13')? 'selected="selected"':'';?>>Branch of HUF Business</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Title of Deductor</p>
</div>
</div>
<div class="col-md-9">
<select name="titledeductor" id="titledeductor" class="form-control inputborder" style="pointer-events:none;">
<option value=""></option>
<option value="1" <?= ($titledeductor=='1')? 'selected="selected"':'';?>>M/S</option>
<option value="2" <?= ($titledeductor=='2')? 'selected="selected"':'';?>>Shri</option>
<option value="3" <?= ($titledeductor=='3')? 'selected="selected"':'';?>>Smt</option>
<option value="4" <?= ($titledeductor=='4')? 'selected="selected"':'';?>>Kumari</option>
</select>

</div>
</div>
</div>
<!-- </div> -->

<div class="row">
<div class="col-md-12">
  <div class="col-md-3">
<div class="form-group">
<p class="para" for="first"><span class="numHead">1</span>&nbsp;Name</p>
</div>
</div>

<div class="officenameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Office.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="officename" value="<?php if($officename!=''){ echo trim($officename); } ?>"  id="officename" readonly>
</div>
</div>
</div>
</div>

<div class="orgnameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Organisation.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="orgname" value="<?php if($orgname!=''){ echo trim($orgname); } ?>"  id="orgname" readonly>
</div>
</div>
</div>
</div>

<div class="deptnameshow">
<div class="col-md-12">  
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Department.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="deptname" value="<?php if($deptname!=''){ echo trim($deptname); } ?>"  id="deptname" readonly>
</div>
</div>
</div>
</div>

<div class="ministrynameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Ministry.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="ministryname" value="<?php if($ministryname!=''){ echo trim($ministryname); } ?>"  id="ministryname" readonly>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="companynameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Company.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="companyname" value="<?php if($companyname!=''){ echo trim($companyname); } ?>"  id="companyname" readonly>
</div>
</div>
</div>
</div>

<div class="divisionnameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Division.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="divisionname" value="<?php if($divisionname!=''){ echo trim($divisionname); } ?>"  id="divisionname" readonly>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-md-12">
<div class="row">
<div class="col-md-12">
  
<div class="LastNameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Last Name/Surname.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="lastname" value="<?php if($lastname!=''){ echo trim($lastname); } ?>"  id="LastName" readonly>
</div>
</div>
</div>
</div>

<div class="FirstNameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">First Name.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="firstname" value="<?php if($firstname!=''){ echo trim($firstname); } ?>"  id="FirstName" readonly>
</div>
</div>
</div>
</div>

<div class="MiddleNameshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Middle Name.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="middlename" value="<?php if($middlename!=''){ echo trim($middlename); } ?>" id="MiddleName" readonly>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="firmassocnameshow">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Firm Association Name</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="firmassocname" value="<?php if($firmassocname!=''){ echo trim($firmassocname); } ?>"  id="firmassocname" readonly>
</div>
</div>
</div>
</div>
</div>

<div class="namelocbranchshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name/Location of branch:</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="namelocbranch" value="<?php if($namelocbranch!=''){ echo trim($namelocbranch); } ?>"  id="namelocbranch" readonly>
</div>
</div>
</div>
</div>
<div class="desigpersonforpaymentshow">
<div class="col-md-12">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Designation of person responsible for *(making payment/collecting tax).</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="desigpersonforpayment" value="<?php if($desigpersonforpayment!=''){ echo trim($desigpersonforpayment); } ?>"  id="desigpersonforpayment" readonly>
</div>
</div>
</div>
</div>
<label id="addFieldError" style="display:none; color: red;"></label>
<!--Residence address div-->
<div id="ResidenceAddress" style="display:block;">
<div class="col-md-12">
<div class="form-group">
<h4 class="para br-ffr" for="first"><span class="numHead">2</span>Residence Address</h4>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Flat/Room/Door/Block No.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrflatorblockno" value="<?php if($addrflatorblockno!=''){ echo trim($addrflatorblockno); } ?>"  id="addrflatorblockno" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Premises/Building/Village</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrbuildingorvillage"  value="<?php if($addrbuildingorvillage!=''){ echo trim($addrbuildingorvillage); } ?>"  id="addrbuildingorvillage" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Road/Street/Lane/Post office</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrpostoffice" value="<?php if($addrpostoffice!=''){ echo trim($addrpostoffice); } ?>"  id="addrpostoffice" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Area/Locality/Taluka/Sub-Division</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrareasubdivision" value="<?php if($addrareasubdivision!=''){ echo trim($addrareasubdivision); } ?>"  id="addrareasubdivision" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Town/City/District</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrtownorcountry" id="addrtownorcountry"  value="<?php if($addrtownorcountry!=''){ echo trim($addrtownorcountry); } ?>" readonly >
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">State Union Territory</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<select class="form-control" name="addrstatecode" id="addrstatecode" style="pointer-events:none;">
<option value=""></option>
<?php
$StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$StateJson = json_decode($StateJson,true);
foreach($StateJson['List'] as $StateData){
if($StateData['Code']!='99'){
?>
<option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$addrstatecode){ echo 'selected'; }?> ><?php echo $StateData['Name']; ?></option>
<?php } } ?>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">PIN/Zip Code</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="number" class="form-control" name="addrpincode" value="<?php if($addrpincode!=''){ echo trim($addrpincode); } ?>" id="addrpincode" readonly>
</div>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Mobile/Telephone</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="number" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($STDCODE!='' && $STDCODE!=0){ echo $STDCODE; } ?>" placeholder="Std Code"  readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="number" name="TELEPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo $TELEPHONE; ?>" placeholder="Enter Number" readonly>

</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Email 1</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="email" name="email1" id="email1" class="form-control" value="<?php if($email1!=''){ echo $email1; } ?>" readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Email 2</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="email" name="email2" id="email2" class="form-control" value="<?php if($email2!=''){ echo $email2; } ?>" readonly>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<p class="para" for="first" style="margin-left: 5px;"><span class="numHead">3</span>Nationality of Deductor</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input class="jiy " type="radio" name="NATIONALITY" id="NATIONALITY" value="0" <?php if($NATIONALITY=='0'){ echo 'checked'; } ?> readonly>
Indian:
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input class="jiy " type="radio" name="NATIONALITY" id="NATIONALITY" value="1" <?php if($NATIONALITY=='1'){ echo 'checked'; } ?> readonly>
Foreign:
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<p class="para" for="first" style="margin-left: 5px;"><span class="numHead">4</span>&nbsp;Permanent Account Number (PAN)</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="panapplicant" id="panapplicant" class="form-control inputborder" value="<?php echo $panapplicant; ?>" readonly>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<p class="para" for="first" style="margin-left: 5px;"><span class="numHead">5</span>&nbsp;Exiting Tax Deduction Account Number</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="oldtandeduction" id="oldtandeduction" class="form-control inputborder" value="<?php if($oldtandeduction!=''){ echo $oldtandeduction; } ?>" readonly>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<p class="para" for="first" style="margin-left: 5px;"><span class="numHead">6</span>&nbsp;Exiting Tax Collection Account Number</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="oldtancollection" id="oldtancollection" class="form-control inputborder" value="<?php if($oldtancollection!=''){ echo $oldtancollection; } ?>" readonly>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<p class="para" for="first" style="margin-left: 5px;"><span class="numHead">7</span>&nbsp;Ack. Date(DD-MM-YY)</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
 <?php
//$date = substr($acknwoledmentdate,0,2).'-';
//$month = substr($acknwoledmentdate,2,2).'-';
//$year = substr($acknwoledmentdate,4,5);
//$acknwoledmentdate = $date.$month.$year;
?>
<input type="text" name="acknwoledmentdate" id="acknwoledmentdate" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr  datepicker isdobupdateflagCls" value="<?php echo dateFormat($acknwoledmentdate); ?>"  <?php if($acknwoledmentdate!=''){ ?>style="pointer-events: none;"<?php } ?> readonly>
</div>
</div>

<?php
//$date = substr($applicationdate,0,2).'-';
//$month = substr($applicationdate,2,2).'-';
//$year = substr($applicationdate,4,5);
//$applicationdate = $date.$month.$year;
?>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Application Date(DD-MM-YY)</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="applicationdate" id="DateAgreement" onChange="getDate(this.value);"  class="form-control isdobupdateflagCls" value="<?php echo dateFormat($applicationdate); ?>" readonly>
</div>
</div>


<h4 class="para br-ffr vtd" for="first">Verification</h4>
<div class="col-md-12">
<div class="form-group ks-trek">
<p class="para rew" for="first">I/We</p>
<input type="text" class="form-control inputborder" name="verifiername" id="VerifierName" value="<?php echo $verifiername; ?>" readonly>
<p class="para rew" for="first">&nbsp;&nbsp;,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of&nbsp;&nbsp;</p>

<input type="text" class="form-control inputborder" name="verifiercapacitycode" id="CVerifier" value="<?php echo $verifiercapacitycode; ?>" readonly>
</div>
<div>
<p class="para rew" for="first">&nbsp;&nbsp;do hereby declare that what is stated above is true to the best of my/ourinformation and belief. </p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Place</p>
</div>
</div>
<div class="col-md-12">
<input type="text" class="form-control " name="verificationplace" id="VerifierPlace" value="<?php echo $verificationplace; ?>" readonly>
</div>


<div class="col-md-12">
<div class="form-group">
<p class="para" for="first" style="margin-left: 20px">Date</p>
</div>
</div>
<div class="col-md-12">
<p class="para" for="first"> <input type="text" name="verificationdate" id="verificationdate" value="<?php echo dateFormat($verificationdate); ?>" class="form-control " readonly></p>
</div>

<?php }

else{
 
$tannumber = trim($data['recordlist']['tannumber']); 
$catofdeductor = trim($data['recordlist']['catofdeductor']);
$subcatofdeductor = trim($data['recordlist']['subcatofdeductor']);
$titledeductor = trim($data['recordlist']['titledeductor']);
$lastname = trim($data['recordlist']['lastname']);
$firstname = trim($data['recordlist']['firstname']);
$middlename = trim($data['recordlist']['middlename']);
$officename = trim($data['recordlist']['officename']);
$orgname = trim($data['recordlist']['orgname']);
$deptname = trim($data['recordlist']['deptname']);
$ministryname = trim($data['recordlist']['ministryname']);
$companyname = trim($data['recordlist']['companyname']);
$divisionname = trim($data['recordlist']['divisionname']);
$namelocbranch = trim($data['recordlist']['namelocbranch']);
$desigpersonforpayment = trim($data['recordlist']['desigpersonforpayment']);
$firmassocname = trim($data['recordlist']['firmassocname']);
$addrflatorblockno = trim($data['recordlist']['addrflatorblockno']);
$addrbuildingorvillage = trim($data['recordlist']['addrbuildingorvillage']);
$addrpostoffice = trim($data['recordlist']['addrpostoffice']);
$addrareasubdivision = trim($data['recordlist']['addrareasubdivision']);
$addrtownorcountry = trim($data['recordlist']['addrtownorcountry']);
$addrstatecode = trim($data['recordlist']['addrstatecode']);
$addrpincode = trim($data['recordlist']['addrpincode']);
$STDCODE = trim($data['recordlist']['STDCODE']);
$TELEPHONE = trim($data['recordlist']['TELEPHONE']);
$NATIONALITY = trim($data['recordlist']['NATIONALITY']);
$applicationdate = trim($data['recordlist']['applicationdate']);
$panapplicant = trim($data['recordlist']['panapplicant']);
$tancancelflag = trim($data['recordlist']['tancancelflag']);
$tancancel1 = trim($data['recordlist']['tancancel1']);
$tancancel2 = trim($data['recordlist']['tancancel2']);
$tancancel3 = trim($data['recordlist']['tancancel3']);
$tancancel4 = trim($data['recordlist']['tancancel4']);
$ispancr = trim($data['recordlist']['ispancr']);
$isnationflag = trim($data['recordlist']['isnationflag']);
$addressflag = trim($data['recordlist']['addressflag']);
$iscatdeductor = trim($data['recordlist']['iscatdeductor']);
$isnamecr = trim($data['recordlist']['isnamecr']);
$email1 = trim($data['recordlist']['email1']);
$email2 = trim($data['recordlist']['email2']);
$acknwoledmentdate = trim($data['recordlist']['acknwoledmentdate']);
$verificationdate = trim($data['recordlist']['verificationdate']);
$acknowledmentnumber = trim($data['recordlist']['acknowledmentnumber']);
$verifiername = trim($data['recordlist']['verifiername']);
$verifiercapacitycode = trim($data['recordlist']['verifiercapacitycode']);
$verificationplace = trim($data['recordlist']['verificationplace']);
$rejectionid = trim($data['recordlist']['rejectionid']);
$rejectiondatetime = trim($data['recordlist']['rejectiondatetime']);
$stage = trim($data['recordlist']['stage']);
$Revised = trim($data['formtype']);
 
?>
<div class="container-fluid">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Tan Number</p>
</div>
</div>
<div class="col-md-9">
<input type="text" name="tan" class="form-control inputborder" placeholder="Tan Number" value="<?= $tannumber; ?>" readonly>
</div>
</div>
<div class="row drr">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Acknowledgement&nbsp;No&nbsp;*</p>
</div>
</div>
<div class="col-md-9">
<input type="text" class="form-control inputborder" name="acknowledmentnumber" value="<?php echo $acknowledmentnumber; ?>" id="acknowledmentnumber" readonly  readonly>
</div>

</div>
<div class="row">
<div class="col-md-2">
<div class="form-group">
<p class="para" for="first">Category of Deductor</p>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<input class="jiy " type="checkbox" name="iscatdeductor" id="iscatdeductor" value="Y" <?php if($iscatdeductor=='Y'){ echo 'checked'; } ?> readonly>
</div>
</div>
<div class="col-md-9">
  <div class="form-group">
<select name="catofdeductor" id="catofdeductor" class="form-control inputborder" onChange="funcCheckAddType();funcchangesubcat(this.value);" style="pointer-events:none;">
<option value=""></option>
<option value="a" <?= ($catofdeductor=='a')? 'selected="selected"':'';?>>Central/State Govt/Local Authority[a].</option>
<option value="b" <?= ($catofdeductor=='b')? 'selected="selected"':'';?>>Statutory/Autonomous Bodies[b]</option>
<option value="c" <?= ($catofdeductor=='c')? 'selected="selected"':'';?>>Company[c]</option>
<option value="d" <?= ($catofdeductor=='d')? 'selected="selected"':'';?>>Branch of a Company[d]</option>
<option value="e" <?= ($catofdeductor=='e')? 'selected="selected"':'';?>>Individual/Hindu Undivided Family(Karta)[e]</option>
<option value="f" <?= ($catofdeductor=='f')? 'selected="selected"':'';?>>Branch of Individual Business(Sole proprietorship concern)/Hindu Undivided Family(Karta)[f]</option>
<option value="g" <?= ($catofdeductor=='g')? 'selected="selected"':'';?>>Firm/Association of persons/ Association of persons(Trust)/ Body of Individuals/ Artificial Juridical Person[g].</option>
<option value="h" <?= ($catofdeductor=='h')? 'selected="selected"':'';?>>Branch of Firm/ Association of persons/ Association of persons (Trust) / Body of Individuals/ Artificial Juridical Person[h]. </option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Sub Category of Deductor</p>
</div>
</div>

<div class="col-md-9">
<div class="form-group">
<select name="subcatofdeductor" id="subcid" class="form-control inputborder" onChange="functiontitle(this.value)" style="pointer-events:none;">
<option value=""></option>
<option value="1" <?= ($subcatofdeductor=='1')? 'selected="selected"':'';?>>Central Government</option>
<option value="2" <?= ($subcatofdeductor=='2')? 'selected="selected"':'';?>>State Government</option>
<option value="3" <?= ($subcatofdeductor=='3')? 'selected="selected"':'';?>>Local Authority (Central Govt.)</option>
<option value="4" <?= ($subcatofdeductor=='4')? 'selected="selected"':'';?>>Local Authority ( State Govt.)</option>
<option value="5" <?= ($subcatofdeductor=='5')? 'selected="selected"':'';?>>Statutory Body</option>
<option value="6" <?= ($subcatofdeductor=='6')? 'selected="selected"':'';?>>Autunomous Body</option>
<option value="7" <?= ($subcatofdeductor=='7')? 'selected="selected"':'';?>>Central Govt Co./ Corporation estd.by Central act.</option>
<option value="8" <?= ($subcatofdeductor=='8')? 'selected="selected"':'';?>>State Govt Co./ Corporation estd.by State act.</option>
<option value="9" <?= ($subcatofdeductor=='9')? 'selected="selected"':'';?>>Other Company.</option>
<option value="10" <?= ($subcatofdeductor=='10')? 'selected="selected"':'';?>>Individual</option>
<option value="11" <?= ($subcatofdeductor=='11')? 'selected="selected"':'';?>>HUF</option>
<option value="12" <?= ($subcatofdeductor=='12')? 'selected="selected"':'';?>>Branch of Individual Business</option>
<option value="13" <?= ($subcatofdeductor=='13')? 'selected="selected"':'';?>>Branch of HUF Business</option>
</select>
<label id="subcatofdeductorError" style="color: red; display: none;"></label>
</div>
</div>
</div>
<!-- <script>
  function funcchangesubcat(catid){
    $('#subcid').load('loadcrsubcat.php?action=loadsubcat&catid='+catid+'&selectid=<?php echo $subcatofdeductor; ?>');
  }
  funcchangesubcat('<?php echo $catofdeductor; ?>');
</script> -->
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first">Title of Deductor</p>
</div>
</div>
<div class="col-md-9">
  <div class="form-group">
<select name="titledeductor" id="titledeductor" class="form-control inputborder" style="pointer-events:none;">
<option value=""></option>
<option value="1" <?= ($titledeductor=='1')? 'selected="selected"':'';?>>M/S</option>
<option value="2" <?= ($titledeductor=='2')? 'selected="selected"':'';?>>Shri</option>
<option value="3" <?= ($titledeductor=='3')? 'selected="selected"':'';?>>Smt</option>
<option value="4" <?= ($titledeductor=='4')? 'selected="selected"':'';?>>Kumari</option>
</select>
</div>
</div>
</div>
<!-- <script>
    function functiontitle(subcatid){
        $('#titledeductor').load('loadtitle.php?action=loadtitle&subcatid='+subcatid+'&selectid=<?php echo $titledeductor; ?>');

    }
    functiontitle('<?php echo $subcatofdeductor; ?>');
    
</script> -->

<!--  col-md-6   -->
<!--  row   -->
<div class="dostas">
<div style="display: flex;" class="arr">
<span class="numHead">1</span>
<div class="">
  <input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> readonly>
  </div>

</div>
</div>

<div class="col-md-12">
<div class="row">
</div>
<div class="row officenameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Office.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="officename" value="<?php if($officename!=''){ echo trim($officename); } ?>"  id="officename" readonly>
</div>
</div>
</div>
<div class="row orgnameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Organisation.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="orgname" value="<?php if($orgname!=''){ echo trim($orgname); } ?>"  id="orgname" readonly>
</div>
</div>
</div>
<div class="row deptnameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Department.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="deptname" value="<?php if($deptname!=''){ echo trim($deptname); } ?>"  id="deptname" readonly>
</div>
</div>
</div>
<div class="row ministrynameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Ministry.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="ministryname" value="<?php if($ministryname!=''){ echo trim($ministryname); } ?>"  id="ministryname" readonly>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row companynameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Company.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="companyname" value="<?php if($companyname!=''){ echo trim($companyname); } ?>"  id="companyname" readonly>
</div>
</div>
</div>
<div class="row divisionnameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Division.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="divisionname" value="<?php if($divisionname!=''){ echo trim($divisionname); } ?>"  id="divisionname" readonly>
</div>
</div>
</div>


</div>
<!--   </div>
</div> -->
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row LastNameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Last Name/Surname.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="lastname" value="<?php if($lastname!=''){ echo trim($lastname); } ?>"  id="LastName" readonly>
</div>
</div>
</div>
<div class="row FirstNameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">First Name.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="firstname" value="<?php if($firstname!=''){ echo trim($firstname); } ?>"  id="FirstName" readonly>
</div>
</div>
</div>
<div class="row MiddleNameshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Middle Name.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="middlename" value="<?php if($middlename!=''){ echo trim($middlename); } ?>" id="MiddleName" readonly>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>

<div class="row firmassocnameshow">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Firm Association Name</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="firmassocname" value="<?php if($firmassocname!=''){ echo trim($firmassocname); } ?>"  id="firmassocname" readonly>
</div>
</div>
</div>
</div>
<!--   </div>
</div> -->
</div>
</div>
</div>

<div class="row namelocbranchshow">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name/Location of branch:</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="namelocbranch" value="<?php if($namelocbranch!=''){ echo trim($namelocbranch); } ?>"  id="namelocbranch" readonly>
</div>
</div>
</div>
</div>
</div>
<div class="row desigpersonforpaymentshow">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Designation of person responsible for * <br>(making payment/collecting tax).</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="desigpersonforpayment" value="<?php if($desigpersonforpayment!=''){ echo trim($desigpersonforpayment); } ?>"  id="desigpersonforpayment" readonly>
</div>
</div>
</div>
<label id="addFieldError" style="display:none; color: red;"></label>
<!--Residence address div-->
<div id="ResidenceAddress" style="display:block;">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<h4 class="para br-ffr" for="first"><span class="numHead" style="margin-left: -25px;">2</span>&nbsp;Residence Address</h4>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input class="jiy " type="checkbox" name="addressflag" id="addressflag" value="Y" <?php if($addressflag=='Y'){ echo 'checked'; } ?> readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Flat/Room/Door/Block No.</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrflatorblockno" value="<?php if($addrflatorblockno!=''){ echo trim($addrflatorblockno); } ?>"  id="FlatDoorBlock" readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Name of Premises/Building/Village</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrbuildingorvillage"  value="<?php if($addrbuildingorvillage!=''){ echo trim($addrbuildingorvillage); } ?>"  id="addrbuildingorvillage" readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Road/Street/Lane/Post office</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrpostoffice" value="<?php if($addrpostoffice!=''){ echo trim($addrpostoffice); } ?>"  id="addrpostoffice" readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Area/Locality/Taluka/Sub-Division</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrareasubdivision" value="<?php if($addrareasubdivision!=''){ echo trim($addrareasubdivision); } ?>"  id="addrareasubdivision" readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Town/City/District</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" class="form-control" name="addrtownorcountry" id="addrtownorcountry"  value="<?php if($addrtownorcountry!=''){ echo trim($addrtownorcountry); } ?>"  readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">State Union Territory</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<select class="form-control inputborder fg-gt" name="addrstatecode" id="StateUnion"  style="pointer-events:none;">
<option value=""></option>
<?php
$StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$StateJson = json_decode($StateJson,true);
foreach($StateJson['List'] as $StateData){
?>
<option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$addrstatecode){ echo 'selected'; }?> ><?php echo $StateData['Name']; ?></option>
<?php } ?>
</select>
</div>
</div>
<!--  col-md-6   -->
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">PIN/Zip Code</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="number" class="form-control" name="addrpincode"  value="<?php if($addrpincode!=''){ echo trim($addrpincode); } ?>" id="addrpincode"  readonly>
</div>
</div>
<!--  col-md-6   -->
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Mobile/Telephone</p>
</div>
</div>
<!-- <div class="col-md-2">
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
</div> -->
<div class="col-md-2">
<div class="form-group">
<input type="number" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($STDCODE!='' && $STDCODE!=0){ echo $STDCODE; } ?>" placeholder="Std Code"  readonly>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
<input type="number" name="TELEPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo $TELEPHONE; ?>" placeholder="Enter Number"  readonly>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Email 1</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="email" name="email1" id="email1" class="form-control inputborder yter" value="<?php if($email1!=''){ echo $email1; } ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Email 2</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="email" name="email2" id="email2" class="form-control inputborder yter" value="<?php if($email2!=''){ echo $email2; } ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first"><span class="numHead" style="margin-left: -25px;">3</span>&nbsp;National of Deductor(Tick the appropriate entry)</p>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<input class="jiy " type="checkbox" name="isnationflag" id="isnationflag" value="Y" <?php if($isnationflag=='Y'){ echo 'checked'; } ?> readonly>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="radio" name="NATIONALITY" id="NATIONALITY" value="0" <?php if($NATIONALITY=='0'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');" readonly>
Indian:
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<input class="jiy " type="radio" name="NATIONALITY" id="NATIONALITY" value="1" <?php if($NATIONALITY=='1'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');" readonly>
Foreign:
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first"><span class="numHead" style="margin-left: -25px;">4</span>&nbsp;Permanent Account Number (PAN)</p>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<input class="jiy " type="checkbox" name="ispancr" id="ispancr" value="Y" <?php if($ispancr=='Y'){ echo 'checked'; } ?> readonly>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="panapplicant" id="panapplicant" class="form-control inputborder yter" value="<?php echo $panapplicant; ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
</div>

<div class="row drr">
<div class="col-md-3">
<div class="form-group">
<p class="para" for="first"><span class="numHead" style="margin-left: -20px;">5</span>&nbsp;TAN Cancel Data</p>
</div>
</div>
<div class="col-md-9">
<div class="form-group">
<input class="jiy " type="checkbox" name="tancancelflag" id="tancancelflag" value="Y" <?php if($tancancelflag=='Y'){ echo 'checked'; } ?> readonly>
</div>
</div>
<div class="col-md-3">
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">TAN1 Cancel</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="tancancel1" id="tancancel1" class="form-control" value="<?php if($tancancel1!=''){ echo $tancancel1; } ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">TAN2 Cancel</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="tancancel2" id="tancancel2" class="form-control" value="<?php if($tancancel2!=''){ echo $tancancel2; } ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">TAN3 Cancel</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="tancancel3" id="tancancel3" class="form-control" value="<?php if($tancancel3!=''){ echo $tancancel3; } ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">TAN4 Cancel</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input type="text" name="tancancel4" id="tancancel4" class="form-control" value="<?php if($tancancel4!=''){ echo $tancancel4; } ?>" style="width: 61%;"  readonly>
</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first"><span class="numHead" style="margin-left: -25px;">6</span>&nbsp;Ack. Date(DD-MM-YY)</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<?php
//$date = substr($acknwoledmentdate,0,2).'-';
//$month = substr($acknwoledmentdate,2,2).'-';
//$year = substr($acknwoledmentdate,4,5);
//$acknwoledmentdate = $date.$month.$year;
?>
<input type="text" name="acknwoledmentdate" id="acknwoledmentdate" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr" value="<?php echo dateFormat($acknwoledmentdate); ?>"  <?php if($acknwoledmentdate!=''){ ?>style="width: 61%;pointer-events: none;"<?php } ?> readonly>
</div>
</div>
</div>
</div>
<!-- <div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<p class="para" for="first">Application Date(DD-MM-YY)</p>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<?php
$date = substr($applicationdate,0,2).'-';
$month = substr($applicationdate,2,2).'-';
$year = substr($applicationdate,4,5);
$applicationdate = $date.$month.$year;
?>
<input type="text" name="applicationdate" id="applicationdate" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr  datepicker isdobupdateflagCls" value="<?php if($applicationdate!='--'){ echo date('d-m-Y',strtotime($applicationdate)); } ?>" style="width: 61%;">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div> -->
<h4 class="para br-ffr vtd" for="first">Verification</h4>
<div class="row">
<div class="col-md-12">
<div class="form-group ks-trek">
<p class="para rew" for="first">I/We</p>
<input type="text" class="form-control inputborder" name="verifiername" id="verifiername" value="<?php echo $verifiername; ?>"  readonly>
<p class="para rew" for="first">,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of</p>
<input type="text" class="form-control inputborder" name="verifiercapacitycode" id="verifiercapacitycode" value="<?php echo $verifiercapacitycode; ?>"  readonly>
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
<input type="text" class="form-control " name="verificationplace" id="verificationplace" value="<?php echo $verificationplace; ?>"  readonly>
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
<div class="col-md-6">
<?php
/*if($verificationdate!=''){
$date = substr($verificationdate,0,2).'-';
$month = substr($verificationdate,2,2).'-';
$year = substr($verificationdate,4,5);
$verificationdate = $date.$month.$year;
}*/
?>
<p class="para" for="first"> <input type="text" name="verificationdate" id="verificationdate" value="<?php echo dateFormat($verificationdate); ?>" class="form-control" readonly></p>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
        <input type="hidden" name="action" value="reviewdatasubmit">
        <div class="nxrt" style="width: fit-content; display:none;"> 
    <button type="submit" class="next"> Add <i class="fa fa-angle-right" ></i></button>
          <button type="submit" id="formsubmit" class="next"> Submit <i class="fa fa-angle-right" ></i></button>
        </div>
      </form>
    </div>
    </section>
  </div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ 
      dateFormat: 'dd-mm-yy',
      maxDate: 0
    });
  } );
</script>
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
 var cat = $("#catofdeductor").val();
 if(cat=='a'){
 $('.officenameshow').show();
 $('.orgnameshow').show();
 $('.deptnameshow').show();
 $('.ministrynameshow').show();
 $('.desigpersonforpaymentshow').show();
 $('.companynameshow').hide();
 $('.divisionnameshow').hide();
 $('.namelocbranchshow').hide();
 $('.LastNameshow').hide();
 $('.FirstNameshow').hide();
 $('.MiddleNameshow').hide();
 $('.firmassocnameshow').hide();
}
else if(cat=='b'){
$('.officenameshow').show();
$('.orgnameshow').show();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').show();
$('.companynameshow').hide();
$('.divisionnameshow').hide();
$('.namelocbranchshow').hide();
$('.LastNameshow').hide();
 $('.FirstNameshow').hide();
 $('.MiddleNameshow').hide();
 $('.firmassocnameshow').hide();
}
else if(cat=='c'){
$('.officenameshow').hide();
$('.orgnameshow').hide();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').show();
$('.companynameshow').show();
$('.divisionnameshow').hide();
$('.namelocbranchshow').hide();
$('.LastNameshow').hide();
 $('.FirstNameshow').hide();
 $('.MiddleNameshow').hide();
 $('.firmassocnameshow').hide();
}
else if(cat=='d'){
$('.officenameshow').hide();
$('.orgnameshow').hide();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').show();
$('.companynameshow').show();
$('.divisionnameshow').show();
$('.namelocbranchshow').show();
$('.LastNameshow').hide();
 $('.FirstNameshow').hide();
 $('.MiddleNameshow').hide();
 $('.firmassocnameshow').hide();
}
else if(cat=='e'){
$('.officenameshow').hide();
$('.orgnameshow').hide();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').hide();
$('.companynameshow').hide();
$('.divisionnameshow').hide();
$('.namelocbranchshow').hide();
$('.LastNameshow').show();
 $('.FirstNameshow').show();
 $('.MiddleNameshow').show();
 $('.firmassocnameshow').hide();
}
else if(cat=='f'){
$('.officenameshow').hide();
$('.orgnameshow').hide();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').hide();
$('.companynameshow').hide();
$('.divisionnameshow').hide();
$('.namelocbranchshow').show();
$('.LastNameshow').show();
 $('.FirstNameshow').show();
 $('.MiddleNameshow').show();
 $('.firmassocnameshow').hide();
}
else if(cat=='g'){
$('.officenameshow').hide();
$('.orgnameshow').hide();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').hide();
$('.companynameshow').hide();
$('.divisionnameshow').hide();
$('.namelocbranchshow').hide();
$('.LastNameshow').hide();
 $('.FirstNameshow').hide();
 $('.MiddleNameshow').hide();
 $('.firmassocnameshow').show();
}
else if(cat=='h'){
$('.officenameshow').hide();
$('.orgnameshow').hide();
$('.deptnameshow').hide();
$('.ministrynameshow').hide();
$('.desigpersonforpaymentshow').hide();
$('.companynameshow').hide();
$('.divisionnameshow').hide();
$('.namelocbranchshow').show();
$('.LastNameshow').hide();
 $('.FirstNameshow').hide();
 $('.MiddleNameshow').hide();
 $('.firmassocnameshow').show();
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
