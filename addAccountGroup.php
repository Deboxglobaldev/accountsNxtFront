<?php
// get url
include 'inc.php';
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");

//insert bank voucher entry
if(isset($_POST['addbranchinfo'])){
logger($InfoMessage." Data Save .." );

$jsonData = '{
		"name" : "'.trim($_POST['name']).'",
		 "accountGroup": "'.trim($_POST['accountGroup']).'"
}';




$url = $serverurlapi."masters/addAccountGroupAPI.php";

$resultData = postCurlData($url,$jsonData);
logger($InfoMessage." Saving addAccountGroupAPI.. ".$resultData );

$responseArr = json_decode($resultData);
$_SESSION['error']=$responseArr->message;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Account Group</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<style>
label {
 color:red;
}
.mandat{
 color:red;
}
</style>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <form action="" method="post" id="branchform" enctype="multipart/form-data"  />
  <div class="hk-pg-wrapper"  style="">
    <?php if(isset($_SESSION['error'])!=''){ ?>
    <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
      <!-- Success Alert -->
      <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    </div>
    <?php } ?>
    <hr class="dot-row">
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-2">
            <h5>Group&nbsp;Name<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-3">
            <input type="text" class="inp-w ui-select wd-tr" name="name" value="" >
          </div>
          <div class="col-md-2">
            <h5>Group Type<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-3">
            <select class="inp-w ui-select wd-tr" name="accountGroup" id="accountGroup" required>
				<option value="1" <?php if($branchData['accountGroup']=='1'){ echo "selected"; } ?>>Assets</option>
				<option value="2" <?php if($branchData['accountGroup']=='2'){ echo "selected"; } ?>>Liability</option>
				<option value="3" <?php if($branchData['accountGroup']=='3'){ echo "selected"; } ?>>Equity</option>
				<option value="4" <?php if($branchData['accountGroup']=='4'){ echo "selected"; } ?>>Income</option>
				<option value="5" <?php if($branchData['accountGroup']=='5'){ echo "selected"; } ?>>Expense</option>
			  </select>
          </div>


        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">

        </div>
      </div>
    </section>
    <hr class="dot-row">
    <section>
      <div class="nxrt full-bd" style="width: fit-content;">
        <input type="submit" name="addbranchinfo" id="btnsubmit" class="next" value="Save">
        <input type="hidden" name="addedBy"  class="inp-t newdate" value="<?php echo $_SESSION["UID"]; ?>" >
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
	width: 37%;
	padding: 0%;
	font-weight: bold;
	background: #6fb71b
	}
	.full-bd{
	padding: 18px;

	}
	.inp-t{
	width: 100%;
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
	</style>
<script>
$( function() {
	//var today = new Date();
	//var tomorrow = new Date();
	$( ".datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy',

	});
});

</script>
<script src="js/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
    $("#branchform").validate({
			onfocusout: function(element) {
           this.element(element);
        },
		rules :{
			paymentType: "required",
			branchAc: "required",
			credit: "required",
			narration: "required",
			productType: "required",
			bankAc: {
				required: true,
				number:true
			}
		},
		messages :{

		},
		submitHandler: function(form) {
		  form.submit();
		}
	});
});
</script>
