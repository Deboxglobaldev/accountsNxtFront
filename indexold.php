<?php 
session_start();
include "inc.php";
logger("Session ...".$_SESSION["branchId"]);
if(!isset($_SESSION['branchId']))
{
    
  logger ("[ERR] - Session called 'branchId' is empty, expecting a branch Id");
  echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
  exit();
  
}
//get mis liste

  $totalPAN='';
  $totalpanNumber='';
  $totalfreshCategory='';
  
    $branchId = $_SESSION['branchId'];

    $url = $serverurlapi."Dashboards/misdataList.php?branchId=".$branchId;
    logger("URL -- ".$url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    if ($result =="")
    {
       Logger("[ERR] - No result came from API call ". $url);
    }
    else
    {
      logger("[INFO] - Return Json --- ".$misList);
      $misList = json_decode($result, true);
    }
     

    curl_close($ch);
    //count deshboard data
    $DataApiUrl = $serverurlapi."Dashboards/totalDashRecord.php?branchId=".$branchId;
    logger("URL -- ".$DataApiUrl);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $DataApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $countData = curl_exec($ch);
    curl_close($ch);
    logger("Response is ......" .$countData);
    //$countData = file_get_contents( $serverurlapi."Dashboards/totalDashRecord.php?branchId=".$branchId);
    if ($countData <> "")
    {  
      $data = json_decode($countData);
      logger("Response is ......" . $data->PanCount);
     
        $totalPAN = $data->PanCount;
        $totalpanNumber = "0";
        $totalfreshCategory = "0";
    }
    else
    {

      echo "There is Some problem in record fetch";

      logger ("[ERR] No result from back office URL '".$DataApiUrl."' -- Kindly validate teh back office");
    }

  



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>PAN Dashboard</title>
<meta name="description" content="PAN OFFICE" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
<?php include 'links.php'; ?>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">
    <div style="background-color: #1e733f;background-image:linear-gradient(to right,#1e733f,#79c117);padding:3px;">
      <div class="Container-fluid">
        <div class="row strip">
          <div class="col-sm-6">
            <p class="ticker">PLEASE SEND PHYSICAL APPLICATION ON TIME...</p>
          </div>
          <div class="col-sm-6">
            <p class="ticker">YOUR BRANCH AUDIT ID DUE ON 25 MARCH...</p>
          </div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Row -->
    <div class="row">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper">
          <div class="grid-container">
            <div class="item1">
              <div class="flex">
                <h4> PAN</h4>
                <h2><span class="fa fa-square-bracket-left "><a href="index.php?branchId=<?php echo $_SESSION['branchId']; ?>">
                  <?php if($totalPAN!=''){echo $totalPAN;}else{echo '0';} ?>
                  </a><span class="fa fa-square-bracket-right"></span></h2>
              </div>
              <!--                                 <i class="fal fa-brackets"></i>
                    -->
              <!--    <i class="fal-fa-brackets" style="font-size:24px"></i>
                    -->
            </div>
            <div class="item2">
              <div class="flex">
                <h4>TAN</h4>
                <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
            <div class="item3">
              <div class="flex">
                <h4>TDS/TCS</h4>
                <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
            <div class="item4">
              <div class="flex">
                <h4>e-TDS/TCS</h4>
                <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
            <div class="item5">
              <div class="flex">
                <h4>FORM 16A</h4>
                <h2><span class="fa fa-square-bracket-left ">0<span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
          </div>
        </section>
        <!--                              <second row>
-->
        <section class="hk-sec-wrapper" style="display: none;">
          <div class="grid-container">
            <div class="item1">
              <div class="flex">
                <h4>Correction</i></h4>
                <h2 style="color:red"><span class="fa fa-square-bracket-left ">7878<span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
            <div class="item2">
              <div class="flex">
                <h4>Rejected</h4>
                <h2><span class="fa fa-square-bracket-left ">78<span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
            <div class="item3">
              <div class="flex">
                <h4>Fresh</h4>
                <h2><span class="fa fa-square-bracket-left ">
                  <?php if($totalfreshCategory!=''){echo $totalfreshCategory;}else{ echo 0;} ?>
                  <span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
            <div class="item4">
              <div class="flex">
                <h4>NRI</h4>
                <h2><span class="fa fa-square-bracket-left ">
                  <?php if($totalpanNumber!=''){echo $totalpanNumber;}else{echo 0;} ?>
                  <span class="fa fa-square-bracket-right"></span></h2>
              </div>
            </div>
          </div>
        </section>
        <div>
          <div class="grid-container">
            <div class="item4">
              <div class="dropdown">
                <select class="select floating" name="stage" id="stage" autocomplete="off">
                  <option value=""> -- Select Stage-- </option>
                  <option value="yet to action">Yet To Action</option>
                </select>
              </div>
            </div>
            <div class="item4">
              <div class="dropdown">
                <select class="select floating" name="category" id="category" autocomplete="off">
                  <option value=""> -- Select Category-- </option>
                  <option value="49A">49A</option>
                  <option value="49AA">49AA</option>
                  <option value="CR">CR</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="headline">
              <th>Acknowledge No.</th>
              <th>Type</th>
              <th>Category</th>
              <th>Stage</th>
              <th>Sub Stage</th>
              <th>Last Activity Date</th>
            </tr>
          </thead>
          <tbody id="searchTable">
            <?php
				if(isset($misList['status'])=='true'){	
				if(isset($misList['misdata'])){									 
				$no=1;
				
				foreach($misList['misdata'] as $list){
				
				if($list['ApplicationCategory']=="INDIVIDUAL"  ){
				  if( strtoupper($list['SubStageId'])=="0"){
					$stagurl = "filesubmit.php?aid=".$list['AcknowledgementNumber'];
				  }elseif($list['SubStageId']=="1"){
					$stagurl = "cropingstage.php?aid=".$list['AcknowledgementNumber'];
				  }elseif($list['SubStageId']=="2"){
					$stagurl = "dataentry.php?aid=".$list['AcknowledgementNumber'];
				  }
				}else{
				  if($list['SubStageId']=="0"){
					$stagurl = "filesubmit.php?aid=".$list['AcknowledgementNumber'];
				  }elseif($list['SubStageId']=="2"){
					$stagurl = "dataentry.php?aid=".$list['AcknowledgementNumber'];
				  }
				}
				?>
            <tr>
              <td class="deta"><a href="<?php echo $stagurl; ?>" target="blank"><?php echo $list['AcknowledgementNumber']; ?></a></td>
              <td><?php echo $list['FormType']; ?></td>
              <td><?php echo $list['ApplicationCategory'];  ?></td>
              <td><?php echo $list['Stage']; ?></td>
              <td><?php echo $list['SubStage']; ?></td>
              <td><?php echo $list['ActivityDate']; ?></td>
            </tr>
            <?php
			 }}}else{
				echo 'no data found';
			 }
			?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
<!--search filter-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script>
$(document).ready(function(){
  $("#type").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#searchTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#category").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#searchTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#stage").on("change", function() {
    var value = $(this).val().toLowerCase();
    $("#searchTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>
