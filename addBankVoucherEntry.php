<?php
// get url
include 'inc.php';
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");

//insert bank voucher entry
if(isset($_POST['addbranchinfo'])){
logger($InfoMessage." Data Save .." );

$filename = $_FILES['attachment']['name'];
$file_tmp_name = $_FILES['attachment']['tmp_name'];

$path = "uploads/";
//$url = "".$serverurlapi."FronEnd/";
logger("****** upload path ****** :".$path);
$path = $path.basename( $_FILES['attachment']['name']);
move_uploaded_file($file_tmp_name, $path);

$jsonData = array(
         "branchAc" => trim($_POST['branchAc']),
		 "paymentType" => trim($_POST['paymentType']),
		 "bankAc" => trim($_POST['bankAc']),
		 "credit" => trim($_POST['credit']),
		 "chequeNo" => trim($_POST['chequeNo']),
		 "chequeDate" => date('Y-m-d',strtotime($_POST['chequeDate'])),
		 "bankName" => trim($_POST['bankName']),
		 "narration" => trim($_POST['narration']),
		 "religareBankName" => trim($_POST['religareBankName']),
		 "status" => trim($_POST['status']),
		 "attachment" => trim($filename),
		 // "productType" => trim($_POST['productType']),
		 "addedBy" => trim($_POST['addedBy'])
   );

$insertData = http_build_query($jsonData);

$url = $serverurlapi."vouchers/addBranchRechargeAPI.php";
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

logger($InfoMessage." Saving addBranchRechargeAPI.. ".$resultData );
$_SESSION['error']=$resultData;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Bank Voucher Entry</title>
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
  <div class="hk-pg-wrapper"  style="padding: 30px;">
    <?php if(isset($_SESSION['error'])!=''){ ?>
    <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
      <!-- Success Alert -->
      <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;margin-top: 25px"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    </div>
    <?php } ?>
    <hr class="dot-row">
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-2">
            <h6>Branch A/c<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
            <!--<select class="inp-w ui-select wd-tr" name="branchAc" id="branchAc" >
                    <option value="">Select</option>
                    <?php
					// $url = $serverurlapi."General/branchinfoList.php";
					// $ch = curl_init();
					// curl_setopt($ch, CURLOPT_URL, $url);
					// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// $stateresult = curl_exec($ch);
					// $stateData = json_decode($stateresult, true);
					// curl_close($ch);
					// if(isset($stateData['branchlist'])){
					// foreach($stateData['branchlist'] as $stateList){
					// if(trim($stateList['BranchCode'])!=''){
					 ?>
                    <option value="<?php // echo trim($stateList['BranchCode']); ?>" ><?php // echo trim($stateList['BranchCode']); ?> - <?php // echo $stateList['Name']; ?></option>
                    <?php
					// }
					// }
					// }
					?>
                  </select>-->
            <input type="text" name="branchAc" id="branchAc"  class="inp-t" value="">
          </div>
          <div class="col-md-2">
            <h6>Payment&nbsp;Type<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
            <select class="inp-w ui-select wd-tr" name="paymentType" id="paymentType" >
			  <option value="">Select</option>
              <option value="Cheque" >Cheque</option>
              <option value="Online" >Online</option>
			  <option value="Direct" >Direct</option>
			  <option value="Cash" >Cash</option>
            </select>
          </div>
          <div class="col-md-2">
            <h6>Bank&nbsp;A/c<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
            <input type="text" name="bankAc" id="bankAc"  class="inp-t" value="">
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
        	<div class="col-md-2">
            <h6>Bank&nbsp;Name</h6>
          </div>
          <div class="col-md-2">
            <input type="text" name="bankName" id="bankName" class="inp-t newdate" value="">
          </div>
          <div class="col-md-2">
            <h6>Cheque&nbsp;Number</h6>
          </div>
          <div class="col-md-2">
            <input type="text" name="chequeNo" id="chequeNo" class="inp-t newdate" value="" >
          </div>
          <div class="col-md-2">
            <h6>Cheque&nbsp;Date</h6>
          </div>
          <div class="col-md-2">
            <input type="text" name="chequeDate" id="chequeDate"  class="inp-t newdate datepicker" value="" readonly="readonly">
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-2">
            <h6>Amount<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
            <input type="text" name="credit" id="credit"  class="inp-t" value="">
          </div>
          <div class="col-md-2">
            <h6>Company&nbsp;Bank&nbsp;Name</h6>
          </div>
          <div class="col-md-2">
          	<select class="inp-w ui-select wd-tr" name="religareBankName" id="religareBankName" required>
              <option value="">Select</option>
			 <?php
       $jsonData = '{
        "AccountName":"",
        "GroupId":"",
        "Status":"1"
      }';
			$result = postCurlData($serverurlapi."masters/accountNameAPI.php",$jsonData);
      //logger('data return: '.$result);
			$accountNameData = json_decode($result, true);
			if(isset($accountNameData['status'])=='true'){
			if(isset($accountNameData['AccountNameData'])){
			$no=1;
			foreach($accountNameData['AccountNameData'] as $resultList){
				//if($resultList['SubGroupId'] == 3){
			?>
            <option value="<?php echo $resultList['Id']; ?>" <?php if($resultList['Id']==$editresult['religareBankName']){ echo "selected"; }?>><?php echo $resultList['AccountName']; ?></option>
			<?php } //}
    }
    } ?>
            </select>
           </div>
           <div class="col-md-2">
            <h6>Attachement</h6>
          </div>
          <div class="col-md-2">
            <input type="file" name="attachment" id="attachment"  class="inp-t newdate" value="" >
          </div>
          <!-- <div class="col-md-2">
            <h6>Product Type<span class="mandat">*</span></h6>
          </div> -->
          <!-- <div class="col-md-2"> -->
		  <!-- <select class="inp-w ui-select wd-tr" name="productType" id="productType" required> -->
              <!-- <option value="">Select</option> -->
			 <?php
			// $result = postCurlData($serverurlapi."General/productinfoList.php","");
			// $regionData = json_decode($result, true);
			// if(isset($regionData['status'])=='true'){
			// if(isset($regionData['productlist'])){
			// $no=1;
			// foreach($regionData['productlist'] as $resultList){
			?>
            <!-- <option value="<?php // echo $resultList['Id']; ?>" <?php // if($resultList['ProductType']==$editresult['ProductId']){ echo "selected"; }?>><?php // echo $resultList['ProductType']; ?></option> -->
			<?php // } } } ?>
            <!-- </select> -->

          <!-- </div> -->
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-2">
            <h6>Narration<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
            <textarea name="narration" id="narration"  class="inp-t newdate" rows="3"></textarea>
          </div>
          <div class="col-md-2">
            <h6>Status<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
            <select class="inp-w ui-select wd-tr" name="status" id="status" >
              <option value="0">Active</option>
            </select>
          </div>
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
