<?php 
// get url
include 'inc.php';
include "logincheck.php";

//Add user
if($_POST['action']=='createfield'){
$insertData = '{
		"id":"'.trim($_POST['EditId']).'",
		"branchcode":"'.trim($_POST['BranchCode']).'",
		"vendorcode":"'.trim($_POST['VendorCode']).'"
	}';
logger("JSON TO POST FOR MAPPING - ".$insertData); 
//use curl method
$ch = curl_init();
$url = $serverurlapi."General/VendorMappingMasterAPI.php";

logger("URL HIT FOR MAPPING - ".$url); 


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$resultData = curl_exec($ch);
logger("RESPONSE RETUR FROM MAPPING - ".$resultData); 
curl_close($ch);
$resultDataArr = json_decode($resultData);
$_SESSION['error']=$resultDataArr->Message;
}

$url = $serverurlapi."General/vendorBranchList.php";
//logger($InfoMessage." URL for API - ".$searching); 
$searching = '{
				"Type" : "Vendor",
        		"Id" : "'.$_GET['branchCode'].'"
			}';
logger('Vendor mapping :'.$url.'---'.$searching);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$listDataMapping = curl_exec($ch);
logger('Response return: '.$listDataMapping);
curl_close($ch);
$DataMappingArr = json_decode($listDataMapping);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Vendor Mapping</title>
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
			<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
				 <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		  </div>
    <?php } ?>
	<form action="" method="post" />
	  <div class="form-group row">
	  		<label for="ProductType" class="col-sm-2 col-form-label">Branch Code:</label>
		<div class="col-sm-4">
		  <input type="text" style="background: #e1dede;" readonly="readonly" class="form-control" name="BranchCode" id="BranchCode" value="<?php echo $_GET['branchCode']; ?>">
		</div>
		<label for="FormType" class="col-sm-2 col-form-label">Vendor:</label>
		<div class="col-sm-4">
		  <select name="VendorCode" class="form-control" required>
		  	<option value="">Select</option>
			<?php
			$searching1 = ""; 
			$url = $serverurlapi."General/vendorinfoList.php";
			logger($InfoMessage." URL for API - ".$url); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$searching1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			$vendorData = json_decode($result);
			curl_close($ch);
			if($vendorData->status='true'){
			foreach($vendorData->vendorlist as $vendorList){
			?>
			<option value="<?php echo $vendorList->BranchCode; ?>" <?php if($vendorList->BranchCode==$_GET['VendorCode']){ echo 'selected'; }?> ><?php echo $vendorList->Name.' ['.$vendorList->BranchCode.']' ?></option>
			<?php } } ?>
		  </select>
		</div>
      </div>
	  
	 <div class="row">
	    <div class="col">
		</div>
		<div class="col">
		</div>
		<div class="col">
		</div>
		<div class="col">
		<div class="">
		  <input type="hidden" name="action" value="createfield">
		  <input type="hidden" name="EditId" value="<?php echo $_GET['editId']; ?>">
		  <input type="submit" name="addField" class="browsebutton" id="usersubmit" value="Save">
		</div>
		</div>
		<div class="col">
		<div class="">
		  <input type="button" onClick="window.location.href='listbranch.php'" class="browsebutton" value="Exit">
		</div>
		</div>
	  </div>	 
	</form>
	</div>  
	
      <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th width="10%">S.No</th>
              <th width="40%">Branch&nbsp;Code</th>
              <th width="15%">Vendor&nbsp;Code</th>
              <th width="35%">Action</th>
            </tr>
          </thead>
          <tbody>
        <?php
		if($DataMappingArr!=''){									 
		$no=1;
		foreach($DataMappingArr->List as $fieldList){
		?>
            <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php echo $_GET['branchCode']; ?></td>
              <td><?php echo $fieldList->ListCode; ?></td>
              <td><div class=""> <a style="border: 1px solid #6db41e;padding: 3px 20px;border-radius: 5px;background: #6db41e;color: white;" href="addVendorMapping.php?branchCode=<?php echo $_GET['branchCode']; ?>&editId=<?php echo $fieldList->Id; ?>&VendorCode=<?php echo $fieldList->ListCode; ?>" >Edit</a></div></td>
            </tr>
            <?php
		$no++;} 
		}else{
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
