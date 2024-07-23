<?php 

include "inc.php";
include "logincheck.php";

//get mis liste
logger("Session BranchId...".$_SESSION["branchId"]);
logger("Session Type...".$_SESSION["Type"]);
 

if($_GET['fromRange']!="" && $_GET['toRange']!=""){
$fromRange = $_GET['fromRange'];
$toRange = $_GET['toRange'];
}else{
$fromRange = "";
$toRange = "";
}

	$jsonPost = '{ "UserType": "'.$_SESSION["Type"].'", "UserId": "", "UserTypeId": "'.$_SESSION["branchId"].'","page":"backofficedashboard","fromRange":"'.$fromRange.'","toRange":"'.$toRange.'"}';
	
	logger("JSON to post dashboard data:  ----".$jsonPost);
	$urlNew = $serverurlapi."Dashboards/BackOfficeDashboardHistoryAPI.php";
	logger("  API hit URL: ". $urlNew); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$urlNew);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$response = curl_exec($ch);
	//logger("Response return from dashboard API: ". $response); 
	$dashData = json_decode($response);
	//print_r($dashData);
	curl_close($ch);
	
	
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard | Back Office </title>
    <meta name="description" content="PAN OFFICE" />

    <!-- Favicon -->
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
</head>

<body>


    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

        <div class="hk-pg-wrapper">

            <div
                style="background-color: #1e733f;background-image:linear-gradient(to right,#1e733f,#79c117);padding:3px;">
                <div class="Container-fluid">
                    <div class="row strip">
                        <div class="col-sm-6">
                            <p class="ticker"></p>
                        </div>

                        <div class="col-sm-6">
                            <p class="ticker"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Row -->



			<div class="container-fluid">
            <div id="tabledata" style="padding: 10px;">
                <form method="GET" action="">
                    <div class="row" style="margin-bottom: 10px; ">
                        <div class="col-md-2">
                            <div class="flx">
                                <input type="number" name="fromRange" id="fromRange" value="<?php echo $fromRange; ?>"
                                    placeholder="From Range.." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="flx">
                                <input type="number" name="toRange" id="toRange" value="<?php echo $toRange; ?>"
                                    placeholder="To Range.." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="flx">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                    <div id="batchbutton" style="display:none; float:left;"><button type="submit"
                            class="btn btn-success" style="font-size: 13px; font-weight: 700;">Create Bunch</button>
                    </div>
                    <input type="hidden" name="action" value="search">
                    <table class="table table-bordered " id="tableID" style="width:100% !important;">
                        <thead>
                            <tr class="headline" style="background: #5ea923;">
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Acknowledge
                                    No.</th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">
                                    Prod.&nbsp;Type</th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Stage</th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Sub Stage
                                </th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Vendor</th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">
                                    Box&nbsp;Number</th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">
                                    Bar&nbsp;Code</th>
                                <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Receiving#
                                </th>
                            </tr>
                            <tr style="background: #5ea923;">
                                <th></th>
                                <th></th>
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
if($dashData[0]->Status=='0')
{	
$color1='';
$color2='';							
$UserType = $_SESSION["Type"];
$UserType = strtoupper($UserType);		 
$no=1;
foreach($dashData[0]->DataTable as $list)
{

?>
                            <tr>
                                <td class="deta"><?php echo $list->Acknowledgement; ?></td>
                                <td><span><?php echo strtoupper($list->ProductType); ?></span></td>
                                <td><span><?php echo $list->CurrentStage; ?></span></td>
                                <td><span><?php echo $list->SubStage; ?></span></td>
                                <td><span><?php if($list->VendorId==1){ echo 'Vendor 1'; } ?></span></td>
                                <td><span><?php echo $list->BoxNumber; ?></span></td>
                                <td><span><?php echo $list->BarcodeNo; ?></span></td>
                                <td><span><?php echo $list->ReceivingNo; ?></span></td>
                            </tr>
                            <?php
$no++; }  
}else{
echo 'no data found';
}
?>
                        </tbody>
                    </table>

                </form>
            </div>

        </div>
    </div>
	</div>
    </div>

    </div>

    </div>



    <?php include 'footer.php'; ?>
    <!--search filter-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

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
                this.api().columns([1, 2, 3, 4, 5, 6, 7]).every(function(i) {
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
                        select.append('<option value="' + textVal + '">' + textVal +
                            '</option>');
                    });
                });
            }
        });

        // 2d array is converted to 1D array
        // structure the actions are 
        // implemented on EACH column
        //$('#tableID thead tr').clone(true).appendTo( '#tableID thead' );
        //$('#tableID thead tr:eq(1) th').each( function (colID) {

        //var selcolID = "sel_"+colID;

        //var mySelectList = $(this).html( "<select id="+selcolID+"><select />" );



        //}); 




    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        // check uncheck all inclusions
        $("#ackknowledmentCheckAll").click(function() {
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

</body>

</html>



<style>


</style>