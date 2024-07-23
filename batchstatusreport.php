<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- ";

if(isset($_REQUEST['action'])=='searchaction')
{
  $fromDate = encode(date('Y-m-d',strtotime($_REQUEST['fromDate'])));  
  $toDate = encode(date('Y-m-d',strtotime($_REQUEST['toDate'])));
  $productType = trim($_REQUEST['productType']);
	$searching = '{
					"fromDate":"'.decode($fromDate).'",
					"toDate":"'.decode($toDate).'",
					"productType":"'.$productType.'"
				}';
				
				
$url = $serverurlapi."General/getBatchStatusReport.php";
$response = postCurlData($url,$searching);
//logger("Response return from Batch Status Report API: ". $response); 
$dashData = json_decode($response);				
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Batch Status Report</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
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
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  	<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
	<div class="hk-pg-wrapper">
	   
		<div class="container-fluid">
		  <form action="" method="POST" />
			  <div class="row gy-bvc">
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">From&nbsp;Date</h6>
					<input type="text" name="fromDate" class="form-control datepicker" value="<?php echo $_REQUEST['fromDate']; ?>" readonly="readonly" required />
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">To&nbsp;Date</h6>
					 <input type="text" name="toDate" class="form-control datepicker" value="<?php echo $_REQUEST['toDate']; ?>" readonly="readonly" required />
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">Product</h6>
					<select name="productType" class="form-control" required>
						<option value="">Select</option>
						<option value="PAN" <?php if($_REQUEST['productType']=="PAN"){ echo 'selected'; }?>>PAN</option>
						<option value="TAN" <?php if($_REQUEST['productType']=="TAN"){ echo 'selected'; }?>>TAN</option>
					</select>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
				  <input type="hidden" name="action" value="searchaction" />
					<input type="submit" name="Search" class="btn btn-success" value="Search" />
				  </div>
				</div>
			  </div>
		  </form>
		</div>
	 
	  <div class="container-fluid">
		<table class="table table-bordered " id="tableID" style="width:100% !important; ">
		  <thead>
			<tr class="headline" style="">
			  <th>Batch&nbsp;No. </th>
			  <th>Product Type</th>
			  <th>WISDA Ref#</th>
			  <th>Batch Creation Date.</th>
			  <th>Total Ack. No</th>
			  <th>Status</th>
			</tr>
		  </thead>
		  <tbody id="searchTable">
	<?php
	$no=1;
	if($dashData->listOfData!=''){
	foreach($dashData->listOfData as $resultList){
	
	?>
			<tr>
			  <td><?php echo $resultList->BatchNumber; ?></td>
			  <td><?php echo $_REQUEST['productType']; ?></td>
			  <td><?php echo $resultList->wisdarefNumber; ?></td>
			  <td><?php echo date('d-M-Y',strtotime($resultList->BatchDate)); ?></td>
			  <td><?php echo $resultList->AckNumberCount; ?></td>
			  <td><?php echo $resultList->ResStatus; ?></td>
			</tr>
			<?php
	
	
	 $no++; 
	 } 
	 }
	 if($no==1){ ?>
	<tr>
	  <td colspan="6"><div align="center">No Result Found</div></td>
	</tr>
	
	<?php } ?>
		  </tbody>
		</table>
	  </div>
	</div>
</div>
<script>
$( function() {
	$( ".datepicker" ).datepicker({ 
		dateFormat: 'dd-mm-yy',
		maxDate: 0
	});
});

</script>
<script>
$(document).ready(function(){
    $('#tableID').DataTable();
} );
</script>
<?php include 'footer.php'; ?>
</body>
</html>
<style>
  .ui-select{
    padding: 2%;
  }
  .hgt th{
    text-align: center;
    font-weight: bold;
  }
  .hgte td{
    text-align: center;
  }
  .gvre{
        display: flex;
    column-gap: 10px;
  }
  .lk-kl{
  width: fit-content;
    margin-left: auto;
    column-gap: 50px;
  }
  .pd-btn{
    padding: 3px 40px;
  }
  .pd-btn2{
    padding: 3px 80px;
  }
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .vcx-i{
    border-top: 2px solid;
    border-bottom: 2px solid;
  }
  .ht-jy{

    margin-top:7%;
  }
.inp-wuui{
  margin: 3px;
}
.gy-bvc{
  margin: 1%;
}
.nn-mb{
  margin-top: 3%;
}
.inp-w{
  width: 90%;
}
.uyt td{
  border: none;
}
</style>
<!--search filter-->
