<?php
// get url
include "inc.php";
include "logincheck.php";


$url = $serverurlapi . "General/statusReportAPI.php";

if($_POST['fromDate']!='' && $_POST['toDate']!=''){
    $fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
    $toDate = date('Y-m-d',strtotime($_POST['toDate']));
}


if ($_POST['action'] == "searchaction") {

    $searching = '{
        "type":"0",
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'",
        "ProductType":"'.$_POST['ProductType'].'"
    }';

    $result = postcurlData($url,$searching);
    $resultData = json_decode($result, true);
    
}


if ($_POST['action'] == "exportaction") {

    ob_start();

    $searching = '{
        "type":"1",
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'",
        "ProductType":"'.$_POST['ProductType'].'"
    }';
 
    $result = postcurlData($url,$searching);
    //logger('status report data'.$result);
    $resultData = json_decode($result, true);

    if (trim($_POST['reportType']) == "excel") {
        // Filter the excel data 

        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        // Excel file name for download 
        $fileName = $_POST['ProductType'] . "_StatusReport_" . $_POST['fromDate'] . "_" . $_POST['toDate'] . ".xls";

        // Column names 
        $fields = array('BRANCHCODE', 'NAME', 'RecvSerialNumber', 'DateReceipt', 'PanNumber', 'WisdaReference', 'RECEIPT_NUMBER', 'SAMFILEUPLOAD', 'ENTRY1', 'ENTRY2', 'MISMATCH', 'MATCH', 'BATCHCREATION', 'DISPATCH', 'RECEIVE', 'VERIFY', 'REJECTION', 'QCBATCHCREATION', 'RE_VERIFYBATCH', 'CR_BATCHCREATION', 'VENDORASSIGNMENT', 'VENDORRECEIVE', 'BATCHCONFIRMATION', 'APPLICATIONSTATUS', 'NSDLCONFIRMATION', 'PANALLOTMENT', 'PODISPATCH', 'BRANCHBATCHEDIT', 'CANCEL', 'COURIERLOST', 'MISSINGMISREVOKE', 'PHOTO_RECV', 'SIG_RECV', 'SCANCOPY_RECV', 'WAREHOUSEDISPATCH', 'WAREHOUSERECEIVE', 'VENDORREVOKE', 'NEWPROCESSENTRY', 'NEWBATCHCREATION', 'NEWVERIFIER', 'NEWBRANCHBATCHEDIT', 'NEWEXPORTBATCH', 'ENTRY2New', 'MisMatchNew', 'MatchNew', 'VendorEntry', 'VendorEntry2', 'VendorMisMatch', 'VendorMatch', 'Undigitized', 'ReUploadPendingatBranch', 'PendingofReverification', 'ImageQualityIssueResolved', 'Modeofacceptance');

        // Display column names as first row 
        $excelData = implode("\t", array_values($fields)) . "\n";

        if (isset($resultData['ReportData'])) {
            $no = 1;
            foreach ($resultData['ReportData'] as $resultList) {

                $lineData = array($resultList['BRANCHCODE'], $resultList['NAME'], $resultList['RecvSerialNumber'], $resultList['DateReceipt'], $resultList['PanNumber'], $resultList['WisdaReference'], $resultList['RECEIPT_NUMBER'], $resultList['SAMFILEUPLOAD'], $resultList['ENTRY1'], $resultList['ENTRY2'], $resultList['MISMATCH'], $resultList['MATCH'], $resultList['BATCHCREATION'], $resultList['DISPATCH'], $resultList['RECEIVE'], $resultList['VERIFY'], $resultList['REJECTION'], $resultList['QCBATCHCREATION'], $resultList['RE_VERIFYBATCH'], $resultList['CR_BATCHCREATION'], $resultList['VENDORASSIGNMENT'], $resultList['VENDORRECEIVE'], $resultList['BATCHCONFIRMATION'], $resultList['APPLICATIONSTATUS'], $resultList['NSDLCONFIRMATION'], $resultList['PANALLOTMENT'], $resultList['PODISPATCH'], $resultList['BRANCHBATCHEDIT'], $resultList['CANCEL'], $resultList['COURIERLOST'], $resultList['MISSINGMISREVOKE'], $resultList['PHOTO_RECV'], $resultList['SIG_RECV'], $resultList['SCANCOPY_RECV'], $resultList['WAREHOUSEDISPATCH'], $resultList['WAREHOUSERECEIVE'], $resultList['VENDORREVOKE'], $resultList['NEWPROCESSENTRY'], $resultList['NEWBATCHCREATION'], $resultList['NEWVERIFIER'], $resultList['NEWBRANCHBATCHEDIT'], $resultList['NEWEXPORTBATCH'], $resultList['ENTRY2New'], $resultList['MisMatchNew'], $resultList['MatchNew'], $resultList['VendorEntry'], $resultList['VendorEntry2'], $resultList['VendorMisMatch'], $resultList['VendorMatch'], $resultList['Undigitized'], $resultList['ReUploadPendingatBranch'], $resultList['PendingofReverification'], $resultList['ImageQualityIssueResolved'], $resultList['Modeofacceptance']);

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
        
    } else {
        $delimiter = ",";
        $filename = $_POST['ProductType'] . "_StatusReport_" . $_POST['fromDate'] . "_" . $_POST['toDate'] . ".csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w');

        // Column names 
        $fields = array('BRANCHCODE', 'NAME', 'RecvSerialNumber', 'DateReceipt', 'PanNumber', 'WisdaReference', 'RECEIPT_NUMBER', 'SAMFILEUPLOAD', 'ENTRY1', 'ENTRY2', 'MISMATCH', 'MATCH', 'BATCHCREATION', 'DISPATCH', 'RECEIVE', 'VERIFY', 'REJECTION', 'QCBATCHCREATION', 'RE_VERIFYBATCH', 'CR_BATCHCREATION', 'VENDORASSIGNMENT', 'VENDORRECEIVE', 'BATCHCONFIRMATION', 'APPLICATIONSTATUS', 'NSDLCONFIRMATION', 'PANALLOTMENT', 'PODISPATCH', 'BRANCHBATCHEDIT', 'CANCEL', 'COURIERLOST', 'MISSINGMISREVOKE', 'PHOTO_RECV', 'SIG_RECV', 'SCANCOPY_RECV', 'WAREHOUSEDISPATCH', 'WAREHOUSERECEIVE', 'VENDORREVOKE', 'NEWPROCESSENTRY', 'NEWBATCHCREATION', 'NEWVERIFIER', 'NEWBRANCHBATCHEDIT', 'NEWEXPORTBATCH', 'ENTRY2New', 'MisMatchNew', 'MatchNew', 'VendorEntry', 'VendorEntry2', 'VendorMisMatch', 'VendorMatch', 'Undigitized', 'ReUploadPendingatBranch', 'PendingofReverification', 'ImageQualityIssueResolved', 'Modeofacceptance');

        fputcsv($f, $fields, $delimiter);

        if (isset($resultData['ReportData'])) {
            $no = 1;
            foreach ($resultData['ReportData'] as $resultList) {

                $lineData = array($resultList['BRANCHCODE'], $resultList['NAME'], $resultList['RecvSerialNumber'], $resultList['DateReceipt'], $resultList['PanNumber'], $resultList['WisdaReference'], $resultList['RECEIPT_NUMBER'], $resultList['SAMFILEUPLOAD'], $resultList['ENTRY1'], $resultList['ENTRY2'], $resultList['MISMATCH'], $resultList['MATCH'], $resultList['BATCHCREATION'], $resultList['DISPATCH'], $resultList['RECEIVE'], $resultList['VERIFY'], $resultList['REJECTION'], $resultList['QCBATCHCREATION'], $resultList['RE_VERIFYBATCH'], $resultList['CR_BATCHCREATION'], $resultList['VENDORASSIGNMENT'], $resultList['VENDORRECEIVE'], $resultList['BATCHCONFIRMATION'], $resultList['APPLICATIONSTATUS'], $resultList['NSDLCONFIRMATION'], $resultList['PANALLOTMENT'], $resultList['PODISPATCH'], $resultList['BRANCHBATCHEDIT'], $resultList['CANCEL'], $resultList['COURIERLOST'], $resultList['MISSINGMISREVOKE'], $resultList['PHOTO_RECV'], $resultList['SIG_RECV'], $resultList['SCANCOPY_RECV'], $resultList['WAREHOUSEDISPATCH'], $resultList['WAREHOUSERECEIVE'], $resultList['VENDORREVOKE'], $resultList['NEWPROCESSENTRY'], $resultList['NEWBATCHCREATION'], $resultList['NEWVERIFIER'], $resultList['NEWBRANCHBATCHEDIT'], $resultList['NEWEXPORTBATCH'], $resultList['ENTRY2New'], $resultList['MisMatchNew'], $resultList['MatchNew'], $resultList['VendorEntry'], $resultList['VendorEntry2'], $resultList['VendorMisMatch'], $resultList['VendorMatch'], $resultList['Undigitized'], $resultList['ReUploadPendingatBranch'], $resultList['PendingofReverification'], $resultList['ImageQualityIssueResolved'], $resultList['Modeofacceptance']);

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
    <title>Status Report</title>
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
                                <h6 style="font-weight: initial;">From Date</h6>
                                <input type="date" name="fromDate" class="form-control "
                                    value="<?php echo $_POST["fromDate"]; ?>" required>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">To Date</h6>
                                <input type="date" name="toDate" class="form-control "
                                    value="<?php echo $_POST["toDate"]; ?>" required>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Product Type</h6>
                                <select class="form-control" name="ProductType">
                                    <option value="PAN" <?php if ($_POST['ProductType'] == "PAN") {
                                                            echo 'selected';
                                                        } ?>>PAN
                                    </option>
                                    <option value="TAN" <?php if ($_POST['ProductType'] == "TAN") {
                                                            echo 'selected';
                                                        } ?>>TAN
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <h6 style="font-weight: initial;">Report Type</h6>
                                <select class="form-control" name="reportType" required>
                                    <option value="">Select</option>
                                    <option value="csv">CSV Format</option>
                                    <option value="excel">Excel Format</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <h6>&nbsp;</h6>
                                    <input type="hidden" id="action" name="action" value="" />
                                    <!-- <input type="button" name="Search" class="btn btn-success"
                                        onClick="searchFunc('searchaction');" value="Search" /> -->

                                    <input type="submit" name="Search" class="btn btn-success"
                                        onClick="searchFunc('exportaction');" value="Export Data" />

                                </div>
                            </div>

                        </div>
                    </form>


                </div>

                <script>
                function searchFunc(data) {
                    $('#action').val(data);
                    
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
                <table id="datatable" class="table table-striped table-bordered table-responsive" style="width:100%; display:none;">
                    <thead>
                        <tr class="vcx-i hgt">
                            <th>BRANCHCODE</th>
                            <th>NAME</th>
                            <th>RecvSerialNumber</th>
                            <th>DateReceipt</th>
                            <th>PanNumber</th>
                            <th>WisdaReference</th>
                            <th>RECEIPT_NUMBER</th>
                            <th>SAMFILEUPLOAD</th>
                            <th>ENTRY1</th>
                            <th>ENTRY2</th>
                            <th>MISMATCH</th>
                            <th>MATCH</th>
                            <th>BATCHCREATION</th>
                            <th>DISPATCH</th>
                            <th>RECEIVE</th>
                            <th>VERIFY</th>
                            <th>REJECTION</th>
                            <th>CR_BATCHCREATION</th>
                            <th>QCBATCHCREATION</th>
                            <th>VENDORASSIGNMENT</th>
                            <th>VENDORRECEIVE</th>
                            <th>BATCHCONFIRMATION</th>
                            <th>APPLICATIONSTATUS</th>
                        </tr>
                    </thead>
                    <tbody id="tablesearch">
                        <?php
                        if (isset($resultData['ReportData'])) {
                            $no = 1;
                            foreach ($resultData['ReportData'] as $resultList) {
                        ?>
                        <tr class="uyt hgte">
                            <td><?php echo $resultList['BRANCHCODE'] ?></td>
                            <td><?php echo $resultList['NAME'] ?></td>
                            <td><?php echo $resultList['RecvSerialNumber'] ?></td>
                            <td><?php echo $resultList['DateReceipt'] ?></td>
                            <td><?php echo $resultList['PanNumber'] ?></td>
                            <td><?php echo $resultList['WisdaReference'] ?></td>
                            <td><?php echo $resultList['RECEIPT_NUMBER'] ?></td>
                            <td><?php echo $resultList['SAMFILEUPLOAD'] ?></td>
                            <td><?php echo $resultList['ENTRY1'] ?></td>
                            <td><?php echo $resultList['ENTRY2'] ?></td>
                            <td><?php echo $resultList['MISMATCH'] ?></td>
                            <td><?php echo $resultList['MATCH'] ?></td>
                            <td><?php echo $resultList['BATCHCREATION'] ?></td>
                            <td><?php echo $resultList['DISPATCH'] ?></td>
                            <td><?php echo $resultList['RECEIVE'] ?></td>
                            <td><?php echo $resultList['VERIFY'] ?></td>
                            <td><?php echo $resultList['REJECTION'] ?></td>
                            <td><?php echo $resultList['QCBATCHCREATION'] ?></td>
                            <td><?php echo $resultList['RE_VERIFYBATCH'] ?></td>
                            <td><?php echo $resultList['CR_BATCHCREATION'] ?></td>
                            <td><?php echo $resultList['VENDORASSIGNMENT'] ?></td>
                            <td><?php echo $resultList['VENDORRECEIVE'] ?></td>
                            <td><?php echo $resultList['BATCHCONFIRMATION'] ?></td>
                            <td><?php echo $resultList['APPLICATIONSTATUS'] ?></td>
                        </tr>
                        <?php
                                $no++;
                            } ?>

                        <?php } else { ?>
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