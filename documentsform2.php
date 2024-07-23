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
$data = json_decode($result, true);
curl_close($ch);

$Title = trim($data['recordlist']['applicanttitlecode']);
$NameOffice= trim($data['recordlist']['OFFICENAME']);
$OFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
$OBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
$ORoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
$OAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
$OTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
$OTownCityDistrict = explode('~', $OTownCityDistrict);
$OStateUnion = trim($data['recordlist']['officestatecode']);
$OZip = trim($data['recordlist']['officepincode']);
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
$StdCode = trim($data['recordlist']['STDCODE']);
$MobileNumber = trim($data['recordlist']['TELPHONE']);
$Email = trim($data['recordlist']['EMAIL']);
$ApplicationStatus = trim($data['recordlist']['STATUSOFAPPLICANT']);
$RegistrationNumberFirm = trim($data['recordlist']['REGNUM']);
$Country = trim($data['recordlist']['countryofcitizen']);
$WheatherCitizen = trim($data['recordlist']['INDIANCITIZEN']);
$issalried = trim($data['recordlist']['issalried']);
$orgname = trim($data['recordlist']['orgname']);
$isbusinessorprofession = trim($data['recordlist']['isbusinessorprofession']);
$businessorprfessioncode = trim($data['recordlist']['businessorprfessioncode']);
$AnotherSourceIncome = trim($data['recordlist']['anotherincomesrctypecode']);
$AcknowledgementNumber = trim($data['recordlist']['acknowledmentnumber']);
$Aadhar = trim($data['recordlist']['ADHARNUM']);
$AadharVarification = trim($data['recordlist']['adharflag']);
$Nationality = trim($data['recordlist']['isdcodeofcitizencountry']);
$isdcodeofcitizencountry = trim($data['recordlist']['isdcodeofcitizencountry']);
$countryisd = trim($data['recordlist']['countryisd']);
$officezip = trim($data['recordlist']['officezip']);
$residencezip = trim($data['recordlist']['residencezip']);
$EnrolmentId = trim($data['recordlist']['adharenrolmentid']);
$AadharName = trim($data['recordlist']['nameasadhar']);
$PhysicalPanCard = trim($data['recordlist']['isphysicalpanwanted']);
$modeofapplication = trim($data['recordlist']['modeofapplication']);
$VID = trim($data['recordlist']['VID']);
$uidtocken = trim($data['recordlist']['uidtocken']);
$adharref = trim($data['recordlist']['adharref']);

$ratitlecode = trim($data['recordlist']['ratitlecode']);
$ralastname = trim($data['recordlist']['ralastname']);
$rafistname = trim($data['recordlist']['rafistname']);
$ramiddlename = trim($data['recordlist']['ramiddlename']);
$RFlatDoorBlock = trim($data['recordlist']['raflatorblock']);
$RBuildingPremises = trim($data['recordlist']['rabuildingorvillage']);
$RRoadStreetLane = trim($data['recordlist']['streetorpostoffice']);
$RAreaLocalityTaluka = trim($data['recordlist']['raareasubdivision']);
$RTownCityDistrict = trim($data['recordlist']['ratownorcountry']);
$RTownCityDistrict = explode('~', $RTownCityDistrict);
$RStateUnion = trim($data['recordlist']['rastatecode']);
$RZip = trim($data['recordlist']['rapincoe']);
$IdentityProof = trim($data['recordlist']['POI']);
$AddressProof = trim($data['recordlist']['POA']);
$ReceiptDate = trim($data['recordlist']['acknwoledmentdate']);
$VerifierDate = trim($data['recordlist']['verificationdate']);
$AcknowledgementNumber = trim($data['recordlist']['acknowledmentnumber']);
$PhotoPresence = trim($data['recordlist']['isphotoattached']);
$SignaturePresence = trim($data['recordlist']['issignatureattached']);
$isminor = trim($data['recordlist']['isminor']);
$isdiscreattinfclevel = trim($data['recordlist']['isdiscreattinfclevel']);
$dateofdescreresolution = trim($data['recordlist']['dateofdescreresolution']);
$VerifierName = trim($data['recordlist']['verifiername']);
$CVerifier  = trim($data['recordlist']['verifiercapcitycode']);
$VerifierPlace = trim($data['recordlist']['verificationplace']);
$KycComplaint = trim($data['recordlist']['iskyc']);
$ProofDOB = trim($data['recordlist']['dobdocumentcode']);


if($ApplicationStatus=='P'){
$PhotoPresence = trim($data['recordlist']['isphotoattached']);
$SignaturePresence = trim($data['recordlist']['issignatureattached']);
}else{
$PhotoPresence = 'N';
$SignaturePresence = 'N';
}

$ApplicationCategory = trim($data['recordlist']['ApplicationCategory']);
$Revised = trim($data['formtype']);
$Stage = trim($data['recordlist']['stage']);

$isOffceForeign = trim($data['recordlist']['isOffceForeign']);
$isRepForeign = trim($data['recordlist']['isRepForeign']);

?>
<?php
if(isset($_POST['action2'])=="dataentryform2"){
// $post = $_POST;
//$post = json_encode($post,JSON_PRETTY_PRINT);
$isminor = trim($_POST['isminor']);
$OFFICENAME= trim($_POST['OFFICENAME']);
if($OFFICENAME==''){
$OFFICENAME = " ";
}
$officeflatorblock = trim($_POST['officeflatorblock']);
if($officeflatorblock==''){
$officeflatorblock = " ";
}
$officebuildingorvillage = trim($_POST['officebuildingorvillage']);
if($officebuildingorvillage==''){
$officebuildingorvillage = " ";
}
$officestreeorpostoffice = trim($_POST['officestreeorpostoffice']);
if($officestreeorpostoffice==''){
$officestreeorpostoffice = " ";
}
$officeareaorsubdivision = trim($_POST['officeareaorsubdivision']);
if($officeareaorsubdivision==''){
$officeareaorsubdivision = " ";
}
$officetownorcontry = trim($_POST['officetownorcontry']);
if($officetownorcontry==''){
$officetownorcontry = " ";
}
$officestatecode = trim($_POST['officestatecode']);
if($officestatecode==''){
$officestatecode = " ";
}
$officepincode = trim($_POST['officepincode']);
if($officepincode==''){
$officepincode = " ";
}

$foreigncountryofs = trim($_POST['foreigncountryofs']);
$officezipcode = trim($_POST['officezipcode']);
$isotheroffce = trim($_POST['isotheroffce']);

if($officezipcode!='' && $isotheroffce=='Y'){
$officetownorcontry = $officetownorcontry.'~'.$foreigncountryofs.'~'.$officezipcode;
}

if(trim($_POST['officeflatorblock'])==''){
$officepincode='';
$officestatecode='';
}

$COMMADDRESS = trim($_POST['COMMADDRESS']);
if($COMMADDRESS==''){
$COMMADDRESS = " ";
}
$countryisd = trim($_POST['countryisd']);
if($countryisd==''){
$countryisd = " ";
}
$STDCODE = trim($_POST['STDCODE']);
if($STDCODE==''){
$STDCODE = " ";
}
$TELPHONE = trim($_POST['TELPHONE']);
if($TELPHONE==''){
$TELPHONE = " ";
}
$EMAIL = trim($_POST['EMAIL']);
if($EMAIL==''){
$EMAIL = " ";
}
$REGNUM = trim($_POST['REGNUM']);
if($REGNUM==''){
$REGNUM = " ";
}
$INDIANCITIZEN = trim($_POST['INDIANCITIZEN']);
if($INDIANCITIZEN==''){
$INDIANCITIZEN = " ";
}
$ADHARNUM = trim($_POST['ADHARNUM']);
if($ADHARNUM==''){
$ADHARNUM = " ";
}
$adharflag = trim($_POST['adharflag']);
if(trim($_POST['formtype'])=="49AA"){
$adharflag = "";
}else{
if($adharflag==''){
$adharflag = " ";
}
}
$adharenrolmentid = trim($_POST['adharenrolmentid']);
$nameasadhar = trim($_POST['nameasadhar']);
if($nameasadhar==''){
$nameasadhar = " ";
}
$countryofcitizen = trim($_POST['countryofcitizen']);
$isdcodeofcitizencountry = trim($_POST['isdcodeofcitizencountry']);
$issalried = trim($_POST['issalried']);
if($issalried==''){
$issalried = " ";
}
$orgname = trim($_POST['orgname']);
if($orgname==''){
$orgname = " ";
}
$isbusinessorprofession = trim($_POST['isbusinessorprofession']);
if($isbusinessorprofession==''){
$isbusinessorprofession = " ";
}
$businessorprfessioncode = trim($_POST['businessorprfessioncode']);
if($businessorprfessioncode==''){
$businessorprfessioncode = " ";
}
$anotherincomesrctypecode = trim($_POST['anotherincomesrctypecode']);
if($anotherincomesrctypecode==''){
$anotherincomesrctypecode = " ";
}
$ratitlecode = trim($_POST['ratitlecode']);
if($ratitlecode==''){
$ratitlecode = " ";
}
$ralastname = trim($_POST['ralastname']);
if($ralastname==''){
$ralastname = " ";
}
$rafistname = trim($_POST['rafistname']);
if($rafistname==''){
$rafistname = " ";
}
$ramiddlename = trim($_POST['ramiddlename']);
if($ramiddlename==''){
$ramiddlename = " ";
}
$raflatorblock = trim($_POST['raflatorblock']);
if($raflatorblock==''){
$raflatorblock = " ";
}
$rabuildingorvillage = trim($_POST['rabuildingorvillage']);
if($rabuildingorvillage==''){
$rabuildingorvillage = " ";
}
$streetorpostoffice = trim($_POST['streetorpostoffice']);
if($streetorpostoffice==''){
$streetorpostoffice = " ";
}
$raareasubdivision = trim($_POST['raareasubdivision']);
if($raareasubdivision==''){
$raareasubdivision = " ";
}
$ratownorcountry = trim($_POST['ratownorcountry']);
if($ratownorcountry==''){
$ratownorcountry = " ";
}
$rastatecode = trim($_POST['rastatecode']);
if($rastatecode==''){
$rastatecode = " ";
}
$rapincoe = trim($_POST['rapincoe']);
if($rapincoe==''){
$rapincoe = " ";
}

$foreigncountryrep = trim($_POST['foreigncountryrep']);
$razipcode = trim($_POST['razipcode']);
$isotherrep = trim($_POST['isotherrep']);

if($razipcode!=''  && $isotherrep=='Y'){
$ratownorcountry = $ratownorcountry.'~'.$foreigncountryrep.'~'.$razipcode;
}

if(trim($_POST['raflatorblock'])==''){
$rapincoe='';
$rastatecode='';
}

$POI = trim($_POST['POI']);
$POA = trim($_POST['POA']);
$dobdocumentcode = trim($_POST['dobdocumentcode']);
if($dobdocumentcode==''){
$dobdocumentcode = " ";
}
$profofdateofbirth = trim($_POST['dobdocumentcode']);
if($profofdateofbirth==''){
$profofdateofbirth = " ";
}
$iskyc = trim($_POST['iskyc']);
$acknwoledmentdate = str_replace('-','',trim($_POST['acknwoledmentdate']));
if($acknwoledmentdate==''){
$acknwoledmentdate = " ";
}
$isphysicalpanwanted = trim($_POST['isphysicalpanwanted']);
$isphotoattached = trim($_POST['isphotoattached']);
$issignatureattached = trim($_POST['issignatureattached']);


if($isminor==''){
$isminor = " ";
}
$isdiscreattinfclevel = trim($_POST['isdiscreattinfclevel']);
if($isdiscreattinfclevel==''){
$isdiscreattinfclevel = " ";
}
$dateofdescreresolution = trim($_POST['dateofdescreresolution']);
if($dateofdescreresolution==''){
$dateofdescreresolution = " ";
}
$verifiername = trim($_POST['verifiername']);
$verifiercapcitycode  = trim($_POST['verifiercapcitycode']);
$verificationplace = trim($_POST['verificationplace']);
$verificationdate = str_replace('-','',trim($_POST['verificationdate']));
$verificationdate = trim($_POST['verificationdate']);
$modeofapplication = trim($_POST['modeofapplication']);
$acknowledmentnumber = trim($_POST['acknowledmentnumber']);


$formJson = '{ "AREACODE": "'.$data['recordlist']['AREACODE'].'", "AOTYPPE": "'.$data['recordlist']['AOTYPPE'].'", "RANGECODE": "'.$data['recordlist']['RANGECODE'].'", "AONO": "'.$data['recordlist']['AONO'].'", "applicanttitlecode": "'.$data['recordlist']['applicanttitlecode'].'", "applicantlastname": "'.$data['recordlist']['applicantlastname'].'", "applicationfirstname": "'.$data['recordlist']['applicationfirstname'].'", "applicantmiddlename": "'.$data['recordlist']['applicantmiddlename'].'", "NAMETOBEPRINTED": "'.$data['recordlist']['NAMETOBEPRINTED'].'", "APPKNOWBY": "'.$data['recordlist']['APPKNOWBY'].'", "APPOTITLE": "'.$data['recordlist']['APPOTITLE'].'", "APPOLNAME": "'.$data['recordlist']['APPOLNAME'].'", "APPOFNAME": "'.$data['recordlist']['APPOFNAME'].'", "APPOMNAME": "'.$data['recordlist']['APPOMNAME'].'", "SEX": "'.$data['recordlist']['SEX'].'","fatherlastname": "'.$data['recordlist']['fatherlastname'].'", "fatherfirstname": "'.$data['recordlist']['fatherfirstname'].'", "fathermiddlename": "'.$data['recordlist']['fathermiddlename'].'", "resiflatorblockno": "'.$data['recordlist']['resiflatorblockno'].'", "resibuildingorvillage": "'.$data['recordlist']['resibuildingorvillage'].'", "resipostoffice": "'.$data['recordlist']['resipostoffice'].'", "resiareasubdivision": "'.$data['recordlist']['resiareasubdivision'].'", "resitownorcountry": "'.$data['recordlist']['resitownorcountry'].'", "resistatecode": "'.$data['recordlist']['resistatecode'].'", "resipincode": "'.$data['recordlist']['resipincode'].'", "STATUSOFAPPLICANT": "'.$data['recordlist']['STATUSOFAPPLICANT'].'", "DATEOFBIRTH": "'.$data['recordlist']['DATEOFBIRTH'].'",  "acknowledmentnumber": "'.$data['recordlist']['acknowledmentnumber'].'","motherlastename": "'.$data['recordlist']['motherlastename'].'", "motherfirstname": "'.$data['recordlist']['motherfirstname'].'", "mothermiddlename": "'.$data['recordlist']['mothermiddlename'].'", "fatherormothernameoncard": "'.$data['recordlist']['fatherormothernameoncard'].'", "residencezip": "'.$data['recordlist']['residencezip'].'", "OFFICENAME": "'.$OFFICENAME.'", "officeflatorblock": "'.$officeflatorblock.'", "officebuildingorvillage": "'.$officebuildingorvillage.'", "officestreeorpostoffice": "'.$officestreeorpostoffice.'", "officeareaorsubdivision": "'.$officeareaorsubdivision.'", "officetownorcontry": "'.$officetownorcontry.'", "officestatecode": "'.$officestatecode.'", "officepincode": "'.$officepincode.'", "COMMADDRESS": "'.$COMMADDRESS.'", "countryisd": "'.$countryisd.'", "STDCODE": "'.$STDCODE.'", "TELPHONE": "'.$TELPHONE.'", "EMAIL": "'.$EMAIL.'", "REGNUM": "'.$REGNUM.'", "INDIANCITIZEN": "'.$INDIANCITIZEN.'", "ADHARNUM": "'.$ADHARNUM.'", "adharflag": "'.$adharflag.'", "adharenrolmentid": "'.$adharenrolmentid.'", "nameasadhar": "'.$nameasadhar.'", "countryofcitizen": "'.$countryofcitizen.'","isdcodeofcitizencountry":"'.$isdcodeofcitizencountry.'", "issalried": "'.$issalried.'", "orgname": "'.$orgname.'", "isbusinessorprofession": "'.$isbusinessorprofession.'", "businessorprfessioncode": "'.$businessorprfessioncode.'", "anotherincomesrctypecode": "'.$anotherincomesrctypecode.'", "ratitlecode": "'.$ratitlecode.'", "ralastname": "'.$ralastname.'", "rafistname": "'.$rafistname.'", "ramiddlename": "'.$ramiddlename.'", "raflatorblock": "'.$raflatorblock.'", "rabuildingorvillage": "'.$rabuildingorvillage.'", "streetorpostoffice": "'.$streetorpostoffice.'", "raareasubdivision": "'.$raareasubdivision.'", "ratownorcountry": "'.$ratownorcountry.'", "rastatecode": "'.$rastatecode.'", "rapincoe": "'.$rapincoe.'", "POI": "'.$POI.'", "POA": "'.$POA.'", "dobdocumentcode": "'.$dobdocumentcode.'", "profofdateofbirth": "'.$profofdateofbirth.'", "iskyc": "'.$iskyc.'","acknwoledmentdate": "'.$acknwoledmentdate.'", "isphysicalpanwanted": "'.$isphysicalpanwanted.'","isphotoattached": "'.$isphotoattached.'","issignatureattached": "'.$issignatureattached.'","isminor": "'.$isminor.'","isdiscreattinfclevel":"'.$isdiscreattinfclevel.'","dateofdescreresolution": "'.$dateofdescreresolution.'","verifiername": "'.$verifiername.'","verifiercapcitycode": "'.$verifiercapcitycode.'","verificationplace": "'.$verificationplace.'","verificationdate": "'.$verificationdate.'","modeofapplication": "'.$modeofapplication.'","acknowledmentnumber": "'.$acknowledmentnumber.'", "officezip": "'.$officezipcode.'" }';

$jsonPost = '{ "status": "0", "message": "Update Record", "page": "2", "formtype": "'.$Revised.'", "Role": "'.$_SESSION['ROLE'].'", "recordlist":'.$formJson.'}';

logger("JSON to post for dataenrty form 2----".$jsonPost);
$url2 = $serverurlapi."User1Entry/PanDataUpdateAPI.php";

logger("  API call to save the Data for Data Entry2 ". $url2);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url2);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
curl_close($ch);

logger("Response return from dataentry page 2 ----".$response);

$res = json_decode($response,true);
$location = 'qc_pdf.php?aid='.$AcknowledgementNumber.'&formType='.strtoupper($Revised);

if($res['status']=='0'){
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
<title>Data Entry From 2</title>
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
</head>
<body  style="overflow: hidden;">
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="margin-left: 0px!important;">
    <div class="row">
      <div class="col-xl-12" >
        <section class="hk-sec-wrapper"  style="margin-left: 0px!important;padding-bottom: 0px!important;">
          <div class="container-fluid">
            <form name="curl_form2" method="post" id="dataentry2" action="" enctype="multipart/form-data">
              <input type="hidden" name="appstatus" id="ApplicationStatus" value="<?php echo $ApplicationStatus; ?>" >
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <h4 class="para br-ffr review-title" for="first">Office Address</h4>
                    <div class="ks-trek">
                      <input class="jiy" type="checkbox" name="OffDetails" id="OffDetails" value="1" onClick="CheckOfficeDetails();" <?php if($OFlatDoorBlock!='' || $ApplicationStatus=='F' ||$ApplicationStatus=='E' || $ApplicationStatus=='C' || $ApplicationStatus=='L' || $ApplicationStatus=='T' || $ApplicationStatus=='G'){ echo 'checked'; } ?> >
                      <p class="para br-ffr" for="first"> Fill Office Detail Here</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-7"> </div>
              </div>
              <div id="OfficeAddress" style="display:none;">
                <div id="isForeignDivOff" style="margin-bottom: 20px;">
                  <div class="row">
                    <div class="col-md-5" style="max-width: 33%;">
                      <p class="para" for="first">Is&nbsp;Foreign&nbsp;Address </p>
                    </div>
                    <div class="col-md-7">
                      <input type="radio" class="js-trek" name="isotheroffce"  <?php if($isOffceForeign=='Y'){ echo 'Checked'; }  ?>  value="Y" onChange="funcIsForeignAddOff('<?php echo $COMADDRESSTYPE; ?>');" <?php if(strtoupper($Revised)=="49AA" || strtoupper($Revised)=="49A"){ ?> style="" <?php } ?>  >
                      Y
                      &nbsp;&nbsp;&nbsp;
                      <input type="radio" class="js-trek"  name="isotheroffce" <?php if($isOffceForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddOff('<?php echo $COMADDRESSTYPE; ?>');"  <?php if(strtoupper($Revised)=="49AA" || strtoupper($Revised)=="49A"){ ?> style="" <?php } ?>  >
                      N </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Name of office</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder" name="OFFICENAME"  value="<?php if($NameOffice!=''){ echo trim($NameOffice); } ?>" id="NameOffice" maxlength="75" onKeyDown="upperCaseF(this)">
                    </div>
                    <label id="NameOfficeError" style="display:none; color: red;"></label>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Flat/Room/Door/Block&nbsp;No</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder field notEqualToClass" name="officeflatorblock" value="<?php if($OFlatDoorBlock!=''){ echo trim($OFlatDoorBlock); } ?>" maxlength="25"  id="OFlatDoorBlock" onKeyDown="upperCaseF(this)">
                      <label id="OFlatDoorBlockError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Name&nbsp;of&nbsp;Premises/Building/Village</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder field notEqualToClass" name="officebuildingorvillage"  value="<?php if($OBuildingPremises!=''){ echo trim($OBuildingPremises); } ?>"  id="OBuildingPremises" maxlength="25" onKeyDown="upperCaseF(this)">
                      <label id="OBuildingPremisesError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Road/Street/Lane/Post&nbsp;office</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder field notEqualToClass" name="officestreeorpostoffice" value="<?php if($ORoadStreetLane!=''){ echo trim($ORoadStreetLane); } ?>"  id="ORoadStreetLane" maxlength="25" onKeyDown="upperCaseF(this)">
                      <label id="ORoadStreetLaneError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Area/Locality/Taluka/SubDivision</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder field notEqualToClass" name="officeareaorsubdivision" value="<?php if($OAreaLocalityTaluka!=''){ echo trim($OAreaLocalityTaluka); } ?>"  id="OAreaLocalityTaluka" maxlength="25" onKeyDown="upperCaseF(this)">
                      <label id="OAreaLocalityTalukaError" style="display:none; color: red;"></label>
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
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder" name="officetownorcontry" id="OTownCityDistrict"  value="<?php if($OTownCityDistrict!=''){ echo trim($OTownCityDistrict[0]); } ?>" maxlength="25" onKeyDown="upperCaseF(this)">
                      <label id="OTownCityDistrictError" style="display:none; color: red;"></label>
                      <input type="hidden" name="" value="<?php if($OTownCityDistrict!=''){ echo trim($data['recordlist']['officetownorcontry']); } ?>">
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
                  <div class="col-md-8">
                    <div class="form-group">
                      <select class="form-control inputborder" name="officestatecode" id="OStateUnion"   onchange="funcChangeStateOff(this.value,'<?php echo $COMADDRESSTYPE; ?>');funcGetOfsStateVal(this.value);">
                        <option value="">Select</option>
                        <?php
	  $OStateJson = file_get_contents($serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
	  $OStateJson = json_decode($OStateJson,true);
	  foreach($OStateJson['List'] as $OStateData){

		if($OStateData['Code']!='99'){
	  ?>
                        <option value="<?php echo $OStateData['Code']; ?>" <?php if($OStateData['Code']==$OStateUnion){ echo 'selected'; }?> ><?php echo $OStateData['Name']; ?></option>
                        <?php } } ?>
                        <option value="99" <?php if($OZip==999999){ echo 'selected'; } ?>  >FOREIGN ADDRESS</option>
                        <option value="99" <?php if($OZip==888888){ echo 'selected'; } ?>  >ADDRESS OF DEFENCE EMPLOYEES</option>
                      </select>
                      <input type="hidden" name="officestatecode" id="hiddenofficestatecode" value="" >
                      <label id="OStateUnionError" style="display:none; color: red;"></label>
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
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder" name="officepincode"  value="<?php echo $OZip; ?>" id="OZip"  maxlength="6">
                      <input type="text" class="form-control inputborder" name="officezipcode" value="<?php echo $OTownCityDistrict[2]; ?>" id="NewOZip"  maxlength="7" style="display: none;" onKeyDown="upperCaseF(this)">
                      <label id="OZipError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div id="foreigncountryofsDiv" style="display:none;" >
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">Country</p>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <select class="form-control inputborder" name="foreigncountryofs" id="foreigncountryofs">
                          <option value="">Select</option>
                          <?php
	$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
	$CountryJson = json_decode($CountryJson,true);
	foreach($CountryJson['List'] as $CountryData){
	?>
                          <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$OTownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                          <?php } ?>
                        </select>
                        <label id="StateUnionError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                </div>
              </div>
              <script>
function funcChangeStateOff(stateid,COMADDRESSTYPE){
var indianOther = COMADDRESSTYPE;
var isForeignof = $("input:radio[name=isotheroffce]:checked").val();
if(stateid=='99' && isForeignof=='N'){
$('#OZip').val("888888");
}
}
funcChangeStateOff('<?php echo $OStateUnion; ?>','<?php echo $COMADDRESSTYPE; ?>');

function funcIsForeignAddOff(COMADDRESSTYPE){
var isForeign = $("input:radio[name=isotheroffce]:checked").val();
if(isForeign=='Y'){

$('#foreigncountryofsDiv').css('display','block');
$('#NewOZip').css('display','block');
$('#OZip').css('display','none');
$('#OZip').val("999999");
$("#OStateUnion").val('99').change();
$("#OStateUnion").attr('disabled',true);

}else{
$('#foreigncountryofsDiv').css('display','none');
$('#NewOZip').css('display','none');
$('#OZip').css('display','block');
$('#OZip').val("<?php echo $OZip; ?>");
<?php if($OZip!='888888'){ ?>
$("#OStateUnion").val('<?php echo $OStateUnion; ?>').change();
<?php } ?>
$("#OStateUnion").removeAttr('disabled');
}
}

funcIsForeignAddOff('<?php echo $COMADDRESSTYPE; ?>');


function funcGetOfsStateVal(sid){
var sidd = $('#OStateUnion').val();
$('#hiddenofficestatecode').val(sidd);
}
funcGetOfsStateVal(<?php echo $OStateUnion;  ?>);
</script>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">8.</span>Address Type</p>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <select name="COMMADDRESS" class="form-control inputborder" id="AddressType"  style="pointer-events: noxne;" required>
                      <option value="">Select</option>
                      <option value="R" <?php if($AddressType=='R'){ echo 'selected'; } ?>>Residence</option>
                      <option value="O" <?php if($AddressType=='O'){ echo 'selected'; } ?>>Office</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">9.</span>Mobile/Telephone</p>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <select name="countryisd" id="countryisd" class="form-control inputborder">
                      <option value="91">+91</option>
                      <?php
$mobileisd = file_get_contents($serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
$mobileisd = json_decode($mobileisd,true);
foreach($mobileisd['List'] as $mobileisdData){
?>
                      <option value="<?php echo $mobileisdData['ISDcode']; ?>" <?php if($mobileisdData['ISDcode']==$countryisd && $countryisd!=''){ echo 'selected'; }?> ><?php echo '+'.$mobileisdData['ISDcode']; ?></option>
                      <?php } ?>
                    </select>
                    <label id="countryisdError" style="display:none; color: red;"></label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($StdCode!='' && $StdCode!=0){ echo trim($StdCode); } ?>" placeholder="Std Code" maxlength="7" onKeyDown="upperCaseF(this)">
                    <label id="" style="display:none; color: red;"></label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" name="TELPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo trim($MobileNumber); ?>" placeholder="Enter Number" maxlength="13">
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
                    <input type="email" name="EMAIL" id="Email" class="form-control inputborder" value="<?php if($Email!=''){ echo trim($Email); } ?>" maxlength="40" onKeyDown="upperCaseF(this)">
                    <label id="EmailError" style="display:none; color: red;"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <p class="para" for="first"><span class="numHead">11.</span>Registration&nbsp;Number(company,&nbsp;firm,&nbsp;LLP&nbsp;etc.) </p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="REGNUM" value="<?php echo $RegistrationNumberFirm; ?>" id="RegistrationNumberFirm"  onKeyDown="upperCaseF(this)" <?php if($ApplicationStatus=="P" || $ApplicationStatus=="H"){ echo 'readonly';  } ?> maxlength="30" >
                        <label id="RegistrationNumberFirmError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first"><span class="numHead">12.</span>Whether citizen of India?</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <select name="INDIANCITIZEN" class="form-control inputborder" id="WheatherCitizen"  required>
                            <option value="">Select</option>
                            <?php if($Revised=='49A'){ ?>
                            <option value="I" <?php if($WheatherCitizen=='I'){ echo 'selected'; } ?>>Indian</option>
                            <?php }else{ ?>
                            <option value="O" <?php if($WheatherCitizen=='O'){ echo 'selected'; } ?>>Other</option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Aadhar No</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" class="form-control inputborder" name="ADHARNUM" value="<?php echo $Aadhar; ?>" maxlength="12" readonly >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"  <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Aadhar Flag</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <select name="adharflag1" class="form-control inputborder" id="AadharVarification1" disabled  style="color:#747676;" >
                            <?php  if($Revised=='49AA'){ ?>
                            <option value=" ">Select</option>
                            <?php } ?>
                            <option value="0" <?php if($AadharVarification=='0'){ echo 'selected'; } ?>>Not Mentined in application</option>
                            <option value="1" <?php if($AadharVarification=='1'){ echo 'selected'; } ?>>Mentioned But Not successful</option>
                            <option value="2" <?php if($AadharVarification=='2'){ echo 'selected'; } ?>>Verified with UID databases</option>
                            <option value="3" <?php if($AadharVarification=='3'){ echo 'selected'; } ?>>Verified with UID databases</option>
                            <option value="4" <?php if($AadharVarification=='4'){ echo 'selected'; } ?>>Biometric Authentication</option>
                            <option value="5" <?php if($AadharVarification=='5'){ echo 'selected'; } ?>>OTP based authentication</option>
                            <option value="6" <?php if($AadharVarification=='6'){ echo 'selected'; } ?>>66% matching </option>
                            <option value="7" <?php if($AadharVarification=='7'){ echo 'selected'; } ?>>100% partial metching</option>
                            <option value="8" <?php if($AadharVarification=='8'){ echo 'selected'; } ?>>100</option>
                            <option value="9" <?php if($AadharVarification=='9'){ echo 'selected'; } ?>>Single Fingerprint</option>
                          </select>
                          <input type="hidden" name="adharflag" id="AadharVarification" value="<?php echo $AadharVarification; ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Aadhar Enrollment</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" class="form-control inputborder" name="adharenrolmentid" value="<?php echo $EnrolmentId; ?>" onKeyDown="upperCaseF(this)" readonly="readonly">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Name as per aadhar</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" class="form-control inputborder" name="nameasadhar" value="<?php echo $AadharName; ?>" maxlength="100"   onkeydown="upperCaseF(this)">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" <?php  if($Revised=='49A'){ ?>style="display:none;"<?php }?>>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Country of Citizenship</p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <select class="form-control inputborder" name="countryofcitizen" id="Country" onChange="funcSelectCode();">
                            <option value="">Select</option>
                            <?php
$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
$CountryJson = json_decode($CountryJson,true);
foreach($CountryJson['List'] as $CountryData){
?>
                            <option value="<?php echo $CountryData['Code']; ?>" isred="<?php echo $CountryData['ISDcode']; ?>" <?php if($CountryData['Code']==$Country){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <!---<select name="isdcodeofcitizencountry" id="CountryCode" class="form-control inputborder">
  <option value="">Select ISD Code</option>
  <?php
$CountryCodeJosn = file_get_contents($serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
$CountryCodeJosn = json_decode($CountryCodeJosn,true);
foreach($CountryCodeJosn['List'] as $CountryCodeData){
?>
  <option value="<?php echo $CountryCodeData['ISDcode']; ?>" <?php if($CountryCodeData['ISDcode']==$isdcodeofcitizencountry){ echo 'selected'; }?> ><?php echo '+'.$CountryCodeData['ISDcode']; ?></option>
  <?php } ?>
</select>--->
                          <input type="text" name="isdcodeofcitizencountry" id="CountryCode" class="form-control inputborder" value="<?php echo $isdcodeofcitizencountry; ?>" readonly="readonly">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
function funcSelectCode(){
var isdcode = $("#Country").find(':selected').attr('isred');
$('#CountryCode').val(isdcode);
}
funcSelectCode();
</script>
              </section>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first"><span class="numHead">13.</span>Source of Income</p>
                        </div>
                      </div>
                      <div class="col-md-3 gg-ff" >
                        <input class="jiy" type="checkbox" name="issalried" value="Y" <?php if($issalried=='Y'){ echo 'checked'; } ?> id="IncomeFromSalary">
                        <input type="hidden" name="IncomeFromSalary1" value="N" />
                        <p class="para br-ffr" for="first">Income From&nbsp;Salary</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Organisation Name</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input class="form-control inputborder" type="text" name="orgname" value="<?php echo $orgname; ?>" id="orgname"  onKeyDown="upperCaseF(this)">
                          <label id="orgnameError" style="display:none; color: red;"></label>
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Business/Profession</p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <select name="isbusinessorprofession" id="BusinessProfessional" class="form-control inputborder">
                            <option value="">Select</option>
                            <option value="Y" <?php if($isbusinessorprofession=='Y'){ echo 'selected'; } ?>>Yes</option>
                          </select>
                          <label id="" style="display:none; color: red;"></label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <select name="businessorprfessioncode" id="businessorprfessioncode" class="form-control inputborder">
                            <option value="">Select</option>
                            <?php
//$businessorprfessioncodeJosn = file_get_contents($serverurlapi."Dashboards/masterscache/bussinessCodeMaster_pan.json");
//$businessorprfessioncodeJosn = json_decode($businessorprfessioncodeJosn,true);
$options = [
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ],
];

$context = stream_context_create($options);
$businessorprfessioncodeJosn = file_get_contents($serverurlapi . "Dashboards/masterscache/bussinessCodeMaster_pan.json", false, $context);
$businessorprfessioncodeJosn = json_decode($businessorprfessioncodeJosn, true);

foreach($businessorprfessioncodeJosn['List'] as $businessorprfessioncodeData){
?>
                            <option value="<?php echo $businessorprfessioncodeData['Code']; ?>" <?php if($businessorprfessioncodeData['Code']==$businessorprfessioncode){ echo 'selected'; }?> ><?php echo $businessorprfessioncodeData['Name']; ?></option>
                            <?php } ?>
                          </select>
                          <label id="" style="display:none; color: red;"></label>
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Another Source Of Income</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <select name="anotherincomesrctypecode" class="form-control inputborder" id="AnotherSourceIncome" >
                            <option value="">Select</option>
                            <option value="A" <?php if($AnotherSourceIncome=='A'){ echo 'selected'; } ?>>Capital Gains</option>
                            <option value="B" <?php if($AnotherSourceIncome=='B'){ echo 'selected'; } ?>>House Property</option>
                            <option value="C" <?php if($AnotherSourceIncome=='C'){ echo 'selected'; } ?>>Other Source</option>
                            <option value="D" <?php if($AnotherSourceIncome=='D'){ echo 'selected'; } ?>>Capital Gains & House Property</option>
                            <option value="E" <?php if($AnotherSourceIncome=='E'){ echo 'selected'; } ?>>House Property & Other Source</option>
                            <option value="F" <?php if($AnotherSourceIncome=='F'){ echo 'selected'; } ?>>Capital Gains & Other Source</option>
                            <option value="G" <?php if($AnotherSourceIncome=='G'){ echo 'selected'; } ?>>Capital Gains & House Property & Other Source</option>
                            <option value="H" <?php if($AnotherSourceIncome=='H'){ echo 'selected'; } ?>>No Income</option>
                          </select>
                          <label id="" style="display:none; color: red;"></label>
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>
                  </div>
                </div>
              </section>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-5">
                        <h4 class="para br-ffr review-title" for="first"><span class="numHead">14.</span>Representative&nbsp;Assesse&nbsp;Detail</h4>
                        <div class="ks-trek">
                          <input class="jiy" type="checkbox" name="RepDetails" id="RepDetails" value="1" onClick="CheckRepDetails();" <?php if($ralastname!='' && $RFlatDoorBlock!=''){ echo 'checked'; } ?>>
                          <p class="para br-ffr" for="first"> Fill Representative Assesse Detail Here</p>
                        </div>
                      </div>
                      <div class="col-md-7"> </div>
                    </div>
                  </div>
                </div>
                <div id="repDetailsDiv" style="display:none;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">Is&nbsp;Foreign&nbsp;Address</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="radio" class="jiy" name="isotherrep" <?php if($isRepForeign=='Y'){ echo 'Checked'; }  ?> value="Y" onChange="funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');"  style="pointer-events: none;" >
                        Y
                        &nbsp;&nbsp;&nbsp;
                        <input type="radio" class="jiy"  name="isotherrep"  <?php if($isRepForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');" style="pointer-events: none;" >
                        N </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">&nbsp;Name&nbsp;(Last,First,Middle)*</p>
                      </div>
                    </div>
                    <!-- <div class="col-md-1">
<div class="form-group"> -->
                    <div class="col-md-1">
                      <div class="form-group">
                        <select name="ratitlecode" class="form-control inputborder" id="ratitlecode" style="padding: 0px !important;">
                          <option value="">Select</option>
                          <option value="1" <?php if($ratitlecode==1){ echo 'selected'; } ?>>Shri</option>
                          <option value="2" <?php if($ratitlecode==2){ echo 'selected'; } ?>>Smt/Mrs</option>
                          <option value="3" <?php if($ratitlecode==3){ echo 'selected'; } ?>>Kumari/Ms</option>
                          <option value="4" <?php if($ratitlecode==4){ echo 'selected'; } ?>>M/s</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="ralastname" value="<?php echo $ralastname; ?>" id="ralastname" onKeyDown="upperCaseF(this)" maxlength="75">
                        <label id="ralastnameError" style="color: red; display:none;"></label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="rafistname" value="<?php echo $rafistname; ?>" id="rafistname" onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="rafistnameError" style="color: red;display:none;"></label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="ramiddlename" value="<?php echo $ramiddlename;  ?>" id="ramiddlename" onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="ramiddlenameError" style="color: red;display:none;"></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">Flat/Room/Door/Block&nbsp;No</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder field notEqualToClass" name="raflatorblock" value="<?php if($RFlatDoorBlock!=''){ echo trim($RFlatDoorBlock); } ?>"  id="RFlatDoorBlock" onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="RFlatDoorBlockError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">Name&nbsp;of&nbsp;Premises/Building/Village</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder field notEqualToClass" name="rabuildingorvillage"  value="<?php if($RBuildingPremises!=''){ echo trim($RBuildingPremises); } ?>"  id="RBuildingPremises" onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="RBuildingPremisesError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">Road/Street/Lane/Post&nbsp;office</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder field notEqualToClass" name="streetorpostoffice" value="<?php if($RRoadStreetLane!=''){ echo trim($RRoadStreetLane); } ?>"  id="RRoadStreetLane" onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="RRoadStreetLaneError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">Area/Locality/Taluka/SubDivision</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder field notEqualToClass" name="raareasubdivision" value="<?php if($RAreaLocalityTaluka!=''){ echo trim($RAreaLocalityTaluka); } ?>"  id="RAreaLocalityTaluka" onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="RAreaLocalityTalukaError" style="display:none; color: red;"></label>
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
                        <input type="text" class="form-control inputborder" name="ratownorcountry" id="RTownCityDistrict"  value="<?php if($RTownCityDistrict!=''){ echo trim($RTownCityDistrict[0]); } ?>"  onKeyDown="upperCaseF(this)" maxlength="25">
                        <label id="RTownCityDistrictError" style="display:none; color: red;"></label>
                        <input type="hidden" name="" value="<?php if($RTownCityDistrict!=''){ echo trim($data['recordlist']['ratownorcountry']); } ?>">
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">State&nbsp;Union&nbsp;Territory</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <select class="form-control inputborder" name="rastatecode" id="RStateUnion" onChange="funcChangeStateRep(this.value,'<?php echo $COMADDRESSTYPE; ?>');funcGetRepStateVal(this.value);">
                          <option value="">Select</option>
                          <?php
$RStateJson = file_get_contents($serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$RStateJson = json_decode($RStateJson,true);
foreach($RStateJson['List'] as $RStateData){
if($RStateData['Code']!='99'){
?>
                          <option value="<?php echo $RStateData['Code']; ?>" <?php if($RStateData['Code']==$RStateUnion){ echo 'selected'; }?> ><?php echo $RStateData['Name']; ?></option>
                          <?php }  } ?>
                          <option value="99" <?php if($RZip==999999){ echo 'selected'; } ?>  >FOREIGN ADDRESS</option>
                          <option value="99" <?php if($RZip==888888){ echo 'selected'; } ?>  >ADDRESS OF DEFENCE EMPLOYEES</option>
                        </select>
                        <input type="hidden" name="rastatecode" id="hiddenrastatecode" value="" >
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first">PIN/Zip&nbsp;Code</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="rapincoe"  value="<?php echo $RZip; ?>" id="RZip" maxlength="6">
                        <input type="text" class="form-control inputborder" name="razipcode" value="<?php echo $RTownCityDistrict[2]; ?>" id="RepZip"  maxlength="7" style="display: none;" onKeyDown="upperCaseF(this)">
                        <label id="RZipError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div id="foreigncountryrepDiv" style="display:none;" >
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Country</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <select class="form-control inputborder" name="foreigncountryrep" id="foreigncountryrep">
                            <option value="">Select</option>
                            <?php
$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
$CountryJson = json_decode($CountryJson,true);
foreach($CountryJson['List'] as $CountryData){
?>
                            <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$RTownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                            <?php } ?>
                          </select>
                          <label id="countryError" style="display:none; color: red;"></label>
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>
                  </div>
                </div>
                <script>
function funcChangeStateRep(stateid,COMADDRESSTYPE){
var indianOther = COMADDRESSTYPE;
var isForeign = $("input:radio[name=isotherrep]:checked").val();
if(stateid=='99' && isForeign=='N'){
$('#RZip').val("888888");
}
}
funcChangeStateRep('<?php echo $RStateUnion; ?>','<?php echo $COMADDRESSTYPE; ?>');

function funcIsForeignAddRep(COMADDRESSTYPE){
//var isForeign = $('#ratitlecode').val();
//isForeign = $.trim(isForeign);
var isForeign = $("input:radio[name=isotherrep]:checked").val();
var isMinor = "<?php echo $isminor;  ?>";
if((isMinor=='' && isForeign=='Y') ||  (isMinor=='M' && isForeign=='Y')){
$('#foreigncountryrepDiv').css('display','block');
$('#RepZip').css('display','block');
$('#RZip').css('display','none');
$('#RZip').val("999999");
$("#RStateUnion").val('99').change();
$("#RStateUnion").attr('disabled',true);
}else{
$('#foreigncountryrepDiv').css('display','none');
$('#RepZip').css('display','none');
$('#RZip').css('display','block');
$('#RZip').val("<?php echo $RZip; ?>");
<?php if($RZip!='888888'){ ?>
$("#RStateUnion").val('<?php echo $RStateUnion; ?>').change();
<?php } ?>
$("#RStateUnion").removeAttr('disabled');
}
}

funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');


function funcGetRepStateVal(sid){
var sidd1 = $('#RStateUnion').val();
$('#hiddenrastatecode').val(sidd1);
}
funcGetRepStateVal(<?php echo $RStateUnion;  ?>);

</script>
              </section>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row hy-bg">
                      <div class="col-md-4">
                        <div class="form-group ks-trek">
                          <p class="para ft-yt" for="first"><span class="numHead">15.</span>Proof&nbsp;of&nbsp;Identity&nbsp;Type&nbsp;*</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control inputborder" name="POI" id="IdentityProof"  required >
                          <option value="">Select</option>
                          <?php
//$IdentityProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/newPOI_pan.json");
//$IdentityProofJsonDec = json_decode($IdentityProofJson,true);

$IdentityProofJson = file_get_contents($serverurlapi . "Dashboards/masterscache/newPOI_pan.json", false, $context);
$IdentityProofJsonDec = json_decode($IdentityProofJson, true);

foreach($IdentityProofJsonDec['ApplicationStatus'] as $IdentityProofJson){
if($Revised == "49A"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
if($ApplicationStatus=="P"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
$ApplicationStatusnew = "49AA";
}

}
if($IdentityProofJson['Category']==$ApplicationStatusnew){
foreach($IdentityProofJson['List'] as $IdentityProofData){
if($IdentityProofData['Name']!=''){
?>
                          <option value="<?php echo $IdentityProofData['Status']; ?>" <?php if($IdentityProofData['Status']==$IdentityProof){ echo 'selected'; }?> ><?php echo $IdentityProofData['Name']; ?></option>
                          <?php } } } } ?>
                        </select>
                        <label id="IdentityProofError" style="color: red; display: none;"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="row hy-bg">
                      <div class="col-md-4">
                        <div class="form-group ks-trek">
                          <p class="para ft-yt" for="first">Proof&nbsp;of&nbsp;Address&nbsp;Type&nbsp;*</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control inputborder" name="POA" id="AddressProof"  required>
                          <option value="">Select</option>
                          <?php
$AddressProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/newPOA_pan.json",false, $context);
$AddressProofJsonDec = json_decode($AddressProofJson,true);
foreach($AddressProofJsonDec['ApplicationStatus'] as $AddressProofJson){
if($Revised == "49A"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
if($ApplicationStatus=="P"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
$ApplicationStatusnew = "49AA";
}
}
if($AddressProofJson['Category']==$ApplicationStatusnew){
foreach($AddressProofJson['List'] as $AddressProofData){
if($AddressProofData['Name']!=''){
?>
                          <option value="<?php echo $AddressProofData['Code']; ?>" <?php if($AddressProofData['Code']==$AddressProof){ echo 'selected'; }?> ><?php echo $AddressProofData['Name']; ?></option>
                          <?php } }  } } ?>
                        </select>
                        <label id="AddressProofError" style="color: red; display: none;"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if(strtoupper($Revised)=='49A'){ ?>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="row hy-bg">
                      <div class="col-md-4">
                        <div class="form-group ks-trek">
                          <p class="para ft-yt" for="first">Proof&nbsp;of&nbsp;DOB&nbsp;Type&nbsp;*</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control inputborder" name="dobdocumentcode" id="dobdocumentcode"  <?php  if(($ApplicationStatus=="P" || $ApplicationStatus=="H") && strtoupper($Revised)=='49A'){ ?> required <?php }?>  >
                          <option value="">Select</option>
                          <?php
$ProofDOBJson = file_get_contents($serverurlapi."Dashboards/masterscache/PODB_pan_49A_P.json",false, $context);
$ProofDOBJsonDec = json_decode($ProofDOBJson,true);
foreach($ProofDOBJsonDec['ApplicationStatus'] as $ProofDOBJson){
if($ProofDOBJson['Category']==$ApplicationStatus){
foreach($ProofDOBJson['List'] as $ProofDOBData){
?>
                          <option value="<?php echo $ProofDOBData['Code']; ?>" <?php if($ProofDOBData['Code']==$ProofDOB){ echo 'selected'; }?> ><?php echo $ProofDOBData['Name']; ?></option>
                          <?php  } } } ?>
                        </select>
                        <label id="ProofDOBError" style="color: red; display: none;"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </section>
              <section>
                <div class="row" <?php  if($Revised=='49A'){ ?>style="display:none;"<?php }?>>
                  <div class="col-md-12 ">
                    <div class="row hy-bg">
                      <div class="col-md-4">
                        <div class="form-group ks-trek">
                          <p class="para ft-yt" for="first">KYC&nbsp;Compliant</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control inputborder" name="iskyc" id="KycComplaint">
                          <option value="">Select</option>
                          <option value="Y" <?php if($KycComplaint=='Y'){ echo 'Selected'; } ?>>Yes</option>
                          <option value="N" <?php if($KycComplaint=='N'){ echo 'Selected'; } ?>>No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="para br-ffr review-title" for="first"><span class="numHead">16.</span>Other Details</h4>
                </div>
              </div>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first">Date of Receipt&nbsp;*</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="col-md-5">
                        <div class="row">
                          <input type="text" name="acknwoledmentdate" value="<?php echo dateFormat($ReceiptDate); ?>" id="acknwoledmentdate" class="form-control inputborder " maxlength="10" readonly="readonly">
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="row">
                          <p class="para" style="margin-bottom: 15px" for="first">Physical&nbsp;PAN&nbsp;Card<span class="numHead" style="visibility: hidden;">10.</span></p>
                          <div>
                            <input type="radio" class="js-trek" name="isphysicalpanwanted" <?php if($PhysicalPanCard=='Y'){ echo 'Checked'; } ?> value="Y" >
                            Y
                            <input type="radio" class="js-trek"  name="isphysicalpanwanted" <?php if($PhysicalPanCard=='N'){ echo 'Checked'; }  ?> value="N"  >
                            N </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </Section>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <p class="para" for="first">Photo Present</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <select name="isphotoattached" class="form-control inputborder" required>
                            <option value="Y" <?php if($PhotoPresence=='Y'){ echo 'Selected'; } ?>>Yes</option>
                            <option value="N" <?php if($PhotoPresence=='N'){ echo 'Selected'; } ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <p class="para" for="first">Signature Present</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <select name="issignatureattached" class="form-control inputborder" required>
                            <option value="Y" <?php if($SignaturePresence=='Y'){ echo 'Selected'; } ?>>Yes</option>
                            <option value="N" <?php if($SignaturePresence=='N'){ echo 'Selected'; } ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <p class="para" for="first">Application is for Minor/Deceased</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <select name="isminor" class="form-control inputborder">
                            <option value=" ">Select</option>
                            <option value="M" <?php if($isminor=='M'){ echo 'Selected'; } ?>>Minor</option>
                            <option value="D" <?php if($isminor=='D'){ echo 'Selected'; } ?>>Deceased</option>
                          </select>
                          <input type="hidden" name="isdiscreattinfclevel" value="<?php echo $isdiscreattinfclevel; ?>" />
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-md-7" style="display:none;">
  <div class="row">
    <div class="col-md-5">
      <p class="para" for="first">Descrepancy at TIN-FC Level</p>
    </div>
    <div class="col-md-7">
      <select name="isdiscreattinfclevel" class="form-control inputborder" required>
        <option value="Y" <?php if($isdiscreattinfclevel=='Y'){ echo 'Selected'; } ?>>Yes</option>
        <option value="N" <?php if($isdiscreattinfclevel=='N'){ echo 'Selected'; } ?>>No</option>
      </select>
    </div>
  </div>
</div> -->
                  </div>
                </div>
              </section>
              <section>
                <?php if(($isdiscreattinfclevel=='Y' || $isdiscreattinfclevel=='1') && $_SESSION['Type']=='HOUSER'){ ?>
                <div class="row ">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <p class="para" for="first">Date of Descrepancy Resolution</p>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <input type="text" name="dateofdescreresolution" value="<?php if($dateofdescreresolution!=''){ echo date('d-m-Y',strtotime($dateofdescreresolution)); } ?>" class="form-control datepicker inputborder datepicker"  id="dateofdescreresolution" maxlength="10">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </section>
              <section>
                <h4 class="para br-ffr review-title" style="text-decoration: underline;" for="first">Verification</h4>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="form-group ks-trek">
                      <p class="para rew" for="first">I/We</p>
                      <input type="text" class="form-control inputborder" placeholder="" name="verifiername" id="VerifierName" value="<?php echo $VerifierName; ?>" maxlength="75" onKeyDown="upperCaseF(this)">
                      <label id="VerifierNameError" style="color: red; display: none;"></label>
                      <p class="para rew" for="first">,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of</p>
                      <select class="form-control inputborder " name="verifiercapcitycode" id="CVerifier"  required>
                        <?php
echo $CVerifierJson = file_get_contents($serverurlapi."Dashboards/masterscache/verifierMaster_pan.json",false, $context);
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
              </section>
              <section>
                <div class="grid-last">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first">Place</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <input type="text" class="form-control inputborder" placeholder="" name="verificationplace" id="VerifierPlace" value="<?php echo $VerifierPlace; ?>" onKeyDown="upperCaseF(this)">
                      <label id="VerifierPlaceError" style="color: red; display: none;"></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <p class="para" for="first">Date of Verification</p>
                      </div>
                      <?php
/*$date = substr($VerifierDate,0,2).'-';
$month = substr($VerifierDate,2,2).'-';
$year = substr($VerifierDate,4,5);
$VerifierDate = $date.$month.$year;*/
?>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <p class="para" for="first">
                          <input type="text" name="verificationdate" id="verificationdate" value="<?php echo dateFormat($VerifierDate); ?>" class="form-control datepicker inputborder datepicker" maxlength="10">
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <input type="hidden" name="action2" value="dataentryform2">
              <input type="hidden" name="modeofapplication" value="T">
              <input type="hidden" name="acknowledmentnumber" value="<?php echo $AcknowledgementNumber; ?>">
              <input type="hidden" name="formtype" id="formtype" value="<?php echo $Revised; ?>">
              <div class="nxrt" style="width: fit-content; display:none; "><a href="#" class="previous"><i class="fa fa-angle-left" ></i> Back</a>
                <button type="submit" id="formsubmit"  class="next"> Save and move to next section <i class="fa fa-angle-right" ></i></button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('#dataentry2').submit(function() {
	//var dateofdescreresolution = $('#dateofdescreresolution').val();
	var isdiscreattinfclevel = '<?php echo $isdiscreattinfclevel; ?>';
	if(isdiscreattinfclevel=='Y' || isdiscreattinfclevel=='1'){
	return confirm('Are you sure you want to add descreresolution date?');
   var status = confirm("Are you sure you want to add descreresolution date?");
   if(status == false){
   return false;
   }
   else{
   return true;
   }
}
  });


</script>
<!--<script src="js/dataentryfromvalidate.js"></script>-->
<?php include 'footer.php'; ?>
<script src="js/document2validateform.js"></script>
<script>
$( function() {
$( ".datepicker" ).datepicker({
dateFormat: 'dd-mm-yy',
maxDate: 0
});
} );

function CheckRepDetails(){
var checkValue = $('#RepDetails').is(':checked');
if(checkValue==true){

$('#repDetailsDiv').css('display','block');
}else{

$('#repDetailsDiv').css('display','none');
}
}
CheckRepDetails();
function CheckOfficeDetails(){
var checkValue = $('#OffDetails').is(':checked');
if(checkValue==true){

$('#OfficeAddress').css('display','block');
}else{

$('#OfficeAddress').css('display','none');
}
}
CheckOfficeDetails();



</script>
<script>
$(document).ready(function(){
	$('input').focus(function(){
		$(this).attr('autocomplete', 'nope');
	});
});
</script>
</body>
</html>
<style>
.bg-jh{
width: 30%;
}
.rew{
padding: 10px;
}
.hy-nh{
width: 17%;
}
.hy-yui{
width: 60%
}
.ft-yt{
width: 21%;
}
.ui-yt{
width: 28%;
}
.ou-yt{
width: 68%;
}
.hg-op{
padding: 0 1%
}
.vtd{
margin-top: 22px;
}
.cx-jh{
width: 6%;
}
.hy-bg{
margin-bottom: 1%!important;
}
</style>
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
.ui-ynb{
width: 39%;
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
