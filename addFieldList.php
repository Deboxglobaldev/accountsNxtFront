<?php 
// get url
include 'inc.php';
include "logincheck.php";
//update user
if($_GET['editId'] !='')
{
$url = "".$serverurlapi."General/createfield.php?status=0&editId=".$_GET['editId']."";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$editresult = json_decode($result, true);
curl_close($ch);
}

if($_GET['product'] !=''){
	$ProductType = $_GET['product'];
}else{
	$ProductType = $editresult['ProductType'];
}
if($_GET['form'] !=''){
	$FormType = $_GET['form'];
}else{
	$FormType = $editresult['FormType'];
}


$ProductTypeq = "'".$_GET['product']."'";
$FormTypeq = "'".$_GET['form']."'";

$searching = '{"ProductType":"'.$ProductTypeq.'","FormType":"'.$FormTypeq.'"}';

  $url = "".$serverurlapi."General/rejectioninfoList.php";
  logger($InfoMessage." URL for API - ".$searching); 

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $rejectionresult = curl_exec($ch);
	$rejectionData = json_decode($rejectionresult, true);
	$rejectionDataq = $rejectionData['Rejectionlist'];
	$rejectionDataqq = $rejectionDataq[0];
	$rejectionDataqqq = $rejectionDataqq['FieldList'];
  curl_close($ch);
?>
<?php 
//create product 
if(isset($_POST['addField']) && $_POST['action']!=''){
$formData = array(
         'action' => $_POST['action'],
		 'editId' => $_POST['editId'],
		 'ProductType' => $_POST['ProductType'],
		 'FormType' => $_POST['FormType'],
		 'Status' => $_POST['Status'],
		 'FieldName' => $_POST['FieldName']
   );
$insertData = http_build_query($formData);
//use curl method
$ch = curl_init();
$url = $serverurlapi."General/createfield.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultData = curl_exec($ch);
curl_close($ch);
logger('Reponse from rejection save:'.$resultData);
$_SESSION['error']=$resultData;
?>
<script>
window.location.href = 'addFieldList.php?editId=<?php echo trim($_POST['editId']); ?>&product=<?php echo $_POST['ProductType']; ?>&form=<?php echo $_POST['FormType']; ?>'; 
</script>
<?php

}
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add/Edit Rejection</title>
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
	<?php if($resultData!=''){ ?>
		  <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;"> 
			<!-- Success Alert -->
			<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
				 <?php echo $resultData; unset($_SESSION['error']); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		  </div>
    <?php } ?>
	<form action="" method="post" />
	  <div class="form-group row">
	  		<label for="ProductType" class="col-sm-2 col-form-label">Product Type:</label>
		<div class="col-sm-4">
		  <input type="text" style="border: none;" readonly="readonly" class="form-control" name="ProductType" id="ProductType" value="<?php echo $ProductType; ?>">
		</div>
		<label for="FormType" class="col-sm-2 col-form-label">Form Type :</label>
		<div class="col-sm-4">
		  <input type="text" style="border: none;" readonly="readonly" class="form-control"  name="FormType" id="FormType" value="<?php echo $FormType; ?>">
		</div>
      </div>
	  <div class="form-group row">
		<label for="FieldName" class="col-sm-2 col-form-label">FieldName :</label>
		<div class="col-sm-4">
		  <input type="text" autocomplete="off" class="form-control" name="FieldName" id="FieldName" value="<?php echo $editresult['FieldName']; ?>" required />
		</div>
		<label for="Status" class="col-sm-2 col-form-label">Status :</label>
		<div class="col-sm-4">
		  <select class="inp-w ui-select wd-tr" id="Status" name="Status">
		  	<option value="1" <?php if($editresult['Status']=="1" ){?>selected="selected"<?php } ?>>Active</option>
		  	<option value="0" <?php if($editresult['Status']=="0" ){?>selected="selected"<?php } ?>>Inactive</option>
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
		  <input type="hidden" name="editId" value="<?php echo $editresult['id']; ?>">
		  <input type="submit" name="addField" class="browsebutton" id="usersubmit" value="Save">
		</div>
		</div>
		<div class="col">
		<div class="">
		  <input type="button" onClick="window.location.href='listrejectionreason.php'" class="browsebutton" value="Exit">
		</div>
		</div>
	  </div>	 
	</form>
	</div>  
	<?php //if($_GET['editId'] == "" ){ ?>
      <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th width="10%">S.No</th>
              <th width="40%">Field&nbsp;Name</th>
              <th width="15%">Status</th>
              <th width="35%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
	
		if($rejectionDataqqq!=''){									 
		$no=1;
		foreach($rejectionDataqqq as $fieldList){
		?>
            <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php echo $fieldList['FieldName']; ?></td>
              <td><?php if($fieldList['Status'] == '1'){ ?><span style="color:green"><?php echo 'Active'; ?></span><?php }else{ ?><span style="color:red;"> <?php echo 'Inactive'; ?></span><?php } ?></td>
              <td><div class="gvre"> <a style="border: 1px solid #6db41e;padding: 3px 20px;border-radius: 5px;background: #6db41e;color: white;" href="addFieldList.php?editId=<?php echo $fieldList['Masterid']; ?>&product=<?php echo $_GET['product']; ?>&form=<?php echo $_GET['form']; ?>" >Edit</a>
              	<?php if($fieldList['Status'] == '1'){ ?>
              	<a href="#" style="border: 1px solid #6db41e;padding: 3px 20px;border-radius: 5px;background: #6db41e;color: white;" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Add Rejection Reason','modelpop.php?action=addrejectionreason&aid=<?php echo $fieldList['Masterid']; ?>','100%','auto');"> Add Rejection </a>
              <?php } ?>

                </div></td>
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
    <?php //} ?>
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
