<nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar" style="background:white;"> <a
        class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        href="javascript:void(0);"><span class="feather-icon"><i data-feather="more-vertical"></i></span></a> <a
        id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span
            class="feather-icon"><i data-feather="menu"></i></span></a> <a class="navbar-brand" href="index.php">
                <img
            class="brand-img d-inline-block" style="width: 150px;" src="img/apparel.png" alt="brand" />

        </a>
        <?php
		if (strpos($_SERVER['REQUEST_URI'], "docmanagement.php") !== false) {
			echo 'Document Management';
		}elseif (strpos($_SERVER['REQUEST_URI'], "addBankVoucherEntry.php") !== false) {
			echo 'Bank Voucher';
		} elseif (strpos($_SERVER['REQUEST_URI'], "listBankVoucherEntry.php") !== false) {
			echo 'list Bank Voucher';
		} elseif (strpos($_SERVER['REQUEST_URI'], "listLedger.php") !== false) {
			echo 'Account Statement';
		} elseif (strpos($_SERVER['REQUEST_URI'], "commissionValidity.php") !== false) {
			echo 'Commission Master';
		} elseif (strpos($_SERVER['REQUEST_URI'], "commissionReport.php") !== false) {
			echo 'Commission Approval';
		} elseif (strpos($_SERVER['REQUEST_URI'], "oracleimportreport.php") !== false) {
			echo 'Oracle Export';
		} elseif (strpos($_SERVER['REQUEST_URI'], "voucherimport.php") !== false) {
			echo 'Voucher Import';
		} elseif (strpos($_SERVER['REQUEST_URI'], "commissionSummary.php") !== false) {
			echo 'Commission Summary';
		} elseif (strpos($_SERVER['REQUEST_URI'], "billSummary.php") !== false) {
			echo 'Bill Summary';
		} elseif (strpos($_SERVER['REQUEST_URI'], "ageingreport.php") !== false) {
			echo 'Ageing Report';
		} elseif (strpos($_SERVER['REQUEST_URI'], "collectionreport.php") !== false) {
			echo 'Collection Report';
		} elseif (strpos($_SERVER['REQUEST_URI'], "limitupload.php") !== false) {
			echo 'Upload Limit';
		} elseif (strpos($_SERVER['REQUEST_URI'], "trialbalance.php") !== false) {
			echo 'Trial Balance';
		} elseif (strpos($_SERVER['REQUEST_URI'], "schememaster.php") !== false) {
			echo 'Commission Charged Schedule';
		} elseif (strpos($_SERVER['REQUEST_URI'], "gstimportdata.php") !== false) {
			echo 'Import GST File';
		} elseif (strpos($_SERVER['REQUEST_URI'], "invoicegeneratepage.php") !== false) {
			echo 'Generate Invoice';
		} elseif (strpos($_SERVER['REQUEST_URI'], "pantancommision.php") !== false) {
			echo 'PAN/TAN Commission Report';
		} elseif (strpos($_SERVER['REQUEST_URI'], "invoicestatusreport.php") !== false) {
			echo 'Invoice Status Report';
		} elseif (strpos($_SERVER['REQUEST_URI'], "accountaudittrail.php") !== false) {
			echo 'Accounts Audit Trail';
		} elseif (strpos($_SERVER['REQUEST_URI'], "ChartOfAccount.php") !== false) {
			echo 'Chart of Account';
		} elseif (strpos($_SERVER['REQUEST_URI'], "addAccountName.php") !== false) {
			echo 'Add Accounts';
		} elseif (strpos($_SERVER['REQUEST_URI'], "addAccountGroup.php") !== false) {
			echo 'Add Account Group';
		} elseif (strpos($_SERVER['REQUEST_URI'], "addAccountSubGroup.php") !== false) {
			echo 'Add Account Sub Group';
		}
		?>
    </span>
    <style>
    .feather-icon svg {
        color: #71b91b;
    }

    #accnt li a span,
    #docm li a span {
        color: #060f7c;
    }

    #accnt,
    #docm {
        list-style: disc;
        padding-inline-start: 15px;
    }
    </style>
    <ul class="navbar-nav hk-navbar-content order-xl-2">
        <!-- <?php if (strtoupper($_SESSION['Type']) == "BRANCH") { ?>
  <li class="nav-item dropdown dropdown-authentication">
      <a href="index.php" class="btn btn-success" style="font-size: 13px;">Swith To Front Office</a>
	</li>
	<?php } ?> -->
        <li class="nav-item dropdown dropdown-authentication">
            <a class="nav-link dropdown-toggle no-caret" href="#"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar"> <img src="img/user1.png" alt="user" class="avatar-img rounded-circle">
                        </div>
                        <span class="badge badge-success badge-indicator"></span>
                    </div>
                    <div class="media-body"> <span style="color:green;">
                            <?php echo $_SESSION["UserName"]; ?>
                            <i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <a class="dropdown-item" href="#"><i
                        class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                <!-- <a class="dropdown-item" href="Settings.php"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a> -->
                <div class="dropdown-divider"></div>
                <div class="sub-dropdown-menu show-on-hover"> <a href="#"
                        class="dropdown-toggle dropdown-item no-caret"><i
                            class="zmdi zmdi-check text-success"></i>Online</a>
                    <div class="dropdown-menu open-left-side"> <a class="dropdown-item" href="#"><i
                                class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a> <a
                            class="dropdown-item" href="#"><i
                                class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a> <a
                            class="dropdown-item" href="#"><i
                                class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log
                        out</span></a>
            </div>
        </li>
    </ul>
</nav>

<!-- /Top Navbar -->
<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-light" style="background-color: #71b91b;background-image: linear-gradient(#71b91b,#3e8f30"> <a
        href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
                data-feather="x"></i></span></a>
    <div class="nicescroll-bar pr-2">
        <div class="navbar-nav-wrap" style="padding-top: 1.75rem;">
            <ul class="navbar-nav flex-column leftbar">

                <!-- <li class="nav-item">
                    <a class="nav-link" href="listBankVoucherEntry.php"><span class="nav-link-text seq">List Bank
                            Voucher</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listLedger.php"><span class="nav-link-text seq">Report
                            Statement</span></a>
                </li> -->


                <li class="nav-item pl-2">
                    <a class="nav-link" href="index.php"><span
                    class="nav-link-text seq">Dashboard</span></a>
                </li>
                <li onclick="toggledetails(1);" class="nav-item border-top"
                    style="cursor: pointer;color: white;font-size: 12px;padding: 4px 0px 4px 16px;"> Accounts
                    <ul style="display:none" id="docm">
                        <li class="nav-item">
                            <a class="nav-link" href="ChartOfAccount.php"><span class="nav-link-text text-white seq">Charts of
                                    Accounts</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listJournalEntry.php"><span class="nav-link-text text-white seq">Journal
                                    Voucher</span></a>
                        </li>
                        <li class="nav-item">
			                <a class="nav-link" href="addContraVoucher.php"><span class="nav-link-text text-white seq">Contra Voucher</span></a>
		                </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listBankReceipt.php"><span class="nav-link-text text-white seq">Bank
                                    Receipt</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listBankPayment.php"><span class="nav-link-text text-white seq">Bank
                                    Payment</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addDebitVoucher.php"><span class="nav-link-text text-white seq">Debit
                                    Note</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addCreditVoucher.php"><span class="nav-link-text text-white seq">Credit
                                    Note</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listBankVoucherEntry.php"><span class="nav-link-text text-white seq">Verify
                                    Voucher</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listLedger.php"><span class="nav-link-text text-white seq">Account
                                    Statement</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="trialbalance.php"><span class="nav-link-text text-white seq">Trial
                                Balance</span></a>
                        </li>
                    </ul>
                </li>
                <li onclick="toggledetails(2);" class="nav-item border-top"
                    style="cursor: pointer;color: white;font-size: 12px;padding: 4px 0px 4px 16px;"> Report
                    <ul style="display:none" id="accnt">
                        <li class="nav-item">
                            <a class="nav-link" href="invoicestatusreport.php"><span class="nav-link-text text-white seq">Invoice Status
                                    Report</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="invoicegeneratepage.php"><span class="nav-link-text text-white seq">Generate
                                    Invoice</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="accountaudittrail.php"><span class="nav-link-text text-white seq">Account Audit
                                    Trail</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div>
        </div>
    </div>
</nav>
<script type="text/javascript">
function toggledetails(id) {

    if (id == 1) {
        $('#docm').slideToggle(500);
    }
    if (id == 2) {
        $('#accnt').slideToggle(500);
    }
}
</script>