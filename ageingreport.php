<?php
include "inc.php";
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url);

if($_POST['action']=="ageingreport")
{
$jsonData = '{
    "Period":"'.$_POST['period'].'",
    "Type":"'.$_POST['type'].'"
}';

$url = $serverurlapi."General/ageingreportAPI.php";
logger($InfoMessage." URL for API - ".$url); 
logger($InfoMessage." Value for API - ".$jsonData); 
$resultData = postCurlData($url,$jsonData);
$arrData = json_decode($resultData,true); 
//logger('RESPONCE RETURN FROM AGEING REPORT API: '.$resultData);

//Filter the excel data
function filterData(&$str){
  $str = preg_replace("/\t/", "\\t", $str); 
  $str = preg_replace("/\r?\n/", "\\n", $str); 
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}



// Excel file name for download 
$fileName = "Ageing_Report_".$arrData['Type'].date('Y-m-d').".xls";

// Column names
$fields = $arrData['FileHeader'];

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

if(isset($arrData['Status'])=='true'){
  if(isset($arrData['listOfData'])){                    
    $no=0;
          
    foreach($arrData['listOfData'] as $resultList){
        $lineData = $arrData['listOfData'][$no];
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n";
        $no++;
    }
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
    <title>Ageing Report</title>
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
                        <div class="col-md-4">
                            <div>
                            <h6 style="font-weight: initial;">&nbsp;</h6>
                                <select name="period" id="period" class="form-control">
                                    <!-- <option value="">Select Period</option> -->
                                    <option value="1" <?php if($_POST['period']==1){ echo 'selected'; } ?>>Weekly</option>
                                    <option value="2" <?php if($_POST['period']==2){ echo 'selected'; } ?>>Monthly</option>
                                    <option value="3" <?php if($_POST['period']==3){ echo 'selected'; } ?>>Yearly</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div>
                            <h6 style="font-weight: initial;">&nbsp;</h6>
                                <select name="type" id="type" class="form-control">
                                    <!-- <option value="">Select</option> -->
                                    <option value="Credit" <?php if($_POST['type']=='Credit'){ echo 'selected'; } ?>>Credit</option>
                                    <option value="Debit" <?php if($_POST['type']=='Debit'){ echo 'selected'; } ?>>Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div>
                                <h6>&nbsp;</h6>
                                <input type="hidden" id="action" name="action" value="ageingreport" />
                                <div style="display:grid;grid-template-columns: auto auto;grid-gap: 10px;">
                                    <input type="submit" name="getReport" class="btn btn-success" value="Download Report" />
                                </div>
                            </div>
                        </div>

                    </div>
                    </form>

                </div>
            </section>
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