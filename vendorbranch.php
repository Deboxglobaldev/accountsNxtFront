<?php 
// get url
include 'inc.php';
include "logincheck.php";

//branch user list
$url = $serverurlapi."General/vendorBranchList.php";
$searching = '{
				"Type" : "Branch",
        		"Id" : "'.$_GET['vendorId'].'"
			}';
logger('Vendor mapping :'.$url.'---'.$searching);
logger($url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
logger('Response return: '.$result);
$DataMappingArr = json_decode($result);
curl_close($ch)

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Branch List</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
} );
</script>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
    <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    <div class="hk-pg-wrapper"  style="background-image: url(../html/dist/img/Religare-Dashboard-BG.JPG);">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<div class="container-fluid" style="margin-top:20px;">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr class="vcx-i hgt">
			<th width="10%">S.No</th>
              <th>Vendor Code</th>
              <th>Branch Code</th>
            </tr>
          </thead>
          <tbody id="tablesearch">
          <?php
		if($DataMappingArr!=''){									 
		$no=1;
		foreach($DataMappingArr->List as $fieldList){
		?>
            <tr class="uyt hgte">
			<td width="10%"><?php echo $no; ?></td>
              <td width="20%"><?php echo $_GET['vendorId']; ?></td>
              <td width="20%"><?php echo $fieldList->ListCode; ?></td>
            </tr>
            <?php
		$no++;} }else{
		echo 'no data found';
		}
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
