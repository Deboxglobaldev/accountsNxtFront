function rflotdoor(commuaddress,ApplicationStatus,regidenceaddress,class_name){
if(commuaddress=='R'){
var addresslength = $('.class_name').length;
if(addresslength<=1){
alert('At least two should be filled up');
return false;
}
else{
return true;
}
}
if(ApplicationStatus=='P' || ApplicationStatus=='H' || ApplicationStatus=='A'
|| ApplicationStatus=='B' || ApplicationStatus=='J'){
if(regidenceaddress==''){
alert('Residential address should be kept blank.');
return false;
}
else{
return true;
}
}
if(ApplicationStatus=='P' || ApplicationStatus=='H' || ApplicationStatus=='A'
|| ApplicationStatus=='B' || ApplicationStatus=='J'){
if(regidenceaddress!=''){
alert('residential address is mandatory');
return false;
}
else{
return true;
}
}
function address_not_repeated(class_name){
$('.class_name').change(function() {
var $current = $(this);
$('.class_name').each(function() {
if ($(this).val() == $current.val() && $(this).attr('id') != $current.attr('id'))
{
alert('should not be repeated in Address');
return false;
}
else{
return true;
}
});
});
}
function checkapplicationcitycode(commucaationflag,ApplicationStatus,OStateUnion,OZip,cityname){
if(commucaationflag==''){
alert ('This is required field');
return false;
}else{
return true;
}
if(ApplicationStatus=='P' || ApplicationStatus=='H' || ApplicationStatus=='A'
|| ApplicationStatus=='B' || ApplicationStatus=='J'){
alert ('This is required field');
return false;
}
else{
return true;
}
if(OStateUnion!='99' && OZip!='999999'){
alert('This field should be (City Name~Country Code~Zip Code)');
return false;

}else{
return true;
}
if(cityname.length >15 && cityname!='') {
alert ('Maximum length for city name is 14 characters.');
return false;
}else{
return true;
}
}
function country_code(countrycode){
if(countrycode.length < 2 || countrycode.length > 2){
alert('Country code should be a valid 2 characters code.');
return false;
}
else{
return true;
}
if(countrycode==''){
alert('This is required field.');
return false;
}
return true;
}
function zipcodeaccept(name)
{
var regEx = /^[0-9a-zA-Z]+$/;
if(name.match(regEx) && name.length<=7)
{
return true;
}
else
{
return "Please enter letters and numbers only.";
return false;
}

} 
function statecodezipcodemedatory(StateUnion,Zip,Zipcodeaccept){
if(StateUnion=='99' && Zip=='999999'){
if(Zipcodeaccept==''){
alert('This is required field.');
return false;
}
else{
return true;
}
}
else if(StateUnion=='' && Zip==''){
if(Zipcodeaccept==''){
return true;
}
else false;
}
}
function Ostate_union_terriototy(commucaationflag,commuaddress,OStatecode,IndianAddress,foreignaddress,defenceemp,officecode,officepincode){
if(commucaationflag=='O'){
if(commuaddress==''){
alert('This is required field.');
return false;
}
else
{
return true;
}
}
if(OStatecode==''){
alert('This is required field.');
return false;
}else{
return true;
}
if(IndianAddress=='India'){
if(OStatecode >1 && OStatecode <37){
return true;
}
else{
alert('Office State code should be between 1 to 36.');
return false;
}
}
else if(IndianAddress !='India'){
if(foreignaddress!='99'){
alert('Office state code value should be 99.');
return false;
}
else{
return false;
}
}
if(defenceemp=='Army' || defenceemp=='Navy' || defenceemp=='Airforce'){
if(OStatecode ==''){
if(officecode=='99'){
return true
}
else{
alert('Office state code value should be 99.');
return false;
}
}
else{
return true;
} 

}
else{
return false;
}
if(officepincode=='888888' || officepincode=='999999'){
if(OStatecode=='99'){
return true;
}
else{
alert('Office state code should be 99');
return false;
}
}
else{
alert('This is required field');
return false;
}
}
function OpinCode(officepincode,commuaddress,commucaationflag,foreignaddress){
if(officepincode==0 || officepincode<0){
alert('Pin code can not be less than or equal to zero.');
return false;
}
else{
return true;
}
if(commucaationflag=='O'){
if(commuaddress!=''){
if(officepincode!=''){
alert('Office Address PIN Code should be mentioned.'); 
return false;
}
else{
return true;
}
}
else{
return false;
}
}
else{
return false;
}
if(!officepincode.match(/^[1-9][0-9]/)){
alert('It should not start with zero.');
return false;

}
else{
return true;
}
if(foreignaddress==''){
alert('PIN Code for foreign address should be 999999.');
return false;
}
else{
return true;
}
if(officepincode.length<7 && officepincode.length>5){
return true;
}
else{
alert('The length of PIN code should be exactly 6.');
return false;
}
}
/////form2 validation/////
function AddressCommunication(ApplicationStatus,commucaationflag){
if(ApplicationStatus=='C' || ApplicationStatus=='F' || ApplicationStatus == 'E' || ApplicationStatus == 'T' || ApplicationStatus=='L' || ApplicationStatus=='G'){
if(commucaationflag=='O'){
return true;
}
else{
alert('This is required field');
return false;
}
}
return false;
}
function AreaStateCode(telephone,StdCode){
if(telephone!=''){
if(StdCode==''){
alert(This is required field); 
return false;
}
else{
return true;
}
}
else{
return false;
}
if(StdCode!=''){
if(telephone==''){
alert(This is required field); 
return false;
}
else{
return true;
}
}
else{
return true;
}
}
function TelephoneMobile(telephone,MobileNumber,Email){
if(Email!=''){
if(telephone=='' || MobileNumber==''){
alert('Telephone/Mobile number is mandatory.');
return false;
}
else{
return true;
}
}
else{
return false;
}
if(!MobileNumber.match(/^[1-9][0-9]/)){
alert('Mobile number can not start with zero.');
return false;
}
else{
return true;
}
if(!Email.match(/^[a-z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/)){
alert('Please Enter a valid E-mail Address');
return false;
}
else{
return true;
}
if(Email=''){
if(telephone==''){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
return false;
}
}
function CheckSex(ApplicationStatus,OtherApplication,ApplicationSex,ApplicationTitle1,ApplicationTitle2,ApplicationTitle3,ApplicationTitle4){
if(ApplicationStatus=='P'){
if(OtherApplication==''){
return true;
}
else{
return false;
}
}
else{
return false;
}
if(ApplicationTitle1=='1'){
if(ApplicationSex=='M'){
return true;
}
else{
alert('Application Sex should be Male.');
return false;
}
}
else{
return false;
}
if(ApplicationTitle1=='2' || ApplicationTitle1=='3'){
if(ApplicationSex=='F'){
return true;
}
else{
alert('Application Sex should be Female.');
return false;
}
}
else{
return false;
}
if(ApplicationTitle1=='2' || ApplicationTitle1=='3'){
if(ApplicationSex=='F'){
return true;
}
else{
alert('Application Sex should be Female.');
return false;
}
}
else{
return false;
}
if(ApplicationTitle1=='1' || ApplicationTitle1=='2' || ApplicationTitle1=='3'){
if(ApplicationSex=='F'){
return true;
}
else{
alert('Application Sex should be Transgender.');
return false;
}
}
else{
return false;
}
if(ApplicationTitle1=='4'){
if(ApplicationSex==''){
return true;
}
else{
return false;
}
}
else{
return false;
}
}
function Checkdob(Dob,PanCard,AncestralHUF,ApplicationStatus){
if(!Dob.match(/(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/)){
alert('Date of Birth should be in the following format: DDMMYYYY.');
return false;
}
else{
return true;
}
if(PanCard!=''){
var oldyear = new Date().getFullYear()+125;
if(oldyear>126){
return true;
}
else{
alert('should not be greater than 125 years earlier to current date.');
return false;
}
}
else{
return false;
}
if(AncestralHUF!=''){
if(AncestralHUF=='01010001'){
return true;
}
}
else{
return true;
}
if(ApplicationStatus=='P'){
var oldage = new Date().getFullYear()+75;
if(oldyear>126){
return true;
}
else{
alert('error_file');
return false;
}
}
}
function RegistrationNumber(RegistrationNumber,CompanyNameC){
if(CompanyNameC!=''){
if(RegistrationNumber==''){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
function whetherCitizenIndia(CitizenIndia){
if(CitizenIndia=='Yes' || CitizenIndia=='No'){
alert('From 49A.');
return true;
}
else if(CitizenIndia=='I'){
alert('Form 49A.');
true;
}
else if(CitizenIndia=='O'){
alert('Form 49AA.');
true;
}
else{
return false;
}

}
function IncomeSalaryEmployee(ApplicationStatus,EmpSalary,Employee,Bussiness,Another,class_name){
if(ApplicationStatus!='P'){
if(EmpSalary==''){
return true;
}
else{
alert('Salary should be left blank.');
return false;
}
}
if(Employee!='' && Bussiness!='' && Another!=''){
var alength = $('.class_name').length;
if(alength=='1'){
return true;
}
else{
alert('Salary should be Only One.');
return false;
}
}
else{
return false;
}
}
function BusinessProfessionalCode(business,busninesscode,busninesscode){
if(business=='Y'){
if(busninesscode=='' || busninesscode==''){
alert('This is required field');
return false;
}	
else{
return true;
}

}
else{
return true;
}
}
function AnotherSourceIncome(ApplicationStatus,OrganizationName,BusinessName,BusinessCode,EmpIncome,BusinessIncome,AnotherIncome){
if(EmpIncome=='' || BusinessIncome=='' && AnotherIncome==''){
if(ApplicationStatus==''){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
return false;
}
if(AnotherIncome=='H'){
if(EmpIncome=='' && OrganizationName=='' && BusinessName=='' && BusinessCode==''){
return true;
}
else{
alert('D48 to D51 should be blank.');
return false;
}
}
else{
return false;
}
}
function RepresentativeTitle(RepresentativeTitle,LastName,ApplicationStatus,DOB){
if(RepresentativeTitle!=''){
if(LastName==''){
alert('Last name can not be null.'); 
return false;
}
else{
return true;
}
}
else{
return true;
}
if(ApplicationStatus=='P'){
if(DOB<18){
if(RepresentativeTitle==''){
alert("Representative Assessee's Title  is mandatory.");
return false
}
else{
return true;
}
}
else{
return false;
}
}
else{
return true;
}
}
//////D54////////

/////for form 49A///
function form1(){
if(OrganizationName=='Limited' || OrganizationName=='Private Limited'){
return true;
}
else{
return false;
}
}
function form2(){
if(OrganizationName=='Limited' || OrganizationName=='Limited' || OrganizationName=='Pvt Ltd' || OrganizationName=='Private Ltd' || OrganizationName=='P Ltd' || OrganizationName=='P. Ltd.' || OrganizationName=='P. Ltd'){
return true;
}
else{
return false;
}
}
function htmlErro(RepresentativeTitle,OrganizationName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(OrganizationName=='Limited' || OrganizationName=='Limited'){
alert('Generat upload file.');
return true;
}
else{
return false;
}
}
else{
return false;
}
}
function RepresentativeLastName(RepresentativeTitle,RepresentativeLastName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(RepresentativeTitle.length=='1' || RepresentativeTitle.length=='2'){
if(RepresentativeLastName==''){
return true;
}
else{
return false;
}
}

else{
return true;
}
}
else{
return true;
}
if(RepresentativeLastName.length<76){
return true;
}
else{
alert('Last Name will be Maximum 75 characters.');
return false;
}
}
function checklaststcharacter(RepresentativeTitle,LastName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(!LastName.match(/[a-z]/i)){
alert('Last Characters must be alphabet.'); 
return false;
}
else{
return false;
}
}
else{
return true;
}
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3' || RepresentativeTitle=='4'){
if(!LastName.match(/^[a-zA-Z'.,]+({0,1}[a-zA-Z-, ])*$/)){
alert('Last Characters must be alphabet.');
return false;
}
else{
return false;
}
}
////Star D55/////
function form1(){
if(OrganizationName=='Limited' || OrganizationName=='Private Limited'){
return true;
}
else{
return false;
}
}
function form2(){
if(OrganizationName=='Limited' || OrganizationName=='Limited' || OrganizationName=='Pvt Ltd' || OrganizationName=='Private Ltd' || OrganizationName=='P Ltd' || OrganizationName=='P. Ltd.' || OrganizationName=='P. Ltd'){
return true;
}
else{
return false;
}
}
function htmlErro(RepresentativeTitle,OrganizationName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(OrganizationName=='Limited' || OrganizationName=='Limited'){
alert('Generat upload file.');
return true;
}
else{
return false;
}
}
else{
return false;
}
}
function RepresentativeFirstName(RepresentativeTitle,RepresentativeFirstName,MiddleName){
if(MiddleName!=''){
if(RepresentativeFirstName==''){
alert('Please enter first Name is compulsory.');
return false;
}
else{
return true;
}
}
else{
return true;
}
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(RepresentativeTitle.length=='1' || RepresentativeTitle.length=='2'){
if(RepresentativeLastName==''){
return true;
}
else{
return false;
}
}

else{
return true;
}
}
else{
return true;
}

}
function checklaststcharacter(RepresentativeTitle,FirstName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(!FirstName.match(/[a-z]/i)){
alert('Last Characters must be alphabet.'); 
return false;
}
else{
return false;
}
}
else{
return true;
}
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3' || RepresentativeTitle=='4'){
if(!FirstName.match(/^[a-zA-Z'.,]+({0,1}[a-zA-Z-, ])*$/)){
alert('First name Characters must be alphabet.');
return false;
}
else{
return false;
}
}
///D56////
function form1(){
if(OrganizationName=='Limited' || OrganizationName=='Private Limited'){
return true;
}
else{
return false;
}
}
function form2(){
if(OrganizationName=='Limited' || OrganizationName=='Limited' || OrganizationName=='Pvt Ltd' || OrganizationName=='Private Ltd' || OrganizationName=='P Ltd' || OrganizationName=='P. Ltd.' || OrganizationName=='P. Ltd'){
return true;
}
else{
return false;
}
}
function htmlErro(RepresentativeTitle,OrganizationName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(OrganizationName=='Limited' || OrganizationName=='Limited'){
alert('Generat upload file.');
return true;
}
else{
return false;
}
}
else{
return false;
}
}

function checkmiddlecharacter(RepresentativeTitle,MiddletName){
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3'){
if(!LastName.match(/[a-z]/i)){
alert('Middle Characters must be alphabet.'); 
return false;
}
else{
return false;
}
}
else{
return true;
}
if(RepresentativeTitle=='1' || RepresentativeTitle=='2' || RepresentativeTitle=='3' || RepresentativeTitle=='4'){
if(!MiddletName.match(/^[a-zA-Z'.,]+({0,1}[a-zA-Z-, ])*$/)){
alert('Middle Characters must be alphabet.');
return false;
}
else{
return false;
}
if(MiddletName.length>1){
return true;
}
else{
alert('Middle name more than one characters.');
return false;
}
}
//////D61/////
function RepresentativeAddressTownCityDistrict(TownCityDistrict){
if(TownCityDistrict!=''){
alert('This is required field');
return false;
}
else{
return true;
}
}
/////D67////
function RepresentativeStateCode(RepresentativeTitle,RepresentativeLastName,StdCode,StdMasterCode,Defenceemp,DefenceAddress,RepresentativePinCode,Mirror,RPinCode){
if(RepresentativeLastName!='' || RepresentativeTitle!=''){
if(StdCode==''){
alert();
return false;
}
else{
return true;
}
}
else{
return true;
}
if(StdMasterCode==StdMasterCode){
return Valid state code.
}
else{
return Invalide state code.
}
if(Defenceemp=='Army' || Defenceemp=='Navy' || Defenceemp=='Air' || Defenceemp==''){
if(DefenceAddress==''){
alert('This is required field.');
return false;
}
return true;
}
else{
return false;
}
if(RepresentativePinCode=='888888' || RepresentativePinCode=='999999'){
if(StdCode==''){
alert('State code should be 99 .'); 
return false;
}
else{
return true;
}
}
if(Mirror=='M' && RPinCode=='999999'){
if(Dob==''){
alert('only if date of biirth is minor.');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
//////D63////
function RepresentativePinCode(pincode,RepresentativeAddTitle,RepresentativeAddLastName,foreignaddress,StdCode,Defenceemp,DefenceAddress){
if(pincode==0 || pincode<0){
alert('Pin code can not be less than or equal to zero.');
return false;
}
else{
return true;
}
if(!pincode.match(/^[1-9][0-9]/)){
alert('It should not start with zero.');
return false;

}
else{
return true;
}

if(StdCode=='99'){
if(pincode=='888888' || pincode=='999999'){
return true;
}
else{
alert('pincode should be 888888 .');
return false;
}
else{
return false;
}

if(foreignaddress==''){
alert('PIN Code for foreign address should be 999999.');
return false;
}
else{
return true;
}
if(pincode.length<7 && pincode.length>5){
return true;
}
else{
alert('The length of PIN code should be exactly 6.');
return false;
}
if(Defenceemp=='Army' || Defenceemp=='Navy' || Defenceemp=='Air' || Defenceemp==''){
if(DefenceAddress==''){
alert('This is required field.');
return false;
}
return true;
}
else{
return false;
}
}
////D64////
function ProofofIdentity(IdentityCode){
if(IdentityCode<4 && IdentityCode>2){
return true;
}
else{
alert('Identiyt code should be three digit.');
return true;
}
}
//////D65////
function ProofofAddress(AddressCode){
if(AddressCode<4 && AddressCode>2){
return true;
}
else{
alert('Address code should be three digit.');
return true;
}
}
//////D66//
function Dateofacknowledgement(Dob,Acknowledgementdate,varificationdate){
if(!Dob.match(/(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/)){
alert('Date of Birth should be in the following format: DDMMYYYY.');
return false;
}
else{
return true;
}
if(Acknowledgementdate<=varificationdate){
return true;
}
else{
alert('Acknowledgement Date and varification date not match.');
return false
}
}
/////67///
function DateofVerification(Dob,Acknowledgementdate,varificationdate,filecreationdate){
if(!Dob.match(/(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/)){
alert('Date of Birth should be in the following format: DDMMYYYY.');
return false;
}
else{
return true;
}
if(Acknowledgementdate<=varificationdate){
return true;
}
else{
alert('Acknowledgement Date and varification date not match.');
return false
}
if(Dob<=varificationdate){
return true;
}
else{
alert('Date of verification should be greater than or equal to Date of birth/incorporation (D45).');
return false
}
if(varificationdate<=filecreationdate){
return true;
}
else{
alert('Date of verification should be less than or equal to Date of File creation (H5).');
return false
}
}
/////D68///
function Acknowledgementnumber(Acknowledgementnumber,agentID){
var thirteendigit = new Date().getTime();
var Acknowledgementnum = agentID.thirteendigit;
if(agentID.length<=2){
if(Acknowledgementnumber.length<='15'){
return true;
}
else{
alert('It should be a valid 15 digit  Acknowledgement number.');
return false;
}
}
else{
return false;
}
}
function PhotoPresenceFlag(ApplicationStatus,photoflag){
if(ApplicationStatus=='P'){
if(photoflag=="Y"){
return true;
}
else if(photoflag=='N'){
return true;
}
else{
return false;
}
}
}
function SignaturePresenceFlag(ApplicationStatus,Signatureflag){
if(ApplicationStatus=='P'){
if(Signatureflag=="Y"){
return true;
}
else if(Signatureflag=='N'){
return true;
}
else{
return false;
}
}
}
function Whethertheapplication(ApplicationStatus,applicationage,dob,verificationdob,Representativeasses){
var differdob= dob-verificationdob;
if(ApplicationStatus=='M'){
if(differdob>18){
return true;
}
else{
return false;
}
}
else{
return false;
}
if(ApplicationStatus=='M' || ApplicationStatus=='D'){
if(Representativeasses==){
alert('This is required field');
return false;
}
else{
return true;
}
}
if(ApplicationStatus=='M' || ApplicationStatus=='D'){
return true;
}
else{
alert('This is required field');
return false;
}
}
///////D72////
function DiscrepancyLevel(Discrepancy,ApplicationStatus,flag){
if(Discrepancy=='Y' || Discrepancy=='N'){
return true;
}
else{
alert('field can accept only Y or N as values.');
return false;
}
if(Discrepancy=='TIN-FC'){
if(flag==''){
alert('flag should be Y.');
return false;
}
else{
return true;
}
}
else{
return true;
}

}
////D73///
function DateofDiscrepancyResolution(DiscrepancyDate,AcknowledgmentDate,filecreationdate){
if(!DiscrepancyDate.match(/(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/)){
alert('Date should be in the following format: DDMMYYYY.');
return false;
}
else{
return true;
}
if(DiscrepancyDate>=AcknowledgmentDate){
return true;
}
else{
alert('Acknowledgement Date and varification date not match.');
return false
}
if(DiscrepancyDate<=filecreationdate){
return true;
}
else{
alert('Discrepancy Date and varification date not match.');
return false
}
if(Discrepancy=='TIN-FC'){
if(flag==''){
alert('flag should be Y.');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
/////D74////
function Aadharcardnumber(ApplicationStatus,Aadharnumber,CitizenIndia,proofofidentity,proofofaddress,PODB,PanCard,State,senoirAge){
if(ApplicationStatus=='P'){
if(Aadharnumber==''){
alert('Aadhar card number not blank.');
return false;
}
else{
return true;
}
}
else{
return true;
}
if(CitizenIndia=='O'){
if(Aadharnumber==''){
return true;
}
else{
alert('AADHAAR number field should be blank.');
return false;
}
}
if(!Aadharnumber.match(/^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/)){
alert('It should not start with zero or one.');
return false;

}
else{
return true;
}
if(Aadharnumber!='' || proofofidentity!='' || proofofaddress!='' || PODB!=''){
if(PanCard==''){
alert('PanCard required.');
return false;
}
else{
return true;
}
}
else{
return true;
}
if(State=='4' || State=='21' ||State =='14'){
if(Aadharnumber==''){
return true;
}
else{
return true;
}
}
else{
return true;
}
if(senoirAge>='80'){
if(Aadharnumber==''){
return true;
}
else{
return true;
}
}
else{
return false;
}
if(CitizenIndia!='India'){
if(Aadharnumber==''){
return true;
}
else{
return true;
}
}
else{
return true;
}
}
////D75//
function AadhaarFlag(Aadharnumber,udinumber,aadhardate){
if(!Aadharnumber.match(/^[1-9][0-9]/)){
alert('It should not start with zero.');
return false;

}
else{
return true;
}
if(aadhardate=='May 1 2015' && aadhardate=='July 1 2017'){
if(!Aadharnumber.match(/^[2-9]\d+$/)){
return true;
}
else{
return false;
}
}
else{
return true;
}
}
////D76//
function CountryCitizenship(Citizenship,countrycode){
if(Citizenship!=''){
if(countrycode==''){
alert('Plz provide country code.');
return false;
}
else{
return true;
}

}
else{
return true;
}

}
////D77////
function ISDCodecountry(Citizenship,IsdCode,MobileNumber,landlinenumber){
if(Citizenship!=''){
if(IsdCode==''){
alert('Plz provide isd code.');
return false;
}
else{
return true;
}
}
else{
return true;
}
if(MobileNumber!='' && landlinenumber!=''){
if(IsdCode==''){
alert('Plz provide isd code.');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
////D79///
function Nameverifier(FirstName){
if(!FirstName.match(/^[a-zA-Z'.,]+({0,1}[a-zA-Z-, ])*$/)){
alert('Characters must be alphabet.');
return false;
}
else{
return false;
}
}
function Capacityverifier(Representativeasses,MasterCode){
if(Representativeasses!=''){
if(MasterCode==''){
alert('Capacity of Verifier Master code.');
return false;
}
else{
return true;
}
}
else{
return false;
}
}
function Placeverification(Placeverification){
if(Placeverification==''){
alert('This is required field');
return false;
}
else if(!Placeverification.match(/^[A-Za-z]+$/)){
alert('Number and special characters are not allowed.');
return false;
}
else{
return true;
}
}
////D82/////
function KYCCompliant(kyc){
if(kyc=='Y'){
alert('Plz provide kyc data.');
}

else if(kyc=='N'){
return true; 
}
else{
return false;
}
}
/////83//
function OfficezipCode(zipcode,StdCode,pincode){
if(StdCode=='99' && pincode=='999999'){
if(zipcode=='' && !zipcode.match('-  /')){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
function ResidencezipCode(Residenceaddr,zipcode,StdCode,pincode){
if(StdCode=='99' && pincode=='999999'){
if(zipcode=='' && !zipcode.match('-  /')){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
///D85//
function ProofBirth(ProofBirth,ApplicationStatus,Hindu,documentcode){
if(ApplicationStatus=='P' && Hindu=='H'){
if(ProofBirth==''){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
return true;
}
if(documentcode.length<5){
return true;
}
else{
alert('Only use four digit.')
return false;
}
}
///D86///	
function MotherLastName(ApplicationStatus,RepresentativeTitle,MotherLastName){
if(ApplicationStatus=='P'){
if(MotherLastName.length=='1' || MotherLastName.length=='2'){
return true;
}
else{
alert('single or two characters names are treated as initial.');
return false;
}
}
else{
return true;
}
if(!MotherLastName.match(/[a-z]/i)){
alert('Characters must be alphabet.');
return false;
}
else{
return true;
}
if(MotherLastName=='Private' || MotherLastName=='Limited'){
alert('upload file can be Generat.');
return true;
}
else{
alert('FVU shall provide a warning message in error file.');
return false;
}
if(!MotherLastName.match(/^[a-zA-Z'.,]+({0,1}[a-zA-Z-, ])*$/)){
alert('First name Characters must be alphabet.');
return false;
}
else{
return false;
}
if(OrganizationName=='Limited' || OrganizationName=='Private Limited'){
return true;
}
else{
return false;
}
}		
///87///
function MotherFirstName(ApplicationStatus,RepresentativeTitle,MotherFirstName){
if(ApplicationStatus=='P'){
if(MotherFirstName.length=='1' || MotherFirstName.length=='2'){
return true;
}
else{
alert('single or two characters names are treated as initial.');
return false;
}
}
else{
return true;
}
if(!FirstName.match(/[a-z]/i)){
alert('Characters must be alphabet.');
return false;
}
else{
return true;
}
if(MotherFirstName=='Private' || MotherFirstName=='Limited'){
alert('upload file can be Generat.');
return true;
}
else{
alert('FVU shall provide a warning message in error file.');
return false;
}
if(!FirstName.match(/^[a-zA-Z'.,]+({0,1}[a-zA-Z-, ])*$/)){
alert('First name Characters must be alphabet.');
return false;
}
else{
return false;
}
if(OrganizationName=='Limited' || OrganizationName=='Private Limited'){
return true;
}
else{
return false;
}
}	
/////D88/////
function MotherMiddleName(MiddleName,ApplicationStatus,OrganizationName){
if(!MiddleName.match(/[a-z]/i)){
alert('Characters must be alphabet.');
return false;
}
else if(MiddleName==''){
return true;
}
else{
return false;
}
if(ApplicationStatus=='P'){
if(MiddleName.length>1 && MiddleName.length<2){
return true;
}
alert('Any two short name is allowed.');
return false;
}
if(MotherMiddleName=='Private' || MotherMiddleName=='Limited'){
alert('upload file can be Generat.');
return true;
}
else{
alert('FVU shall provide a warning message in error file.');
return false;
}
if(OrganizationName=='Private' || OrganizationName=='Limited'){
return true;
}
else{
return false;
}
}
/////D89/////
function NamecardFlagwithApplicationStatus(ApplicationStatus,Namecardflag){
if(ApplicationStatus=='P'){
if(Namecardflag==''){
alert('This is required field');
return false;
}
else{
return true;
}
}
else{
	return true;
}
}
function NamecardFlagwithparents(ApplicationStatus,father,mother,parents,PanCard){
if(ApplicationStatus=='P'){
if(father=='' || mother=='' || parents ==''){
alert('This is required field.');
return false;
}
else{
return true;
}
}
if(father!=''){
if(PanCard==''){
alert('PanCard not mentioned.'); 
return false;
}
else{
alert('Pan card would get print.');
return true;
}

}
else{
return false;
}
if(mother!=''){
if(PanCard==''){
alert('PanCard not mentioned.'); 
return false;
}
else{
alert('Pan card would get print.');
return true;
}
}
if(parents!=''){
if(PanCard==''){
alert('PanCard not mentioned.'); 
return false;
}
else{
alert('Pan card would get print.');
return true;
}
}
}
function NamecardFlagwithLastName(ApplicationStatus,father,mother,parents,LastName,PanCard){
if(father!=''){
if(LastName=''){
alert('Last name mentioned.');
return false;
}
else{
return true;
}
}
else{
return false;
}
if(mother!=''){
if(LastName=''){
alert('Last name mentioned.');
return false;
}
else{
return true;
}
}
if(parents!=''){
if(LastName=''){
alert('Last name mentioned.');
return false;
}
else{
return true;
}
}
}
/////D90///
function AadhaarEnrolmentID(Aadharnumber,Aadhaarenroll,Datetime){
if(Aadharnumber==''){
if(Aadhaarenroll==''){
alert('Aadhaar Enrollment Id mentioned.');
return false;
}
if(!Aadhaarenroll.match(/^\d{14}$/)){
alert("Please enter your 14 digit Enrollment numbers.");
return false;
}
if(!Datetime.match(/^\d{14}$/)){
alert("Please enter your 14 digit Enrollment numbers.");
return false;
}
else{
return true;
}
}
else{
return false;
}
}
function AadhaarEnrolmentIDCitizenship(Citizenship,Aadhaarenroll){
if(Citizenship=='O'){
if(Aadhaarenroll==''){
return true;
}
else{
alert('AADHAAR Enrolment number field should be blank.');
return false;
}
}
}
function AadhaarEnrolmentPanCard(Aadhaarenroll,PanCard){
if(Aadhaarenroll==PanCard){
alert('Provide copy of Aadhaar Enrolement receipt.');
return false;
}
else{
return true;
}

}
function AadhaarEnrolmentStateName(statename,Aadhaarenroll,Citizenship,Aadharnumber){
if(statename=='Assam' || statename=='Meghalaya' || statename=='Jammu & Kashmir'){
if(Aadhaarenroll==''){
return true;
}
else{
alert('Aadhar number should be blank.');
return false;
}
}
if(Citizenship!='India'){
if(Aadharnumber==''){
return true;
}
else{
return true;
}
}
}
function AadhaarEnrolmentAge(Age,Aadhaarenroll){
if(Age>80){
if(Aadhaarenroll==''){
return true;
}
else{
return true;
}
}
else{
return false;
}
}
////D91//
function NameperAadhaar(Aadhaarenroll,Aadharnumber,AadhaarName){
if(Aadhaarenroll!='' || Aadharnumber!=''){
if(AadhaarName==''){
alert('Aadhaar Name should be mentioned.');
return false;
}
if(!AadhaarName.match(/[a-z]/i && !AadhaarName.length<100)){
alert('Aadhaar Name should be in character and 100 max length.'); 
return false;
}
else{
return true;
}
}
else{
	return true;
}
}
function applicantPANcard(PanapplicantState,Panphysical,epancard,EmailID){
if(PanapplicantState==''){
alert('This is required field.');
return false;
}
else if(PanapplicantState=='Y'){
if(Panphysical==''){
alert('This is required field');
return false;
}
else{
	return true;
}
}
else if(PanapplicantState=='N'){
if(epancard=='' || EmailID ==''){
alert('This is required field');
return false;
}
else{
	return true;
}
}
else{
return false;
}
}
///End D92///
function Modeofapplication(PanCardApplicationState,modeApplication){
if(PanCardApplicationState!=''){
if(modeApplication=='' || modeApplication!='T'){
alert('Mode of application should contain value as T..');
return false;
}
else{
return true;
}
}
else{
return true;
}
}
function VirtualIdentificationNumber(PanCardApplicationState,IdentificationNumber){
if(PanCardApplicationState!=''){
if(IdentificationNumber==''){
return true;
}
else{
alert('Pan Card Application Stateshould be blank.');
return false;
}
}
else{
return true;
}
}
function UIDToken(PanCardApplicationState,uidtoken){
if(PanCardApplicationState!=''){
if(uidtoken==''){
return true;
}
else{
alert('Uid token should be blank.');
return false;
}
}
else{
return true;
}
}
function AadhaarReferenceNumber(PanCardApplicationState,aadhaarcardnumber){
if(PanCardApplicationState!=''){
if(aadhaarcardnumber==''){
return true;
}
else{
alert('Aadhaar reference mumber should be blank.');
return false;
}
}
else{
return true;
}
}