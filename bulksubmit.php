 <?php
include("inc.php");
include "logincheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Bulk Upload PAN</title>
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
<div class="hk-wrapper hk-vertical-nav">
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
              <h3>Bulk Upload PAN</h3>
              <p></p>
              <div class="dostas1"> </div>
            </div>
          </div>
          <div class="container-fluid" style="border: 2px solid #79c117; border-radius: 0.25rem; padding: 15px; margin-top: 36px; margin-left: 0px!important;">
            <form name="curl_form" id="upload-file" method="post" action="#" enctype="multipart/form-data" target="actoinfrm">
              <div class="row">
                <div class="col-lg-7">
                  <div class="row">
                    <div class="col-lg-2">
                      <h5 class="dostas4"> 1.</h5>
                    </div>
                    <div class="col-lg-5">
                      <label for="choose-file" class="custom-file-upload dostas4" id="choose-file-label"></label>
                      <input name="attachment[]" type="file" id="attachment" accept="application/pdf"  style="display: none;"  multiple onChange="selectFolder(event)" />
                    </div>
                    <div class="col-lg-5">
                      <div style="display: flex;">
                        <h5 class="dostas4" id="fileCount">No File Selected</h5>
                        <i class="fa fa-close cls cancelBtn" style="font-size:24px; display:none;"></i> </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="row">
                    <div class="col-lg-4">
                      <h4>
                        <button type="button" class="btn btn-default browsebutton" onClick="chooseFile();">Browse</button>
                      </h4>
                    </div>
                    <div class="col-lg-4">
                      <h4>
                        <button type="submit" class="btn btn-default uploadbutton" disabled >Upload</button>
                      </h4>
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
            <div id="id"></div>
            <table class="table" id="uploadListing">
              <thead>
                <tr class="headline">
                  <th>S.No</th>
                  <th>IDs</th>
                  <th>Upload Remark</th>
                  <th>Status</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
<script>
function selectFolder(e) {
    var theFiles = e.target.files;
    var relativePath = theFiles[0].webkitRelativePath;
    var folder = relativePath.split("/");
    $('#choose-file-label').text(folder[0]);
}

function chooseFile(){
	$('#attachment').click();
}

$(document).ready(function () {
	$('#attachment').change(function () {
    var numFiles = $(this).get(0).files.length
   		$('#fileCount').text(numFiles+' File Selected');
		$('.cancelBtn').show();
		
		//var i = $(this).prev('label').clone();
		//var file = $('#attachment')[0].files[0].name;
    //$(this).prev('label').text(file);
		
		$('.uploadbutton').removeAttr("disabled");
	}); 
});

//function to get the File Path
function getFile(filePath) {
   // return fileCompletePath = filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
   return fileNameWithOutExt = filePath.split('.')[0];  
}

  document.getElementById("attachment").addEventListener("change", function(event) {
  let output = document.getElementById("uploadListing");

  let files = event.target.files;
  $count = 1;
  var newcount = 0;
  for (let i=0; i<files.length; i++) {
    var fileFullName = files[i].name;
    var fileName = getFile(fileFullName);
    var fileExtention  = fileFullName.split('.')[1];
    var fileSize  = files[i].size;
    //fileSize = Math.round(fileSize/1000);
    fileSize = Math.round(fileSize);

    let item = document.createElement("tr");
    //item.innerHTML = files[i].webkitRelativePath;

   var ext = fileFullName.split('.').pop();
   //var extension = myfile.substr( (myfile.lastIndexOf('.') +1) );
   if(ext=="pdf" || ext=="PDF"){
    
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
	  	cell.className = "status_"+fileName;
        cell.setAttribute("id", "status"+newcount);
        var cellText = document.createTextNode("Pending");
      }else if(j==3){
	  cell.className = "remark_"+fileName;
	  //cell.className = "deta";
        cell.setAttribute("id", "remark"+newcount);
        var cellText = document.createTextNode("");
      }else if(j==4){
        var cellText = document.createTextNode(""+fileExtention);
      }else{
        //
      }
      cell.appendChild(cellText);
      item.appendChild(cell);
      
    }

    output.appendChild(item);
    $count++;  
    newcount++;
  }
    
  };
}, false);

</script>
<script>
//$(document).ready(function () {
  $("form").submit(function (event) {
   $('#blkbox').show();
    var form_data;
    // Read selected files
   var totalfiles = document.getElementById('attachment').files.length;
   console.log('Total File To Upload Is: '+totalfiles);
   var j = [];
   for (var index = 0; index < totalfiles; index++) {
   
		form_data = new FormData();
		var type =document.getElementById('attachment').files[index].type;
		if(type=="application/pdf"){
			form_data.append("attachment[]", document.getElementById('attachment').files[index]);
			form_data.append('TotalFileUpload', totalfiles);
			form_data.append('CurrentFileUpload', index);
		}
	   
		// AJAX request
		$.ajax({
			url: 'uploadcurl.php?ProductType=PAN',
			type: 'post',
			data: form_data,
			//dataType: 'json',
			contentType: false,
			processData: false,
			success: function (response) {
				console.log(response);
				var arr = '['+response+']';
				arr = JSON.parse(arr);
				//console.log(arr);
			
				var src = arr[0];
				var statusShow = $('.status_'+src.AckNumber).text(src.status+' - '+src.remark);
			
				if(src.status=="Successfull"){
					$('.status_'+src.AckNumber).css({
					'font-weight' : '600',
					'color' : 'green'
					});
					var remark = $('.remark_'+src.AckNumber).append('<i class="fa fa-check" style="font-size: 25px;color:green;"></i>');
				}else{
					$('.status_'+src.AckNumber).css({
					'font-weight' : '600',
					'color' : 'red'
					});
					var remark = $('.remark_'+src.AckNumber).append('<i class="fa fa-close" style="font-size: 25px;color:red;"></i>');
				}
         		
					j.push(src.SequenceNo);
					var returnLength = j.length;
						
					$('#uploadCount').text(returnLength+" File Proceed");
						
					if(returnLength==index){
						$('#blkbox').hide();
					}
				},
				error:function(exception){
					alert('Exeption:'+exception);
				}
		});
	    
	}
   	
   //var arr = [];
   

  });
  
//});
</script>
</body>
<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
  <div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br>
    Uploading... Please wait<br><span id="uploadCount" style="font-weight: 700; color:blue;"></span></div>
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
