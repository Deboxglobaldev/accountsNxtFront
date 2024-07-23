<?php
include "inc.php";
include "logincheck.php";
$searching = '{
   "ListData":[
      {
         "BunchNumber":"'.$_REQUEST['BunchNumber'].'"
      }
   ]
}';

$url = $serverurlapi."General/getAckNoforBunchNo.php";
logger($InfoMessage." URL for API - ".$url); 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searching);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$responseData1 = curl_exec($ch);
logger("Response return from courier list API: ". $responseData1); 
$dashDatanew = json_decode($responseData1);
curl_close($ch);
?>
<div class="col-md-12">
<table class="table table-bordered " id="tableID" style="width:100% !important; ">
  <thead>
    <tr style="background: #fbfbfb;">
      <td><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></td>
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
	foreach($dashDatanew{0}->DataTable as $list){
	$sno++;
	$rand = rand();
	?>
    <tr>
      <td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $list->Acknowledgement; ?>" name="acknowledgmentchecksingle[]" class="deleteack" checked /></td>
      <td><?php echo $list->Acknowledgement ?>
        <input type="hidden" name="ackNumber<?php echo $sno; ?>" value="<?php echo $list->Acknowledgement; ?>">
      </td>
      <td><?php echo $sno; ?>
        <input type="hidden" name="ReceivingNumber<?php echo $sno; ?>" value="<?php echo $sno; ?>"></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<input type="hidden" id="items" name="items" value="<?php echo $sno; ?>" />
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
<script type="text/javascript">
    $(document).ready(function(){
    // check uncheck all inclusions
    $("#ackknowledmentCheckAll").click(function(){
    if(this.checked){
      $('.deleteack').each(function(){
        this.checked = true;
      })
    }else{
      $('.deleteack').each(function(){
        this.checked = false;
      })
    }
    });
    
    });

    window.setInterval(function(){ 
      checked = $("#tabledata input[type=checkbox]:checked").length;
      if(!checked) { 
    $("#batchbutton").hide();
      } else {
	  
    $("#batchbutton").show();
    } 
}, 100);
</script> 