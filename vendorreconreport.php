<?php 
// get url
include "inc.php";
include "logincheck.php";


$url = $serverurlapi."General/vendorRecAPI.php";

if (trim($_POST['fromDate'])!= '' && trim($_POST['toDate'])!= '') {
    $fromDate = date('Y-m-d', strtotime($_POST['fromDate']));
    $toDate = date('Y-m-d', strtotime($_POST['toDate']));
}

if($_POST['action']=="searchaction")
{

    $searching = '{
        "type":"0",
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'"
    }';
$result = postcurlData($url,$searching);
$resultData = json_decode($result, true);
}


if($_POST['action']=="exportaction"){

ob_start();

$searching = '{
    "type":"1",
    "fromDate":"'.$fromDate.'",
    "toDate":"'.$toDate.'"
}';

  $result = postcurlData($url,$searching);
  $resultData = json_decode($result, true);
  

  if(trim($_POST['reportType']) == "excel"){

    // Filter the excel data 
  function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "VendorReconciliation.xls"; 

// Column names 
$fields = array('VendorCode','VendorName','UserName', 'Product', 'SubProduct', 'ApplicationAssigned', 'DigitizationCompleted', 'PendingDigitization');

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

 if(isset($resultData['ReportData'])){                    
  $no=1;
  foreach($resultData['ReportData'] as $resultList){
    
       $lineData = array($resultList['VendorCode'], $resultList['VendorName'], $resultList['UserName'], $resultList['Product'], $resultList['SubProduct'], $resultList['Assigned'], $resultList['Digitized'], $resultList['Pending']);
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

  }else{
    $delimiter = ",";
        $filename = "VendorReconciliation.csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w');

        // Column names 
        $fields = array('VendorCode','VendorName','UserName', 'Product', 'SubProduct', 'ApplicationAssigned', 'DigitizationCompleted', 'PendingDigitization');

        fputcsv($f, $fields, $delimiter);

        if(isset($resultData['ReportData'])){                    
            $no=1;
            foreach($resultData['ReportData'] as $resultList){
              
                 $lineData = array($resultList['VendorCode'], $resultList['VendorName'], $resultList['UserName'], $resultList['Product'], $resultList['SubProduct'], $resultList['Assigned'], $resultList['Digitized'], $resultList['Pending']);
                 fputcsv($f, $lineData, $delimiter);  
                 
              $no++;
            }

            // Move back to beginning of file 
            fseek($f, 0);
        }

        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer 
        fpassthru($f);

  }
   
   
  exit;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Vendor Reconcilation Report</title>
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
    
      <div class="container-fluid">
        <form action="" method="POST" autocomplete="nope" id="exportfrm" >
          <div class="row gy-bvc">
            <div class="col-md-2">
              <h6 style="font-weight: initial;">From Date</h6>
              <input type="date" name="fromDate" class="form-control"
                                  value="<?php echo $_POST["fromDate"]; ?>" required />
            </div>
            <div class="col-md-2">
              <h6 style="font-weight: initial;">To Date</h6>
              <input type="date" name="toDate" class="form-control"
                                    value="<?php echo $_POST["toDate"]; ?>" required />
            </div>
            <div class="col-md-2">
              <h6 style="font-weight: initial;">Report Type</h6>
              <select class="form-control" name="reportType" onChange="$('#expbtn').removeAttr('disabled');">
                <option value="">Select</option>
                <option value="csv">CSV Format</option>
                <option value="excel">Excel Format</option>
              </select>
            </div>
            <div class="col-md-3">
              <div>
                <h6>&nbsp;</h6>
                <input type="hidden" id="action" name="action" value="" />
                <input type="submit" name="Search" class="btn btn-success"
                                    onClick="searchFunc('searchaction');" value="Search"  />
                <input type="submit" name="Search" class="btn btn-success"
                                    onClick="searchFunc('exportaction');" value="Export Data"  id="expbtn" disabled  />
              </div>
            </div>
          </div>
        </form>
      </div>
<script>
    function searchFunc(data) {
        $('#action').val(data);
        //$('form#exportfrm').submit();
    }
</script>

    
    <div class="container-fluid">
      <table id="datatable" class="table table-striped table-bordered table-responsive" style="width:100%;">
        <thead>
          <tr class="vcx-i hgt">
            <th>VendorCode</th>
            <th>VendorName</th>
            <th>UserName</th>
            <th>Product</th>
            <th>SubProduct</th>
            <th>ApplicationAssigned</th>
            <th>DigitizationCompleted</th>
            <th>PendingDigitization</th>
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
            <td><a href="vendorrecondetail.php?vid=<?php echo encode($resultList['UserId']); ?>&action=searchaction&fromDate=<?php echo encode($fromDate); ?>&toDate=<?php echo encode($toDate); ?>&SubProduct=<?php echo encode($resultList['SubProduct']); ?>" target="Blank__" style="font-weight:700;"><?php echo $resultList['VendorCode']; ?></a></td>
            <td><?php echo $resultList['VendorName']; ?></td>
            <td><?php echo $resultList['UserName']; ?></td>
            <td><?php echo $resultList['Product']; ?></td>
            <td><?php echo $resultList['SubProduct']; ?></td>
            <td><?php echo $resultList['Assigned']; ?></td>
            <td><?php echo $resultList['Digitized']; ?></td>
            <td><?php echo $resultList['Pending']; ?></td>
          </tr>
          <?php
    $no++;} ?>
          <?php }else{?>
          <tr class="uyt hgte">
            <td colspan="11"><div align="center"><?php echo 'You Can Search...'; ?></div></td>
          </tr>
          <?php }
    ?>
        </tbody>
      </table>
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
