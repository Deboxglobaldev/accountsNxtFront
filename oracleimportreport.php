<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;


if($_SESSION["Type"]=="BRANCH"){
  $BranchCode = $_SESSION["BID"];
}else{
  $BranchCode = '';
}

if($_GET['action']=="searchaction"){

if($_GET['fromDate']!='' || $_GET['toDate']!=''){
    $fromDate = trim($_GET['fromDate']);
    $toDate = trim($_GET['toDate']);
}


$productType = trim($_GET['productType']);
	
$searching = '{
    "fromDate":"'.date('Y-m-d',strtotime($fromDate)).'",
    "toDate":"'.date('Y-m-d',strtotime($toDate)).'",
    "Branch":"'.$BranchCode.'"
}';

$url = "".$serverurlapi."Reports/oracleimportreportAPI.php";
logger($InfoMessage." URL for API - ".$searching); 
logger($InfoMessage." URL for API - ".$url); 

$result = postCurlData($url,$searching);
$regionData = json_decode($result, true);

}
   
if($_GET['action']=="exportaction"){

    if($_GET['fromDate']!='' || $_GET['toDate']!=''){
        $fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
        $toDate = date('Y-m-d',strtotime($_GET['toDate']));
    }
    $productType = trim($_GET['productType']);
	
    $searching = '{
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'",
        "Branch":"'.$BranchCode.'"
    }';

$url = "".$serverurlapi."Reports/oracleimportreportAPI.php";
logger($InfoMessage." URL for export API - ".$searching); 
logger($InfoMessage." URL for export API - ".$url); 

$result = postCurlData($url,$searching);
$regionData = json_decode($result, true);
logger($InfoMessage."RESPONSE RETURN FROM ORACLE EXPORT API : ".$result); 

//Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

$path = 'data/temp/rejectionbatchzip/';
$foldername = 'oracle_report';

if(is_dir($foldername)){
	$batchfolder = $foldername;
}else{
	$batchfolder = mkdir($foldername, 0777);
}

// Excel file name for download 
$fileName = "OracleImport_Report".date('Y-m-d').".xls";
$txt_file = 'OracleImport_format2.txt';

//text file write
$oracle_txt_file = fopen($foldername . '/' . $txt_file,"w");

// Column names 
$fields = array('Source', 'Entity', 'Branch', 'A/C Code', 'Code ', 'Voucher No', 'Amount', 'Voucher Date','Dr/Cr Flag','A/c Type'); 

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

	if(isset($regionData['Status'])=='true'){
		if(isset($regionData['LedgerList'])){                    
			$no=1;
            
			foreach($regionData['LedgerList'] as $resultList){
			 $lineData = array($resultList['Source'],$resultList['Entity'], $resultList['Branch'], $resultList['Accountcode'], $resultList['Code'], $resultList['Voucherno'], $resultList['Amount'], $resultList['Voucherdate'],$resultList['Debitcreditflag'],$resultList['Accounttype']); 
            //write data row in text file 
            $oracle_data = implode('^',$lineData);
            fwrite($oracle_txt_file, $oracle_data."\n");

            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 

                    
			}
		$no++;
		}
	}

    // closes the file
	fclose($oracle_txt_file);
    file_put_contents($foldername."/".$fileName,$excelData);

    ///Create zip file
	$zip = new \ZipArchive();
	$filename123 = $path.$foldername.".zip";
    if ($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
		exit("cannot open <$filename123>\n");
	}

    $dir = ''.$foldername.'/';
	//function to Create zip
	createZip($zip,$dir);
	$zip->close();

    ///Download zip file
	$filenamenew = $foldername.".zip";

    header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-type: application/octet-stream");
	header('Content-Disposition: attachment; filename="'.$filenamenew.'"');
	header("Content-Transfer-Encoding: binary");
	//header("Content-Length: ".filesize($filepath));
	ob_end_flush();
	@readfile($filename123);

    //delete file
	unlink($foldername.'/'.$txt_file);
    unlink($foldername.'/'.$fileName);
    rmdir($foldername);
    ///Zip file delete
	unlink($filename123);
    

exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Oracle Export</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    <?php include 'links.php'; ?>
    <script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "lengthMenu": [50, 100, 250, 500, 1000],
            "pageLength": 100

        });
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
        <div class="hk-pg-wrapper" >

            <div class="container-fluid">
                <form action="" method="GET" autocomplete="off" id="exportfrm" />
                <div class="row gy-bvc">
                    <div class="col-md-3">
                        <div class="flx">
                            <h6 style="font-weight: initial;">From<?php echo $BranchCode."5"; ?>&nbsp;Date</h6>
                            <input type="text" name="fromDate" class="form-control datepicker"
                                value="<?php echo $_GET['fromDate']; ?>" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="flx">
                            <h6 style="font-weight: initial;">To&nbsp;Date</h6>
                            <input type="text" name="toDate" class="form-control datepicker"
                                value="<?php echo $_GET['toDate']; ?>" required autocomplete="off" />
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="flx">
                            <h6 style="font-weight: initial;">Product&nbsp;Type</h6>
                            <select class="form-control" name="productType" id="productType" required>
                                <option value="">Select</option>
                                <option value="PAN" <?php if($_GET['productType']=='PAN'){ echo "selected"; }?>>PAN
                                </option>
                                <option value="TAN" <?php if($_GET['productType']=='TAN'){ echo "selected"; }?>>TAN
                                </option>
                            </select>
                        </div>
                    </div> -->

                    <div class="col-md-3">
                        <div class="flx">
                            <input type="hidden" id="action" name="action" value="" />
                            <!-- <input type="button" name="Search" class="btn btn-success" onClick="searchFunc('searchaction');" value="Search" />-->
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
            </script>

            
            <div class="container-fluid" style="margin-top:20px;overflow: auto; display:none;">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="vcx-i hgt">
                            <th>S.No</th>
                            <th>Acknowledgement No</th>
                            <th>Applicant Last Name</th>
                            <th>Applicant First Name</th>
                            <th>Applicant Middle Name</th>
                            <th>Date of birth </th>
                            <th>Status Code provided by TINFC</th>
                            <th>Type of Application</th>
                            <th>Date of Rejection</th>
                            <th>Rejection Reason</th>
                        </tr>
                    </thead>
                    <tbody id="tablesearch">
                        <?php
    if(isset($regionData['status'])=='true'){
    if(isset($regionData['ReportData'])){                    
    $no=1;
    foreach($regionData['ReportData'] as $resultList){


    ?>
                        <tr class="uyt hgte">
                            <td><?php echo $no; ?></td>
                            <td><?php echo $resultList['AckNumber']; ?></td>
                            <td><?php echo $resultList['Applastname'] ?></td>
                            <td><?php echo $resultList['Appfirstname']; ?></td>
                            <td><?php echo $resultList['Appmiddlename']; ?></td>
                            <td><?php echo $resultList['Dateofbirth']; ?></td>
                            <td><?php echo $resultList['Statuscode']; ?></td>
                            <td><?php echo $resultList['Formtype']; ?></td>
                            <td><?php echo $resultList['RejectionDate']; ?></td>
                            <td><?php echo $resultList['RejectionReason']; ?></td>
                        </tr>
                        <?php
    $no++;
  }
}
  }
  else{?>
                        <tr class="uyt hgte">
                            <td colspan="10">
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

table.dataTable>thead>tr>th:not(.sorting_disabled),
table.dataTable>thead>tr>td:not(.sorting_disabled),
table.table-bordered.dataTable tbody th,
table.table-bordered.dataTable tbody td {
    font-size: 12px !important;
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
<script>
$(function() {
    $(".datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        maxDate: 0
    });
});
</script>
<!--search filter-->
<script>
// function searchingName(){
//     var name = $("#bname").val().toLowerCase();
//     $("#tablesearch tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
//     });
// }
</script>