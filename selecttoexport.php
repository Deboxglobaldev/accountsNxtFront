<?php

include "inc.php";
include "logincheck.php";

//get mis liste
logger("Session BranchId...".$_SESSION["branchId"]);
logger("Session Type...".$_SESSION["Type"]);

	$jsonPost = '{ "UserType": "'.$_SESSION["Type"].'", "UserId": "", "UserTypeId": "'.$_SESSION["branchId"].'"}';
	logger("JSON to post dashboard data:  ----".$jsonPost);
	$urlNew = $serverurlapi."Dashboards/DashboardAPI.php";
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
<title>Export Batch</title>
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




<div id="tabledata" style="padding: 10px;">
<?php  if(isset($_SESSION['error'])!=''){ ?>
<div class="bs-example" id="messageDiv">
	<!-- Success Alert -->
	<div class="alert alert-dismissible fade show" style="border: solid 2px; border-block-color: green; font-weight: 800; font-size: 17px; color: green;">
		  <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
</div>
<?php } ?>

<form method="post" action="export.php">
<div id="batchbutton" style="display:none; float:left;"><button type="submit" class="btn btn-success" style="font-size: 13px; font-weight: 700;">Generate Batch File</button></div>
<input type="hidden" name="action" value="exportbatch">
<table class="table table-bordered " id="tableID" style="width:100% !important;">
	<thead>
	<tr class="headline" style="background: #5ea923;">
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;"><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Acknowledge No.</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Prod.&nbsp;Type</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Type</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Stage</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Sub Stage</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Batch No.</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Agent ID</th>
		<th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Ack.&nbsp;Date</th>
	</tr>
	<tr style="background: #5ea923;">
		<th></th>
		<th></th>
		<th></th>
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


	if(strtoupper($list->ProductType)=='PAN'){
		  if($UserType =="QCF" || $UserType =="BRANCH" || $UserType =="BCP")
		  {


			if( strtoupper($list->SubStageId)=="0")
			{
			  $stagurl = "filesubmit.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}elseif($list->SubStageId=="1")
			{
			  $stagurl = strtoupper(trim($list->ApplicantCategory))=="INDIVIDUAL"?"cropingstage.php?aid=" :  "dataentry.php?aid="  ;
			   $stagurl  .= $list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}elseif($list->SubStageId=="2")
			{
			  $stagurl = "dataentry.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}
		  }else if($UserType =="QCP")
		  {
			if($list->SubStageId=="1")
			{
			  $stagurl = $list->ApplicationCategory=="INDIVIDUAL"?"cropingstage.php?aid=" :  "qc_pdf.php?aid="  ;
			   $stagurl  .= $list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}else{
				$stagurl = "qc_pdf.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}
		  }else{
				echo 'Invalid User Type';
				exit();
		  }
	}elseif(strtoupper($list->ProductType)=='TAN'){
		  if($UserType =="QCF" || $UserType =="BRANCH" || $UserType =="BCP")
		  {


			if( strtoupper($list->SubStageId)=="0")
			{
			  $stagurl = "filesubmittan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}elseif($list->SubStageId=="1")
			{
			  $stagurl = "dataentrytan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}elseif($list->SubStageId=="2")
			{
			  $stagurl = "dataentrytan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}
		  }else if($UserType =="QCP")
		  {
			if($list->SubStageId=="1")
			{
				$stagurl = "qc_pdftan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}else{
				$stagurl = "qc_pdftan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
			}
		  }else{
				echo 'Invalid User Type';
				exit();
		  }
	}else{
		echo 'Invalid Product Type';
		exit();
	}

	if($list->ApplicationAgeing<=2 || $list->ApplicationAgeing==''){
		$color='#2eb82e';

	}else if($list->ApplicationAgeing>=3 && $list->ApplicationAgeing<=6 ){
		$color='#ffa31a';

	}else if($list->ApplicationAgeing>6){
		$color='#ff1a1a';
	}

	if(strtoupper($list->ProductType)=="PAN"){
		$stagurl = "dataentry.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
	}else{
		$stagurl = "dataentrytan.php?aid=".$list->Acknowledgement."&formType=".strtoupper($list->FormType);
	}


?>
<tr>
	<td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $list->Acknowledgement; ?>" name="acknowledgmentchecksingle[]"  class="deleteack" onClick="checkProductType('<?php echo strtoupper($list->ProductType); ?>');" /></td>
	<td class="deta"><a href="<?php echo $stagurl; ?>"><?php echo $list->Acknowledgement; ?></a></td>
	<td><span><?php echo strtoupper($list->ProductType); ?></span></td>
	<td><span><?php echo strtoupper($list->FormType); ?></span></td>
	<td><span><?php echo $list->CurrentStage; ?></span></td>
	<td><span><?php echo $list->SubStage; ?></span></td>
	<td  class="deta"><a href="rebatchingpage.php?batchno=<?php echo $list->BatchNo; ?>&ptype=<?php echo strtoupper($list->ProductType); ?>" target="_blank"><?php echo $list->BatchNo; ?></a></td>
	<td><span><?php echo substr($list->Acknowledgement,0,2); ?></span></td>
	<td><span><?php echo $list->AcknowDate; ?></span></td>
</tr>
<?php
	$no++; }   }else{
	echo 'no data found';
	}
	?>
</tbody>
</table>
<input type="hidden" id="proType" name="proType" value="">
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
  stateSave: true,
  orderCellsTop: true,
  initComplete: function () {
        this.api().columns([2,3,4,5,6,7]).every( function (i) {
			var selcolID = "sel_"+i;
            var column = this;
            var select = $('<select class="filterCls" id="'+selcolID+'"><option value="">All</option></select>')
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
					var textVal = $( d ).text();
					var filter = column.state().columns[i].search.search;
					var newStr = filter.replace('^', '');
					var filterStr = newStr.replace('$', '');
					filterStr =  filterStr.replace(/\\/g, '');
					//alert(textVal+'++++++++++'+filterStr);
					var selected = (textVal === filterStr) ? 'selected' : ' ';
					if(textVal!=''){
						select.append( '<option value="'+textVal+'" ' + selected + '>'+textVal+'</option>' );
					}

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