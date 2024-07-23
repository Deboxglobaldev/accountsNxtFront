<?php
// get url
include 'inc.php';

if(isset($_POST['resetpass']) && $_POST['action']=='resetpasswordaction'){
$postData = '{
  "UserId":"'.decode($_POST['uid']).'",
  "password":"'.trim($_POST['confirmpassword']).'"
}';


$url = $serverurlapi."HOOperation/resetpassword.php";
$resultData = postCurlData($url,$postData);
logger('RESPONCE FROM RESET PASSWORD API: '.$resultData);
$resultDataArr = json_decode($resultData, true);
$_SESSION['error']=$resultDataArr['Message'];

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Reset Password</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar" style="background:white;">
 <a tabindex="-1" id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a> <a tabindex="-1" class="navbar-brand" href="home">
   <img class="brand-img d-inline-block" style="width: 185px;" src="img/Religare-Logo.png" alt="brand" /></a>
<style>
.feather-icon svg{
	color:#757575;
}
</style>

</nav>
 <!-- Vertical Nav -->
<nav class="hk-nav hk-nav-light" style="background-color: #71b91b;background-image: linear-gradient(#71b91b,#3e8f30"> <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>

</nav>



  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper" >
  <?php if(isset($_SESSION['error'])!=''){ ?>
		  <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
			<!-- Success Alert -->
			<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
				 <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		  </div>
  <?php } ?>

    <div class="container" style="margin-bottom: 37px; margin-top: 32px;padding-left: 20px; padding-right: 20px;">
      <form action="" method="post">
      <div class="form-group row">
        <label for="UserId" class="col-sm-2 col-form-label">New Password: </label>
        <div class="col-sm-4">
          <input type="password" class="form-control" name="newpassword" id="InitialPassword">
          <p id="passwordcheck"></p>
        </div>
        <label for="staticEmail" class="col-sm-2 col-form-label">Confirm New Password: </label>
        <div class="col-sm-4">
        <input type="password" class="form-control" name="confirmpassword" id="RetypePassword">
          <p id="cpasswordcheck"></p>
        </div>
      </div>

      <div class="row">
      <div class="col">
          <div class="">

          </div>
        </div>
        <div class="col">
          <div class="">

          </div>
        </div>
        <div class="col">
          <div class="">

          </div>
        </div>
        <div class="col">
          <div class="">
            <input type="hidden" name="action" value="resetpasswordaction">

            <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
            <input type="submit" name="resetpass" class="browsebutton" id="resetsubmit" value="Save">
          </div>
        </div>



      </div>
      </form>

    </div>

  </div>
</div>
<script>
$(document).ready(function(){
  $('#resetsubmit').click(function(){
    pass_err = true;
		cpass_err = true;
    password_check();
		cpassword_check();
    if((pass_err = true) && (cpass_err = true)){
		return true;
		}else{
		return false;
		}
  });
});
</script>
<script type="text/javascript" src="js/Validator.js"></script
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
