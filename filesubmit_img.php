<?php
include("inc.php");
include "logincheck.php";
$url = $serverurlapi."User1Entry/callAcknowData.php?aid=".$_GET['aid'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$data = json_decode($result);

$ApplicantStatus =  trim($data->recordlist->STATUSOFAPPLICANT);
$ApplicantTitle =  trim($data->recordlist->applicanttitlecode);
$APPLTITLE =  trim($data->recordlist->APPLTITLE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>File Submit Image PAN</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
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
.dostas5{
 font-size: 15px; 
}
</style>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
    <div class="row contas">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper contas1">
          <div class="dostas">
            <div style="display: flex;">
              <div class="dostas2"> </div>
              <h3>File Submit Image PAN</h3>
              <p></p>
              <div class="dostas1"> </div>
            </div>
          </div>
          <div class="container-fluid" style="border: 2px solid #79c117; border-radius: 0.25rem; padding: 15px; margin-top: 36px; margin-left: 0px!important;">
            <form name="curl_form" id="upload-file" method="post" action="#" enctype="multipart/form-data" target="actoinfrm">
               <?php  if($_GET['formType']=="49A" || $_GET['formType']=="49AA"){ ?>
        		<div style="display: grid;grid-template-columns: 24.3% 24.3% 24.3% 24.3%;grid-gap: 10px;">
      <?php } else{ ?>
        <div style="display: grid;grid-template-columns:32.7% 32.7% 32.7%;grid-gap: 10px;">
      <?php }?>
              <div style="border: 2px solid #6ab21e;padding: 15px 0px 15px 15px;display: grid;grid-gap: 12px;">
                    <div class="">
                      <h5 class="dostas5">Select Ack. Receipt</h5>
                    </div>
                    <div class="">
                      <h4>
                      <input name="doc_0" type="file" id="doc_0" accept="image/jpeg" required style="font-size: 14px;"/>
                      </h4>
                    </div>
                  </div>
			  <div style="border: 2px solid #6ab21e;padding: 15px 0px 15px 15px;display: grid;grid-gap: 12px;">

                    <div class="">
                      <h5 class="dostas5">Select Page 1</h5>
                    </div>
                    <div class="">
                       <h4>
                      <input name="doc_1" type="file" id="doc_1" accept="image/jpeg" required style="font-size: 14px;"/>
                      </h4>
                    </div>
                  </div>
			  
			  <?php 
			  if($_GET['formType']=="49A" || $_GET['formType']=="49AA"){
			  ?>
			  <div style="border: 2px solid #6ab21e;padding: 15px 0px 15px 15px;display: grid;grid-gap: 12px;">

                    <div>
                      <h5 class="dostas5">Select Page 2</h5>
                    </div>
                    <div class="">
                      <h4>
                      <input name="doc_2" type="file" id="doc_2" accept="image/jpeg" style="font-size: 14px;"/>
                      </h4>
                    </div>
                  </div>
			  <?php } ?>
			  <div style="border: 2px solid #6ab21e;padding: 15px 0px 15px 15px;display: grid;grid-gap: 12px;">
                    <div class="">
                      <h5 class="dostas5">Select Other Document</h5>
                    </div>
                    <div class="">
                       <h4>
                      <input name="doc_other[]" type="file" id="doc_other" accept="image/jpeg" multiple required style="font-size: 14px;"  />
                      </h4>
                    </div>               
              </div>
            </div>
              
              <div class="row" style="margin-top: 15px;">
			  
			  <div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <h5 class="dostas4">&nbsp;</h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                       <h4>
                      <button type="submit" class="btn btn-default uploadbutton"  >Upload</button>
                      </h4>
                    </div>
                  </div>
                </div>
				
				<div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                       <h4>
                      <h5 class="dostas4">&nbsp;</h5>
                      </h4>
                    </div>
                  </div>
                </div>
			  </div>
            </form>
          </div>
          <div class="container" style="margin-top: 50px;">
            <table class="table" id="ShowMessage" >
		 <tr class="headline">
		<td class="deta"> Upload Status</td>
		<td class="deta" style="font-size: 19px;"><p id="status"></p></td>
		
                </tr>
	       <tr class="headline">
		<td class="deta" > Remark</td>
		<td class="deta"><p id="remark"></p></td>
		
                </tr>



	     </table>
		 
		 <a href="filesubmit.php?aid=<?php echo $_GET['aid']; ?>&formType=<?php echo $_GET['formType']; ?>" class="btn btn-warning">Upload Document Via PDF</a>
              
				<?php
				$pdfPath = $serverurlapi.'BulkUpload/uploads/panpdf/'.$_GET['aid'].'.pdf';
				$imagePath = $serverurlapi.'BulkUpload/uploads/panimages/'.$_GET['aid'].'.jpg';
				
				if(trim($ApplicantStatus)=='P'){
				$stageurl = 'cropingstage.php?aid='.$_GET['aid'].'&formType='.$_GET['formType'];
				}else{
				$stageurl = 'dataentry.php?aid='.$_GET['aid'].'&formType='.$_GET['formType'];
				}
				
				
				if(trim($ApplicantTitle)!='' || trim($APPLTITLE)!=''){
				?>
				<div class="nxrt" style="width: fit-content;">
						<a href="<?php echo $pdfPath; ?>" target="_blank" class="previous" style="background-color: #9ba09d;text-decoration: none; color: #fff;">View PDF File</a>
						<a href="<?php echo $imagePath; ?>" target="_blank" class="previous" style="background-color: #9ba09d;text-decoration: none; color: #fff;">View Image File</a>
						<a href="<?php echo $stageurl; ?>" class="previous"><i class="fa fa-angle-Right"></i>  Move to Next Stage</a>
					</div>
				<?php 
				}
				?>	
						  </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
<script>
//$(document).ready(function () {
  $("form").submit(function (event) {
   $('#blkbox').show();
    var form_data;
    // Read selected files
   
		form_data = new FormData();
		
		form_data.append("doc_0", document.getElementById('doc_0').files[0]);
		
		form_data.append("doc_1", document.getElementById('doc_1').files[0]);
		
		<?php 
		  if($_GET['formType']=="49A" || $_GET['formType']=="49AA"){
		  ?>
		form_data.append("doc_2", document.getElementById('doc_2').files[0]);
		<?php } ?>
		var totalfiles = document.getElementById('doc_other').files.length;
		
		for (var index = 0; index < totalfiles; index++) {
			form_data.append("doc_other[]", document.getElementById('doc_other').files[index]);
	    }
		// AJAX request
		$.ajax({
			url: 'uploadcurlimg.php?ProductType=PAN&FormType=<?php echo $_GET['formType']; ?>&aid=<?php echo $_GET['aid']; ?>',
			type: 'post',
			data: form_data,
			//dataType: 'json',
			contentType: false,
			processData: false,
			success: function (response) {
			  $('#blkbox').hide();
			  console.log(response);
			 var arr = '['+response+']';
			 arr = JSON.parse(arr);
			 var src = arr[0];
			 
			 var statusShow = $('#status').text(src.status);
			 var remark = $('#remark').text(src.remark);
			 
			if(src.status=="Successfull"){
			var ApplicationCategory = '<?php echo trim($ApplicantStatus); ?>';
			  if(ApplicationCategory=='P'){
				window.location.href = '<?php echo 'cropingstage.php?aid='.$_GET['aid']; ?>&formType=<?php echo $_GET['formType']; ?>'; 
			  }else{
				window.location.href = '<?php echo 'dataentry.php?aid='.$_GET['aid']; ?>&formType=<?php echo $_GET['formType']; ?>'; 
			  }
			}else{
			  $('#status').css({
				 'font-weight' : '600',
				 'color' : 'red'
			  });
			  $('#remark').css({
				 'font-weight' : '600',
				 'color' : 'red'
			  });
			}
				
				},
				error:function(exception){
					alert('Exeption:'+exception);
				}
		});
	    
	
   	
   //var arr = [];
   

  });
  
//});
</script>
</body>
<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
  <div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br>
    Uploading... Please wait<br>
    <span id="uploadCount" style="font-weight: 700; color:blue;"></span></div>
</div>
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
