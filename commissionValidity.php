 <?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url); 
if(isset($_POST['Search']))
{
  	$searching = '{
            "fromDate": "'.$_POST['fromDate'].'",
            "Status": "'.$_POST['Status'].'",
            "type": "'.$_POST['Type'].'",
            "minAmt": "'.$_POST['MinAmount'].'",
            "maxAmt": "'.$_POST['MaxAmount'].'",
            "Status": "'.$_POST['Status'].'",
            "commissionType": "'.$_POST['commissionType'].'"
}';
	$url = $serverurlapi."General/commissionAPI.php";
	$response = postCurlData($url,$searching);
	logger("Response return from Audit Trail API SEARCH: ". $response); 
	$regionData = json_decode($response);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Commission Validity</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
} );
</script>
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    
    <div class="container-fluid">
    <form action="" method="post" />
      <div class="row gy-bvc" style="">
        <div class="col-md-2">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Date</h6>
            <input class="inp-w datepicker" type="text" placeholder="Date..." autocomplete="off" name="fromDate" value="<?php echo $_POST['fromDate']; ?>" id="fromDate">
          </div>
        </div>
		<!-- <div class="col-md-2">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">To Date</h6>
             <input class="inp-w datepicker" type="text" placeholder="To Date..." autocomplete="off" name="toDate" value="<?php // echo $_POST['toDate']; ?>" id="toDate">
          </div>
        </div> -->
		<div class="col-md-2">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Commission Type</h6>
            <select class="inp-w ui-select" name="commissionType">
              <option value="">Select</option>
              <option value="A" <?php if($_POST['commissionType']=='A'){?>selected="selected"<?php } ?>>Acceptance</option>
              <option value="D" <?php if($_POST['commissionType']=='D'){?>selected="selected"<?php } ?>>Digitization</option>
			  <option value="I" <?php if($_POST['commissionType']=='I'){?>selected="selected"<?php } ?>>Incentive</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Status</h6>
            <select class="inp-w ui-select" name="Status" value="<?php echo $_POST['Status']; ?>">
              <option value="">Select</option>
              <option value="1" <?php if($_POST['Status']=='1'){?>selected="selected"<?php } ?>>Active</option>
              <option value="0" <?php if($_POST['Status']=='0'){?>selected="selected"<?php } ?>>Inactive</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="search-input-grid">
          <h6>&nbsp;</h6>
         <div class="search-button">
              <input type="submit" name="Search" class="btn btn-default browsebutton pd-button" value="Search" />
              <button type="reset" class="btn btn-default browsebutton pd-button">Reset</button>
          </div>
        </div>
        </div>
      </div>
    </form>
      <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="addCommissionValidity.php">
              <button type="button" class="btn btn-default browsebutton pd-btns"> <i class="fa-plus fa">&nbsp;</i>Add</button>
              </a></div>
          </div>
        </div>
      </div>
      </section>
      <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>S.No</th>
              <th>From Date</th>
			  <th>To Date</th>
			  <th>Amount</th>
			  <th>Commission Type</th>
              <th>Status</th>
              <th>Created By</th>
              <th>Created Date</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody id="tablesearch">
    <?php
    if(isset($regionData->DataTable)){ 
    $no=1;
    foreach($regionData->DataTable as $resultList){
    ?>
		<tr class="uyt hgte">
		  <td><?php echo $no; ?></td>
		  <td><?php echo date('d-m-Y',strtotime($resultList->FromDate)); ?></td>
		  <td><?php echo date('d-m-Y',strtotime($resultList->ToDate)); ?></td>
		  <td><?php echo $resultList->CommissionRate; ?></td>
		  <td><?php if($resultList->CommissionType=='A'){echo 'Acceptance'; }elseif($resultList->CommissionType=='D'){ echo 'Digitization'; }elseif($resultList->CommissionType=='I'){ echo 'Incentive'; } ?></td>
		  <td><?php if($resultList->Status==1){echo 'Active';} else{ echo 'Inactive'; } ?></td>
      <td><?php echo $resultList->CreatedBy; ?></td>
      <td><?php echo $resultList->CreatedDate; ?></td>
		  <!-- <td><div class="gvre"> <a href="addCommissionValidity.php?editId=<?php // echo encode($resultList->Id); ?>" class="btn btn-default branchbtn" style="width: 100%;">Edit</a></div></td> -->
		</tr>
     <?php
    	$no++;
	}
}
	if($no==1){
	?>
    <tr class="uyt hgte">
<td colspan="8"><div align="center"><?php echo 'No Result Found...'; ?></div></td>    
    </tr>
    <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
$( function() {
$( ".datepicker" ).datepicker({ 
dateFormat: 'dd-mm-yy',
});
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
<!--search filter-->
<script>
function searchingName(){
    var name = $("#bname").val().toLowerCase();
    $("#tablesearch tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
    });
}
</script>
