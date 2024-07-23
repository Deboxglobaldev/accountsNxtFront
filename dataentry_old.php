<?php
include "inc.php";
include "logincheck.php";
$AcknowledgementNumber = $_GET['aid'];
$formType = $_GET['formType'];
$imagePath = $serverurlapi.'BulkUpload/uploads/panpdf/'.$AcknowledgementNumber.'.pdf';
logger(" Image path ".$imagePath);

$urlnew = $serverurlapi."User1Entry/callAcknowData.php?aid=".$_GET['aid'];
//Fetch data from get curl function
$result2 = getCurlData($urlnew);
//logger("RESPONSE RETURN FROM CALL ACKNOW API DATA-ENTRY PAN: ". $result2); 
$data2 = json_decode($result2);

$ApplicantStatus =  trim($data2->recordlist->STATUSOFAPPLICANT);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Data Entry</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<script src="js/jquery.min.js"></script>
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
  <!--  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div> -->
  <!--  <div class="hk-pg-wrapper"  style="background-image: url(img/Religare-Dashboard-BG.JPG);"> -->
  <div class="hk-pg-wrapper" style="padding-bottom: 0px!important;">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
    <div class="container-fluid">
      <div class="col-md-12 timeline-bg">
            <img src="img/Religare-Timeline-png04.png" class="timeline">
    </div>
  </div>
    <div class="container-fluid">
    <div class="row" style="outline: none;" tabindex="-1">
      <div class="col-xl-12">
        
        <section class="hk-sec-wrapper">
		
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
 	if(page == 2){
	
		//pageScr = 900;
	}else{
		//pageScr = 1800;
	}
  // $('#form1').contents().get(0);

  //$('#div1').scrollTop(pageScr);
 
/*$("#div1").scroll(function () { 
        $("#div2").scrollTop($("#div1").scrollTop());
        $("#div2").scrollLeft($("#div1").scrollLeft());
    });*/
	

$("#div2").scroll(function () { 
   var scroll2 = $("#div2").scrollTop();
  // alert(scroll2);
  //var scrollnew = $("#pdfshowId").contents().find('#scroller').scrollTop();
  //var scrollnew = $('#div1').scrollTop();
  //alert(scrollnew);
  //alert(scrollnew);
   scroll2 = (scroll2*.04)+ $("#div1").scrollTop();
   //alert(scroll2);
   //alert(scroll2);
   /*if(scroll2>2000){
   alert(scroll2);
 }*/
       //$("#pdfshowId").contents().find('#scroller').scrollTop(scroll2);
	   $("#div1").scrollTop(scroll2);
	   // window.scroll({ top: scroll2*.04, left: 100,behavior: 'smooth'});
        //$("#div1").scrollLeft($("#div2").scrollLeft());
    });

});

</SCRIPT>
<div style="grid-gap: 20px;display: grid;grid-template-columns: 1fr 1fr;">

          <div id="div1" tabindex="-1"  style="overflow:auto;height:500px;width:100%;border:1px solid black;">
            <iframe tabindex="-1" id="pdfshowId" src="" allowfullscreen  width="100%" style="height: 2000px;"></iframe>
            <script>
const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
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
$("#pdfshowId").attr("src", blobUrl+'#page=<?php echo $page; ?>&toolbar=0');
</script>
            <br>
            <br>
          </div>
          <div id="div2" style="overflow: auto;height:500px;width:100%;border:1px solid black;">
            <?php if($formType=="CR"){
          if(trim($ApplicantStatus)=='P'){
          $backLocation = 'cropingstage.php?aid='.$AcknowledgementNumber.'&formType='.$_GET['formType'].'';
          }else{
          $backLocation = 'filesubmit.php?aid='.$AcknowledgementNumber.'&formType='.$_GET['formType'].'';
          } ?>
            <iframe src="documentsform1cr.php?aid=<?php echo $AcknowledgementNumber; ?>&formType=<?php echo $_GET['formType']?>" width="100%" height="4500px" style=" border: 1px solid #ccc; display: block;" id="formcr"></iframe>
            <?php }else{
                if($page==2){
                  if(trim($ApplicantStatus)=='P'){
                  $backLocation = 'cropingstage.php?aid='.$AcknowledgementNumber.'&formType='.$_GET['formType'].'';
                  }else{
                  $backLocation = 'filesubmit.php?aid='.$AcknowledgementNumber.'&formType='.$_GET['formType'].'';
                  }
                ?>
            <iframe src="documentsform.php?aid=<?php echo $AcknowledgementNumber; ?>" width="100%" height="2000px" style=" border: 1px solid #ccc; display: block;" id="form1"></iframe>
            <?php     }elseif($page==3){ 
                $backLocation = 'dataentry.php?aid='.$AcknowledgementNumber.'&formType='.$_GET['formType'].'&page=2';
           ?>
            <iframe src="documentsform2.php?aid=<?php echo $AcknowledgementNumber; ?>" width="100%" height="3500px" style="border: 0px solid #ccc; display: block;" id="form2"></iframe>
            <?php 
        }
        ?>
          <?php } ?>
          </div>
        </div>
      <div class="nxrt" style="width: fit-content;display: flex;margin:10px auto;"> 
      <a href="<?php echo $backLocation; ?>" class="previous"><i class="fa fa-angle-left" ></i>&nbsp;&nbsp;Back</a>
      <button type="button"class="next" onClick="formSubmit('<?php echo $page; ?>','<?php echo $_GET['formType']; ?>');"> Save and Next <i class="fa fa-angle-right" ></i></button>
          </div>
        </section>
      
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script>

function formSubmit(pageid,formtype){
    if(pageid==2){
        if(formtype=='CR'){
            $('#formcr').contents().find('#formsubmit').click();
        }else{
            $('#form1').contents().find('#formsubmit').click();
        }
    }else if(pageid==3){
        $('#form2').contents().find('#formsubmit').click();
    }
}

	
</script>
<!--<script src="js/dataentryfromvalidate.js"></script>-->
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
    color: white
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
