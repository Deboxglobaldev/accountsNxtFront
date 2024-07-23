<?php
//get url
include "inc.php";
include "logincheck.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>GST Import Data</title>
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
        <?php include 'backofficeheader.php'; ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <div class="hk-pg-wrapper" style="">

            <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px; display:none;"
                id="divMsg">
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
                                <input type="file" name="attachmentFile" class="form-control" value="" required
                                    autocomplete="off" />

                            </div>
                            <p id="err" style="color:red;"></p>
                        </div>

                        <div class="col-md-1">
                            <div class="flx">
                                <input type="hidden" id="action" name="action" value="" />
                                <input type="submit" name="Search" id="importBtn" class="btn btn-success"
                                    onClick='submitForm("import");' value="Import Invoice" />
                            </div>
                        </div>

                        <div class="col-md-3" style="margin-left:35px;">
                            <div class="flx">
                                <div style="background: #f1f0f0; padding: 15px;">Total Entries: <span
                                        style="color:green;font-weight: 700; font-size: 17px;"
                                        id="successCount">0</span></div>
                                <div style="background: #f1f0f0; padding: 15px; display:none; ">Failed Record: <span
                                        style="color:red;font-weight: 700; font-size: 17px;" id="failedCount">0</span>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-1" style="margin-left:35px;">
                            <div class="flx">
                                <input type="submit" name="Search" id="exportBtn" class="btn btn-warning"
                                    onClick='submitForm("export");' value="Export Invoice" />
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row gy-bvc">
                    <div class="col-md-12">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead id="theadId">
                                <tr class="vcx-i hgt">
                                    <td>BranchCode</td>
                                    <td>IRN</td>
                                    <td>IRNDate</td>
                                    <td>TaxScheme</td>
                                    <td>CancellationReason</td>
                                    <td>CancellationRemarks</td>
                                    <td>SupplyType</td>
                                    <td>DocCategory</td>
                                    <td>DocumentType</td>
                                    <td>DocumentNumber</td>
                                </tr>
                            </thead>
                            <tbody id="tablesearch">

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <script>
    
    function submitForm(propVal){
        $('#action').val(propVal);
        const actionVal = $('#action').val();
        //console.log(actionVal);
    }

    
        $(document).ready(function(e) {
            $("#exportfrm").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "uploadgstformat.php",
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
                        var objData = jQuery.parseJSON(data);
                        
                        if(objData.Type=="Import"){
                            console.log(objData.Status);
                            if (objData.Status == true) {
                            $("#blkbox").hide();
                            $('#successCount').text(objData.Successfull);
                            $('#failedCount').text(objData.Failed);
                            $("#msg").html("File imported successfully!");
                            $('#divMsg').show().fadeIn();
                            //$("#exportfrm")[0].reset();

                            const arrData = objData.JsonReturnData.JsonData;

                                var html = "";
                                for (var i = 0; i < arrData.length; i++) {
                                    html += "<tr>";
                                    html += "<td>" + arrData[i].BranchCode + "</td>";
                                    html += "<td>" + arrData[i].IRN + "</td>";
                                    html += "<td>" + arrData[i].IRNDate + "</td>";
                                    html += "<td>" + arrData[i].TaxScheme + "</td>";
                                    html += "<td>" + arrData[i].CancellationReason + "</td>";
                                    html += "<td>" + arrData[i].CancellationRemarks + "</td>";
                                    html += "<td>" + arrData[i].SupplyType + "</td>";
                                    html += "<td>" + arrData[i].DocCategory + "</td>";
                                    html += "<td>" + arrData[i].DocumentType + "</td>";
                                    html += "<td>" + arrData[i].DocumentNumber + "</td>";

                                    html += "</tr>";

                                }
                                document.getElementById("tablesearch").innerHTML = html;
                            }else{
                                // invalid file format.
                                $("#blkbox").hide();
                                $("#err").html("Invalid File !").fadeIn();
                            }
                         
                        }else if(objData.Type=='Export'){
                            $("#msg").html(objData.Message);
                            $("#blkbox").hide();
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
    <div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-color: #000000c7; z-index: 9999; display:none;"
        id="blkbox">
        <div
            style="padding:20px; background-color:#FFFFFF; margin:auto; width:300px; margin-top:10%; text-align:center; border-radius: 10px;color: green;">
            <img src="img/Spin2.gif" width="100px;"><br>
            Processing File... Please wait
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