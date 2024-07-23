<?php 
// get url
include "inc.php";
include "logincheck.php";

if($_POST['ProductType']=="PAN"){
  $url = $serverurlapi."General/queryScreenPANAPI.php";
}else{
  $url = $serverurlapi."General/queryScreenTANAPI.php";
}

if(trim($_POST['branchCode'])==''){
    $branchCode = 'all';
}else{
    $branchCode = trim($_POST['branchCode']);
}

if(trim($_POST['fromDate'])!='' && trim($_POST['toDate'])!=''){
    $fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
    $toDate = date('Y-m-d',strtotime($_POST['toDate']));
}


if($_POST['action']=="searchaction")
{
    $searching = '{
        "type":"0",
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'",
        "Branch":"'.$branchCode.'",
        "Filter":"'.$_POST['Filter'].'",
        "FilterCond":"'.$_POST['FilterCond'].'",
        "FilterName":"'.$_POST['FilterName'].'"
    }';
    
    $result = postCurlData($url,$searching);
    //logger('RESPONCE RETURN FRO QUEry screen report: '.$result);
    $resultData = json_decode($result, true);
}


if($_POST['action']=="exportaction"){

ob_start();

$searching = '{
    "type":"1",
    "fromDate":"'.$fromDate.'",
    "toDate":"'.$toDate.'",
    "Branch":"'.$branchCode.'",
    "Filter":"'.$_POST['Filter'].'",
    "FilterCond":"'.$_POST['FilterCond'].'",
    "FilterName":"'.$_POST['FilterName'].'"
}';

  $result = postCurlData($url,$searching);
  $resultData = json_decode($result, true);

  if(trim($_POST['reportType'])=="excel"){

  // Filter the excel data 
  function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
  } 


// Excel file name for download 
$fileName = $_POST['ProductType']."_QueryScreen_Report_" . $_POST['fromDate'] . "_".$_POST['toDate'].".xls"; 

// Column names 
$fields = array('AcknowledgementNo','PanNumber', 'AckDate', 'Branch', 'ApplicantCategory', 'BatchNo', 'Name', 'Document');

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

 if(isset($resultData['ReportList'])){                    
  $no=1;
  foreach($resultData['ReportList'] as $resultList){
    
       $lineData = array($resultList['AcknowledgementNo'],$resultList['PanNumber'], $resultList['AckDate'], $resultList['Branch'], $resultList['ApplicantCategory'], $resultList['BatchNo'], $resultList['Name'], $resultList['Document']); 
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
    $filename = $_POST['ProductType']."_QueryScreen_Report_" . $_POST['fromDate'] . "_".$_POST['toDate'].".csv";

    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
    
    // Column names 
    $fields = array('AcknowledgementNo','PanNumber', 'AckDate', 'Branch', 'ApplicantCategory', 'BatchNo', 'Name', 'Document');

    fputcsv($f, $fields, $delimiter); 

    if(isset($resultData['ReportList'])){                    
        $no=1;
        foreach($resultData['ReportList'] as $resultList){
          
             $lineData = array($resultList['AcknowledgementNo'],$resultList['PanNumber'], $resultList['AckDate'], $resultList['Branch'], $resultList['ApplicantCategory'], $resultList['BatchNo'], $resultList['Name'], $resultList['Document']); 
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
    <title>Query Screen Report</title>
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
                    <form action="" method="POST" autocomplete="nope" id="exportfrm">
                        <div class="row gy-bvc">
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Receipt From Date</h6>
                                <input type="date" name="fromDate" class="form-control"
                                    value="<?php echo $_POST["fromDate"]; ?>" required>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Receipt To Date</h6>
                                <input type="date" name="toDate" class="form-control"
                                    value="<?php echo $_POST["toDate"]; ?>" required>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Product Type</h6>
                                <select class="form-control" name="ProductType" onChange="changeFilterValue(this.value);">
                                    <option value="PAN" <?php if($_POST['ProductType']=="PAN"){ echo 'selected'; } ?>>
                                        PAN
                                    </option>
                                    <option value="TAN" <?php if($_POST['ProductType']=="TAN"){ echo 'selected'; } ?>>
                                        TAN
                                    </option>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Branch Code</h6>
                                <select class="form-control" name="branchCode" id="branchCode">
                                    <option value="">All Branch</option>
                                    <option value="all">All Branch</option>
                                    <?php
                                    $branchsearch ='';
                                    $branchapiurl = $serverurlapi."General/branchinfoList.php";
                                    $resultBranchData = postCurlData($branchapiurl,$branchsearch);
                                    $branchData = json_decode($resultBranchData, true);
                                    foreach($branchData['branchlist'] as $BranchResultList){
                                    ?>
                                    <option value="<?php echo $BranchResultList['BranchCode']; ?>" <?php if ($_POST['branchCode'] == $BranchResultList['BranchCode']) { echo 'selected';  } ?>><?php echo $BranchResultList['Name']; ?> [<?php echo $BranchResultList['BranchCode']; ?>]</option>
                                    <?php } ?>
                            </select>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Advanced Filter</h6>
                                <select class="form-control" name="Filter" id="advanceFiter">
                                    <?php
                                    if(trim($_POST['ProductType'])=="PAN"){
                                        ?>
                                            <option value="">Select</option>
                                            <option value="AKNOWLEDGEMENT-NO" <?php if($_POST['Filter']=="AKNOWLEDGEMENT-NO"){ echo 'selected'; } ?>>RECEIPT NUMBER</option>
                                            <option value="APPFNAME" <?php if($_POST['Filter']=="APPFNAME"){ echo 'selected'; } ?>>APPLICANT FIRST NAME</option>
                                            <option value="APPMNAME" <?php if($_POST['Filter']=="APPMNAME"){ echo 'selected'; } ?>>APPLICANT MIDDLE NAME</option>
                                            <option value="APPLNAME" <?php if($_POST['Filter']=="APPLNAME"){ echo 'selected'; } ?>>APPLICANT LASTN AME</option>
                                            <option value="APPLICANT-CATEGORY" <?php if($_POST['Filter']=="APPLICANT-CATEGORY"){ echo 'selected'; } ?>>APPLICANT STATUS</option>
                                            <option value="NAMETOBEPRINTED" <?php if($_POST['Filter']=="NAMETOBEPRINTED"){ echo 'selected'; } ?>>CARDDISPLAY NAME</option>
                                            <option value="PAN-NUMBER" <?php if($_POST['Filter']=="PAN-NUMBER"){ echo 'selected'; } ?>>PANNUMBER</option>
                                            <option value="AKNW-DATE" <?php if($_POST['Filter']=="AKNW-DATE"){ echo 'selected'; } ?>>DateofReceipt</option>
                                            <option value="BATCH-NO" <?php if($_POST['Filter']=="BATCH-NO"){ echo 'selected'; } ?>>BatchNo</option>
                                            <option value="ACCEPTANCE_UPLOAD_DATE" <?php if($_POST['Filter']=="ACCEPTANCE_UPLOAD_DATE"){ echo 'selected'; } ?>>NSDLDate</option>
                                            <option value="R-FLAT-BLOCKNO" <?php if($_POST['Filter']=="R-FLAT-BLOCKNO"){ echo 'selected'; } ?>>Address1</option>
                                            <option value="R-TOWN|COUNTRY" <?php if($_POST['Filter']=="R-TOWN|COUNTRY"){ echo 'selected'; } ?>>City</option>
                                            <option value="R-PIN" <?php if($_POST['Filter']=="R-PIN"){ echo 'selected'; } ?>>PINDCODE</option>
                                            <option value="REJECTION-DATE" <?php if($_POST['Filter']=="REJECTION-DATE"){ echo 'selected'; } ?>>REJECTION DATE</option>
                                        <?php
                                        }elseif(trim($_POST['ProductType'])=="TAN"){
                                        ?>
                                            <option value="">Select</option>
                                            <option value="ACKNOWLEDGEMENT-NO" <?php if($_POST['Filter']=="ACKNOWLEDGEMENT-NO"){ echo 'selected'; } ?>>RECEIPT NUMBER</option>
                                            <option value="OFFICE-NAME" <?php if($_POST['Filter']=="OFFICE-NAME"){ echo 'selected'; } ?>>OFFICE NAME</option>
                                            <option value="ORGANIZATION-NAME" <?php if($_POST['Filter']=="ORGANIZATION-NAME"){ echo 'selected'; } ?>>ORGANIZATION NAME</option>
                                            <option value="COMPANY-NAME" <?php if($_POST['Filter']=="COMPANY-NAME"){ echo 'selected'; } ?>>COMPANY NAME</option>
                                            <option value="MNAME" <?php if($_POST['Filter']=="MNAME"){ echo 'selected'; } ?>>Middle Name</option>
                                            <option value="FNAME" <?php if($_POST['Filter']=="FNAME"){ echo 'selected'; } ?>>First Name</option>
                                            <option value="LNAME" <?php if($_POST['Filter']=="LNAME"){ echo 'selected'; } ?>>Last Name</option>
                                            <option value="TAN-NUMBER" <?php if($_POST['Filter']=="TAN-NUMBER"){ echo 'selected'; } ?>>TAN Number</option>
                                            <option value="AKNW-DATE" <?php if($_POST['Filter']=="AKNW-DATE"){ echo 'selected'; } ?>>DateofReceipt</option>
                                            <option value="BATCH-NO" <?php if($_POST['Filter']=="BATCH-NO"){ echo 'selected'; } ?>>Batch No</option>
                                            <option value="ADDR-TOWN|COUNTRY" <?php if($_POST['Filter']=="ADDR-TOWN|COUNTRY"){ echo 'selected'; } ?>>City</option>
                                            <option value="ADDR-BUILDING-VILLAGE" <?php if($_POST['Filter']=="ADDR-BUILDING-VILLAGE"){ echo 'selected'; } ?>>Address 1</option>
                                            <option value="ADDR-STREET-POSTOFFICE" <?php if($_POST['Filter']=="ADDR-STREET-POSTOFFICE"){ echo 'selected'; } ?>>Address 2</option>
                                            <option value="ADDR-PIN" <?php if($_POST['Filter']=="ADDR-PIN"){ echo 'selected'; } ?>>Pincode</option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <script>
                                function changeFilterValue(ptype){
                                    $('#advanceFiter').load('loadadvancefilter.php?action=advancedfilter&ptype='+ptype);
                                    
                                }
                                changeFilterValue("PAN");
                            </script>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Filter Condition</h6>
                                <select class="form-control" name="FilterCond">
                                    <option value="">Select</option>ss
                                    <option value="=" <?php if($_POST['FilterCond']=="="){ echo 'selected'; } ?>>=
                                    </option>
                                    <option value="<" <?php if($_POST['FilterCond']=="<"){ echo 'selected'; } ?>>
                                        <</option>
                                    <option value=">" <?php if($_POST['FilterCond']==">"){ echo 'selected'; } ?>>>
                                    </option>
                                    <option value="<=" <?php if($_POST['FilterCond']=="<="){ echo 'selected'; } ?>>
                                        <=</option>
                                    <option value=">=" <?php if($_POST['FilterCond']==">="){ echo 'selected'; } ?>>>=
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Search Name</h6>
                                <input type="text" name="FilterName" class="form-control"
                                    value="<?php echo $_POST["FilterName"];  ?>">
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
                                        onClick="searchFunc('searchaction');" value="Search"/>

                                    <input type="submit" name="Search" class="btn btn-success"
                                        onClick="searchFunc('exportaction');" value="Export Data" id="expbtn" disabled />

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
                    $('#branchCode').selectize({
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
                <table id="datatable" class="table table-striped table-bordered table-responsive"
                    style="width:100%;">
                    <thead>
                        <tr class="vcx-i hgt">
                            <th>AcknowledgementNo</th>
                            <th>PanNumber</th>
                            <th>AckDate</th>
                            <th>Branch</th>
                            <th>ApplicantCategory</th>
                            <th>BatchNo</th>
                            <th>Name</th>
                            <th>Document</th>
                        </tr>
                    </thead>
                    <tbody id="tablesearch">
                        <?php
    if(isset($resultData['ReportList'])){                    
    $no=1;
    $crTotal = 0;
    $drTotal = 0;
    foreach($resultData['ReportList'] as $resultList){
    ?>
                        <tr class="uyt hgte">
                            <td><?php echo $resultList['AcknowledgementNo'] ?></td>
                            <td><?php echo trim($resultList['PanNumber']); ?>
                            </td>
                            <td><?php echo $resultList['AckDate'];  ?>
                            </td>
                            <td><?php echo $resultList['Branch']; ?>
                            </td>
                            <td><?php echo $resultList['ApplicantCategory']; ?></td>
                            <td><?php echo $resultList['BatchNo']; ?>
                            </td>
                            <td><?php echo $resultList['Name']; ?></td>
                            <td><?php echo $resultList['Document']; ?>
                            </td>
                        
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