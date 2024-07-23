<?php  

include 'inc.php';
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");
 
//insert bank voucher entry
if(isset($_POST['addbranchinfo'])){

$no = 0;
$transactionJson = '';
foreach($_POST['accountName'] as $accountRow){
	$transactionJson.= '{
				"AccountName":"'.$_POST['accountName'][$no].'",
				"Debit":"'.$_POST['debit'][$no].'",
				"Narration":"'.$_POST['narration'][$no].'"
			},'; 
	
	
$no++;
}


$jsonData = '{
	"VoucherDate":"'.date('Y-m-d',strtotime($_POST['voucherDate'])).'",
	"EntryDate":"'.date('Y-m-d',strtotime($_POST['voucherEntryDate'])).'",
	"UserId":"'.$_POST['addedBy'].'",
	"ip":"'.$_SERVER["REMOTE_ADDR"].'",
	"BankAccount":"'.$_POST['bankAccount'].'",
	"ListOfTransaction":['.rtrim($transactionJson,',').']
	
}';

$url = $serverurlapi."General/addBankPaymentAPI.php";
$response = postCurlData($url,$jsonData);
$res = json_decode($response,true);


logger($InfoMessage." Saving addBankPaymentAPI.. ".$response);
$_SESSION['error']=$response;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Bank Payment</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>
<!-- Favicon -->
<?php include 'links.php'; ?>
</head>
<body>
	<style>
label {
 color:red;
}
.mandat{
 color:red;
}
.selectize-input{
    border: 1px solid #767676!important;
    border-radius: 2px!important;	
}
</style>
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
		  <div class="col-md-2">
            <h6>Voucher No.</h6>
          </div>
          <div class="col-md-2">
            <input type="text" name="voucherNo" id="voucherNo" class="inp-t newdate" value="Auto Generated" style="background: #f7f7f7;"   readonly >
          </div>
          <div class="col-md-2">
            <h6>Voucher Entry Date<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
           <input type="text" name="voucherEntryDate" id="voucherEntryDate"  class="inp-t" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" required style="background:#f7f7f7;">
          </div>
          <div class="col-md-2">
            <h6>Voucher Date<span class="mandat">*</span></h6>
          </div>
          <div class="col-md-2">
           <input type="text" name="voucherDate" id="voucherDate"  class="inp-t datepicker" required style="background:#f7f7f7;">
          </div>
         <div style="margin-top:20px" class="col-md-2">
         	<h6>Bank Account<span class="mandat">*</span></h6>
          </div>
          <div style="margin-top:20px" class="col-md-2">
			   	<select class="inp-w ui-select wd-tr"  placeholder="Select..." name="bankAccount" required="">
			   			<option></option>
			   			<?php 
			   			$jsonData = '{
					"AccountName":"",
					"GroupId":"LB0004",
					"Status":"1"
				}';
				$newurl = $serverurlapi."General/accountNameAPI.php";
				$resultData = postCurlData($newurl,$jsonData);
				//logger('Response return from account Name API: '.$resultData);
				$accountData = json_decode($resultData);
				if(isset($accountData->status)=='true'){
				if(isset($accountData->AccountNameData)){                    
				foreach($accountData->AccountNameData as $resultList){
					?>
			   	<option value="<?php echo $resultList->Id; ?>"><?php echo $resultList->AccountName; ?></option>
			   	<?php } } }	?>
			   	</select>
          </div>
       </div>
      </div>
    </section>
	
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <table width="100%" border="1" class="table">
			  <tr>
			  	<td align="left"  style="width:8%;"><span style="color:#0000FF; font-weight:600; cursor:pointer;" class="add-row">+Add</span></td>
				<td>Account Name</td>
				<td style="width:17%;">Debit</td>
				<td>Narration</td>
			  </tr>
<?php for($w=1;$w<=5;$w++){?>
			   <tr id="row_<?php echo $w; ?>">
			   	<td>
			   		<?php if($w > 2){	?>
			   		<i class="fa fa-trash" aria-hidden="true" style="color:#FF0000;font-size: 18px;cursor:pointer;" onclick="funDeleteRow(<?php echo $w; ?>);"></i>
           <?php } ?>
			   	</td>
			   	
			   	<td>
			   	<select class="inp-w ui-select wd-tr" name="accountName[]" required="">
			   			<option value=""></option>
			   			<?php 
			   			$jsonData = '{
					"AccountName":"",
					"GroupId":"",
					"Status":"1"
				}';
				$newurl = $serverurlapi."General/accountNameAPI.php";
				$resultData = postCurlData($newurl,$jsonData);
				//logger('Response return from account Name API: '.$resultData);
				$accountData = json_decode($resultData);
				if(isset($accountData->status)=='true'){
				if(isset($accountData->AccountNameData)){                    
				foreach($accountData->AccountNameData as $resultList){
					?>
			   	<option value="<?php echo $resultList->Id; ?>"><?php echo $resultList->AccountName; ?></option>
			   	<?php } } }	?>
			   	</select>
			   </td>

			   	<td><input type="number" name="debit[]" onblur="funcSumValue();" onkeyup="funcDebitEnable(<?php echo $w; ?>);" id="debit_<?php echo $w; ?>" class="debitsum inp-t newdate" value="0" ></td>

			   	<td><input type="text" onfocus="funcCopyNar();" name="narration[]" id="narration_<?php echo $w; ?>" class="inp-t newdate"></td>

			   </tr>
			 <?php } ?>
			  <tr id="commonrow">
			  	<td colspan="5" align="center"></td>
			  </tr>
		</table>
        </div>
      </div>
    </section>
 <script> 

        let rowno = 6; 
        $(document).ready(function () { 
            $(".add-row").click(function () { 
				$('#commonrow').hide();
                rows = "<tr id='row_"+rowno+"'><td><i class='fa fa-trash' aria-hidden='true' style='color:#FF0000;font-size: 18px;cursor:pointer;' onclick='funDeleteRow("+rowno+");'></i></td><td><select class='inp-w ui-select wd-tr' name='accountName[]' required ><option value=''></option><?php 
				$jsonData = '{
					"AccountName":"",
					"GroupId":"",
					"Status":"1"
				}';
				$newurl = $serverurlapi."General/accountNameAPI.php";
				$resultData = postCurlData($newurl,$jsonData);
				//logger('Response return from account Name API: '.$resultData);
				$accountData = json_decode($resultData);
				if(isset($accountData->status)=='true'){
				if(isset($accountData->AccountNameData)){                    
				$no=1;
				foreach($accountData->AccountNameData as $resultList){
				?><option value='<?php echo $resultList->AccountName; ?>'><?php echo $resultList->AccountName; ?></option><?php } } } ?></select></td><td><input type='number' name='debit[]' onkeyup='funcDebitEnable("+rowno+");' onBlur='funcSumValue();' id='debit_"+rowno+"' class='debitsum inp-t newdate' value='0' ></td><td><input type='text' name='narration[]' id='narration_"+rowno+"' class='inp-t newdate'></td></tr>"; 
                tableBody = $("table tbody"); 
                tableBody.append(rows); 
                rowno++; 
            }); 
        }); 
		
		function funDeleteRow(id){
			$('#row_'+id).empty();
		}
		
// 		function funcDebitEnable(rowid){
// var debit = $('#debit_'+rowid).val();
// 			if(debit > 0){
// 				$('#debit_'+rowid).val(0);
// 				$('#debit_'+rowid).val(debit);
// 			}
// 		}

// 			function funcDebitEnable(rowid){
			
// var debit = $('#debit_'+rowid).val();
// 			if(debit > 0){
// 				$('#debit_'+rowid).val(debit);
// 				$('#debit_'+rowid).val(0);
// 			}
// 		}
		
// 		function funcSumValue(){
// 			var totalSumDebit = 0;
// 			var totalSumDebit = 0;
// 			$('.debitsum').each(function () {
// 				totalSumDebit += parseFloat(this.value);
// 			});
			
// 			$('.debitsum').each(function () {
// 				totalSumDebit += parseFloat(this.value);
// 			});			
			
// 			if(totalSumDebit==totalSumDebit){
// 				$('#btnsubmit').show();
// 			}else{
// 				$('#btnsubmit').hide();
// 			}
			  
// 		}

	$("table tr:nth-child(2) td:last-child input").keyup(function(){
  for(var w =0;w < 20;w++){
  $("#narration_"+w).val(this.value);
}
});


	  $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
    </script>    
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
			
		},
		messages :{
		   
		},
		submitHandler: function(form) {
		  form.submit();
		}
	});
});
</script>
