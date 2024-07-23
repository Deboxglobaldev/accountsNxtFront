<?php 
// get url
include "inc.php";
include "logincheck.php";
$InfoMessagProductTypee = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage." URL for API - ".$url); 
if(isset($_POST['Search']))
{

$ProductTypeq = "'".$_POST['ProductType']."'";
$FormTypeq = "'".$_POST['FormType']."'";

$searching = '{"ProductType":"'.$ProductTypeq.'","FormType":"'.$FormTypeq.'"}';

  $url = "".$serverurlapi."General/rejectioninfoList.php";
  logger($InfoMessage." URL for API - ".$searching); 

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $result = curl_exec($ch);
  $rejectionData = json_decode($result, true);
  curl_close($ch);
}
else
{
  $searching = "";

  $url = "".$serverurlapi."General/rejectioninfoList.php";
  logger($InfoMessage." URL for API - ".$url); 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $result = curl_exec($ch);
  $rejectionData = json_decode($result, true);
  // $rejectionDataq = json_decode($rejectionData['Rejectionlist'], true);
  curl_close($ch); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Rejection List</title>
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
    <form action="" method="post" />
      <div class="row gy-bvc" style="">
        <div class="col-md-3">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Product&nbsp;Type</h6>
            <select class="inp-w ui-select" name="ProductType" >
              <option value="">Select</option>
              <option value="PAN"<?php if($_POST['ProductType']=='PAN'){?>selected="selected"<?php } ?>>PAN</option>
              <option value="TAN"<?php if($_POST['ProductType']=='TAN'){?>selected="selected"<?php } ?>>TAN</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="search-input-grid">
            <h6 style="font-weight: initial;">Form&nbsp;Type</h6>
            <select class="inp-w ui-select" name="FormType" >
              <option value="">Select</option>
              <option value="49A"<?php if($_POST['FormType']=='49A'){?>selected="selected"<?php } ?>>PAN 49A</option>
              <option value="49AA"<?php if($_POST['FormType']=='49AA'){?>selected="selected"<?php } ?>>PAN 49AA</option>
              <option value="CR"<?php if($_POST['FormType']=='CR'){?>selected="selected"<?php } ?>>PAN CR</option>
            <option value="49B"<?php if($_POST['FormType']=='49B'){?>selected="selected"<?php } ?>>TAN NEW</option>
            <option value="CR"<?php if($_POST['FormType']=='CR'){?>selected="selected"<?php } ?>>TAN CR</option>
            </select>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="search-input-grid">
          <h6>&nbsp;</h6>
         <div class="search-button">
              <input type="submit" name="Search" class="btn btn-default browsebutton pd-button" value="Search" />
              <button type="reset" class="btn btn-default browsebutton pd-button">Reset</button>
          </div>
        </div>
        </div>
      </div>
    </form>
      <div class="row gy-bvc nn-mb">
        <div style="display:none;" class="col-md-12">
          <div class="row lk-kl">
            <div class=""> <a href="addrejection.php">
              <button type="button" class="btn btn-default browsebutton pd-btns"> <i class="fa-plus fa">&nbsp;</i>Add</button>
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
              <th>Product&nbsp;Type</th>
              <th>Form&nbsp;Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
            <?php
    if($rejectionData['Status'] =='0'){
    // if(isset($rejectionDataq)){                    
    $no=1;
    foreach($rejectionData['Rejectionlist'] as $resultList){
    ?>
            <tr class="uyt hgte">
              <td><?php echo $no; ?></td>
              <td><?php echo $resultList['ProductType']; ?></td>
              <td><?php echo $resultList['FormType']; ?></td>
              <td><div class="gvre"> 
                <!-- <a href="addrejection.php?editId=<?php echo $resultList['id']; ?>" class="btn btn-default branchbtn">Edit</a> -->
                <a href="addFieldList.php?product=<?php echo $resultList['ProductType']; ?>&form=<?php echo $resultList['FormType']; ?>" class="btn btn-default branchbtn ">Field&nbsp;List</a>
                </div></td>
            </tr>
            <?php
    $no++; } 
  // }
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
