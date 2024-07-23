<?php
 
include "inc.php";
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
        <form name="cropform" id="cropform" method="post" action="" target="">
        <section class="hk-sec-wrapper contas1" style="height: 50rem;">
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
			<img id="img_<?php echo $i; ?>" class="cropimage" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($imageSeq)); ?>" onClick="funcChangeImage('<?php echo base64_encode(funcGetFileContent($imageSeq)); ?>','<?php echo $imageSeq; ?>','<?php echo $i; ?>');" style="width: 65px; height: 70px;">
			
			<?php } $j++; } ?>
			</p>
          </div>
          <div class="container-fluid bultable" style="height: 50%; margin-top: 0px !important;">
		  <div class="row">
              <div class="col-xl-12">
			  	<?php echo '<img id="cropbox1" class="img imgcrp" src="data:image/jpg;base64,' . base64_encode(file_get_contents($imagePath)) . '" data-gallery="'.$imagePath.'"  />';  ?>
			  </div>
			</div>
<script>
$(document).ready(function(){
	//$('.bultable').scrollTop(2380);
})
function funcChangeImage(data,url,imgNo){
	$('.imgcrp').attr("src", 'data:image/jpg;base64,'+data);
	$('.imgcrp').attr("data-gallery", url);
	$('.jcrop-hline').prev().attr("src",'data:image/jpg;base64,'+data)
	
	// $('#img_'+imgNo).css("border","3px solid #35a160");
  $('.cropimage').removeClass("active");
  $('#img_'+imgNo).addClass("active");

}
</script> 
    		
		</div>
          <div class="container-fluid">
          <div class="row" style="margin-top:20px;">
            <div class="col-xl-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group" id="imgDiv"> 
                    <?php
					$photoPath = "data/temp/crop/".$_GET['aid']."_Photo.Jpg";
					$isPhotoExist = file_exists($photoPath);
					if($isPhotoExist == '1'){
					?>
                    <img class="photoshow" src="<?php echo $photoPath; ?>" style="padding: 10px; background: #e6f9e9; width: 55%;">
					<input type="hidden" name="hiddenphotoval" class="hiddenphotoval" value="1">
					<?php }else{ ?>
					<img class="photoshow" src="img/Religare-Photo.png" style="padding: 10px; background: #e6f9e9; width: 55%;">
					<input type="hidden" name="hiddenphotoval" class="hiddenphotoval" value="">
					<?php } ?>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="imgSignature"> 
				  	<?php
					$sigPath = "data/temp/crop/".$_GET['aid']."_Sig.Jpg";
					$isSigExist = file_exists($sigPath);
					if($isSigExist == '1'){
					?>
                    <img class="sigshow" src="<?php echo $sigPath; ?>" style="padding: 10px; background: #e6f9e9; width: 60%;">
					<input type="hidden" name="hiddenimageval" class="hiddenimageval" value="1">
					<?php }else{ ?>
					<img class="sigshow" src="img/Religare-Photo-and-Signature.png" style="padding: 10px; background: #e6f9e9; width: 60%;">
					<input type="hidden" name="hiddenimageval" class="hiddenimageval" value="">
                    <?php } ?>
                   </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <select name="imageType" id="imageType" class="form-control inputborder">
                      <option value="Photo">Photo</option>
                      <option value="Sig">Signature</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div id="btn" class="form-group">
                    <input type='button' id="crop" value='Upload' class="btn btn-default uploadbutton">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" style="float:right;">
                    <input type="hidden" name="aid" value="<?php echo $_GET['aid']; ?>">
                    <input type="hidden" name="action" value="cropimage">
					<input type="hidden" name="userId" value="<?php echo $_SESSION['UID']; ?>">
					<input type="hidden" name="ip" value="<?php echo $_SERVER["REMOTE_ADDR"]; ?>">
					<?php
					$backLocation = 'filesubmit.php?aid='.trim($_GET['aid']).'&formType='.trim($_GET['formType']);
					?>
					<a href="<?php echo $backLocation; ?>" class="previous" style="background: gray; border: 2px solid #808080;"><i class="fa fa-angle-left" ></i> Back</a>
                  </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group" id="imgSignature"> 
                      <button type="submit" class="next">Save and Next</button>
                   </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
  <div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br>Cropping... Please wait</div>
</div>
<script>
$('form').on('submit', function() {
	var photoval = $('.hiddenphotoval').val();
	var imageval = $('.hiddenimageval').val();
	
    // do validation here
    if(photoval!=1){
		alert('Please Crop Photo & Signature First!');
        return false;
	}
	if(imageval!=1){
		alert('Please Crop Photo & Signature First!');
        return false;
	}
		
});
</script>
<?php include 'footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
    var size;
	$('.imgcrp').Jcrop({
      aspectRatio: 0,
      onSelect: function(c){
       size = {x:c.x,y:c.y,w:c.w,h:c.h};
       $("#crop").css("visibility", "visible");     
      }
    });
    
    $("#crop").click(function(){
		$("#blkbox").show();
		//var img = $(".imgcrp").attr('src');
		var img = $(".imgcrp").attr('data-gallery');
        var imgType = $("#imageType").val();
        var ackNumber = "<?php echo $_GET['aid']; ?>";
		
		$.ajax({
		  url: "image-crop.php",
		  type: "POST",
		  cache:false,
		  data: {"img":img,"x":size.x,"y":size.y,"w":size.w,"h":size.h,"imgType":imgType,"ackNumber":ackNumber},
		  success: function (data,status) {
			console.log(data);
			var arr = JSON.parse(data);
			
			var src = arr[0];
			var imgTag = src.ImageTag;
			var htmlContent = imgTag.replace('&lt;','<').replace('&gt;','>').replace('&quot;','"').replace('&quot;','"');
			
			if(src.ImageType=="Photo"){
				$(".photoshow").attr("src",src.ImageTag);
				$(".hiddenphotoval").val("1");
				//$("#imgDiv").html(htmlContent);
			}else{
				$(".sigshow").attr("src",src.ImageTag);
				$(".hiddenimageval").val("1");
				//$("#imgSignature").html(htmlContent);
			}
            $("#blkbox").hide();
			html = '<img src="' + data + '" />';
			//$("#imgDiv").html(data);
			//location.reload();
		  },
		  error:function (xhr, textStatus, thrownError)
		  {
			ret_val=xhr.readyState;
			alert("status=" +xhr.status);
		  }
		});
        
		//$("#cropped_img").attr('src','image-crop.php?x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img+'&imgType='+imgType+'&ackNumber='+ackNumber);
        //location.reload(true);

    });
});


</script>
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
