<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

$url = $serverurlapi."General/schemeMasterAPI.php";
$jsonPost = '';
$result = postCurlData($url,$jsonPost);
$arrData = json_decode($result, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Commission Charged Schedule</title>
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
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper">

  <?php if($_SESSION['error']!=''){ ?>
    <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px; "
      id="divMsg">
      <!-- Success Alert -->
      <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green; ">
          <span id="msg"><?php echo $_SESSION['error']; unset($_SESSION['error']);  ?></span>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    </div>
  <?php } ?>
    <!-- <div style="background:transparent;">

</div> -->

    <div class="container-fluid">
      
	  <!--<form action="" method="post" />
      <div class="row gy-bvc" style="">
        <div class="col-md-3">
          <div class="flx">
            <h6 style="font-weight: initial;">Name </h6>
            <input class="inp-w" type="text" name="Name" value="<?php echo trim($_POST['Name']); ?>" id="Name">
          </div>
        </div>
        <div class="col-md-3">
          <div class="flx">
            <h6 style="font-weight: initial;">Branch&nbsp;Code</h6>
            <input class="inp-w" type="text" name="BranchCode" id="BranchCode" value="<?php echo trim($_POST['BranchCode']); ?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="flx">
            <h6 style="font-weight: initial;">Agent&nbsp;Code</h6>
			<input class="inp-w" type="text" name="AgentCode" id="AgentCode" value="<?php echo trim($_POST['AgentCode']); ?>">
            
          </div>
        </div>
        <div class="col-md-3">
          <div class="flx">
            <h6 style="font-weight: initial;">Status</h6>
            <select class="inp-w ui-select" name="Status" value="<?php echo $_POST['Status']; ?>" >
				<option value="">All</option>
              <option value="1" <?php if(trim($_POST['Status'])=='1'){?>selected="selected"<?php } ?>>Active</option>
			   <option value="0" <?php if(trim($_POST['Status'])=='0'){?>selected="selected"<?php } ?>>In-Active</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class="">
              <button type="reset" class="btn btn-default browsebutton pd-button">Reset</button>
            </div>
            <div class="">
			
              <input type="submit" name="Search" class="btn btn-default browsebutton pd-button" value="Search" />
            </div>
            <div class="">
              <button type="button" class="btn btn-default browsebutton pd-button">Exit</button>
            </div>
          </div>
        </div>
      </div>
	  </form>-->
      <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> 
              <button type="button" class="btn btn-default browsebutton pd-btns" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Add Charged Schedule','modelpop.php?action=schememaster','100%','auto');">Add New Charged Schedule</button>
              </div>
          </div>
        </div>
      </div>
      
    <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>Charged Schedule Name</th> 
              <th>Status</th>
              <th>Action&nbsp;&nbsp;Management</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
        <?php
		if(isset($arrData['status'])=='true'){
		if(isset($arrData['SchemeData'])){										 
		$no=1;
		foreach($arrData['SchemeData'] as $resultList){
		?>
            <tr class="uyt hgte">
              <td><?php echo $resultList['SchemeName']; ?></td>
              <td><?php if($resultList['Status']==1){echo 'Active';}else{ echo 'In-Active'; } ?></td>
              <td><div class="gvre"> 
                <button class="btn btn-default branchbtn" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Edit Charged Schedule','modelpop.php?action=schememaster&id=<?php echo $resultList['Id']; ?>','100%','auto');">Edit</button>
                <a class="btn btn-default branchbtn" href="schemedata.php?sid=<?php echo encode($resultList['Id']); ?>&schemeName=<?php echo encode($resultList['SchemeName']); ?>" style="width: 45% !important ;">Charged Schedule Data</a>
				      </div>
            </td>
            </tr>
            <?php
		$no++;}}}else{?>
		<tr class="uyt hgte">
		<td colspan="3"><div align="center"><?php echo 'You Can Search...'; ?></div></td>
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
<script>
function searchingName(){
    var name = $("#bname").val().toLowerCase();
    $("#tablesearch tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
    });
}
</script>
