<?php
include "inc.php";
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
<title>File Submit PAN</title>
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
</style>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="">
    <!-- Row -->
    <div class="container-fluid">
      <div class="col-md-12 timeline-bg">
            <img src="img/Religare-Timeline-png02.png" class="timeline">
    </div>
  </div>
    <div class="row contas">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper contas1">
          <div class="dostas">
            <div style="display: flex;">
              <div class="dostas2"> </div>
              <h3>File Submit PAN [<?php echo $_GET['aid']; ?>]</h3>
              <p></p>
              <div class="dostas1"> </div>
            </div>
          </div>
          
          <div class="container-fluid" style="width: 61%;
    border: 2px solid #79c117;
    border-radius: 0.25rem;
    padding: 15px;
    margin-top: 36px;">
            

		  <form name="curl_form" id="upload-file" method="post" action="#" enctype="multipart/form-data" target="actoinfrm">
            <div class="row">
              <div class="col-lg-7">
                <div class="row">
                   
                  <div class="col-lg-6">
                    <label for="choose-file" class="custom-file-upload dostas4" id="choose-file-label"></label>
					<input name="attachment[]" type="file" id="attachment" accept="application/pdf"  style="display: none;" multiple onChange="selectFolder(event)" />
                  </div>
                  <div class="col-lg-6">
                    <div style="display: flex;">
                      <h5 class="dostas4" id="fileCount">No File Selected</h5>
                      <i class="fa fa-close cls cancelBtn" style="font-size:24px; display:none;" onClick="window.location.reload();"></i>	</div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="row">
                  <div class="col-lg-6">
                      <button type="button" class="btn btn-default browsebutton" onClick="chooseFile();">Browse</button>
                  </div>
                  <div class="col-lg-6">
					  <button type="submit" class="btn btn-default uploadbutton" disabled >Upload</button>

                  </div>
                  <!--<div class="col-lg-4">
                    <h4>
                      <button type="button" class="btn btn-default submitbutton">Submit</button>
                    </h4>
                  </div>-->
                </div>
              </div>
            </div>

		  </form>	
          </div>

          <div class="container bultable">
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
		 
		<!--<a href="filesubmit_img.php?aid=<?php echo $_GET['aid']; ?>&formType=<?php echo $_GET['formType']; ?>" class="btn btn-warning">Upload Document Via Image</a>-->
		 
              <table class="table" id="uploadListing" style="display:none;">
              <thead>
                <tr class="headline">
                  <th>S.No</th>
                  <th>IDs</th>
                  <th>Upload Status</th>
                  <th>Remark</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
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
 

function chooseFile(){
	$('#attachment').click();
}


function chooseFile(){
	$('#attachment').click();
}

$(document).ready(function () {
  $('#attachment').change(function () {
    var getaid = '<?php echo $_GET['aid'].'.pdf'; ?>';
    var numFiles = $(this).get(0).files.length
      $('#fileCount').text(numFiles+' File Selected');
    $('.cancelBtn').show();
    
    var i = $(this).prev('label').clone();
    var file = $('#attachment')[0].files[0].name;

    $(this).prev('label').text(file);
    if(getaid!=file.toLowerCase()){
      $('#fileCount').text('Invalid File No');
    }else{
      $('.uploadbutton').removeAttr("disabled");
    }
    
  }); 
});

//function to get the File Path
function getFile(filePath) {
   // return fileCompletePath = filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
   return fileNameWithOutExt = filePath.split('.')[0];  
} 

  document.getElementById("attachment").addEventListener("change", function(event) {
  let output = document.getElementById("uploadListing");
   output.find("tr:gt(0)").remove() ;
  let files = event.target.files;
  $count = 1;
  for (let i=files.length-1; i<files.length; i++) {
    let item = document.createElement("tr");
    var fileFullName = files[i].name;
    var fileName = getFile(fileFullName);
    var fileExtention  = fileFullName.split('.')[1];
    var fileSize  = files[i].size;
    //fileSize = Math.round(fileSize/1000);
    fileSize = Math.round(fileSize);
    //item.innerHTML = files[i].webkitRelativePath;
    for (var j = 0; j < 5; j++) {
      // Create a <td> element and a text node, make the text
      // node the contents of the <td>, and put the <td> at
      // the end of the table row
      var cell = document.createElement("td");
	   if(j==0){
	  	cell.className = "deta";
        var cellText = document.createTextNode(""+$count);
      }else if(j==1){
	  	cell.className = "deta";
        var cellText = document.createTextNode(""+fileName);
      }else if(j==2){
        cell.setAttribute("id", "status"+i);
        var cellText = document.createTextNode("Pending");
      }else if(j==3){
        cell.setAttribute("id", "remark"+i);
        var cellText = document.createTextNode("-");
      }else if(j==4){
        var cellText = document.createTextNode(""+fileExtention);
      }else{
        //
      }
      cell.appendChild(cellText);
      item.appendChild(cell);
      
    }
     //$("someTableSelector").find("tr:gt(0)").remove();
    
    output.appendChild(item);
    $count++;  
  };
}, false);

</script> 
<script>
$(document).ready(function () {
  $("form").submit(function (event) {
    $('#blkbox').show();
	var form_data;
    // Read selected files
   var totalfiles = document.getElementById('attachment').files.length;
   for (var index = 0; index < totalfiles; index++) {
   	  form_data = new FormData();
      form_data.append("attachment[]", document.getElementById('attachment').files[index]);
	  form_data.append('TotalFileUpload', totalfiles);
	  form_data.append('CurrentFileUpload', index);
	  // AJAX request
	   $.ajax({
		 url: 'uploadcurl.php?ProductType=PAN', 
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
   }
   //var arr = [];
   

  });
});
</script>
</body>
<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
 
 <div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br> 
   Uploading... Please wait</div>
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

background: rgb(247 141 70);
    padding: 6px 8px;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    bottom: -5px;
}
.contas{
  margin-left: 0px!important;
  margin-right: 0px!important;
margin-top: 15px!important;
}
</style>
