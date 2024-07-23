<?php
include "inc.php";
include "logincheck.php";
$courierNumber = $_REQUEST['courierNumber'];

$searching = '{
	"courier":"'.$courierNumber.'"
}';

$url = $serverurlapi."General/getAckNofromCourier.php";
logger($InfoMessage." URL for API - ".$url); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
logger("Response return from courier ack list API: ". $response); 
$dashDatanew = json_decode($response);
curl_close($ch);
?>
<div class="col-md-12">
<table class="table table-bordered " id="tableID" style="width:100% !important; ">
  <thead>
    <tr style="background: #fbfbfb;">
      <td>Acknowledgement Number</td>
      <td>Receiving Number</td>
    </tr>
    <tr style="display:none;">
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody id="searchTable">
    <?php
	$sno = 0;
	foreach($dashDatanew{0}->ListofACK as $list){
	$sno++;
	?>
    <tr>
      <td><?php echo $list->AcknowledgementNo ?></td>
      <td></td>
    </tr>
    <?php $sno++; } ?>
  </tbody>
</table>
</div>
<script>

/* Initialization of datatables */
$(document).ready(function () {

// Paging and other information are
// disabled if required, set to true
var myTable = $("#tableID").DataTable({
  paging: true,
  searching: true,
  info: true,
  //stateSave: true,
  orderCellsTop: true,
  initComplete: function () {
        this.api().columns([0,1]).every( function (i) {
			var selcolID = "sel_"+i;
            var column = this;
            var select = $('<select class="filterCls" id="'+selcolID+'"><option value="">--Select--</option></select>')
               .appendTo( $("#tableID thead tr:eq(1) th").eq(column.index()).empty() )
                    .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
                } );
            column.data().unique().sort().each( function ( d, j ) {
			var textVal = $( d ).text()
                    select.append( '<option value="'+textVal+'">'+textVal+'</option>' );
            } );
        } );
    }
});


});
</script>
 