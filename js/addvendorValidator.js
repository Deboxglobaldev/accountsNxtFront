$(document).ready(function(){
//======================Name======================
$('#namecheck').hide();
var user_err = true;
$('#name').keyup(function(){
	username_check();
});

function username_check(){
   var user_val = $('#name').val();
   if(user_val.length == ''){
	  $('#namecheck').show();
	  $('#namecheck').html("Please Fill The Branch Name *");
	  $('#namecheck').focus();
	  $('#namecheck').css("color","red");
	  user_err = false;
	  return false;
   }else{
	  $('#namecheck').hide();
   }
   if((user_val.length < 1 ) || (user_val.length > 20 )){
	  $('#namecheck').show();
	  $('#namecheck').html("name lenght must be between 1 and 20 *");
	  $('#namecheck').focus();
	  $('#namecheck').css("color","red");
	  user_err = false;
	  return false;
   }else{
	  $('#namecheck').hide();
   }
	var regex = /^[ A-Za-z0-9_@./#&+-]*$/;
	var isValid = regex.test(user_val);
	
	if (!isValid) {
	$('#namecheck').show();
	$('#namecheck').html("only allow alphanumeric and special character");
	$('#namecheck').focus();
	$('#namecheck').css("color","red");
	user_err = false;
	return false;
	}else{
	$('#namecheck').hide();
	}

}
//=============================Address One==================
$('#addressOnecheck').hide();
var addressone_err = true;
//for first name field
$('#AddressOne').keyup(function(){
	addressone_check();
});

function addressone_check(){
   var addressone_val = $('#AddressOne').val();
   if(addressone_val.length == ''){
	  $('#addressOnecheck').show();
	  $('#addressOnecheck').html("Please Fill The Address One *");
	  $('#addressOnecheck').focus();
	  $('#addressOnecheck').css("color","red");
	  addressone_err = false;
	  return false;
   }else{
	  $('#addressOnecheck').hide();
   }
   /*if((addressone_val.length < 3) || (addressone_val.length > 45)){
	  $('#addressOnecheck').show();
	  $('#addressOnecheck').html("address one lenght must be between 3 and 45 *");
	  $('#addressOnecheck').focus();
	  $('#addressOnecheck').css("color","red");
	  addressone_err = false;
	  return false;
   }else{
	  $('#addressOnecheck').hide();
   }*/
    var add1regex = /^[ A-Za-z0-9_@./#&+-]*$/;
	var add1regexisValid = add1regex.test(addressone_val);
	
	if (!add1regexisValid) {
	$('#addressOnecheck').show();
	$('#addressOnecheck').html("only allow alphanumeric and special character");
	$('#addressOnecheck').focus();
	$('#addressOnecheck').css("color","red");
	addressone_err = false;
	return false;
	}else{
	$('#addressOnecheck').hide();
	}

}
//=============================City==================
$('#citycheck').hide();
var city_err = true;
//for first name field
$('#City').keyup(function(){
	city_check();
});

function city_check(){
   var city_val = $('#City').val();
   if(city_val.length == ''){
	  $('#citycheck').show();
	  $('#citycheck').html("Please Fill The City Name *");
	  $('#citycheck').focus();
	  $('#citycheck').css("color","red");
	  city_err = false;
	  return false;
   }else{
	  $('#citycheck').hide();
   }
   if((city_val.length < 1) || (city_val.length > 15)){
	  $('#citycheck').show();
	  $('#citycheck').html("city lenght must be between 1 and 15 *");
	  $('#citycheck').focus();
	  $('#citycheck').css("color","red");
	  city_err = false;
	  return false;
   }else{
	  $('#citycheck').hide();
   }
    var cityregex = /^[A-Za-z]/;
	var cityValid = cityregex.test(city_val);
	
	if (!cityValid) {
	$('#citycheck').show();
	$('#citycheck').html("only allow alphabet");
	$('#citycheck').focus();
	$('#citycheck').css("color","red");
	city_err = false;
	return false;
	}else{
	$('#citycheck').hide();
	}

}
//=============================PINCODE==================
$('#pincheck').hide();
var pin_err = true;
$('#PinCode').keyup(function(){
	pincode_check();
});

function pincode_check(){
   var pincode_val = $('#PinCode').val();
   if(pincode_val.length == ''){
	  $('#pincheck').show();
	  $('#pincheck').html("Please Fill The Pin Code *");
	  $('#pincheck').focus();
	  $('#pincheck').css("color","red");
	  pin_err = false;
	  return false;
   }else{
	  $('#pincheck').hide();
   }
   if((pincode_val.length < 1) || (pincode_val.length > 6)){
	  $('#pincheck').show();
	  $('#pincheck').html("pin code lenght must be between 1 and 6 *");
	  $('#pincheck').focus();
	  $('#pincheck').css("color","red");
	  pin_err = false;
	  return false;
   }else{
	  $('#pincheck').hide();
   }
    var pinregex = /^[0-9]/;
	var pinValid = pinregex.test(pincode_val);
	
	if (!pinValid) {
	$('#pincheck').show();
	$('#pincheck').html("only allow numbers");
	$('#pincheck').focus();
	$('#pincheck').css("color","red");
	pin_err = false;
	return false;
	}else{
	$('#pincheck').hide();
	}

}
//=============================PRIMARY EMAIL==================
$('#primaryemailcheck').hide();
var primaryemail_err = true;
$('#PrimaryEmail').keyup(function(){
	primaryemail_check();
});

function primaryemail_check(){
  var primaryemail_val = $('#PrimaryEmail').val();
  if(primaryemail_val.length == ''){
	  $('#primaryemailcheck').show();
	  $('#primaryemailcheck').html("Please Fill The Primary Email *");
	  $('#primaryemailcheck').focus();
	  $('#primaryemailcheck').css("color","red");
	  primaryemail_err = false;
	  return false;
   }else{
	  $('#primaryemailcheck').hide();
   }
    var primaryemailregex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var pemailValid = primaryemailregex.test(primaryemail_val);
	
	if (!pemailValid) {
	$('#primaryemailcheck').show();
	$('#primaryemailcheck').html("only allow email address");
	$('#primaryemailcheck').focus();
	$('#primaryemailcheck').css("color","red");
	primaryemail_err = false;
	return false;
	}else{
	$('#primaryemailcheck').hide();
	}

}
//=============================CONTACT PERSON==================
$('#contactpersoncheck').hide();
var cperson_err = true;
$('#ContactPerson').keyup(function(){
	cperson_check();
});

function cperson_check(){
   var cperson_val = $('#ContactPerson').val();
   if(cperson_val.length == ''){
	  $('#contactpersoncheck').show();
	  $('#contactpersoncheck').html("Please Fill The Contact Person *");
	  $('#contactpersoncheck').focus();
	  $('#contactpersoncheck').css("color","red");
	  cperson_err = false;
	  return false;
   }else{
	  $('#contactpersoncheck').hide();
   }
    var cpersonregex = /^[A-Za-z]/;
	var cpersonValid = cpersonregex.test(cperson_val);
	
	if (!cpersonValid) {
	$('#contactpersoncheck').show();
	$('#contactpersoncheck').html("only allow characters");
	$('#contactpersoncheck').focus();
	$('#contactpersoncheck').css("color","red");
	cperson_err = false;
	return false;
	}else{
	$('#contactpersoncheck').hide();
	}

}

//=============================PAN NUMBER==================
$('#pannumbercheck').hide();
var pannumber_err = true;
$('#PanNumber').keyup(function(){
	pannumber_check();
});

function pannumber_check(){
   var pannumber_val = $('#PanNumber').val();
   if(pannumber_val.length == ''){
	  $('#pannumbercheck').show();
	  $('#pannumbercheck').html("Please Fill The Pan Number *");
	  $('#pannumbercheck').focus();
	  $('#pannumbercheck').css("color","red");
	  pannumber_err = false;
	  return false;
   }else{
	  $('#pannumbercheck').hide();
   }
   if((pannumber_val.length > 12)){
	  $('#pannumbercheck').show();
	  $('#pannumbercheck').html("pan number lenght must be 12 *");
	  $('#pannumbercheck').focus();
	  $('#pannumbercheck').css("color","red");
	  pannumber_err = false;
	  return false;
   }else{
	  $('#pannumbercheck').hide();
   }
    var pannumberregex = /^[0-9]/;
	var pnumberValid = pannumberregex.test(pannumber_val);
	
	if (!pnumberValid) {
	$('#pannumbercheck').show();
	$('#pannumbercheck').html("only allow numbers");
	$('#pannumbercheck').focus();
	$('#pannumbercheck').css("color","red");
	pannumber_err = false;
	return false;
	}else{
	$('#pannumbercheck').hide();
	}

}
//=============================TAN NUMBER==================
$('#tanumbercheck').hide();
var tannumber_err = true;
$('#TanNumber').keyup(function(){
	tannumber_check();
});

function tannumber_check(){
   var tannumber_val = $('#TanNumber').val();
   if(tannumber_val.length == ''){
	  $('#tannumbercheck').show();
	  $('#tannumbercheck').html("Please Fill The Tan Number *");
	  $('#tannumbercheck').focus();
	  $('#tannumbercheck').css("color","red");
	  tannumber_err = false;
	  return false;
   }else{
	  $('#tannumbercheck').hide();
   }
   if((tannumber_val.length > 12)){
	  $('#tannumbercheck').show();
	  $('#tannumbercheck').html("tan number lenght must be 12 *");
	  $('#tannumbercheck').focus();
	  $('#tannumbercheck').css("color","red");
	  tannumber_err = false;
	  return false;
   }else{
	  $('#tannumbercheck').hide();
   }
    var tannumberregex = /^[0-9]/;
	var tnumberValid = tannumberregex.test(tannumber_val);
	
	if (!tnumberValid) {
	$('#tannumbercheck').show();
	$('#tannumbercheck').html("only allow numbers");
	$('#tannumbercheck').focus();
	$('#tannumbercheck').css("color","red");
	tannumber_err = false;
	return false;
	}else{
	$('#tannumbercheck').hide();
	}

}
//=============================GST NUMBER==================
$('#gstcheck').hide();
var gstnumber_err = true;
$('#GstNumber').keyup(function(){
	gstnumber_check();
});

function gstnumber_check(){
   var gstnumber_val = $('#GstNumber').val();
   if(gstnumber_val.length == ''){
	  $('#gstcheck').show();
	  $('#gstcheck').html("Please Fill The Gst Number *");
	  $('#gstcheck').focus();
	  $('#gstcheck').css("color","red");
	  gstnumber_err = false;
	  return false;
   }else{
	  $('#gstcheck').hide();
   }
   if((gstnumber_val.length > 12)){
	  $('#gstcheck').show();
	  $('#gstcheck').html("gst number lenght must be 12 *");
	  $('#gstcheck').focus();
	  $('#gstcheck').css("color","red");
	  gstnumber_err = false;
	  return false;
   }else{
	  $('#gstcheck').hide();
   }
    var gstnumberregex = /^[0-9]/;
	var gstnumberValid = gstnumberregex.test(gstnumber_val);
	
	if (!gstnumberValid) {
	$('#gstcheck').show();
	$('#gstcheck').html("only allow numbers");
	$('#gstcheck').focus();
	$('#gstcheck').css("color","red");
	gstnumber_err = false;
	return false;
	}else{
	$('#gstcheck').hide();
	}

}
//=============================BRANCH CODE==================
$('#branchcodecheck').hide();
var branchcode_err = true;
$('#BranchCode').keyup(function(){
	branchcode_check();
});

function branchcode_check(){
   var branchcode_val = $('#BranchCode').val();
   if(branchcode_val.length == ''){
	  $('#branchcodecheck').show();
	  $('#branchcodecheck').html("Please Fill The Branch Code *");
	  $('#branchcodecheck').focus();
	  $('#branchcodecheck').css("color","red");
	  branchcode_err = false;
	  return false;
   }else{
	  $('#branchcodecheck').hide();
   }
   if((branchcode_val.length > 10)){
	  $('#branchcodecheck').show();
	  $('#branchcodecheck').html("branch code lenght must be 10 *");
	  $('#branchcodecheck').focus();
	  $('#branchcodecheck').css("color","red");
	  branchcode_err = false;
	  return false;
   }else{
	  $('#branchcodecheck').hide();
   }
    var branchcoderegex = /^[a-zA-Z0-9]/;
	var bcodeValid = branchcoderegex.test(branchcode_val);
	
	if (!bcodeValid) {
	$('#branchcodecheck').show();
	$('#branchcodecheck').html("only allow numbers and letters");
	$('#branchcodecheck').focus();
	$('#branchcodecheck').css("color","red");
	branchcode_err = false;
	return false;
	}else{
	$('#branchcodecheck').hide();
	}

}
//=============================FINANCIAL CODE==================
$('#financialcodecheck').hide();
var financialcode_err = true;
$('#FinancialCode').keyup(function(){
	financialcode_check();
});

function financialcode_check(){
   var financialcode_val = $('#FinancialCode').val();
   if(financialcode_val.length == ''){
	  $('#financialcodecheck').show();
	  $('#financialcodecheck').html("Please Fill The Financial Code *");
	  $('#financialcodecheck').focus();
	  $('#financialcodecheck').css("color","red");
	  financialcode_err = false;
	  return false;
   }else{
	  $('#financialcodecheck').hide();
   }
   if((financialcode_val.length > 10)){
	  $('#financialcodecheck').show();
	  $('#financialcodecheck').html("financial code lenght must be 10 *");
	  $('#financialcodecheck').focus();
	  $('#financialcodecheck').css("color","red");
	  financialcode_err = false;
	  return false;
   }else{
	  $('#financialcodecheck').hide();
   }
    var fcoderegex = /^[a-zA-Z0-9]/;
	var fcodeValid = fcoderegex.test(financialcode_val);
	
	if (!fcodeValid) {
	$('#financialcodecheck').show();
	$('#financialcodecheck').html("only allow numbers and letters");
	$('#financialcodecheck').focus();
	$('#financialcodecheck').css("color","red");
	financialcode_err = false;
	return false;
	}else{
	$('#financialcodecheck').hide();
	}

}
//=============================BANK NAME==================
$('#banknamecheck').hide();
var bankname_err = true;
$('#BankName').keyup(function(){
	bankname_check();
});

function bankname_check(){
   var bankname_val = $('#BankName').val();
   if(bankname_val.length == ''){
	  $('#banknamecheck').show();
	  $('#banknamecheck').html("Please Fill The Bank Name *");
	  $('#banknamecheck').focus();
	  $('#banknamecheck').css("color","red");
	  bankname_err = false;
	  return false;
   }else{
	  $('#banknamecheck').hide();
   }
   if((bankname_val.length > 15)){
	  $('#banknamecheck').show();
	  $('#banknamecheck').html("bank name lenght must be 15 *");
	  $('#banknamecheck').focus();
	  $('#banknamecheck').css("color","red");
	  bankname_err = false;
	  return false;
   }else{
	  $('#banknamecheck').hide();
   }
    var banknameregex = /^[a-zA-Z]/;
	var bnValid = banknameregex.test(bankname_val);
	
	if (!bnValid) {
	$('#banknamecheck').show();
	$('#banknamecheck').html("only allow characters");
	$('#banknamecheck').focus();
	$('#banknamecheck').css("color","red");
	bankname_err = false;
	return false;
	}else{
	$('#banknamecheck').hide();
	}

}
//=============================ACCOUNT NUMBER==================
$('#accountnumbercheck').hide();
var accountnumber_err = true;
$('#AccountNumber').keyup(function(){
	accountnumber_check();
});

function accountnumber_check(){
   var accountnumber_val = $('#AccountNumber').val();
   if(accountnumber_val.length == ''){
	  $('#accountnumbercheck').show();
	  $('#accountnumbercheck').html("Please Fill The Account Number *");
	  $('#accountnumbercheck').focus();
	  $('#accountnumbercheck').css("color","red");
	  accountnumber_err = false;
	  return false;
   }else{
	  $('#accountnumbercheck').hide();
   }
   if((accountnumber_val.length > 16)){
	  $('#accountnumbercheck').show();
	  $('#accountnumbercheck').html("account number lenght must be 16 *");
	  $('#accountnumbercheck').focus();
	  $('#accountnumbercheck').css("color","red");
	  accountnumber_err = false;
	  return false;
   }else{
	  $('#accountnumbercheck').hide();
   }
    var acregex = /^[0-9]/;
	var acValid = acregex.test(financialcode_val);
	
	if (!acValid) {
	$('#accountnumbercheck').show();
	$('#accountnumbercheck').html("only allow numbers");
	$('#accountnumbercheck').focus();
	$('#accountnumbercheck').css("color","red");
	accountnumber_err = false;
	return false;
	}else{
	$('#accountnumbercheck').hide();
	}

}
//=============================IFSC CODE==================
$('#ifsccodecheck').hide();
var ifsccode_err = true;
$('#IfscCode').keyup(function(){
	ifsccode_check();
});

function ifsccode_check(){
   var ifsccode_val = $('#IfscCode').val();
   if(ifsccode_val.length == ''){
	  $('#ifsccodecheck').show();
	  $('#ifsccodecheck').html("Please Fill The Ifsc Code *");
	  $('#ifsccodecheck').focus();
	  $('#ifsccodecheck').css("color","red");
	  ifsccode_err = false;
	  return false;
   }else{
	  $('#ifsccodecheck').hide();
   }
   if((ifsccode_val.length > 10)){
	  $('#ifsccodecheck').show();
	  $('#ifsccodecheck').html("ifsc code lenght must be 10 *");
	  $('#ifsccodecheck').focus();
	  $('#ifsccodecheck').css("color","red");
	  ifsccode_err = false;
	  return false;
   }else{
	  $('#ifsccodecheck').hide();
   }
    var icoderegex = /^[a-zA-Z0-9]/;
	var icodeValid = icoderegex.test(ifsccode_val);
	
	if (!icodeValid) {
	$('#ifsccodecheck').show();
	$('#ifsccodecheck').html("only allow numbers and letters");
	$('#ifsccodecheck').focus();
	$('#ifsccodecheck').css("color","red");
	ifsccode_err = false;
	return false;
	}else{
	$('#ifsccodecheck').hide();
	}

}
//=============================BRANCH NAME==================
$('#branchnamecheck').hide();
var branchname_err = true;
$('#BranchName').keyup(function(){
	branchname_check();
});

function branchname_check(){
   var branchname_val = $('#BranchName').val();
   if(branchname_val.length == ''){
	  $('#branchnamecheck').show();
	  $('#branchnamecheck').html("Please Fill The Branch Name *");
	  $('#branchnamecheck').focus();
	  $('#branchnamecheck').css("color","red");
	  branchname_err = false;
	  return false;
   }else{
	  $('#branchnamecheck').hide();
   }
   if((branchname_val.length < 1) || (branchname_val.length > 15)){
	  $('#branchnamecheck').show();
	  $('#branchnamecheck').html("branch name lenght must be between 1 and 15 *");
	  $('#branchnamecheck').focus();
	  $('#branchnamecheck').css("color","red");
	  branchname_err = false;
	  return false;
   }else{
	  $('#branchnamecheck').hide();
   }
    var bnameregex = /^[A-Za-z]/;
	var bnameValid = bnameregex.test(branchname_val);
	
	if (!bnameValid) {
	$('#branchnamecheck').show();
	$('#branchnamecheck').html("only allow characters");
	$('#branchnamecheck').focus();
	$('#branchnamecheck').css("color","red");
	branchname_err = false;
	return false;
	}else{
	$('#branchnamecheck').hide();
	}

}

$('#btnsubmit').click(function(){
        user_err = true;
		addressone_err = true;
		city_err = true;
		pin_err = true;
		primaryemail_err = true;
		cperson_err = true;
		pannumber_err = true;
		tannumber_err = true;
		gstnumber_err = true;
		branchcode_err = true;
		financialcode_err = true;
		bankname_err = true;
		ifsccode_err = true;
		accountnumber_err = true;
		branchname_err = true;
		
		username_check();
		addressone_check();
		city_check();
		pincode_check();
		primaryemail_check();
		cperson_check();
		pannumber_check();
		tannumber_check();
		gstnumber_check();
		branchcode_check();
		financialcode_check();
		bankname_check();
		ifsccode_check();
		accountnumber_check();
		branchname_check();
		
		if((user_err = true) && (addressone_err = true) && (city_err = true) && (pin_err = true) && (primaryemail_err = true) && (cperson_err = true) && (pannumber_err = true) && (tannumber_err = true) && (gstnumber_err = true) && (branchcode_err = true) && (financialcode_err = true) && (bankname_err = true) && (ifsccode_err = true) && (accountnumber_err = true) && (branchname_err = true)){
		return true;
		}else{
		return false;
		}
});

});