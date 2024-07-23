<?php
//get url
include "inc.php";
include "logincheck.php";
require_once 'reader.php';

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

if($_POST['action']=="exportLimitData"){
    $searching = '{
        "fromDate":"'.$fromDate.'"
    }';

$url = "".$serverurlapi."General/limitReportAPI.php";
logger($InfoMessage." URL for export API - ".$searching); 
logger($InfoMessage." URL for limit export API - ".$url); 

$result = postCurlData($url,$searching);
$regionData = json_decode($result, true);
logger($InfoMessage."RESPONSE RETURN FROM LIMIT EXPORT API : ".$result); 

//Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

$path = 'data/temp/rejectionbatchzip/';
$foldername = 'Limit_Report';

if(is_dir($foldername)){
	$batchfolder = $foldername;
}else{
	$batchfolder = mkdir($foldername, 0777);
}

// Excel file name for download 
$fileName = "Limit_file_".date('Y-m-d').".xls";
$txt_file = 'Limit_file.txt';

//text file write
$oracle_txt_file = fopen($foldername . '/' . $txt_file,"w");

// Column names 
$fields = array('BranchCode', 'Status', 'NetSecurity', 'LimitApproved', 'Billed ', 'UnBilled', 'OtherDrCr', 'ActualLimit','Limit'); 

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

	if(isset($regionData['status'])=='true'){
		if(isset($regionData['LimitData'])){                    
			$no=1;
            
			foreach($regionData['LimitData'] as $resultList){
			 $lineData = array($resultList['BranchCode'],$resultList['Status'], $resultList['NetSecurity'], $resultList['LimitApproved'], $resultList['Billed'], $resultList['UnBilled'], $resultList['OtherDrCr'], $resultList['ActualLimit'],$resultList['Limit']); 
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
    <title>Limit Upload</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    <?php include 'links.php'; ?>
   <!-- Favicon -->
</head>

<body>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
        <!-- Top Navbar -->
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper" style="">
            
            <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px; display:none;" id="divMsg">
                <!-- Success Alert -->
                <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green; ">
                    <span id="msg"></span>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            </div>
            

            <div class="container-fluid">
                <form action="" method="POST" autocomplete="off" id="exportfrm" enctype="multipart/form-data">
                
                    <div class="row gy-bvc">
                        <div class="col-md-5">
                            <div class="flx">
                                <input type="file" name="attachmentFile" class="form-control" value=""
                                 required autocomplete="off" />
                                
                            </div>
                            <p id="err" style="color:red;"></p>
                        </div>

                        <div class="col-md-3">
                            <div class="flx">
                                <input type="hidden" id="action" name="action" value="importfiledata" />
                                <input type="submit" name="Search" class="btn btn-success" value="Import Data" />
                                <input type="button" name="exp" class="btn btn-success" value="Export Data" onClick="funcSubmitExportForm();" />
                            </div>
                        </div>
                    </div>
                    <div class="row gy-bvc">
                        <div class="col-md-5">
                            <div class="flx">
                                <div style="background: #f1f0f0; padding: 15px;">Successfull Record: <span style="color:green;font-weight: 700; font-size: 17px;" id="successCount">0</span></div>
                                <div style="background: #f1f0f0; padding: 15px;">Failed Record: <span style="color:red;font-weight: 700; font-size: 17px;" id="failedCount">0</span></div>
                            </div>
                           
                        </div>

                    </div>
                </form>
                
                        <div class="col-md-5">
                            <div class="flx">
                            <form action="" method="POST" id="exportfrm2" enctype="multipart/form-data">
                                 <input type="hidden" id="action" name="action" value="exportLimitData" />

                            </form>  
                            </div>
                        </div>
                
                
                <script>
                    function funcSubmitExportForm(){
                        $('#exportfrm2').submit();
                    }
                </script>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(e) {
        $("#exportfrm").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "uploadlimitformat.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#blkbox").show();
                    $("#err").fadeOut();
                },
                success: function(data) {
                    console.log(data);
                    var objData = jQuery.parseJSON(data);
                    console.log(objData.Status);
                    if(objData.Status==true) {
                        $("#blkbox").hide();
                        $('#successCount').text(objData.Successfull);
                        $('#failedCount').text(objData.Failed);
                        $("#msg").html("File imported successfully!");
                        $('#divMsg').show().fadeIn();
                        $("#exportfrm")[0].reset();
                    }else {
                        // invalid file format.
                        $("#blkbox").hide();
                        $("#err").html("Invalid File !").fadeIn();
                    }
                },
                error: function(e) {
                    $("#err").html(e).fadeIn();
                    $("#blkbox").hide();
                }
            });
        }));
    });
    </script>
<div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;" id="blkbox">
  <div style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;"><img src="img/Spin2.gif" width="100px;"><br>
    Importing Data... Please wait</div>
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