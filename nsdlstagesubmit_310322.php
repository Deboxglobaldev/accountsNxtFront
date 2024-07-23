<?php 
include "inc.php";
include "logincheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>NSDL File [PAN]</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
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
              <h3><?php if($_GET['type']=='batchfile'){ echo 'NSDL Batch File Upload [PAN]'; } if($_GET['type']=='accecptedfile'){ echo 'NSDL Accecpted File Upload [PAN]'; } if($_GET['type']=='allotmentfile'){ echo 'NSDL Allotment File Upload [PAN]'; } if($_GET['type']=='batchstatusfile'){ echo 'Batch Status [PAN]'; } ?></h3>
              <div class="dostas1"> </div>
            </div>
          </div>
		  <?php if(isset($_SESSION['error'])!=''){ ?>
		  <div class="bs-example" style="padding-top: 14px"> 
			<!-- Success Alert -->
			<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
				 <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		  </div>
		  <?php } ?>
		  <form class="form-inline" action="" method="post" enctype="multipart/form-data"> 
          <div class="container-fluid dostas3">
                <div class="row">
                  <div class="col-lg-6">
                    <input type="file" name="file" class="form-control" id="file" placeholder="File" required>
                  </div>
                  <div class="col-lg-2">
                    <h4>
                      <button type="button" class="btn btn-default uploadbutton" id="misfileupload">upload</button>
                    </h4>
                  </div>
				  <div class="col-lg-2">
                    <h4>
                     <!-- <a href="mislogfile.php" target="_blank"><button type="button" class="btn btn-default" style="background-color: darkorange;color:#FFFFFF">View Log</button></a>-->
                    </h4>
                  </div>
               </div>
          </div>
		 
		  </form>
		  <div class="container bultable">
            <table class="table">
              <thead>
                <tr class="headline">
					<th><?php if($_GET['type']=='batchstatusfile'){ echo "Batch Number"; }else{ echo "Acknowledegment Number"; } ?></th>
                    <th>Status</th>
					</tr>
              </thead>
              <tbody id="returndata">
			  
              </tbody>
            </table>
		  </div>
         <!--<div class="model-busy" style="display:none">
		   <div class="center-busy">
		     <img alt="" src="img/Spin.gif" /><br>
			 <p style="color:#003399;">Please wait we are Uploading data. It may take few minute</p>
		   </div>
		 </div>-->
		 
		 
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">

document.getElementById('file').onchange = function() {

  var file = this.files[0];
  var FR = new FileReader();

  FR.readAsText(file);
  FR.onload = function(data) {
    var myVar = data.target.result;
	var lines = myVar.split("\n");
	var  linesmm = array.filter(lines);
	alert(linesmm.length);
  }
  
};

$(document).ready(function(){
	$("#misfileupload").click(function(){
	    $("#blkbox").show();
        var formData = new FormData();
        var files = $('#file')[0].files;
        // Check file selected or not
        if(files.length > 0 ){
           formData.append('file',files[0]);
		   $.ajax({
              url: '<?php if($_GET['type']=="batchfile"){ ?>nsdlstageuploadfile.php<?php } if($_GET['type']=="accecptedfile"){ ?>nsdlaccecpteduploadfile.php<?php } if($_GET['type']=="allotmentfile"){ ?>nsdlpanallotuploadfile.php<?php } if($_GET['type']=="batchstatusfile"){ ?>nsdlbatchstatusuploadfile.php <?php } ?>',
              type: 'post',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
			  console.log(response);
			  	const obj = JSON.parse(JSON.stringify(response));
				const list = JSON.parse(obj);
				//console.log((list.listOfData[0].AcknowledgmentNumber));
				var arrDataList = list[0];
				if(arrDataList.Status==2){
					alert(arrDataList.message);
				}else{
				var listlength = list.length;
				console.log(listlength);
				var totalarr = (arrDataList.listOfData).length;
				console.log(totalarr);
				var trHTML = '';
				var j=0;
				for(var i=1; i<=listlength;i++){
					trHTML +=
                                    '<tr><td>'
                                    + list[j].listOfData[0].AcknoNumber
                                    + '</td><td>'
                                    + list[j].listOfData[0].StageStatus
                                    + '</td></tr>';	
				j++;				
				}
				$('#returndata').append(trHTML);
				}
				$("#blkbox").hide();
              },
           });
        }else{
           alert("Please select a file.");
        }
    });
});
</script>
<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
 
 <div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br> 
 <?php if($_GET['type']=="accecptedfile"){ ?>Updating... Please wait it may take few minutes <?php }else{ ?>Updating... Please wait it may take few minutes <?php  }?>
   </div>
 </div>
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

.model-busy
{
position:fixed;
z-index:999;
height:100%;
width:100%;
top:0;
left:0;
background-color:black;
filter:alpha(opacity=60);
opacity:0.6;
-moz-opacity:0.8;
}
.center-busy
{
z-index:1000;
margin:300px auto;
padding:0px;
width:130px;
filter: alpha(opacity=100);
opacity:1;
-moz-opacity:1;
}
.center-busy img
{
height:128px;
width:128px;
}
</style>
