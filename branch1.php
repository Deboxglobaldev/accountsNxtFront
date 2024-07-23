<?php
// get url
include 'inc.php';
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");

if(isset($_GET['editId'])!=''){
logger($InfoMessage."Call for Retrival ");

$url = "".$serverurlapi."General/branchinfoList.php?editId=".decode($_GET['editId'])."";

logger($InfoMessage." Retrival API Call ..".$url );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$branchData = json_decode($result, true);
logger($InfoMessage." JSON Retsult for Data Retrival ..".$result );
curl_close($ch);
}

?>
<?php
//insert branch information
if(isset($_POST['addbranchinfo'])){
logger($InfoMessage." Data Save .." );

$formData = array(
'editId' => trim($_POST['editId']),
'Name' => trim($_POST['name']),
'AddressOne' => trim($_POST['AddressOne']),
'AddressTwo' => trim($_POST['AddressTwo']),
'City' => trim($_POST['City']),
'PinCode' => trim($_POST['PinCode']),
'State' => trim($_POST['State']),
'PrimaryPhone' => trim($_POST['PrimaryPhone']),
'SecondaryPhone' => trim($_POST['SecondaryPhone']),
'PrimaryEmail' => trim($_POST['PrimaryEmail']),
'SecondaryEmail' => trim($_POST['SecondaryEmail']),
'ContactPerson' => trim($_POST['ContactPerson']),
'ActivationDate' => trim($_POST['ActivationDate']),
'ClosureDate' => trim($_POST['ClosureDate']),
'CenterType' => trim($_POST['CenterType']),
'AgentNumber' => trim($_POST['AgentNumber']),
'Region' => trim($_POST['Region']),
'PanNumber' => trim($_POST['PanNumber']),
'TanNumber' => trim($_POST['TanNumber']),
'GstNumber' => trim($_POST['GstNumber']),
'BranchCode' => trim($_POST['BranchCode']),
'FinancialCode' => trim($_POST['FinancialCode']),
'BankName' => trim($_POST['BankName']),
'AccountNumber' => trim($_POST['AccountNumber']),
'IfscCode' => trim($_POST['IfscCode']),
'BranchName' => trim($_POST['BranchName']),
'BankName2' => trim($_POST['BankName2']),
'AccountNumber2' => trim($_POST['AccountNumber2']),
'IfscCode2' => trim($_POST['IfscCode2']),
'BranchName2' => trim($_POST['BranchName2']),
'Status' => trim($_POST['Status']),
'itemdata' => trim($_POST['itemdata']),
'FranchCode' => trim($_POST['FranchCode']),
'TrainingDate' => trim($_POST['TrainingDate']),
'TrainnerName' => trim($_POST['TrainnerName']),
'SelfDig_Flag' => trim($_POST['SelfDig_Flag']),
'SelfDig_Flag_TAN' => trim($_POST['SelfDig_Flag_TAN']),
'Acceptance' => trim($_POST['Acceptance']),
'Digitization' => trim($_POST['Digitization']),
'Incentive' => trim($_POST['Incentive']),
'schemeName' => trim($_POST['schemeName'])
);
$insertData = http_build_query($formData);
logger($InfoMessage." Saving Data as  .. ".$insertData );
//use curl method
$ch = curl_init();
$url = "".$serverurlapi."General/addbranchbasicInfo.php";
logger($InfoMessage." Saving Data URL  .. ".$url );
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultData = curl_exec($ch);
logger($InfoMessage." Saving Data API Call Result  .. ".$resultData );
//print_r($resultData);die();
curl_close($ch);
$_SESSION['error']=$resultData;
}
//die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Branch</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<style>
label {
color: red;
}

.mandat {
color: red;
}
</style>
</head>

<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
<!-- Top Navbar -->
<?php include 'header.php'; ?>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<form action="" method="post" id="branchform" />
<div class="hk-pg-wrapper" style="">
<?php if(isset($_SESSION['error'])!=''){ ?>
<div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
<!-- Success Alert -->
<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
    <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
</div>
<?php } ?>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Name<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <input type="text" name="name" id="name" class="inp-t"
                value="<?php echo trim($branchData['Name']); ?>" maxlength="100">
            <p id="namecheck"></p>
        </div>
    </div>
</div>
<hr class="dot-row">
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Address Line <span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <input type="text" name="AddressOne" id="AddressOne" class="inp-t"
                value="<?php echo trim($branchData['AddressOne']); ?>" maxlength="250">
            <p id="addressOnecheck"></p>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Address Line 2</h5>
        </div>
        <div class="col-md-9">
            <input type="text" name="AddressTwo" class="inp-t"
                value="<?php echo trim($branchData['AddressTwo']); ?>" maxlength="250">
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>City<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="City" id="City" class="inp-t"
                        value="<?php echo trim($branchData['City']); ?>" maxlength="50">
                    <p id="citycheck"></p>
                </div>
                <div class="col-md-4">
                    <div class="flx">
                        <h5>Pin&nbsp;Code<span class="mandat">*</span></h5>
                        <input type="text" name="PinCode" id="PinCode" class="inp-t"
                            value="<?php echo trim($branchData['PinCode']); ?>" maxlength="6">
                        <p id="pincheck"></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="flx">
                        <h5>State<span class="mandat">*</span></h5>
                        <select class="inp-w ui-select wd-tr" name="State" id="State">
                            <option value="">Select</option>
                            <?php
//get state
$url = $serverurlapi."General/getstate.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$stateresult = curl_exec($ch);
$stateData = json_decode($stateresult, true);
curl_close($ch);
if(isset($stateData['List'])){
foreach($stateData['List'] as $stateList){
if($stateList['Code']!='99'){
?>
                            <option value="<?php echo trim($stateList['Code']); ?>"
                                <?php if($branchData['State']==trim($stateList['Code'])){?>selected="selected"
                                <?php } ?>><?php echo $stateList['Name']; ?></option>
                            <?php
}
}
}
?>
                        </select>
                        <p id="statecheck"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Primary&nbsp;Phone<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="number" name="PrimaryPhone" id="PrimaryPhone" class="inp-t"
                        value="<?php echo trim($branchData['PrimaryPhone']); ?>" maxlength="10">
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Secondary&nbsp;Phone</h5>
                        <input type="number" name="SecondaryPhone" id="SecondaryPhone" class="inp-t"
                            value="<?php echo trim($branchData['SecondaryPhone']); ?>" maxlength="10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Primary&nbsp;E-mail<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="email" name="PrimaryEmail" id="PrimaryEmail" class="inp-t"
                        value="<?php echo trim($branchData['PrimaryEmail']); ?>" maxlength="50">
                    <p id="primaryemailcheck"></p>
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Secondary&nbsp;E-&nbsp;mail</h5>
                        <input type="email" name="SecondaryEmail" id="SecondaryEmail" class="inp-t"
                            value="<?php echo trim($branchData['SecondaryEmail']); ?>" maxlength="50">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Contact Person<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="ContactPerson" id="ContactPerson" class="inp-t"
                        value="<?php echo trim($branchData['ContactPerson']); ?>" maxlength="75">
                    <p id="contactpersoncheck"></p>
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Scheme&nbsp;Id<span class="mandat">*</span></h5>
                        <?php
//get commission master
$url = $serverurlapi."General/schemeMasterAPI.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$commission = curl_exec($ch);
$commissionSlab = json_decode($commission, true);
curl_close($ch);
?>
                        <select class="inp-w ui-select wd-tr" name="schemeName" id="schemeName"
                            required>
                            <option value="">Select</option>
                            <?php
if(isset($commissionSlab['SchemeData']))
{
foreach($commissionSlab['SchemeData'] as $result)
{
if($result['status']==0){
?>
                            <option value="<?php echo $result['Id']?>"
                                <?php if($branchData['SchemeId']==$result['Id']){?>selected="selected"
                                <?php } ?>><?php echo $result['SchemeName']; ?></option>
                            <?php
}
}
}
?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Activation&nbsp;Date<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="date" name="ActivationDate" id="ActivationDate"
                        class="inp-t newdate "
                        value="<?php if($branchData['ActivationDate']!="1970-01-01"){ echo $branchData['ActivationDate']; } ?>"
                        maxlength="10">
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Closure&nbsp;Date</h5>
                        <input type="date" name="ClosureDate" id="ClosureDate"
                            class="inp-t newdate "
                            value="<?php if($branchData['ClosureDate']!="1970-01-01"){ echo trim($branchData['ClosureDate']); } ?>"
                            maxlength="10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Franchisee&nbsp;Code<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="FranchCode" id="FranchCode" class="inp-t newdate"
                        value="<?php echo trim($branchData['FranchiseCode']); ?>" maxlength="10">
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Training&nbsp;Date</h5>
                        <input type="date" name="TrainingDate" id="TrainingDate"
                            class="inp-t newdate "
                            value="<?php if($branchData['TrainingDate']!="1970-01-01"){ echo trim($branchData['TrainingDate']); } ?>"
                             maxlength="10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Trainner&nbsp;Name</h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="TrainnerName" id="TrainnerName" class="inp-t newdate"
                        value="<?php echo $branchData['TrainnerName']; ?>" maxlength="75">
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Self&nbsp;Digi.&nbsp;Flag PAN<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <select class="inp-w ui-select wd-tr" name="SelfDig_Flag" id="SelfDig_Flag"
                        required>
                        <option value="0"
                            <?php if($branchData['SelfDig_Flag']=="0"){ echo 'selected'; } ?>>Yes
                        </option>
                        <option value="1"
                            <?php if($branchData['SelfDig_Flag']=="1"){ echo 'selected'; } ?>>No
                        </option>
                    </select>
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Self&nbsp;Digi.&nbsp;Flag TAN<span class="mandat">*</span></h5>
                        <select class="inp-w ui-select wd-tr" name="SelfDig_Flag_TAN"
                            id="SelfDig_Flag_TAN" required>
                            <option value="0"
                                <?php if($branchData['SelfDig_FlagTan']=="0"){ echo 'selected'; } ?>>Yes
                            </option>
                            <option value="1"
                                <?php if($branchData['SelfDig_FlagTan']=="1"){ echo 'selected'; } ?>>No
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="dot-row">
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Centre Type<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <?php
//get center type
$url = "".$serverurlapi."General/getcentertype.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$centerresult = curl_exec($ch);
$centertype = json_decode($centerresult, true);
curl_close($ch);
?>
                    <select class="inp-w ui-select wd-tr" name="CenterType" required>
                        <option value="">Select</option>
                        <?php
if(isset($centertype['List']))
{
foreach($centertype['List'] as $centerType)
{ ?>
                        <option value="<?php echo $centerType['Code']; ?>"
                            <?php if($branchData['CenterType']==$centerType['Code']){?>selected="selected"
                            <?php } ?>><?php echo $centerType['Name']; ?></option>
                        <?php }
}
?>
                    </select>
                </div>
                <div class="col-md-5">
                    <div class="flx">
                        <h5>NSDL&nbsp;Agent&nbsp;Number<span class="mandat">*</span></h5>
                        <input type="text" name="AgentNumber" id="AgentNumber" class="inp-t"
                            value="<?php echo $branchData['AgentNumber']; ?>" maxlength="2">
                        <p id="agentnumbercheck"></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="flx">
                        <h5>Region<span class="mandat">*</span></h5>
                        <?php
  //get region master
$url = "".$serverurlapi."General/getregion.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$regionresult = curl_exec($ch);
$regionType = json_decode($regionresult, true);
curl_close($ch);
?>
                        <select class="inp-w ui-select wd-tr" name="Region" id="Region" required>
                            <option value="">Select</option>
                            <?php
if(isset($regionType['List']))
{
foreach($regionType['List'] as $region)

{
if($region['Status']==1){
?>
                            <option value="<?php echo str_replace('R','',$region['Code']); ?>"
                                <?php if($branchData['Region']==str_replace('R','',$region['Code'])){?>selected="selected"
                                <?php } ?>><?php echo $region['Name']; ?></option>
                            <?php
}
}
}
?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="dot-row">
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>PAN Number<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="PanNumber" id="PanNumber" class="inp-t"
                        value="<?php echo $branchData['PanNumber']; ?>" maxlength="10">
                    <p id="pannumbercheck"></p>
                </div>
                <div class="col-md-5">
                    <div class="flx">
                        <h5>TAN&nbsp;Number</h5>
                        <input type="text" name="TanNumber" id="TanNumber" class="inp-t"
                            value="<?php echo $branchData['TanNumber']; ?>" maxlength="10">
                        <p id="tannumbercheck"></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="flx">
                        <h5>GST&nbsp;Number</h5>
                        <input type="text" name="GstNumber" id="GstNumber" class="inp-t"
                            value="<?php echo $branchData['GstNumber']; ?>" maxlength="15">
                        <p id="gstcheck"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Branch&nbsp;Code<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="number" name="BranchCode" id="BranchCode" class="inp-t"
                        value="<?php echo $branchData['BranchCode']; ?>" required maxlength="7">
                    <p id="branchcodecheck"></p>
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Financial&nbsp;Code<span class="mandat">*</span></h5>
                        <input type="text" name="FinancialCode" id="FinancialCode" class="inp-t"
                            value="<?php echo $branchData['FinancialCode']; ?>" maxlength="26">
                        <p id="financialcodecheck"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="dot-row">
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Bank&nbsp;Name<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="BankName" id="BankName" class="inp-t"
                        value="<?php echo $branchData['BankName']; ?>" maxlength="40">
                    <p id="banknamecheck"></p>
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Account&nbsp;Number<span class="mandat">*</span></h5>
                        <input type="number" name="AccountNumber" id="AccountNumber" class="inp-t"
                            value="<?php echo $branchData['AccountNumber']; ?>" maxlength="50">
                        <p id="accountnumbercheck"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>IFSC&nbsp;Code<span class="mandat">*</span></h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="IfscCode" id="IfscCode" class="inp-t"
                        value="<?php echo $branchData['IfscCode']; ?>" maxlength="25">
                    <p id="ifsccodecheck"></p>
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Branch&nbsp;Name<span class="mandat">*</span></h5>
                        <input type="text" name="BranchName" id="BranchName" class="inp-t"
                            value="<?php echo $branchData['BranchName']; ?>" maxlength="25">
                        <p id="branchnamecheck"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="dot-row">
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>Bank&nbsp;Name</h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="BankName2" id="BankName2" class="inp-t"
                        value="<?php echo $branchData['BankName2']; ?>" maxlength="40">
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Account&nbsp;Number</h5>
                        <input type="number" name="AccountNumber2" id="AccountNumber2" class="inp-t"
                            value="<?php echo $branchData['AccountNumber2']; ?>" maxlength="50">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="">
<div class="container-fluid full-bd">
    <div class="row">
        <div class="col-md-3">
            <h5>IFSC&nbsp;Code</h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="IfscCode2" id="IfscCode2" class="inp-t"
                        value="<?php echo $branchData['IfscCode2']; ?>" maxlength="25">
                </div>
                <div class="col-md-7">
                    <div class="flx">
                        <h5>Branch&nbsp;Name</h5>
                        <input type="text" name="BranchName2" id="BranchName2" class="inp-t"
                            value="<?php echo $branchData['BranchName2']; ?>" maxlength="25">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="dot-row">
<section class="">
    <div class="container-fluid full-bd">
        <div class="row">
            <div class="col-md-3">
                <h5>Item</h5>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <?php
//get items
$url = "".$serverurlapi."General/getitemList.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$itemresult = curl_exec($ch);
$itemsList = json_decode($itemresult, true);
curl_close($ch);
?>
                        <select class="inp-w ui-select wd-tr" name="item" id="item">
                            <option value="">Select</option>
                            <?php
if(isset($itemsList['List'])){
?>
                            <option value="<?php echo $itemsList['List']['Name']; ?>">
                                <?php echo $itemsList['List']['Name']; ?></option>
                            <?php
}
?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <div class="flx">
                            <h5>Description</h5>
                            <input type="text" name="description" id="description" class="inp-t">
                            <input type="hidden" name="itemId" id="itemId" value="0" />
                            <input type="hidden" name="rIndexId" id="rIndexId" value="" />
                            <button type="button" class="btn btn-default addbutton"
                                onClick="addTableRow();">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr class="vcx-i gav">
                    <th>Item</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="itemlist" align="center" valign="top">
                <?php
if($branchData['JsonItem']!=''){
$itemJson = json_decode($branchData['JsonItem']);
foreach($itemJson as $itemJsonData){
if($itemJsonData->item!='' && $itemJsonData->description!=''){
?>
                <tr>
                    <th><?php echo $itemJsonData->item; ?></th>
                    <th><?php echo $itemJsonData->description; ?></th>
                    <th><input id="Button" type="button" value="Edit" class="btn btn-default addbutton"
                            onClick="selectedRowInput();" /></th>
                </tr>
                <?php
}
}
}
?>
            </tbody>
        </table>
    </div>
    <hr class="dot-row">
</section>
<section class="">
    <div class="container-fluid full-bd">
        <div class="row">
            <div class="col-md-3">
                <h5>Status<span class="mandat">*</span></h5>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-5">
                        <div class="flx">
                            <select class="inp-w ui-select wd-tr" name="Status" id="Status" required>
                                <option value="1"
                                    <?php if($branchData['Status']=='1'){ echo "selected"; } ?>>Active
                                </option>
                                <option value="0"
                                    <?php if($branchData['Status']=='0'){ echo "selected"; } ?>>
                                    In-active</option>
                            </select>
                            <!--<h5>Active</h5>-->
                        </div>
                    </div>
                    <div class="col-md-7" style="display:none;">
                        <div class="flx">
                            <h5>System&nbsp;Status</h5>
                            <select class="inp-w ui-select wd-tr">
                                <option>Select</option>
                                <option>4</option>
                                <option>5</option>
                                <option>8</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="nxrt full-bd" style="width: fit-content;">
        <input type="hidden" name="editId" value="<?php echo $branchData['Id']; ?>" />
        <input type="hidden" name="itemdata" id="itemdata"
            value="<?php echo htmlentities($branchData['JsonItem']); ?>" style="width: 100%;" />
        <input type="submit" class="next" value="Cancle">
        <input type="submit" name="addbranchinfo" id="btnsubmit" class="next" value="Save">
        <input type="submit" class="next" value="Exit">
    </div>
</section>
</div>
</form>
</div>
</div>
<?php include 'footer.php'; ?>
</body>

</html>
<style>
.jh-mn {
margin-top: auto;
margin-bottom: auto;
}

.gav th {
text-align: center;
}

.hav td {
text-align: center;
}

.vcx-i {
border-top: 2px solid;
border-bottom: 2px solid;
}

.addbutton {
width: 37%;
padding: 0%;
font-weight: bold;
background: #6fb71b
}

.full-bd {
padding: 2%;

}

.inp-t {
width: 100%;
}

.dot-row {
border-top: 1px dotted black;
}

.flx {
display: flex;
column-gap: 12px;
}

.ui-select {
padding: 2%;
}

.wd-tr {
width: 100%;
}
</style>
<script>
/*$("#ClosureDate").datepicker({
dateFormat: 'dd-mm-yy',
onClose: function() {
this.focus();
}
});*/


$(function() {
//var today = new Date();
//var tomorrow = new Date();
$(".datepicker").datepicker({
dateFormat: 'dd-mm-yy',
maxDate: 0,
onClose: function() {
this.focus();
}
});
});

var rIndex, table = document.getElementById("itemlist");

function addTableRow() {
var itemId = document.getElementById("itemId").value;
if (itemId == 0) {
var newRow = table.insertRow(table.length),
cell1 = newRow.insertCell(0),
cell2 = newRow.insertCell(1),
cell3 = newRow.insertCell(2),
Item = document.getElementById("item").value,
Description = document.getElementById("description").value;
cell1.innerHTML = Item;
cell2.innerHTML = Description;
cell3.innerHTML =
'<input id="Button" type="button" value="Edit" class="btn btn-default addbutton" onclick="selectedRowInput();" />';
//fetch table cells data into array object
var TableData = new Array();
$('#itemlist tr').each(function(row, tr) {
TableData[row] = {
"item": $(tr).find('td:eq(0)').text(),
"description": $(tr).find('td:eq(1)').text()
}
});
$('#item').val('');
$('#description').val('');
//return TableData;
//var list = TableData.shift();
//convert array to json
var arraydata = JSON.stringify(Object.assign({}, TableData))
//console.log(arraydata);
$('#itemdata').val(arraydata);
//END convert array to json
} else {
var Item = document.getElementById("item").value,
Description = document.getElementById("description").value;
rIndexId = document.getElementById("rIndexId").value;
indexitem = rIndexId - 1;
table.rows[indexitem].cells[0].innerHTML = Item;
table.rows[indexitem].cells[1].innerHTML = Description;
//change value to add


$('#itemId').val(0);

}

}

function selectedRowInput() {
//var rIndex,table = document.getElementById("itemlist");
for (var i = 0; i < table.rows.length; i++) {
table.rows[i].onclick = function() {
rIndex = this.rowIndex;
document.getElementById("item").value = this.cells[0].innerHTML;
document.getElementById("description").value = this.cells[1].innerHTML;
//for update
document.getElementById("rIndexId").value = rIndex;
};
}
//change value to edit button
$('#itemId').val(1);
}
</script>
<script src="js/jquery.validate.min.js"></script>
<script>
///////Not start with zero//////////////
jQuery.validator.addMethod("numberNotStartWithZero", function(value, element) {
return this.optional(element) || /^[1-9][0-9]+$/i.test(value);
}, "Please enter a valid number. (Do not start with zero)");
////////////////////////////////////////

////// date equal to given date/////////
jQuery.validator.addMethod("greaterThan",
function(value, element, params) {
if (!/Invalid|NaN/.test(new Date(value))) {
return new Date(value) <= new Date($(params).val());
}

return isNaN(value) && isNaN($(params).val()) ||
(Number(value) >= Number($(params).val()));
}, 'Date must less then or equal to receipt date');
////////////////////////////////////////


$(document).ready(function() {
$("#branchform").validate({
onfocusout: function(element) {
this.element(element);
},
rules: {
name: "required",
AddressOne: "required",
City: "required",
PinCode: {
required: true,
minlength: 6,
maxlength: 6,
numberNotStartWithZero: true
},
State: "required",
PrimaryPhone: {
required: true,
digits: true,
numberNotStartWithZero: true,
minlength:10,
maxlength:10
},
SecondaryPhone: {
digits: true,
numberNotStartWithZero: true,
minlength:10,
maxlength:10
},
PrimaryEmail: {
required: true,
email: true
},
SecondaryEmail: {
email: true
},
ContactPerson: "required",
AgentNumber: {
required: true,
minlength: 2,
maxlength: 2
},
Region: "required",
PanNumber: {
required: true,
minlength: 10,
maxlength: 10
},
TanNumber: {
minlength: 10,
maxlength: 10
},
BranchCode: {
required: true,
digits: true
},
FinancialCode: "required",
BankName: "required",
AccountNumber: "required",
IfscCode: "required",
BranchName: "required",
BankName: "required",
Status: "required",
ActivationDate: {
required: true
},
FranchCode: {
required: true
},
TrainingDate: {
//greaterThan: "#ActivationDate"
},
ClosureDate: {
//greaterThan: "#ActivationDate"
}
},
messages: {
TrainingDate: {
//greaterThan: "Should be greater than or equal to Date of Activation"
},
ClosureDate: {
//greaterThan: "Should be greater than or equal to Date of Activation"
}
},
submitHandler: function(form) {
form.submit();
}
});
});
</script>