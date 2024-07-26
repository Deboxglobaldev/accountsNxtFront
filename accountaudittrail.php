<?php
// get url
include "inc.php";
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- ";

$voucherNo = $_POST['voucherNo'];
$accountCode = $_POST['accountCode'];

if (trim($_POST['fromDate'])!= '' && trim($_POST['toDate'])!='') {
    $fromDate = date('Y-m-d', strtotime($_POST['fromDate']));
    $toDate = date('Y-m-d', strtotime($_POST['toDate']));
}

$searching = '{
        "voucherNo":"'.$voucherNo.'",
        "accountCode":"'.$accountCode.'",
        "fromDate":"'.$fromDate.'",
        "toDate":"'.$toDate.'"
    }';

$url = $serverurlapi."reports/getAccAuditTrailAPI.php";

if(isset($_POST['action'])=='searchaction')
{

$response = postCurlData($url,$searching);
//logger("Response return from account Audit Trail API: ". $response);
$dashData = json_decode($response);

}

if($_POST['action']=="exportaction"){


$response = postCurlData($url,$searching);
//logger("Response return from account Audit Trail EXPORT API: ". $response);
$dashData = json_decode($response);


// Filter the excel data
/*function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
} */

// Excel file name for download
$fileName = "AccountAudit_Trail.xls";

// Column names
$fields = array('AccountCode', 'AccountName', 'Amount', 'AmountType', 'VoucherType', 'Voucher' , 'Balance' ,'Date' , 'UserName' , 'UserIP');


// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

	if(isset($dashData->Status)=='true'){
		if(isset($dashData->listOfData)){
			$no=1;
			foreach($dashData->listOfData as $resultList){
			//$dateTime = explode(' ', $resultList->Date);
			//$date = $dateTime[0];
			//$time = $dateTime[1];
			//$showDate = date_create($date);


				 $lineData = array($resultList->AccountCode,$resultList->AccountName,$resultList->Amount,$resultList->AmountType,$resultList->VoucherType,$resultList->Voucher,$resultList->Balance,$resultList->DateTime,$resultList->UserName,$resultList->IPAddress);
						//array_walk($lineData, 'filterData');
						$excelData .= implode("\t", array_values($lineData)) . "\n";

			}
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
    <title>Account Audit Trail</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    <?php include 'links.php'; ?>
    <style>
    .filterCls {
        padding: 2px;
    }

    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 10px !important;
        padding-left: 10px !important;
    }

    table.table-bordered.dataTable tbody th,
    table.table-bordered.dataTable tbody td {
        border-bottom-width: 1px !important;
    }

    .headline {
        border-bottom: 4px solid #1f7140 !important;
    }

    .thCls {
        font-size: 15px;
        font-weight: 700;
        color: #fff;

    }
    </style>
    <!-- Favicon -->
</head>

<body>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
        <!-- Top Navbar -->
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper" style="">
            <!-- <div style="background:transparent;">

</div> -->
            <link rel="stylesheet" href="">
            <section>
                <div class="container-fluid">
                    <form action="" method="POST" id="exportfrm" />
                    <div class="row gy-bvc">
                        <div class="col-md-3">
                            <div class="flx">
                                <h6 style="font-weight: initial;">Voucher&nbsp;No</h6>
                                <input type="text" name="voucherNo" id="voucherNo" class="form-control"
                                    value="<?php echo $_POST['voucherNo']; ?>"  />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="flx">
                                <h6 style="font-weight: initial;">Account&nbsp;Name</h6>
                                <select name="accountCode" class="form-control" >
                                    <option value="">Select</option>
                                    <?php
                                    $jsonData = '{
                                                    "AccountName":"",
                                                    "GroupId":"",
                                                    "Status":"1"
                                                }';
                                    $newurl = $serverurlapi."masters/accountNameAPI.php";
                                    $resultData = postCurlData($newurl,$jsonData);
                                    //logger('Response return from account Name API: '.$resultData);
                                    $accountData = json_decode($resultData);
                                    if(isset($accountData->status)=='true'){
                                    if(isset($accountData->AccountNameData)){
                                    foreach($accountData->AccountNameData as $resultList){
                                        ?>
                                        <option value="<?php echo $resultList->Id; ?>" <?php if($_POST['accountCode']==$resultList->Id){ echo 'selected'; }?>>
                                        <?php echo $resultList->AccountName; ?></option>
                                    <?php } } }	?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="flx">
                                <h6 style="font-weight: initial;">From&nbsp;Date</h6>
                                    <input type="date" name="fromDate" id="fromDate" class="form-control " value="<?php echo $_POST['fromDate']; ?>"  />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="flx">
                                <h6 style="font-weight: initial;">To&nbsp;Date</h6>
                                    <input type="date" name="toDate" id="toDate" class="form-control " value="<?php echo $_POST['toDate']; ?>"  />
                            </div>
                        </div>
                    </div>
                    <div class="row gy-bvc">
                        <div class="col-md-3"> </div>
                        <div class="col-md-3">
                            <input type="hidden" name="action" id="action" value="" />
                            <input type="submit" name="Search" class="btn btn-default browsebutton pd-button searchBtn"
                                onClick="searchFunc('searchaction');" value="Search" />
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="Search" class="btn btn-default browsebutton pd-button searchBtn"
                                onClick="searchFunc('exportaction');" value="Export" />
                        </div>
                        <div class="col-md-3">
                            <!--<button type="button" class="btn btn-default browsebutton pd-button">Exit</button> -->
                            <a href="auditTrail.php" class="btn btn-default browsebutton pd-button">Exit</a>
                        </div>
                    </div>
                    </form>
                </div>
            </section>

            <script>
            function searchFunc(data) {
                $('#action').val(data);
                $('form#exportfrm').submit();
            }

            $(document).ready(function() {
                        $('select').selectize({
                            sortField: 'text'
                        });
                    });

            </script>
            <div class="container-fluid">
                <table class="table table-bordered " id="tableID" style="width:100% !important; ">
                    <thead>
                        <tr class="headline" style="">
                            <!-- <th>SNO#</th> -->
                            <th>Account Code</th>
                            <th>Account Name</th>
                            <th>Amount</th>
                            <th>Amount Type</th>
                            <th>Voucher Type</th>
                            <th>Voucher</th>
                            <th>Voucher&nbsp;Date</th>
                            <th>Balance</th>
                            <th>Entry Date</th>
                            <th width="15%">User</th>
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                        <?php
	if($_POST['voucherNo']!='' || $_POST['accountCode']!=''){
    $no=1;
	if($dashData->listOfData!=''){
    foreach($dashData->listOfData as $resultList){

	if($resultList->AccountCode!=''){
		//$dateTime = explode(' ', $resultList->DateTime);
		//$date = $dateTime[0];
		//$time = $dateTime[1];
		//$showDate = date_create($date);

    ?>
                        <tr>
                            <!-- <td><?php echo $no; ?></td> -->
                            <td><?php echo trim($resultList->AccountCode); ?></td>
                            <td><?php echo trim($resultList->AccountName); ?></td>
                            <td><?php echo $resultList->Amount; ?></td>
                            <td><?php echo $resultList->AmountType; ?></td>
                            <td><?php echo $resultList->VoucherType; ?></td>
                            <td><?php echo $resultList->Voucher; ?></td>
                            <td><?php echo $resultList->VoucherDate; ?></td>
                            <td><?php echo $resultList->Balance; ?></td>
                            <td><?php echo trim($resultList->DateTime); ?></td>
                            <td>
                                <?php echo trim($resultList->UserName); ?>
                                <br>
                                <span style="font-weight: 700;">IP: </span> <?php echo trim($resultList->IPAddress); ?>
                            </td>
                        </tr>
                        <?php
$no++;
}

	 } }else{ ?>
                        <tr>
                            <td colspan="10">
                                <div align="center">No Result Found</div>
                            </td>
                        </tr>

                        <?php }

    }else{ ?>
                        <tr>
                            <td colspan="10">
                                <div align="center"><?php echo 'You Can Search...'; ?></div>
                            </td>
                        </tr>
                        <?php }  ?>
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