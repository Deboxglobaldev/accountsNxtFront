<?php 

include "inc.php";
include "logincheck.php";

if($_POST['action']=='createbunch'){
 	$ackJson = '';
	foreach($_POST['acknowledgmentchecksingle'] as $AcknowledgementNumber){
		$ackJson.= '{"AcknowledgementNumber":"'.$AcknowledgementNumber.'"},';
	}
	
	$jsonPost = '{
		"ListOfACKO":['.rtrim($ackJson,',').']
	}';
	
	logger("JSON to post create bunch:  ----".$jsonPost);
	$url = $serverurlapi."General/CreateBunchAPI.php";
	logger("  API hit URL: ". $url); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$responseData = curl_exec($ch);
	logger("Response return from dashboard API: ". $response); 
	$dashData = json_decode($responseData);
	//print_r($dashData);
	curl_close($ch);

if($dashData->status==0){

$saveTo = $serverurl."FronEnd/vendors/barcode/barcode.php?codetype=Code39&size=40&text=".$dashData->BunchNo."&print=true";
$file = 'data/temp/barcode/'.$dashData->BunchNo.'.jpg'; //file name to write to include location if needed
$current = file_get_contents($saveTo);//read the created file
file_put_contents($file, $current);//write it

?>
<script>
alert('<?php echo $dashData->Message; ?>');
</script>
<?php } 
	
}	

//get mis liste
logger("Session BranchId...".$_SESSION["branchId"]);
logger("Session Type...".$_SESSION["Type"]);
if(!isset($_SESSION['branchId']))
{
    
  logger ("[ERR] - Session called 'branchId' is empty, expecting a branch Id");
  echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
  exit();
  
}
	$jsonPost = '{ "UserType": "'.$_SESSION["Type"].'", "UserId": "", "UserTypeId": "'.$_SESSION["branchId"].'"}';
	logger("JSON to post dashboard data:  ----".$jsonPost);
	$urlNew = $serverurlapi."Dashboards/BackOfficeDashboardAPI.php";
	logger("  API hit URL: ". $urlNew); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$urlNew);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$response = curl_exec($ch);
	//logger("Response return from dashboard API: ". $response); 
	$dashData = json_decode($response);
	//print_r($dashData);
	curl_close($ch);
	
	

?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Box Management</title>
<meta name="description" content="PAN OFFICE" />

<!-- Favicon -->
<?php include 'links.php'; ?>

<style>
.filterCls{
	padding: 2px;
}
table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled) {
    padding-right: 10px !important;
    padding-left: 10px !important;
}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 1px !important;
}
.headline {
    border-bottom: 4px solid #1f7140 !important;
}
.thCls{
	 font-size: 15px;  font-weight: 700; color: #fff;
	 
}
</style>
</head>

<body>


<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

<!-- Top Navbar -->
<?php include 'backofficeheader.php'; ?>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

<div class="hk-pg-wrapper"  >

<div style="background-color: #1e733f;background-image:linear-gradient(to right,#1e733f,#79c117);padding:3px;">
<div class="Container-fluid">
<div class="row strip">
<div class="col-sm-6">
<p class="ticker"></p>
</div>

<div class="col-sm-6">
<p class="ticker"></p>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Row -->
<div class="row">




</div>



<div id="tabledata" style="padding: 10px;">
<form method="post" action="">
<div style="display: grid;grid-template-columns: 1fr 1fr;width: 50%;">
<div>
<select name="vendorId" id="vendorId" style="outline: none;height: 30px;border: 1 px solid #a1a1a1;width: 200px;">
	<option>Choose Vendor</option>
	<option value="1">Vendor1</option>
	<option value="2">Vendor2</option>
	<option value="3">Vendor3</option>
</select>
</div>
<div>
<select name="boxNo" id="boxNo" style="outline: none;height: 30px;border: 1 px solid #a1a1a1;width: 200px;">
	<option>Choose Box No</option>
	<option value="001">001</option>
	<option value="002">002</option>
	<option value="003">003</option>
	<option value="004">004</option>
	<option value="005">005</option>
	<option value="006">006</option>
	<option value="007">007</option>
	<option value="008">008</option>
	<option value="009">009</option>
</select>
</div>
</div>
<input type="hidden" name="action" value="createbunch">
<table class="table table-bordered " id="tableID" style="width:100% !important;">
	<thead>
	<tr class="headline" style="background: #5ea923;">
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;"><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Acknowledgement No.</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Prod.&nbsp;Type</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Stage</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Sub Stage</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Bunch&nbsp;Number</th>
	</tr>
	<tr style="background: #5ea923;">
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	</thead>
<tbody id="searchTable">
<?php
if($dashData[0]->Status=='0')
{
$color1='';
$color2='';							
$UserType = $_SESSION["Type"];
$UserType = strtoupper($UserType);		 
$no=1;
foreach($dashData[0]->DataTable as $list)
{

?>
<tr>
	<td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $list->Acknowledgement; ?>" name="acknowledgmentchecksingle[]"  class="deleteack" onClick="checkProductType('<?php echo strtoupper($list->ProductType); ?>');" /></td>
	<td class="deta"><?php echo $list->Acknowledgement; ?></td>
	<td><span><?php echo strtoupper($list->ProductType); ?></span></td>
	<td><span><?php echo $list->CurrentStage; ?></span></td>
	<td><span><?php echo $list->SubStage; ?></span></td>
	<td><a href="courierdetail.php?bunchNumber=<?php echo $list->BunchNumber; ?>"><b><?php echo $list->BunchNumber; ?></b></a></td>
</tr>
<?php
$no++; }  
}else{
echo 'no data found';
}
?>
</tbody>
</table>  
<input type="hidden" id="proType" name="proType" value="" >
</form>
</div>

</div>
</div>

</div>

</div>

</div>

<script>
function checkProductType(ptype){
	$('#proType').val(ptype);
}
</script>


<?php include 'footer.php'; ?>    
<!--search filter-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

<script>

/* Initialization of datatables */
$(document).ready(function () {

// Paging and other information are
// disabled if required, set to true
var myTable = $("#tableID").DataTable({
  paging: true,
  searching: true,
  info: true,
  //stateSave: true,
  orderCellsTop: true,
  initComplete: function () {
        this.api().columns([2,3,4,5]).every( function (i) {
			var selcolID = "sel_"+i;
            var column = this;
            var select = $('<select class="filterCls" id="'+selcolID+'"><option value="">--Select--</option></select>')
               .appendTo( $("#tableID thead tr:eq(1) th").eq(column.index()).empty() )
                    .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
                } );
            column.data().unique().sort().each( function ( d, j ) {
			var textVal = $( d ).text()
                    select.append( '<option value="'+textVal+'">'+textVal+'</option>' );
            } );
        } );
    }
});

// 2d array is converted to 1D array
// structure the actions are 
// implemented on EACH column
//$('#tableID thead tr').clone(true).appendTo( '#tableID thead' );
//$('#tableID thead tr:eq(1) th').each( function (colID) {

//var selcolID = "sel_"+colID;

//var mySelectList = $(this).html( "<select id="+selcolID+"><select />" );

 
	  
//}); 



 
});
</script>
</body>

</html>



<style>


</style>