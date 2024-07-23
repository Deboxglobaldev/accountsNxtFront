<?php
include "inc.php";
include "logincheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Account Tree</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.box {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.box::before {
  content: "\2610";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.check-box::before {
  content: "\2611"; 
  color: dodgerblue;
}

.nested {
  display: none;
}

.active {
  display: block;
}


</style>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(img/Religare-Dashboard-BG.JPG);">
   
    <link rel="stylesheet" href="css/font-awesome.min.css">
   
    <div class="row contas">
      <div class="col-xl-12 ">
        <section class="hk-sec-wrapper con">
		<ul id="myUL">
  <li><span class="box">Beverages</span>
    <ul class="nested">
      <li>Water</li>
      <li>Coffee</li>
      <li><span class="box">Tea</span>
        <ul class="nested">
          <li>Black Tea (20)(50)</li>
          <li>White Tea(20)(50)</li>
          <li><span class="box">Green Tea</span>
            <ul class="nested">
              <li>Sencha(20)(50)</li>
              <li>Gyokuro(20)(50)</li>
              <li>Matcha(20)(50)</li>
              <li>Pi Lo Chun(20)(50)</li>
            </ul>
          </li>
        </ul>
      </li>  
    </ul>
  </li>
</ul>

<script>
var toggler = document.getElementsByClassName("box");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("check-box");
  });
}

// AJAX request
		$.ajax({
			url: 'apihit.php',
			type: 'post',
			data: form_data,
			//dataType: 'json',
			contentType: false,
			processData: false,
			success: function (response) {
				console.log(response);
				var arr = '['+response+']';
				arr = JSON.parse(arr);
				//console.log(arr);
			},
			error:function(exception){
				alert('Exeption:'+exception);
			}
		});
		
</script>

<?php
// function to create dynamic treeview menus
function createTreeView($parent, $menu) {
   $html = "";
   if (isset($menu['parents'][$parent])) {
      $html .= "
      &amp;amp;lt;ol class='tree'&amp;amp;gt;";
       foreach ($menu['parents'][$parent] as $itemId) {
          if(!isset($menu['parents'][$itemId])) {
             $html .= "&amp;amp;lt;li&amp;amp;gt;&amp;amp;lt;label for='subfolder2'
&amp;amp;gt;&amp;amp;lt;a href='".$menu['items'][$itemId]['link']."'&amp;amp;gt;"
.$menu['items'][$itemId]['label']."&amp;amp;lt;/a&amp;amp;gt;&amp;amp;lt;/label&amp;amp;gt;
 &amp;amp;lt;input type='checkbox' name='subfolder2'/&amp;amp;gt;&amp;amp;lt;/li&amp;amp;gt;";
          }
          if(isset($menu['parents'][$itemId])) {
             $html .= "
             &amp;amp;lt;li&amp;amp;gt;&amp;amp;lt;label for='subfolder2'&amp;amp;gt;&amp;amp;
lt;a href='".$menu['items'][$itemId]['link']."'&amp;amp;gt;".$menu['items'][$itemId]['label']
."&amp;amp;lt;/a&amp;amp;gt;&amp;amp;lt;/label&amp;amp;gt; &amp;amp;lt;input type='checkbox' name='subfolder2'/
&amp;amp;
gt;";
             $html .= createTreeView($itemId, $menu);
             $html .= "&amp;amp;lt;/li&amp;amp;gt;";
          }
       }
       $html .= "&amp;amp;lt;/ol&amp;amp;gt;";
   }
   return $html;
}
?>


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


    background:rgb(247 141 70);
    padding: 10px;
    border-radius: 50%;
    color: white;

        font-size: 24px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    bottom: 4px;
}
.contas{
  margin-left: 0px!important;
  margin-right: 0px!important;
margin-top: 15px!important;
}
</style>
