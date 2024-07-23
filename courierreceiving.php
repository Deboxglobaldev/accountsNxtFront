<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- ";
logger($InfoMessage." URL for API - ".$url);

if($_POST['action']=='courierreceive'){
 	$ackJson = '';
	foreach($_POST['courierchecksingle'] as $CourierNumber){
		$ackJson.= '{"CourierNumber":"'.$CourierNumber.'"},';
	}
	
	$jsonPost = '{
		"UserId":"'.$_SESSION['UID'].'",
		"ip":"'.$_SERVER["REMOTE_ADDR"].'",
		"listofcourier":['.rtrim($ackJson,',').']
	}';
	
	logger("JSON POST FOR COURIER RECEIVED API:  ----".$jsonPost);
	$url = $serverurlapi."General/courierReceivedAPI.php";
	logger("  API hit URL: ". $url); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$responseData = curl_exec($ch);
	logger("Response return from courier received API: ". $responseData); 
	$dashData = json_decode($responseData);
	
	curl_close($ch);

if($dashData->status==0){

$location = 'ackreceiving.php';

?>
<script>
parent.window.location.href = '<?php echo $location; ?>';
</script>
<?php } 
	
}	


if($_GET['fromDate']!='' && $_GET['toDate']!=''){
  $fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
  $toDate = date('Y-m-d',strtotime($_GET['toDate']));
}

$courierNumber = $_GET['courierNumber'];
 
$searching = '{
  "courier":"'.$courierNumber.'",
 "fromDate":"'.$fromDate.'",
 "toDate":"'.$toDate.'",
 "page":"courierlist"
}';

  
	
$url = $serverurlapi."Dashboards/courierDashboard.php";
logger($InfoMessage." URL for API - ".$url); 
logger("REQUEST SENT TO COURIER LIST NULL: ".$searching); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$responseData = curl_exec($ch);
logger("Response return from courier list API: ". $responseData); 
$dashData = json_decode($responseData);
curl_close($ch);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Courier Receiving</title>
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Favicon -->
</head>

<body>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper">
            <!-- <div style="background:transparent;">

</div> -->

            <section>
                <div class="container-fluid">
                    <form action="" method="get" />
                    <div class="row gy-bvc">
                        <div class="col-md-6">
                            <div class="flx">
                                <h6 style="font-weight: initial;">Courier&nbsp;Number</h6>
                                <select class="inp-w ui-select" name="courierNumber">
                                    <option value="">Select</option>
                                    <?php
      $jsonpost = '{
        "courier":"",
        "page":"courierlist"
      }';
      $posturl = $serverurlapi."Dashboards/courierlistapi.php";
      $response = postCurlData($posturl,$jsonpost);
      $arrData = json_decode($response);			
      foreach($arrData->CourierList as $courierNumberData){
			?>
                                    <option value="<?php echo $courierNumberData->Courier; ?>"
                                        <?php if($courierNumberData->Courier==$_GET['courierNumber']){ ?>selected="selected"
                                        <?php } ?>><?php echo $courierNumberData->Courier; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="flx">
                                <h6 style="font-weight: initial;">From&nbsp;Date</h6>
                                <input type="text" name="fromDate" class="form-control datepicker"
                                    value="<?php echo $_GET['fromDate']; ?>" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="flx">
                                <h6 style="font-weight: initial;">To&nbsp;Date</h6>
                                <input type="text" name="toDate" class="form-control datepicker"
                                    value="<?php echo $_GET['toDate']; ?>" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="row gy-bvc ">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-3">

                            <input type="hidden" name="action" value="searchaction" />
                            <input type="submit" name="Search" class="btn btn-default browsebutton pd-button"
                                value="Search" />

                        </div>
                        <div class="col-md-3">


                            <button type="button" class="btn btn-default browsebutton pd-button">Exit</button>

                        </div>
                    </div>
                    </form>

            </section>
            <section>
                <div class="container-fluid">
                    <form method="post" action="">
                        <input type="hidden" name="action" value="courierreceive">
                        <div class="container-fluid" style="margin-top:10px;" id="tabledata">
                            <div id="batchbutton" style="display:none; float:left;"><button type="submit"
                                    class="btn btn-success" style="font-size: 13px; font-weight: 700;">Mark
                                    Received</button></div>
                            <table class="table table-bordered " id="tableID" style="width:100% !important; ">
                                <thead>
                                    <tr class="headline" style="">
                                        <th><input name="courierCheckAll" type="checkbox" class="" id="courierCheckAll"
                                                style="height: 17px;width: 50px;margin-top: 0;text-align: center;" />
                                        </th>
                                        <th>Courier No.</th>
                                        <th>Bunch&nbsp;No.</th>
                                        <th>Dispatch&nbsp;Date</th>
                                        <th>Courier Details</th>
                                        <th>Sub Stage</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="searchTable">
                                    <?php
		$no=1;
		foreach($dashData->CourierList as $courierno){
			foreach($courierno->BunchList as $resultList){
		?>
                                    <tr>
                                        <td><?php if(substr($resultList->Stage,-2)=='CS'){ ?><input type="checkbox"
                                                style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;"
                                                value="<?php echo $courierno->Courier; ?>" name="courierchecksingle[]"
                                                class="deleteack" /><?php } ?></td>
                                        <td><a
                                                href="receivingacknumber.php?bunchNumber=<?php echo $resultList->Bunch; ?>"><?php echo $courierno->Courier; ?></a>
                                        </td>
                                        <td><span><?php echo $resultList->Bunch; ?></span></td>
                                        <td><?php echo date('d-M-Y',strtotime($resultList->CourierDate)); ?></td>
                                        <td><?php echo $resultList->CourierdAddress; ?></td>
                                        <td><?php if(substr($resultList->Stage,-2)=='CR'){ echo 'Courier Received'; }  if(substr($resultList->Stage,-2)=='CS'){ echo 'Courier Sent'; }  ?>
                                        </td>
                                    </tr>
                                    <?php
			}
		$no++;  
		}
		?>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </section>

            <script>
            /* Initialization of datatables */
            $(document).ready(function() {

                // Paging and other information are
                // disabled if required, set to true
                var myTable = $("#tableID").DataTable({
                    paging: true,
                    searching: true,
                    info: true,
                    //stateSave: true,
                    orderCellsTop: true,
                    initComplete: function() {
                        this.api().columns([1, 2]).every(function(i) {
                            var selcolID = "sel_" + i;
                            var column = this;
                            var select = $('<select class="filterCls" id="' + selcolID +
                                    '"><option value="">--Select--</option></select>')
                                .appendTo($("#tableID thead tr:eq(1) th").eq(column.index())
                                    .empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });
                            column.data().unique().sort().each(function(d, j) {
                                var textVal = $(d).text()
                                select.append('<option value="' + textVal + '">' +
                                    textVal + '</option>');
                            });
                        });
                    }
                });


            });
            </script>

            <script type="text/javascript">
            $(document).ready(function() {
                // check uncheck all inclusions
                $("#courierCheckAll").click(function() {
                    if (this.checked) {
                        $('.deleteack').each(function() {
                            this.checked = true;
                        })
                    } else {
                        $('.deleteack').each(function() {
                            this.checked = false;
                        })
                    }
                });

            });

            window.setInterval(function() {
                checked = $("#tabledata input[type=checkbox]:checked").length;
                if (!checked) {
                    $("#batchbutton").hide();
                } else {

                    $("#batchbutton").show();
                }
            }, 100);
            </script>
        </div>
    </div>
    </div>
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
    <script>
$(function() {
    $(".datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        maxDate: 0
    });
});
</script>
    <?php include 'footer.php'; ?>
</body>

</html>

<!--search filter-->