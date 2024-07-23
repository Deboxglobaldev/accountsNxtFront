<?php
// get url
include 'inc.php';
include "logincheck.php";
//update user
if(isset($_GET['editId'])!='')
{
$url = $serverurlapi."General/createuserAPI.php?editId=".decode($_GET['editId']);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$editresult1 = json_decode($result, true);
$editresult2 = $editresult1['UserList'];
$editresult = $editresult2[0];
curl_close($ch);
}


//view user list
$url = $serverurlapi."General/createuserAPI.php?CodeId=".decode($_GET['CodeId']);
logger($url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
//logger("Response from user api: ".$result);
$userData = json_decode($result, true);
curl_close($ch)

?>
<?php
//insert vendor information
if(isset($_POST['adduser']) && $_POST['action']!=''){
$formData = array(
         'action' => $_POST['action'],
		 'type' => $_POST['type'],
		 'editId' => $_POST['editId'],
     	 'MasterCode' => $_POST['MasterCode'],
		 'Role' => $_POST['Role'],
		 'UserId' => $_POST['UserId'],
		 'Email' => $_POST['Email'],
		 'FirstName' => $_POST['FirstName'],
		 'LastName' => $_POST['LastName'],
		 'InitialPassword' => $_POST['InitialPassword'],
		 'Status' => $_POST['Status'],
		 'panAssignmentQty' => $_POST['panAssignmentQty']
   );
$insertData = http_build_query($formData);

//use curl method
$ch = curl_init();
$url = $serverurlapi."General/addedituser.php";
logger('add vendor user:'. $url.'---'.$insertData);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
echo $resultData = curl_exec($ch);
logger('RESPONCE USER FROM USER CREATION :'.$resultData);
curl_close($ch);
$_SESSION['error']=$resultData;
//Header('Location: usercreation.php?CodeId='.$_REQUEST['CodeId'].'&type='.$_REQUEST['type']);
//Exit();
}
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>User List</title>
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
  <div class="hk-pg-wrapper" >

    <div class="container" style="margin-bottom: 37px; margin-top: 32px;padding-left: 20px; padding-right: 20px;">
      <form action="usercreation.php?CodeId=<?php echo $_GET['CodeId']; ?>&type=<?php echo trim($_GET['type']); ?>" method="post" >
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">
        <?php
		 if(decode($_GET['type'])=='branch'){ ?>
        Branch ID
        <?php }else if(decode($_GET['type'])=='vendor'){ ?>
        Vendor ID
        <?php }else{ ?>
        User Group ID
        <?php } ?>
        </label>
        <div class="col-sm-4">
          <input type="text" name="MasterCode" style="border: none;color: #59a525;" readonly="readonly" class="form-control" value="<?php echo decode($_GET['CodeId']); ?>">
        </div>
        <label for="staticRole" class="col-sm-2 col-form-label">Role:</label>
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
          <select class="form-control" name="Role" <?php if(trim(decode($_GET['type']))!='housertype'){ ?> required <?php } ?>>
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
      <?php if(decode($_GET['type'])=="vendor"){ ?>
      <div class="form-group row">
        <label for="FirstName" class="col-sm-2 col-form-label">Assignment&nbsp;Qty. :</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" name="panAssignmentQty" id="panAssignmentQty" value="<?php echo $editresult['assignmentQty']; ?>">
          <p id=""></p>
        </div>
      </div>
      <?php } ?>
      <?php if(decode($_GET['type'])=="housertype"){ ?>
      <div class="form-group row"  >
        <label for="FirstName" class="col-sm-2 col-form-label">User&nbsp;Type :</label>
        <div class="col-sm-4">
          <select name="type" class="form-control" onChange="showAssignQty(this.value);">
            <option value="">Select</option>
            <option value="QCP" <?php if($editresult['MasterType']=="QCP"){ echo 'selected'; }?>>QC User</option>
            <option value="QCF" <?php if($editresult['MasterType']=="QCF"){ echo 'selected'; }?>>QC Fulfillment User</option>
            <option value="BCP" <?php if($editresult['MasterType']=="BCP"){ echo 'selected'; }?>>Batch User</option>
            <option value="NSD" <?php if($editresult['MasterType']=="NSD"){ echo 'selected'; }?>>Response User</option>
            <option value="HOUSER" <?php if($editresult['MasterType']=="houser"){ echo 'selected'; }?>>HO User</option>
            <option value="BACKHO" <?php if($editresult['MasterType']=="BACKHO"){ echo 'selected'; }?>>BACKEND HO User</option>
          </select>
          <p id=""></p>
        </div>
        <label for="FirstName" class="col-sm-2 assnQty col-form-label" >Assignment&nbsp;Qty :</label>
        <div class="col-sm-4 assnQty" >
          <input type="number" class="form-control" name="panAssignmentQty" value="<?php echo $editresult['assignmentQty']; ?>">
          <p id=""></p>
        </div>
      </div>
	  <script>
	  function showAssignQty(type){
	  	if(type=="QCP" || type=="QCF"){
			$('.assnQty').show();
		}else{
			$('.assnQty').hide();
		}
	  }
	  showAssignQty('<?php echo $editresult['MasterType']; ?>');
	  </script>
      <?php } ?>
      <div class="form-group row">
        <label for="InitinalPassword" class="col-sm-2 col-form-label">Initial&nbsp;Password :</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" name="InitialPassword" id="InitialPassword" value="<?php if($_GET['editId']!=''){ echo 'debox'; } ?>" required>
          <p id="passwordcheck"></p>
        </div>
        <label for="RetypePassword" class="col-sm-2 col-form-label">Retype&nbsp;Password :</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" name="RetypePassword" id="RetypePassword" value="<?php if($_GET['editId']!=''){ echo 'debox'; } ?>" required>
          <p id="cpasswordcheck"></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-check form-check-inline">
            <input class="form-check-input" <?php if($editresult['Status'] == 1){ echo 'checked'; } ?> type="radio" id="active" name="Status" value="1" required>
            <label class="form-check-label" for="inlineRadio1">Active</label>
          </div>
        </div>
        <div class="col">
          <div class="form-check form-check-inline">
            <input class="form-check-input" <?php if($editresult['Status'] == 2){ echo 'checked'; } ?> type="radio" id="locked" name="Status" value="2">
            <label class="form-check-label" for="inlineRadio2">Locked</label>
          </div>
        </div>
        <div class="col">
          <div class="form-check form-check-inline">
            <input class="form-check-input" <?php if($editresult['Status'] == 3){ echo 'checked'; } ?> type="radio" id="in-active" name="Status" value="3">
            <label class="form-check-label" for="inlineRadio3">In-active</label>
          </div>
        </div>
        <div class="col">
          <div class="">
            <input type="hidden" name="action" value="userCreation">
            <?php if(decode($_GET['type'])!="housertype"){ ?>
            <input type="hidden" name="type" value="<?php echo trim(decode($_GET['type'])) ?>">
            <?php } ?>
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
            <input type="button" onClick="window.location.href='listvendors.php'" class="browsebutton" value="Exit">
          </div>
        </div>
      </div>
      </form>
    </div>
    <div class="container-fluid">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr class="vcx-i hgt">
            <th>User Name</th>
            <th>UserId</th>
            <th>Role</th>
            <th>Email</th>
			      <th>Type</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tablesearch">
          <?php
    if($userData['Status'] =='0'){
    $no=1;
    foreach($userData['UserList'] as $resultList){
    ?>
          <tr class="uyt hgte">
            <td ><?php echo $resultList['FirstName'].' '.$resultList['LastName']; ?></td>
            <td ><?php echo $resultList['UserId']; ?></td>
            <td ><?php echo ($resultList['Role']==1) ? "User 1" : " User 2"; ?></td>
            <td ><?php echo $resultList['Email']; ?></td>
			      <td ><?php echo getUserType(strtoupper($resultList['MasterType'])); ?></td>
            <td ><?php if($resultList['Status']==1){echo 'Active';}elseif($resultList['Status']==2){echo 'Locked';}elseif($resultList['Status']==3){echo 'In-active';} ?></td>
            <td ><div class="gvre"> <a href="usercreation.php?editId=<?php echo encode($resultList['Id']); ?>&CodeId=<?php echo encode($resultList['MasterCode']); ?>&type=<?php if(decode($_GET['type'])=="housertype"){ echo encode("housertype"); }else{ echo encode($resultList['MasterType']); } ?>" class="btn btn-default editbutton" style="width: auto !important;">Edit</a> </div></td>
          </tr>
          <?php
		$no++;} }
		?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/Validator.js"></script>
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
