<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;


if($_SESSION["Type"]=="BRANCH"){
  $BranchCode = $_SESSION["BID"];
}else{
  $BranchCode = 'All';
}

if(trim($_GET['fromDate'])!='' && trim($_GET['toDate'])!=''){
  $fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
  $toDate = date('Y-m-d',strtotime($_GET['toDate']));
}

$url = $serverurlapi."General/dailydiscrepancyreport.php";

if($_GET['action']=="searchaction"){

$productType = trim($_GET['productType']);
	
$searching = '{
  "fromDate":"'.$fromDate.'",
  "toDate":"'.$toDate.'",
  "productType":"'.$productType.'",
  "BranchCode":"'.$BranchCode.'"
}';


$result = postCurlData($url,$searching);
$regionData = json_decode($result, true);

}
   
if($_GET['action']=="exportaction"){

$productType = trim($_GET['productType']);
	
$searching = '{
  "fromDate":"'.$fromDate.'",
  "toDate":"'.$toDate.'",
  "productType":"'.$productType.'",
  "BranchCode":"'.$BranchCode.'"
}';

$result = postCurlData($url,$searching);
$regionData = json_decode($result, true);
 
//  file name for download 
$filename = "Rejection_Report_".$productType."_" . $fromDate . "_to_".$toDate.".csv"; 
$delimiter = ",";

 // Create a file pointer 
    $f = fopen('php://memory', 'w'); 

// Column names 
$fields = array('S.No','Acknowledgement No', 'Applicant Last Name', 'Applicant First Name', 'Applicant Middle Name', 'Date of birth ', 'Status Code provided by TINFC', 'Type of Application', 'Date of Rejection','Rejection Reason'); 
 fputcsv($f, $fields, $delimiter); 
 

	if(isset($regionData['status'])=='true'){
		if(isset($regionData['ReportData'])){                    
			$no=1;
			foreach($regionData['ReportData'] as $resultList){
			 $lineData = array($resultList['Number'],$resultList['AckNumber'], $resultList['Applastname'], $resultList['Appfirstname'], $resultList['Appmiddlename'], $resultList['Dateofbirth'], $resultList['Statuscode'], $resultList['Formtype'],$resultList['RejectionDate'],$resultList['RejectionReason']); 
			 fputcsv($f, $lineData, $delimiter); 
			}
		$no++;
		}
	}
  // Move back to beginning of file 
    fseek($f, 0); 
	 
 
 // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 

exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Daily PAN/TAN Discrepancy Report</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable({
       "lengthMenu": [50, 100, 250, 500, 1000],
       "pageLength": 100

    });
} );
</script>
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">
  
  <div class="container-fluid">
		  <form action="" method="GET" autocomplete="off" id="exportfrm" />
			  <div class="row gy-bvc">
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">From&nbsp;Date</h6>
					<input type="text" name="fromDate" class="form-control datepicker" value="<?php echo $_GET['fromDate']; ?>" required autocomplete="off" />
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">To&nbsp;Date</h6>
					 <input type="text" name="toDate" class="form-control datepicker" value="<?php echo $_GET['toDate']; ?>" required autocomplete="off" />
				  </div>
				</div>
        <div class="col-md-3">
        <div class="flx">
        <h6 style="font-weight: initial;">Product&nbsp;Type</h6>
        <select class="form-control" name="productType" id="productType" required>
          <option value="">Select</option>
          <option value="PAN" <?php if($_GET['productType']=='PAN'){ echo "selected"; }?>>PAN</option>
          <option value="TAN" <?php if($_GET['productType']=='TAN'){ echo "selected"; }?>>TAN</option>
        </select>
        </div>
      </div>
				
				<div class="col-md-3">
				  <div class="flx">
				  <input type="hidden" id="action" name="action" value="" />
				  <input type="button" name="Search" class="btn btn-success" onClick="searchFunc('searchaction');" value="Search" />
				  <input type="button" name="Search" class="btn btn-success" onClick="searchFunc('exportaction');" value="Export Data" />
				  </div>
				</div>
			  </div>
		  </form>
		</div>
 <script>
 function searchFunc(data){
 	$('#action').val(data);
	$('form#exportfrm').submit();
 }
 </script> 
  
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

      <div class="container-fluid" style="margin-top:20px;overflow: auto;">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>S.No</th>
              <th>Acknowledgement No</th>
              <th>Applicant Last Name</th>
              <th>Applicant First Name</th>
              <th>Applicant Middle Name</th>
              <th>Date of birth </th>
              <th>Status Code provided by TINFC</th>
              <th>Type of Application</th>
              <th>Date of Rejection</th>
              <th>Rejection Reason</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
            <?php
    if(isset($regionData['status'])=='true'){
    if(isset($regionData['ReportData'])){                    
    $no=1;
    foreach($regionData['ReportData'] as $resultList){


    ?>
            <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php echo $resultList['AckNumber']; ?></td>
              <td><?php echo $resultList['Applastname'] ?></td>
              <td><?php echo $resultList['Appfirstname']; ?></td>
              <td><?php echo $resultList['Appmiddlename']; ?></td>
              <td><?php echo $resultList['Dateofbirth']; ?></td>
              <td><?php echo $resultList['Statuscode']; ?></td>
              <td><?php echo $resultList['Formtype']; ?></td>
              <td><?php echo $resultList['RejectionDate']; ?></td>
              <td><?php echo $resultList['RejectionReason']; ?></td>
            </tr>
            <?php
    $no++;
  }
}
  }
  else{?>
    <tr class="uyt hgte">
<td colspan="10"><div align="center"><?php echo 'You Can Search...'; ?></div></td>    
    </tr>
    <?php }
    ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
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
  table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled),table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
font-size: 12px!important;
}
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .search-input-grid{
     display: grid;
    grid-gap: 5px;
  }
  .search-button{
      display: grid;
    grid-template-columns: auto auto;
    grid-gap: 20px;
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
<script>
$( function() {
	$( ".datepicker" ).datepicker({ 
		dateFormat: 'dd-mm-yy',
		maxDate: 0
	});
});
</script>
<!--search filter-->
<script>
// function searchingName(){
//     var name = $("#bname").val().toLowerCase();
//     $("#tablesearch tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
//     });
// }
</script>
