<?php 
include 'inc.php';
include "logincheck.php";

if($_POST['action']=="submitbatchfile"){
	print_r($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Batch File Uplaod</title>
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
  <div class="hk-pg-wrapper"  style="background-image: url(img/Religare-Dashboard-BG.JPG);">
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
              <h3>Batch File Uplaod</h3>
              <div class="dostas1"> </div>
            </div>
          </div>
          <?php if(isset($_SESSION['error'])!=''){ ?>
          <div class="bs-example" style="padding-top: 14px">
            <!-- Success Alert -->
            <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
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
              </div>
            </div>
          </form>
          <div class="container bultable">
            <div id="tabledata">
              <form method="post" action="">
                <div id="batchbutton" style="display:none;">
                  <button type="submit" class="btn btn-success" style="font-size: 12px;">Submit Data</button>
                </div>
                <input type="hidden" name="action" value="submitbatchfile">
                <table class="table table-bordered " id="tableID" style="width:100% !important;">
                  <thead>
                    <tr class="headline" style="background: #5ea923;">
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;"><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>
					  <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Acknowledge No.</th>
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Category</th>
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Batch No.</th>
                    </tr>
                  </thead>
                  <tbody id="searchTable">
                   
                  </tbody>
                </table>
              </form>
            </div>
          </div>
          <div class="model-busy" style="display:none">
            <div class="center-busy"> <img alt="" src="img/Spin.gif" /> </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){

    $("#misfileupload").click(function(){
	    $(".model-busy").show();
        var formData = new FormData();
        var files = $('#file')[0].files;
        // Check file selected or not
        if(files.length > 0 ){
           formData.append('file',files[0]);
			$.ajax({
              url: 'batchuploadfileparse.php?action=batchfileupload',
              type: 'post',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
			 	//console.log(response);
			    //const obj = JSON.parse(JSON.stringify(response));
				const list = JSON.parse(response);
				console.log(list);
                 $(".model-busy").hide();
				 var trHTML = '';
				 for(var index = 0; index < list.length; index++) {
				 	src = list[index];
					trHTML +=
						'<tr><td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="'+src.AcknowledgementNumber+'" name="acknowledgmentchecksingle[]" class="deleteack" /></td><td class="deta">'
						+ src.AcknowledgementNumber
						+ '</td><td>'
						+ '</td><td>'
						+ src.BatchNo
						+ '</td></tr>';
				 }
				 $('#searchTable').append(trHTML);
				 
              },
           });
        }else{
           alert("Please select a file.");
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
    // check uncheck all inclusions
    $("#ackknowledmentCheckAll").click(function(){
    if(this.checked){
      $('.deleteack').each(function(){
        this.checked = true;
      })
    }else{
      $('.deleteack').each(function(){
        this.checked = false;
      })
    }
    });
    
    });

    window.setInterval(function(){ 
      checked = $("#tabledata input[type=checkbox]:checked").length;
      if(!checked) { 
    $("#batchbutton").hide();
      } else {
    $("#batchbutton").show();
    } 
}, 100);
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
