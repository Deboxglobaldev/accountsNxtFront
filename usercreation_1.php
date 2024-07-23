<?php 
// get url
include 'inc.php';

//update user
if(isset($_GET['editId'])!='')
{
$url = "".$serverurlapi."General/createuser.php?editId=".$_GET['editId']."";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$editresult = json_decode($result, true);
curl_close($ch);
}
//view user list
$url = "".$serverurlapi."General/createuser.php?status=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$userData = json_decode($result, true);
curl_close($ch)

?>
<?php 
//insert branch information
if(isset($_POST['adduser']) && $_POST['action']!=''){
$formData = array(
         'action' => $_POST['action'],
		 'type' => $_POST['type'],
		 'editId' => $_POST['editId'],
         'BranchId' => $_POST['BranchId'],
		 'Role' => $_POST['Role'],
		 'UserId' => $_POST['UserId'],
		 'Email' => $_POST['Email'],
		 'FirstName' => $_POST['FirstName'],
		 'LastName' => $_POST['LastName'],
		 'InitialPassword' => $_POST['InitialPassword'],
		 'Status' => $_POST['Status']
   );
$insertData = http_build_query($formData);
//use curl method
$ch = curl_init();
$url = "".$serverurlapi."General/createuser.php";
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
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>PAN Dashboard</title>
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
	<div class="container" style="margin-bottom: 37px; margin-top: 32px;padding-left: 20px; padding-right: 20px;">
	 <form action="usercreation.php?branchCode=<?php echo $_GET['branchCode']; ?>&type=branch" method="post" />
	  <div class="form-group row">
		<label for="staticEmail" class="col-sm-2 col-form-label">Branch&nbsp;ID :</label>
		<div class="col-sm-4">
		  <input type="text" readonly class="form-control-plaintext" value="<?php echo $_GET['branchCode']; ?>">
		  <input type="hidden" name="BranchId" value="<?php echo $_GET['branchCode']; ?>" />
		</div>
		<label for="staticRole" class="col-sm-2 col-form-label">Role :</label>
		<div class="col-sm-4">
		  <?php 
		    //get region master
			$url = "".$serverurlapi."General/userRole.php";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$uroleresult = curl_exec($ch);
			$userrole = json_decode($uroleresult, true);
			curl_close($ch);
		   ?>
			<select class="form-control" name="Role" required>
			  <option value="">Select</option>
			  <?php 
			  if(isset($userrole['List']))
			  {
				foreach($userrole['List'] as $userRole)
				{ ?>
				  <option value="<?php echo $userRole['Code']; ?>"<?php if($editresult['Role']==$userRole['Code']){?>selected="selected"<?php } ?>><?php echo $userRole['Name']; ?></option>
				<?php }
			  }
			  ?>
			</select>
		</div>
      </div>
	  <div class="form-group row">
		<label for="UserId" class="col-sm-2 col-form-label">User&nbsp;ID :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="UserId" id="UserId" value="<?php echo $editresult['UserId']; ?>">
		  <p id="useridcheck"></p>
		</div>
		<label for="staticEmail" class="col-sm-2 col-form-label">Email :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="Email" id="Email" value="<?php echo $editresult['Email']; ?>">
		  <p id="useremailcheck"></p>
		</div>
      </div>
	  <div class="form-group row">
		<label for="FirstName" class="col-sm-2 col-form-label">First&nbsp;Name :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="FirstName" id="FirstName" value="<?php echo $editresult['FirstName']; ?>">
		  <p id="firstnamecheck"></p>
		</div>
		<label for="LastName" class="col-sm-2 col-form-label">Last&nbsp;Name :</label>
		<div class="col-sm-4">
		  <input type="text" class="form-control" name="LastName" value="<?php echo $editresult['LastName']; ?>">
		</div>
      </div>
	  <div class="form-group row">
		<label for="InitinalPassword" class="col-sm-2 col-form-label">Initial&nbsp;Password :</label>
		<div class="col-sm-4">
		  <input type="password" class="form-control" name="InitialPassword" id="InitialPassword" value="<?php echo $editresult['InitialPassword']; ?>">
		  <p id="passwordcheck"></p>
		</div>
		<label for="RetypePassword" class="col-sm-2 col-form-label">Retype&nbsp;Password :</label>
		<div class="col-sm-4">
		  <input type="password" class="form-control" name="RetypePassword" id="RetypePassword" value="<?php echo $editresult['RetypePassword']; ?>">
		  <p id="cpasswordcheck"></p>
		</div>
      </div>
	 <div class="row">
	    <div class="col">
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" id="active" name="Status" value="1" required>
		  <label class="form-check-label" for="inlineRadio1">Active</label>
		</div>
		</div>
		<div class="col">
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" id="locked" name="Status" value="2">
		  <label class="form-check-label" for="inlineRadio2">Locked</label>
		</div>
		</div>
		<div class="col">
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" id="in-active" name="Status" value="3">
		  <label class="form-check-label" for="inlineRadio3">In-active</label>
		</div>
		</div>
		<div class="col">
		<div class="">
		  <input type="hidden" name="action" value="userCreation">
		  <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
		  <input type="hidden" name="editId" value="<?php echo $editresult['Id']; ?>">
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
              <th>userId</th>
              <th>Role</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
            <?php
		if(isset($userData['status'])=='true'){	
		if(isset($userData['userlist'])!=''){									 
		$no=1;
		foreach($userData['userlist'] as $resultList){
		?>
            <tr class="uyt hgte">
              <td width="20%"><?php echo $resultList['UserId']; ?></td>
              <td width="20%"><?php echo $resultList['Role']; ?></td>
              <td width="20%"><?php echo $resultList['Email']; ?></td>
              <td width="20%"><?php if($resultList['Status']==1){echo 'Active';}elseif($resultList['Status']==2){echo 'Locked';}elseif($resultList['Status']==3){echo 'In-active';} ?></td>
              <td width="20%"><div class="gvre"> <a href="usercreation.php?editId=<?php echo $resultList['Id']; ?>&branchCode=<?php echo $resultList['BranchId']; ?>" class="btn btn-default editbutton">Edit</a>
                </div></td>
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
