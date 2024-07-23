<?php 
include "inc.php";
include "logincheck.php";

if($_POST['action']=='boxallot'){
 	$ackJson = '';
	foreach($_POST['acknowledgmentchecksingle'] as $AcknowledgementNumber){
		$ackJson.= '{"TempBoxNo":"'.$AcknowledgementNumber.'"},';
	}
	
	$jsonPost = '{
		"BoxNo":"'.$_POST['boxno'].'",
		"Vendor":"'.$_POST['vendor'].'",
		"BarCodeNo":"'.$_POST['barCode'].'",
		"TempBoxNoList":['.rtrim($ackJson,',').']
	}';
	
	logger("JSON to post box allot:  ----".$jsonPost);
	$url = $serverurlapi."Dashboards/updateBoxBarcodeAPI.php";
	logger("  API hit URL: ". $url); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$responseData = curl_exec($ch);
	logger("Response return from box allot API: ". $responseData); 
	$dashData = json_decode($responseData);
	//print_r($dashData);
	curl_close($ch);

if($dashData->status==0 && $dashData->RecordUpdated!=0){
$location = 'backofficedashboard.php';
?>
<script>
parent.window.location.href = '<?php echo $location; ?>'; 
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

if($_GET['fromRange']!="" && $_GET['toRange']!=""){
$fromRange = $_GET['fromRange'];
$toRange = $_GET['toRange'];
}else{
$fromRange = "";
$toRange = "";
}
	$jsonPost = '{"fromRange":"'.$fromRange.'","toRange":"'.$toRange.'"}';
	logger("JSON to post box allot API:  ----".$jsonPost);
	$urlNew = $serverurlapi."General/tempBoxAPI.php";
	logger("API hit URL: ". $urlNew); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$urlNew);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	logger("Response return from box allot API: ". $response); 
	$dashData = json_decode($response);
	//print_r($dashData);
	curl_close($ch);
	
	

?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Box Allotment</title>
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

<form method="GET" action="">
<input type="hidden" name="action" value="search">
<div class="row" style="margin-bottom: 10px; padding: 10px;">
	<div class="col-md-2">
	  <div class="flx">
		<input type="number" name="fromRange" id="fromRange" value="<?php echo $fromRange; ?>" placeholder="From Range.." class="form-control" required>
	  </div>
	</div>
	<div class="col-md-2">
	  <div class="flx">
		<input type="number" name="toRange" id="toRange" value="<?php echo $toRange; ?>" placeholder="To Range.." class="form-control" required>
	  </div>
	</div>
	<div class="col-md-2">
	  <div class="flx">
		<button type="submit" class="btn btn-success">Search</button>
	  </div>
	</div>
</div>
</form>

<div id="tabledata" style="padding: 10px;">
<form method="post" action="" name="allotform" id="allotform">
<div id="batchbutton" style="display:none; float:left;"><button type="button" class="btn btn-success" style="font-size: 13px; font-weight: 700;" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Box Allot','modelpop.php?action=boxallot','100%','auto');">Allot Box</button></div>
<input type="hidden" name="action" value="boxallot">
<input type="hidden" name="tempbox" id="tempboxid" value="">
<input type="hidden" name="vendor" id="vendor" value="">
<input type="hidden" name="boxno" id="boxno" value="">
<input type="hidden" name="barCode" id="barCodeno" value="">
<table class="table table-bordered " id="tableID" style="width:100% !important;">
	<thead>
	<tr class="headline" style="background: #5ea923;">
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;"><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Temp. Bunch No.</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Total Ack. No</th>
	</tr>
	<tr style="background: #5ea923;">
		<th></th>
		<th></th>
		<th></th>
	</tr>
	</thead>
<tbody id="searchTable">
<?php
if($dashData->Status=='0')
{
$no=1;
foreach($dashData->tempBoxList as $list)
{

?>
<tr>
	<td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $list->tempBoxNumber; ?>" name="acknowledgmentchecksingle[]"  class="deleteack"/></td>
	<td class="deta"><a href="#"><?php echo $list->tempBoxNumber; ?></a></td>
	<td><span><?php echo $list->count; ?></span></td>
</tr>
<?php
$no++; }  
}else{
echo 'no data found';
}
?>
</tbody>
</table>  
</form>
</div>

</div>
</div>

</div>

</div>

</div>




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
        this.api().columns([1,2,3]).every( function (i) {
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
<script type="text/javascript">
    $(document).ready(function(){
    // check uncheck all inclusions
    $("#ackknowledmentCheckAll").click(function(){
    if(this.checked){
      $('.deleteack').each(function(){
        this.checked = true;
      })
    }else{
      $('.deleteack').each(function(){
        this.checked = false;
      })
    }
    });
    
    });

    window.setInterval(function(){ 
      checked = $("#tabledata input[type=checkbox]:checked").length;
      if(!checked) { 
    $("#batchbutton").hide();
      } else {
	  
    $("#batchbutton").show();
    } 
}, 100);
</script>   

</body>

</html>



<style>


</style>