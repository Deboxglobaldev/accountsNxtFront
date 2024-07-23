<?php
include("inc.php");
include "logincheck.php";

	$url = $serverurlapi."User1Entry/callAcknowData.php?aid=".$_GET['aid']; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$data = json_decode($result,true);
curl_close($ch);

$AreaCode = trim($data['recordlist']['AREACODE']);
$AoType = trim($data['recordlist']['AOTYPPE']);
$RangeCode = trim($data['recordlist']['RANGECODE']);
$AoNumber = trim($data['recordlist']['AONO']);
$Title = trim($data['recordlist']['applicanttitlecode']);
$LastName = trim($data['recordlist']['applicantlastname']);
$FirstName = trim($data['recordlist']['applicationfirstname']);
$MiddleName = trim($data['recordlist']['applicantmiddlename']);
$CardName = trim($data['recordlist']['NAMETOBEPRINTED']);
$KnownByOther = trim($data['recordlist']['APPKNOWBY']);
$TitleOther = trim($data['recordlist']['APPOTITLE']);
$LastNameOther = trim($data['recordlist']['APPOLNAME']);
$FirstNameOther = trim($data['recordlist']['APPOFNAME']);
$MiddleNameOther = trim($data['recordlist']['APPOMNAME']);
$ApplicantFatherLastName = trim($data['recordlist']['fatherlastname']);
$ApplicantFatherFirstName = trim($data['recordlist']['fatherfirstname']);
$ApplicantFatherMiddleName = trim($data['recordlist']['fathermiddlename']);
$FlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
$BuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
$RoadStreetLane = trim($data['recordlist']['resipostoffice']);
$AreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
$TownCityDistrict = trim($data['recordlist']['resitownorcountry']);
$TownCityDistrict = explode('~', $TownCityDistrict);
$StateUnion = trim($data['recordlist']['resistatecode']);
$Zip = trim($data['recordlist']['resipincode']);
$AddressType = trim($data['recordlist']['COMMADDRESS']);
if(trim($data['formtype'])=='49AA'){
  if(trim($data['recordlist']['COMADDRESS-TYPE'])==''){
    $COMADDRESSTYPE = 'O';
  }else{ 
    $COMADDRESSTYPE = trim($data['recordlist']['COMADDRESS-TYPE']);
  }

}else{
$COMADDRESSTYPE = trim($data['recordlist']['COMADDRESS-TYPE']);
}
$Gender = trim($data['recordlist']['SEX']);
$ApplicationStatus = trim($data['recordlist']['STATUSOFAPPLICANT']);
$DateAgreement = $data['recordlist']['DATEOFBIRTH'];
$AcknowledgementNumber = trim($data['recordlist']['acknowledmentnumber']);
$ApplicantMotherLastName = trim($data['recordlist']['motherlastename']);
$ApplicantMotherFirstName = trim($data['recordlist']['motherfirstname']);
$ApplicantMotherMiddleName = trim($data['recordlist']['mothermiddlename']);
$NamePrintedCard = trim($data['recordlist']['fatherormothernameoncard']);
$ApplicationCategory = trim($data['recordlist']['ApplicationCategory']);
$Revised = trim($data['formtype']);
$isminor = trim($data['recordlist']['isminor']);

$isResiForeign = trim($data['recordlist']['isResiForeign']);

/////End
?>
<?php
if(isset($_POST['action'])=="dataentryform"){
  
$AREACODE = trim($_POST['AREACODE']);
$AOTYPPE = trim($_POST['AOTYPPE']);
$RANGECODE = trim($_POST['RANGECODE']);
$AONO = trim($_POST['AONO']);
$applicanttitlecode = trim($_POST['applicanttitlecode']);
$applicantlastname = trim($_POST['applicantlastname']);
$applicationfirstname = trim($_POST['applicationfirstname']);
if($applicationfirstname==''){
$applicationfirstname = " ";
}
$applicantmiddlename = trim($_POST['applicantmiddlename']);
if($applicantmiddlename==''){
$applicantmiddlename = " ";
}
$NAMETOBEPRINTED = trim($_POST['NAMETOBEPRINTED']);
if($NAMETOBEPRINTED==''){
$NAMETOBEPRINTED = " ";
}
$APPKNOWBY = trim($_POST['APPKNOWBY']);
$APPOTITLE = trim($_POST['APPOTITLE']);
if($APPOTITLE==''){
$APPOTITLE = " ";
}
$APPOLNAME = trim($_POST['APPOLNAME']);
if($APPOLNAME==''){
$APPOLNAME = " ";
}
$APPOFNAME = trim($_POST['APPOFNAME']);
if($APPOFNAME==''){
$APPOFNAME = " ";
}
$APPOMNAME = trim($_POST['APPOMNAME']);
if($APPOMNAME==''){
$APPOMNAME = " ";
}
$fatherlastname = trim($_POST['fatherlastname']);
if($fatherlastname==''){
$fatherlastname = " ";
}
$fatherfirstname = trim($_POST['fatherfirstname']);
if($fatherfirstname==''){
$fatherfirstname = " ";
}
$fathermiddlename = trim($_POST['fathermiddlename']);
if($fathermiddlename==''){
$fathermiddlename = " ";
}
$resiflatorblockno = trim($_POST['resiflatorblockno']);
if($resiflatorblockno==''){
$resiflatorblockno = " ";
}
$resibuildingorvillage = trim($_POST['resibuildingorvillage']);
if($resibuildingorvillage==''){
$resibuildingorvillage = " ";
}
$resipostoffice = trim($_POST['resipostoffice']);
if($resipostoffice==''){
$resipostoffice = " ";
}
$resiareasubdivision = trim($_POST['resiareasubdivision']);
if($resiareasubdivision==''){
$resiareasubdivision = " ";
}

//////////////
$resitownorcountry = trim($_POST['resitownorcountry']);
$resistatecode = trim($_POST['resistatecode']);
$resipincode = trim($_POST['resipincode']);
$foreigncountryrsd = trim($_POST['foreigncountryrsd']);
$resizipcode = trim($_POST['resizipcode']);
$isotherresi = trim($_POST['isotherresi']);

if($resitownorcountry==''){
$resitownorcountry = " ";
}

if($resizipcode!='' && $isotherresi=='Y'){
$resitownorcountry = $resitownorcountry.'~'.$foreigncountryrsd.'~'.$resizipcode;
}

if($resistatecode==''){
$resistatecode = " ";
}


if($resipincode==''){
$resipincode = " ";
}


if(trim($_POST['resiflatorblockno'])==''){
  $resipincode='';
  $resistatecode='';
}
/////////////

$SEX = trim($_POST['SEX']);

$STATUSOFAPPLICANT = trim($_POST['STATUSOFAPPLICANT']);
$DATEOFBIRTH = str_replace('-','',trim($_POST['DATEOFBIRTH']));
if($DATEOFBIRTH==''){
$DATEOFBIRTH = " ";
}
$acknowledmentnumber = trim($_POST['acknowledmentnumber']);
$motherlastename = trim($_POST['motherlastename']);
if($motherlastename==''){
$motherlastename = " ";
}
$motherfirstname = trim($_POST['motherfirstname']);
if($motherfirstname==''){
$motherfirstname = " ";
}
$mothermiddlename = trim($_POST['mothermiddlename']);
if($mothermiddlename==''){
$mothermiddlename = " ";
}
$fatherormothernameoncard = trim($_POST['fatherormothernameoncard']);
if($fatherormothernameoncard==''){
$fatherormothernameoncard = " ";
}

$formJson = '{ "AREACODE": "'.$AREACODE.'", "AOTYPPE": "'.$AOTYPPE.'", "RANGECODE": "'.$RANGECODE.'", "AONO": "'.$AONO.'", "applicanttitlecode": "'.$applicanttitlecode.'", "applicantlastname": "'.$applicantlastname.'", "applicationfirstname": "'.$applicationfirstname.'", "applicantmiddlename": "'.$applicantmiddlename.'", "NAMETOBEPRINTED": "'.$NAMETOBEPRINTED.'", "APPKNOWBY": "'.$APPKNOWBY.'", "APPOTITLE": "'.$APPOTITLE.'", "APPOLNAME": "'.$APPOLNAME.'", "APPOFNAME": "'.$APPOFNAME.'", "APPOMNAME": "'.$APPOMNAME.'", "SEX": "'.$SEX.'","fatherlastname": "'.$fatherlastname.'", "fatherfirstname": "'.$fatherfirstname.'", "fathermiddlename": "'.$fathermiddlename.'", "resiflatorblockno": "'.$resiflatorblockno.'", "resibuildingorvillage": "'.$resibuildingorvillage.'", "resipostoffice": "'.$resipostoffice.'", "resiareasubdivision": "'.$resiareasubdivision.'", "resitownorcountry": "'.$resitownorcountry.'", "resistatecode": "'.$resistatecode.'", "resipincode": "'.$resipincode.'", "STATUSOFAPPLICANT": "'.$STATUSOFAPPLICANT.'", "DATEOFBIRTH": "'.$DATEOFBIRTH.'",  "acknowledmentnumber": "'.$acknowledmentnumber.'","motherlastename": "'.$motherlastename.'", "motherfirstname": "'.$motherfirstname.'", "mothermiddlename": "'.$mothermiddlename.'", "fatherormothernameoncard": "'.$fatherormothernameoncard.'", "residencezip": "'.$resizipcode.'", "OFFICENAME": "'.$data['recordlist']['OFFICENAME'].'", "officeflatorblock": "'.$data['recordlist']['officeflatorblock'].'", "officebuildingorvillage": "'.$data['recordlist']['officebuildingorvillage'].'", "officestreeorpostoffice": "'.$data['recordlist']['officestreeorpostoffice'].'", "officeareaorsubdivision": "'.$data['recordlist']['officeareaorsubdivision'].'", "officetownorcontry": "'.$data['recordlist']['officetownorcontry'].'", "officestatecode": "'.$data['recordlist']['officestatecode'].'", "officepincode": "'.$data['recordlist']['officepincode'].'", "COMMADDRESS": "'.$data['recordlist']['COMMADDRESS'].'", "countryisd": "'.$data['recordlist']['countryisd'].'", "STDCODE": "'.$data['recordlist']['STDCODE'].'", "TELPHONE": "'.$data['recordlist']['TELPHONE'].'", "EMAIL": "'.$data['recordlist']['EMAIL'].'", "REGNUM": "'.$data['recordlist']['REGNUM'].'", "INDIANCITIZEN": "'.$data['recordlist']['INDIANCITIZEN'].'", "ADHARNUM": "'.$data['recordlist']['ADHARNUM'].'", "adharflag": "'.$data['recordlist']['adharflag'].'", "adharenrolmentid": "'.$data['recordlist']['adharenrolmentid'].'", "nameasadhar": "'.$data['recordlist']['nameasadhar'].'", "countryofcitizen": "'.$data['recordlist']['countryofcitizen'].'","isdcodeofcitizencountry":"'.$data['recordlist']['isdcodeofcitizencountry'].'", "issalried": "'.$data['recordlist']['issalried'].'", "orgname": "'.$data['recordlist']['orgname'].'", "isbusinessorprofession": "'.$data['recordlist']['isbusinessorprofession'].'", "businessorprfessioncode": "'.$data['recordlist']['businessorprfessioncode'].'", "anotherincomesrctypecode": "'.$data['recordlist']['anotherincomesrctypecode'].'", "ratitlecode": "'.$data['recordlist']['ratitlecode'].'", "ralastname": "'.$data['recordlist']['ralastname'].'", "rafistname": "'.$data['recordlist']['rafistname'].'", "ramiddlename": "'.$data['recordlist']['ramiddlename'].'", "raflatorblock": "'.$data['recordlist']['raflatorblock'].'", "rabuildingorvillage": "'.$data['recordlist']['rabuildingorvillage'].'", "streetorpostoffice": "'.$data['recordlist']['streetorpostoffice'].'", "raareasubdivision": "'.$data['recordlist']['raareasubdivision'].'", "ratownorcountry": "'.$data['recordlist']['ratownorcountry'].'", "rastatecode": "'.$data['recordlist']['rastatecode'].'", "rapincoe": "'.$data['recordlist']['rapincoe'].'", "POI": "'.$data['recordlist']['POI'].'", "POA": "'.$data['recordlist']['POA'].'", "dobdocumentcode": "'.$data['recordlist']['dobdocumentcode'].'", "profofdateofbirth": "'.$data['recordlist']['profofdateofbirth'].'", "iskyc": "'.$data['recordlist']['iskyc'].'","acknwoledmentdate": "'.$data['recordlist']['acknwoledmentdate'].'", "isphysicalpanwanted": "'.$data['recordlist']['isphysicalpanwanted'].'","isphotoattached": "'.$data['recordlist']['isphotoattached'].'","issignatureattached": "'.$data['recordlist']['issignatureattached'].'","isminor": "'.$data['recordlist']['isminor'].'","isdiscreattinfclevel":"'.$data['recordlist']['isdiscreattinfclevel'].'","dateofdescreresolution": "'.$data['recordlist']['dateofdescreresolution'].'","verifiername": "'.$data['recordlist']['verifiername'].'","verifiercapcitycode": "'.$data['recordlist']['verifiercapcitycode'].'","verificationplace": "'.$data['recordlist']['verificationplace'].'","verificationdate": "'.$data['recordlist']['verificationdate'].'","modeofapplication": "'.$data['recordlist']['modeofapplication'].'","acknowledmentnumber": "'.$data['recordlist']['acknowledmentnumber'].'", "officezip": "'.$data['recordlist']['officezip'].'" }';

  //$post = json_encode($post,JSON_PRETTY_PRINT);
  $jsonPost = '{ "status": "0", "message": "Update Record", "page": "1", "formtype": "'.$Revised.'", "Role": "'.$_SESSION['ROLE'].'", "recordlist":'.$formJson.'}';
  
  logger("JSON to post for dataenrty form 1----".$jsonPost);
   
  $url = $serverurlapi."User1Entry/PanDataUpdateAPI.php";
  
  logger("URL to hit on dataenrty form 1----".$url);
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $response = curl_exec($ch);
  curl_close($ch);
  $res = json_decode($response,true);
  
  logger("Response return from dataentry page 1 ----".$response);
  
  if($res['status']=='0'){
  $location = 'dataentry.php?aid='.$AcknowledgementNumber.'&formType='.$res['formtype'].'&page=3';
?>
<script>
  parent.window.location.href = '<?php echo $location; ?>'; 
</script>
<?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Data Entry Form 1</title>
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
.form-control{
color: #324148;
padding: 0.175rem 0.75rem;
height: calc(1.75rem + 4px);
border-radius: 0.2rem;
margin-bottom: 8px;
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
</style>

<script>
  $(document).ready(function () {
  $('#AOJSON').selectize({
    sortField: 'text'
  });
});
</script>
</head>
<body  style="overflow: hidden;">
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="margin-left: 0px!important;padding: 0px!important;">
    <!-- <div style="background:transparent;">

</div> -->
    <!-- Row -->
    <div class="row">
		<div class="col-xl-12">
			<section class="hk-sec-wrapper" >
				  <div class="container-fluid" >
					<form name="curl_form" method="post" autocomplete="off" id="dataentry1" action="" enctype="multipart/form-data"  >
			  <input type="hidden" name="WARDCIRCLE"  value=" " />
			  <input type="hidden" name="RANGE"  value=" " />
			  <input type="hidden" name="COMMISSIONER"  value=" " />
			  <input type="hidden" name="applicantcategorycode"  value=" " />
			  <table class="table table-bordered">
				<thead>
				  <tr>
					<!-- <th scope="col" style="text-align: center;color:#000;font-weight: 300;" colspan="2">Search : (Area Code)-(AO Type)-(Range Code)-(AO No)-(Desc.)-(City)</th> -->
					<th scope="col" colspan="4" style="text-align: center;color:#79c117;"> 
					<select name="AOJSON" id="AOJSON" class="form-control " onChange="funcSelecetAo(this.value);" placeholder="Search..." autocomplete="false">
						<option value="">(Area Code)-(AO Type)-(Range Code)-(AO No)-(Desc.)-(City)</option>
						<?php
									  //$AoJson = file_get_contents($serverurlapi."Dashboards/masterscache/aoMaster.json");
							         //$AoJson = json_decode($AoJson,true);
									 
									 $options = [
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ],
];

$context = stream_context_create($options);
$AoJson = file_get_contents($serverurlapi . "Dashboards/masterscache/aoMaster.json", false, $context);
$AoJson = json_decode($AoJson, true);
									 
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
					<th scope="col" style="text-align: center;color:#000;font-weight: 300;">Area Code</th>
					<th scope="col"  style="text-align: center;color:#000;font-weight:300;">AO Type</th>
					<th scope="col"  style="text-align: center;color:#000;font-weight:300;">Range Code</th>
					<th scope="col"  style="text-align: center;color:#000;font-weight:300;">AO Number</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td scope="row"><input type="text" class="form-control inputborder gc-xc" name="AREACODE" value="<?php echo $AreaCode; ?>" id="AreaCode" required  ></td>
					<td><input type="text" class="form-control inputborder gc-xc" name="AOTYPPE" value="<?php echo $AoType; ?>" id="AoType" required  ></td>
					<td><input type="text" class="form-control inputborder gc-xc" name="RANGECODE" value="<?php echo $RangeCode; ?>" id="RangeCode" required  ></td>
					<td><input type="text" class="form-control inputborder gc-xc" name="AONO" value="<?php echo $AoNumber; ?>" id="AoNumber" required  ></td>
				  </tr>
				</tbody>
			  </table>
			  
			  <div class="dostas">
				<div style="display: flex;" class="arr">
				  <div class="dostas2"></div>
				  <h5 style="font-weight: 300;">Applicant Personal Details</h5>
				  <div class="dostas1"> </div>
				</div>
			  </div>
			  
			  <div class="row">
			  	<div style="display: grid;grid-template-columns: auto auto;width: 100%;">
				<?php if($ApplicationStatus=='P'){ ?>
				<div class="col-md-12">
				  <div class="form-group">
					<div class="para" for="first" style="padding-left: 0px;">Photo</div>
					<div class="ast" style=""> <img src="data/temp/crop/<?php echo $_GET['aid']; ?>_Photo.Jpg" style="width: 100%;border: 1px solid #79c117;"> </div>
				  </div>
				</div>
				<?php } ?>
				<?php if($ApplicationStatus=='P'){ ?>
				<div class="col-md-12">
				  <div class="form-group">
					<div class="para" for="first" style="padding-left: 0px;">Signature</div>
					<div class="ast1" style=""> 
						<img  style="width: 100%;border: 1px solid #79c117;" src="data/temp/crop/<?php echo $_GET['aid']; ?>_Sig.Jpg"> </div>
						
				  </div>
				</div>
				<?php } ?>
				</div>
				<div class="col-md-12">
				  <div class="row">
					<div class="col-md-4">
					  <div class="form-group">
						<p class="para" for="first">Application&nbsp;Status&nbsp;*</p>
					  </div>
					</div>
					<div class="col-md-8">
					  <select name="STATUSOFAPPLICANT" id="ApplicationStatus" class="form-control inputborder" onChange="funcCheckAddType();">
						<option value="">Select</option>
						<?php
									 // $ApplicationStatusJson = file_get_contents($serverurlapi."Dashboards/masterscache/applicantStatus_pan.json");
									  //$ApplicationStatusJson = json_decode($ApplicationStatusJson,true);
									  $context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);

// Fetch the data using file_get_contents with the stream context
$ApplicationStatusJson = file_get_contents($serverurlapi . "Dashboards/masterscache/applicantStatus_pan.json", false, $context);

// Decode the JSON response
$ApplicationStatusJson = json_decode($ApplicationStatusJson, true);
									  
									  
									  foreach($ApplicationStatusJson['List'] as $ApplicationStatusData){
									  ?>
						<option value="<?php echo $ApplicationStatusData['Code']; ?>" <?php if($ApplicationStatusData['Code']==$ApplicationStatus){ echo 'selected'; }?> ><?php echo $ApplicationStatusData['Status'].' ['.$ApplicationStatusData['Code'].']'; ?></option>
						<?php } ?>
					  </select>
					  <label id="ApplicationStatusError" style="color: red; display: none;"></label>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<p class="para" for="first">Acknowledgement&nbsp;No&nbsp;*</p>
					  </div>
					</div>
					<div class="col-md-8">
					  <input type="text" class="form-control inputborder" name="acknowledmentnumber" value="<?php echo $AcknowledgementNumber; ?>" id="AcknowledgementNumber" readonly>
					  <label id="AcknowledgementNumberError" style="color: red; display: none;"></label>
					</div>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="row">
					<div class="col-md-12">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead">1</span>&nbsp;Full&nbsp;Name&nbsp;(Last,First,Middle)*</p>
					  </div>
					</div>
					<!-- <div class="col-md-1">
							<div class="form-group"> -->
					<div class="col-md-12">
					  <div class="form-group">
						<select name="applicanttitlecode" class="form-control inputborder" id="Title"  style="padding: 0px !important;" required>
						  <?php if($ApplicationStatus=='P'){ ?>
						 	 <?php if($Revised=='49A'){ ?>
							  <?php if($Gender=='M'){ ?>
							  <option value="1" <?php if($Title==1){ echo 'selected'; } ?>>Shri</option>
							  <?php }elseif($Gender=='F'){ ?>
							  <option value="">Select</option>
							  <option value="2" <?php if($Title==2){ echo 'selected'; } ?>>Smt/Mrs</option>
							  <option value="3" <?php if($Title==3){ echo 'selected'; } ?>>Kumari/Ms</option>
						  	  <?php }elseif($Gender=='T'){ ?>
							  <option value="">Select</option>
							  <option value="1" <?php if($Title==1){ echo 'selected'; } ?>>Shri</option>
							  <option value="2" <?php if($Title==2){ echo 'selected'; } ?>>Smt/Mrs</option>
							  <option value="3" <?php if($Title==3){ echo 'selected'; } ?>>Kumari/Ms</option>
							  <?php } ?>
							  <?php }else{ ?>
							   <option value="">Select</option>
							  <option value="1" <?php if($Title==1){ echo 'selected'; } ?>>Shri</option>
							  <option value="2" <?php if($Title==2){ echo 'selected'; } ?>>Smt/Mrs</option>
							  <option value="3" <?php if($Title==3){ echo 'selected'; } ?>>Kumari/Ms</option>
							  <?php } ?>
						  <?php }else{ ?>
						  <option value="4" <?php if($Title==4){ echo 'selected'; } ?>>M/s</option>
						  <?php } ?>
						</select>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="applicantlastname" value="<?php echo $LastName; ?>" id="LastName" onKeyDown="upperCaseF(this);" autocomplete="nope" <?php if($ApplicationStatus=='P'){ ?>maxlength="25"<?php }else{ ?>maxlength="75"<?php } ?>>
						<label id="LastNameError" style="color: red;display:none;"></label>
					  </div>
					  
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="applicationfirstname" value="<?php echo $FirstName; ?>" id="FirstName" onKeyDown="upperCaseF(this)" maxlength="25" autocomplete="nope">
						<label id="FirstNameError" style="color: red;display:none;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="applicantmiddlename" value="<?php echo $MiddleName;  ?>" id="MiddleName" onKeyDown="upperCaseF(this)" maxlength="25" autocomplete="nope">
						<label id="MiddleNameError" style="color: red;display:none;"></label>
					  </div>
					</div>
				  </div>
				</div>
				<!--   </div>
							</div> -->
			  
				<div class="col-md-12">
				  <div class="row">
					<div class="col-md-4">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead">2</span>&nbsp;Card&nbsp;Display&nbsp;Name*</p>
					  </div>
					</div>
					<!-- <div class="col-md-1">
							<div class="form-group"> nbvu-test -->
					<div class="col-md-8">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="NAMETOBEPRINTED" value="<?php echo $CardName; ?>" id="CardName" onKeyDown="upperCaseF(this);"  maxlength="85">
						<label id="" style="color: red; display:none;"></label>
					  </div>
					</div>
				  </div>
				</div>
			  
				<div class="col-md-12">
				  <div class="row">
					<div class="col-md-4">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead">3</span>&nbsp;Known by any other Name?</p>
					  </div>
					</div>
					<div class="col-md-8">
					  <div class="form-group">
						<select name="APPKNOWBY" class="form-control inputborder" onChange="showdiv(this.value);" id="KnownByOther">
						  <option value="N" <?php if($KnownByOther=='N'){ echo 'selected'; } ?>>No</option>
						  <option value="Y" <?php if($KnownByOther=='Y'){ echo 'selected'; } ?>>Yes</option>
						</select>
					  </div>
					</div>
				  </div>
				</div>
			 
			  <div class="" id="otherNameDiv" style="display:none;">
				<div class="col-md-12">
				  <div class="row">
					<div class="col-md-12">
					  <div class="form-group">
						<p class="para" for="first">Full&nbsp;Name&nbsp;Other(Initial,Last,First,Middle)*</p>
					  </div>
					</div>
					<!-- <div class="col-md-1">
							<div class="form-group"> -->
					<div class="col-md-12">
					  <div class="form-group">
						<select name="APPOTITLE" class="form-control inputborder" style="padding: 0px !important;">
							  <option value="">Select</option>
						  <?php if($ApplicationStatus=='P'){ ?>
						  	<?php if($Revised=='49A'){ ?>
							  <?php if($Gender=='M'){ ?>
							  <option value="1" <?php if($TitleOther==1){ echo 'selected'; } ?>>Shri</option>
							  <?php }elseif($Gender=='F'){ ?>
							  <option value="2" <?php if($TitleOther==2){ echo 'selected'; } ?>>Smt/Mrs</option>
							  <option value="3" <?php if($TitleOther==3){ echo 'selected'; } ?>>Kumari/Ms</option>
						  	  <?php }elseif($Gender=='T'){ ?>
							  <option value="1" <?php if($TitleOther==1){ echo 'selected'; } ?>>Shri</option>
							  <option value="2" <?php if($TitleOther==2){ echo 'selected'; } ?>>Smt/Mrs</option>
							  <option value="3" <?php if($TitleOther==3){ echo 'selected'; } ?>>Kumari/Ms</option>
							  <?php } }else{ ?>
							  <option value="1" <?php if($TitleOther==1){ echo 'selected'; } ?>>Shri</option>
							  <option value="2" <?php if($TitleOther==2){ echo 'selected'; } ?>>Smt/Mrs</option>
							  <option value="3" <?php if($TitleOther==3){ echo 'selected'; } ?>>Kumari/Ms</option>
							  <?php } ?>
						  <?php }else{ ?>
						  <option value="4" <?php if($TitleOther==4){ echo 'selected'; } ?>>M/s</option>
						  <?php } ?>
						</select>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="APPOLNAME" id="LastNameOther" value="<?php echo $LastNameOther; ?>" <?php if($ApplicationStatus=='P'){ ?>maxlength="25"<?php }else{ ?>maxlength="75"<?php } ?> onKeyDown="upperCaseF(this)">
						<label id="LastNameOtherError" style="color: red;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="APPOFNAME" id="FirstNameOther" value="<?php echo $FirstNameOther; ?>" maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="FirstNameOtherError" style="color: red;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="APPOMNAME" id="MiddleNameOther"  value="<?php echo $MiddleNameOther;  ?>"  maxlength="25"  onKeyDown="upperCaseF(this)">
						<label id="MiddleNameOtherError" style="color: red;"></label>
					  </div>
					</div>
				  </div>
				</div>
				<script>
							function showdiv(id){
							if(id=='Y'){
							$('#otherNameDiv').show();
							}else{
							$('#otherNameDiv').css('display','none');
							}
							}
							showdiv('<?php echo $KnownByOther; ?>');
							
							</script>
				<!--   </div>
							</div> -->
			  </div>
			  <!--   </div>
							</div> -->
			  <!--  col-md-6   -->
			  
			  <div class="col-md-12">
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead">4</span>&nbsp;Gender&nbsp;</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <select name="SEX" class="form-control inputborder" id="Gender"   <?php if($ApplicationStatus!='P'){ ?> style=" display:none;" <?php  }?>>
						<option value="">Select</option>
						<option value="M" <?php if($Gender=='M'){ echo 'Selected'; } ?>>Male</option>
						<option value="F" <?php if($Gender=='F'){ echo 'Selected'; } ?>>Female</option>
						<option value="T" <?php if($Gender=='T'){ echo 'Selected'; } ?>>Transgender</option>
					  </select>
					</div>
				  </div>
				</div>
			  </div>
			   
			  <div class="col-md-12">
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <?php
							 $DOB = $DateAgreement;
							$date = substr($DOB,0,2).'-';
							$month = substr($DOB,2,2).'-';
							$year = substr($DOB,4,5);
							$DOB = $date.$month.$year;
							?>
					  <p class="para" for="first"><span class="numHead">5</span>&nbsp;Date of Birth/Agreement&nbsp;*</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" name="DOB" id="DateAgreement" onChange="getDate(this.value);" class="form-control inputborder  datepicker" value="<?php if($DateAgreement!=''){ echo $DOB; }?>" maxlength="10">
					  <input type="hidden" name="DATEOFBIRTH" id="DATEOFBIRTH" value="<?php echo $DateAgreement; ?>">
					  <script>
							function getDate(dobValue){
							  var newdobval = dobValue.replace('-','');
							  final = newdobval.replace('-','');
							  $('#DATEOFBIRTH').val(final);
							}
							</script>
					</div>
				  </div>
				</div>
			  </div>
			  
			  
				<div class="col-md-12">
				  <div class="row">
					<div class="col-md-12">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead">6.</span>Father&nbsp;Name&nbsp;(Last,First,Middle)</p>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="fatherlastname" value="<?php echo $ApplicantFatherLastName; ?>" id="ApplicantFatherLastName"  maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="ApplicantFatherLastNameError" style="color: red; display:none;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="fatherfirstname" value="<?php echo $ApplicantFatherFirstName; ?>" id="ApplicantFatherFirstName"  maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="ApplicantFatherFirstNameError" style="color: red; display:none;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="fathermiddlename" value="<?php echo $ApplicantFatherMiddleName; ?>"  id="ApplicantFatherMiddleName" maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="ApplicantFatherMiddleNameError" style="color: red; display:none;"></label>
					  </div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-md-12">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Mother&nbsp;Name&nbsp;(Last,First,Middle)</p>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="motherlastename" id="ApplicantMotherLastName" value="<?php echo $ApplicantMotherLastName; ?>" maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="ApplicantMotherLastNameError" style="color: red;display:none;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="motherfirstname" value="<?php echo $ApplicantMotherFirstName; ?>" id="ApplicantMotherFirstName" maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="ApplicantMotherFirstNameError" style="color: red;display:none;"></label>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="text" class="form-control inputborder" name="mothermiddlename" value="<?php echo $ApplicantMotherMiddleName; ?>" id="ApplicantMotherMiddleName" maxlength="25" onKeyDown="upperCaseF(this)">
						<label id="ApplicantMotherMiddleNameError" style="color: red;display:none;"></label>
					  </div>
					</div>
				  </div>
				
			  
				  <div class="row">
					<div class="col-md-12">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Name to be printed on card(Father/Mother)</p>
					  </div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<select name="fatherormothernameoncard" id="NamePrintedCard" class="form-control inputborder"   <?php if($ApplicationStatus!='P'){ ?> style=" display:none;" <?php  } ?>>
						  <option value="">Select</option>
						  <option value="F" <?php if($NamePrintedCard=='F'){ echo 'selected'; } ?>>Father</option>
						  <option value="M" <?php if($NamePrintedCard=='M'){ echo 'selected'; } ?>>Mother</option>
						  <option value="S" <?php if($NamePrintedCard=='S'){ echo 'selected'; } ?>>Single Parent [Mother]</option>
						</select>
					  </div>
					</div>
				  </div>
				</div>
			  <div class="col-md-12">
			  <label id="addFieldError" style="display:none; color: red;"></label>
			  <!--Residence address div-->
			  <div id="ResidenceAddress" style="display:block;">
				
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <h4 class="para br-ffr review-title" for="first"><span class="numHead">7.</span>Residence Address </h4>
					</div>
				  </div>
				  <div class="col-md-8">
					<div id="isForeignDiv" style="margin-left:15px;">
					  <div class="row">
						<div class="col-md-5">
						  <p class="para" for="first">Is&nbsp;Foreign&nbsp;Address</p>
						</div>
						<div class="col-md-7">
						  <input type="radio" class="js-trek" name="isotherresi" <?php if($isResiForeign=='Y'){ echo 'Checked'; }  ?> value="Y" onChange="funcIsForeignAddRes('<?php echo $COMADDRESSTYPE; ?>');"  >
						  Y
						  &nbsp;&nbsp;&nbsp;
						  <input type="radio" class="js-trek"  name="isotherresi" <?php if($isResiForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddRes('<?php echo $COMADDRESSTYPE; ?>');"  >
						  N </div>
					  </div>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Flat/Room/Door/Block No.</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" class="form-control inputborder fieldAddress notEqualToClass" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>" maxlength="25" id="FlatDoorBlock" onKeyDown="upperCaseF(this)">
					  <label id="FlatDoorBlockError" style="display:none; color: red;"></label>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Name of Premises/Building/Village</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" class="form-control inputborder fieldAddress notEqualToClass" name="resibuildingorvillage"  value="<?php if($BuildingPremises!=''){ echo trim($BuildingPremises); } ?>" maxlength="25" id="BuildingPremises" onKeyDown="upperCaseF(this)">
					  <label id="BuildingPremisesError" style="display:none; color: red;"></label>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Road/Street/Lane/Post office</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" class="form-control inputborder fieldAddress notEqualToClass" name="resipostoffice" value="<?php if($RoadStreetLane!=''){ echo trim($RoadStreetLane); } ?>" maxlength="25" id="RoadStreetLane" onKeyDown="upperCaseF(this)">
					  <label id="RoadStreetLaneError" style="display:none; color: red;"></label>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Area/Locality/Taluka/Sub-Division</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" class="form-control inputborder fieldAddress notEqualToClass" name="resiareasubdivision" value="<?php if($AreaLocalityTaluka!=''){ echo trim($AreaLocalityTaluka); } ?>" maxlength="25" id="AreaLocalityTaluka" onKeyDown="upperCaseF(this)">
					  <label id="AreaLocalityTalukaError" style="display:none; color: red;"></label>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Town/City/District</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" class="form-control inputborder" name="resitownorcountry" id="TownCityDistrict"  value="<?php if($TownCityDistrict!=''){ echo trim($TownCityDistrict[0]); } ?>" maxlength="25" onKeyDown="upperCaseF(this)">
					  <label id="TownCityDistrictError" style="display:none; color: red;"></label>
					  <input type="hidden" name="" value="<?php if($TownCityDistrict!=''){ echo trim($data['recordlist']['resitownorcountry']); } ?>">
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>State Union Territory</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <select class="form-control inputborder" name="resistatecode" id="StateUnion"  onChange="funcChangeStateRes(this.value,'<?php echo $COMADDRESSTYPE; ?>');funcGetResStateVal(this.value);">
						<option value="">Select</option>
						<?php
										  //$StateJson = file_get_contents($serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
										  //$StateJson = json_decode($StateJson,true);
										  
										  
										  
										  $context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);

// Fetch the data using file_get_contents with the stream context
$StateJson = file_get_contents($serverurlapi . "Dashboards/masterscache/stateMaster_pan.json", false, $context);

// Decode the JSON response
$StateJson = json_decode($StateJson, true);
										  
										  
										  
										  
										  
										  foreach($StateJson['List'] as $StateData){
											if($COMADDRESSTYPE=='O'){
											 $add = "ADDRESS OF DEFENCE EMPLOYEES";
											}else{
											 $add = "FOREIGN ADDRESS";
											}
											if($StateData['Code']!='99'){
										  ?>
						<option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$StateUnion){ echo 'selected'; }?>  ><?php echo $StateData['Name']; ?></option>
						<?php } } ?>
						<option value="99" <?php if($Zip==999999){ echo 'selected'; } ?>  >FOREIGN ADDRESS</option>
						<option value="99" <?php if($Zip==888888){ echo 'selected'; } ?>  >ADDRESS OF DEFENCE EMPLOYEES</option>
					  </select>
					  <input type="hidden" name="resistatecode" id="hiddenresistatecode" value="" >
					  <label id="StateUnionError" style="display:none; color: red;"></label>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>PIN/Zip Code</p>
					</div>
				  </div>
				  <div class="col-md-8">
					<div class="form-group">
					  <input type="text" class="form-control inputborder" name="resipincode"  value="<?php echo $Zip; ?>"  id="Zip" maxlength="6">
					  <input type="text" class="form-control inputborder" name="resizipcode" value="<?php echo $TownCityDistrict[2]; ?>" id="NewZip"  style="display: none;" maxlength="7">
					  <label id="ZipError" style="display:none; color: red;"></label>
					</div>
				  </div>
				  <!--  col-md-6   -->
				</div>
				<div id="foreigncountryrsdDiv" style="display:none;" >
				  <div class="row">
					<div class="col-md-4">
					  <div class="form-group">
						<p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Country</p>
					  </div>
					</div>
					<div class="col-md-8">
					  <div class="form-group">
						<select class="form-control inputborder" name="foreigncountryrsd" id="foreigncountryrsd">
						  <option value="">Select</option>
						  <?php
										//$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
										//$CountryJson = json_decode($CountryJson,true);
										$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);

// Fetch the data using file_get_contents with the stream context
$CountryJson = file_get_contents($serverurlapi . "Dashboards/masterscache/countryMaster_pan.json", false, $context);

// Decode the JSON response
$CountryJson = json_decode($CountryJson, true);
										
										
										foreach($CountryJson['List'] as $CountryData){
										?>
						  <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$TownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
						  <?php } ?>
						</select>
						<label id="StateUnionError" style="display:none; color: red;"></label>
					  </div>
					</div>
					<!--  col-md-6   -->
				  </div>
				</div>
				
			  </div>
			  </div>
			  </div>
			  </section>
			  </div>
			  <input type="hidden" name="action" value="dataentryform">
			  <input type="hidden" name="formtype" value="<?php echo $Revised; ?>">
			  <div class="nxrt" style="width: fit-content; display:none;"><a href="#" class="previous"><i class="fa fa-angle-left" ></i> Back</a>
				<button type="submit" id="formsubmit" class="next"> Save and move to next section <i class="fa fa-angle-right" ></i></button>
			  </div>
			</form>
				  </div>
			</section>
		</div>
	</div>
</div>
</div>
</div>
<!--<script src="js/dataentryfromvalidate.js"></script>-->
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ 
      dateFormat: 'dd-mm-yy',
      maxDate: 0
    });
  } );
</script>
<script>

if($('#ApplicationStatus').val()!='P'){
		$('#MiddleName').attr('readonly', true);
		$('#FirstName').attr('readonly', true);
		$('#MiddleNameOther').attr('readonly', true);
		$('#FirstNameOther').attr('readonly', true);
		$('#ApplicantFatherLastName').attr('readonly', true);
		$('#ApplicantFatherFirstName').attr('readonly', true);
		$('#ApplicantFatherMiddleName').attr('readonly', true);
		$('#ApplicantMotherLastName').attr('readonly', true);
		$('#ApplicantMotherFirstName').attr('readonly', true);
		$('#ApplicantMotherMiddleName').attr('readonly', true);
}

function funcCheckAddType(){
	var ApplicationStatus = $('#ApplicationStatus').val();
	if(ApplicationStatus=='P' || ApplicationStatus=='A' || ApplicationStatus=='H' || ApplicationStatus=='B' || ApplicationStatus=='J'){
		$("#ResidenceAddress").css('display','block');
	}else if(ApplicationStatus=='F' || ApplicationStatus=='E' || ApplicationStatus=='C' || ApplicationStatus=='L' || ApplicationStatus=='G' || ApplicationStatus=='T'){
		$("#ResidenceAddress").css('display','none');
	}
}
funcCheckAddType();

function funcChangeStateRes(stateid,COMADDRESSTYPE){
 var indianOther = COMADDRESSTYPE;
 var isForeignFlag = $("input:radio[name=isotherresi]:checked").val();
 if(stateid=='99' && isForeignFlag=='N'){
  $('#Zip').val("888888");
 }
}
funcChangeStateRes('<?php echo $StateUnion; ?>','<?php echo $COMADDRESSTYPE; ?>');

function funcIsForeignAddRes(COMADDRESSTYPE){

  var isForeign = $("input:radio[name=isotherresi]:checked").val();
  
  if(isForeign=='Y'){
    $('#foreigncountryrsdDiv').css('display','block');
    $('#NewZip').css('display','block');
    $('#Zip').css('display','none');
    $('#Zip').val("999999");
    $("#StateUnion").val('99').change();
    $("#StateUnion").attr('disabled',true);
   
  }else{  
    $('#foreigncountryrsdDiv').css('display','none');
    $('#NewZip').css('display','none');
    $('#Zip').css('display','block');
    $('#Zip').val("<?php echo $Zip; ?>");
  <?php if($Zip!='888888'){ ?>
    $("#StateUnion").val('<?php echo $StateUnion;  ?>').change();
  <?php } ?>
    $("#StateUnion").removeAttr('disabled');
  }
  
  
  
}

funcIsForeignAddRes('<?php echo $COMADDRESSTYPE; ?>');

function funcGetResStateVal(sid){
  var sidd = $('#StateUnion').val();
  $('#hiddenresistatecode').val(sidd);
}
funcGetResStateVal(<?php echo $StateUnion;  ?>);
</script>
<script>
$(document).ready(function(){
	$('input').focus(function(){
		$(this).attr('autocomplete', 'nope');
	});
});
</script>
<?php include 'footer.php'; ?>
<script src="js/documentvalidateform.js"></script>
</body>
</html>

