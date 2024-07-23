<?php 
include("inc.php"); 
include "logincheck.php";
$url = $serverurlapi."User1Entry/callAcknowDataTan.php?aid=".$_GET['aid'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$data = json_decode($result, true);
curl_close($ch);
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
/*$applicationdate = trim($data['recordlist']['applicationdate']);*/
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

if(isset($_POST['action'])=="saveaction"){
$tannumber = trim($_POST['tannumber']);
$catofdeductor = trim($_POST['catofdeductor']);
$subcatofdeductor = trim($_POST['subcatofdeductor']);
$titledeductor = trim($_POST['titledeductor']);
$catofdeductor = trim($_POST['catofdeductor']);
$subcatofdeductor = trim($_POST['subcatofdeductor']);
$titledeductor = trim($_POST['titledeductor']);
if($catofdeductor=='g'){
    $firmassocname = trim($_POST['firmassocname']);
    $officename = '';
    $deptname = '';
    $lastname = '';
    $middlename = '';
    $firstname = '';
    $orgname = '';
    $ministryname = '';
    $companyname = '';
    $divisionname = '';
    $namelocbranch = '';
    $desigpersonforpayment = '';
}
else if($catofdeductor=='a'){
    $officename = trim($_POST['officename']);
    $orgname = trim($_POST['orgname']);
    $deptname = trim($_POST['deptname']);
    $ministryname = trim($_POST['ministryname']);
    $desigpersonforpayment = trim($_POST['desigpersonforpayment']);
    $firmassocname='';
    $lastname = '';
    $middlename = '';
    $firstname = '';
    $companyname = '';
    $divisionname = '';
    $namelocbranch = '';
}

  else if($catofdeductor=='b'){
    $officename = trim($_POST['officename']);
    $orgname = trim($_POST['orgname']);
    $desigpersonforpayment = trim($_POST['desigpersonforpayment']);
    $firmassocname='';
    $deptname = '';
    $lastname = '';
    $middlename = '';
    $firstname = '';
    $ministryname = '';
    $companyname = '';
    $divisionname = '';
    $namelocbranch = '';
}

 else if($catofdeductor=='c'){
    $desigpersonforpayment = trim($_POST['desigpersonforpayment']);
    $companyname = trim($_POST['companyname']);
    $firmassocname='';
    $officename = '';
    $deptname = '';
    $lastname = '';
    $middlename = '';
    $firstname = '';
    $orgname = '';
    $ministryname = '';
    $divisionname = '';
    $namelocbranch = '';
}

else if(trim($_POST['catofdeductor'])=='d'){
    $companyname = trim($_POST['companyname']);
    $divisionname = trim($_POST['divisionname']);
    $namelocbranch = trim($_POST['namelocbranch']);
    $desigpersonforpayment = trim($_POST['desigpersonforpayment']);
    $firmassocname='';
    $officename = '';
    $deptname = '';
    $lastname = '';
    $middlename = '';
    $firstname = '';
    $orgname = '';
    $ministryname = '';
}

else if(trim($_POST['catofdeductor'])=='e'){
    $middlename = trim($_POST['middlename']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $firmassocname='';
    $officename = '';
    $deptname = '';
    $orgname = '';
    $ministryname = '';
    $companyname = '';
    $divisionname = '';
    $namelocbranch = '';
    $desigpersonforpayment = '';
}
else if(trim($_POST['catofdeductor'])=='f'){
    $namelocbranch = trim($_POST['namelocbranch']);
    $middlename = trim($_POST['middlename']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $firmassocname='';
    $officename = '';
    $deptname = '';
    $orgname = '';
    $ministryname = '';
    $companyname = '';
    $divisionname = '';
    $desigpersonforpayment = '';
}

else if(trim($_POST['catofdeductor'])=='h'){
    $namelocbranch = trim($_POST['namelocbranch']);
    $firmassocname = trim($_POST['firmassocname']);
    $officename = '';
    $deptname = '';
    $lastname = '';
    $middlename = '';
    $firstname = '';
    $orgname = '';
    $ministryname = '';
    $companyname = '';
    $divisionname = '';
    $desigpersonforpayment = '';
}

$addrflatorblockno = trim($_POST['addrflatorblockno']);
$addrbuildingorvillage = trim($_POST['addrbuildingorvillage']);
$addrpostoffice = trim($_POST['addrpostoffice']);
$addrareasubdivision = trim($_POST['addrareasubdivision']);
$addrtownorcountry = trim($_POST['addrtownorcountry']);
$addrstatecode = trim($_POST['addrstatecode']);
$addrpincode = trim($_POST['addrpincode']);
$STDCODE = trim($_POST['STDCODE']);
$TELEPHONE = trim($_POST['TELEPHONE']);
$NATIONALITY = trim($_POST['NATIONALITY']);
/*$applicationdate = trim($_POST['applicationdate']);*/
$panapplicant = trim($_POST['panapplicant']);
if($_POST['tancancelflag']!=""){
$tancancelflag = trim($_POST['tancancelflag']);
}
else{
  $tancancelflag = 'N';
}
$tancancel1 = trim($_POST['tancancel1']);
$tancancel2 = trim($_POST['tancancel2']);
$tancancel3 = trim($_POST['tancancel3']);
$tancancel4 = trim($_POST['tancancel4']);
if($_POST['ispancr']!=""){
$ispancr = trim($_POST['ispancr']);
}
else{
  $ispancr = 'N';
}
if($_POST['isnationflag']!=""){
$isnationflag = trim($_POST['isnationflag']);
}
else{
  $isnationflag = 'N';
}
if($_POST['addressflag']!=""){
$addressflag = trim($_POST['addressflag']);
}
else{
  $addressflag = 'N';
}
if($_POST['iscatdeductor']!=""){
$iscatdeductor = trim($_POST['iscatdeductor']);
}
else{
  $iscatdeductor = 'N';
}
if($_POST['isnamecr']!=""){
$isnamecr = trim($_POST['isnamecr']);
}
else{
  $isnamecr = 'N';
}

$email1 = trim($_POST['email1']);
$email2 = trim($_POST['email2']);
$acknwoledmentdate = trim($_POST['acknwoledmentdate']);
$verificationdate = trim($_POST['verificationdate']);
$acknowledmentnumber = trim($_POST['acknowledmentnumber']);
$verifiername = trim($_POST['verifiername']);
$verifiercapacitycode = trim($_POST['verifiercapacitycode']);
$verificationplace = trim($_POST['verificationplace']);
$rejectionid = trim($_POST['rejectionid']);
$rejectiondatetime = trim($_POST['rejectiondatetime']);

$Revised = trim($data['formtype']);


$formJson = '{ "tannumber": "'.$tannumber.'", "catofdeductor": "'.$catofdeductor.'", "subcatofdeductor": "'.$subcatofdeductor.'", "titledeductor": "'.$titledeductor.'", "lastname": "'.$lastname.'", "firstname": "'.$firstname.'", "middlename": "'.$middlename.'", "officename": "'.$officename.'", "orgname": "'.$orgname.'", "deptname": "'.$deptname.'", "ministryname": "'.$ministryname.'", "companyname": "'.$companyname.'", "divisionname": "'.$divisionname.'", "namelocbranch": "'.$namelocbranch.'", "desigpersonforpayment": "'.$desigpersonforpayment.'", "firmassocname": "'.$firmassocname.'", "addrflatorblockno": "'.$addrflatorblockno.'", "addrbuildingorvillage": "'.$addrbuildingorvillage.'", "addrpostoffice": "'.$addrpostoffice.'", "addrareasubdivision": "'.$addrareasubdivision.'", "addrtownorcountry": "'.$addrtownorcountry.'", "addrstatecode": "'.$addrstatecode.'", "addrpincode": "'.$addrpincode.'", "STDCODE": "'.$STDCODE.'", "TELEPHONE": "'.$TELEPHONE.'", "NATIONALITY": "'.$NATIONALITY.'", "panapplicant": "'.$panapplicant.'", "tancancelflag": "'.$tancancelflag.'", "tancancel1": "'.$tancancel1.'", "tancancel2": "'.$tancancel2.'", "tancancel3": "'.$tancancel3.'", "tancancel4": "'.$tancancel4.'", "ispancr": "'.$ispancr.'", "isnationflag": "'.$isnationflag.'", "addressflag": "'.$addressflag.'", "iscatdeductor": "'.$iscatdeductor.'", "isnamecr": "'.$isnamecr.'", "email1": "'.$email1.'", "email2": "'.$email2.'", "acknwoledmentdate": "'.$acknwoledmentdate.'", "verificationdate": "'.$verificationdate.'", "acknowledmentnumber": "'.$acknowledmentnumber.'", "verifiername": "'.$verifiername.'", "verifiercapacitycode": "'.$verifiercapacitycode.'", "verificationplace": "'.$verificationplace.'", "rejectionid": "'.$rejectionid.'", "rejectiondatetime": "'.$rejectiondatetime.'", "stage": "'.$stage.'"}';

$jsonPost = '{ "status": "0", "message": "Update Record", "formtype": "'.$Revised.'", "Role": "'.$_SESSION['ROLE'].'", "recordlist":'.$formJson.'}';

logger("JSON to post for CR TAN form ----".$jsonPost);
$urlPost = $serverurlapi."User1Entry/TanDataUpdateAPI.php";
$chp = curl_init();
curl_setopt($chp, CURLOPT_URL,$urlPost);
curl_setopt($chp, CURLOPT_POST,1);
curl_setopt($chp, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chp, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($chp, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($chp); 
curl_close($chp);
$res = json_decode($response,true);

logger("Response return from CR TAN form ----".$response);

$location = 'qc_pdftan.php?aid='.$acknowledmentnumber.'&formType='.strtoupper($Revised);

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
<script>
$(document).ready(function () {
$('#AOJSON').selectize({
sortField: 'text'
});
});
</script>
</head>
<body style="overflow: hidden;">
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="margin-left: 0!important;">
    <!-- Row -->
    <div class="row">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper">
          <div class="container-fluid">
            <form name="curl_form" id="dataentry1" method="post" action="" enctype="multipart/form-data" >
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <p class="para" for="first">Tan Number</p>
                        </div>
                      </div>
                      <div class="col-md-1"> </div>
                      <div class="col-md-8">
                        <input type="text" name="tannumber" class="form-control inputborder" placeholder="Tan Number" value="<?= $tannumber; ?>"  id="tannumber" onKeyDown="upperCaseF(this)" maxlength="10">
                      </div>
                    </div>
                    <div class="row drr">
                      <div class="col-md-3">
                        <div class="form-group">
                          <p class="para" for="first">Acknowledgement&nbsp;No&nbsp;*</p>
                        </div>
                      </div>
                      <div class="col-md-1"> </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control inputborder" name="acknowledmentnumber" value="<?php echo $acknowledmentnumber; ?>" id="acknowledmentnumber"  readonly>
                      </div>
                    </div>
                    <div class="row drr">
                      <div class="col-md-3">
                        <div class="form-group">
                          <p class="para" for="first">Category of Deductor</p>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <input class="jiy " type="checkbox" name="iscatdeductor" id="iscatdeductor" value="Y" <?php if($iscatdeductor=='Y'){ echo 'checked'; } ?> >
                      </div>
                      <div class="col-md-8">
                        <select name="catofdeductor" id="catofdeductor" class="form-control inputborder" onChange="funcCheckAddType();funcchangesubcat(this.value);" >
                          <option value="">Select</option>
                          <option value="a" <?= ($catofdeductor=='a')? 'selected="selected"':'';?>>Central/State Govt/Local Authority[a].</option>
                          <option value="b" <?= ($catofdeductor=='b')? 'selected="selected"':'';?>>Statutory/Autonomous Bodies[b]</option>
                          <option value="c" <?= ($catofdeductor=='c')? 'selected="selected"':'';?>>Company[c]</option>
                          <option value="d" <?= ($catofdeductor=='d')? 'selected="selected"':'';?>>Branch of a Company[d]</option>
                          <option value="e" <?= ($catofdeductor=='e')? 'selected="selected"':'';?>>Individual/Hindu Undivided Family(Karta)[e]</option>
                          <option value="f" <?= ($catofdeductor=='f')? 'selected="selected"':'';?>>Branch of Individual Business(Sole proprietorship concern)/Hindu Undivided Family(Karta)[f]</option>
                          <option value="g" <?= ($catofdeductor=='g')? 'selected="selected"':'';?>>Firm/Association of persons/ Association of persons(Trust)/ Body of Individuals/ Artificial Juridical Person[g].</option>
                          <option value="h" <?= ($catofdeductor=='h')? 'selected="selected"':'';?>>Branch of Firm/ Association of persons/ Association of persons (Trust) / Body of Individuals/ Artificial Juridical Person[h]. </option>
                        </select>
                        <label id="catofdeductorError" style="color: red; display: none;"></label>
                      </div>
                    </div>
                    <div class="row drr">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Sub Category of Deductor</p>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <select name="subcatofdeductor" id="subcid" class="form-control inputborder" onChange="functiontitle(this.value)">
                          <option value="">Select</option>
                        </select>
                        <label id="subcatofdeductorError" style="color: red; display: none;"></label>
                      </div>
                    </div>
                    <script>
  function funcchangesubcat(catid){
    $('#subcid').load('loadcrsubcat.php?action=loadsubcat&catid='+catid+'&selectid=<?php echo $subcatofdeductor; ?>');
  }
  funcchangesubcat('<?php echo $catofdeductor; ?>');
</script>
                    <div class="row drr inputborder1">
                      <div class="col-md-3">
                        <div class="form-group">
                          <p class="para" for="first">Title of Deductor</p>
                        </div>
                      </div>
                      <div class="col-md-1"> </div>
                      <div class="col-md-8">
                        <select name="titledeductor" id="titledeductor" class="form-control inputborder">
                          <option value="">Select</option>
                        </select>
                        <label id="titledeductorError" style="color: red; display: none;"></label>
                      </div>
                    </div>
                    <script>
    function functiontitle(subcatid){
        $('#titledeductor').load('loadtitle.php?action=loadtitle&subcatid='+subcatid+'&selectid=<?php echo $titledeductor; ?>');

    }
    functiontitle('<?php echo $subcatofdeductor; ?>');
    
</script>
                  </div>
                  <!--  col-md-6   -->
                </div>
              </div>
              <!--  row   -->
              <div class="dostas">
                <div style="display: flex;" class="arr"> <span class="numHead">1.</span>
                  <div class="">
                    <input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> >
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row"> </div>
                    <div class="row officenameshow">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first"><span class="numHead">1.</span>Name of Office.</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <input type="text" class="form-control" name="officename" value="<?php if($officename!=''){ echo trim($officename); } ?>"  id="office_name" onKeyDown="upperCaseF(this)" maxlength="75">
                          <label id="officenameError" style="display:none; color: red;"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row orgnameshow">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Name of Organisation.</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <input type="text" class="form-control" name="orgname" value="<?php if($orgname!=''){ echo trim($orgname); } ?>"  id="orgname" onKeyDown="upperCaseF(this)" maxlength="75">
                          <label id="orgnameError" style="display:none; color: red;"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row deptnameshow">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Name of Department.</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <input type="text" class="form-control" name="deptname" value="<?php if($deptname!=''){ echo trim($deptname); } ?>"  id="deptname" onKeyDown="upperCaseF(this)" maxlength="75">
                          <label id="deptnameError" style="display:none; color: red;"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row ministrynameshow">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Name of Ministry.</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <input type="text" class="form-control" name="ministryname" value="<?php if($ministryname!=''){ echo trim($ministryname); } ?>"  id="ministr_yname" onKeyDown="upperCaseF(this)" maxlength="75">
                          <label id="ministrynameError" style="display:none; color: red;"></label>
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
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row companynameshow">
                          <div class="col-md-4">
                            <div class="form-group">
                              <p class="para" for="first">Name of Company.</p>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" name="companyname" value="<?php if($companyname!=''){ echo trim($companyname); } ?>"  id="companyname" onKeyDown="upperCaseF(this)" maxlength="75">
                              <label id="companynameError" style="display:none; color: red;"></label>
                            </div>
                          </div>
                        </div>
                        <div class="row divisionnameshow">
                          <div class="col-md-4">
                            <div class="form-group">
                              <p class="para" for="first">Name of Division.</p>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" name="divisionname" value="<?php if($divisionname!=''){ echo trim($divisionname); } ?>"  id="divisionname" onKeyDown="upperCaseF(this)" maxlength="75">
                              <label id="divisionnameError" style="display:none; color: red;"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--   </div>
</div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row LastNameshow">
                          <div class="col-md-4">
                            <div class="form-group">
                              <p class="para" for="first">Last Name/Surname.</p>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" name="lastname" value="<?php if($lastname!=''){ echo trim($lastname); } ?>"  id="LastName" onKeyDown="upperCaseF(this)" maxlength="25">
                              <label id="LastNameError" style="display:none; color: red;"></label>
                            </div>
                          </div>
                        </div>
                        <div class="row FirstNameshow">
                          <div class="col-md-4">
                            <div class="form-group">
                              <p class="para" for="first">First Name.</p>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" name="firstname" value="<?php if($firstname!=''){ echo trim($firstname); } ?>"  id="FirstName" onKeyDown="upperCaseF(this)" maxlength="25">
                              <label id="FirstNameError" style="display:none; color: red;"></label>
                            </div>
                          </div>
                        </div>
                        <div class="row MiddleNameshow">
                          <div class="col-md-4">
                            <div class="form-group">
                              <p class="para" for="first">Middle Name.</p>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" name="middlename" value="<?php if($middlename!=''){ echo trim($middlename); } ?>" id="MiddleName"  onKeyDown="upperCaseF(this)" maxlength="25">
                              <label id="MiddleNameError" style="display:none; color: red;"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--   </div>
</div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row firmassocnameshow">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <p class="para" for="first">Firm Association Name</p>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input type="text" class="form-control" name="firmassocname" value="<?php if($firmassocname!=''){ echo trim($firmassocname); } ?>"  id="firmassocname" onKeyDown="upperCaseF(this)" maxlength="75">
                              <label id="firmassocnameError" style="display:none; color: red;"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--   </div>
</div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row namelocbranchshow">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <p class="para" for="first">Name/Location of branch:</p>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="form-group">
                          <input type="text" class="form-control" name="namelocbranch" value="<?php if($namelocbranch!=''){ echo trim($namelocbranch); } ?>"  id="namelocbranch" onKeyDown="upperCaseF(this)" maxlength="25">
                          <label id="namelocbranchError" style="display:none; color: red;"></label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row desigpersonforpaymentshow">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Designation of person responsible for * (making payment/collecting tax).</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control" name="desigpersonforpayment" value="<?php if($desigpersonforpayment!=''){ echo trim($desigpersonforpayment); } ?>"  id="desigpersonforpayment" onKeyDown="upperCaseF(this)" maxlength="50">
                      <label id="desigpersonforpaymentError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <!--Residence address div-->
              <div id="ResidenceAddress" style="display:block;">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <h4 class="para br-ffr review-title" for="first"><span class="numHead">2.</span>Residence Address</h4>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <input class="jiy " type="checkbox" name="addressflag" id="addressflag" value="Y" <?php if($addressflag=='Y'){ echo 'checked'; } ?> >
                  </div>
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
                      <input type="text" class="form-control" name="addrflatorblockno" value="<?php if($addrflatorblockno!=''){ echo trim($addrflatorblockno); } ?>"  id="addrflatorblockno" onKeyDown="upperCaseF(this)" maxlength="25">
                      <label id="addrflatorblocknoError" style="display:none; color: red;"></label>
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
                      <input type="text" class="form-control" name="addrbuildingorvillage"  value="<?php if($addrbuildingorvillage!=''){ echo trim($addrbuildingorvillage); } ?>"  id="addrbuildingorvillage" onKeyDown="upperCaseF(this)" maxlength="25">
                      <label id="addrbuildingorvillageError" style="display:none; color: red;"></label>
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
                      <input type="text" class="form-control" name="addrpostoffice" value="<?php if($addrpostoffice!=''){ echo trim($addrpostoffice); } ?>"  id="addrpostoffice" onKeyDown="upperCaseF(this)" maxlength="25">
                      <label id="addrpostofficeError" style="display:none; color: red;"></label>
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
                      <input type="text" class="form-control" name="addrareasubdivision" value="<?php if($addrareasubdivision!=''){ echo trim($addrareasubdivision); } ?>"  id="addrareasubdivision" onKeyDown="upperCaseF(this)" maxlength="25">
                      <label id="addrareasubdivisionError" style="display:none; color: red;"></label>
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
                      <input type="text" class="form-control" name="addrtownorcountry" id="addrtownorcountry"  value="<?php if($addrtownorcountry!=''){ echo trim($addrtownorcountry); } ?>"  onKeyDown="upperCaseF(this)" maxlength="25">
                      <label id="addrtownorcountryError" style="display:none; color: red;"></label>
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
                      <select class="form-control inputborder" name="addrstatecode" id="StateUnion" >
                        <option value="">Select</option>
                        <?php
$StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$StateJson = json_decode($StateJson,true);
foreach($StateJson['List'] as $StateData){
if($StateData['Code']!='99' && $StateData['Code']!='37'){
?>
                        <option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$addrstatecode){ echo 'selected'; }?> ><?php echo $StateData['Name']; ?></option>
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
                      <p class="para" for="first">PIN/Zip Code</p>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <input type="text" class="form-control" name="addrpincode"  value="<?php if($addrpincode!=''){ echo trim($addrpincode); } ?>" id="addrpincode" maxlength="6">
                      <label id="addrpincodeError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <!--  col-md-6   -->
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
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
                      <input type="text" name="STDCODE" id="StdCode" class="form-control inputborder " value="<?php  if($STDCODE!='' && $STDCODE!=0){ echo $STDCODE; } ?>" placeholder="Std Code"  onKeyDown="upperCaseF(this)" maxlength="7">
                      <label id="StdCodeError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <input type="text" name="TELEPHONE" id="MobileNumber" class="form-control inputborder " value="<?php  echo $TELEPHONE; ?>" placeholder="Enter Number" maxlength="13">
                      <label id="MobileNumberError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Email 1</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="email" name="email1" id="email1" class="form-control inputborder" value="<?php if($email1!=''){ echo $email1; } ?>"  onKeyDown="upperCaseF(this)" maxlength="50">
                      <label id="email1Error" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">Email 2</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="email" name="email2" id="email2" class="form-control inputborder" value="<?php if($email2!=''){ echo $email2; } ?>" onKeyDown="upperCaseF(this)" maxlength="50">
                      <label id="email2Error" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first"><span class="numHead">3.</span>National of Deductor(Tick the appropriate entry)</p>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <input class="jiy " type="checkbox" name="isnationflag" id="isnationflag" value="Y" <?php if($isnationflag=='Y'){ echo 'checked'; } ?> >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input class="jiy " type="radio" name="NATIONALITY" id="NATIONALITY" value="0" <?php if($NATIONALITY=='0'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
                      Indian: </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="jiy " type="radio" name="NATIONALITY" id="NATIONALITY" value="1" <?php if($NATIONALITY=='1'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');">
                      Foreign: </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <p class="para" for="first"><span class="numHead">4.</span>Permanent Account Number (PAN)</p>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <input class="jiy " type="checkbox" name="ispancr" id="ispancr" value="Y" <?php if($ispancr=='Y'){ echo 'checked'; } ?> >
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" name="panapplicant" id="panapplicant" class="form-control inputborder" value="<?php echo $panapplicant; ?>"  onKeyDown="upperCaseF(this)" maxlength="10">
                      <label id="panapplicantError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row drr">
                <div class="col-md-3">
                  <div class="form-group">
                    <p class="para" for="first"><span class="numHead">5.</span>TAN Cancel Data</p>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <input class="jiy " type="checkbox" name="tancancelflag" id="tancancelflag" value="Y" <?php if($tancancelflag=='Y'){ echo 'checked'; } ?> >
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">TAN1 Cancel</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" name="tancancel1" id="tancancel1" class="form-control" value="<?php if($tancancel1!=''){ echo $tancancel1; } ?>"  onKeyDown="upperCaseF(this)" maxlength="10">
                      <label id="tancancel1Error" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">TAN2 Cancel</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" name="tancancel2" id="tancancel2" class="form-control" value="<?php if($tancancel2!=''){ echo $tancancel2; } ?>"   onKeyDown="upperCaseF(this)" maxlength="10">
                      <label id="tancancel2Error" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">TAN3 Cancel</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" name="tancancel3" id="tancancel3" class="form-control" value="<?php if($tancancel3!=''){ echo $tancancel3; } ?>"  onKeyDown="upperCaseF(this)" maxlength="10">
                      <label id="tancancel3Error" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first">TAN4 Cancel</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="text" name="tancancel4" id="tancancel4" class="form-control" value="<?php if($tancancel4!=''){ echo $tancancel4; } ?>"  onKeyDown="upperCaseF(this)" maxlength="10">
                      <label id="tancancel4Error" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <p class="para" for="first"><span class="numHead">6.</span>Ack. Date(DD-MM-YY)</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <?php
//$date = substr($acknwoledmentdate,0,2).'-';
//$month = substr($acknwoledmentdate,2,2).'-';
//$year = substr($acknwoledmentdate,4,5);
//$acknwoledmentdate = $date.$month.$year;
?>
                      <input type="text" name="acknwoledmentdate" id="acknwoledmentdate" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr" value="<?php echo dateFormat($acknwoledmentdate); ?>"  <?php if($acknwoledmentdate!=''){ ?>style="pointer-events: none;"<?php } ?>>
                      <label id="EmailError" style="display:none; color: red;"></label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<p class="para" for="first">Application Date(DD-MM-YY)</p>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<?php
$date = substr($applicationdate,0,2).'-';
$month = substr($applicationdate,2,2).'-';
$year = substr($applicationdate,4,5);
$applicationdate = $date.$month.$year;
?>
<input type="text" name="applicationdate" id="applicationdate" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr  datepicker isdobupdateflagCls" value="<?php if($applicationdate!='--'){ echo date('d-m-Y',strtotime($applicationdate)); } ?>" style="width: 61%;" maxlength="10">
<label id="EmailError" style="display:none; color: red;"></label>
</div>
</div>
</div>
</div> -->
              <h4 class="para br-ffr review-title" for="first">Verification</h4>
              <div class="">
                <div class="col-md-12">
                  <div class="form-group ks-trek">
                    <p class="para rew" for="first">I/We</p>
                    <input type="text" class="form-control inputborder" name="verifiername" id="verifiername" value="<?php echo $verifiername; ?>"   required onKeyDown="upperCaseF(this)" maxlength="75">
                    <label id="VerifierNameError" style="color: red; display: none;"></label>
                    <p class="para rew" for="first">,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of</p>
                    <input type="text" class="form-control inputborder" name="verifiercapacitycode" id="verifiercapacitycode" value="<?php echo $verifiercapacitycode; ?>"   onKeyDown="upperCaseF(this)" maxlength="75">
                    <label id="CVerifierError" style="color: red; display: none;"></label>
                    <p class="para rew" for="first">do&nbsp;hereby</p>
                  </div>
                  <div>
                    <p class="para rew" for="first">declare that what is stated above is true to the best of my/ourinformation and belief</p>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <p class="para" for="first">Place</p>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control " placeholder="" name="verificationplace" id="verificationplace" value="<?php echo $verificationplace; ?>"  onKeyDown="upperCaseF(this)" maxlength="75">
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
                      <p class="para" for="first">
                        <input type="text" name="verificationdate" id="verificationdate" value="<?php echo dateFormat($verificationdate); ?>" class="form-control datepicker inputborder datepicker" maxlength="10" >
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="action" value="saveaction">
              <input type="hidden" name="acknowledmentnumber" value="<?php echo $acknowledmentnumber; ?>">
              <button type="submit" id="formsubmit" class="next" style=" display:none;"> Save and move to next section <i class="fa fa-angle-right" ></i></button>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
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
<script>
$(document).ready(function(){
	$('input').focus(function(){
		$(this).attr('autocomplete', 'nope');
	});
});
</script>
<?php include 'footer.php'; ?>
<script src="js/tan_crvalidation.js"></script>
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
