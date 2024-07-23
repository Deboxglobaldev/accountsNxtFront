<?php 
session_start();
// get url
include 'inc.php';
//if(!isset($_SESSION['branchId']))
//{
    // not logged in
    header('Location: login.php');
    //exit();
//}
echo
//get mis list 
if($_SESSION['branchId']!=''){ 
$branchId = $_SESSION['branchId'];
}
$url = $serverurlapi."Dashboards/misdataList.php?branchId=".$branchId;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$misList = json_decode($result, true);
curl_close($ch);
//count deshboard data 
$countData = file_get_contents($serverurlapi."Dashboards/totalDashRecord.php);
$data = json_decode($countData, true);
$totalPAN='';
$totalpanNumber='';
$totalfreshCategory='';
if($data['status']=='true'){
$totalPAN = $data['countList']['0'];
$totalpanNumber = $data['countList']['1'];
$totalfreshCategory = $data['countList']['2'];
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>PAN Dashboard</title>
<meta name="description" content="PAN OFFICE" />

<!-- Favicon -->
<?php include 'links.php'; ?>
</head>

<body>


<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

<!-- Top Navbar -->
<?php include 'header.php'; ?>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

<div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">

<div style="background-color: #1e733f;background-image:linear-gradient(to right,#1e733f,#79c117);padding:3px;">
<div class="Container-fluid">
<div class="row strip">
<div class="col-sm-6">
<p class="ticker">PLEASE SEND PHYSICAL APPLICATION ON TIME...</p>
</div>

<div class="col-sm-6">
<p class="ticker">YOUR BRANCH AUDIT ID DUE ON 25 MARCH...</p>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<!-- Row -->
<div class="row">
<div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                    <div class="grid-container">
                    <div class="item1">
                    <div class="flex">
                    <h4> PAN</h4>
                    <h2><span class="fa fa-square-bracket-left "><?php if($totalPAN!=''){echo $totalPAN;}else{echo '0';} ?><span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                    <!--                                 <i class="fal fa-brackets"></i>
                    --><!--    <i class="fal-fa-brackets" style="font-size:24px"></i>
                    -->                              </div>

                    <div class="item2">
                        <div class="flex">

                    <h4>TAN</h4>
                    <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                    </div>

                    <div class="item3">
                        <div class="flex">

                    <h4>TDS/TCS</h4>
                    <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                    </div>

                    <div class="item4">
                        <div class="flex">

                    <h4>e-TDS/TCS</h4>
                    <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                    </div>


                    <div class="item5">
                        <div class="flex">

                    <h4>FORM 16A</h4>

                    
                    <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>                
                    </div>
                    </div>

                    </div>

                    </section>



<!--                              <second row>
-->

<section class="hk-sec-wrapper" style="display: none;">
                    <div class="grid-container">



                    <div class="item1">
                    <div class="flex">
                    <h4>Correction</i></h4>
                    <h2 style="color:red"><span class="fa fa-square-bracket-left ">7878<span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                      </div>

                    <div class="item2">
                        <div class="flex">

                    <h4>Rejected</h4>
                    <h2><span class="fa fa-square-bracket-left ">78<span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                    </div>

                    <div class="item3">
                        <div class="flex">

                    <h4>Fresh</h4>
                    <h2><span class="fa fa-square-bracket-left "><?php if($totalfreshCategory!=''){echo $totalfreshCategory;}else{ echo 0;} ?><span class="fa fa-square-bracket-right"></span></h2>
                    </div>
                    </div>

                    <div class="item4">
                        <div class="flex">

                    <h4>NRI</h4>
                    <h2><span class="fa fa-square-bracket-left "><?php if($totalpanNumber!=''){echo $totalpanNumber;}else{echo 0;} ?><span class="fa fa-square-bracket-right"></span></h2>                    </div>
                    </div>


                

                    </div>

                    </section>




<div>

<div class="grid-container">


                        
                   <div class="item4"> 
						<div class="dropdown">
							<select class="select floating" name="stage" id="stage" autocomplete="off"> 
								<option value=""> -- Select Stage-- </option>
								<option value="yet to action">Yet To Action</option>
							</select>
						</div>
					</div>		

                    <div class="item4"> 
						<div class="dropdown">
							<select class="select floating" name="category" id="category" autocomplete="off"> 
								<option value=""> -- Select Category-- </option>
								<option value="Fresh">Fresh</option>
								<option value="Rejection">Rejection</option>
							</select>
						</div>
					</div>		

                    <div class="item3">
                    <div class="dropdown">
<button class="btn  dropdown-toggle botcor" type="button" data-toggle="dropdown">Filter Priority Only
<span class="caret"></span></button>
<ul class="dropdown-menu">
<li><a href="#">HTML</a></li>
<li><a href="#">CSS</a></li>
<li><a href="#">JavaScript</a></li>
</ul>
</div>
                    </div>

<div class="item4"> 
	<div class="dropdown">
		<select class="select floating" name="type" id="type" autocomplete="off"> 
			<option value=""> -- Select Type-- </option>
			<option value="NRI">NRI</option>
			<option value="NEW">NEW</option>
			<option value="Correction">Correction</option>
		</select>
	</div>
</div>					
                

                    </div>
</div>





<table class="table">
<thead>
<tr class="headline">
<th>Priority</th>
<th>Acknowledge No.</th>
<th>Stage</th>
<th>Category</th>

<th>Last Activity Date</th>
</tr>
</thead>
<tbody id="myTable">
<?php
if($misList['status']=='true'){										 
$no=1;

foreach($misList['misdata'] as $list){

if($list['ApplicationStatus']=="INDIVIDUAL"){
  if($list['Stage']=="Yet To Action"){
    $stagurl = "bulkuploaddata.php";
  }elseif($list['Stage']=="Upload Scan Doc"){
    $stagurl = "cropingstage.php?aid=".$list['AcknowledgementNumber'];
  }elseif($list['Stage']=="Cropping"){
    $stagurl = "dataentry.php?aid=".$list['AcknowledgementNumber'];
  }
}else{
  if($list['Stage']=="Yet To Action"){
    $stagurl = "bulkuploaddata.php";
  }elseif($list['Stage']=="Upload Scan Doc"){
    $stagurl = "dataentry.php?aid=".$list['AcknowledgementNumber'];
  }
}
?>
<tr>
<td><i class='fas fa-arrow-up' style='font-size:23px;color:#71b91b;'></i></td>

<td class="deta"><a href="<?php echo $stagurl; ?>" target="blank"><?php echo $list['AcknowledgementNumber']; ?></a></td>
<td><?php echo $list['Stage']; ?></td>
<td><?php echo $list['ApplicationName']; //$list['ApplicationCategory'];  ?></td>
<!--<td><?php if($list['PanNumber']=='49A'){
		echo "New";
	}elseif($list['PanNumber']=='49AA'){
		echo "NRI";
	} ?></td>-->
<td><?php if($list['AcknowledgementDate']!='01-01-1970'){echo date('d-M-Y',strtotime($list['AcknowledgementDate']));} ?></td>
</tr>
<?php
 }}else{
	echo 'no data found';
 }
?>
</tbody>
</table>  


</div>
</div>

</div>

</div>

</div>

<?php include 'footer.php'; ?>    
<!--search filter-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#type").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#category").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#stage").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>

</html>



<style>


</style>