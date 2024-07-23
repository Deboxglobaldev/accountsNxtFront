<?php 
include "inc.php";
include "logincheck.php";

//get mis liste

$batchno  = trim($_GET['batchno']);
$productType  = trim($_GET['ptype']);

$formJson = '{ "BatchId": "'.$batchno.'" }';	
logger("JSON GET ACK NUMBER FROM BATCH NUMBER: ".$formJson);

if($productType=='PAN'){
$urlPost = $serverurlapi."General/PanPdf.php";
}else{
$urlPost = $serverurlapi."General/TanPdf.php";
}

$chp = curl_init();
curl_setopt($chp, CURLOPT_URL,$urlPost);
curl_setopt($chp, CURLOPT_POST,1);
curl_setopt($chp, CURLOPT_POSTFIELDS, $formJson);
curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($chp); 
curl_close($chp);
$res = json_decode($response);
	

?>
<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Re-Batching</title>
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
<?php include 'header.php'; ?>
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
<form method="post" action="exportrebatching.php">
<div id="batchbutton" style="display:none; float:left;"><button type="submit" class="btn btn-warning" style="font-size: 13px; font-weight: 700;">Re-Batching</button></div>
<input type="hidden" name="action" value="exportbatch">
<table class="table table-bordered " id="tableID" style="width:100% !important;">
	<thead>
	<tr class="headline" style="background: #5ea923;">
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;"><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Acknowledge No.</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Product&nbsp;Type</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Form&nbsp;Type</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Applicant Category</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Batch No.</th>
	</tr>
	</thead>
<tbody id="searchTable">
<?php
foreach($res->Fieldlist as $list){

if(strtoupper($productType)=="PAN"){
		$stagurl = "dataentry.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
	}else{
		$stagurl = "dataentrytan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
	}
	
?>
<tr>
	<td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $list->Acknowledgement; ?>" name="acknowledgmentchecksingle[]" class="deleteack" checked /><input type="hidden" name="proType" value="<?php echo strtoupper($productType); ?>" ></td>
	<td class="deta"><a href="<?php echo $stagurl; ?>"><?php echo $list->Acknowledgement; ?></a></td>
	<td><?php echo $productType; ?></td>
	<td><?php echo $list->FormType; ?></td>
	<td><?php echo $list->ApplicantCategory; ?></td>
	<td><?php echo $batchno; ?></td>
</tr>
<?php
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
        this.api().columns().every( function (i) {
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
                    select.append( '<option value="'+d+'">'+d+'</option>' );
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