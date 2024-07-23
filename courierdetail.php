<?php 
// get url
include 'inc.php';
include "logincheck.php";
//insert courier information
if(isset($_POST['action'])=='courierdetails'){

$BunchNumber = trim($_POST['BunchNumber']);
$CourierNo = trim($_POST['CourierNo']);
$CourierDate = trim($_POST['CourierDate']);
$CourierAddress = trim($_POST['CourierAddress']);

$insertData = '{
   "ListData":[
      {
         "BunchNumber":"'.$BunchNumber.'",
		 "CourierNo":"'.$CourierNo.'",
		 "CourierDate":"'.$CourierDate.'",
		 "CourierAddress":"'.$CourierAddress.'",
		 "UserId":"'.$_SESSION['UID'].'",
		 "ip":"'.$_SERVER["REMOTE_ADDR"].'"
      }
   ]
}';
//use curl method
$ch = curl_init();
$url = $serverurlapi."General/AddCourierDetailAPI.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$resultData = curl_exec($ch);
$returnData = json_decode($resultData);
curl_close($ch);
$message=$returnData->Message;
}
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Courier Details</title>
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<?php if($returnData->status==0){ ?>
	<h2 style="text-align: center; font-weight: 500; font-size: 17px; color: #79c117;"><?php echo $message; ?></h2>
	<?php  }else{ ?>
	<h2 style="text-align: center; font-weight: 500; font-size: 17px; color: #f73c3c;"><?php echo $message; ?></h2>
	<?php } ?>
	<div class="container" style="margin-bottom: 37px; margin-top: 32px;padding-left: 20px; padding-right: 20px;">
	 <form action="" method="post" />
	  
	  <div class="form-group row">
		<label for="UserId" class="col-sm-2 col-form-label">Bunch&nbsp;Number :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="BunchNumber" id="BunchNumber" value="<?php echo $_GET['bunchNumber']; ?>" readonly />
		  <p id="useridcheck"></p>
		</div>
		<label for="staticEmail" class="col-sm-2 col-form-label">Courier No :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="CourierNo" id="CourierNo" value="" required >
		  <p id="useremailcheck"></p>
		</div>
      </div>
	  <div class="form-group row">
		<label for="FirstName" class="col-sm-2 col-form-label">Courier Date :</label>
		<div class="col-sm-4">
		  <input type="date" class="form-control" name="CourierDate" id="CourierDate" value="" required>
		  <p id="firstnamecheck"></p>
		</div>
		<label for="LastName" class="col-sm-2 col-form-label">Courier Address:</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="CourierAddress" value="" required >
		</div>
      </div>
	  
	  <div class="row">
	    <div class="col">
		<div class="form-check form-check-inline">
		  
		</div>
		</div>
		<div class="col">
		<div class="form-check form-check-inline">
		 
		</div>
		</div>
		<div class="col">
		<div class="form-check form-check-inline">
		 
		</div>
		</div>
		<div class="col">
		<div class="">
		  <input type="hidden" name="action" value="courierdetails">
		   <input type="hidden" name="editId" value="">
		  <input type="submit" name="adduser" class="browsebutton" id="usersubmit" value="Save">
		</div>
		</div>
		<div class="col">
		<div class="">
		  <input type="reset" class="browsebutton" value="Reset">
		</div>
		</div>
		<div class="col">
		<div class="">
		 <input type="button" onClick="window.location.href='docmanagement.php'" class="browsebutton" value="Exit">
		</div>
		</div>
	  </div>
	</form>	 
	</div>
    
  </div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="js/Validator.js"></script>
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
