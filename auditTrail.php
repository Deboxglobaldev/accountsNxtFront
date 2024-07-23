<?php
// get url
include "inc.php";
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- ";

if(isset($_POST['action'])=='searchaction')
{
  $acknoNumber = $_POST['ackNo'];
  $productType = $_POST['productType'];
	$searching = '{
					"AcknowledgementNo":"'.$acknoNumber.'",
					"productType":"'.$productType.'"
				}';


$url = "".$serverurlapi."General/getAuditTrailAPI.php";
$response = postCurlData($url,$searching);
//logger("Response return from Audit Trail API: ". $response);
$dashData = json_decode($response);
}

if($_POST['action']=="exportaction"){

$acknoNumber = $_POST['ackNo'];
  $productType = $_POST['productType'];
	$searching = '{
					"AcknowledgementNo":"'.$acknoNumber.'",
					"productType":"'.$productType.'"
				}';

$url = "".$serverurlapi."General/getAuditTrailAPI.php";
$response = postCurlData($url,$searching);
logger("Response return from Audit Trail EXPORT API: ". $response);
$dashData = json_decode($response);


// Filter the excel data
/*function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
} */

// Excel file name for download
$fileName = "Audit_Trail_".$acknoNumber .".xls";

// Column names
$fields = array('Acknowledgement No', 'Form Type', 'Stage', 'Date', 'User', 'User IP');


// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

	if(isset($dashData->Status)=='true'){
		if(isset($dashData->listOfData)){
			$no=1;
			foreach($dashData->listOfData as $resultList){
			//$dateTime = explode(' ', $resultList->Date);
			//$date = $dateTime[0];
			//$time = $dateTime[1];
			//$showDate = date_create($date);
				if($resultList->AcknowledgementNo!='' && $resultList->Stage!=''){

				 $lineData = array($resultList->AcknowledgementNo,$resultList->FormType,$resultList->Stage,$resultList->Date,$resultList->UserId,$resultList->IPAddress);
						//array_walk($lineData, 'filterData');
						$excelData .= implode("\t", array_values($lineData)) . "\n";
				 }
			}
		$no++;
		}
	}

	// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");
// Render excel data
echo $excelData;

exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Audit Trail</title>
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
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="">
    <section>
    <div class="container-fluid">
      <form action="" method="POST" id="exportfrm">
      <div class="row gy-bvc">
        <div class="col-md-5">
          <div class="flx">
            <h6 style="font-weight: initial;">Acknowledgement&nbsp;Number</h6>
            <input type="number" name="ackNo" id="ackNo" class="form-control" value="<?php echo $_POST['ackNo']; ?>" required />
			<span id="showErr" style="color:#FF0000; display:none;">You have branch code matching with your branch!</span>
			<input type="hidden" name="userType" id="userType" value="<?php echo $_SESSION['Type']; ?>" />
          </div>
        </div>
		<div class="col-md-4">
          <div class="flx">
            <h6 style="font-weight: initial;">Product&nbsp;Type</h6>
            <select name="productType" class="form-control" required>
				<option value="">Select</option>
				<option value="PAN" <?php if($_POST['productType']=="PAN"){ echo 'selected'; }?>>PAN</option>
				<option value="TAN" <?php if($_POST['productType']=="TAN"){ echo 'selected'; }?>>TAN</option>
			</select>
          </div>
        </div>
      </div>
      <div class="row gy-bvc">
        <div class="col-md-3"> </div>
        <div class="col-md-3">
          <input type="hidden" name="action" id="action" value="" />
          <input type="submit" name="Search" class="btn btn-default browsebutton pd-button searchBtn" onClick="searchFunc('searchaction');" value="Search" />
        </div>
		<div class="col-md-3">
          <input type="submit" name="Search" class="btn btn-default browsebutton pd-button searchBtn" onClick="searchFunc('exportaction');" value="Export" />
        </div>
        <div class="col-md-3">
          <!--<button type="button" class="btn btn-default browsebutton pd-button">Exit</button> -->
          <a href="auditTrail.php" class="btn btn-default browsebutton pd-button">Exit</a> </div>
      </div>
      </form>
	  </div>
      </section>
	  <script>
	   $(document).ready(function(){
			$("#ackNo").blur(function(e){

				var userType = $('#userType').val();
				var ackVal = e.currentTarget.value;

				if(userType=="BRANCH"){
					var first5AckChar = ackVal.substr(0,5);
          var first7AckChar = ackVal.substr(0,7);

					if(first5AckChar=='<?php echo $_SESSION["BID"]; ?>'){
						$('.searchBtn').attr('disabled' , false);
						$('#showErr').hide();
					} else if(first7AckChar=='<?php echo $_SESSION["BID"]; ?>'){
            $('.searchBtn').attr('disabled' , false);
						$('#showErr').hide();
          }
          else{
            $('.searchBtn').attr('disabled' , true);
						$('#showErr').show();
					}
				}
			});
		});
	  </script>
<script>
function searchFunc(data){
 	$('#action').val(data);
	//$('form#exportfrm').submit();
}
</script>
      <div class="container-fluid">
        <table class="table table-bordered " id="tableID" style="width:100% !important; ">
          <thead>
            <tr class="headline" style="">
              <th>Acknowledgement&nbsp;No. </th>
			  <th>Form Type</th>
              <th>Stage.</th>
              <!--<th>Sub Stage.</th>-->
              <th>Date</th>
              <th>User</th>
			  <th>User IP</th>
            </tr>
          </thead>
          <tbody id="searchTable">
   <?php
	if($_POST['ackNo']!=''){
    $no=1;
	if($dashData->listOfData!=''){
    foreach($dashData->listOfData as $resultList){


		$dateTime = explode(' ', $resultList->Date);
		$date = $dateTime[0];
		$time = $dateTime[1];
		$showDate = date_create($date);
		if($resultList->AcknowledgementNo!='' && $resultList->Stage!=''){
    ?>
            <tr>
              <td><?php echo trim($resultList->AcknowledgementNo); ?></td>
			  <td><?php echo trim($resultList->FormType); ?></td>
              <td><?php echo strtoupper($resultList->Stage); ?></td>
              <!--<td><?php echo $resultList->SubStage; ?></td>-->
              <td><?php echo date_format($showDate, "d/m/Y"); ?> <?php echo $time; ?></td>
              <td><?php echo $resultList->UserId; ?></td>
			  <td><?php echo $resultList->IPAddress; ?></td>
            </tr>
            <?php
    }

     $no++;
	 } }else{ ?>
	<tr>
	  <td colspan="6"><div align="center">No Result Found</div></td>
	</tr>

	<?php }

    }else{?>
            <tr>
              <td colspan="6"><div align="center"><?php echo 'You Can Search...'; ?></div></td>
            </tr>
            <?php }
    ?>
          </tbody>
        </table>
      </div>
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
