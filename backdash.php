<?php 
// get url   
include "inc.php";
include "logincheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Report Dashboard</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<style>
.filterCls{
	padding: 2px;
}
table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled) {
    padding-right: 10px !important;
    padding-left: 10px !important;
}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 1px !important;
}
.headline {
    border-bottom: 4px solid #1f7140 !important;
}
.thCls{
	 font-size: 15px;  font-weight: 700; color: #fff;
	 
}
#tableID_length{
 display:none;
}
</style>
<!-- Favicon -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Document Uploaded',     1093],
		  ['Croping',     593],
		  ['Quality Check ',     25],
          ['Rejection',     4],
		  ['Batch Genetation',     209],
        ]);

        var options = {
          title: 'Digitization Stage',
          pieHole: 0.2,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Task', 'Hours per Day'],
          ['Courier Sent',     20],
		  ['Receiving',     593],
		  ['Box Alloted ',     200]
		  
        ]);

        var options = {
          title: 'Document Management',
          pieHole: 0.2,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
      }
    </script>	
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Due', 'Payment'],
          ['Jul', 1000, 400],
          ['Aug', 1170, 460],
          ['Sep', 660, 1120],
          ['Oct', 1030, 540]
        ]);
	
        var options = {
          chart: {
            title: 'Due vs Payment',
            subtitle: 'Monthly',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Monthly'],
          ['Jan', 1047],
          ['Feb', 67],
          ['Mar', 660],
          ['Apr', 98],
		  ['May', 22],
		  ['Jun', 59],
		  ['Jul', 95],
		  ['Aug', 974],
		  ['Sep', 22],
		  ['Oct', 164],
		  ['Nov', 222],
		  ['Dec', 244],
        ]);
	
        var options = {
          chart: {
            title: 'Pending Physical Application',
            subtitle: 'Branch Level',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material2'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'backofficeheader.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper">
    <div class="container-fluid">
	 
      <div class="row gy-bvc" style="margin-top:25px; padding:10px !important;">
        <div class="col-md-6">
			<div id="donutchart"></div>
		</div>
		<div class="col-md-6">
			<div id="donutchart1"></div>
		</div>
      </div>
	  <div class="row gy-bvc" style="margin-top:25px; padding:10px !important;">
        <div class="col-md-6">
			<div id="columnchart_material"></div>
		</div>
		<div class="col-md-6">
			<div id="columnchart_material2"></div>
		</div>
      </div>
    </div>
    
  </div>
</div>
</div>


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
<?php include 'footer.php'; ?>
</body>
</html>
<!--search filter-->
