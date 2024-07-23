<?php 
// get url
include 'inc.php';
include "logincheck.php";
//update user
if(isset($_GET['editId'])!='')
{
$url = $serverurlapi."General/createproduct.php?branchCode=".decode($_GET['branchCode'])."&type=".decode($_GET['type'])."&editId=".decode($_GET['editId']);
logger("edit product data list: ".$url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
logger('response return from edit product mapping: '.$result);
$editresult = json_decode($result, true);
curl_close($ch);
}

?>
<?php 
//create product 
if(isset($_POST['addproduct']) && $_POST['action']!=''){
$formData = array(
         'action' => $_POST['action'],
		 'type' => $_POST['type'],
		 'editId' => $_POST['editId'],
		 'ProductType' => $_POST['ProductType'],
		 'status' => $_POST['Status'],
		 'branchCode' => $_POST['branchCode'],
		 'fromDate' => $_POST['fromDate'],
		 'toDate' => $_POST['toDate']
   );
$insertData = http_build_query($formData);
logger($InfoMessage." Saving Data as  .. ".$insertData );
//use curl method
$ch = curl_init();
$url = $serverurlapi."General/createproduct.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultData = curl_exec($ch);
curl_close($ch);
$_SESSION['error']=$resultData;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Product Mapping</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
} );
</script>
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
    <div class="container-fluid" style="margin-bottom: 37px; margin-top: 32px;padding-left: 20px; padding-right: 20px;">
      <?php if(isset($_SESSION['error'])!=''){ ?>
      <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
        <!-- Success Alert -->
        <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      </div>
      <?php } ?>
      <!----------product.php?type=product----------->
      <form action="" method="post" />
      <div class="form-group row">
        <label for="ProductName" class="col-sm-2 col-form-label">Branch&nbsp;Code:</label>
        <div class="col-sm-4">
          <label><strong><?php echo decode($_GET['branchCode']); ?></strong></label>
        </div>
        <label for="ProductName" class="col-sm-2 col-form-label">Product&nbsp;Name :</label>
        <div class="col-sm-4">
          <select class="form-control" name="ProductType" id="ProductType">
            <option value="">Select</option>
			<?php
			$result = postCurlData($serverurlapi."General/productinfoList.php","");
			$regionData = json_decode($result, true);
			if(isset($regionData['status'])=='true'){
			if(isset($regionData['productlist'])){                    
			$no=1;
			foreach($regionData['productlist'] as $resultList){
			?>
            <option value="<?php echo $resultList['Id']; ?>" <?php if($resultList['Id']==$editresult['ProductId']){ echo "selected"; }?>><?php echo $resultList['ProductType']; ?> [<?php echo $resultList['ProductFullName']; ?>]</option>
			<?php } } } ?>
          </select>
        </div>
      </div>
	  <div class="form-group row">
	  	<label for="Charges" class="col-sm-2 col-form-label">From Date :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control datepicker" name="fromDate" id="fromDate" value="<?php echo $editresult['FromDate']; ?>">
		</div>
		<label for="Charges" class="col-sm-2 col-form-label">To Date :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control datepicker" name="toDate" id="toDate" value="<?php echo $editresult['ToDate']; ?>">
		</div>
	  </div>
      <div class="form-group row">
        <label for="Charges" class="col-sm-2 col-form-label">Status :</label>
        <div class="col-sm-4">
          <select class="form-control" name="Status" id="Status">
            <option value="1" <?php if($editresult['Status']=="1"){ echo "selected"; }?>>Active</option>
            <option value="0" <?php if($editresult['Status']=="0"){ echo "selected"; }?>>In-Active</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col"> </div>
        <div class="col"> </div>
        <div class="col"> </div>
        <div class="col">
          <div class="">
            <input type="hidden" name="action" value="createproduct">
            <input type="hidden" name="type" value="<?php echo decode($_GET['type']); ?>">
			<input type="hidden" name="branchCode" value="<?php echo decode($_GET['branchCode']); ?>">
            <input type="hidden" name="editId" value="<?php echo $editresult['Id']; ?>">
            <input type="submit" name="addproduct" class="browsebutton" id="usersubmit" value="Save">
          </div>
        </div>
        <div class="col">
          <div class="">
            <input type="reset" class="browsebutton" value="Reset">
          </div>
        </div>
        <div class="col">
          <div class="">
            <input type="button" class="browsebutton" value="Exit">
          </div>
        </div>
      </div>
      </form>
    </div>
    <div class="container-fluid">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr class="vcx-i hgt">
            <th>Product&nbsp;Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
		<?php
		//view product list
		$result = getCurlData($serverurlapi."General/listproduct.php?branchCode=".decode($_GET['branchCode'])."&type=".decode($_GET['type']));
		logger("response return from product mapping list : ".$result);
		$productData = json_decode($result, true);
		if(isset($productData['status'])=='true'){	
		if(isset($productData['productlist'])!=''){									 
		$no=1;
		foreach($productData['productlist'] as $productList){
		?>
          <tr class="uyt hgte">
            <td><?php 
			if(isset($regionData['status'])=='true'){
			if(isset($regionData['productlist'])){                    
			$no=1;
			foreach($regionData['productlist'] as $resultList){
			if($resultList['Id']==$productList['ProductId']){ echo $resultList['ProductType']; }
			
			} } }
			 ?></td>
            <td><?php  echo ($productList['Status']=="1") ? "Active":"In-Active"; ?></td>
            <td><div class="gvre"> <a href="product.php?branchCode=<?php echo $_GET['branchCode']; ?>&type=<?php echo encode("branch"); ?>&editId=<?php echo encode($productList['Id']); ?>" class="btn btn-default editbutton">Edit</a> </div></td>
          </tr>
          <?php
		$no++;}}}else{
		echo 'no data found';
		}
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
