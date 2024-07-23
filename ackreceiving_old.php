<?php 
// get url
include "inc.php";
session_start();
if($_POST['action']=='gunningaction'){
$receivingDate = $_POST['receivingDate'];
$items = $_POST['items'];

$ackJson = '';
for($i=1; $i<=$items; $i++){
	$ackJson.= '{
		"AcknowledgementNumber":"'.$_POST['ackNumber'.$i].'",
		"ReceivingNumber":"'.$_POST['ReceivingNumber'.$i].'"
	},';
}

$jsonPost = '{
		"BunchNumber":"'.$_POST['BunchNumber'].'",
		"ReceivingDate":"'.date('Y-m-d',strtotime($receivingDate)).'",
		"ListOfACKO":['.rtrim($ackJson,',').']
	}';

	logger("JSON to post Received Ack Number:  ----".$jsonPost);
	$url = $serverurlapi."General/BunchReceivedAPI.php";
	logger("  API hit URL: ". $url); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	logger("Response return from Receiving ack number API: ". $responseData); 
	$dashData = json_decode($responseData);
	//print_r($dashData);
	curl_close($ch);
	
	if($dashData->status==0){
	$location = 'vendorboxallot.php';

	?>
	<script>
	parent.window.location.href = '<?php echo $location; ?>'; 
	</script>
	<?php
	}
}


$searching = '{
		"courier":""
	}';

$url = $serverurlapi."Dashboards/courierDashboard.php";
logger($InfoMessage." URL for API - ".$url); 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$responseData = curl_exec($ch);
logger("Response return from courier list API: ". $responseData); 
$dashData = json_decode($responseData);
curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Courier Receiving</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<style>
.filterCls{
	padding: 2px;
}
table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled) {
    padding-right: 10px !important;
    padding-left: 10px !important;
}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 1px !important;
}
.headline {
    border-bottom: 4px solid #1f7140 !important;
}
.thCls{
	 font-size: 15px;  font-weight: 700; color: #fff;
	 
}
#tableID_length{
 display:none;
}
</style>
<!-- Favicon -->
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);" >
 
    
    <section>
    <div class="container-fluid" >
	  <form  method="POST" name="dataform" id="dataform">
      <!--<div class="row gy-bvc">
	  	<div class="col-md-4">
          <div class="flx">
            <h6 style="font-weight: initial;">Courier&nbsp;Number</h6>
			 <select class="inp-w ui-select" name="courierNumber" id="courierNumber" onChange="checkCourier();">
              <option value="">Select</option>
			<?php
			foreach($dashData->CourierList as $courierNumberData){
			?>
              <option value="<?php echo $courierNumberData->Courier; ?>" <?php if($courierNumberData->Courier==$_GET['courierNumber']){?>selected="selected"<?php } ?> ><?php echo $courierNumberData->Courier; ?></option>
             <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="flx">
            <h6 style="font-weight: initial;">Bunch&nbsp;Number</h6>
          <select class="inp-w ui-select" name="BunchNumber" id="BunchNumber" onChange="checkAckNumber();">
             
         </select>
          </div>
        </div>
      </div>-->
	<!--<div class="row gy-bvc">
		<div class="col-md-4" style="max-width: 25.33%;">
		  <div class="flx">
			<h6 style="font-weight: initial;">From</h6>
			 <input type="number" name="from" id="from" class="form-contrl" value="">
		  </div>
		</div>
		
		<div class="col-md-4" style="max-width: 25.33%;">
		  <div class="flx">
			<h6 style="font-weight: initial;">To</h6>
			 <input type="number" name="to" id="to" class="form-contrl" value="">
		  </div>
		</div>
		
		<div class="col-md-4" style="max-width: 25.33%;">
		  <div class="flx">
			<h6 style="font-weight: initial;">&nbsp;</h6>
			 <buttom class="btn btn-success" >Assign</button>
		  </div>
		</div>
	</div>-->
	
		<div class="row gy-bvc">
			<div class="col-md-4">
			  <div class="flx">
				<h6 style="font-weight: initial;">Acknowledgement#</h6>
				 <input type="number" name="ackNumber" id="ackNumber" class="inp-w ui-select" value="" onBlur="addRowFunc(this.value);">
			  </div>
			</div>
		</div>
	
	  	 <div class="container-fluid" id="data" style=""><span id="loadingspan" style="display:none;">Loading...</span>
			<div class="col-md-12" id="recorddiv">
			<table class="table table-bordered " id="tableID" style="width:100% !important; ">
			  <thead>
				<tr style="background: #fbfbfb;">
				  <td>Acknowledgement Number</td>
				  <td>Receiving Number</td>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2">No Record Found</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
<script>
function addRowFunc(ackno){
	alert(ackno);
	$('#ackNumber').val();
}
</script>	 
      <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
          <div class="">
		  <input class="inp-w" type="hidden" name="receivingDate" value="<?php echo date('d-M-Y'); ?>" id="receivingDate">
			
			<input type="hidden" name="action" value="gunningaction" />
              <input type="submit" name="Search" class="btn btn-default browsebutton pd-button" value="Save" />
            </div>
            <div class="">
              <button type="button" class="btn btn-default browsebutton pd-button">Exit</button>
            </div>
          </div>
        </div>
      </div>
	  </form>
 
<script>
/*function checkCourier(){
	var courierNumber = $('#courierNumber').val();
	$('#BunchNumber').load('loadbunchnumber.php?courierNumber='+courierNumber);
}

function checkAckNumber(){
	var BunchNumber = $('#BunchNumber').val();
	$('#data').load('loadacknumber.php?BunchNumber='+BunchNumber);
	$('#loadingspan').show();
	$('#recorddiv').hide();
}*/
</script>	
	  
      </div>
      </section>
  
     
    </div>
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
<!--search filter-->

