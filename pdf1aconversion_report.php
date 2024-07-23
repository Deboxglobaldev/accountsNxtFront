<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;

 
if($_POST['action']=="searchaction"){


$fromDate = date('d/m/Y',strtotime($_POST['fromDate']));
$toDate = date('d/m/Y',strtotime($_POST['toDate']));

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://preinsta.religareonline.com/PDFA1AConverterAPI/api/PDF/FetchPDFA1AReports',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 5000,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "FromDate":"'.$fromDate.'",
        "ToDate":"'.$toDate.'",
        "EmailTo":"'.$_POST['email'].'"
    }',
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'X-Auth-Header: UkVMQjk1NjA2NlRJTkZDMTQ0ODoxOTE4Njk3MDE1MzU4MjA='
    ),
));

$response = curl_exec($curl);

curl_close($curl);
$DataArr = json_decode($response, true);
 
logger($InfoMessage." RESPONSE RETURN FROM pdf1a report: ".$response);

}
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>PDF/A-1a Reports</title>
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
        <?php include 'header.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper">

            <div class="container-fluid">
                <form action="" method="POST" autocomplete="off" id="exportfrm" />
                <div class="row gy-bvc">
                    <div class="col-md-4">
                        <div class="flx">
                            <h6 style="font-weight: initial;">Email</h6>
                            <input type="text" name="email" class="form-control"
                                value="<?php echo $_POST['email']; ?>" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="flx">
                            <h6 style="font-weight: initial;">From&nbsp;Date</h6>
                            <input type="date" name="fromDate" class="form-control "
                                value="<?php echo $_POST['fromDate']; ?>" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="flx">
                            <h6 style="font-weight: initial;">To&nbsp;Date</h6>
                            <input type="date" name="toDate" class="form-control "
                                value="<?php echo $_POST['toDate']; ?>" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="flx">
                            <input type="hidden" id="action" name="action" value="" />
                            <input type="submit" name="Search" class="btn btn-success"
                                onClick="searchFunc('searchaction');" value="Send" />
                            <!-- <input type="button" name="Search" class="btn btn-success" onClick="searchFunc('exportaction');" value="Export Data" /> -->
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <script>
            function searchFunc(data) {
                $('#action').val(data);
               
            }
            </script>


            <div class="container-fluid" style="margin-top:20px;overflow: auto;">
                <div style="background: #f1f0f0; padding: 20px;"> 
                    <p><b><?php echo $DataArr['Message']; ?></b></p>
                    <p><?php echo $DataArr['ResponseObject']['Message']; ?></p>
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