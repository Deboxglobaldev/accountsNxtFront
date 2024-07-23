
<nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar" style="background:white;"> <a tabindex="-1" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" href="javascript:void(0);"><span class="feather-icon"><i data-feather="more-vertical"></i></span></a> <a tabindex="-1" id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a> <a tabindex="-1" class="navbar-brand" href="index.php"> <img class="brand-img d-inline-block" style="width: 185px;" src="img/Religare-Logo.png" alt="brand" /></a>
<style>
.feather-icon svg{
	color:#71b91b;
}

</style>
<span style="color: blue; font-size: 15px; font-weight: 600;"> >> 
<?php 
if(strpos($_SERVER['REQUEST_URI'], "filesubmit.php") !== false){ echo "File Submit PAN"; }
elseif(strpos($_SERVER['REQUEST_URI'], "filesubmittan")!== false){ echo 'File Submit TAN'; }
elseif(strpos($_SERVER['REQUEST_URI'], "bulkuploaddata.php")!== false){ echo 'Bulk Upload PAN'; }
elseif(strpos($_SERVER['REQUEST_URI'], "bulkuploaddatatan")!== false){ echo 'Bulk Upload TAN'; } 
elseif(strpos($_SERVER['REQUEST_URI'], "index")!== false){ echo 'Dashboard'; } 
elseif(strpos($_SERVER['REQUEST_URI'], "missubmit")!== false){ echo 'MIS Upload'; } 
elseif(strpos($_SERVER['REQUEST_URI'], "listbranch")!== false){ echo 'Branch List'; } 

?>


</span>
  <ul class="navbar-nav hk-navbar-content order-xl-2" >
  	<li class="nav-item dropdown dropdown-authentication">
      <a href="docmanagement.php" tabindex="-1" class="btn btn-warning" style="font-size: 13px;" tabindex="-1" >Swith To Back Office</a>
	</li>
    <li class="nav-item dropdown dropdown-authentication"> <a class="nav-link dropdown-toggle no-caret" tabindex="-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <div class="media">
        <div class="media-img-wrap">
          <div class="avatar"> <img tabindex="-1" src="img/avatar12.jpg" alt="user" class="avatar-img rounded-circle" > </div>
          <span class="badge badge-success badge-indicator"></span> </div>
        <div class="media-body"> <span style="color:green;"><?php echo $_SESSION["UserName"]; ?><i class="zmdi zmdi-chevron-down"></i></span> </div>
      </div>
      </a>
      <div tabindex="-1" class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX"> <a tabindex="-1" class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a> <a tabindex="-1" class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-card"></i><span>My balance</span></a> <a tabindex="-1" class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-email"></i><span>Inbox</span></a> <a tabindex="-1" class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
        <div class="dropdown-divider"></div>
        <div class="sub-dropdown-menu show-on-hover"> <a tabindex="-1" href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
          <div class="dropdown-menu open-left-side"> <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a> <a class="dropdown-item" tabindex="-1" href="#"><i class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a> <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a> </div>
        </div>
        <div class="dropdown-divider"></div>
        <a tabindex="-1" class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a> </div>
    </li>
  </ul>
  <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Marketing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sales</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Help Desk</a>
                    </li>
                    <li class="nav-item">
                        <a href="calendar.html" class="nav-link">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Email</a>
                    </li>
                    <li class="nav-item">
                        <a href="file-manager.html" class="nav-link">File Manager</a>
                    </li>
                </ul>
            </div> -->  
</nav>
<!-- <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form> -->
<!-- /Top Navbar -->
<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-light" style="background-color: #71b91b;background-image: linear-gradient(#71b91b,#3e8f30"> <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
  <div class="nicescroll-bar">
    <div class="navbar-nav-wrap" style="padding-top: 1.75rem;">
      <ul class="navbar-nav flex-column leftbar">
        <?php 
                    if(strtoupper($_SESSION["Type"])=='BRANCH') { ?>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="index.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Dashboard</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="bulkuploaddata.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Bulk Upload PAN</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="bulkuploaddatatan.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Bulk Upload TAN</span> </a> </li>
        
        <?php }else if(strtoupper($_SESSION["Type"])=='NSD'){ ?>
		<li class="nav-item"> <a tabindex="-1" class="nav-link" href="index.php">
		 <span class="nav-link-text seq">Dashboard</span> </a> </li>
        
		<li class="nav-item"> <a tabindex="-1" class="nav-link" href="nsdlstagesubmit.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
							-->
          <span class="nav-link-text seq">Upload Batch File PAN</span> </a> </li>
        <li class="nav-item"> <a class="nav-link" href="nsdlaccecptedsubmit.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
							-->
          <span class="nav-link-text seq">Upload NSDL Accecpt File PAN</span> </a> </li>
        
		<li class="nav-item"> <a tabindex="-1" class="nav-link" href="nsdlpanallotsubmit.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
							-->
          <span class="nav-link-text seq">Upload NSDL Allotment File PAN</span> </a> </li>
		  
		  
		  
		  <li class="nav-item"> <a tabindex="-1" class="nav-link" href="nsdlstagesubmittan.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
							-->
          <span class="nav-link-text seq">Upload Batch File TAN</span> </a> </li>
		  
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="nsdlaccecptedsubmittan.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
							-->
          <span class="nav-link-text seq">Upload NSDL Accecpt File TAN</span> </a> </li>
       
	    <li class="nav-item"> <a tabindex="-1" class="nav-link" href="nsdlpanallotsubmittan.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
							-->
          <span class="nav-link-text seq">Upload NSDL Allotment File TAN</span> </a> </li>
        <?php }else{ ?>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="<?php if($_SESSION["Type"]=="BCP"){ echo "selecttoexport.php"; }else{ echo "index.php"; }?>">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Dashboard</span> </a> </li>
        <li class="nav-item"> <a class="nav-link" href="bulkuploaddata.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Bulk Upload PAN</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="bulkuploaddatatan.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Bulk Upload TAN</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="missubmit.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Mis Upload</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="listbranch.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Branch</span> </a> </li>
        <li class="nav-item"> <a  tabindex="-1"class="nav-link" href="listregion.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Region</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="listrejectionreason.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Rejection Reasons</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="listvendors.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Vendors</span> </a> </li>
        <!--<li class="nav-item">
                            <span class="nav-link-text seq">HO</span>
                            </a>
                        </li>-->
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="listrloffice.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Religare Office</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="dashboard1.html">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Reports</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="selecttoexport.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Export Batch File</span> </a> </li>
        <!--<li class="nav-item">
                            <a class="nav-link" href="batchuploadfile.php">
								<span class="nav-link-text seq">Re-Batching</span>
                            </a>
                        </li>-->
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="downloadpdf.php">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Download PDF</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="dashboard1.html">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Helpdesk</span> </a> </li>
        <li class="nav-item"> <a tabindex="-1" class="nav-link" href="dashboard1.html">
          <!--                                 <i class="ion ion-md-analytics"></i>
 -->
          <span class="nav-link-text seq">Training Module</span> </a> </li>
        <?php } ?>
        <!-- <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#auth_drp">
                                <i class="ion ion-md-contact"></i>
                                <span class="nav-link-text">Authentication</span>
                            </a>
                            <ul id="auth_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#signup_drp">
                                                    Sign Up
                                                </a>
                                            <ul id="signup_drp" class="nav flex-column collapse collapse-level-2">
                                                <li class="nav-item">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="signup.html">Cover</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="signup-simple.html">Simple</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#signin_drp">
                                                    Login
                                                </a>
                                            <ul id="signin_drp" class="nav flex-column collapse collapse-level-2">
                                                <li class="nav-item">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="login.html">Cover</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="login-simple.html">Simple</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#recover_drp">
                                                    Recover Password
                                                </a>
                                            <ul id="recover_drp" class="nav flex-column collapse collapse-level-2">
                                                <li class="nav-item">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="forgot-password.html">Forgot Password</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="reset-password.html">Reset Password</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="lock-screen.html">Lock Screen</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="404.html">Error 404</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="maintenance.html">Maintenance</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
      </ul>
    </div>
    <div> <img  class="img-fluid imgr" style="width: 65%;" src="img/Religare-Dashboard-Clover.png" alt="brand" /> </div>
  </div>
</nav>
