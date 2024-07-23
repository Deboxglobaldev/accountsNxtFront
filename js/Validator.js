$(document).ready(function(){
//======================USER ID======================
$('#useridcheck').hide();
var userid_err = true;
$('#UserId').keyup(function(){
	userid_check();
});

function userid_check(){
   var userid_val = $('#UserId').val();
   if(userid_val.length == ''){
	  $('#useridcheck').show();
	  $('#useridcheck').html("Please Fill The User Id *");
	  $('#useridcheck').focus();
	  $('#useridcheck').css("color","red");
	  userid_err = false;
	  return false;
   }else{
	  $('#useridcheck').hide();
   }
}
//=============================EMAIL==================
$('#useremailcheck').hide();
var useremail_err = true;
$('#Email').keyup(function(){
	useremail_check();
});

function useremail_check(){
  var useremail_val = $('#Email').val();
  if(useremail_val.length == ''){
	  $('#useremailcheck').show();
	  $('#useremailcheck').html("Please Fill The Email *");
	  $('#useremailcheck').focus();
	  $('#useremailcheck').css("color","red");
	  useremail_err = false;
	  return false;
   }else{
	  $('#useremailcheck').hide();
   }
    var useremailregex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var uemailValid = useremailregex.test(useremail_val);
	
	if (!uemailValid) {
	$('#useremailcheck').show();
	$('#useremailcheck').html("only allow email address");
	$('#useremailcheck').focus();
	$('#useremailcheck').css("color","red");
	useremail_err = false;
	return false;
	}else{
	$('#useremailcheck').hide();
	}

}
//=============================FIRST NAME==================
$('#firstnamecheck').hide();
var firstname_err = true;
$('#FirstName').keyup(function(){
	firstname_check();
});

function firstname_check(){
   var firstname_val = $('#FirstName').val();
   if(firstname_val.length == ''){
	  $('#firstnamecheck').show();
	  $('#firstnamecheck').html("Please Fill The First Name *");
	  $('#firstnamecheck').focus();
	  $('#firstnamecheck').css("color","red");
	  firstname_err = false;
	  return false;
   }else{
	  $('#firstnamecheck').hide();
   }
    var firstnameregex = /^[a-zA-Z]/;
	var fnValid = firstnameregex.test(firstname_val);
	
	if (!fnValid) {
	$('#firstnamecheck').show();
	$('#firstnamecheck').html("only allow characters");
	$('#firstnamecheck').focus();
	$('#firstnamecheck').css("color","red");
	firstname_err = false;
	return false;
	}else{
	$('#firstnamecheck').hide();
	}

}
//=============================PASSWORD==================
$('#passwordcheck').hide();
var pass_err = true;
$('#InitialPassword').keyup(function(){
	password_check();
});

function password_check(){
   var password_val = $('#InitialPassword').val();
   if(password_val.length == ''){
	  $('#passwordcheck').show();
	  $('#passwordcheck').html("Please Fill The Password *");
	  $('#passwordcheck').focus();
	  $('#passwordcheck').css("color","red");
	  pass_err = false;
	  return false;
   }else{
	  $('#passwordcheck').hide();
   }
    var paswordregex = /^[ A-Za-z0-9_@./#&+-]*$/;
	var passValid = paswordregex.test(password_val);
	
	if (!passValid){
	$('#passwordcheck').show();
	$('#passwordcheck').html("only allow alphanumeric and special character");
	$('#passwordcheck').focus();
	$('#passwordcheck').css("color","red");
	pass_err = false;
	return false;
	}else{
	$('#passwordcheck').hide();
	}

}
//=============================CONFIRM PASSWORD==================
$('#cpasswordcheck').hide();
var cpass_err = true;
$('#RetypePassword').keyup(function(){
	cpassword_check();
});

function cpassword_check(){
    var cpassword_val = $('#RetypePassword').val();
	var password_val = $('#InitialPassword').val();
	if(password_val != cpassword_val)
	{
	  $('#cpasswordcheck').show();
	  $('#cpasswordcheck').html("Password are not matching *");
	  $('#cpasswordcheck').focus();
	  $('#cpasswordcheck').css("color","red");
	  cpass_err = false;
	  return false;
	}else{
	  $('#cpasswordcheck').hide();
    }
}

$('#usersubmit').click(function(){
        userid_err = true;
		useremail_err = true;
		firstname_err = true;
		pass_err = true;
		cpass_err = true;
	
		
		userid_check();
		useremail_check();
		firstname_check();
		password_check();
		cpassword_check();

		
		if((userid_err = true) && (useremail_err = true) && (firstname_err = true) && (pass_err = true) && (cpass_err = true)){
		return true;
		}else{
		return false;
		}
});

});