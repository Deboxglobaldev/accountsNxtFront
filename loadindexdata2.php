<?php 
session_start();
include "inc.php";
logger("Session BranchId...".$_SESSION["branchId"]);
logger("Session Type...".$_SESSION["Type"]);
if(!isset($_SESSION['branchId']))
{
    
  logger ("[ERR] - Session called 'branchId' is empty, expecting a branch Id");
  echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
  exit();
  
}
	$jsonPost = '{ "UserType": "'.$_SESSION["Type"].'", "UserId": "", "UserTypeId": "'.$_SESSION["branchId"].'"}';
	logger("JSON to post dashboard data:  ----".$jsonPost);
	$urlNew = $serverurlapi."Dashboards/DashboardAPI.php";
	logger("  API hit URL: ". $urlNew); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$urlNew);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$response = curl_exec($ch);
	logger("Response return from dashboard API: ". $response); 
	$dashData = json_decode($response);
	//print_r($dashData);
	curl_close($ch);
	
	
	
	
	$pan  = $dashData[0]->SummaryCounts[0]->SummaryCount;
?>


<section class="hk-sec-wrapper">
  <div class="grid-container">
    <div class="item1">
      <div class="flex">
        <h4> PAN</h4>
        <h2><span class="fa fa-square-bracket-left "><a href="index.php?branchId=<?php echo $_SESSION['branchId']; ?>">
          <?php echo $pan; ?>
          </a><span class="fa fa-square-bracket-right"></span></h2>
      </div>
      <!--                                 <i class="fal fa-brackets"></i>
-->
      <!--    <i class="fal-fa-brackets" style="font-size:24px"></i>
-->
    </div>
    <div class="item2">
      <div class="flex">
        <h4>TAN</h4>
        <h2><span class="fa fa-square-bracket-left "></span>0<span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
    <div class="item3">
      <div class="flex">
        <h4>TDS/TCS</h4>
        <h2><span class="fa fa-square-bracket-left "></span>0<span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
    <div class="item4">
      <div class="flex">
        <h4>e-TDS/TCS</h4>
        <h2><span class="fa fa-square-bracket-left "></span>0<span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
    <div class="item5">
      <div class="flex">
        <h4>FORM 16A</h4>
        <h2><span class="fa fa-square-bracket-left "></span>0<span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
  </div>
</section>
<section class="hk-sec-wrapper" style="">
  <div class="grid-container">
    <div class="item1">
      <div class="flex">
        <h4>Correction</i></h4>
        <h2 style="color:red"><span class="fa fa-square-bracket-left "></span>0<span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
    <div class="item2">
      <div class="flex">
        <h4>Rejected</h4>
        <h2><span class="fa fa-square-bracket-left "></span>0<span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
    <div class="item3">
      <div class="flex">
        <h4>Fresh</h4>
        <h2><span class="fa fa-square-bracket-left "></span>
          <?php if($totalfreshCategory!=''){echo $totalfreshCategory;}else{ echo 0;} ?>
          <span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
    <div class="item4">
      <div class="flex">
        <h4>NRI</h4>
        <h2><span class="fa fa-square-bracket-left "></span>
          <?php if($totalpanNumber!=''){echo $totalpanNumber;}else{echo 0;} ?>
          <span class="fa fa-square-bracket-right"></span></h2>
      </div>
    </div>
  </div>
</section>
 

<table id="tableID" class="table table-striped table-bordered table-responsive" style="width:100%">
  <thead>
  <tr>
  	<td><select class="select floating" name="color" id="color" autocomplete="off">
          	<option value=""> -- Select -- </option>
			<option value="#2eb82e"><span style="color:#2eb82e;">#2eb82e</span></option>
		  	<option value="#ffa31a"><span style="color:#ffa31a;">#ffa31a</span></option>
			<option value="#ff1a1a"><span style="color:#ff1a1a;">#ff1a1a</span></option>
        </select>
	</td>
	<td></td>
	<td><select class="select floating" name="type" id="type" autocomplete="off" >
          <option value=""> -- Select -- </option>
          <option value="49A">49A</option>
          <option value="49AA">49AA</option>
          <option value="CR">CR</option>
        </select>
	</td>
	<td><select class="select floating" name="category" id="category" autocomplete="off" >
          <option value=""> -- Select -- </option>
		  <option value="ASSOCIATION">ASSOCIATION OF PERSONS</option>
		  <option value="COMPANYY">COMPANY</option>
		  <option value="FIRM">FIRM</option>
		  <option value="HINDU">HINDU UNDIVIDED FAMILY</option>
          <option value="INDIVIDUAL">INDIVIDUAL</option>
		  <option value="LOCAL">LOCAL AUTHORITY</option> 
		  <option value="TRUST">TRUST</option>
		</select></td>
	<td><select class="select floating" name="stage" id="stage" autocomplete="off">
          <option value=""> -- Select -- </option>
          <option value="NEW">New</option>
        </select></td>
	<td><select class="select floating" name="substage" id="substage" autocomplete="off">
          <option value=""> -- Select -- </option>
          <option value="YTA">YET TO ACTION</option>
		  <option value="DOCUMENT UPLOADED">DOCUMENT UPLOADED</option>
		  <option value="CROPING">CROPING</option>
		 </select></td>
	<td></td>
	<td></td>
  </tr>
    <tr class="headline">
      <th>Color</th>
      <th>Acknowledge No.</th>
      <th>Type</th>
      <th>Category</th>
      <th>Stage</th>
      <th>Sub Stage</th>
      <th>Last Act.&nbsp;Date</th>
	  <th>Assign</th>
    </tr>
  </thead>
  <tbody id="searchTable">
   <?php
   
   
if($dashData[0]->Status=='0')
{	
$color1='';
$color2='';									 
$no=1;
foreach($dashData[0]->DataTable as $list)
{

	
//if($list['ApplicationCategory']=="INDIVIDUAL")
	  if($branchId!="QCP")
	  {
		if( strtoupper($list->SubStageId)=="0")
		{
		  $stagurl = "filesubmit.php?aid=".$list->Acknowledgement."&formType=".$list->FormType."&ApplicationType=".$list->ApplicationType."&Category=".$list->ApplicantCategory;
		}elseif($list->SubStageId=="1")
		{
		  $stagurl = "cropingstage.php?aid=".$list->Acknowledgement."&formType=".$list->FormType;
		}elseif($list->SubStageId=="2")
		{
		  $stagurl = "dataentry.php?aid=".$list->Acknowledgement."&formType=".$list->FormType;
		}
	  }else
	  {
		if($list->SubStageId=="0")
		{
		  $stagurl = "qc_pdf.php?aid=".$list->Acknowledgement."&formType=".$list->FormType;
		}elseif($list->SubStageId=="2")
		{
		  $stagurl = "qc_pdf.php?aid=".$list->Acknowledgement."&formType=".$list->FormType;
		}
	  }
	  
	  if($list->ApplicationAgeing==0 || $list->ApplicationAgeing==''){
	  	$color1 = '#ffffff';
		$color2 = '#ffffff';
		
	  }else if($list->ApplicationAgeing<=5){
	  	$color1 = '#ffffff';
		$color2 = '#ffe6e6';
		
	  }else if($list->ApplicationAgeing<=15){
	  	$color1 = '#ffe6e6';
		$color2 = '#ff9999';
		
	  }else if($list->ApplicationAgeing<=30){
	  	$color1 = '#ff9999';
		$color2 = '#ff8080';
		
	  }else if($list->ApplicationAgeing<=45){
	  	$color1 = '#ff8080';
		$color2 = '#ff6666';
		
	  }else if($list->ApplicationAgeing<=60){
	  	$color1 = '#ff6666';
		$color2 = '#ff3333';
	  }else{
	  	$color1 = '#e60000';
		$color2 = '#e60000';
		
	  }
	  
	if($list->ApplicationAgeing<=2 || $list->ApplicationAgeing==''){
		$color='#2eb82e';
		
	}else if($list->ApplicationAgeing>=3 && $list->ApplicationAgeing<=6 ){
		$color='#ffa31a';
		
	}else if($list->ApplicationAgeing>6){
		$color='#ff1a1a';
	}
?>
    <tr style="background-image: linear-gradient(to right, <?php echo $color1; ?>, <?php echo $color2; ?>);">
      <td><div style="width: 69px; background-color:<?php echo $color; ?>; padding: 5px; color:<?php echo $color; ?>;"><?php echo $color; ?></div></td>
      <td class="deta"><a href="<?php echo $stagurl; ?>" target="blank"><?php echo $list->Acknowledgement; ?></a></td>
      <td><?php echo $list->FormType; ?></td>
      <td><?php echo $list->ApplicantCategory;  ?></td>
      <td><?php echo $list->CurrentStage; ?></td>
      <td><?php echo $list->SubStage; ?></td>
      <td><?php echo $list->LastActivityDate; ?></td>
	   <td><button type="button" class="btn btn-success">Me</button></td>
    </tr>
    <?php
	$no++; }   }else{
	echo 'no data found';
	}
	?>
  </tbody>
</table>
<!--search filter-->
<script>
$(document).ready(function(){
	$('#tableID').DataTable({
		stateSave: true
	});
});

$(document).ready(function(){
	$('#color option').each(function () {
		var color = $(this).text();
		$(this).closest("option").css({"background-color":color,"color":color});
	})
});

$(document).ready(function(){
	$("#type").on("change", function() {
		var value = $(this).val().toLowerCase();
		$("#searchTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});

$(document).ready(function(){
	 $("#category").on("change", function() {
		var value = $(this).val().toLowerCase();
		$("#searchTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});	

$(document).ready(function(){
	$("#stage").on("change", function() {
		var value = $(this).val().toLowerCase();
		$("#searchTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
$(document).ready(function(){
	$("#color").on("change", function() {
		var value = $(this).val().toLowerCase();
		$("#searchTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
$(document).ready(function(){	
	$("#substage").on("change", function() {
		var value = $(this).val().toLowerCase();
		$("#searchTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	}); 
});
<!--END search filter-->
</script>

<!--<script>

/* Initialization of datatables */
$(document).ready(function () {

// Paging and other information are
// disabled if required, set to true
var myTable = $("#tableID").DataTable({
  paging: true,
  searching: true,
  info: true,
  stateSave: true
});

// 2d array is converted to 1D array
// structure the actions are 
// implemented on EACH column
myTable
  .columns()
  .flatten()
  .each(function (colID) {

	// Create the select list in the
	// header column header
	// On change of the list values,
	// perform search operation
	var mySelectList = $("<select />")
	  .appendTo(myTable.column(colID).header())
	  .on("change", function () {
		myTable.column(colID).search($(this).val());

		// update the changes using draw() method
		myTable.column(colID).draw();
	  });

	// Get the search cached data for the
	// first column add to the select list
	// usinh append() method
	// sort the data to display to user
	// all steps are done for EACH column
	myTable
	  .column(colID)
	  .cache("search")
	  .sort()
	  .each(function (param) {
		mySelectList.append(
		  $('<option value="' + param + '">'
			+ param + "</option>")
		);
	  });
  });
});
</script>-->
