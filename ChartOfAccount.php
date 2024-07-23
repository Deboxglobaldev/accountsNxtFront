<?php
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

$url = $serverurlapi."masters/accountGroupAPI.php";

$jsonData1 = '{
    "accountGroup":"1"
}';
$jsonData2 = '{
    "accountGroup":"2"
}';
$jsonData3 = '{
    "accountGroup":"3"
}';
$jsonData4 = '{
    "accountGroup":"4"
}';
$jsonData5 = '{
    "accountGroup":"5"
}';

$resultData1 = postCurlData($url,$jsonData1);
$resultData2 = postCurlData($url,$jsonData2);
$resultData3 = postCurlData($url,$jsonData3);
$resultData4 = postCurlData($url,$jsonData4);
$resultData5 = postCurlData($url,$jsonData5);

$accountData1 = json_decode($resultData1);
$accountData2 = json_decode($resultData2);
$accountData3 = json_decode($resultData3);
$accountData4 = json_decode($resultData4);
$accountData5 = json_decode($resultData5);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>List Account Group</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
    $('#datatable1').DataTable();
    $('#datatable2').DataTable();
    $('#datatable3').DataTable();
    $('#datatable4').DataTable();
} );
</script>
<!-- Favicon -->
</head>
<style>
  .hgte{
   background:#dcdcdc59;
  }
  .nav-pills{
    margin-top: 40px;
    margin-left: 40px;
  }
  .nav-pills li{
   background: #2f9e41;
    padding: 6px 40px;
    border: 1px solid #665f5f;
  }
  .nav-pills li a{
    color: white;
  }
  .tab-pane{
margin: 0 40px;
  }

table tbody tr td{
font-size: 14px!important;
border: 1px solid black!important;
border-bottom: none!important;
padding-left: 10px!important;
}
table thead th{
      color: #14992a!important;
  font-size:14px!important;
border: 1px solid black!important;
}

table tbody tr:last-child td{
 border-bottom: 1px solid black!important;;
}
table tbody tr:first-child td{
 border-top: none!important;;
}

table{
  margin-top: 15px;
}
i{
  background: #2f9e41;
    color: white;
    padding: 2px 3px;
    margin-right: 10px;
    cursor: pointer;
}
.btn-button{
 float: right;
    padding: 4px 11px;
    background: #2f9e41;
    color: white;
    border-radius: 3px;
}


</style>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  	<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  	<div class="hk-pg-wrapper"  style="">
  		<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Assets</a></li>
    <li><a data-toggle="pill" href="#menu1">Liability</a></li>
    <li><a data-toggle="pill" href="#menu2">Equity</a></li>
    <li><a data-toggle="pill" href="#menu3">Income</a></li>
    <li><a data-toggle="pill" href="#menu4">Expense</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <table id="datatable" class="table" style="width:100%">
          <thead>
            <tr class="hgt">
        <th colspan="3">Ledger Name <a href="addAccountGroup.php" class="btn-button">Add</a> </th>
      </tr>
          </thead>
          <tbody id="tablesearch">
     <?php
    if(isset($accountData1->status)=='true'){
    if(isset($accountData1->AccountGroupData)){
    $no=1;
    foreach($accountData1->AccountGroupData as $resultList){
      ?>
    <tr class="uyt hgte">
      <td><i onclick="showgroup(<?php echo $resultList->Id; ?>);" class="fa fa-plus sgroup<?php echo $resultList->Id; ?>"></i>
        <i style="display: none;" onclick="hidegroup(<?php echo $resultList->Id; ?>);" class="fa fa-minus hgroup<?php echo $resultList->Id; ?>"></i>
        <a href="addAccountSubGroup.php"><?php echo $resultList->Name; ?></a></td>
    </tr>
    <?php
    $subGroupId = $resultList->Id;

$jsonData = '{
    "accountGroup":"'.$subGroupId.'"
}';

$url = $serverurlapi."General/accountSubGroupAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountSubGroupData)){
    foreach($accountData->AccountSubGroupData as $resultLists){
      ?>
    <tr style="background: aliceblue;display: none;" class="subgroup<?php echo $resultList->Id; ?>">
      <td style="padding-left: 65px!important;"><i onclick="showaccount('<?php echo $resultLists->Id; ?>');" class="fa fa-plus"></i>
        <a href="addAccountName.php"><?php echo $resultLists->Name; ?></a></td>
    </tr>
    <?php
    $Id = $resultLists->Id;
$jsonData = '{
    "GroupId":"'.$Id.'"
}';

$url = $serverurlapi."General/accountNameAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountNameData)){
    foreach($accountData->AccountNameData as $accountList){
      ?>
    <tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?> mgroup<?php echo $resultList->Id ?>">
      <td style="padding-left: 115px!important;"><?php echo $accountList->AccountName; ?></td>
    </tr>

    <?php } } } ?>
  <?php } } } } } }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu1" class="tab-pane fade">
      <table id="datatable1" class="table" style="width:100%">
          <thead>
            <tr class="hgt">
        <th colspan="3">Ledger Name<a href="addAccountGroup.php" class="btn-button">Add</a> </th>
      </tr>
          </thead>
          <tbody id="tablesearch">
     <?php
    if(isset($accountData2->status)=='true'){
    if(isset($accountData2->AccountGroupData)){
    $no=1;
    foreach($accountData2->AccountGroupData as $resultList){
      ?>
    <tr class="uyt hgte">
      <td><i onclick="showgroup(<?php echo $resultList->Id; ?>);" class="fa fa-plus"></i>
        <a href="addAccountSubGroup.php"><?php echo $resultList->Name; ?></a></td>
    </tr>
    <?php
    $subGroupId = $resultList->Id;

$jsonData = '{
    "accountGroup":"'.$subGroupId.'"
}';

$url = $serverurlapi."General/accountSubGroupAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountSubGroupData)){
    foreach($accountData->AccountSubGroupData as $resultLists){
      ?>
    <tr style="background: aliceblue;display: none;" class="subgroup<?php echo $resultList->Id; ?>">
      <td style="padding-left: 65px!important;"><i onclick="showaccount('<?php echo $resultLists->Id; ?>');" class="fa fa-plus"></i>
        <a href="addAccountName.php"><?php echo $resultLists->Name; ?></a></td>
    </tr>
    <?php
    $Id = $resultLists->Id;
$jsonData = '{
    "GroupId":"'.$Id.'"
}';

$url = $serverurlapi."General/accountNameAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountNameData)){
    foreach($accountData->AccountNameData as $accountList){
      ?>
    <tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?>">
      <td style="padding-left: 115px!important;"><?php echo $accountList->AccountName; ?></td>
    </tr>

    <?php } } } ?>
  <?php } } } } } }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu2" class="tab-pane fade">
     <table id="datatable2" class="table" style="width:100%">
          <thead>
            <tr class="hgt">
        <th colspan="3">Ledger Name<a href="addAccountGroup.php" class="btn-button">Add</a> </th>
      </tr>
          </thead>
          <tbody id="tablesearch">
     <?php
    if(isset($accountData3->status)=='true'){
    if(isset($accountData3->AccountGroupData)){
    $no=1;
    foreach($accountData3->AccountGroupData as $resultList){
      ?>
    <tr class="uyt hgte">
      <td><i onclick="showgroup(<?php echo $resultList->Id; ?>);" class="fa fa-plus"></i>
        <a href="addAccountSubGroup.php"><?php echo $resultList->Name; ?></a></td>
    </tr>
    <?php
    $subGroupId = $resultList->Id;

$jsonData = '{
    "accountGroup":"'.$subGroupId.'"
}';

$url = $serverurlapi."General/accountSubGroupAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountSubGroupData)){
    foreach($accountData->AccountSubGroupData as $resultLists){
      ?>
    <tr style="background: aliceblue;display: none;" class="subgroup<?php echo $resultList->Id; ?>">
      <td style="padding-left: 65px!important;"><i onclick="showaccount('<?php echo $resultLists->Id; ?>');" class="fa fa-plus"></i>
        <a href="addAccountName.php"><?php echo $resultLists->Name; ?></a></td>
    </tr>
    <?php
    $Id = $resultLists->Id;
$jsonData = '{
    "GroupId":"'.$Id.'"
}';

$url = $serverurlapi."General/accountNameAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountNameData)){
    foreach($accountData->AccountNameData as $accountList){
      ?>
    <tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?>">
      <td style="padding-left: 115px!important;"><?php echo $accountList->AccountName; ?></td>
    </tr>

    <?php } } } ?>
  <?php } } } } } }
    ?>
  </tbody>
</table>
    </div>
    <div id="menu3" class="tab-pane fade">
      <table id="datatable3" class="table" style="width:100%">
          <thead>
            <tr class="hgt">
        <th colspan="3">Ledger Name<a href="addAccountGroup.php" class="btn-button">Add</a> </th>
      </tr>
          </thead>
          <tbody id="tablesearch">
     <?php
    if(isset($accountData4->status)=='true'){
    if(isset($accountData4->AccountGroupData)){
    $no=1;
    foreach($accountData4->AccountGroupData as $resultList){
      ?>
    <tr class="uyt hgte">
      <td><i onclick="showgroup(<?php echo $resultList->Id; ?>);" class="fa fa-plus"></i>
        <a href="addAccountSubGroup.php"><?php echo $resultList->Name; ?></a></td>
    </tr>
    <?php
    $subGroupId = $resultList->Id;

$jsonData = '{
    "accountGroup":"'.$subGroupId.'"
}';

$url = $serverurlapi."General/accountSubGroupAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountSubGroupData)){
    foreach($accountData->AccountSubGroupData as $resultLists){
      ?>
    <tr style="background: aliceblue;display: none;" class="subgroup<?php echo $resultList->Id; ?>">
      <td style="padding-left: 65px!important;"><i onclick="showaccount('<?php echo $resultLists->Id; ?>');" class="fa fa-plus"></i>
        <a href="addAccountName.php"><?php echo $resultLists->Name; ?></a></td>
    </tr>
  <?php
    $Id = $resultLists->Id;
$jsonData = '{
    "GroupId":"'.$Id.'"
}';

$url = $serverurlapi."General/accountNameAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountNameData)){
    foreach($accountData->AccountNameData as $accountList){
      ?>
    <tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?>">
      <td style="padding-left: 115px!important;"><?php echo $accountList->AccountName; ?></td>
    </tr>

    <?php } } } ?>
  <?php } } } } } }
    ?>
  </tbody>
</table>
      </div>
    <div id="menu4" class="tab-pane fade">
      <table id="datatable4" class="table" style="width:100%">
          <thead>
            <tr class="hgt">
        <th colspan="3">Ledger Name<a href="addAccountGroup.php" class="btn-button">Add</a> </th>
      </tr>
          </thead>
          <tbody id="tablesearch">
     <?php
    if(isset($accountData5->status)=='true'){
    if(isset($accountData5->AccountGroupData)){
    $no=1;
    foreach($accountData5->AccountGroupData as $resultList){
      ?>
    <tr class="uyt hgte">
      <td><i onclick="showgroup(<?php echo $resultList->Id; ?>);" class="fa fa-plus"></i>
        <a href="addAccountSubGroup.php"><?php echo $resultList->Name; ?></a></td>
    </tr>
    <?php
    $subGroupId = $resultList->Id;

$jsonData = '{
    "accountGroup":"'.$subGroupId.'"
}';

$url = $serverurlapi."General/accountSubGroupAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountSubGroupData)){
    foreach($accountData->AccountSubGroupData as $resultLists){
      ?>
    <tr style="background: aliceblue;display: none;" class="subgroup<?php echo $resultList->Id; ?>">
      <td style="padding-left: 65px!important;"><i onclick="showaccount('<?php echo $resultLists->Id; ?>');" class="fa fa-plus"></i>
        <a href="addAccountName.php"><?php echo $resultLists->Name; ?></a></td>
    </tr>
    <?php
    $Id = $resultLists->Id;
$jsonData = '{
    "GroupId":"'.$Id.'"
}';

$url = $serverurlapi."General/accountNameAPI.php";
$resultData = postCurlData($url,$jsonData);
$accountData = json_decode($resultData);
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountNameData)){
    foreach($accountData->AccountNameData as $accountList){
      ?>
    <tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?>">
      <td style="padding-left: 115px!important;"><?php echo $accountList->AccountName; ?></td>
    </tr>

    <?php } } } ?>
  <?php } } } } } }
    ?>
  </tbody>
</table>
      </div>
  </div>
</div>

    </div>
  </div>
  <script>
function showgroup(id){
$(".subgroup"+id).show();
$(".hgroup"+id).show();
$(".sgroup"+id).hide();
}
function hidegroup(id){
$(".subgroup"+id).hide();
$(".hgroup"+id).hide();
$(".sgroup"+id).show();
$(".mgroup"+id).hide();
}
function showaccount(id){
$(".account"+id).toggle();
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>
