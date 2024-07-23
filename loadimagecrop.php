<?php
include "inc.php";
include "logincheck.php";
$aid = $_REQUEST['aid'];
$imgNo = $_REQUEST['imgNo'];
$imagePath = $targetImagePath."panimages/".$aid.'_'.$imgNo.'.jpg';
$formType = $_REQUEST['formType'];

?>

<form name="cropform" id="cropform" method="post" action="" target="">
        <section class="hk-sec-wrapper contas1" style="height: 50rem;">
          
          <div class="container-fluid bultable" style="height: 50%; margin-top: 0px !important;">
		  <div class="row">
              <div class="col-xl-12" >
			  	<?php
				echo '<img id="cropbox1" class="img imgcrp" src="data:image/jpg;base64,' . base64_encode(file_get_contents($imagePath)) . '" data-gallery="'.$imagePath.'"  />';
				?>
			  </div>
			</div>

    		
		</div>
          <div class="container-fluid">
          <div class="row" style="margin-top:20px;">
            <div class="col-xl-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group" id="imgDiv"> 
                    <?php
					$photoPath = "data/temp/crop/".$aid."_Photo.Jpg";
					$isPhotoExist = file_exists($photoPath);
					if($isPhotoExist == '1'){
					?>
                    <img class="photoshow" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($photoPath)); ?>" style="padding: 10px; background: #e6f9e9; width: 55%;">
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
					$sigPath = "data/temp/crop/".$aid."_Sig.Jpg";
					$isSigExist = file_exists($sigPath);
					if($isSigExist == '1'){
					?>
                    <img class="sigshow" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($sigPath)); ?>" style="padding: 10px; background: #e6f9e9; width: 60%;">
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
                    <input type="hidden" name="aid" value="<?php echo $aid; ?>">
                    <input type="hidden" name="action" value="cropimage">
					<input type="hidden" name="userId" value="<?php echo $_SESSION['UID']; ?>">
					<input type="hidden" name="ip" value="<?php echo $_SERVER["REMOTE_ADDR"]; ?>">
					<?php
					$backLocation = 'filesubmit.php?aid='.trim($aid).'&formType='.trim($formType);
					?>
					<a href="<?php echo $backLocation; ?>" class="previous" style="background: gray; border: 2px solid #808080;"><i class="fa fa-angle-left" ></i> Back</a>
                  </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group" id="imgSignature">
					<?php if(strtoupper($_SESSION['Type'])=="BCP"){ ?> 
                      <a href="dataentry.php?aid=<?php echo $AcknowledgementNumber; ?>&formType=<?php echo $_GET['formType']; ?>" class="previous">Save and Next</a>
					  <?php }else{ ?>
					  <button type="submit" class="next">Save and Next </button>
					  <?php } ?>
                   </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </section>
        </form>
		
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
        var ackNumber = "<?php echo $aid; ?>";
		
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