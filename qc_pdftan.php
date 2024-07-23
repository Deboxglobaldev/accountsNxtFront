<?php
include "inc.php";
include "logincheck.php";
$AcknowledgementNumber = $_GET['aid'];
$formType = $_GET['formType'];


$urlnew = $serverurlapi."User1Entry/callAcknowDataTan.php?aid=".$_GET['aid'];
//Fetch data from get curl function
$result2 = getCurlData($urlnew);
//logger("RESPONSE RETURN FROM CALL ACKNOW API: ". $result2); 
$data2 = json_decode($result2);

$ProductType =  trim($data2->ProductType);
$Stage =  trim($data2->recordlist->stage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Review</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<style>
 
.custom-file-upload{
  
  padding: 8px;
 
  border-radius: 5px; 
 
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
</style>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(img/Religare-Dashboard-BG.JPG);">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
	<!--<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item"><a href="#">Library</a></li>
		<li class="breadcrumb-item active" aria-current="page">Data</li>
	  </ol>
	</nav>-->
	
    <div class="row contas">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper con">
		<div id="errorDiv"></div>
		
<?php 
if($_GET['page']!=''){
	$page = $_GET['page'];
}else{
	$page = 2;
}
?>  
<SCRIPT>
$(document).ready(function()
{
 
 	var pageScr = 0;
	var page = '<?php echo $page; ?>';
	var aaTop1 = $("#image_0").offset().top;
	
	if(page == 2){
		//pageScr = 900;
		$('#div1').animate({
			scrollTop: $("#image_1").offset().top-aaTop1
		}, 10);
	}else{
		//pageScr = 1800;
		$('#div1').animate({
			scrollTop: $("#image_2").offset().top-aaTop1
		}, 10);
	}
  $('#div1').scrollTop(pageScr);
 
/*$("#div1").scroll(function () { 
        $("#div2").scrollTop($("#div1").scrollTop());
        $("#div2").scrollLeft($("#div1").scrollLeft());
    });*/
$("#div2").scroll(function () { 
  var scroll2 = $("#div2").scrollTop();
   scroll2 = (scroll2*.07)+ $("#div1").scrollTop();
   //alert(scroll2);
   //alert(scroll2);
   /*if(scroll2>2000){
   alert(scroll2);
 }*/
        $("#div1").scrollTop(scroll2);
        //$("#div1").scrollLeft($("#div2").scrollLeft());
    });

});

</SCRIPT>   
<div style="grid-gap: 20px;display: grid;grid-template-columns: 1fr 1fr;">
          <!-- <div class="container-fluid dostas3" style="border: 0px solid #ffff;padding: 0px;"> -->
            <div id="div1" style="overflow:auto;height:500px;width:100%;border:1px solid black;">
           <div style="position: absolute;display: grid;grid-gap: 10px;margin-top: 20px;">
			  <button tabindex="-1" class="zoom-btn" onClick="zoomin();"><i class="fa fa-plus"></i></button>
			  <button tabindex="-1" class="zoom-btn" onClick="zoomout();"><i class="fa fa-minus"></i></button>
			</div>
		   <?php
			$j=1;
			for($i=0; $i<=25; $i++){
			$imageSeq = $targetImagePath."tanimages/".$_GET['aid'].'_'.$i.'.jpg';
			// Open the file
			$check = @fopen($imageSeq, 'r');
			// Check if the file exists
			if($check){
			?>
			
            <img class="map" id="image_<?php echo $i; ?>" tabindex="-1" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($imageSeq)); ?>" width="100%">
			
			<?php } $j++; } ?>
<script>
/*const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
  const byteCharacters = atob(b64Data);
  const byteArrays = [];

  for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
    const slice = byteCharacters.slice(offset, offset + sliceSize);

    const byteNumbers = new Array(slice.length);
    for (let i = 0; i < slice.length; i++) {
      byteNumbers[i] = slice.charCodeAt(i);
    }

    const byteArray = new Uint8Array(byteNumbers);
    byteArrays.push(byteArray);
  }

  const blob = new Blob(byteArrays, {type: contentType});
  return blob;
}

const contentType = 'application/pdf';
const b64Data = '<?php echo base64_encode(getCurlImage($imagePath)); ?>';

const blob = b64toBlob(b64Data, contentType);
const blobUrl = URL.createObjectURL(blob);

//const img = document.createElement('img');
//img.src = blobUrl;
//document.body.appendChild(img);
$("#pdfshowId").attr("src", blobUrl+'#page=<?php echo $page; ?>');
*/
</script>			
			
            <br>
            <br>
			
          </div>
          <div id="div2" style="overflow: auto;height:500px;width:100%;border:1px solid black;">
        	<iframe src="qc_reviewtan.php?aid=<?php echo $AcknowledgementNumber; ?>" width="100%" height="2200px" style="border: 0px solid #ccc; display: block;" id="form1"></iframe>
         </div>
       </div>
          <div class="nxrt" style="width: fit-content; padding-top: 12px !important;"> 
		  <?php if($formType=='CR'){ ?>
		  <a href="dataentrytan.php?aid=<?php echo $AcknowledgementNumber; ?>&formType=<?php echo $_GET['formType']; ?>&page=2" class="next btn btn-default" style="background: gray; color: #fff; padding: 10px; font-size: 15px;"> <i class="fa fa-pencil" ></i> Edit Page </a>
		  <?php }else{ ?>
		  <a href="dataentrytan.php?aid=<?php echo $AcknowledgementNumber; ?>&formType=<?php echo $_GET['formType']; ?>&page=2" class="next btn btn-default" style="background: gray; color: #fff; padding: 10px; font-size: 15px;"> <i class="fa fa-pencil" ></i> Edit Page </a>
		 
		  <?php } ?>
		  
		  <?php 
		 if($_SESSION['branchId']=="QCP" || $_SESSION['branchId']=="BCP")
		
		  { ?>
		  	<button type="button" class="next btn btn-warning" style="background: orange;" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Add Rejection','modelpop.php?action=addqcrejection&aid=<?php echo $_GET['aid']; ?>&formType=<?php echo trim($_GET['formType']); ?>&status=0&ProductType=<?php echo $ProductType; ?>','100%','auto');"> Add Rejection </button>
          <?php }else{  ?>
		   <?php 
if(strtoupper(substr($Stage,-2))!= "BC"){
if($_SESSION['branchId']=="QCF" || strtoupper(substr($Stage,0,1)) == "I")
{ ?>
<button type="button" class="next btn btn-warning" style="background: orange;" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Resolve Rejection','modelpop.php?action=addqcresolve&aid=<?php echo $_GET['aid']; ?>&formType=<?php echo trim($_GET['formType']); ?>&status=1&ProductType=<?php echo $ProductType; ?>','100%','auto');"> Resolve Rejection </button>
<?php } } } ?>
		  
			
			<button type="button"class="next" onClick="formSubmit('2');"> <?php if($_SESSION['branchId']=="QCP"){ echo "Submit QC"; }else{ echo "Review and Submit"; } ?> <i class="fa fa-angle-right" ></i></button>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
	<div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br>Submitting Review Data... Please wait</div>
</div>
<script>
function zoomin() {
  var myImg = document.getElementsByClassName("map");
	for(var i=0; i< myImg.length;i++){
		var currWidth = myImg[i].clientWidth;
		if (currWidth == 2500) return false;
		else {
			myImg[i].style.width = (currWidth + 100) + "px";
		}
	}
}

function zoomout() {
  var myImg = document.getElementsByClassName("map");
 	 for(var i=0; i< myImg.length;i++){
		  var currWidth = myImg[i].clientWidth;
		  if (currWidth == 100) return false;
		  else {
			myImg[i].style.width = (currWidth - 100) + "px";
		  }
	 }
}
</script>
<script>
function formSubmit(pageid){
	if(pageid==2){
		$('#form1').contents().find('#formsubmit').click();
		$("#blkbox").show();
	}
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>
<style>
.zoom-btn{
     outline: none;
    background: #dad6e1ab;
    border:none;
    box-shadow: 1px 1px 9px 1px #00000085; 
}
.zoom-btn:focus{
  outline: none;
  border: none;
}
.submitbutton{
        background-color: rgb(247 141 70);
        width:100%;
  color:black;
    font-weight: bold;
}
.sign{
padding-right: 15px;
}
.cls{


    background:rgb(247 141 70);
    padding: 10px;
    border-radius: 50%;
    color: white;

        font-size: 24px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    bottom: 4px;
}
.contas{
  margin-left: 0px!important;
  margin-right: 0px!important;
margin-top: 15px!important;
}
</style>
