<?php 
// get url
include "inc.php";
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url); 
if(isset($_POST['Search']))
{
	$searching = array('keyword' => $_POST['Name'],'branchcode' => $_POST['BranchCode'],'status' => $_POST['Status']);
}
else
{
 $searching = ""; 
}


  $url = "".$serverurlapi."General/vendorinfoList.php";
  logger($InfoMessage." URL for API - ".$url); 


  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $result = curl_exec($ch);
  $vendorData = json_decode($result, true);
  curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>All Vendor List</title>
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

        <div class="col-md-4">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Vendor&nbsp;Code</h6>
            <input class="inp-w" type="text" name="BranchCode" value="<?php echo $_POST['BranchCode']; ?>" id="BranchCode">
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="search-input-grid">
          <h6>&nbsp;</h6>
         <div class="search-button">
              <input type="submit" name="Search" class="btn btn-default browsebutton pd-button" value="Search" />
              <button type="reset" class="btn btn-default browsebutton pd-button">Reset</button>
              <!-- <button type="button" class="btn btn-default browsebutton pd-button">Exit</button> -->
          </div>
        </div>
        </div>
      </div>
	  </form>
      <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="addvendor.php">
              <button type="button" class="btn btn-default browsebutton pd-btns">Add New Vendor</button>
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
              <th>Vendor&nbsp;Name</th>
              <th>Vendor&nbsp;Code</th>
              <th>Status</th>
              <th>Action&nbsp;&&nbsp;Management</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
            <?php
		if(isset($vendorData['status'])=='true'){
		if(isset($vendorData['vendorlist'])){										 
		$no=1;
		foreach($vendorData['vendorlist'] as $resultList){
		?>
            <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php echo $resultList['Name']; ?></td>
              <td><?php echo $resultList['BranchCode']; ?></td>
              <td><?php if($resultList['Status']==1){echo 'Active';}else{ echo 'In-Active'; } ?></td>
              <td><div class="gvre"> <a href="addvendor.php?editId=<?php echo encode($resultList['Id']); ?>" class="btn btn-default branchbtn">Edit</a>
                  <a href="product.php?type=<?php echo encode("product"); ?>" class="btn btn-default branchbtn ">Product</a>
                  <a href="usercreation.php?CodeId=<?php echo encode($resultList['BranchCode']); ?>&type=<?php echo encode("vendor"); ?>" class="btn btn-default branchbtn ">Users</button>
                  </a>
				  <!--<a href="vendorbranch.php?vendorId=<?php echo $resultList['BranchCode']; ?>&type=vendor" class="btn btn-default branchbtn ">Branch</button>
                  </a>-->
                </div></td>
            </tr>
            <?php
		$no++;}}}else{?>
		<tr class="uyt hgte">
		<td colspan="4"><div align="center"><?php echo 'You Can Search...'; ?></div></td>
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
  .search-button{
      display: grid;
    grid-template-columns: auto auto;
    grid-gap: 40px;
  }
	.pd-btn{
		padding: 3px 40px;
	}
	.pd-btn2{
		padding: 3px 80px;
	}
	.search-input-grid{
	display: grid;
	grid-gap: 5px;
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
  outline: none;
  padding: 5px 0;
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
