<?php
include "inc.php";
include "logincheck.php";

$url = $serverurlapi."General/userGroupAPI.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
//logger('RESPONSE RETURN FROM USER GROUP API: '.$result);
$data = json_decode($result);
$DataTable = $data->DataTable;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>User Group</title>
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
<style>
.custom-file-upload{
  
  padding: 8px;
 
  border-radius: 5px; 
 
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
</style>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="">
    <!-- Row -->
    <div class="container-fluid"> </div>
    <div class="row contas">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper contas1">
          <div class="dostas">
            <div style="display: flex;">
              <div class="dostas2"> </div>
              <h3>User Group List</h3>
              <p></p>
              <div class="dostas1"> </div>
            </div>
          </div>
          <div class="container-fluid" style="margin-top:20px;">
		<table id="datatable" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr class="vcx-i hgt">
					<th>SR#</th>
					<th>Name</th>
					<th>Type</th>
				</tr>
			</thead>
			<tbody id="tablesearch">
				<?php
				$no=1;
				foreach($DataTable as $userGroup){

          if($userGroup->UserType!='SUPER'){
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><a href="pagePermissionList.php?id=<?php echo encode($userGroup->Id); ?>&q=<?php echo encode($userGroup->UserName); ?>"><?php echo $userGroup->UserName; ?></a></td>
					<td><?php echo strtoupper($userGroup->UserType); ?></td>
				</tr>
				<?php $no++; } } ?>
			</tbody>
		</table>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
<style>

.submitbutton{
        background-color: rgb(247 141 70);
        width:100%;
  color:black;
    font-weight: bold;
}
.sign{
padding-right: 15px;
}
.cls{

background: rgb(247 141 70);
    padding: 6px 8px;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    bottom: -5px;
}
.contas{
  margin-left: 0px!important;
  margin-right: 0px!important;
margin-top: 15px!important;
}
</style>
