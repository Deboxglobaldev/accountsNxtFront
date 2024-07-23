<?php
include("inc.php");
include "logincheck.php";
$imagePath =  $serverurlapi.'BulkUpload/uploads/panpdf/'.$_GET['aid'].'.pdf';

$url =  $serverurlapi."User1Entry/callAcknowData.php?aid=".$_GET['aid'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$data = json_decode($result, true);
curl_close($ch);

$ProductType = trim($data['ProductType']);
$PanNumber = trim($data['recordlist']['newpanid']);
$WARDCIRCLE = trim($data['recordlist']['WARDCIRCLE']);
$AreaCode = trim($data['recordlist']['AREACODE']);
$AoType = trim($data['recordlist']['AOTYPPE']);
$RangeCode = trim($data['recordlist']['RANGECODE']);
$AoNumber = trim($data['recordlist']['AONO']);
$RANGE = trim($data['recordlist']['RANGE']);
$COMMISSIONER = trim($data['recordlist']['COMMISSIONER']);
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
$Gender = trim($data['recordlist']['SEX']);
$ApplicationStatus = trim($data['recordlist']['STATUSOFAPPLICANT']);
$DateAgreement = $data['recordlist']['DATEOFBIRTH'];
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
$ApplicantMotherLastName = trim($data['recordlist']['motherlastename']);
$ApplicantMotherFirstName = trim($data['recordlist']['motherfirstname']);
$ApplicantMotherMiddleName = trim($data['recordlist']['mothermiddlename']);
$NamePrintedCard = trim($data['recordlist']['fatherormothernameoncard']);
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
$Enclosed = trim($data['recordlist']['numofsupporteddoc']);

$ApplicationCategory = trim($data['recordlist']['ApplicationCategory']);
$Revised = trim($data['formtype']);
$Stage = trim($data['recordlist']['stage']);


?>
<?php
$res='';
if(isset($_POST['action'])=="reviewdatasubmit"){
  
  $AcknowledgementNumber = trim($AcknowledgementNumber);
  $jsonPost = '{ "UserId": "", "UserName": "", "Stage": "'.$Stage.'", "FormType": "'.strtoupper($Revised).'", "AcknowledgementNumber":"'.$AcknowledgementNumber.'"}';
  $url2 = $serverurlapi."User1Entry/PanSubmitValidatorAPI.php";
    logger("  API call to validate review data entry: ". $url2); 
  logger("  Data post to review data: ". $jsonPost); 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url2);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $response = curl_exec($ch);
  curl_close($ch);
  $res = json_decode($response,true);
  
  logger("  Response after validate review page: ". $response); 
 
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
.inputborder,.js-trek,.jiy{
  border: 0px;
  text-align: left;
  pointer-events: none;

}
select {
  appearance: none;
}
.rew{
padding-top: 10px;
}  
.error{
color: red;
}
.selectize-dropdown{
  text-align: left;
}
.form-control{
color: #000;
padding: 0.175rem 0;
height: calc(1.75rem + 4px);
font-size: 15px;
font-weight: 300;
}
label{
 color: #000!important;
 font-weight: 300; 
}
.form-group {
    margin-bottom: 0.50rem;
}
.numHead{
  font-size: 13px;
  padding: 0px 4px;
  color: #000;
  font-weight: 600;
  margin-right: 8px;
}
.arr {
    margin: 4px 0 20px !important;
}
.form-group.ks-trek {
    margin-left: 20px !important;
}
.divspace{
  margin-bottom: -21px !important;
}
</style>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(img/Religare-Dashboard-BdG.JPG);">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
     <div class="container-fluid">
      <div class="col-md-12 timeline-bg" style="margin-top: 70px;">
            <img src="img/Religare-Timeline-png05.png" class="timeline">
    </div>
  </div>
    <div class="row contas">
      <form name="curl_form" method="post" id="dataentry1" action="" enctype="multipart/form-data">
        <div class="col-xl-12" >
        <section class="hk-sec-wrapper con">
        <div class="dostas">
          <div class="container-fluid" style="border: 0px solid #ffff;padding: 0px;">
            <div class="col-md-12">
              <button type="button" data-toggle="collapse" data-target="#demo" style="float: right; background: green; color: #fff;">Show Pdf</button>
              <div id="demo" class="collapse" style="padding-top: 34px;">
                <iframe id="pdfshowId"  src="" width="100%" style="height:250px;"></iframe>
                <script>
const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
  const byteCharacters = atob(b64Data);
  const byteArrays = [];

  for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
    const slice = byteCharacters.slice(offset, offset + sliceSize);

    const byteNumbers = new Array(slice.length);
    for (let i = 0; i < slice.length; i++) {
      byteNumbers[i] = slice.charCodeAt(i);
    }

    const byteArray = new Uint8Array(byteNumbers);
    byteArrays.push(byteArray);
  }

  const blob = new Blob(byteArrays, {type: contentType});
  return blob;
}

const contentType = 'application/pdf';
const b64Data = '<?php echo base64_encode(getCurlImage($imagePath)); ?>';

const blob = b64toBlob(b64Data, contentType);
const blobUrl = URL.createObjectURL(blob);

//const img = document.createElement('img');
//img.src = blobUrl;
//document.body.appendChild(img);
$("#pdfshowId").attr("src", blobUrl+'#page=2');
</script>
              </div>
            </div>
          </div>
          <div style="display: flex;">
            <div class="dostas2"> </div>
            <h3>Review</h3>
            <div class="dostas1">
              <?php //echo $imagePath; ?>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <?php 
    if($res!=''){
    if($res['Validated']=='0'){
    
    if($res['Erorlist']==''){ ?>
          <div style="border: 1px solid #f95858;padding: 10px;margin-top: 10px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Failed to validate please check error log file.</div>
          <?php  }else{ ?>
          <div style="border: 1px solid #f95858;padding: 10px;margin-top: 10px;">
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
          <?php } }else{
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
     }
      } ?>
          <?php if($Revised!="CR"){ ?>
          <table class="table table-bordered" style="margin-top:20px;">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;color:#79c117;">Area Code</th>
                <th scope="col"  style="text-align: center;color:#79c117;">AO Type</th>
                <th scope="col"  style="text-align: center;color:#79c117;">Range Code</th>
                <th scope="col"  style="text-align: center;color:#79c117;">AO Number</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row"><input type="text" class="form-control inputborder gc-xc" name="AreaCode" value="<?php echo $AreaCode; ?>" id="AreaCode"></td>
                <td><input type="text" class="form-control inputborder gc-xc" name="AoType" value="<?php echo $AoType; ?>" id="AoType"></td>
                <td><input type="text" class="form-control inputborder gc-xc" name="RangeCode" value="<?php echo $RangeCode; ?>" id="RangeCode"></td>
                <td><input type="text" class="form-control inputborder gc-xc" name="AoNumber" value="<?php echo $AoNumber; ?>" id="AoNumber"></td>
              </tr>
            </tbody>
          </table>
          <?php } ?>
          <div class="row">
            <?php if($Revised=="CR"){ ?>
            <div class="col-md-4 gc-xc">
              <div class="form-group">
                <p class="para " for="first">Permanent&nbsp;Account&nbsp;Number(PAN)</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control inputborder gc-xc" name="PanNumber" value="<?php echo $PanNumber; ?>">
              </div>
            </div>
            <?php } ?>
            <!--  col-md-6   -->
            <!--<div class="col-md-5" style="display:none;">
            <div style="display:flex;column-gap: 20px;">
              <p  class="para gc-xc" for="first">Nationality</p>
              <input type="radio" name="Nationality" value="IN" class="gc-xc" <?php if($Nationality=='IN'){ echo 'checked'; }?>  >
              <p class="rest gc-xc" for="first">Indian</p>
              <input type="radio" name="Nationality" value="Other" class="gc-xc" <?php if($Nationality!='IN'){ echo 'checked'; }?> >
              <div class="form-group ks-trek gc-xc">
                <div style="width: 10rem;">
                  <select name="NationalityOther" class="form-control inputborder">
                    <option value="">Select</option>
                    <?php
                  $nationality = file_get_contents("".$serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
                  $nationality = json_decode($nationality,true);
                  foreach($nationality['List'] as $nationalityData){
                  ?>
                    <option value="<?php echo $nationalityData['Code']; ?>" <?php if($nationalityData['Code']==$Nationality){ echo 'selected'; }?> ><?php echo $nationalityData['Name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>-->
            <!--  <div class="col-md-1">
           
          </div> -->
            <!-- <div class="col-md-3">
            
          </div> -->
          </div>
          <?php if($Revised!="CR"){ ?>
          <div class="dostas">
            <div style="display: flex;" class="arr">
              <div class="dostas2"></div>
              <h5 class="review-title">Applicant Personal Detail</h5>
              <div class="dostas1"> </div>
            </div>
          </div>
          <div class="row">
            <?php if($ApplicationStatus=='P'){ ?>
            <div class="col-md-3">
              <div class="form-group indian">
                <p  class="para mrest" for="first">Photo</p>
                <div class="ast" style="height: 140px; width: 63%; border: none !important;"> <img src="data/temp/crop/<?php echo $_GET['aid']; ?>_Photo.Jpg" style="border: 1px solid #79c117; height: 100%;"> </div>
              </div>
            </div>
            <?php } ?>
            <!--  col-md-6   -->
            <?php if($ApplicationStatus=='P'){ ?>
            <div class="col-md-4">
              <div class="form-group indian">
                <p  class="para mrest" for="first">Signature</p>
                <div class="ast1" style="width: -webkit-fill-available; border: none !important;"> <img  style=" border: 1px solid #79c117; width: 100%;height: fit-content;" src="data/temp/crop/<?php echo $_GET['aid']; ?>_Sig.Jpg"> </div>
              </div>
            </div>
            <?php } ?>
            <div class="col-md-5">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <p class="para" for="first">Application&nbsp;Status&nbsp;*</p>
                  </div>
                </div>
                <div class="col-md-7">
                  <select name="STATUSOFAPPLICANT" id="ApplicationStatus" class="form-control inputborder" onChange="funcCheckAddType();"  >
                    <option value="">Select</option>
                    <?php
      $ApplicationStatusJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/applicantStatus_pan.json");
      $ApplicationStatusJson = json_decode($ApplicationStatusJson,true);
      foreach($ApplicationStatusJson['List'] as $ApplicationStatusData){
      ?>
                    <option value="<?php echo $ApplicationStatusData['Code']; ?>" <?php if($ApplicationStatusData['Code']==$ApplicationStatus){ echo 'selected'; }?> ><?php echo $ApplicationStatusData['Status'].' ['.$ApplicationStatusData['Code'].']'; ?></option>
                    <?php } ?>
                  </select>
                  <label id="ApplicationStatusError" style="color: red; display: none;"></label>
                </div>
              </div>
              <div class="row drr">
                <div class="col-md-5">
                  <div class="form-group">
                    <p class="para" for="first">Acknowledgement&nbsp;No&nbsp;*</p>
                  </div>
                </div>
                <div class="col-md-7">
                  <input type="text" class="form-control inputborder" name="acknowledmentnumber" value="<?php echo $AcknowledgementNumber; ?>" id="AcknowledgementNumber"   readonly>
                  <label id="AcknowledgementNumberError" style="color: red; display: none;"></label>
                </div>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">1.</span>Full&nbsp;Name&nbsp;(Initial,Last,First,Middle)*</p>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>
                  <?php if($Title==1){ echo 'Shri'; } ?>
                  <?php if($Title==2){ echo 'Smt/Mrs'; } ?>
                  <?php if($Title==3){ echo 'Kumari/Ms'; } ?>
                  <?php if($Title==4){ echo 'M/s'; } ?>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label><?php echo $LastName; ?></label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label><?php echo $FirstName; ?></label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label><?php echo $MiddleName; ?></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">2.</span>Card&nbsp;Display&nbsp;Name*</p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label><?php echo $CardName; ?></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">3.</span>Known by any other Name?</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select name="APPKNOWBY" class="form-control inputborder" onChange="showdiv(this.value);" id="KnownByOther"  >
                    <option value="N" <?php if($KnownByOther=='N'){ echo 'selected'; } ?>>No</option>
                    <option value="Y" <?php if($KnownByOther=='Y'){ echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="otherNameDiv" style="display:none;">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first">&nbsp;Full&nbsp;Name&nbsp;Other(Initial,Last,First,Middle)*</p>
                  </div>
                </div>
                <!-- <div class="col-md-1">
<div class="form-group"> -->
                <div class="col-md-2">
                  <div class="form-group">
                    <select name="APPOTITLE" class="form-control inputborder">
                      <option value="" >Select</option>
                      <option value="1" <?php if($TitleOther==1){ echo 'selected'; } ?>>Shri</option>
                      <option value="2" <?php if($TitleOther==2){ echo 'selected'; } ?>>Smt/Mrs</option>
                      <option value="3" <?php if($TitleOther==3){ echo 'selected'; } ?>>Kumari/Ms</option>
                      <option value="4" <?php if($TitleOther==4){ echo 'selected'; } ?>>M/s</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $LastNameOther; ?></label>
                    <label id="LastNameOtherError" style="color: red;"></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $FirstNameOther; ?></label>
                    <label id="FirstNameOtherError" style="color: red;"></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $MiddleNameOther; ?></label>
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
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">4.</span>Gender&nbsp;(for&nbsp;'Individual'&nbsp;applicant&nbsp;only)</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select name="SEX" class="form-control inputborder" id="Gender">
                    <option value=""></option>
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
                  <p class="para" for="first"> <span class="numHead">5.</span>Date of Birth/Agreement&nbsp;*</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="DOB" id="DateAgreement" onChange="getDate(this.value);" class="form-control inputborder  datepicker" value="<?php if($DateAgreement!=''){ echo $DOB; }?>" readonly>
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
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">6.</span>Father&nbsp;Name&nbsp;(Initial,Last,First,Middle)</p>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control inputborder" name="fatherlastname" value="<?php echo $ApplicantFatherLastName; ?>" id="ApplicantFatherLastName"  style="width: 175px !important;"  >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control inputborder" name="fatherfirstname"  style="width: 175px !important;"  value="<?php echo $ApplicantFatherFirstName; ?>" id="ApplicantFatherFirstName"   >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control inputborder" name="fathermiddlename" value="<?php echo $ApplicantFatherMiddleName; ?>"  id="ApplicantFatherMiddleName"   style="width: 175px !important;"  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Mother&nbsp;Name&nbsp;(Initial,Last,First,Middle)</p>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control inputborder" name="motherlastename" id="ApplicantMotherLastName" value="<?php echo $ApplicantMotherLastName; ?>"  style="width: 175px !important;"   >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control inputborder" name="motherfirstname" value="<?php echo $ApplicantMotherFirstName; ?>" id="ApplicantMotherFirstName"  style="width: 175px !important;"   >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="text" class="form-control inputborder" name="mothermiddlename" value="<?php echo $ApplicantMotherMiddleName; ?>" id="ApplicantMotherMiddleName"  style="width: 175px !important;"   >
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Name to be printed on card&nbsp;(Father/Mother)</p>
                </div>
              </div>
              <!-- <div class="col-md-1">
<div class="form-group"> -->
              <div class="col-md-4">
                <div class="form-group">
                  <select name="fatherormothernameoncard" id="NamePrintedCard" class="form-control inputborder"  >
                    <option value="" ></option>
                    <option value="F" <?php if($NamePrintedCard=='F'){ echo 'selected'; } ?>>Father</option>
                    <option value="M" <?php if($NamePrintedCard=='M'){ echo 'selected'; } ?>>Mother</option>
                    <option value="S" <?php if($NamePrintedCard=='S'){ echo 'selected'; } ?>>Single Parent [Mother]</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h4 class="para br-ffr review-title" for="first"><span class="numHead">7.</span>Address for Communication</h4>
          <label id="addFieldError" style="display:none; color: red;"></label>
          <!--Residence address div-->
          <div class="col-md-12">
          <?php if($FlatDoorBlock!=''){ ?>
          <div id="ResidenceAddress" style="display:block;">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Residence Address</p>
                </div>
              </div>
              <div class="col-md-7">
                <div id="isForeignDiv" style="margin-left:4px;">
                  <div class="row">
                    <div class="col-md-5" style="max-width: 32%;">
                      <p class="para" for="first">&nbsp;Is Foreign Address</p>
                    </div>
                    <div class="col-md-7">
                      <input type="radio" class="js-trek" name="isotherresi"  <?php if($TownCityDistrict[1]!=''){ echo 'Checked'; } ?> value="Y"   style="pointer-events: none;" >
                      Y
                      &nbsp;&nbsp;&nbsp;
                      <input type="radio" class="js-trek"  name="isotherresi" <?php if($TownCityDistrict[1]==''){ echo 'Checked'; } ?> value="N"  style="pointer-events: none;" >
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
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>"   id="FlatDoorBlock">
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
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resibuildingorvillage"  value="<?php if($BuildingPremises!=''){ echo trim($BuildingPremises); } ?>"   id="BuildingPremises">
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
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resipostoffice" value="<?php if($RoadStreetLane!=''){ echo trim($RoadStreetLane); } ?>"   id="RoadStreetLane">
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
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiareasubdivision" value="<?php if($AreaLocalityTaluka!=''){ echo trim($AreaLocalityTaluka); } ?>"   id="AreaLocalityTaluka">
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
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt" name="resitownorcountry" id="TownCityDistrict"  value="<?php if($TownCityDistrict!=''){ echo trim($TownCityDistrict[0]); } ?>"   >
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
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control inputborder fg-gt" name="resistatecode" id="StateUnion"  >
                    <?php
          if($Zip=='999999'){ ?>
                    <option value="">FOREIGN ADDRESS</option>
                    <?php
          }elseif($Zip=='888888'){ ?>
                    <option value="">ADDRESS OF DEFENCE EMPLOYEES</option>
                    <?php }else{
        $StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
        $StateJson = json_decode($StateJson,true);
        foreach($StateJson['List'] as $StateData){
        
        ?>
                    <option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$StateUnion){ echo 'selected'; }?> ><?php echo $StateData['Name']; ?></option>
                    <?php } } ?>
                  </select>
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
              <div class="col-md-7">
                <div class="form-group">
                  <label>
                  <?php if($Zip=='999999'){ echo $TownCityDistrict[2]; }else{ echo $Zip; } ?>
                  </label>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <?php if($TownCityDistrict[1]!='') { ?>
            <div id="foreigncountryrsdDiv">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Country</p>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <select class="form-control inputborder fg-gt" name="foreigncountryrsd" id="foreigncountryrsd">
                      <option value="">Select</option>
                      <?php
                    $CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
                    $CountryJson = json_decode($CountryJson,true);
                    foreach($CountryJson['List'] as $CountryData){
                    ?>
                      <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$TownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                      <?php }  ?>
                    </select>
                    <label id="StateUnionError" style="display:none; color: red;"></label>
                  </div>
                </div>
                <!--  col-md-6   -->
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
          <?php } ?>
          <?php if($OFlatDoorBlock!=''){ ?>
          <div id="OfficeAddress" style="display:block;">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <h4 class="para br-ffr" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office Address</h4>
                </div>
              </div>
              <div class="col-md-7">
                <div id="isForeignDiv" style="margin-bottom: 20px;">
                  <div class="row">
                    <div class="col-md-5" style="max-width: 32%;">
                      <p class="para" for="first">Is Foreign Address</p>
                    </div>
                    <div class="col-md-7">
                      <input type="radio" class="js-trek" name="isotheroffce" <?php if($OTownCityDistrict[1]!=''){ echo 'Checked'; } ?>  value="Y"   style="pointer-events: none;" >
                      Y
                      &nbsp;&nbsp;&nbsp;
                      <input type="radio" class="js-trek"  name="isotheroffce" <?php if($OTownCityDistrict[1]==''){ echo 'Checked'; } ?> value="N"   style="pointer-events: none;" >
                      N </div>
                  </div>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Name of office(to be filled only in case of office addres)</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt" name="OFFICENAME"  value="<?php if($NameOffice!=''){ echo trim($NameOffice); } ?>" id="NameOffice">
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office Flat/Room/Door/Block No.</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt field" name="officeflatorblock" value="<?php if($OFlatDoorBlock!=''){ echo trim($OFlatDoorBlock); } ?>"   id="OFlatDoorBlock">
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office Name of Premises/Building/Village</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt field" name="officebuildingorvillage"  value="<?php if($OBuildingPremises!=''){ echo trim($OBuildingPremises); } ?>"   id="OBuildingPremises">
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office Road/Street/Lane/Post office</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt field" name="officestreeorpostoffice" value="<?php if($ORoadStreetLane!=''){ echo trim($ORoadStreetLane); } ?>"   id="ORoadStreetLane">
                  <label id="ORoadStreetLaneError" style="display:none; color: red;"></label>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office Area/Locality/Taluka/Sub-Division</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt field" name="officeareaorsubdivision" value="<?php if($OAreaLocalityTaluka!=''){ echo trim($OAreaLocalityTaluka); } ?>"   id="OAreaLocalityTaluka">
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office Town/City/District</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="text" class="form-control inputborder fg-gt" name="officetownorcontry" id="OTownCityDistrict"  value="<?php if($OTownCityDistrict!=''){ echo trim($OTownCityDistrict[0]); } ?>"   >
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office State Union Territory</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control inputborder fg-gt" name="officestatecode" id="OStateUnion"  >
                    <?php
          if($OZip=='999999'){ ?>
                    <option value="">FOREIGN ADDRESS</option>
                    <?
          }elseif($OZip=='888888'){ ?>
                    <option value="">ADDRESS OF DEFENCE EMPLOYEES</option>
                    <?php }else{
          
                      $OStateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
                      $OStateJson = json_decode($OStateJson,true);
                      foreach($OStateJson['List'] as $OStateData){
                      ?>
                    <option value="<?php echo $OStateData['Code']; ?>" <?php if($OStateData['Code']==$OStateUnion){ echo 'selected'; }?> ><?php echo $OStateData['Name']; ?></option>
                    <?php } } ?>
                  </select>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Office PIN/Zip Code</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <label>
                  <?php if($OZip=='999999'){ echo $OTownCityDistrict[2]; }else{ echo $OZip; } ?>
                  </label>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <?php if($OTownCityDistrict[1]!='') { ?>
            <div id="foreigncountryofsDiv">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Country</p>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <select class="form-control inputborder fg-gt" name="foreigncountryofs" id="foreigncountryofs">
                      <option value="">Select</option>
                      <?php
                    $CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
                    $CountryJson = json_decode($CountryJson,true);
                    foreach($CountryJson['List'] as $CountryData){
                    ?>
                      <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$OTownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!--  col-md-6   -->
              </div>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">8.</span>Address Type</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select name="COMMADDRESS" class="form-control inputborder" id="AddressType"  style="pointer-events: noxne;"  >
                    <option value="">Select</option>
                    <option value="R" <?php if($AddressType=='R'){ echo 'selected'; } ?>>Residence</option>
                    <option value="O" <?php if($AddressType=='O'){ echo 'selected'; } ?>>Office</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead">9.</span>Mobile/Telephone</p>
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
                    <option value="<?php echo $mobileisdData['ISDcode']; ?>" <?php if($mobileisdData['ISDcode']==$countryisd && $countryisd!=''){ echo 'selected'; }?> ><?php echo  $mobileisdData['ISDcode']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="number" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($StdCode!='' && $StdCode!=0){ echo $StdCode; } ?>" placeholder="Std Code"   >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="number" name="TELPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo $MobileNumber; ?>" placeholder="Enter Number"  >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">0.</span>Email</p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="email" name="EMAIL" id="Email" class="form-control inputborder yter" value="<?php if($Email!=''){ echo $Email; } ?>" style="width: 61%;"  >
                </div>
              </div>
            </div>
          </div>
          <section>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">11.</span>Registration&nbsp;Number&nbsp;(company,&nbsp;firm,&nbsp;LLP&nbsp;etc.)</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="REGNUM" value="<?php echo $RegistrationNumberFirm; ?>" id="RegistrationNumberFirm"  >
                    <label id="RegistrationNumberFirmError" style="display:none; color: red;"></label>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">12.</span>Whether citizen of India?</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select name="INDIANCITIZEN" class="form-control inputborder" id="WheatherCitizen"   >
                      <option value="">Select</option>
                      <option value="I" <?php if($WheatherCitizen=='I'){ echo 'selected'; } ?>>Indian</option>
                      <option value="O" <?php if($WheatherCitizen=='O'){ echo 'selected'; } ?>>Other</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Aadhar No</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="ADHARNUM" value="<?php echo $Aadhar; ?>" readonly >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12"  <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Aadhar Flag</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select name="adharflag" class="form-control inputborder" id="AadharVarification"   >
                      <option value="">Select</option>
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
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Aadhar Enrollment</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="adharenrolmentid" value="<?php echo $EnrolmentId; ?>" >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" <?php  if($Revised=='49AA'){ ?>style="display:none;"<?php }?>>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Name as per aadhar</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="nameasadhar" value="<?php echo $AadharName; ?>"   >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" <?php  if($Revised=='49A'){ ?>style="display:none;"<?php }?>>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Country of Citizenship</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control inputborder" name="countryofcitizen" id="Country" >
                      <option value=""></option>
                      <?php
                    $CountryJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
                    $CountryJson = json_decode($CountryJson,true);
                    foreach($CountryJson['List'] as $CountryData){
                    ?>
                      <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$Country){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="isdcodeofcitizencountry" id="CountryCode" class="form-control inputborder" style="display:none;">
                      <option value=""></option>
                      <?php
            $CountryCodeJosn = file_get_contents("".$serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
            $CountryCodeJosn = json_decode($CountryCodeJosn,true);
            foreach($CountryCodeJosn['List'] as $CountryCodeData){
            ?>
                      <option value="<?php echo $CountryCodeData['ISDcode']; ?>" <?php if($CountryCodeData['ISDcode']==$isdcodeofcitizencountry){ echo 'selected'; }?> ><?php echo '+'.$CountryCodeData['ISDcode']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" <?php  if($Revised=='49A'){ ?>style="display:none;"<?php }?>>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>ISD Of Country Citizenship</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="isdcodeofcitizencountry" id="CountryCode" class="form-control inputborder">
                      <option value=""></option>
                      <?php
            $CountryCodeJosn = file_get_contents("".$serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
            $CountryCodeJosn = json_decode($CountryCodeJosn,true);
            foreach($CountryCodeJosn['List'] as $CountryCodeData){
            ?>
                      <option value="<?php echo $CountryCodeData['ISDcode']; ?>" <?php if($CountryCodeData['ISDcode']==$isdcodeofcitizencountry){ echo 'selected'; }?> ><?php echo '+'.$CountryCodeData['ISDcode']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group"> </div>
                </div>
              </div>
            </div>
          </section>
          <section>
            <div class="col-md-12" style="margin-bottom: 10px;">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">13.</span>Source of Income</p>
                  </div>
                </div>
                <div class="col-md-3 gg-ff" >
                  <input class="jiy" type="checkbox" name="issalried" value="Y" <?php if($issalried=='Y'){ echo 'checked'; } ?> id="IncomeFromSalary" onClick="funcCheckAddType();">
                  <input type="hidden" name="IncomeFromSalary1" value="N" />
                  <p class="para" for="first">Income From&nbsp;Salary</p>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Organisation Name</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control inputborder" type="text" name="orgname" value="<?php echo $orgname; ?>" id="orgname" >
                    <label id="" style="display:none; color: red;"></label>
                  </div>
                </div>
                <!--  col-md-6   -->
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Business/Profession</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="isbusinessorprofession" id="BusinessProfessional" class="form-control inputborder"  >
                      <option value=""></option>
                      <option value="Y" <?php if($isbusinessorprofession=='Y'){ echo 'selected'; } ?>>Yes</option>
                    </select>
                    <label id="" style="display:none; color: red;"></label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="businessorprfessioncode" id="" class="form-control inputborder">
                      <option value=""></option>
                      <?php
            $businessorprfessioncodeJosn = file_get_contents($serverurlapi."Dashboards/masterscache/bussinessCodeMaster_pan.json");
            $businessorprfessioncodeJosn = json_decode($businessorprfessioncodeJosn,true);
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
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Another Source Of Income</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <select name="anotherincomesrctypecode" class="form-control inputborder" id="AnotherSourceIncome" >
                      <option value=""></option>
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
          </section>
          <section>
          <h4 class="para br-ffr review-title" for="first"><span class="numHead">14.</span>Representative Assesse Detail</h4>
          <?php if(trim($ralastname)!=''){ ?>
          <div >
            <input class="jiy" type="checkbox" name="RepDetails" id="RepDetails" value="1" onClick="CheckRepDetails();"  <?php if($ralastname!='' && $RFlatDoorBlock!=''){ echo 'checked'; } ?>>
            <p class="para br-ffr" for="first"> Fill Representative Assesse Detail Here</p>
          </div>
          <div id="repDetailsDiv" style="display:no11ne;">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <p class="para" for="first"> <span class="numHead" style="visibility: hidden;">10.</span>Is&nbsp;Foreign&nbsp;Address</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <input type="radio" class="jiy" name="isotherrep" <?php if($RTownCityDistrict[1]!=''){ echo 'Checked';  } ?> value="Y"   style="pointer-events: none;"  >
                  Y
                  &nbsp;&nbsp;&nbsp;
                  <input type="radio" class="jiy"  name="isotherrep" <?php if($RTownCityDistrict[1]==''){  echo 'Checked';  } ?> value="N"   style="pointer-events: none;" >
                  N </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Name&nbsp;(Initial,Last,First,Middle)*</p>
                  </div>
                </div>
                <!-- <div class="col-md-1">
        <div class="form-group"> -->
                <div class="col-md-2">
                  <div class="form-group">
                    <label>
                    <?php if($ratitlecode==1){ echo 'Shri'; } ?>
                    <?php if($ratitlecode==2){ echo 'Smt/Mrs'; } ?>
                    <?php if($ratitlecode==3){ echo 'Kumari/Ms'; } ?>
                    <?php if($ratitlecode==4){ echo 'M/s'; } ?>
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $ralastname; ?></label>
                    <label id="LastNameError" style="color: red;"></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $rafistname; ?></label>
                    <label id="FirstNameError" style="color: red;"></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $ramiddlename; ?></label>
                    <label id="MiddleNameError" style="color: red;"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Flat/Room/Door/Block No.</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <input type="text" class="form-control inputborder fg-gt field" name="raflatorblock" value="<?php if($RFlatDoorBlock!=''){ echo trim($RFlatDoorBlock); } ?>"    id="RFlatDoorBlock">
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Name of Premises/Building/Village</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <input type="text" class="form-control inputborder fg-gt field" name="rabuildingorvillage"  value="<?php if($RBuildingPremises!=''){ echo trim($RBuildingPremises); } ?>"    id="RBuildingPremises">
                <label id="RBuildingPremisesError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Road/Street/Lane/Post office</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <input type="text" class="form-control inputborder fg-gt field" name="streetorpostoffice" value="<?php if($RRoadStreetLane!=''){ echo trim($RRoadStreetLane); } ?>"    id="RRoadStreetLane">
                <label id="RRoadStreetLaneError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Area/Locality/Taluka/Sub-Division</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <input type="text" class="form-control inputborder fg-gt field" name="raareasubdivision" value="<?php if($RAreaLocalityTaluka!=''){ echo trim($RAreaLocalityTaluka); } ?>"    id="RAreaLocalityTaluka">
                <label id="RAreaLocalityTalukaError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Town/City/District</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <input type="text" class="form-control inputborder fg-gt" name="ratownorcountry" id="RTownCityDistrict"  value="<?php if($RTownCityDistrict!=''){ echo trim($RTownCityDistrict[0]); } ?>"   >
                <label id="RTownCityDistrictError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>State Union Territory</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <select class="form-control inputborder fg-gt" name="rastatecode" id="RStateUnion">
                  <?php
          if($RZip=='999999'){ ?>
                  <option value="">FOREIGN ADDRESS</option>
                  <?
          }elseif($RZip=='888888'){ ?>
                  <option value="">ADDRESS OF DEFENCE EMPLOYEES</option>
                  <?php }else{
                    $RStateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
                    $RStateJson = json_decode($RStateJson,true);
                    foreach($RStateJson['List'] as $RStateData){
                    ?>
                  <option value="<?php echo $RStateData['Code']; ?>" <?php if($RStateData['Code']==$RStateUnion){ echo 'selected'; }?> ><?php echo $RStateData['Name']; ?></option>
                  <?php }  }?>
                </select>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>PIN/Zip Code</p>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label>
                <?php if($RZip=='999999'){ echo $RTownCityDistrict[2]; }else{ echo $RZip; } ?>
                </label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <?php if($RTownCityDistrict[1]!='') { ?>
          <div id="foreigncountryrepDiv">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Country</p>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control inputborder fg-gt" name="foreigncountryrep" id="foreigncountryrep">
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
          <?php } ?>
        </div>
        <?php } ?>
        </section>
        <section>
              <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">15.</span>Proof&nbsp;of&nbsp;Identity&nbsp;Type&nbsp;*</p>
                  </div>
                </div>
                <div class="col-md-8">
                  <select class="form-control inputborder" name="POI" id="IdentityProof"    >
                    <option value="">Select</option>
                    <?php
                    $IdentityProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/newPOI_pan.json");
                    $IdentityProofJsonDec = json_decode($IdentityProofJson,true);
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
          <div class="col-md-12 ">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Proof&nbsp;of&nbsp;Address&nbsp;Type&nbsp;*</p>
                </div>
              </div>
              <div class="col-md-8">
                <select class="form-control inputborder" name="POA" id="AddressProof"     >
                  <option value="">Select</option>
                  <?php
                    $AddressProofJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/newPOA_pan.json");
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
          <div class="col-md-12 ">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Proof&nbsp;of&nbsp;DOB&nbsp;Type&nbsp;*</p>
                </div>
              </div>
              <div class="col-md-8">
                <select class="form-control inputborder" name="dobdocumentcode" id="ProofDOB"     >
                  <option value=""></option>
                  <?php
                $ProofDOBJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/PODB_pan_49A_P.json");
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
        </section>
        <section>
          <div class="col-md-12 "<?php  if($Revised=='49A'){ ?>style="display:none;"<?php }?>>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>KYC&nbsp;Compliant</p>
                </div>
              </div>
              <div class="col-md-9">
                <select class="form-control inputborder" name="iskyc" id="KycComplaint">
                  <option value=""></option>
                  <option value="Y" <?php if($KycComplaint=='Y'){ echo 'Selected'; } ?>>Yes</option>
                  <option value="N" <?php if($KycComplaint=='N'){ echo 'Selected'; } ?>>No</option>
                </select>
              </div>
            </div>
          </div>
        </section>
        <hr>
        <section>
          <h4 class="para br-ffr review-title" for="first"><span class="numHead">16.</span>Other Details</h4>
           <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility:hidden;">10.</span>Date of Receipt&nbsp;*</p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <?php
       /* $date = substr($ReceiptDate,0,2).'-';
        $month = substr($ReceiptDate,2,2).'-';
        $year = substr($ReceiptDate,4,5);
        $ReceiptDate = $date.$month.$year;*/
        ?>
                  <input type="text" name="acknwoledmentdate" value="<?php echo dateFormat($ReceiptDate); ?>" id="acknwoledmentdate" class="form-control datepicker inputborder datepicker" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom: 14px;">
            <div class="row">
              <div class="col-md-4">
                <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Physical&nbsp;PAN&nbsp;Card</p>
              </div>
              <div class="col-md-8">
                <input type="radio" class="js-trek" name="isphysicalpanwanted" <?php if($PhysicalPanCard=='Y'){ echo 'Checked'; } ?> value="Y" >
                Y
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="js-trek"  name="isphysicalpanwanted" <?php if($PhysicalPanCard=='N'){ echo 'Checked'; }  ?> value="N" >
                N </div>
            </div>
          </div>
        </section>
        <section>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Photo Present</p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <select name="isphotoattached" class="form-control inputborder"  >
                    <option value="Y" <?php if($PhotoPresence=='Y'){ echo 'Selected'; } ?>>Yes</option>
                    <option value="N" <?php if($PhotoPresence=='N'){ echo 'Selected'; } ?>>No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Signature Present</p>
                  </div>
                  <div class="col-md-8">
                    <select name="issignatureattached" class="form-control inputborder"  >
                      <option value="Y" <?php if($SignaturePresence=='Y'){ echo 'Selected'; } ?>>Yes</option>
                      <option value="N" <?php if($SignaturePresence=='N'){ echo 'Selected'; } ?>>No</option>
                    </select>
                  </div>
                </div>
              </div>
          
        </Section>
        <section>
          <div class="row"> </div>
        </Section>
        <section>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Application is for Minor/Deceased</p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <select name="isminor" class="form-control inputborder">
                    <option value=" "></option>
                    <option value="M" <?php if($isminor=='M'){ echo 'Selected'; } ?>>Minor</option>
                    <option value="D" <?php if($isminor=='D'){ echo 'Selected'; } ?>>Deceased</option>
                  </select>
                </div>
              </div>
              <!-- <div class="col-md-7" style="display:none;">
                      <div class="row">
                        <div class="col-md-5">
                          <p class="para" for="first">Descrepancy at TIN-FC Level</p>
                        </div>
                        <div class="col-md-7">
                          <select name="isdiscreattinfclevel" class="form-control inputborder"  >
                            <option value="Y" <?php if($isdiscreattinfclevel=='Y'){ echo 'Selected'; } ?>>Yes</option>
                            <option value="N" <?php if($isdiscreattinfclevel=='N'){ echo 'Selected'; } ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div> -->
            </div>
          </div>
        </section>
        <?php if($isdiscreattinfclevel=='Y' || $isdiscreattinfclevel=='1'){ ?>
        <section>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Date of Descrepancy&nbsp;Resolution</p>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <input type="text" name="dateofdescreresolution" value="<?php if($dateofdescreresolution!=''){ echo date('d-m-Y',strtotime($dateofdescreresolution)); } ?>" class="form-control datepicker inputborder datepicker" readonly >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Section>
        <?php } ?>
        <section>
          <h4 class="para br-ffr review-title" style="text-decoration: underline;" for="first"><span style="visibility:hidden;" class="numHead">10.</span>Verification</h4>
          <div class="col-md-12">
              <div class="form-group">
                <p class="para rew" for="first">I/We <span>
                <input type="text" class="form-control inputborder" placeholder="" name="verifiername" id="VerifierName" value="<?php echo $VerifierName; ?>" style="width: fit-content;display: initial;">
                <label id="VerifierNameError" style="color: red; display: none;"></label></span>
                ,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of<span>
                <select class="form-control inputborder" style="width: fit-content;display: initial;" name="verifiercapcitycode" id="CVerifier">
                  <option value=""></option>
                  <?php
          $CVerifierJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/verifierMaster_pan.json");
          $CVerifierJsondec = json_decode($CVerifierJson,true);
          foreach($CVerifierJsondec['ApplicationStatus'] as $CVerifierJson){
          
          if($CVerifierJson['Category']==$ApplicationStatus){
          foreach($CVerifierJson['List'] as $CVerifierData){
                    ?>
                  <option value="<?php echo $CVerifierData['Code']; ?>" <?php if($CVerifierData['Code']==$CVerifier){ echo 'selected'; }?> ><?php echo $CVerifierData['Name']; ?></option>
                  <?php } } } ?>
                </select></span> do hereby declare that what is stated above is true to the best of my/our information and belief.</p>
              </div>
              <div>
               
              </div>
            </div>
        </section>
        <section>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first" >Place</p>
              </div>
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control inputborder" placeholder="" name="verificationplace" id="VerifierPlace" value="<?php echo $VerifierPlace; ?>"  >
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first" >Date</p>
              </div>
              <?php
        /* $date = substr($VerifierDate,0,2).'-';
        $month = substr($VerifierDate,2,2).'-';
        $year = substr($VerifierDate,4,5);
        $VerifierDate = $date.$month.$year;*/
        ?>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <p class="para" for="first">
                  <input type="text" name="verificationdate" id="verificationdate" value="<?php echo dateFormat($VerifierDate); ?>" class="form-control datepicker inputborder datepicker" readonly >
                </p>
              </div>
            </div>
            </Section>
            <?php }
    
        else{
$PanNumber = trim($data['recordlist']['newpanid']); 
$ApplicationStatus = trim($data['recordlist']['STATUSOFAPPLICANT']);
$Title = trim($data['recordlist']['APPLTITLE']);
$isnamecr = trim($data['recordlist']['isnamecr']);
$LastName = trim($data['recordlist']['applicantlastname']);
$FirstName = trim($data['recordlist']['applicationfirstname']);
$MiddleName = trim($data['recordlist']['applicantmiddlename']);
$CardName = trim($data['recordlist']['NAMETOBEPRINTED']);
$isfathernamecr = trim($data['recordlist']['isfathernamecr']);
$ApplicantFatherLastName = trim($data['recordlist']['fatherlastname']);
$ApplicantFatherFirstName = trim($data['recordlist']['fatherfirstname']);
$ApplicantFatherMiddleName = trim($data['recordlist']['fathermiddlename']);
$isdobupdateflag = trim($data['recordlist']['isdobupdateflag']);
$DateAgreement = $data['recordlist']['DATEOFBIRTH'];
$issexupdate = $data['recordlist']['issexupdate'];
$Gender = trim($data['recordlist']['SEX']);
$PhotoMatch = trim($data['recordlist']['isphotomismatch']);
$SignatureMatch = trim($data['recordlist']['issignaturemismatch']);
$iscommaddressupdate = trim($data['recordlist']['iscommaddressupdate']);
$AddressType = trim($data['recordlist']['COMMADDRESS']);
$COMADDRESSTYPE = trim($data['recordlist']['COMADDRESS-TYPE']);
$isanotheraddressupdate = trim($data['recordlist']['isanotheraddressupdate']);
if($isanotheraddressupdate=='Y'){
  if($AddressType=='R'){
    $FlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
    $BuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
    $RoadStreetLane = trim($data['recordlist']['resipostoffice']);
    $AreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
    $TownCityDistrict = trim($data['recordlist']['resitownorcountry']);
    $TownCityDistrict = explode('~', $TownCityDistrict);
    $StateUnion = trim($data['recordlist']['resistatecode']);
    $Zip = trim($data['recordlist']['resipincode']);
    $isRepForeign = trim($data['recordlist']['isResForeign']);
    $NameOffice= '';
    $OFlatDoorBlock = '';
    $OBuildingPremises = '';
    $ORoadStreetLane = '';
    $OAreaLocalityTaluka = '';
    $OTownCityDistrict = '';
    $OTownCityDistrict = '';
    $OStateUnion = '';
    $OZip = '';
    $isOffceForeign = trim($data['recordlist']['isOffceForeign']);
    $RNameOffice = trim($data['recordlist']['OFFICENAME']);
    $RFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
    $RBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
    $RRoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
    $RAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
    $RTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
    $RTownCityDistrict = explode('~', $RTownCityDistrict);
    $RStateUnion = trim($data['recordlist']['officestatecode']);
    $RZip = trim($data['recordlist']['officepincode']);
    $isRepForeign = trim($data['recordlist']['isOffceForeign']);

  }
  if($AddressType=='O'){
    $FlatDoorBlock = '';
    $BuildingPremises = '';
    $RoadStreetLane = '';
    $AreaLocalityTaluka = '';
    $TownCityDistrict = '';
    $TownCityDistrict = '';
    $StateUnion = '';
    $Zip = '';
    $isResiForeign = trim($data['recordlist']['isResiForeign']);
    $NameOffice= trim($data['recordlist']['OFFICENAME']);
    $OFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
    $OBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
    $ORoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
    $OAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
    $OTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
    $OTownCityDistrict = explode('~', $OTownCityDistrict);
    $OStateUnion = trim($data['recordlist']['officestatecode']);
    $OZip = trim($data['recordlist']['officepincode']);
    $isOffceForeign = trim($data['recordlist']['isOffceForeign']);
    $RFlatDoorBlock = trim($data['recordlist']['raflatorblock']);
    $RBuildingPremises = trim($data['recordlist']['rabuildingorvillage']);
    $RRoadStreetLane = trim($data['recordlist']['streetorpostoffice']);
    $RAreaLocalityTaluka = trim($data['recordlist']['raareasubdivision']);
    $RTownCityDistrict = trim($data['recordlist']['ratownorcountry']);
    $RTownCityDistrict = explode('~', $RTownCityDistrict);
    $RStateUnion = trim($data['recordlist']['rastatecode']);
    $RZip = trim($data['recordlist']['rapincoe']);
    $RFlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
    $RBuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
    $RRoadStreetLane = trim($data['recordlist']['resipostoffice']);
    $RAreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
    $RTownCityDistrict = trim($data['recordlist']['resitownorcountry']);
    $RTownCityDistrict = explode('~', $RTownCityDistrict);
    $RStateUnion = trim($data['recordlist']['resistatecode']);
    $RZip = trim($data['recordlist']['resipincode']);
    $isRepForeign = trim($data['recordlist']['isResiForeign']);
  }
}else{
  $FlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
  $BuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
  $RoadStreetLane = trim($data['recordlist']['resipostoffice']);
  $AreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
  $TownCityDistrict = trim($data['recordlist']['resitownorcountry']);
  $TownCityDistrict = explode('~', $TownCityDistrict);
  $StateUnion = trim($data['recordlist']['resistatecode']);
  $Zip = trim($data['recordlist']['resipincode']);
  $isResiForeign = trim($data['recordlist']['isResiForeign']);
  $NameOffice= trim($data['recordlist']['OFFICENAME']);
  $OFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
  $OBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
  $ORoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
  $OAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
  $OTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
  $OTownCityDistrict = explode('~', $OTownCityDistrict);
  $OStateUnion = trim($data['recordlist']['officestatecode']);
  $OZip = trim($data['recordlist']['officepincode']);
  $isOffceForeign = trim($data['recordlist']['isOffceForeign']);
  $RFlatDoorBlock = '';
  $RBuildingPremises = '';
  $RRoadStreetLane = '';
  $RAreaLocalityTaluka = '';
  $RTownCityDistrict = '';
  $RTownCityDistrict = '';
  $RStateUnion = '';
  $RZip = '';
  $isRepForeign = trim($data['recordlist']['isRepForeign']);
  
}
$istelephoneemailupdate = trim($data['recordlist']['istelephoneemailupdate']);
$StdCode = trim($data['recordlist']['STDCODE']);
$MobileNumber = trim($data['recordlist']['TELPHONE']);
$Pan1 = trim($data['recordlist']['oldpan1']);
$Pan2 = trim($data['recordlist']['oldpan2']);
$Pan3 = trim($data['recordlist']['oldpan3']);
$Pan4 = trim($data['recordlist']['oldpan4']);
$Pan5 = trim($data['recordlist']['oldpan5']);
$Pan6 = trim($data['recordlist']['oldpan6']);
$Pan7 = trim($data['recordlist']['oldpan7']);
$Pan8 = trim($data['recordlist']['oldpan8']);
$Enclosed = trim($data['recordlist']['numofsupporteddoc']);
$verificationdate = trim($data['recordlist']['verificationdate']);
$POI = trim($data['recordlist']['POI']);
$POA = trim($data['recordlist']['POA']);
$reuploadedtonsdl = trim($data['recordlist']['reuploadedtonsdl']);
$isreprintrequest = trim($data['recordlist']['isreprintrequest']);
$AcknowledgementNumber = trim($data['recordlist']['acknowledmentnumber']);
$isphotoflag = trim($data['recordlist']['isphotoflag']);
$issignflag = trim($data['recordlist']['issignflag']);
$AcknowledgementDate = trim($data['recordlist']['acknwoledmentdate']);
$oldacknwoledmentnum = trim($data['recordlist']['oldacknwoledmentnum']);
$ispanproofgiven = trim($data['recordlist']['ispanproofgiven']);
$isminor = trim($data['recordlist']['isminor']);
$isdiscreattinfclevel = trim($data['recordlist']['isdiscreattinfclevel']);
$dateofdescreresolution = trim($data['recordlist']['dateofdescreresolution']);
$countryisd = trim($data['recordlist']['countryisd']);
$Aadhar = trim($data['recordlist']['ADHARNUM']);
$AadharVarification = trim($data['recordlist']['adharflag']);
$verifiername = trim($data['recordlist']['verifiername']);
$verifiercapcitycode = trim($data['recordlist']['verifiercapcitycode']);
$verificationplace = trim($data['recordlist']['verificationplace']);
$officezip = trim($data['recordlist']['officezip']);
$resizip = trim($data['recordlist']['resizip']);
$ProofDob = trim($data['recordlist']['proofofbirthdoccode']);
$ismothernamecr = trim($data['recordlist']['ismothernamecr']);
$ApplicantMotherLastName = trim($data['recordlist']['motherlastename']);
$ApplicantMotherFirstName = trim($data['recordlist']['motherfirstname']);
$ApplicantMotherMiddleName = trim($data['recordlist']['mothermiddlename']);
$NamePrintedCard = trim($data['recordlist']['fatherormothernameoncard']);
$EnrolmentId = trim($data['recordlist']['adharenrolmentid']);
$AadharName = trim($data['recordlist']['nameasadhar']);
$PhysicalPanCard = trim($data['recordlist']['isphysicalpanwanted']);
$modeofapplication = trim($data['recordlist']['modeofapplication']);
$VID = trim($data['recordlist']['VID']);
$uidtocken = trim($data['recordlist']['uidtocken']);
$adharref = trim($data['recordlist']['adharref']);
$Revised = trim($data['formtype']);
$Zip = trim($data['recordlist']['resipincode']);
         ?>
            <div class="dostas">
              <div style="display: flex;" class="arr">
                <div class="dostas2"></div>
                <h5 class="review-title">Applicant Personal Detail</h5>
                <div class="dostas1"> </div>
              </div>
            </div>
            <div class="row">
             <?php if($ApplicationStatus=='P'){ ?>
            <div class="col-md-3">
              <div class="form-group indian">
                <p  class="para mrest" for="first">Photo</p>
                <div class="ast" style="height: 140px; width: 63%; border: none !important;"> <img src="data/temp/crop/<?php echo $_GET['aid']; ?>_Photo.Jpg" style="border: 1px solid #79c117; height: 100%;"> </div>
              </div>
            </div>
            <?php } ?>
            <!--  col-md-6   -->
            <?php if($ApplicationStatus=='P'){ ?>
            <div class="col-md-4">
              <div class="form-group indian">
                <p  class="para mrest" for="first">Signature</p>
                <div class="ast1" style="width: -webkit-fill-available; border: none !important;"> <img  style=" border: 1px solid #79c117; width: 100%;height: fit-content;" src="data/temp/crop/<?php echo $_GET['aid']; ?>_Sig.Jpg"> </div>
              </div>
            </div>
            <?php } ?>
              <div class="col-md-5">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Application&nbsp;Status&nbsp;*</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <select name="STATUSOFAPPLICANT" id="ApplicationStatus" class="form-control inputborder" onChange="funcCheckAddType();"  >
                      <option value="">Select</option>
                      <?php
      $ApplicationStatusJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/applicantStatus_pan.json");
      $ApplicationStatusJson = json_decode($ApplicationStatusJson,true);
      foreach($ApplicationStatusJson['List'] as $ApplicationStatusData){
      ?>
                      <option value="<?php echo $ApplicationStatusData['Code']; ?>" <?php if($ApplicationStatusData['Code']==$ApplicationStatus){ echo 'selected'; }?> ><?php echo $ApplicationStatusData['Status'].' ['.$ApplicationStatusData['Code'].']'; ?></option>
                      <?php } ?>
                    </select>
                    <label id="ApplicationStatusError" style="color: red; display: none;"></label>
                  </div>
                </div>
                <div class="row drr">
                  <div class="col-md-5">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Acknowledgement&nbsp;No&nbsp;*</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <input type="text" class="form-control inputborder" name="acknowledmentnumber" value="<?php echo $AcknowledgementNumber; ?>" id="AcknowledgementNumber"   readonly>
                    <label id="AcknowledgementNumberError" style="color: red; display: none;"></label>
                  </div>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">1.</span>Full&nbsp;Name&nbsp;(Initial,Last,First,Middle)*
                      <input class="jiy" type="checkbox" name="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> >
                    </p>
                  </div>
                </div>
                <!-- <div class="col-md-1">
        <div class="form-group"> -->
                <div class="col-md-2">
                  <div class="form-group">
                    <label >
                    <?php if($Title==1){ echo 'Shri'; } ?>
                    <?php if($Title==2){ echo 'Smt/Mrs'; } ?>
                    <?php if($Title==3){ echo 'Kumari/Ms'; } ?>
                    <?php if($Title==4){ echo 'M/s'; } ?>
                    </label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $LastName; ?></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $FirstName; ?></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label><?php echo $MiddleName; ?></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Card&nbsp;Display&nbsp;Name*</p>
                    </div>
                  </div>
                  <!-- <div class="col-md-1">
        <div class="form-group"> -->
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder nbvu-test" style="width:100%" name="NAMETOBEPRINTED" value="<?php echo $CardName; ?>" id="CardName"     >
                    </div>
                  </div>
                </div>
                <!--   </div>
      </div> -->
                <!--  col-md-6   -->
              </div>
            </div>
            <!--   </div>
      </div> -->
            <!--  col-md-6   -->
          </div>
          <section>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group" style="margin-left: 20px;">
                    <p class="para" for="first"><span class="numHead">2.</span>Father&nbsp;Name&nbsp;(Initial,Last,First,Middle)
                      <input class="jiy" type="checkbox" name="isfathernamecr"  value="Y" <?php if($isfathernamecr=='Y'){ echo 'checked'; } ?> >
                    </p>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="fatherlastname" value="<?php echo $ApplicantFatherLastName; ?>">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="fatherfirstname" value="<?php echo $ApplicantFatherFirstName; ?>">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="fathermiddlename" value="<?php echo $ApplicantFatherMiddleName; ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first" style="margin-left: 40px;"> Mother&nbsp;Name&nbsp;(Initial,Last,First,Middle)
                      <input class="jiy" type="checkbox" name="ismothernamecr" value="Y" <?php if($ismothernamecr=='Y'){ echo 'checked'; } ?> >
                    </p>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="motherlastename" value="<?php echo $ApplicantMotherLastName; ?>" >
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="motherfirstname" value="<?php echo $ApplicantMotherFirstName; ?>" >
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <input type="text" class="form-control inputborder" name="mothermiddlename" value="<?php echo $ApplicantMotherMiddleName; ?>" >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Name to be printed on card (Father/Mother)</p>
                  </div>
                </div>
                <!-- <div class="col-md-1">
        <div class="form-group"> -->
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="fatherormothernameoncard" class="form-control inputborder" id="NamePrintedCard">
                      <option value=""></option>
                      <option value="F" <?php if($NamePrintedCard=='F'){ echo 'selected'; } ?>>Father</option>
                      <option value="M" <?php if($NamePrintedCard=='M'){ echo 'selected'; } ?>>Mother</option>
                      <option value="S" <?php if($NamePrintedCard=='S'){ echo 'selected'; } ?>>Single Parent</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 14px;">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead" style="visibility: hidden;">10.</span>Whether&nbsp;application&nbsp;wishes&nbsp;to&nbsp;have&nbsp;physical&nbsp;PAN&nbsp;Card</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="radio" class="js-trek" name="isphysicalpanwanted" <?php if($PhysicalPanCard=='Y'){ echo 'Checked'; } ?> value="Y" >
                    <p class="para grek gc-xc" for="first">Y </p>
   
                    <input type="radio" class="js-trek"  name="isphysicalpanwanted" <?php if($PhysicalPanCard=='N'){ echo 'Checked'; }  ?> value="N"  >
                    <p class="para grek gc-xc" for="first">N </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <p class="para" for="first" style="margin-left: 20px;"><span class="numHead">3.</span>Date of Birth/Agreement&nbsp;*</p>
                  <?php
    $DOB = $DateAgreement;
    $date = substr($DOB,0,2).'-';
    $month = substr($DOB,2,2).'-';
    $year = substr($DOB,4,5);
    $DOB = $date.$month.$year;
    ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input class="jiy" type="checkbox" name="isdobupdateflag" value="Y" <?php if($isdobupdateflag=='Y'){ echo 'checked'; } ?> >
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="DOB" id="DateAgreement" onChange="getDate(this.value);" class="form-control inputborder  datepicker" value="<?php if($DateAgreement!=''){ echo $DOB; }?>" readonly>
                  <input type="hidden" name="DATEOFBIRTH" id="DATEOFBIRTH" value="<?php echo $DateAgreement; ?>">
                </div>
              </div>
            </div>
          </div>
           <section>
			  <div class="row">
				<div class="col-md-8">
				  <p class="para" for="first" style="margin-left: 28px;"> <span class="numHead">4.</span> </p>
				</div>
				<div class="col-md-2">
				  <div class="dostas">
					<div style="display: flex;" class="arr">
					  <div class="dostas2"> </div>
					  <h5>5</h5>
					  <div class="dostas1"> </div>
					</div>
				  </div>
				</div>
				<div class="col-md-2">
				  <div class="dostas">
					<div style="display: flex;" class="arr">
					  <div class="dostas2"> </div>
					  <h5>6</h5>
					  <div class="dostas1"> </div>
					</div>
				  </div>
				</div>
			  </div>
			</section>
			<section>
			  <div class="row">
				<div class="col-md-4 gg-ff">
				  <p class="para ytti-t" for="first" style="margin-left: 40px;">Gender&nbsp;(for&nbsp;'Individual'&nbsp;applicant&nbsp;only)</p>
				</div>
				<div class="col-md-2 gg-ff">
				  <input class="jiy" type="checkbox" name="issexupdate" value="Y" <?php if($issexupdate=='Y'){ echo 'checked'; } ?> >
				</div>
				<div class="col-md-2 gg-ff">
				  <select name="SEX" class="form-control inputborder" id="Gender">
					<option value="" ></option>
					<option value="M" <?php if($Gender=='M'){ echo 'Selected'; } ?>>Male</option>
					<option value="F" <?php if($Gender=='F'){ echo 'Selected'; } ?>>Female</option>
					<option value="T" <?php if($Gender=='T'){ echo 'Selected'; } ?>>Transgender</option>
				  </select>
				</div>
				<div class="col-md-2 gg-ff">
				  <input class="jiy" type="checkbox" name="isphotomismatch" value="Y" <?php if($PhotoMatch=='Y'){ echo 'checked'; } ?> >
				  <input type="hidden" name="PhotoMatch1" value="N" />
				  <p class="para" for="first">Photo&nbsp;Mismatch</p>
				</div>
				<div class="col-md-2 gg-ff">
				  <input class="jiy" type="checkbox" name="issignaturemismatch" value="Y" <?php if($SignatureMatch=='Y'){ echo 'checked'; } ?> >
				  <input type="hidden" name="SignatureMatch1" value="N" />
				  <p class="para" for="first">Signature&nbsp;Mismatch</p>
				</div>
			  </div>
			</section>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <p class="para" for="first" style="margin-left: 20px;"><span class="numHead">7.</span>Communication Address Type
                      <input class="jiy" type="checkbox" name="iscommaddressupdate" value="Y" <?php if($iscommaddressupdate=='Y'){ echo 'checked'; } ?> >
                    </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <select name="COMMADDRESS" class="form-control inputborder" id="AddressType"  style="pointer-events: none;">
                      <option value="">Select</option>
                      <option value="R" <?php if($AddressType=='R'){ echo 'selected'; } ?>>Residence</option>
                      <option value="O" <?php if($AddressType=='O'){ echo 'selected'; } ?>>Office</option>
                    </select>
                  </div>
                </div>
              </div>
              <?php if($FlatDoorBlock!=''){ ?>
              <div id="ResidenceAddress" style="display:block;">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <h4 class="para br-ffr" for="first" style="margin-left: 40px;">Address</h4>
                      <label id="addFieldError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div id="isForeignDiv">
                      <div class="row">
                        <div class="col-md-5" style="max-width: 32%;">
                          <p class="para" for="first">Is Foreign Address</p>
                        </div>
                        <div class="col-md-7">
                          <input type="radio" class="js-trek" name="isotherresi"  <?php if($TownCityDistrict[1]!=''){ echo 'Checked'; } ?> value="Y"   style="pointer-events: none;" >
                          Y
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" class="js-trek"  name="isotherresi" <?php if($TownCityDistrict[1]==''){ echo 'Checked'; } ?> value="N"  style="pointer-events: none;" >
                          N </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Flat/Room/Door/Block No.</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>"   id="FlatDoorBlock">
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Name of Premises/Building/Village</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resibuildingorvillage"  value="<?php if($BuildingPremises!=''){ echo trim($BuildingPremises); } ?>"   id="BuildingPremises">
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Road/Street/Lane/Post office</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resipostoffice" value="<?php if($RoadStreetLane!=''){ echo trim($RoadStreetLane); } ?>"   id="RoadStreetLane">
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Area/Locality/Taluka/Sub-Division</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder fg-gt fieldAddress" name="resiareasubdivision" value="<?php if($AreaLocalityTaluka!=''){ echo trim($AreaLocalityTaluka); } ?>"   id="AreaLocalityTaluka">
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;">Town/City/District</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control inputborder inputtyodr fg-gt iscommaddressupdateCls" name="resitownorcountry" id="TownCityDistrict"  value="<?php if($TownCityDistrict!=''){ echo trim($TownCityDistrict[0]); } ?>" >
                    </div>
                    <!--  col-md-6   -->
                  </div>
				  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">State Union Territory</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <select class="form-control inputborder fg-gt" name="resistatecode" id="StateUnion"  >
                          <?php
          if($Zip=='999999'){ ?>
                          <option value="">FOREIGN ADDRESS</option>
                          <?php
          }elseif($Zip=='888888'){ ?>
                          <option value="">ADDRESS OF DEFENCE EMPLOYEES</option>
                          <?php }else{
        $StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
        $StateJson = json_decode($StateJson,true);
        foreach($StateJson['List'] as $StateData){
        
        ?>
                          <option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$StateUnion){ echo 'selected'; }?> ><?php echo $StateData['Name']; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">PIN/Zip Code</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label>
                        <?php if($Zip=='999999'){ echo $TownCityDistrict[2]; }else{ echo $Zip; } ?>
                        </label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <?php if($TownCityDistrict[1]!='') { ?>
                  <div id="foreigncountryrsdDiv">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first" style="margin-left: 40px;">Country</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <select class="form-control inputborder fg-gt" name="foreigncountryrsd" id="foreigncountryrsd">
                            <option value="">Select</option>
                            <?php
                    $CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
                    $CountryJson = json_decode($CountryJson,true);
                    foreach($CountryJson['List'] as $CountryData){
                    ?>
                            <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$TownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                            <?php }  ?>
                          </select>
                        </div>
                      </div>
                      <!--  col-md-6   -->
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <?php } ?>
                <?php if($OFlatDoorBlock!=''){ ?>
                <div id="OfficeAddress" style="display:block;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <h4 class="para br-ffr" for="first" style="margin-left: 40px;">Address</h4>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div id="isForeignDiv" style="margin-bottom: 20px;">
                        <div class="row">
                          <div class="col-md-5" style="max-width: 32%;">
                            <p class="para" for="first" style="margin-left: 40px;">Is Foreign Address</p>
                          </div>
                          <div class="col-md-7">
                            <input type="radio" class="js-trek" name="isotheroffce" <?php if($OTownCityDistrict[1]!=''){ echo 'Checked'; } ?>  value="Y"   style="pointer-events: none;" >
                            Y
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" class="js-trek"  name="isotheroffce" <?php if($OTownCityDistrict[1]==''){ echo 'Checked'; } ?> value="N"   style="pointer-events: none;" >
                            N </div>
                        </div>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Name of office</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt" name="OFFICENAME"  value="<?php if($NameOffice!=''){ echo trim($NameOffice); } ?>" id="NameOffice">
                      </div>
                      <label id="NameOfficeError" style="display:none; color: red;"></label>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Flat/Room/Door/Block No.</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="officeflatorblock" value="<?php if($OFlatDoorBlock!=''){ echo trim($OFlatDoorBlock); } ?>"   id="OFlatDoorBlock">
                        <label id="OFlatDoorBlockError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Name of Premises/Building/Village</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="officebuildingorvillage"  value="<?php if($OBuildingPremises!=''){ echo trim($OBuildingPremises); } ?>"   id="OBuildingPremises">
                        <label id="OBuildingPremisesError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Road/Street/Lane/Post office</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="officestreeorpostoffice" value="<?php if($ORoadStreetLane!=''){ echo trim($ORoadStreetLane); } ?>"   id="ORoadStreetLane">
                        <label id="ORoadStreetLaneError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Area/Locality/Taluka/Sub-Division</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="officeareaorsubdivision" value="<?php if($OAreaLocalityTaluka!=''){ echo trim($OAreaLocalityTaluka); } ?>"   id="OAreaLocalityTaluka">
                        <label id="OAreaLocalityTalukaError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Town/City/District</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt" name="officetownorcontry" id="OTownCityDistrict"  value="<?php if($OTownCityDistrict!=''){ echo trim($OTownCityDistrict[0]); } ?>"   >
                        <label id="OTownCityDistrictError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">State Union Territory</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <select class="form-control inputborder fg-gt" name="officestatecode" id="OStateUnion"  >
                          <?php
          if($OZip=='999999'){ ?>
                          <option value="">FOREIGN ADDRESS</option>
                          <?
          }elseif($OZip=='888888'){ ?>
                          <option value="">ADDRESS OF DEFENCE EMPLOYEES</option>
                          <?php }else{
          
                      $OStateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
                      $OStateJson = json_decode($OStateJson,true);
                      foreach($OStateJson['List'] as $OStateData){
                      ?>
                          <option value="<?php echo $OStateData['Code']; ?>" <?php if($OStateData['Code']==$OStateUnion){ echo 'selected'; }?> ><?php echo $OStateData['Name']; ?></option>
                          <?php } } ?>
                        </select>
                        <label id="OStateUnionError" style="display:none; color: red;"></label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">PIN/Zip Code</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label>
                        <?php if($OZip=='999999'){ echo $OTownCityDistrict[2]; }else{ echo $OZip; } ?>
                        </label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <?php if($OTownCityDistrict[1]!='') { ?>
                  <div id="foreigncountryofsDiv">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first" style="margin-left: 40px;">Country</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <select class="form-control inputborder fg-gt" name="foreigncountryofs" id="foreigncountryofs">
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
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <section >
                <h4 class="para br-ffr" for="first" style="margin-left: 10px;"><span class="numHead">8.</span>Address for Other
                  <input class="jiy" type="checkbox" name="isanotheraddressupdate" id="isanotheraddressupdate" value="Y" <?php if($isanotheraddressupdate=='Y'){ echo 'checked'; } ?> >
                </h4>
                <?php if($RFlatDoorBlock!=''){ ?>
                <div id="repDetailsDiv" style="">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;"> Is&nbsp;Foreign&nbsp;Address</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="radio" class="jiy" name="isotherrep" <?php if($isRepForeign=='Y'){ echo 'Checked'; }  ?> value="Y" onChange="funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');"   >
                        Y
                        &nbsp;&nbsp;&nbsp;
                        <input type="radio" class="jiy"  name="isotherrep"  <?php if($isRepForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');" >
                        N </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <?php if($AddressType=='R'){ ?>
                  <div class="row" id="Roffice">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Name of office</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder inputtyodr fg-gt " name="RNameOffice"  value="<?php if($RNameOffice!=''){ echo trim($RNameOffice); } ?>" id="RNameOffice">
                      </div>
                    </div>
                    <!--col-md-6 -->
                  </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Flat/Room/Door/Block No.</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="raflatorblock" value="<?php if($RFlatDoorBlock!=''){ echo trim($RFlatDoorBlock); } ?>"    id="RFlatDoorBlock">
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;" >Name of Premises/Building/Village</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="rabuildingorvillage"  value="<?php if($RBuildingPremises!=''){ echo trim($RBuildingPremises); } ?>"    id="RBuildingPremises">
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Road/Street/Lane/Post office</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="streetorpostoffice" value="<?php if($RRoadStreetLane!=''){ echo trim($RRoadStreetLane); } ?>"    id="RRoadStreetLane">
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Area/Locality/Taluka/Sub-Division</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt field" name="raareasubdivision" value="<?php if($RAreaLocalityTaluka!=''){ echo trim($RAreaLocalityTaluka); } ?>"    id="RAreaLocalityTaluka">
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Town/City/District</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder fg-gt" name="ratownorcountry" id="RTownCityDistrict"  value="<?php if($RTownCityDistrict!=''){ echo trim($RTownCityDistrict[0]); } ?>"   >
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">State Union Territory</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <select class="form-control inputborder fg-gt" name="rastatecode" id="RStateUnion">
                          <?php
          if($RZip=='999999'){ ?>
                          <option value="">FOREIGN ADDRESS</option>
                          <?
          }elseif($RZip=='888888'){ ?>
                          <option value="">ADDRESS OF DEFENCE EMPLOYEES</option>
                          <?php }else{
                    $RStateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
                    $RStateJson = json_decode($RStateJson,true);
                    foreach($RStateJson['List'] as $RStateData){
                    ?>
                          <option value="<?php echo $RStateData['Code']; ?>" <?php if($RStateData['Code']==$RStateUnion){ echo 'selected'; }?> ><?php echo $RStateData['Name']; ?></option>
                          <?php }  }?>
                        </select>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">PIN/Zip Code</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label>
                        <?php if($RZip=='999999'){ echo $RTownCityDistrict[2]; }else{ echo $RZip; } ?>
                        </label>
                      </div>
                    </div>
                    <!--  col-md-6   -->
                  </div>
                  <?php if($RTownCityDistrict[1]!='') { ?>
                  <div id="foreigncountryrepDiv">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <p class="para" for="first" style="margin-left: 40px;">Country</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <select class="form-control inputborder fg-gt" name="foreigncountryrep" id="foreigncountryrep">
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
                  <?php } ?>
                </div>
                <?php } ?>
              </section>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 10px;"><span class="numHead">9.</span>Mobile/Telephone
                        <input class="jiy" type="checkbox" name="istelephoneemailupdate" value="Y" <?php if($istelephoneemailupdate=='Y'){ echo 'checked'; } ?> >
                      </p>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <select name="countryisd" id="CountryCode" class="form-control inputborder">
                        <option value="91">+91</option>
                        <?php
            $CountryCodeJosn = file_get_contents("".$serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
            $CountryCodeJosn = json_decode($CountryCodeJosn,true);
            foreach($CountryCodeJosn['List'] as $CountryCodeData){
            ?>
                        <option value="<?php echo $CountryCodeData['Code']; ?>" <?php if($CountryCodeData['ISDcode']==$CountryCode){ echo 'selected'; }?> ><?php echo '+'.$CountryCodeData['ISDcode']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input type="number" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($StdCode!='' && $StdCode!=0){ echo $StdCode; } ?>" placeholder="Std Code" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="number" name="TELPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo $MobileNumber; ?>" placeholder="Enter Number" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 40px;"><span class="numHead" style="visibility: hidden;">0.</span>Email</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" name="EMAIL" id="Email" class="form-control inputborder yter" value="<?php if($Email!=''){ echo $Email; } ?>" style="width: 61%;" >
                    </div>
                  </div>
                </div>
              </div>
              <section>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 10px;"><span class="numHead">10.</span>Aadhar No</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="ADHARNUM" value="<?php echo $Aadhar; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Aadhar Flag</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="adharflag" class="form-control inputborder" id="AadharVarification" >
                          <option value="">Select</option>
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
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Aadhar Enrollment</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="adharenrolmentid" value="<?php echo $EnrolmentId; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 40px;">Name as per aadhar</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control inputborder" name="nameasadhar" value="<?php echo $AadharName; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section>
                <h4 class="para br-ffr vtd" for="first" style="margin-left: 10px;"><span class="numHead">11.</span>Mention other Permanent Account Number (PANs) alloted to you</h4>
                <div class="form-group ">
                  <div class="grid-container">
                    <div class="item1">
                      <div class="flex">
                        <p class="para rew" for="first" style="margin-left: 40px;">PAN&nbsp;1</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan1" value="<?php echo $Pan1; ?>">
                      </div>
                    </div>
                    <div class="item2">
                      <div class="flex">
                        <p class="para rew" for="first">PAN&nbsp;2</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan2" value="<?php echo $Pan2; ?>">
                      </div>
                    </div>
                    <div class="item3">
                      <div class="flex">
                        <p class="para rew" for="first">PAN&nbsp;3</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan3" value="<?php echo $Pan3; ?>">
                      </div>
                    </div>
                    <div class="item4">
                      <div class="flex">
                        <p class="para rew" for="first">PAN&nbsp;4</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan4" value="<?php echo $Pan4; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group ">
                  <div class="grid-container">
                    <div class="item1">
                      <div class="flex">
                        <p class="para rew" for="first" style="margin-left: 40px;">PAN&nbsp;5</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan5" value="<?php echo $Pan5; ?>">
                      </div>
                    </div>
                    <div class="item2">
                      <div class="flex">
                        <p class="para rew" for="first">PAN&nbsp;6</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan6" value="<?php echo $Pan6; ?>">
                      </div>
                    </div>
                    <div class="item3">
                      <div class="flex">
                        <p class="para rew" for="first">PAN&nbsp;7</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan7" value="<?php echo $Pan7; ?>">
                      </div>
                    </div>
                    <div class="item4">
                      <div class="flex">
                        <p class="para rew" for="first">PAN&nbsp;8</p>
                        <input type="text" class="form-control inputborder " placeholder="" name="oldpan8" value="<?php echo $Pan8; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first"><span class="numHead">12.</span>Proof&nbsp;of&nbsp;Identity&nbsp;Type&nbsp;*</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control inputborder" name="POI" id="IdentityProof"  >
                        <option value="">Select</option>
                       <?php
$IdentityProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/correctionPOI_pan.json");
$IdentityProofJsonDec = json_decode($IdentityProofJson,true);
foreach($IdentityProofJsonDec['ApplicationStatus'] as $IdentityProofJson){
if($Revised == "CR"){
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
<option value="<?php echo $IdentityProofData['Status']; ?>" <?php if($IdentityProofData['Status']==$POI){ echo 'selected'; }?> ><?php echo $IdentityProofData['Name']; ?></option>
<?php } } } } ?>
                      </select>
                      <label id="IdentityProofError" style="color: red; display: none;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 25px;">Proof&nbsp;of&nbsp;Address&nbsp;Type&nbsp;*</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control inputborder" name="POA" id="AddressProof"  >
                        <option value="">Select</option>
                       <?php
$AddressProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/correctionPOA_pan.json");
$AddressProofJsonDec = json_decode($AddressProofJson,true);
foreach($AddressProofJsonDec['ApplicationStatus'] as $AddressProofJson){
if($Revised == "CR"){
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

<option value="<?php echo $AddressProofData['Code']; ?>" <?php if($AddressProofData['Code']==$POA){ echo 'selected'; }?> ><?php echo $AddressProofData['Name']; ?></option>
<?php } }  } } ?>
                      </select>
                      <label id="AddressProofError" style="color: red; display: none;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 25px;">Proof&nbsp;of&nbsp;DOB&nbsp;Type&nbsp;*</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control inputborder" name="proofofbirthdoccode" id="ProofDOB"  >
                        <option value=""></option>
                        <?php
                $ProofDOBJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/PODB_pan_49A_P.json");
                $ProofDOBJsonDec = json_decode($ProofDOBJson,true);
        foreach($ProofDOBJsonDec['ApplicationStatus'] as $ProofDOBJson){
        if($ProofDOBJson['Category']==$ApplicationStatus){
                foreach($ProofDOBJson['List'] as $ProofDOBData){
                ?>
                        <option value="<?php echo $ProofDOBData['Code']; ?>" <?php if($ProofDOBData['Code']==$ProofDob){ echo 'selected'; }?> ><?php echo $ProofDOBData['Name']; ?></option>
                        <?php  } } } ?>
                      </select>
                      <label id="ProofDOBError" style="color: red; display: none;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <?php if($_SESSION["Type"]=='QCP'){ ?>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 25px;">Old&nbsp;Acknowledgment#</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control inputborder " placeholder="" name="oldacknwoledmentnum" value="<?php echo $oldacknwoledmentnum; ?>">
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 25px;">Reupload&nbsp;to&nbsp;NSDL</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <select name="reuploadedtonsdl" class="form-control inputborder"   id="reuploadedtonsdl"  >
                        <option value=""></option>
                        <option value="Y" <?php if($reuploadedtonsdl=='Y'){ echo 'selected'; } ?>>Yes</option>
                        <option value="N" <?php if($reuploadedtonsdl=='N'){ echo 'selected'; } ?>>No</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 25px;">Pan&nbsp;Proof&nbsp;Given</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <select name="ispanproofgiven" class="form-control inputborder"   id="ispanproofgiven"  >
                        <option value=""></option>
                        <option value="C" <?php if($ispanproofgiven=='C'){ echo 'selected'; } ?>>C</option>
                        <option value="M" <?php if($ispanproofgiven=='L'){ echo 'selected'; } ?>>L</option>
                        <option value="G" <?php if($ispanproofgiven=='G'){ echo 'selected'; } ?>>G</option>
                      </select>
                    </div>
                    <div class="col-md-2"> <div class="form-group">
                    	<p class="para" for="first" style="margin-left: 25px;">Reprint&nbsp;Request</p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <select name="isreprintrequest" class="form-control inputborder"   id="isreprintrequest"  >
                      <option value=""></option>
                      <option value="Y" <?php if($isreprintrequest=='Y'){ echo 'selected'; } ?>>Yes</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 ">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <p class="para" for="first" style="margin-left: 25px;">Applicant Minor/Deceased</p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <select name="isminor" class="form-control inputborder" id="isminor">
                      <option value=""></option>
                      <option value="M" <?php if($isminor=='M'){ echo 'selected'; } ?>>Minor</option>
                      <option value="D" <?php if($isminor=='D'){ echo 'selected'; } ?>>Deceased</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <p class="para" for="first">ACK. Date</p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <?php
/*$date = substr($AcknowledgementDate,0,2).'-';
$month = substr($AcknowledgementDate,2,2).'-';
$year = substr($AcknowledgementDate,4,5);
$AcknowledgementDate = $date.$month.$year;*/
?>
                    <input type="text" class="form-control inputborder datepicker" name="acknwoledmentdate" readonly="readonly" value="<?php echo dateFormat($AcknowledgementDate); ?>">
                  </div>
                </div>
              </div>
            </div>
            </section>
            <?php if($isdiscreattinfclevel=='Y' || $isdiscreattinfclevel=='1'){ ?>
            <section>
              <div class="row ">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 25px;">Date of Descrepancy Resolution</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <input type="text" name="dateofdescreresolution" value="<?php if($dateofdescreresolution!=''){ echo date('d-m-Y',strtotime($dateofdescreresolution)); } ?>" class="form-control datepicker inputborder datepicker"  >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <?php } ?>
            <section>
              <h4 class="para br-ffr vtd" for="first" style="margin-left: 20px;">Verification</h4>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="form-group">
                    <p class="para rew" for="first" style="margin-left: 10px;">I/We</p>
                    <input type="text" class="form-control inputborder" placeholder="" name="verifiername" id="VerifierName" value="<?php echo $VerifierName; ?>"  >
                    <label id="VerifierNameError" style="color: red; display: none;"></label>
                    <p class="para rew" for="first">,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of</p>
                    <select class="form-control inputborder " name="verifiercapcitycode" id="CVerifier" >
                      <option value=""> </option>
                      <?php
                    $CVerifierJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/verifierMaster_pan.json");
          $CVerifierJsondec = json_decode($CVerifierJson,true);
          foreach($CVerifierJsondec['ApplicationStatus'] as $CVerifierJson){
          
          if($CVerifierJson['Category']==$ApplicationStatus){
          foreach($CVerifierJson['List'] as $CVerifierData){
                    ?>
                      <option value="<?php echo $CVerifierData['Code']; ?>" <?php if($CVerifierData['Code']==$verifiercapcitycode){ echo 'selected'; }?> ><?php echo $CVerifierData['Name']; ?></option>
                      <?php } } } ?>
                    </select>
                  </div>
                  <div>
                    <p class="para rew" for="first" style="margin-left: 30px;">do&nbsp;hereby declare that what is stated above is true to the best of my/ourinformation and belief</p>
                  </div>
                  <div class="form-group">
                    <p class="para rew" for="first">I/We have enclosed</p>
                    <input type="text" class="form-control inputborder cx-jh" placeholder="" name="numofsupporteddoc" id="Enclosed" value="<?php echo $Enclosed; ?>">
                    <p class="para rew" for="first">(number of document) in support of proposed changes/corrections</p>
                  </div>
                </div>
              </div>
            </Section>
            <section>
              <div class="row hg-op">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first" style="margin-left: 30px;">Place</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control inputborder" placeholder="" name="verificationplace" id="VerifierPlace" value="<?php echo $VerifierPlace; ?>"  >
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
                      <?php
         /*$date = substr($verificationdate,0,2).'-';
        $month = substr($verificationdate,2,2).'-';
        $year = substr($verificationdate,4,5);
        $verificationdate = $date.$month.$year;*/
        ?>
                      <input type="text" class="form-control inputborder datepicker" name="verificationdate" readonly="readonly" value="<?php echo dateFormat($verificationdate); ?>">
                    </div>
                  </div>
                </div>
              </div>
            </Section>
            <?php } ?>
          </div>
          </section>
        </div>
        <input type="hidden" name="action" value="reviewdatasubmit">
        <div class="nxrt" style="width: fit-content;display: flex;">
          <?php if($Revised=="CR"){ ?>
          <a href="dataentry.php?aid=<?php echo $_GET['aid']; ?>&formType=<?php echo $Revised; ?>&page=2" class="previous"><i class="fa fa-angle-left" ></i> Back <i class="fa fa-angle-left" ></i> Page 1</a>
          <?php }else{ ?>
          <a href="dataentry.php?aid=<?php echo $_GET['aid']; ?>&formType=<?php echo $Revised; ?>&page=2" class="previous"><i class="fa fa-angle-left" ></i> Back <i class="fa fa-angle-left" ></i> Page 1</a> <a href="dataentry.php?aid=<?php echo $_GET['aid']; ?>&formType=<?php echo $Revised; ?>&page=3" class="previous"><i class="fa fa-angle-left" ></i> Back <i class="fa fa-angle-left" ></i> Page 2</a>
          <?php } ?>
          <?php 
		  if(strtoupper(substr($Stage,-2))!= "BC"){
     if($_SESSION['branchId']=="QCF" || strtoupper(substr($Stage,0,1)) == "I")
    { ?>
          <button type="button" class="next btn btn-warning" style="background: orange;" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Resolve Rejection','modelpop.php?action=addqcresolve&aid=<?php echo $_GET['aid']; ?>&formType=<?php echo trim($_GET['formType']); ?>&status=1&ProductType=<?php echo $ProductType; ?>','100%','auto');"> Resolve Rejection </button>
          <?php } } ?>
          <button type="submit" class="next"> Submit <i class="fa fa-angle-right" ></i></button>
        </div>
      </form>
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
<?php include 'footer.php'; ?>
</body>
</html>
<style>
   .fr-rew{
    padding: 5px;
    margin-right: 5px;
   }
   .gio-yt{
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
    text-align: center;
   }
   
</style>
