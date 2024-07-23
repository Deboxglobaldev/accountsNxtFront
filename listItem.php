<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessagProductTypee = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url); 


  $searching = "";

  $url = "".$serverurlapi."General/itemInfoList.php";
  logger($InfoMessage." URL for API - ".$url); 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $result = curl_exec($ch);
  $ItemData = json_decode($result, true);
  curl_close($ch); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>PAN Dashboard</title>
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
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <section>
    <div class="container-fluid">
      <div class="row gy-bvc nn-mb">
        <div style="color: #4f9d28;font-weight: 600;text-transform: uppercase;font-size: 20px;">List Item Master</div>
        <div class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="addItemList.php">
              <button type="button" class="btn btn-default browsebutton" style="padding: 7px;"> <i class="fa-plus fa">&nbsp;</i>Add Item</button>
              </a></div>
          </div>
        </div>
      </div>
      </section>
      <div class="container-fluid">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
              <th>S.No</th>
              <th>Item&nbsp;Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
            <?php
    if($ItemData['Status'] =='0'){                   
    $no=1;
    foreach($ItemData['ItemList'] as $resultList){
    ?>
            <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php echo $resultList['ItemName']; ?></td>
              <td><?php if($resultList['Status'] == '1'){ ?><span style="color:green"><?php echo 'Active'; ?></span><?php }else{ ?><span style="color:red;"> <?php echo 'Inactive'; ?></span><?php } ?></td>
              <td><div class="gvre">
                <a href="addItemList.php?editId=<?php echo $resultList['Id']; ?>" class="btn btn-default branchbtn">Edit</a>
                </div></td>
            </tr>
            <?php
    $no++; } 
  }
  else{ ?>
    <tr class="uyt hgte">
<td colspan="4"><div align="center"><?php echo 'You Can Search...'; ?></div></td>    
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
