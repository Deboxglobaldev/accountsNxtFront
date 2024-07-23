<?php  
// get url
include 'inc.php';
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");
 
//insert bank voucher entry
if(isset($_POST['addbillinfo'])){
logger($InfoMessage." Data Save .." );

$jsonData = array(
		 "fromDate" => date('Y-m-d',strtotime($_POST['fromDate'])),
		 "toDate" => date('Y-m-d',strtotime($_POST['toDate'])),
		 "commissionDate" => date('Y-m-d',strtotime($_POST['commissionDate'])),
		 "dueDate" => date('Y-m-d',strtotime($_POST['dueDate'])),
		 "addedBy" => trim($_POST['addedBy'])
   );

$insertData = http_build_query($jsonData);

$url = $serverurlapi."General/addCommissionInformationAPI.php";
$ch = curl_init();
logger($InfoMessage." Saving Data URL  .. ".$url );
logger($InfoMessage." Saving Data as  .. ".$insertData );
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$resultData = curl_exec($ch);
logger($InfoMessage." Saving Data API Call Result  .. ".$resultData );
curl_close($ch);

logger($InfoMessage." Saving addCommissionInformationAPI.. ".$resultData );
$_SESSION['error']=$resultData;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Commission Information</title>
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
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
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
          <div class="col-md-3">
            <h5>From&nbsp;Date</h5>
            <input type="text" name="fromDate" id="fromDate"  class="inp-t newdate datepicker" value="" readonly="readonly">
          </div>
          <div class="col-md-3">
            <h5>To&nbsp;Date</h5>
            <input type="text" name="toDate" id="toDate"  class="inp-t newdate datepicker" value="" readonly="readonly">
          </div>
          <div class="col-md-3">
            <h5>Commission&nbsp;Date</h5>
            <input type="text" name="commissionDate" id="commissionDate"  class="inp-t newdate datepicker" value="" readonly="readonly">
          </div>
          <div class="col-md-3">
            <h5>Due&nbsp;Date</h5>
            <input type="text" name="dueDate" id="dueDate"  class="inp-t newdate datepicker" value="" readonly="readonly">
          </div>
        </div>
      </div>
    </section>
    
    <hr class="dot-row">
    <section>
      <div class="nxrt full-bd" style="width: fit-content;">
      	<a href="billInformation.php" style="background: dimgrey;color: white;width: 140px;" class="btn">Back</a>
        <input type="submit" name="addbillinfo" id="btnsubmit" class="next" value="Save">
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
