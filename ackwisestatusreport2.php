<?php 
// get url
include "inc.php";
include "logincheck.php";



if($_POST['ProductType']=="PAN"){
  $url = $serverurlapi."General/AckWiseReportAPI.php";
}else{
  $url = $serverurlapi."General/AckWiseReportAPI.php";
}

if(trim($_POST['fromDate'])!='' && trim($_POST['toDate'])!=''){
    $fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
    $toDate = date('Y-m-d',strtotime($_POST['toDate']));
}


if(trim($_POST['branchCode'])==''){
    $branchCode = 'all';
  }else{
    $branchCode = trim($_POST['branchCode']);
  }

if($_POST['action']=="searchaction")
{
    $searching = '{
        "type":"0",
        "BranchCode":"'.$branchCode.'",
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'",
        "DateType":"'.$_POST['dateType'].'",
        "AckNo":"'.$_POST['AckNo'].'",
        "ProductType":"'.$_POST['ProductType'].'"
        
    }';

    $result = postcurlData($url, $searching);
    //logger("RESPONSE RETURN FROM PAN/TAN Ack wise status: ". $result);
    $resultData = json_decode($result, true);
}


if($_POST['action']=="exportaction"){
  ob_start();

  $searching = '{
    "type":"1",
    "BranchCode":"'.$branchCode.'",
    "fromDate":"'.$fromDate.'",
    "toDate":"'.$toDate.'",
    "DateType":"'.$_POST['dateType'].'",
    "AckNo":"'.$_POST['AckNo'].'",
    "ProductType":"'.$_POST['ProductType'].'"
    
}';

  
  $result = postcurlData($url, $searching);
 //logger("RESPONSE RETURN FROM PAN/TAN Ack wise status: ". $result);
  $resultData = json_decode($result, true);

  // Filter the excel data 
  function filterData(&$str){ 
      $str = preg_replace("/\t/", "\\t", $str); 
      $str = preg_replace("/\r?\n/", "\\n", $str); 
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
  } 
  
  // Excel file name for download 
  $fileName = $_POST['ProductType']."_Ackwise_Status_Report_" . $_POST['fromDate'] . "_".$_POST['toDate'].".xls"; 
  
  // Column names 
  $fields = array('BranchCode','AckNumber', 'AckDate', 'NsdlDate', 'Status', 'RejectionDate', 'RejectionReason');
  
  // Display column names as first row 
  $excelData = implode("\t", array_values($fields)) . "\n"; 

   if(isset($resultData['ReportData'])){                    
    $no=1;
    foreach($resultData['ReportData'] as $resultList){
      
         $lineData = array($resultList['BranchCode'],$resultList['AckNumber'], $resultList['AckDate'], $resultList['NsdlDate'], $resultList['Status'], $resultList['RejectionDate'], $resultList['RejectionReason']); 
          array_walk($lineData, 'filterData'); 
          $excelData .= implode("\t", array_values($lineData)) . "\n"; 
         
      $no++;
      }
    }
    
    // Headers for download 
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    // Render excel data 
    echo $excelData; 
   
  
  exit;
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Ack. Wise Status Report</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    <?php include 'links.php'; ?>
    <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
    </script>
    <!-- Favicon -->
</head>

<body>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
        <!-- Top Navbar -->
        <?php include 'header.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper"> 
            <section>
                <div class="container-fluid">
                    <form action="" method="POST" autocomplete="nope" id="exportfrm" />
                    <div class="row gy-bvc">
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">Branch Code</h6>
                              <input type="text" name="branchCode" class="form-control"
                                  value="<?php if($_SESSION["Type"]=='BRANCH'){ echo $_SESSION["BID"]; }else{ echo $_POST["branchCode"]; } ?>" <?php if($_SESSION["Type"]=='BRANCH'){ ?> readonly="readonly" <?php } ?>>
                        </div>
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">From Date</h6>
                              <input type="text" name="fromDate" class="form-control datepicker"
                                  value="<?php echo $_POST["fromDate"]; ?>" readonly="readonly">
                        </div>
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">To Date</h6>
                                <input type="text" name="toDate" class="form-control datepicker"
                                    value="<?php echo $_POST["toDate"]; ?>" readonly="readonly">
                        </div>
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">Ack. No</h6>
                              <input type="text" name="AckNo" class="form-control" value="<?php echo $_POST["AckNo"];  ?>">
                        </div>
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">Date Type</h6>
                            <select class="form-control" name="dateType">
                                <option value="1" <?php if($_POST['dateType']=="1"){ echo 'selected'; } ?>>Ack. Date
                                </option>
                                <option value="2" <?php if($_POST['dateType']=="2"){ echo 'selected'; } ?>>Rejection Date
                                </option>
                                <option value="3" <?php if($_POST['dateType']=="3"){ echo 'selected'; } ?>>NSDL Confirmation Date
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">Product Type</h6>
                            <select class="form-control" name="ProductType">
                                <option value="PAN" <?php if($_POST['ProductType']=="PAN"){ echo 'selected'; } ?>>PAN
                                </option>
                                <option value="TAN" <?php if($_POST['ProductType']=="TAN"){ echo 'selected'; } ?>>TAN
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6>&nbsp;</h6>
                                <input type="hidden" id="action" name="action" value="" />
                                <input type="button" name="Search" class="btn btn-success"
                                    onClick="searchFunc('searchaction');" value="Search" />

                                <input type="button" name="Search" class="btn btn-success"
                                    onClick="searchFunc('exportaction');" value="Export Data" />

                            </div>
                        </div>

                    </div>
                    </form>
                   

                </div>

                <script>
                function searchFunc(data) {
                    $('#action').val(data);
                    $('form#exportfrm').submit();
                }

                /*function searchFunc(data){
  $('#action').val(data);
  var branch = $('#Branch').val();
  if(branch == ''){
  $('#Branch').focus().css("border-color","#c00101");
  }else{
  $('form#exportfrm').submit();
 }
}*/

                $(document).ready(function() {
                    $('select').selectize({
                        sortField: 'text'
                    });
                });
                </script>
                <script>
                $(function() {
                    $(".datepicker").datepicker({
                        dateFormat: 'dd-mm-yy',
                        maxDate: 0
                    });
                });
                </script>
            </section>
            <div class="container-fluid">
                <table id="datatable" class="table table-striped table-bordered table-responsive" style="width:100%;">
                    <thead>
                        <tr class="vcx-i hgt">
                            <th>BranchCode.</th>
                            <th>AckNumber</th>
                            <th>AckDate</th>
                            <th>NsdlDate</th>
                            <th>Status</th>
                            <th>RejectionDate</th>
                            <th>RejectionReason</th>
                        </tr>
                    </thead>
                    <tbody id="tablesearch">
                        <?php
    if(isset($resultData['ReportData'])){                    
    $no=1;
    $crTotal = 0;
    $drTotal = 0;
    foreach($resultData['ReportData'] as $resultList){
    ?>
                        <tr class="uyt hgte">
                            <td><?php echo $resultList['BranchCode'] ?></td>
                            <td><?php echo $resultList['AckNumber'] ?></td>
                            <td><?php echo $resultList['AckDate'] ?></td>
                            <td><?php echo $resultList['NsdlDate'] ?></td>
                            <td><?php echo $resultList['Status'] ?></td>
                            <td><?php echo $resultList['RejectionDate'] ?></td>
                            <td><?php echo $resultList['RejectionReason'] ?></td>
                        </tr>
                        <?php
    $no++;} ?>
                        
                        <?php }else{?>
                        <tr class="uyt hgte">
                            <td colspan="11">
                                <div align="center"><?php echo 'You Can Search...'; ?></div>
                            </td>
                        </tr>
                        <?php }
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
<style>
.ui-select {
    padding: 2%;
}

.hgt th {
    text-align: center;
    font-weight: bold;
}

.hgte td {
    text-align: center;
}

.gvre {
    display: flex;
    column-gap: 10px;
}

.lk-kl {
    width: fit-content;
    margin-left: auto;
    column-gap: 50px;
}

.pd-btn {
    padding: 3px 40px;
}

.pd-btn2 {
    padding: 3px 80px;
}

.flx {
    display: flex;
    column-gap: 12px;
}

.search-input-grid {
    display: grid;
    grid-gap: 5px;
}

.search-button {
    display: grid;
    grid-template-columns: auto auto;
    grid-gap: 20px;
}

.vcx-i {
    border-top: 2px solid;
    border-bottom: 2px solid;
}

.ht-jy {

    margin-top: 7%;
}

.inp-wuui {
    margin: 3px;
}

.gy-bvc {
    margin: 1%;
}

.nn-mb {
    margin-top: 3%;
}

.inp-w {
    width: 90%;
}

.uyt td {
    border: none;
}
</style>
<!--search filter-->
<script>
function searchingName() {
    var name = $("#bname").val().toLowerCase();
    $("#tablesearch tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
    });
}
</script>