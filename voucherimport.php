<?php
//get url
include "inc.php";
include "logincheck.php";
require_once 'reader.php';
$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Voucher Import</title>
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

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(e) {
        $("#exportfrm").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "uploadvoucherimport.php",
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
                    if(objData.Status==true) {
                        $("#blkbox").hide();
                        $('#successCount').text(objData.Successfull);
                        $('#failedCount').text(objData.Failed);
                        $("#msg").html(objData.Message);
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