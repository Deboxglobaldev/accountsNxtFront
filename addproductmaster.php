<?php 
// get url 
include 'inc.php';
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");

if(isset($_GET['editId'])!=''){
logger($InfoMessage."Call for Retrival ");

$url = $serverurlapi."General/productinfoList.php?editId=".decode($_GET['editId'])."";

logger($InfoMessage." Retrival API Call ..".$url );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$regionData = json_decode($result, true);
logger($InfoMessage." JSON Retsult for Data Retrival ..".$regionData );
curl_close($ch);
}

?>
<?php 
//insert vendor information
if(isset($_POST['addregioninfo'])){
logger($InfoMessage." Data Save .." );

$formData = array(
         'editId' => $_POST['editId'],
		 'ProductType' => $_POST['ProductType'],
		 'ProductFullName' => $_POST['ProductFullName'],
		 'Status' => $_POST['Status'],
		 'Charges' => $_POST['Charges'],
		 'InwardCommission' => $_POST['InwardCommission'],
		 'InwardType' => $_POST['InwardType'],
		 'OutwardCommission' => $_POST['OutwardCommission'],
		 'OutwardType' => $_POST['OutwardType']
		 
   );
$insertData = http_build_query($formData);
logger($InfoMessage." Saving Data as  .. ".$insertData );
//use curl method
$ch = curl_init();
$url = "".$serverurlapi."General/addproductbasicInfo.php";
logger($InfoMessage." Saving Data URL  .. ".$url );
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultData = curl_exec($ch);
logger($InfoMessage." Saving Data API Call Result  .. ".$resultData );
//print_r($resultData);die();
curl_close($ch);
$_SESSION['error']=$resultData;
}
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Product</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <form action="" method="post" />
  <div class="hk-pg-wrapper"  style="">
    <?php if(isset($_SESSION['error'])!=''){ ?>
    <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
      <!-- Success Alert -->
      <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    </div>
    <?php } ?>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="form-group row">
		<label for="InwardCommission" class="col-sm-2 col-form-label">Product&nbsp;Name :</label>
		<div class="col-sm-4">
		  <input type="text" autocomplete="off" name="ProductType" id="ProductType" required class="form-control" value="<?php echo $regionData['ProductType']; ?>">
		</div>
		<label for="staticRole" class="col-sm-2 col-form-label">Product Full&nbsp;Name:</label>
		<div class="col-sm-4">
			 <input type="text" autocomplete="off" name="ProductFullName" id="ProductFullName" required class="form-control" value="<?php echo $regionData['ProductFullName']; ?>">
		</div>
      </div>
	  
		
		<div class="form-group row">
		<label for="InwardCommission" class="col-sm-2 col-form-label">Inward&nbsp;Commission :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="InwardCommission" id="InwardCommission" value="<?php echo $editresult['InwardCommission']; ?>">
		</div>
		<label for="staticRole" class="col-sm-2 col-form-label">Inward Type :</label>
		<div class="col-sm-4">
			<select class="form-control" name="InwardType" >
			  <option value="">Select</option>
		      <option value="Fixed"<?php if($editresult['InwardType']=='Fixed'){?>selected="selected"<?php } ?>>Fixed</option>
			</select>
		</div>
      </div>
	  
	  <div class="form-group row">
		<label for="OutwardCommission" class="col-sm-2 col-form-label">Outward&nbsp;Commission :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="OutwardCommission" value="<?php echo $editresult['OutwardCommission']; ?>">
		</div>
		<label for="staticRole" class="col-sm-2 col-form-label">Outward Type :</label>
		<div class="col-sm-4">
			<select class="form-control" name="OutwardType" >
			  <option value="">Select</option>
		      <option value="Fixed"<?php if($editresult['OutwardType']=='Fixed'){?>selected="selected"<?php } ?>>Fixed</option>
			</select>
		</div>
      </div>
	  <div class="form-group row">
		<label for="Charges" class="col-sm-2 col-form-label">Charges :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="Charges" id="Charges" value="<?php echo $editresult['Charges']; ?>">
		</div>
		<label for="Charges" class="col-sm-2 col-form-label">Status :</label>
		<div class="col-sm-4">
		  <select class="form-control" name="Status" id="Status">
		  	<option value="1" <?php if($editresult['Status']=="1"){ echo "selected"; }?>>Active</option>
			<option value="0" <?php if($editresult['Status']=="0"){ echo "selected"; }?>>In-Active</option>
		  </select>
		</div>
      </div>
	  
      </div>
      <hr class="dot-row">
    </section>
    <section>
      <div class="nxrt full-bd" style="width: fit-content;">
        <input type="hidden" name="editId" value="<?php echo $regionData['Id']; ?>" />
        <input type="submit" name="addregioninfo" id="btnsubmit" class="next" value="Save">
        <input type="button" onClick="window.location.href='productMaster.php'" class="next" value="Exit">
      </div>
    </section>
  </div>
  </form>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
<style>
  .jh-mn{
  margin-top: auto;
  margin-bottom: auto;
  }
  .gav th{
  text-align: center;
  }
  .hav td{
  text-align: center;
  }
  .vcx-i{
  border-top: 2px solid;
  border-bottom: 2px solid;
  }
  .addbutton{
  padding: 0%;
  width: 90px;
  color: white;
font-weight: 500;
  background: #6fb71b
  }
  .full-bd{
  padding: 2%;

  }
  .inp-t{
  width: 100%;
  height: 35px;
  outline: none;
  }
  .dot-row{
  border-top: 1px dotted black;
  }
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .ui-select{
    padding: 2%;
  }
  .wd-tr{
    width: 100%;
  }
  .input-grid{
     display: grid;
    grid-gap: 5px;
  }
  </style>
