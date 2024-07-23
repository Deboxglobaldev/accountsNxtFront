function validateForm(){
var tannumber = $('#tannumber').val();
if(tannumber.length>76){
$('#tannumberError').show();
$('#tannumberError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#tannumberError').hide();
} 
var catofdeductor = $('#catofdeductor').val();
if (catofdeductor == "") {
$("#catofdeductorError").show();
$("#catofdeductorError").text('This is required');
return false;
}else{
$("#catofdeductorError").hide();
}

var NameOffice = $('#office_name').val();
if(NameOffice.length>76){
$('#officenameError').show();
$('#officenameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#officenameError').hide();
}

var orgname = $('#orgname').val();
if(orgname.length>76){
$('#orgnameError').show();
$('#orgnameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#orgnameError').hide();
}

var deptname = $('#deptname').val();
if(deptname.length>76){
$('#deptnameError').show();
$('#deptnameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#deptnameError').hide();
}

var ministryname = $('#ministr_yname').val();
if(ministryname.length>76){
$('#ministryname').show();
$('#ministryname').text('This should be maximum 75 digit.');
return false;
}
else{
$('#ministryname').hide();
}

var companyname = $('#companyname').val();
if(companyname.length>76){
$('#companynameError').show();
$('#companynameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#companynameError').hide();
}

var divisionname = $('#divisionname').val();
if(divisionname.length>76){
$('#divisionnameError').show();
$('#divisionnameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#divisionnameError').hide();
}

var LastName = $('#LastName').val();
if(LastName.length>26){
$('#LastNameError').show();
$('#LastNameError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#LastNameError').hide();
}

var FirstName = $('#FirstName').val();
if(FirstName.length>26){
$('#FirstNameError').show();
$('#FirstNameError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#FirstNameError').hide();
}	

var MiddleName = $('#MiddleName').val();
if(MiddleName.length>26){
$('#MiddleNameError').show();
$('#MiddleNameError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#MiddleNameError').hide();
}

var firmassocname = $('#firmassocname').val();
if(firmassocname.length>76){
$('#firmassocnameError').show();
$('#firmassocnameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#firmassocnameError').hide();
}	

var namelocbranch = $('#namelocbranch').val();
if(namelocbranch.length>26){
$('#namelocbranchError').show();
$('#namelocbranchError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#namelocbranchError').hide();
}	

var desigpersonforpayment = $('#desigpersonforpayment').val();
if(desigpersonforpayment.length>51){
$('#desigpersonforpaymentError').show();
$('#desigpersonforpaymentError').text('This should be maximum 50 digit.');
return false;
}
else{
$('#desigpersonforpaymentError').hide();
}	

var addrflatorblockno = $('#addrflatorblockno').val();
if(addrflatorblockno.length>26){
$('#addrflatorblocknoError').show();
$('#addrflatorblocknoError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#addrflatorblocknoError').hide();
}

var addrbuildingorvillage = $('#addrbuildingorvillage').val();
if(addrbuildingorvillage.length>26){
$('#addrbuildingorvillageError').show();
$('#addrbuildingorvillageError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#addrbuildingorvillageError').hide();
}	
var addrpostoffice = $('#addrpostoffice').val();	
if(addrpostoffice.length>26){
$('#addrpostofficeError').show();
$('#addrpostofficeError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#addrpostofficeError').hide();
}

var addrareasubdivision = $('#addrareasubdivision').val();
if(addrareasubdivision.length>26){
$('#addrareasubdivisionError').show();
$('#addrareasubdivisionError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#addrareasubdivisionError').hide();
}	

var addrtownorcountry = $('#addrtownorcountry').val();
if(addrtownorcountry.length>26){
$('#addrtownorcountryError').show();
$('#addrtownorcountryError').text('This should be maximum 25 digit.');
return false;
}
else{
$('#addrtownorcountryError').hide();
}	

var addrpincode = $('#addrpincode').val();
if(addrpincode.length>7){
$('#addrpincodeError').show();
$('#addrpincodeError').text('This should be maximum 6 digit.');
return false;
}
else{
$('#addrpincodeError').hide();
}

var StdCode = $('#StdCode').val();
if(StdCode.length>7){
$('#StdCodeError').show();
$('#StdCodeError').text('This should be maximum 6 digit.');
return false;
}
else{
$('#StdCodeError').hide();
}	

var MobileNumber = $('#MobileNumber').val();
if(MobileNumber.length>13){
$('#MobileNumberError').show();
$('#MobileNumberError').text('This should be maximum 12 digit.');
return false;
}
else{
$('#MobileNumberError').hide();
}	

var email1 = $('#email1').val();
if(email1!=''){
if(!email1.match(/^[a-zA-Z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-zA-Z][a-zA-Z-0-9]*\.[a-zA-Z]+(\.[a-zA-Z]+)?$/)){
$('#email1Error').show();
$('#email1Error').text('Please Enter Valid Email');
return false;
}
else{
$('#email1Error').hide();
}	
}else{
$('#email1Error').hide();
}

var email2 = $('#email2').val();
if(email2!=''){
if(!email2.match(/^[a-zA-Z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-zA-Z][a-zA-Z-0-9]*\.[a-zA-Z]+(\.[a-zA-Z]+)?$/)){
$('#email2Error').show();
$('#email2Error').text('Please Enter Valid Email');
return false;
}
else{
$('#email2Error').hide();
}
}else{
$('#email2Error').hide();	
}

var panapplicant = $('#panapplicant').val();
if(panapplicant.length>11){
$('#panapplicantError').show();
$('#panapplicantError').text('This should be maximum 10 digit.');
return false;
}
else{
$('#panapplicantError').hide();
}	

/*var oldtandeduction = $('#oldtandeduction').val();
if(oldtandeduction.length>17){
$('#oldtandeductionError').show();
$('#oldtandeductionError').text('This should be maximum 16 digit.');
return false;
}
else{
$('#oldtandeductionError').hide();
}	

var oldtancollection = $('#oldtancollection').val();
if(oldtancollection.length>17){
$('#oldtancollectionrError').show();
$('#oldtancollectionrError').text('This should be maximum 16 digit.');
return false;
}
else{
$('#oldtancollectionrError').hide();
}	
*/
var applicationdate = $('#applicationdate').val();
if(applicationdate==''){
$('#applicationdateError').show();
$('#applicationdateError').text('This is required field');
return false;
}else{
$('#applicationdateError').hide();
}	

var VerifierName = $('#verifiername').val();
if(VerifierName==''){
$('#VerifierNameError').show();
$('#VerifierNameError').text('This is required field');
return false;
}else{
$('#VerifierNameError').hide();
}
if(VerifierName.length>76){
$('#VerifierNameError').show();
$('#VerifierNameError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#VerifierNameError').hide();
}	

var CVerifier = $('#verifiercapacitycode').val();	
if(CVerifier==''){
$('#CVerifierError').show();
$('#CVerifierError').text('This is required field');
return false;
}else{
$('#CVerifierError').hide}
if(CVerifier.length>75){
$('#CVerifierError').show();
$('#CVerifierError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#CVerifierError').hide();
}

var VerifierPlace = $('#verificationplace').val();
if(VerifierPlace==''){
$('#VerifierPlaceError').show();
$('#VerifierPlaceError').text('This is required field');
return false;
}else{
$('#VerifierPlaceError').hide();
}
if(VerifierPlace.length>76){
$('#VerifierPlaceError').show();
$('#VerifierPlaceError').text('This should be maximum 75 digit.');
return false;
}
else{
$('#VerifierPlaceError').hide();
}	
}
   