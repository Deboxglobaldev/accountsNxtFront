<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url); 
if(isset($_POST['Search']))
{
	$searching = array('keyword' => $_POST['Name'],'status' => $_POST['Status']);
}
else
{
  $searching = '';
}
	$url = "".$serverurlapi."General/HOInfoListAPI.php";
	logger($InfoMessage." URL for API - ".$url); 


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 	$result = curl_exec($ch);
	$branchData = json_decode($result, true);
	curl_close($ch);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>HO Management</title>
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
  <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <section>
    <div class="container-fluid">
      <form action="" method="post" />
      <div class="row gy-bvc" style="">
        <div class="col-md-4">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Name</h6>
            <input class="inp-w" type="text" name="Name" value="<?php echo $_POST['Name']; ?>" id="Name">
          </div>
        </div>
        <div class="col-md-2">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Status</h6>
            <select class="inp-w ui-select" name="Status" value="<?php echo $_POST['Status']; ?>" required>
              <option value="1">Active</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="search-input-grid">
            <h6>&nbsp;</h6>
            <div class="search-button">
              <input type="submit" name="Search" class="btn btn-default browsebutton pd-button" value="Search" />
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="search-input-grid">
            <h6>&nbsp;</h6>
            <div class="search-button">
              <button type="reset" class="btn btn-default browsebutton pd-button">Reset</button>
              <!-- <button type="button" class="btn btn-default browsebutton pd-button">Exit</button> -->
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="search-input-grid">
            <h6>&nbsp;</h6>
            <div class="search-button"> <a href="addho.php">
              <button type="button" class="btn btn-default browsebutton pd-btns">Add New&nbsp;HO</button>
              </a> </div>
          </div>
        </div>
      </div>
      </form>
      <!-- <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="addho.php">
              <button type="button" class="btn btn-default browsebutton pd-btns">Add New HO</button>
              </a></div>
          </div>
        </div>
      </div>-->
      </section>
      <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>Name</th>
              <th>Center&nbsp;Type</th>
              
              <th>Status</th>
              <th>Action&nbsp;&&nbsp;Management</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
            <?php
		if(isset($branchData['status'])=='true'){
		if(isset($branchData['HOList'])){										 
		$no=1;
		foreach($branchData['HOList'] as $resultList){
		?>
            <tr class="uyt hgte">
              <td><?php echo $resultList['Name']; ?></td>
              <td><?php if($resultList['CenterType']=='1'){ echo 'HO'; }elseif($resultList['CenterType']=='2'){ echo 'Region Office'; } ; ?></td>
             
              <td><?php if($resultList['Status']==1){echo 'Active';}?></td>
              <td><div class="gvre"> <a href="addho.php?editId=<?php echo $resultList['Id']; ?>" class="btn btn-default branchbtn">Edit</a> <a href="product.php?type=product" class="btn btn-default branchbtn ">Product</a> <a href="usercreation.php?CodeId=<?php echo $resultList['BranchCode']; ?>&type=branch" class="btn btn-default branchbtn ">Users
                  </button>
                  </a> </div></td>
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
