<?php 
// get url
include 'inc.php';
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");


//insert vendor information
if(isset($_POST['addcommissioninfo'])){
logger($InfoMessage." Data Save .." );

$formData = array(
		 'fromDate' => $_POST['fromDate'],
		 'toDate' => $_POST['toDate'],
		 'Status' => $_POST['Status'],
     'Amount' => $_POST['Amount'],
     // 'Type' => $_POST['Type'],
     'Days' => $_POST['days'],
     'AppFrom' => $_POST['AppFrom'],
     // 'minAmt' => $_POST['MinAmount'],
     // 'maxAmt' => $_POST['MaxAmount'],
     'UserId' => $_SESSION['UID'],
     'commissionType' => $_POST['commissionType']
		 
   );
$insertData = http_build_query($formData);
logger($InfoMessage." Saving Data as  .. ".$insertData );
//use curl method
$ch = curl_init();
$url = "".$serverurlapi."General/addcommissionbasicInfo.php";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Commission Validity</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
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
    <section style="margin:10px;">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <div class="input-grid">
                  <h6>From Date</h6>
                  <input type="text" autocomplete="off" name="fromDate" id="fromDate" readonly required class="inp-t datepicker" value="<?php echo $commissionData['fromDate']; ?>">
                </div>
              </div>
			  <div class="col-md-4">
                <div class="input-grid">
                  <h6>To Date</h6>
                   <input type="text" autocomplete="off" name="toDate" id="toDate" readonly required class="inp-t datepicker" value="<?php echo $commissionData['toDate']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-grid">
                  <h6>Commission&nbsp;Type</h6>
                  <select onchange="changeField(this.value);" class="inp-t" name="commissionType">
					  <option value="">Select</option>
					  <option value="Acceptance" <?php if($commissionData['commissionType']=='A'){?>selected="selected"<?php } ?>>Acceptance</option>
					  <option value="Digitization" <?php if($commissionData['commissionType']=='D'){?>selected="selected"<?php } ?>>Digitization</option>
					  <option value="Incentive" <?php if($commissionData['commissionType']=='I'){?>selected="selected"<?php } ?>>Incentive</option>
            <option value="eReturn" <?php if($commissionData['commissionType']=='eReturn'){?>selected="selected"<?php } ?>>eReturn</option>
					</select>
                </div>
              </div>
              <div class="col-md-4" style="display: none;">
                <div class="input-grid">
                  <h6>Type</h6>
                  <select class="inp-t" name="Type">
            <option value="1" <?php if($commissionData['Type']=='1'){?>selected="selected"<?php } ?>>Fixed</option>
            <option value="2" <?php if($commissionData['Type']=='2'){?>selected="selected"<?php } ?>>Percentage</option>
          </select>
                </div>
              </div>
              <div class="col-md-4" id="eReturnShow" style="display: none;">
                <div class="input-grid">
                  <h6>App. From/To</h6>
                    <select class="inp-t" name="AppFrom">
                      <option value="">Select</option>
            <option value="< 100" <?php if($commissionData['AppFrom']=='1'){?>selected="selected"<?php } ?>>Less than 100</option>
            <option value="100-1000" <?php if($commissionData['AppFrom']=='2'){?>selected="selected"<?php } ?>>100-1000</option>
            <option value="> 1000" <?php if($commissionData['AppFrom']=='2'){?>selected="selected"<?php } ?>>Above 1000</option>
          </select>
                </div>
              </div>
              <div class="col-md-4" id="panShow">
                <div class="input-grid">
                  <h6>Validity (in Days)</h6>
                   <input type="number" autocomplete="off" name="days" id="days" required class="inp-t" value="<?php echo $commissionData['Days']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-grid">
                  <h6>Amount</h6>
                   <input type="number" autocomplete="off" name="Amount" id="Amount" required class="inp-t" value="<?php echo $commissionData['Amount']; ?>">
                </div>
              </div>
              <div class="col-md-4" style="display:none">
                <div class="input-grid">
                  <h6>Min Amount</h6>
                   <input type="number" autocomplete="off" name="MinAmount" id="MinAmount" required class="inp-t" value="<?php echo $commissionData['MinAmount']; ?>">
                </div>
              </div>
              <div class="col-md-4"  style="display:none">
                <div class="input-grid">
                  <h6>Max Amount</h6>
                   <input type="number" autocomplete="off" name="MaxAmount" id="MaxAmount" required class="inp-t" value="<?php echo $commissionData['MaxAmount']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-grid">
                  <h6>Status</h6>
                  <select name="Status" id="Status" class="inp-w ui-select wd-tr">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="dot-row">
    </section>
    <section>
      <div class="nxrt full-bd" style="width: fit-content;">
        <!-- <input type="hidden" name="editId" value="<?php // echo $commissionData['Id']; ?>" /> -->
        <input type="submit" name="addcommissioninfo" id="btnsubmit" class="next" value="Save">
        <input type="button" onClick="window.location.href='commissionValidity.php'" class="next" value="Exit">
      </div>
    </section>
  </div>
  </form>
</div>
</div>
<script>
$( function() {
$( ".datepicker" ).datepicker({ 
dateFormat: 'dd-mm-yy',
});
} );

function changeField(e){
if(e == "eReturn"){
$("#eReturnShow").show();
$("#panShow").hide();
}else{
$("#eReturnShow").hide();
$("#panShow").show();
}
}

</script>
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