<?php 
// get url
include 'inc.php';
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");

if(isset($_GET['editId'])!=''){
logger($InfoMessage."Call for Retrival ");

$url = "".$serverurlapi."General/OfficeInfoListAPI.php?editId=".decode($_GET['editId'])."";

logger($InfoMessage." Retrival API Call ..".$url );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$branchData = json_decode($result, true);
logger($InfoMessage." JSON Retsult for Data Retrival ..".$branchData );
curl_close($ch);
}
//get state 
$url = "".$serverurlapi."General/getstate.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$stateresult = curl_exec($ch);
$stateData = json_decode($stateresult, true);
curl_close($ch);
?>
<?php 
//insert branch information
if(isset($_POST['addbranchinfo'])){
logger($InfoMessage." Data Save .." );

$formData = array(
         'editId' => $_POST['editId'],
         'Name' => $_POST['name'],
		 'AddressOne' => $_POST['AddressOne'],
		 'AddressTwo' => $_POST['AddressTwo'],
		 'City' => $_POST['City'],
		 'PinCode' => $_POST['PinCode'],
		 'State' => $_POST['State'],
		 'PrimaryPhone' => $_POST['PrimaryPhone'],
		 'SecondaryPhone' => $_POST['SecondaryPhone'],
		 'PrimaryEmail' => $_POST['PrimaryEmail'],
		 'SecondaryEmail' => $_POST['SecondaryEmail'],
		 'ContactPerson' => $_POST['ContactPerson'],
		 'CenterType' => $_POST['CenterType'],
		 'AgentNumber' => $_POST['AgentNumber'],
		 'Region' => $_POST['Region'],
		 'PanNumber' => $_POST['PanNumber'],
		 'TanNumber' => $_POST['TanNumber'],
		 'GstNumber' => $_POST['GstNumber'],
		 'BranchCode' => $_POST['BranchCode'],
		 'FinancialCode' => $_POST['FinancialCode'],
		 'BankName' => $_POST['BankName'],
		 'AccountNumber' => $_POST['AccountNumber'],
		 'IfscCode' => $_POST['IfscCode'],
		 'BranchName' => $_POST['BranchName'],
		 'BankName2' => $_POST['BankName2'],
		 'AccountNumber2' => $_POST['AccountNumber2'],
		 'IfscCode2' => $_POST['IfscCode2'],
		 'BranchName2' => $_POST['BranchName2'],
		 'Status' => $_POST['Status'],
		 'itemdata' => $_POST['itemdata']
   );
$insertData = http_build_query($formData);
logger($InfoMessage." Saving Data as  .. ".$insertData );
//use curl method
$ch = curl_init();
$url = "".$serverurlapi."General/AddOfficeReligareInfoMaster.php";
logger($InfoMessage." Saving Data URL  .. ".$url );
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultData = curl_exec($ch);
logger($InfoMessage." Saving Data API Call Result  .. ".$resultData );
//print_r($resultData);die();
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
<title>Add Religare Office</title>
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
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <form action="" method="post" id="branchform" >
  <div class="hk-pg-wrapper"  style="">
    <?php if(isset($_SESSION['error'])!=''){ ?>
		  <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;"> 
			<!-- Success Alert -->
			<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
				 <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		  </div>
  <?php } ?>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Name<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <input type="text" name="name" id="name" class="inp-t" value="<?php echo $branchData['Name']; ?>">
			<p id="namecheck"></p>
          </div>
        </div>
      </div>
      <hr class="dot-row">
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Address Line 1<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <input type="text" name="AddressOne" id="AddressOne" class="inp-t" value="<?php echo $branchData['AddressOne']; ?>">
			<p id="addressOnecheck"></p>
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Address Line 2</h5>
          </div>
          <div class="col-md-9">
            <input type="text" name="AddressTwo" class="inp-t" value="<?php echo $branchData['AddressTwo']; ?>">
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>City<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-4">
                <input type="text" name="City" id="City"  class="inp-t" value="<?php echo $branchData['City']; ?>">
				<p id="citycheck"></p>
              </div>
              <div class="col-md-4">
                <div class="flx">
                  <h5>Pin&nbsp;Code<span class="mandat">*</span></h5>
                  <input type="number" name="PinCode" id="PinCode" class="inp-t" value="<?php echo $branchData['PinCode']; ?>">
				  <p id="pincheck"></p>
                </div>
              </div>
              <div class="col-md-4">
                <div  class="flx">
                  <h5>State<span class="mandat">*</span></h5>
                  <select class="inp-w ui-select wd-tr" name="State" id="State">
                    <option value="">Select</option>
					<?php 
					if(isset($stateData['List'])){
					foreach($stateData['List'] as $stateList){
            if($stateList['Code']!='99'){
					 ?>
					 <option value="<?php echo $stateList['Code']; ?>"<?php if($branchData['State']==$stateList['Code']){?>selected="selected"<?php } ?>><?php echo $stateList['Name']; ?></option>
					 <?php
            }
					}
					}
					?>
                  </select>
				  <p id="statecheck"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Primary&nbsp;Phone<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="number" name="PrimaryPhone" id="PrimaryPhone" class="inp-t" value="<?php echo $branchData['PrimaryPhone']; ?>">
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Secondary&nbsp;Phone</h5>
                  <input type="number" name="SecondaryPhone" id="SecondaryPhone"  class="inp-t" value="<?php echo $branchData['SecondaryPhone']; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Primary&nbsp;E-mail<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="email" name="PrimaryEmail" id="PrimaryEmail"  class="inp-t" value="<?php echo $branchData['PrimaryEmail']; ?>">
				<p id="primaryemailcheck"></p>
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Secondary&nbsp;E-&nbsp;mail</h5>
                  <input type="email" name="SecondaryEmail" id="SecondaryEmail"  class="inp-t" value="<?php echo $branchData['SecondaryEmail']; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Contact Person<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <input type="text" name="ContactPerson" id="ContactPerson" class="inp-t" value="<?php echo $branchData['ContactPerson']; ?>">
			 <p id="contactpersoncheck"></p>
          </div>
        </div>
      </div>
      <hr class="dot-row">
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Centre Type<span class="mandat">*</span></h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-3">
			    <select class="inp-w ui-select wd-tr" name="CenterType" required>
                  <option value="">Select</option>
				 	 <option value="1" <?php if($branchData['CenterType']=="1"){?>selected="selected"<?php } ?>>HO Office</option>
					  <option value="2" <?php if($branchData['CenterType']=="2"){?>selected="selected"<?php } ?>>Regional Office</option>
					
                </select>
              </div>
              <div class="col-md-5" style="display:none;">
                <div class="flx">
                  <h5>NSDL&nbsp;Agent&nbsp;Number</h5>
                  <input type="text" name="AgentNumber" id="AgentNumber"  class="inp-t" value="<?php echo $branchData['AgentNumber']; ?>">
				  <p id="agentnumbercheck"></p>
                </div>
              </div>
              <div class="col-md-4">
                <div  class="flx">
                  <h5>Region</h5>
				  <?php 
                  //get region master
					$url = "".$serverurlapi."General/getregion.php";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$regionresult = curl_exec($ch);
					$regionType = json_decode($regionresult, true);
					curl_close($ch);
				   ?>
					<select class="inp-w ui-select wd-tr" name="Region" required>
					  <option value="">Select</option>
					  <?php 
					  if(isset($regionType['List']))
					  {
						foreach((array) $regionType['List'] as $region)
						{ ?>
						  <option value="<?php echo str_replace('R','',$region['Code']); ?>"<?php if($branchData['Region']==str_replace('R','',$region['Code'])){?>selected="selected"<?php } ?>><?php echo $region['Name']; ?></option>
						<?php }
					  }
					  ?>
					</select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="dot-row">
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>PAN Number</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-3">
                <input type="text" name="PanNumber" id="PanNumber"  class="inp-t" value="<?php echo $branchData['PanNumber']; ?>">
				<p id="pannumbercheck"></p>
              </div>
              <div class="col-md-5">
                <div class="flx">
                  <h5>TAN&nbsp;Number</h5>
                  <input type="text" name="TanNumber" id="TanNumber" class="inp-t" value="<?php echo $branchData['TanNumber']; ?>">
				  <p id="tannumbercheck"></p>
                </div>
              </div>
              <div class="col-md-4">
                <div  class="flx">
                  <h5>GST&nbsp;Number</h5>
                  <input type="text" name="GstNumber" id="GstNumber"  class="inp-t" value="<?php echo $branchData['GstNumber']; ?>">
				  <p id="gstcheck"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section >
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>User Group&nbsp;Id</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="text" name="BranchCode" id="BranchCode" class="inp-t" value="<?php echo $branchData['BranchCode']; ?>">
				<p id="branchcodecheck"></p>
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Financial&nbsp;Code</h5>
                  <input type="text" name="FinancialCode" id="FinancialCode"  class="inp-t" value="<?php echo $branchData['FinancialCode']; ?>">
				  <p id="financialcodecheck"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <hr class="dot-row">
    </section>
	<section style=" display:none;">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Bank&nbsp;Name</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="text" name="BankName" id="BankName" class="inp-t" value="<?php echo $branchData['BankName']; ?>">
				<p id="banknamecheck"></p>
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Account&nbsp;Number</h5>
                  <input type="text" name="AccountNumber" id="AccountNumber"  class="inp-t" value="<?php echo $branchData['AccountNumber']; ?>">
				  <p id="accountnumbercheck"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="" style=" display:none;">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>IFSC&nbsp;Code</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="text" name="IfscCode" id="IfscCode"  class="inp-t" value="<?php echo $branchData['IfscCode']; ?>">
				<p id="ifsccodecheck"></p>
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Branch&nbsp;Name</h5>
                  <input type="text" name="BranchName" id="BranchName" class="inp-t" value="<?php echo $branchData['BranchName']; ?>">
				  <p id="branchnamecheck"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="dot-row">
    </section>
    <section class="" style=" display:none;">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Bank&nbsp;Name</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="text" name="BankName2" id="BankName2" class="inp-t" value="<?php echo $branchData['BankName2']; ?>">
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Account&nbsp;Number</h5>
                 <input type="text" name="AccountNumber2" id="AccountNumber2"  class="inp-t" value="<?php echo $branchData['AccountNumber2']; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="" style=" display:none;">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>IFSC&nbsp;Code</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <input type="text" name="IfscCode2" id="IfscCode2" class="inp-t" value="<?php echo $branchData['IfscCode2']; ?>">
              </div>
              <div class="col-md-7">
                <div  class="flx">
                  <h5>Branch&nbsp;Name</h5>
                  <input type="text" name="BranchName2" id="BranchName2" class="inp-t" value="<?php echo $branchData['BranchName2']; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  </section>
      
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Item</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-4">
				<?php 
				//get items
				$url = "".$serverurlapi."General/getitemList.php";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$itemresult = curl_exec($ch);
				$itemsList = json_decode($itemresult, true);
				curl_close($ch);
				?>
				<select class="inp-w ui-select wd-tr" name="item" id="item">
                    <option value="">Select</option>
					<?php 
					if(isset($itemsList['List'])){
					 ?>
					 <option value="<?php echo $itemsList['List']['Name']; ?>"><?php echo $itemsList['List']['Name']; ?></option>
					 <?php
					}
					?>
                </select>
              </div>
              <div class="col-md-8">
                <div  class="flx">
                  <h5>Description</h5>
                  <input type="text" name="description" id="description" class="inp-t" id="description">
				  <input type="hidden" name="itemId" id="itemId" value="0" />
				  <input type="hidden" name="rIndexId" id="rIndexId" value="" />
                  <button type="button" class="btn btn-default addbutton" onClick="addTableRow();">Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container-fluid">
        <table class="table">
          <thead>
            <tr class="vcx-i gav">
              <th>Item</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody  id="itemlist" align="center" valign="top">
          </tbody>
        </table>
      </div>
      <hr class="dot-row">
    </section>
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-3">
            <h5>Status</h5>
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <div  class="flx">
                  <select class="inp-w ui-select wd-tr" name="Status" id="Status" required>
                    <option value="1" <?php if($branchData['Status']=='1'){ echo "selected"; } ?>>Active</option>
                    <option value="0" <?php if($branchData['Status']=='0'){ echo "selected"; } ?>>In-active</option>
                  </select>
                </div>
              </div>
              <div class="col-md-7" style="display:none;">
                <div  class="flx">
                  <h5>System&nbsp;Status</h5>
                  <select class="inp-w ui-select wd-tr">
                    <option>Select</option>
                    <option>4</option>
                    <option>5</option>
                    <option>8</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="nxrt full-bd" style="width: fit-content;">
	    <input type="hidden" name="editId" value="<?php echo $branchData['Id']; ?>" />
        <input type="hidden" name="itemdata" id="itemdata" value="" style="width: 100%;" />
        <a href="listrloffice.php" class="next">Cancle</a>
        <input type="submit" name="addbranchinfo" id="btnsubmit" class="next" value="Save">
        <a href="listrloffice.php" class="next">Exit</a>
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
	padding: 2%;

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
var rIndex,table = document.getElementById("itemlist");
function addTableRow(){
     var itemId = document.getElementById("itemId").value;
	 if(itemId == 0)
	 {
	     var newRow = table.insertRow(table.length),
		 cell1 = newRow.insertCell(0),
		 cell2 = newRow.insertCell(1),
		 cell3 = newRow.insertCell(2),
		 Item = document.getElementById("item").value,
		 Description = document.getElementById("description").value;
		 cell1.innerHTML = Item;
		 cell2.innerHTML = Description;
		 cell3.innerHTML = '<input id="Button" type="button" value="Edit" class="btn btn-default addbutton" onclick="selectedRowInput();" />';
		//fetch table cells data into array object 
		var TableData = new Array();   
		$('#itemlist tr').each(function(row, tr){
			TableData[row]={
				"item" : $(tr).find('td:eq(0)').text(),
				"description" :$(tr).find('td:eq(1)').text()
			}
		});
		//return TableData;
		//var list = TableData.shift();
		//convert array to json 
		var arraydata = JSON.stringify(Object.assign({}, TableData))
		//console.log(arraydata);
		$('#itemdata').val(arraydata);
		//END convert array to json 
	 }else
	 {
	   var Item = document.getElementById("item").value,
	   Description = document.getElementById("description").value;
	   rIndexId = document.getElementById("rIndexId").value;
	   indexitem = rIndexId-1;
	   table.rows[indexitem].cells[0].innerHTML = Item;
	   table.rows[indexitem].cells[1].innerHTML = Description;
	   //change value to add 
	   $('#itemId').val(0); 	 
	 }
     
}

function selectedRowInput(){
     //var rIndex,table = document.getElementById("itemlist");
	 for(var i = 0; i < table.rows.length; i++){
	   table.rows[i].onclick = function()
	   {
	      rIndex = this.rowIndex;
		  document.getElementById("item").value = this.cells[0].innerHTML;
		  document.getElementById("description").value = this.cells[1].innerHTML;
		  //for update
		  document.getElementById("rIndexId").value = rIndex;
	   };
	 }
	 //change value to edit button
	 $('#itemId').val(1);
}

</script>
 <script src="js/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
    $("#branchform").validate({
		onfocusout: function(element) {
           this.element(element);
        },
		rules :{
			name: "required",
			AddressOne: "required",
			City: "required",
			PinCode: {
				required: true,
				minlength:6,
				maxlength:6
			},
			State: "required",
			PrimaryPhone: {
				required: true,
				minlength:10,
				maxlength:10
			},
			SecondaryPhone: {
				minlength:10,
				maxlength:10
			},
			PrimaryEmail: {
				required: true,
				email: true
			},
			SecondaryEmail: {
				email: true
			},
			PanNumber: {
				minlength:10,
				maxlength:10
			},
			TanNumber: {
				minlength:10,
				maxlength:10
			},
			ContactPerson: "required"
		},
		messages :{
		   
		},
		submitHandler: function(form) {
		  form.submit();
		}
	});
});
</script>
