<?php 
include "inc.php";
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url);
$branchCode = '';
if($_POST['action']=="searchaction")
{
$jsonData = '{
    "billPeriod":"'.$_POST['billPeriod'].'"
}';

$url = $serverurlapi."General/billSummaryReportAPI.php";
logger($InfoMessage." URL for API - ".$url); 
logger($InfoMessage." Value for API - ".$searching); 
$resultData = postCurlData($url,$jsonData);
$billReportData = json_decode($resultData);
}


$loginType = strtoupper($_SESSION['Type']);
if($loginType=="BRANCH"){
  $branchCodeNum = $_SESSION["BID"];
}else{
  $branchCodeNum = $branchCode;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Bill Summary</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
} );
</script>
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <section>
    <div class="container-fluid">
    <form action="" method="POST" autocomplete="nope" id="exportfrm" />
        <div class="row gy-bvc">
          <div class="col-md-4">
          <div >
          <h6 style="font-weight: initial;">Bill Period</h6>
           <select name="billPeriod" id="billPeriod" class="form-control">
            <option value="">Select</option>
            <?php
      $result = postCurlData($serverurlapi."General/billInformationAPI.php","");
      $billData = json_decode($result, true);
      if(isset($billData['status'])=='true'){
      if(isset($billData['billPeriod'])){                    
      $no=1;
      foreach($billData['billPeriod'] as $resultList){
      ?>
            <option value="<?php echo $resultList['Id']; ?>"  <?php if($_POST['billPeriod'] == $resultList['Id']){ echo "selected"; } ?>><?php echo date('d/m/Y',strtotime($resultList['FromDate']))." - ".date('d/m/Y',strtotime($resultList['ToDate'])); ?></option>
      <?php } } } ?>
            </select>

           </select>
          </div>
        </div>
        
        <div class="col-md-1">
          <div>
            <h6>&nbsp;</h6>
          <input type="hidden" id="action" name="action" value="" />
          <div style="display:grid;grid-template-columns: auto auto;grid-gap: 10px;">
          <input type="button" name="Search" class="btn btn-success" onClick="searchFunc('searchaction');" value="Display" />
          
          </div>
        </div>
        </div>
    
        </div>
      </form>
   
    </div>
     <script>
 function searchFunc(data){
  $('#action').val(data);
  $('form#exportfrm').submit();
 }

 </script> 
 <script>
$( function() {
  $( ".datepicker" ).datepicker({ 
    dateFormat: 'dd-mm-yy',
    maxDate: 0
  });
});

</script>
      </section>
      <div class="container-fluid" style="overflow-x: auto;">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>S.No</th>
              <th>Branch&nbsp;Code</th>
  <th>Branch&nbsp;Name</th>
  <th>Bill&nbsp;Number</th>
  <th>Amount</th>
  <th>Service&nbsp;Tax</th>
<th>Total</th>
  <th>IsBillGenerate</th>
  <th>Paid&nbsp;Date</th>
  <th>Generated&nbsp;By</th>
  <th>Generated&nbsp;Date&nbsp;Time</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
  <?php
    if(isset($billReportData->Status) == 'true'){
    if(isset($billReportData->TotalData)){                    
    $no=1;
    foreach($billReportData->TotalData as $resultList){
    ?>
              <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php if($resultList->SubLedgerCode != ""){ ?>
               <a href="obligationReport.php?bid=<?php echo encode($resultList->SubLedgerCode); ?>&bpi=<?php echo encode($resultList->Id); ?>" target="_blank"><?php echo $resultList->BranchCode; ?></a>
             <?php } else{ echo $resultList->BranchCode; } ?>
             </td>
              <td><?php echo $resultList->BranchName; ?></td>
              <td><?php echo $resultList->BillNumber; ?></td>
              <td><?php echo $resultList->Amount; ?></td>
              <td><?php echo $resultList->ServiceTax; ?></td>
              <td><?php echo $resultList->Total; ?></td>
              <td><?php echo $resultList->IsBillGenerate; ?></td>
              <td><?php echo $resultList->PaidDate; ?></td>
              <td><?php echo $resultList->GeneratedBy; ?></td>
              <td><?php echo $resultList->GeneratedDateTime; ?></td>
                        
            </tr>
             <?php $no++; } } }
   else{ ?>
    <tr class="uyt hgte">
<td colspan="11"><div align="center"><?php echo 'You Can Search...'; ?></div></td>    
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
  .ui-select{
    padding: 2%;
  }
  .hgt th{
    text-align: center;
    font-weight: bold;
  }
  .hgte td{
    text-align: center;
  }
  .gvre{
        display: flex;
    column-gap: 10px;
  }
  .lk-kl{
  width: fit-content;
    margin-left: auto;
    column-gap: 50px;
  }
  .pd-btn{
    padding: 3px 40px;
  }
  .pd-btn2{
    padding: 3px 80px;
  }
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .search-input-grid{
     display: grid;
    grid-gap: 5px;
  }
  .search-button{
      display: grid;
    grid-template-columns: auto auto;
    grid-gap: 20px;
  }
  .vcx-i{
    border-top: 2px solid;
    border-bottom: 2px solid;
  }
  .ht-jy{

    margin-top:7%;
  }
.inp-wuui{
  margin: 3px;
}
.gy-bvc{
  margin: 1%;
}
.nn-mb{
  margin-top: 3%;
}
.inp-w{
  width: 90%;
}
.uyt td{
  border: none;
}
</style>
<!--search filter-->
<script>
function searchingName(){
    var name = $("#bname").val().toLowerCase();
    $("#tablesearch tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
    });
}
</script>
