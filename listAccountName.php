<?php 
// get url 
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

$loginType = strtoupper($_SESSION['Type']);

if($loginType=="BRANCH"){
	$branchCode = $_SESSION["BID"];
}else{
	$branchCode = '';
}




if($_GET['did']!=""){
$jsondelete = '{
	"editId":"'.decode($_GET['did']).'",
	"type":"'.decode($_GET['type']).'"
}';

$branchCode = trim($_GET['branchCode']);
$voucherNo = trim($_GET['voucherNo']);
$productType = trim($_GET['productType']);
  
$url = $serverurlapi."General/editDeleteRechargeAPI.php";
$resultData = postCurlData($url,$jsondelete);
//logger('Response return from listBranchRechargeAPI: '.$resultData);
}


if($_GET['action']=="searchaction"){

$AccountName = trim($_GET['AccountName']);
$GroupName = trim($_GET['GroupId']);
$Status = trim($_GET['Status']);
  
$jsonData = '{
  	"AccountName":"'.$AccountName.'",
    "GroupId":"'.$GroupName.'",
	"Status":"'.$Status.'"
}';

$newurl = $serverurlapi."General/accountNameAPI.php";
$resultData = postCurlData($newurl,$jsonData);
logger('Response return from account Name API: '.$resultData);
$accountData = json_decode($resultData);

}






?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>List Account</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
} );
</script>
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  	<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  	<div class="hk-pg-wrapper"  style="">
  		<div class="container-fluid">
      <form action="" method="GET" autocomplete="nope" id="exportfrm"  />
	   
        <div class="row gy-bvc">
		
        <div class="col-md-4">
          <div >
          <h6 style="font-weight: initial;">Account Name</h6>
           <input type="text" name="AccountName" class="inp-w ui-select" value="<?php echo $_GET['AccountName']; ?>"  autocomplete="off" />
          </div>
        </div>
         <div class="col-md-3">
          <div >
          <h6 style="font-weight: initial;">Group Name</h6>
           <select class="inp-w ui-select" name="GroupId" >
				<option value="">All</option>
				<?php 
				$jsonDataaa = '';
				$resultDatass = postCurlData($serverurlapi."General/accountSubGroupAPI.php",$jsonDataaa);
				$accountDataaa = json_decode($resultDatass);
				if(isset($accountDataaa->status)=='true'){
				if(isset($accountDataaa->AccountSubGroupData)){                    
				$no=1;
				foreach($accountDataaa->AccountSubGroupData as $resultListdata){
				?>
				<option value="<?php echo $resultListdata->Id; ?>" <?php if($resultListdata->Id==$_GET['GroupId']){ echo "selected";} ?>><?php echo $resultListdata->Name; ?></option>
				<?php } } } ?>
            </select>
          </div>
        </div>
		 <div class="col-md-3">
          <div >
          <h6 style="font-weight: initial;">Status</h6>
           <select class="inp-w ui-select" name="Status" >
				<option value="">All</option>
				<option value="1" <?php if($_GET['Status']=="1"){ echo "selected";} ?>>Active</option>
				<option value="0" <?php if($_GET['Status']=="0"){ echo "selected";} ?>>In-Active</option>
            </select>
          </div>
        </div>
		<div class="col-md-2">
          <div>
            <h6>&nbsp;</h6>
          <input type="hidden" id="action" name="action" value="searchaction" />
          <input type="submit" name="Search" class="inp-w ui-select btn btn-success" value="Search" />
          </div>
        </div>
		
		</div>
      </form>
	  <div class="row gy-bvc nn-mb">
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="addAccountName.php">
              <button type="button" class="btn btn-default browsebutton pd-btns">Add Account</button>
              </a></div>
          </div>
        </div>
      </div>
	 
    </div>
    
		<div class="container-fluid" style="margin-top:20px">
		<div id="tabledata" style="padding: 10px;"> 
	<?php  if(isset($_SESSION['error'])!=''){ ?>
	<div class="bs-example" id="messageDiv">
	<!-- Success Alert -->
	<div class="alert alert-dismissible fade show" style="border: solid 2px; border-block-color: green; font-weight: 800; font-size: 17px; color: green;">
		  <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	</div>
	<?php } ?>
        <form method="post" id="appfrom">
          <div id="approvebutton" style="display:none; float:left;">
            <button type="button" class="btn btn-success" style="font-size: 13px; font-weight: 700;" onClick="processBar();confirmsubmit();" >Approve</button>
          </div>
          <input type="hidden" name="action" value="approveall">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
			  <th>Account Name</th>
			  <th>Group Name</th>
			   <th>Status</th>
			<!-- <th>Action</th>-->
			</tr>
          </thead>
          <tbody id="tablesearch">
            <?php
    if(isset($accountData->status)=='true'){
    if(isset($accountData->AccountNameData)){                    
    $no=1;
    foreach($accountData->AccountNameData as $resultList){

    ?>
            <tr class="uyt hgte">
			 
			  <td><?php echo $resultList->AccountName; ?></td>
			  <td><?php echo $resultList->SubGroupName; ?></td>
			  <td><?php echo ($resultList->Status=="1") ? "Active" : "In-active"; ?></td>
			  
            </tr>
            <?php
    $no++;
  }
}
  }
  else{?>
    <tr class="uyt hgte">
<td colspan="14"><div align="center"><?php echo 'You Can Search...'; ?></div></td>    
    </tr>
    <?php }
    ?>
          </tbody>
        </table>
		</form>
		</div>
      	</div>
    </div>
  </div>
  <script>
  function confirmsubmit(){
  	var confirmfrom = confirm("Are you sure you want to approve?");
	if(confirmfrom==true){
		$('#appfrom').submit();
	}else{
		$('#processBar').hide();
	}
  }
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
    // check uncheck all inclusions
    $("#ackknowledmentCheckAll").click(function(){
    if(this.checked){
      $('.deleteack').each(function(){
        this.checked = true;
      })
    }else{
      $('.deleteack').each(function(){
        this.checked = false;
      })
    }
    });
    
    });

    window.setInterval(function(){ 
      checked = $("#tabledata input[type=checkbox]:checked").length;
      if(!checked) { 
    $("#approvebutton").hide();
      } else {
	  
    $("#approvebutton").show();
    } 
}, 100);
</script>
<?php include 'footer.php'; ?>
</body>
</html>
<script>
$( function() {
  $( ".datepicker" ).datepicker({ 
    dateFormat: 'dd-mm-yy',
    maxDate: 0
  });
});


function funccheck(no,voucher){
	var voucher = encodeURI(voucher);
	var confirmed = confirm("Do you want to Approve Voucher no "+voucher);
	if(confirmed){
		$('#hide'+voucher).load('frmaction.php?act=walletApprove&voucher='+voucher);
		
	}

}
</script>
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
  table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled),table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
font-size: 12px!important;
}
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .search-input-grid{
     display: grid;
    grid-gap: 5px;
  }
  .search-button{
      display: grid;
    grid-template-columns: auto auto;
    grid-gap: 20px;
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