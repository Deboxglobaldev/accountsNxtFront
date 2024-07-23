<?php
// get url
include 'inc.php';
include "logincheck.php";

$url = $serverurlapi."General/listCommissionRate.php";
$jsonPost = '{
  "SchemeId":"'.decode($_REQUEST['sid']).'"
}';
$result = postCurlData($url,$jsonPost);
//logger('RESPONCE RETURN FROM SCHEME DATA LIST: '.$result);
$arrData = json_decode($result, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Charged Schedule Data</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    <!-- Favicon -->
    <?php include 'links.php'; ?>
    <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
    </script>
</head>

<body>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper">
        <div class="container-fluid">
            <?php if($_SESSION['error']!=''){ ?>
            <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px; " id="divMsg">
                <!-- Success Alert -->
                <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green; ">
                    <span id="msg"><?php echo $_SESSION['error']; unset($_SESSION['error']);  ?></span>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            </div>
            <?php } ?>


                <div class="row gy-bvc nn-mb">
                    <div class="col-md-12">
                        <div class="row lk-kl">
                            <div class="">
                                <button type="button" class="btn btn-default browsebutton pd-btns" data-toggle="modal"
                                    data-target="#modalpop"
                                    onClick="opmodalpop('Add Charged Schedule Data','modelpop.php?action=schememasterdata&sid=<?php echo $_REQUEST['sid']; ?>&schemeName=<?php echo $_REQUEST['schemeName']; ?>','100%','auto');">Add
                                    [<?php echo decode($_GET['schemeName']); ?>] Charged Schedule Data</button>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container-fluid">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="vcx-i hgt">
                            <th>Charged Schedule Name</th>
                            <th>Type</th>
                            <th>From&nbsp;Date</th>
                            <th>To Date</th>
                            <th>App&nbsp;From</th>
                            <th>App&nbsp;To</th>
                            <th>Status</th>
                            <th>TAT</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tablesearch">
                        <?php
                          if($arrData['status'] =='0'){
                          $no=1;
                          foreach($arrData['commissionRateData'] as $resultList){
                          ?>
                        <tr class="uyt hgte">
                            <td><?php echo $arrData['SchemeName']; ?></td>
                            <td><?php echo $resultList['TypeName']; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($resultList['FromDate'])); ?></td>
                            <td><?php echo date('d-m-Y',strtotime($resultList['ToDate'])); ?></td>
                            <td><?php echo $resultList['AppFrom']; ?></td>
                            <td><?php echo $resultList['AppTo']; ?></td>
                            <td><?php if($resultList['Status']==1){ echo 'Active';}elseif($resultList['Status']==0){echo 'In-active';} ?>
                            </td>
                            <td><?php echo $resultList['Days']; ?></td>
                            <td><?php echo $resultList['Commission']; ?></td>
                            <td>

                                <button class="btn btn-default editbutton"
                                    style="width: auto !important; margin-left: 0  !important;" data-toggle="modal"
                                    data-target="#modalpop"
                                    onClick="opmodalpop('Edit Charged Schedule Data','modelpop.php?action=schememasterdata&sid=<?php echo $_REQUEST['sid']; ?>&schemeName=<?php echo $_REQUEST['schemeName']; ?>&eid=<?php echo $resultList['RateId']; ?>&Status=<?php echo $resultList['Status']; ?>','100%','auto');">Edit</button>

                            </td>
                        </tr>
            <?php
        $no++;} }
        ?>
            </tbody>
            </table>
        </div>
    </div>
    </div>


    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="js/Validator.js"></script>
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