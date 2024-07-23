<?php 
// get url
include "inc.php";
include "logincheck.php";

$searching = '{
    "ProductType":"'.$_POST['ProductType'].'",
    "fromDate":"'.date('Y-m-d',strtotime($_POST['fromDate'])).'",
    "toDate":"'.date('Y-m-d',strtotime($_POST['toDate'])).'"
}';

if($_POST['ProductType']=="PAN"){
  $url = $serverurlapi."General/reportAPI.php";
}else{
  $url = $serverurlapi."General/reportTanAPI.php";
}


if($_POST['action']=="searchaction")
{


logger($InfoMessage." PAN/TAN Commission list URL for API post - ".$url); 
logger($InfoMessage." PAN/TAN Commission list Value for API post list- ".$searching); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
//logger("RESPONSE RETURN FROM PAN/TAN Commission list: ". $result);
$resultData = json_decode($result, true);
curl_close($ch);
}


if($_POST['action']=="exportaction"){
  ob_start();
  logger($InfoMessage." PAN/TAN Commission URL for API - ".$url); 
  logger($InfoMessage." PAN/TAN Commission return from API - ".$searching); 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $result = curl_exec($ch);
  //logger("RESPONSE RETURN FROM PAN/TAN Commission: ". $result);
  $resultData = json_decode($result, true);
  curl_close($ch);
  // Filter the excel data 
  function filterData(&$str){ 
      $str = preg_replace("/\t/", "\\t", $str); 
      $str = preg_replace("/\r?\n/", "\\n", $str); 
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
  } 
  
  // Excel file name for download 
  $fileName = $_POST['ProductType']."_Commission_" . $_POST['fromDate'] . "_".$_POST['toDate'].".xls"; 
  
  // Column names 
  $fields = array('AckNo','AckDate', 'RejectionDate', 'AcceptanceDate', 'AcceptanceUser', 'DigDate', 'DigUser', 'QCDate', 'QCUser', 'BulkDate', 'BranchName');
  
  // Display column names as first row 
  $excelData = implode("\t", array_values($fields)) . "\n"; 

   if(isset($resultData['listOfData'])){                    
    $no=1;
    foreach($resultData['listOfData'] as $resultList){
      

         $lineData = array($resultList['AckNo'],$resultList['AckDate'], $resultList['RejectionDate'], $resultList['AcceptanceDate'], $resultList['AcceptanceUser'], $resultList['DigDate'], $resultList['DigUser'], $resultList['QCDate'], $resultList['QCUser'], $resultList['BulkDate'], $resultList['BranchName']); 
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
    <title>PAN/TAN Commission Report</title>
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
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper"> 
            <section>
                <div class="container-fluid">
                    <form action="" method="POST" autocomplete="nope" id="exportfrm" />
                    <div class="row gy-bvc">
                        <div class="col-md-2">
                            <h6 style="font-weight: initial;">Product Type</h6>
                            <select class="form-control" name="ProductType">
                            <option value="TAN" <?php if($_POST['ProductType']=="TAN"){ echo 'selected'; } ?>>TAN
                                </option>
                            <option value="PAN" <?php if($_POST['ProductType']=="PAN"){ echo 'selected'; } ?>>PAN
                                </option>
                            
                            </select>
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
                <table id="datatable" class="table table-striped table-bordered table-responsive" style="width:100%">
                    <thead>
                        <tr class="vcx-i hgt">
                            <th>AckNo.</th>
                            <th>Ack&nbsp;Date</th>
                            <th>RejectionDate</th>
                            <th>AcceptanceDate</th>
                            <th>AcceptanceUser</th>
                            <th>Dig&nbsp;Date</th>
                            <th>DigUser</th>
                            <th>QC&nbsp;Date</th>
                            <th>QCUser</th>
                            <th>Bulk&nbsp;Date</th>
                            <th>BranchName</th>
                        </tr>
                    </thead>
                    <tbody id="tablesearch">
                        <?php
    if(isset($resultData['listOfData'])){                    
    $no=1;
    $crTotal = 0;
    $drTotal = 0;
    foreach($resultData['listOfData'] as $resultList){
    ?>
                        <tr class="uyt hgte">
                            <td><?php echo $resultList['AckNo'] ?></td>
                            <td><?php if($resultList['AckDate']!=''){ echo date("d-m-Y",strtotime($resultList['AckDate'])); } ?></td>
                            <td><?php if($resultList['RejectionDate']!=''){ echo date("d-m-Y",strtotime($resultList['RejectionDate'])); } ?></td>
                            <td><?php if($resultList['AcceptanceDate']!=''){ echo date("d-m-Y",strtotime($resultList['AcceptanceDate'])); } ?></td>
                            <td><?php echo $resultList['AcceptanceUser']; ?></td>
                            <td><?php if($resultList['DigDate']!=''){ echo date("d-m-Y",strtotime($resultList['DigDate'])); } ?></td>
                            <td><?php echo $resultList['DigUser']; ?></td>
                            <td><?php if($resultList['QCDate']!=''){ echo date("d-m-Y",strtotime($resultList['QCDate'])); } ?></td>
                            <td><?php echo $resultList['QCUser']; ?></td>
                            <td><?php if($resultList['BulkDate']!=''){ echo date("d-m-Y",strtotime($resultList['BulkDate'])); } ?></td>
                            <td><?php echo $resultList['BranchName']; ?></td>
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