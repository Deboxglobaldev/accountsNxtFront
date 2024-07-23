<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url); 

if(isset($_POST['Search']))
{
	$searching = array('keyword' => $_POST['Name'],'branchcode' => $_POST['BranchCode'],'agentcode' => $_POST['AgentCode'],'status' => $_POST['Status']);
	$url = "".$serverurlapi."General/branchinfoList.php";
	logger($InfoMessage." URL for API - ".$url); 
	logger($InfoMessage." Post data ".$searching); 

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 	$result = curl_exec($ch);
	$branchData = json_decode($result, true);
	curl_close($ch);
}
/*else
{
  $searching = '';
}*/
	


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>All Branch List</title>
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
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="">
    <section>
    <div class="container-fluid">
	  <form action="" method="post" />
      <div class="row gy-bvc" style="">
        <div class="col-md-3">
          <div class="flx">
            <h6 style="font-weight: initial;">Name</h6>
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
            <!--<select class="inp-w ui-select" name="AgentCode" >
              <option value="">Select</option>
              <option value="4"<?php if($_POST['AgentCode']==4){?>selected="selected"<?php } ?>>4</option>
              <option value="5"<?php if($_POST['AgentCode']==5){?>selected="selected"<?php } ?>>5</option>
              <option value="8"<?php if($_POST['AgentCode']==8){?>selected="selected"<?php } ?>>8</option>
            </select>-->
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
	  </form>
      <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="branch1.php">
              <button type="button" class="btn btn-default browsebutton pd-btns">Add New Branch</button>
              </a></div>
          </div>
        </div>
      </div>
      </section>
      <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>Name</th>
              <th>Agent&nbsp;Code</th>
              <th>Branch&nbsp;Code</th>
              <th>Status</th>
              <th>Action&nbsp;&&nbsp;Management</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
        <?php
		if(isset($branchData['status'])=='true'){
		if(isset($branchData['branchlist'])){										 
		$no=1;
		foreach($branchData['branchlist'] as $resultList){
		?>
            <tr class="uyt hgte">
              <td><?php echo $resultList['Name']; ?></td>
              <td><?php echo $resultList['AgentNumber']; ?></td>
              <td><?php echo $resultList['BranchCode']; ?></td>
              <td><?php if($resultList['Status']==1){echo 'Active';}else{ echo 'In-Active'; } ?></td>
              <td><div class="gvre"> <a href="branch1.php?editId=<?php echo encode($resultList['Id']); ?>" class="btn btn-default branchbtn">Edit</a>
                  <a href="product.php?type=<?php echo encode("product"); ?>" class="btn btn-default branchbtn ">Product</a>
                  <a href="usercreation.php?CodeId=<?php echo encode($resultList['BranchCode']); ?>&type=<?php echo encode("branch"); ?>" class="btn btn-default branchbtn ">Users 
                  </a>
				 <!-- <a href="addVendorMapping.php?branchCode=<?php echo $resultList['BranchCode']; ?>" class="btn btn-default branchbtn ">Vendors</a>-->
                </div></td>
            </tr>
            <?php
		$no++;}}}else{?>
		<tr class="uyt hgte">
		<td></td>
		<td></td>
		<td><div align="center"><?php echo 'You Can Search...'; ?></div></td>
		<td></td>
		<td></td>
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
