<?php
include("inc.php");
include "logincheck.php";

$imagePath = $targetImagePath."panimages/".$_GET['aid'].'_1.jpg';
$urlnew = $serverurlapi."User1Entry/callAcknowData.php?aid=".$_GET['aid'];
logger('image path: '.$imagePath);
$result2 = getCurlData($urlnew);
$data2 = json_decode($result2);
$ApplicantStatus =  trim($data2->recordlist->STATUSOFAPPLICANT);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Crop Photo/Signature</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

<!-- Favicon -->
<?php include 'links.php'; ?>

</head>
<body>
<style>
.jcrop-holder{
  /*height: 400px !important;*/
}
.custom-file-upload{
  
  padding: 8px;
 
  border-radius: 5px; 
 
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
html {
  scroll-behavior: smooth;
}
p .active{
 border: 3px solid #35a160; 
}
</style>
<?php

if(isset($_POST['action'])=="cropimage"){

  $post = $_POST;
  $AcknowledgementNumber = trim($_POST['aid']);
  $url = $serverurlapi."User1Entry/cropactionapi.php";
  $response = postCurlData($url,json_encode($post));
  $res = json_decode($response,true);
  if($res['message']=='successfull'){
     $location = 'dataentry.php?aid='.$AcknowledgementNumber.'&formType='.$_GET['formType'];
     header('Location: '.$location.'');
  }
}
?>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
    <div class="container-fluid">
      <div class="col-md-12 timeline-bg">
            <img src="img/Religare-Timeline-png03.png" class="timeline">
    </div>
  </div>
    <div class="row contas">
      <div class="col-xl-12">
	  <div class="dostas">
            <div style="display: flex;">
              <div class="dostas2"> </div>
              <h3>Crop Photo/Signature </h3>
              <div class="dostas1"> </div>
            </div>
            <p style="margin: 8px 8px 20px;color: black;"><span style="font-weight: 700;">NOTE :</span> <span style="color: #138706; font-size: 17px; font-weight: 600;">Select Photo and Signature one after other by dragging cursor in the uploaded Document.</span> </p>
			<p style="cursor:pointer;padding: 5px;">
			<?php
			$j=1;
			for($i=0; $i<=11; $i++){
			$imageSeq = $targetImagePath."panimages/".$_GET['aid'].'_'.$i.'.jpg';
			// Open the file
			$check = @fopen($imageSeq, 'r');
			// Check if the file exists
			if($check){
			?>
			<img id="img_<?php echo $i; ?>" class="cropimage" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($imageSeq)); ?>" onClick="funcChangeImage('<?php echo base64_encode(funcGetFileContent($imageSeq)); ?>','<?php echo $imageSeq; ?>','<?php echo $i; ?>','<?php echo $_GET['aid']; ?>');" style="width: 65px; height: 70px;">
			
			<?php } $j++; } ?>
			</p>
          </div>
	  
		
		<div id="showImage">Loading Image Please Wait...</div>
        
      </div>
    </div>
  </div>
</div>
</div>
<script>
$(document).ready(function(){
	//$('.bultable').scrollTop(2380);
})
/*function funcChangeImage(data,url,imgNo){
	$('.imgcrp').attr("src", 'data:image/jpg;base64,'+data);
	$('.imgcrp').attr("data-gallery", url);
	$('.jcrop-hline').prev().attr("src",'data:image/jpg;base64,'+data)
	
	// $('#img_'+imgNo).css("border","3px solid #35a160");
  $('.cropimage').removeClass("active");
  $('#img_'+imgNo).addClass("active");

}*/

function funcChangeImage(data,url,imgNo,aid){
	
	$("#showImage").load("loadimagecrop.php?aid="+aid+"&imgNo="+imgNo+"&formType=<?php echo trim($_GET['formType']); ?>");
	$('.cropimage').removeClass("active");
    $('#img_'+imgNo).addClass("active");

}

funcChangeImage('test','test','1','<?php echo $_GET['aid']; ?>');
</script> 

<?php include 'footer.php'; ?>

</body>
</html>
<style>

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
