<?php
include("inc.php");
include "logincheck.php";

$url = $serverurlapi."User1Entry/callAcknowData.php?aid=".$_GET['aid'];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
$result = curl_exec($ch);
$data = json_decode($result, true);
curl_close($ch);
$PanNumber = trim($data['recordlist']['newpanid']);
$ApplicationStatus = trim($data['recordlist']['STATUSOFAPPLICANT']);
$Title = trim($data['recordlist']['APPLTITLE']);
$isnamecr = trim($data['recordlist']['isnamecr']);
$LastName = trim($data['recordlist']['applicantlastname']);
$FirstName = trim($data['recordlist']['applicationfirstname']);
$MiddleName = trim($data['recordlist']['applicantmiddlename']);
$CardName = trim($data['recordlist']['NAMETOBEPRINTED']);
$isfathernamecr = trim($data['recordlist']['isfathernamecr']);
$ApplicantFatherLastName = trim($data['recordlist']['fatherlastname']);
$ApplicantFatherFirstName = trim($data['recordlist']['fatherfirstname']);
$ApplicantFatherMiddleName = trim($data['recordlist']['fathermiddlename']);
$isdobupdateflag = trim($data['recordlist']['isdobupdateflag']);
$DateAgreement = $data['recordlist']['DATEOFBIRTH'];
$issexupdate = $data['recordlist']['issexupdate'];
$Gender = trim($data['recordlist']['SEX']);
$PhotoMatch = trim($data['recordlist']['isphotomismatch']);
$SignatureMatch = trim($data['recordlist']['issignaturemismatch']);
$iscommaddressupdate = trim($data['recordlist']['iscommaddressupdate']);
$AddressType = trim($data['recordlist']['COMMADDRESS']);
$COMADDRESSTYPE = trim($data['recordlist']['COMADDRESS-TYPE']);
$isanotheraddressupdate = trim($data['recordlist']['isanotheraddressupdate']);
if($isanotheraddressupdate=='Y'){
if($AddressType=='R'){
$FlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
$BuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
$RoadStreetLane = trim($data['recordlist']['resipostoffice']);
$AreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
$TownCityDistrict = trim($data['recordlist']['resitownorcountry']);
$TownCityDistrict = explode('~', $TownCityDistrict);
$StateUnion = trim($data['recordlist']['resistatecode']);
$Zip = trim($data['recordlist']['resipincode']);
$isRepForeign = trim($data['recordlist']['isResForeign']);
$NameOffice= '';
$OFlatDoorBlock = '';
$OBuildingPremises = '';
$ORoadStreetLane = '';
$OAreaLocalityTaluka = '';
$OTownCityDistrict = '';
$OTownCityDistrict = '';
$OStateUnion = '';
$OZip = '';
$isOffceForeign = trim($data['recordlist']['isOffceForeign']);
$RNameOffice= trim($data['recordlist']['OFFICENAME']);
$RFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
$RBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
$RRoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
$RAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
$RTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
$RTownCityDistrict = explode('~', $RTownCityDistrict);
$RStateUnion = trim($data['recordlist']['officestatecode']);
$RZip = trim($data['recordlist']['officepincode']);
$isRepForeign = trim($data['recordlist']['isOffceForeign']);
}
if($AddressType=='O'){
$FlatDoorBlock = '';
$BuildingPremises = '';
$RoadStreetLane = '';
$AreaLocalityTaluka = '';
$TownCityDistrict = '';
$TownCityDistrict = '';
$StateUnion = '';
$Zip = '';
$isResiForeign = trim($data['recordlist']['isResiForeign']);
$NameOffice= trim($data['recordlist']['OFFICENAME']);
$OFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
$OBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
$ORoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
$OAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
$OTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
$OTownCityDistrict = explode('~', $OTownCityDistrict);
$OStateUnion = trim($data['recordlist']['officestatecode']);
$OZip = trim($data['recordlist']['officepincode']);
$isOffceForeign = trim($data['recordlist']['isOffceForeign']);
$RFlatDoorBlock = trim($data['recordlist']['raflatorblock']);
$RBuildingPremises = trim($data['recordlist']['rabuildingorvillage']);
$RRoadStreetLane = trim($data['recordlist']['streetorpostoffice']);
$RAreaLocalityTaluka = trim($data['recordlist']['raareasubdivision']);
$RTownCityDistrict = trim($data['recordlist']['ratownorcountry']);
$RTownCityDistrict = explode('~', $RTownCityDistrict);
$RStateUnion = trim($data['recordlist']['rastatecode']);
$RZip = trim($data['recordlist']['rapincoe']);
$RFlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
$RBuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
$RRoadStreetLane = trim($data['recordlist']['resipostoffice']);
$RAreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
$RTownCityDistrict = trim($data['recordlist']['resitownorcountry']);
$RTownCityDistrict = explode('~', $RTownCityDistrict);
$RStateUnion = trim($data['recordlist']['resistatecode']);
$RZip = trim($data['recordlist']['resipincode']);
$isRepForeign = trim($data['recordlist']['isResiForeign']);
}
}else{
$FlatDoorBlock = trim($data['recordlist']['resiflatorblockno']);
$BuildingPremises = trim($data['recordlist']['resibuildingorvillage']);
$RoadStreetLane = trim($data['recordlist']['resipostoffice']);
$AreaLocalityTaluka = trim($data['recordlist']['resiareasubdivision']);
$TownCityDistrict = trim($data['recordlist']['resitownorcountry']);
$TownCityDistrict = explode('~', $TownCityDistrict);
$StateUnion = trim($data['recordlist']['resistatecode']);
$Zip = trim($data['recordlist']['resipincode']);
$isResiForeign = trim($data['recordlist']['isResiForeign']);
$NameOffice= trim($data['recordlist']['OFFICENAME']);
$OFlatDoorBlock = trim($data['recordlist']['officeflatorblock']);
$OBuildingPremises = trim($data['recordlist']['officebuildingorvillage']);
$ORoadStreetLane = trim($data['recordlist']['officestreeorpostoffice']);
$OAreaLocalityTaluka = trim($data['recordlist']['officeareaorsubdivision']);
$OTownCityDistrict = trim($data['recordlist']['officetownorcontry']);
$OTownCityDistrict = explode('~', $OTownCityDistrict);
$OStateUnion = trim($data['recordlist']['officestatecode']);
$OZip = trim($data['recordlist']['officepincode']);
$isOffceForeign = trim($data['recordlist']['isOffceForeign']);
$RFlatDoorBlock = '';
$RBuildingPremises = '';
$RRoadStreetLane = '';
$RAreaLocalityTaluka = '';
$RTownCityDistrict = '';
$RTownCityDistrict = '';
$RStateUnion = '';
$RZip = '';
$isRepForeign = trim($data['recordlist']['isRepForeign']);
}
$istelephoneemailupdate = trim($data['recordlist']['istelephoneemailupdate']);
$StdCode = trim($data['recordlist']['STDCODE']);
$MobileNumber = trim($data['recordlist']['TELPHONE']);
$Email = trim($data['recordlist']['EMAIL']);
$Pan1 = trim($data['recordlist']['oldpan1']);
$Pan2 = trim($data['recordlist']['oldpan2']);
$Pan3 = trim($data['recordlist']['oldpan3']);
$Pan4 = trim($data['recordlist']['oldpan4']);
$Pan5 = trim($data['recordlist']['oldpan5']);
$Pan6 = trim($data['recordlist']['oldpan6']);
$Pan7 = trim($data['recordlist']['oldpan7']);
$Pan8 = trim($data['recordlist']['oldpan8']);
$Enclosed = trim($data['recordlist']['numofsupporteddoc']);
$verificationdate = trim($data['recordlist']['verificationdate']);
$POI = trim($data['recordlist']['POI']);
$POA = trim($data['recordlist']['POA']);
$reuploadedtonsdl = trim($data['recordlist']['reuploadedtonsdl']);
$isreprintrequest = trim($data['recordlist']['isreprintrequest']);
$AcknowledgementNumber = trim($data['recordlist']['acknowledmentnumber']);
$isphotoflag = trim($data['recordlist']['isphotoflag']);
$issignflag = trim($data['recordlist']['issignflag']);
$AcknowledgementDate = trim($data['recordlist']['acknwoledmentdate']);
$oldacknwoledmentnum = trim($data['recordlist']['oldacknwoledmentnum']);
$ispanproofgiven = trim($data['recordlist']['ispanproofgiven']);
$isminor = trim($data['recordlist']['isminor']);
$isdiscreattinfclevel = trim($data['recordlist']['isdiscreattinfclevel']);
$dateofdescreresolution = trim($data['recordlist']['dateofdescreresolution']);
$countryisd = trim($data['recordlist']['countryisd']);
$Aadhar = trim($data['recordlist']['ADHARNUM']);
$AadharVarification = trim($data['recordlist']['adharflag']);
$verifiername = trim($data['recordlist']['verifiername']);
$verifiercapcitycode = trim($data['recordlist']['verifiercapcitycode']);
$verificationplace = trim($data['recordlist']['verificationplace']);
$officezip = trim($data['recordlist']['officezip']);
$resizip = trim($data['recordlist']['resizip']);
$ProofDob = trim($data['recordlist']['proofofbirthdoccode']);
$ismothernamecr = trim($data['recordlist']['ismothernamecr']);
$ApplicantMotherLastName = trim($data['recordlist']['motherlastename']);
$ApplicantMotherFirstName = trim($data['recordlist']['motherfirstname']);
$ApplicantMotherMiddleName = trim($data['recordlist']['mothermiddlename']);
$NamePrintedCard = trim($data['recordlist']['fatherormothernameoncard']);
$EnrolmentId = trim($data['recordlist']['adharenrolmentid']);
$AadharName = trim($data['recordlist']['nameasadhar']);
$PhysicalPanCard = trim($data['recordlist']['isphysicalpanwanted']);
$modeofapplication = trim($data['recordlist']['modeofapplication']);
$VID = trim($data['recordlist']['VID']);
$uidtocken = trim($data['recordlist']['uidtocken']);
$adharref = trim($data['recordlist']['adharref']);
$Revised = trim($data['formtype']);
if($ApplicationStatus=='P'){
//$isphotoflag = trim($data['recordlist']['isphotoflag']);
//$issignflag = trim($data['recordlist']['issignflag']);
$isphotoflag = 'Y';
$issignflag = 'Y';
}else{
$isphotoflag = 'N';
$issignflag = 'N';
}
$isResiForeign = trim($data['recordlist']['isResiForeign']);
$Stage = trim($data['recordlist']['stage']);
?>
<?php
if(isset($_POST['action'])=="dataentryformcr"){
//$postData = $_POST;
//$postData = json_encode($postData,JSON_PRETTY_PRINT);
$isotherresi = trim($_POST['isotherresi']);
$isotheroffce = trim($_POST['isotheroffce']);
$isminor = trim($_POST['isminor']);
$newpanid = trim($_POST['newpanid']);
$APPLTITLE = trim($_POST['APPLTITLE']);
$STATUSOFAPPLICANT = trim($data['recordlist']['STATUSOFAPPLICANT']);
$applicantcategorycode = trim($_POST['applicantcategorycode']);
$applicantlastname = trim($_POST['applicantlastname']);
$applicationfirstname = trim($_POST['applicationfirstname']);
$applicantmiddlename = trim($_POST['applicantmiddlename']);
$NAMETOBEPRINTED = trim($_POST['NAMETOBEPRINTED']);
$fatherlastname = trim($_POST['fatherlastname']);
$fatherfirstname = trim($_POST['fatherfirstname']);
$fathermiddlename = trim($_POST['fathermiddlename']);
$DATEOFBIRTH = trim($_POST['DATEOFBIRTH']);
$SEX = trim($_POST['SEX']);
$COMMADDRESS = trim($_POST['COMMADDRESS']);
if(trim($_POST['isanotheraddressupdate'])=='Y'){
if($COMMADDRESS=='R'){
//COMMADDRESS is R
$resiflatorblockno = trim($_POST['resiflatorblockno']);
$resibuildingorvillage = trim($_POST['resibuildingorvillage']);
$resipostoffice = trim($_POST['resipostoffice']);
$resiareasubdivision = trim($_POST['resiareasubdivision']);
$resitownorcountry = trim($_POST['resitownorcountry']);
$resistatecode = trim($_POST['resistatecode']);
$foreigncountryrsd = trim($_POST['foreigncountryrsd']);
$resizipcode = trim($_POST['resizipcode']);
$resipincode = trim($_POST['resipincode']);
$isotherresi = trim($_POST['isotherresi']);
if($resizipcode!='' && $isotherresi=='Y'){
$resitownorcountry = $resitownorcountry.'~'.$foreigncountryrsd.'~'.$resizipcode;
}else{
$resizipcode = '';
}
if(trim($_POST['resiflatorblockno'])==''){
$resipincode='';
$resistatecode='';
}
$OFFICENAME = trim($_POST['RNameOffice']);;
$officeflatorblock = trim($_POST['raflatorblock']);
$officebuildingorvillage = trim($_POST['rabuildingorvillage']);
$officestreeorpostoffice = trim($_POST['streetorpostoffice']);
$officeareaorsubdivision = trim($_POST['raareasubdivision']);
$officetownorcontry = trim($_POST['ratownorcountry']);
$officestatecode = trim($_POST['rastatecode']);
$officepincode = trim($_POST['rapincoe']);
$foreigncountryofs = trim($_POST['foreigncountryrep']);
$officezipcode = trim($_POST['razipcode']);
$isotheroffce = trim($_POST['isotherrep']);
if($officezipcode!='' && $isotheroffce=='Y'){
$officetownorcontry = $officetownorcontry.'~'.$foreigncountryofs.'~'.$officezipcode;
}else{
$officezipcode = '';
}
if(trim($_POST['raflatorblock'])==''){
$officepincode='';
$officestatecode='';
}
}
if($COMMADDRESS=='O'){
//commaddress is office O
$OFFICENAME = trim($_POST['OFFICENAME']);
$officeflatorblock = trim($_POST['officeflatorblock']);
$officebuildingorvillage = trim($_POST['officebuildingorvillage']);
$officestreeorpostoffice = trim($_POST['officestreeorpostoffice']);
$officeareaorsubdivision = trim($_POST['officeareaorsubdivision']);
$officetownorcontry = trim($_POST['officetownorcontry']);
$officestatecode = trim($_POST['officestatecode']);
$officepincode = trim($_POST['officepincode']);
$foreigncountryofs = trim($_POST['foreigncountryofs']);
$officezipcode = trim($_POST['officezipcode']);
$isotheroffce = trim($_POST['isotheroffce']);
if($officezipcode!='' && $isotheroffce=='Y'){
$officezipcode = trim($_POST['officezipcode']);
$officetownorcontry = $officetownorcontry.'~'.$foreigncountryofs.'~'.$officezipcode;
}else{
$officezipcode = '';
}
if(trim($_POST['officeflatorblock'])==''){
$officepincode='';
$officestatecode='';
}
//for other
$resiflatorblockno = trim($_POST['raflatorblock']);
$resibuildingorvillage = trim($_POST['rabuildingorvillage']);
$resipostoffice = trim($_POST['streetorpostoffice']);
$resiareasubdivision = trim($_POST['raareasubdivision']);
$resitownorcountry = trim($_POST['ratownorcountry']);
$resistatecode = trim($_POST['rastatecode']);
$foreigncountryrsd = trim($_POST['foreigncountryrep']);
$resizipcode = trim($_POST['razipcode']);
$resipincode = trim($_POST['rapincoe']);
$isotherresi = trim($_POST['isotherrep']);
if($resizipcode!='' && $isotherresi=='Y'){
$resizipcode = trim($_POST['razipcode']);
$resitownorcountry = $resitownorcountry.'~'.$foreigncountryrsd.'~'.$resizipcode;
}else{
$resizipcode = '';
}
if(trim($_POST['raflatorblock'])==''){
$resipincode='';
$resistatecode='';
}
}
}else{
if($COMMADDRESS=='R'){
$resiflatorblockno = trim($_POST['resiflatorblockno']);
$resibuildingorvillage = trim($_POST['resibuildingorvillage']);
$resipostoffice = trim($_POST['resipostoffice']);
$resiareasubdivision = trim($_POST['resiareasubdivision']);
$resitownorcountry = trim($_POST['resitownorcountry']);
$resistatecode = trim($_POST['resistatecode']);
$foreigncountryrsd = trim($_POST['foreigncountryrsd']);
$resizipcode = trim($_POST['resizipcode']);
$resipincode = trim($_POST['resipincode']);
if($resizipcode!='' && $isotherresi=='Y'){
$resitownorcountry = $resitownorcountry.'~'.$foreigncountryrsd.'~'.$resizipcode;
}else{
$resizipcode = '';
}
if(trim($_POST['resiflatorblockno'])==''){
$resipincode='';
$resistatecode='';
}
}
if($COMMADDRESS=='O'){
$OFFICENAME = trim($_POST['OFFICENAME']);
$officeflatorblock = trim($_POST['officeflatorblock']);
$officebuildingorvillage = trim($_POST['officebuildingorvillage']);
$officestreeorpostoffice = trim($_POST['officestreeorpostoffice']);
$officeareaorsubdivision = trim($_POST['officeareaorsubdivision']);
$officetownorcontry = trim($_POST['officetownorcontry']);
$officestatecode = trim($_POST['officestatecode']);
$officepincode = trim($_POST['officepincode']);
$foreigncountryofs = trim($_POST['foreigncountryofs']);
$officezipcode = trim($_POST['officezipcode']);
if($officezipcode!='' && $isotheroffce=='Y'){
$officetownorcontry = $officetownorcontry.'~'.$foreigncountryofs.'~'.$officezipcode;
}else{
$officezipcode = '';
}
if(trim($_POST['officeflatorblock'])==''){
$officepincode='';
$officestatecode='';
}
}
}
$STDCODE = trim($_POST['STDCODE']);
$EMAIL = trim($_POST['EMAIL']);
$oldpan1 = trim($_POST['oldpan1']);
$oldpan2 = trim($_POST['oldpan2']);
$oldpan3 = trim($_POST['oldpan3']);
$oldpan4 = trim($_POST['oldpan4']);
$oldpan5 = trim($_POST['oldpan5']);
$oldpan6 = trim($_POST['oldpan6']);
$oldpan7 = trim($_POST['oldpan7']);
$oldpan8 = trim($_POST['oldpan8']);
$numofsupporteddoc = trim($_POST['numofsupporteddoc']);
$verificationdate = trim($_POST['verificationdate']);
$POI = trim($_POST['POI']);
$POA = trim($_POST['POA']);
$reuploadedtonsdl = trim($_POST['reuploadedtonsdl']);
$isreprintrequest = trim($_POST['isreprintrequest']);
$acknowledmentnumber = trim($_POST['acknowledmentnumber']);
$acknwoledmentdate = trim($_POST['acknwoledmentdate']);
$oldacknwoledmentnum = trim($_POST['oldacknwoledmentnum']);
$oldacknwoledmentnum = trim($_POST['oldacknwoledmentnum']);
$isdiscreattinfclevel = trim($_POST['isdiscreattinfclevel']);
$dateofdescreresolution = trim($_POST['dateofdescreresolution']);
$countryisd = trim($_POST['countryisd']);
$ADHARNUM = trim($_POST['ADHARNUM']);
$adharflag = trim($_POST['adharflag']);
$verifiername = trim($_POST['verifiername']);
$verifiercapcitycode = trim($_POST['verifiercapcitycode']);
$verificationplace = trim($_POST['verificationplace']);
$officezip = trim($_POST['officezip']);
$resizip = trim($_POST['resizip']);
$proofofbirthdoccode = trim($_POST['dobdocumentcode']);
$motherlastename = trim($_POST['motherlastename']);
$motherfirstname = trim($_POST['motherfirstname']);
$mothermiddlename = trim($_POST['mothermiddlename']);
$fatherormothernameoncard = trim($_POST['fatherormothernameoncard']);
$adharenrolmentid = trim($_POST['adharenrolmentid']);
$nameasadhar = trim($_POST['nameasadhar']);
$isphysicalpanwanted = trim($_POST['isphysicalpanwanted']);
$modeofapplication = trim($_POST['modeofapplication']);
$VID = trim($_POST['VID']);
$uidtocken = trim($_POST['uidtocken']);
$adharref = trim($_POST['adharref']);
$TELPHONE = trim($_POST['TELPHONE']);
$isnamecr = trim($_POST['isnamecr']);
if($isnamecr==''){
$isnamecr = "N";
}
$isfathernamecr = trim($_POST['isfathernamecr']);
if($isfathernamecr==''){
$isfathernamecr = "N";
}
$ismothernamecr = trim($_POST['ismothernamecr']);
if($ismothernamecr==''){
$ismothernamecr = "N";
}
$isdobupdateflag = trim($_POST['isdobupdateflag']);
if($isdobupdateflag==''){
$isdobupdateflag = "N";
}
$issexupdate = trim($_POST['issexupdate']);
if($issexupdate==''){
$issexupdate = "N";
}
$isphotoflag = trim($_POST['isphotoflag']);
if($isphotoflag==''){
$isphotoflag = "N";
}
$issignflag = trim($_POST['issignflag']);
if($issignflag==''){
$issignflag = "N";
}
$isphotomismatch = trim($_POST['isphotomismatch']);
if($isphotomismatch==''){
$isphotomismatch = "N";
}
$issignaturemismatch = trim($_POST['issignaturemismatch']);
if($issignaturemismatch==''){
$issignaturemismatch = "N";
}
$iscommaddressupdate = trim($_POST['iscommaddressupdate']);
if($iscommaddressupdate==''){
$iscommaddressupdate = "N";
}
$isanotheraddressupdate = trim($_POST['isanotheraddressupdate']);
if($isanotheraddressupdate==''){
$isanotheraddressupdate = "N";
}
$istelephoneemailupdate = trim($_POST['istelephoneemailupdate']);
if($istelephoneemailupdate==''){
$istelephoneemailupdate = "N";
}
$ispanproofgiven = trim($_POST['ispanproofgiven']);
$formJson = '{ "newpanid": "'.$newpanid.'", "APPLTITLE": "'.$APPLTITLE.'", "isnamecr": "'.$isnamecr.'", "STATUSOFAPPLICANT": "'.$STATUSOFAPPLICANT.'", "applicantcategorycode": "'.$applicantcategorycode.'", "applicantlastname": "'.$applicantlastname.'", "applicationfirstname": "'.$applicationfirstname.'", "applicantmiddlename": "'.$applicantmiddlename.'", "NAMETOBEPRINTED": "'.$NAMETOBEPRINTED.'", "isfathernamecr": "'.$isfathernamecr.'", "fatherlastname": "'.$fatherlastname.'", "fatherfirstname": "'.$fatherfirstname.'", "fathermiddlename": "'.$fathermiddlename.'", "isdobupdateflag": "'.$isdobupdateflag.'", "DATEOFBIRTH": "'.$DATEOFBIRTH.'", "issexupdate": "'.$issexupdate.'", "SEX": "'.$SEX.'", "isphotomismatch": "'.$isphotomismatch.'", "issignaturemismatch": "'.$issignaturemismatch.'", "iscommaddressupdate": "'.$iscommaddressupdate.'", "COMMADDRESS": "'.$COMMADDRESS.'", "isanotheraddressupdate": "'.$isanotheraddressupdate.'", "resiflatorblockno": "'.$resiflatorblockno.'", "resibuildingorvillage": "'.$resibuildingorvillage.'", "resipostoffice": "'.$resipostoffice.'", "resiareasubdivision": "'.$resiareasubdivision.'", "resitownorcountry": "'.$resitownorcountry.'", "resistatecode": "'.$resistatecode.'",
"resipincode": "'.$resipincode.'", "OFFICENAME": "'.$OFFICENAME.'", "officeflatorblock": "'.$officeflatorblock.'", "officebuildingorvillage": "'.$officebuildingorvillage.'", "officestreeorpostoffice": "'.$officestreeorpostoffice.'", "officeareaorsubdivision": "'.$officeareaorsubdivision.'", "officetownorcontry": "'.$officetownorcontry.'", "officestatecode": "'.$officestatecode.'", "officepincode": "'.$officepincode.'", "istelephoneemailupdate": "'.$istelephoneemailupdate.'", "STDCODE": "'.$STDCODE.'", "TELPHONE": "'.$TELPHONE.'", "EMAIL": "'.$EMAIL.'", "oldpan1": "'.$oldpan1.'", "oldpan2": "'.$oldpan2.'", "oldpan3": "'.$oldpan3.'", "oldpan4": "'.$oldpan4.'", "oldpan5": "'.$oldpan5.'", "oldpan6": "'.$oldpan6.'", "oldpan7": "'.$oldpan7.'", "oldpan8": "'.$oldpan8.'", "numofsupporteddoc": "'.$numofsupporteddoc.'", "verificationdate": "'.$verificationdate.'", "POI": "'.$POI.'", "POA": "'.$POA.'", "reuploadedtonsdl": "'.$reuploadedtonsdl.'", "isreprintrequest": "'.$isreprintrequest.'", "acknowledmentnumber": "'.$acknowledmentnumber.'", "isphotoflag": "'.$isphotoflag.'", "issignflag": "'.$issignflag.'", "acknwoledmentdate": "'.$acknwoledmentdate.'", "oldacknwoledmentnum": "'.$oldacknwoledmentnum.'", "ispanproofgiven": "'.$ispanproofgiven.'", "isminor": "'.$isminor.'","isdiscreattinfclevel":"'.$isdiscreattinfclevel.'","dateofdescreresolution": "'.$dateofdescreresolution.'", "countryisd": "'.$countryisd.'", "ADHARNUM": "'.$ADHARNUM.'", "adharflag": "'.$adharflag.'", "verifiername": "'.$verifiername.'", "verifiercapcitycode": "'.$verifiercapcitycode.'", "verificationplace": "'.$verificationplace.'", "officezip": "'.$officezipcode.'", "resizip": "'.$resizipcode.'", "proofofbirthdoccode": "'.$proofofbirthdoccode.'", "ismothernamecr": "'.$ismothernamecr.'", "motherlastename": "'.$motherlastename.'", "motherfirstname": "'.$motherfirstname.'", "mothermiddlename": "'.$mothermiddlename.'", "fatherormothernameoncard": "'.$fatherormothernameoncard.'", "adharenrolmentid": "'.$adharenrolmentid.'", "nameasadhar": "'.$nameasadhar.'", "isphysicalpanwanted": "'.$isphysicalpanwanted.'", "modeofapplication": "'.$modeofapplication.'", "VID": "'.$VID.'", "uidtocken": "'.$uidtocken.'", "adharref": "'.$adharref.'" }';

$jsonPost = '{ "status": "0", "message": "Update Record", "page": "1", "formtype": "'.$Revised.'", "Role": "'.$_SESSION['ROLE'].'", "recordlist":'.$formJson.'}';

logger("JSON to post for cr form ----".$jsonPost);
$urlPost = $serverurlapi."User1Entry/PanDataUpdateAPI.php";
$chp = curl_init();
curl_setopt($chp, CURLOPT_URL,$urlPost);
curl_setopt($chp, CURLOPT_POST,1);
curl_setopt($chp, CURLOPT_POSTFIELDS, $jsonPost);
curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($chp);
curl_close($chp);
$res = json_decode($response,true);
logger("Response return from cr form ----".$response);

$location = 'qc_pdf.php?aid='.$AcknowledgementNumber.'&formType='.strtoupper($Revised);

if($res['status']=='0'){
?>
<script>
parent.window.location.href = '<?php echo $location; ?>';
</script>
<?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>PAN CR Form</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<style type="text/css">
.error{
color: red;
}
.selectize-dropdown{
  text-align: left;
}
.form-control{
color: #324148;
padding: 0.175rem 0.75rem;
height: calc(1.75rem + 4px);
}
.form-group {
    margin-bottom: 0.50rem;
}
.numHead{
font-size: 14px;
    padding: 4px;
    color: black;
    font-weight: 500;
}
.grid-box{
display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 18px;
    text-align: center;
    padding: 10px;
}
.arr {
    margin-top: 4px !important;
    margin-bottom: 20px !important;
}
.form-group.ks-trek {
    margin-left: 20px !important;
}
.divspace{
	margin-bottom: -21px !important;
}
h4.para.br-ffr.vtd {
    margin-top: 0px;
}
.form-group.panclass {
    margin-bottom: -18px;
    margin-top: -9px;
}
.proofclass{
margin-bottom: -17px;
}
.form-group.ks-trek.verification {
    margin-bottom: -9px;
    text-align: center;
}
</style>
<style>
.fr-rew{
padding: 5px;
margin-right: 5px;
}.gio-yt{
display: flex;
column-gap: 26px;
}
.nbvu-test{
width: 47%;
}
.gh-nbv{
border: 1px solid #79c117;
border-radius: 5px;
width: 22%;
}
.fd-dyt{
padding: 3px;
}
.hk-pg-wrapper{
padding-top: 0;
margin-left: 0;
}
.gc-xc{
margin-top: auto;
margin-bottom: auto;

}
.lostas1{
background: #efefef;
height: 19px;
width: 10%;
margin-left: 5px;
margin-top: 3px;
}
.lostas2{
background: #efefef;
height: 19px;
width: 30px;
margin-left: 5px;
margin-top: 3px;
margin-right: 5px;
}
.bg-jh{
width: 30%;
}
.rew{
padding: 10px;
}
.hy-nh{
width: 17%;
}
.hy-yui{
width: 60%
}
.ft-yt{
width: 21%;
}
.ui-yt{
width: 28%;
}
.ou-yt{
width: 68%;
}
.hg-op{
padding: 0 1%
}
.vtd{
margin-top: 40px;
}
.cx-jh{
width: 12%;
}
.hy-bg{
margin-bottom: 2%!important;
}
.fr-rew{
padding: 5px;
margin-right: 5px;
}
.gio-yt{
display: flex;
column-gap: 26px;
}
.nbvu-test{
width: 47%;
}
.gh-nbv{
border: 1px solid #79c117;
border-radius: 5px;
width: 22%;
}
.fd-dyt{
padding: 3px;
}
.hk-pg-wrapper{
padding-top: 0;
margin-left: 0;
}
.gc-xc{
margin-top: auto;
margin-bottom: auto;

}
.ui-ynb{
width: 39%;
}
.lostas1{
background: #efefef;
height: 19px;
width: 10%;
margin-left: 5px;
margin-top: 3px;
}
.lostas2{
background: #efefef;
height: 19px;
width: 30px;
margin-left: 5px;
margin-top: 3px;
margin-right: 5px;
}


</style>
<style type="text/css">
.chosen-container-single .chosen-single span {
color: #324148 !important;
border-width: 2px !important;
border-color: #79c117 !important;
padding: .375rem .75rem;
height: calc(2.25rem + 4px) !important;
/* border: 1px solid #79c117 !important;*/
border-radius: 3px !important;
}
.chosen-container-single .chosen-search input[type=text] {
padding: 16px 20px 8px 12px !important;
}
.chosen-container-single .chosen-single {
height: 41px !important;
}
div#OStateUnion_chosen {
width: 459px !important;
}
div#StateUnion_chosen {
width: 462px !important;
}
</style>
</head>
<body style="overflow: hidden;">
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper" style="margin-left: 0!important;">
    <!-- <div style="background:transparent;">
</div> -->
    <!-- Row -->
    <div class="row conta">
    <div class="col-xl-12">
    <section class="hk-sec-wrapper">
    <div class="container-fluid">
    <form name="curl_form" method="post" id="dataentry1" enctype="multipart/form-data" autocomplete="off">
      <div class="row">
        <div class="col-md-4 gc-xc">
          <div class="form-group">
            <p class="para " for="first">Permanent&nbsp;Account&nbsp;Number(PAN)</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" class="form-control inputborder gc-xc" name="newpanid" value="<?php echo $PanNumber; ?>" readonly>
          </div>
        </div>
        <!--  col-md-6   -->
        <div class="col-md-5"> </div>
        <!--  <div class="col-md-1">
</div> -->
        <!-- <div class="col-md-3">
</div> -->
      </div>
      <div class="dostas">
        <div style="display: flex;" class="arr">
          <div class="lostas2"></div>
          <h5>Applicant Personal Detail</h5>
          <div class="lostas1"> </div>
        </div>
      </div>
      <div class="row">
        <div style="display: grid;grid-template-columns: auto auto;width: 100%;">
          <?php if($ApplicationStatus=='P'){ ?>
          <div class="col-md-12">
            <div class="form-group">
              <p  class="para mrest" for="first">Photo</p>
              <div class="ast" style="height: 140px; width: 63%; border: none !important;"> <img src="data/temp/crop/<?php echo $_GET['aid']; ?>_Photo.Jpg" style="position: absolute;
    top: 0;
    left: 86px;
    width: 56%;
    height: 89%;
    opacity: 0.6; border: 1px solid #79c117;"> </div>
            </div>
          </div>
          <?php } ?>
          <!--  col-md-6   -->
          <?php if($ApplicationStatus=='P'){ ?>
          <div class="col-md-12">
            <div class="form-group">
              <p  class="para mrest" for="first">Signature</p>
              <div class="ast1" style="height: 111px; width: 59%; border: none !important;"> <img  style="position: absolute;
    top: 0;
    left: 104px;
    width: 56%;
    height: 89%;
    opacity: 0.6; border: 1px solid #79c117;" src="data/temp/crop/<?php echo $_GET['aid']; ?>_Sig.Jpg"> </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-md-5">
          <!--<div class="row">
<div class="col-md-5">
<div class="form-group">
<p class="para" for="first">Application&nbsp;Status&nbsp;*</p>
</div>
</div>
<div class="col-md-7">
<select name="ApplicationStatus" id="ApplicationStatus" class="form-control inputborder" onChange="funcCheckAddType();">
<option value="">Select</option>
<?php
$ApplicationStatusJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/applicantStatus_pan.json");
$ApplicationStatusJson = json_decode($ApplicationStatusJson,true);
foreach($ApplicationStatusJson['List'] as $ApplicationStatusData){
?>
<option value="<?php echo $ApplicationStatusData['Code']; ?>" <?php if($ApplicationStatusData['Code']==$ApplicationStatus){ echo 'selected'; }?> ><?php echo $ApplicationStatusData['Status'].' ['.$ApplicationStatusData['Code'].']'; ?></option>
<?php } ?>
</select>
</div>
</div>-->
          <div class="row drr">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Acknowledgement&nbsp;No&nbsp;*</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder" name="acknowledmentnumber" value="<?php echo $AcknowledgementNumber; ?>" id="AcknowledgementNumber" readonly  onKeyDown="upperCaseF(this)">
                <label id="AcknowledgementNumberError" style="color: red; display: none;"></label>
              </div>
            </div>
          </div>
        </div>
        <!--  col-md-6   -->
      </div>
      <!--  row   -->
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead">1.</span>Full&nbsp;Name&nbsp;(Initial,Last,First,Middle)*
                  <input class="jiy " type="checkbox" name="isnamecr" id="isnamecr" value="Y" <?php if($isnamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isnamecr');" onKeyDown="upperCaseF(this)">
                </p>
              </div>
            </div>
            <!-- <div class="col-md-1">
<div class="form-group"> -->
            <div class="col-md-12">
              <div class="form-group">
                <select name="APPLTITLE" class="form-control inputborder inputtyodr" id="Title" required>
                  <?php if($ApplicationStatus=='P'){ ?>
					  <?php if($Gender=='M'){ ?>
					  <option value="1" <?php if($Title==1){ echo 'selected'; } ?>>Shri</option>
					  <?php }elseif($Gender=='F'){ ?>
					  <option value="">Select</option>
					  <option value="2" <?php if($Title==2){ echo 'selected'; } ?>>Smt/Mrs</option>
					  <option value="3" <?php if($Title==3){ echo 'selected'; } ?>>Kumari/Ms</option>
					  <?php }elseif($Gender=='T' || $Gender==''){ ?>
					  <option value="">Select</option>
					  <option value="1" <?php if($Title==1){ echo 'selected'; } ?>>Shri</option>
					  <option value="2" <?php if($Title==2){ echo 'selected'; } ?>>Smt/Mrs</option>
					  <option value="3" <?php if($Title==3){ echo 'selected'; } ?>>Kumari/Ms</option>
					  <?php } ?>
				  <?php }else{ ?>
				  <option value="4" <?php if($Title==4){ echo 'selected'; } ?>>M/s</option>
				  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr  " name="applicantlastname" value="<?php echo $LastName; ?>" id="LastName" onKeyDown="upperCaseF(this);" <?php if($ApplicationStatus=='P'){ ?>maxlength="25"<?php }else{ ?>maxlength="75"<?php } ?>>
                <label id="LastNameError" style="color: red;display: none;"></label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr  " name="applicationfirstname" value="<?php echo $FirstName; ?>" id="FirstName" maxlength="25" autocomplete="nope" onKeyDown="upperCaseF(this);">
                <label id="FirstNameError" style="color: red;display: none;"></label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr  " name="applicantmiddlename" value="<?php echo $MiddleName;  ?>" id="MiddleName" maxlength="25" autocomplete="nope" onKeyDown="upperCaseF(this);">
                <label id="MiddleNameError" style="color: red;display: none;"></label>
              </div>
            </div>
          </div>
        </div>
        <!--   </div>
</div> -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Card&nbsp;Display&nbsp;Name*</p>
              </div>
            </div>
            <!-- <div class="col-md-1">
<div class="form-group"> -->
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr" name="NAMETOBEPRINTED" value="<?php echo $CardName; ?>" id="CardName" maxlength="85" onKeyDown="upperCaseF(this);">
                <label id="CardNameError" style="color: red;"></label>
              </div>
            </div>
          </div>
          <!--   </div>
</div> -->
          <!--  col-md-6   -->
        </div>
      </div>
      <!--   </div>
</div> -->
      <!--  col-md-6   -->
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first"><span class="numHead">2.</span>Father&nbsp;Name&nbsp;(Last,First,Middle)
                <input class="jiy" type="checkbox" name="isfathernamecr" id="isfathernamecr"  value="Y" <?php if($isfathernamecr=='Y'){ echo 'checked'; }else{ echo 'unchecked'; } ?> onClick="funcCheckDetails('isfathernamecr');" onKeyDown="upperCaseF(this);">
              </p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control inputborder inputtyodr" name="fatherlastname" value="<?php echo $ApplicantFatherLastName; ?>" maxlength="25" id="ApplicantFatherLastName" onKeyDown="upperCaseF(this);">
              <label id="ApplicantFatherLastNameError" style="color: red;display: none;"></label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control inputborder inputtyodr  " name="fatherfirstname" value="<?php echo $ApplicantFatherFirstName; ?>" maxlength="25" id="ApplicantFatherFirstName" onKeyDown="upperCaseF(this);">
              <label id="ApplicantFatherFirstNameError" style="color: red;display: none;"></label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control inputborder inputtyodr  " name="fathermiddlename" value="<?php echo $ApplicantFatherMiddleName; ?>" maxlength="25" id="ApplicantFatherMiddleName" onKeyDown="upperCaseF(this);">
              <label id="ApplicantFatherMiddleNameError" style="color: red;display: none;"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first">Mother&nbsp;Name&nbsp;(Last,First,Middle)
                <input class="jiy" type="checkbox" name="ismothernamecr" id="ismothernamecr" value="Y" <?php if($ismothernamecr=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('ismothernamecr');"  onkeydown="upperCaseF(this)">
              </p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control inputborder inputtyodr  " name="motherlastename" value="<?php echo $ApplicantMotherLastName; ?>" maxlength="25" id="ApplicantMotherLastName" onKeyDown="upperCaseF(this)">
              <label id="ApplicantMotherLastNameError" style="color: red;display: none;"></label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control inputborder inputtyodr  " name="motherfirstname" value="<?php echo $ApplicantMotherFirstName; ?>" maxlength="25" id="ApplicantMotherFirstName" onKeyDown="upperCaseF(this)">
              <label id="ApplicantMotherFirstNameError" style="color: red;display: none;"></label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control inputborder inputtyodr  " name="mothermiddlename" value="<?php echo $ApplicantMotherMiddleName; ?>" maxlength="25" id="ApplicantMotherMiddleName" onKeyDown="upperCaseF(this)">
              <label id="ApplicantMotherMiddleNameError" style="color: red;display: none;"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first">Name to be printed on card (Father/Mother)</p>
            </div>
          </div>
          <!-- <div class="col-md-1">
<div class="form-group"> -->
          <div class="col-md-12">
            <div class="form-group">
              <select name="fatherormothernameoncard" class="form-control inputborder" id="NamePrintedCard">
                <option value="">Select</option>
                <option value="F" <?php if($NamePrintedCard=='F'){ echo 'selected'; } ?>>Father</option>
                <option value="M" <?php if($NamePrintedCard=='M'){ echo 'selected'; } ?>>Mother</option>
                <option value="S" <?php if($NamePrintedCard=='S'){ echo 'selected'; } ?>>Single Parent</option>
              </select>
            </div>
          </div>
        </div>
        <!--   </div>
</div> -->
        <!--  col-md-6   -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first">Application&nbsp;wishes&nbsp;to&nbsp;have&nbsp;physical&nbsp;PAN</p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group ks-trek">
              <input type="radio" class="js-trek" name="isphysicalpanwanted" <?php if($PhysicalPanCard=='Y'){ echo 'Checked'; } ?> value="Y" >
              <p class="para grek gc-xc" for="first">Y </p>
              <input type="radio" class="js-trek"  name="isphysicalpanwanted" <?php if($PhysicalPanCard=='N'){ echo 'Checked'; }  ?> value="N" >
              <p class="para grek gc-xc" for="first">N </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first"><span class="numHead">3.</span>&nbsp;Date of Birth/Agreement&nbsp;*
                <input class="jiy" type="checkbox" name="isdobupdateflag" id="isdobupdateflag" value="Y" <?php if($isdobupdateflag=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('isdobupdateflag');">
              </p>
            </div>
          </div>
          <?php
$DOB = $DateAgreement;
$date = substr($DOB,0,2).'-';
$month = substr($DOB,2,2).'-';
$year = substr($DOB,4,5);
$DOB = $date.$month.$year;
?>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" name="DOB" id="DateAgreement" onChange="getDate(this.value);"  class="form-control inputborder inputtyodr  datepicker " value="<?php if($DateAgreement!=''){ echo $DOB; }?>" maxlength="10">
              <input type="hidden" name="DATEOFBIRTH" id="DATEOFBIRTH" value="<?php echo $DateAgreement; ?>">
              <script>
function getDate(dobValue){
var newdobval = dobValue.replace('-','');
final = newdobval.replace('-','');
$('#DATEOFBIRTH').val(final);
}
</script>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para ytti-t" for="first"><span class="numHead">4.</span>Gender&nbsp;(for&nbsp;'Individual'&nbsp;applicant&nbsp;only)
                <input class="jiy isphotoflagCls" type="checkbox" name="issexupdate" id="issexupdate" value="Y" <?php if($issexupdate=='Y'){ echo 'checked'; } ?> >
              </p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <select name="SEX" class="form-control inputborder issexupdateCls" id="Gender">
                <option value="" >Select</option>
                <option value="M" <?php if($Gender=='M'){ echo 'Selected'; } ?>>Male</option>
                <option value="F" <?php if($Gender=='F'){ echo 'Selected'; } ?>>Female</option>
                <option value="T" <?php if($Gender=='T'){ echo 'Selected'; } ?>>Transgender</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <input class="jiy" type="checkbox" name="isphotoflag" id="isphotoflag" value="Y" <?php if($isphotoflag=='Y'){ echo 'checked'; } ?>  onclick="funcCheckDetails('isphotoflag');" style="display:none;">
              <p class="para ytti-t" for="first"><span class="numHead">5.</span>Photo&nbsp;Mismatch
                <input class="jiy " type="checkbox" name="isphotomismatch" value="Y" <?php if($PhotoMatch=='Y'){ echo 'checked'; } ?> >
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div class="form-group">
              <input class="jiy " type="checkbox" name="issignflag" id="issignflag" value="Y" <?php if($issignflag=='Y'){ echo 'checked'; } ?>  onclick="funcCheckDetails('issignflag');"  style="display:none;">
              <p class="para ytti-t" for="first"><span class="numHead">6.</span>Signature&nbsp;Mismatch
                <input class="jiy " type="checkbox" name="issignaturemismatch" value="Y" <?php if($SignatureMatch=='Y'){ echo 'checked'; } ?> >
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first"><span class="numHead">7.</span>&nbsp;Communication Address Type
                <input class="jiy" type="checkbox" name="iscommaddressupdate" id="iscommaddressupdate" value="Y" checked  onClick="funcCheckDetails('iscommaddressupdate');">
              </p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <select name="COMMADDRESS" id="AddressType" class="form-control inputborder inputtyodr" onChange="getval(this.value);" required >
                <option value="">Select</option>
                <?php
if($ApplicationStatus=="C" || $ApplicationStatus=="F" || $ApplicationStatus=="E" || $ApplicationStatus=="T" || $ApplicationStatus=="L" || $ApplicationStatus=="G"){
?>
                <option value="O" <?php if($AddressType=='O'){ echo 'selected'; } ?>>Office</option>
                <?php }else{ ?>
                <option value="O" <?php if($AddressType=='O'){ echo 'selected'; } ?>>Office</option>
                <option value="R" <?php if($AddressType=='R'){ echo 'selected'; } ?>>Residence</option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <label id="addFieldError" style="display:none; color: red;"></label>
      <div id="ResidenceAddress" style="display:block;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <h5 class="para br-ffr" style="text-decoration:underline;" for="first">Address</h5>
                <label id="addFieldError" style="display:none; color: red;"></label>
              </div>
            </div>
            <div class="col-md-12">
              <div id="isForeignDiv">
                <div class="col-md-5" style="max-width: 32%;">
                  <p class="para" for="first">Is Foreign Address</p>
                </div>
                <div class="col-md-7">
                  <input type="radio" class="js-trek" name="isotherresi" <?php if($isResiForeign=='Y'){ echo 'Checked'; }  ?> value="Y" onChange="funcIsForeignAddRes('<?php echo $COMADDRESSTYPE; ?>');" >
                  Y
                  &nbsp;&nbsp;&nbsp;
                  <input type="radio" class="js-trek"  name="isotherresi" <?php if($isResiForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddRes('<?php echo $COMADDRESSTYPE; ?>');"  >
                  N </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">Flat/Room/Door/Block No.</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr fieldAddress notEqualToClass" name="resiflatorblockno" value="<?php if($FlatDoorBlock!=''){ echo trim($FlatDoorBlock); } ?>"  id="FlatDoorBlock" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="FlatDoorBlockError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">Name of Premises/Building/Village</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr fieldAddress notEqualToClass" name="resibuildingorvillage"  value="<?php if($BuildingPremises!=''){ echo trim($BuildingPremises); } ?>"  id="BuildingPremises" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="BuildingPremisesError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">Road/Street/Lane/Post office</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr fieldAddress notEqualToClass" name="resipostoffice" value="<?php if($RoadStreetLane!=''){ echo trim($RoadStreetLane); } ?>"  id="RoadStreetLane" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="RoadStreetLaneError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">Area/Locality/Taluka/Sub-Division</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr fieldAddress notEqualToClass" name="resiareasubdivision" value="<?php if($AreaLocalityTaluka!=''){ echo trim($AreaLocalityTaluka); } ?>" id="AreaLocalityTaluka" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">Town/City/District</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr" name="resitownorcountry" id="TownCityDistrict"  value="<?php if($TownCityDistrict!=''){ echo trim($TownCityDistrict[0]); } ?>" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="TownCityDistrictError" style="display:none; color: red;"></label>
                <input type="hidden" name="" value="<?php if($TownCityDistrict!=''){ echo trim($data['recordlist']['resitownorcountry']); } ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">State Union Territory</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <select class="form-control inputborder inputtyodr" name="resistatecode" id="StateUnion"  onChange="funcChangeStateRes(this.value,'<?php echo $COMADDRESSTYPE; ?>');funcGetResStateVal(this.value);" >
                  <option value="">Select</option>
                  <?php
$StateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$StateJson = json_decode($StateJson,true);
foreach($StateJson['List'] as $StateData){

if($StateData['Code']!='99'){
?>
                  <option value="<?php echo $StateData['Code']; ?>" <?php if($StateData['Code']==$StateUnion){ echo 'selected'; }?>  ><?php echo $StateData['Name']; ?></option>
                  <?php } } ?>
                  <option value="99" <?php if($Zip==999999){ echo 'selected'; } ?>  >FOREIGN ADDRESS</option>
                  <option value="99" <?php if($Zip==888888){ echo 'selected'; } ?>  >ADDRESS OF DEFENCE EMPLOYEES</option>
                </select>
                <input type="hidden" name="resistatecode" id="hiddenresistatecode" value="" >
                <label id="StateUnionError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">PIN/ZIP Code</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr" name="resipincode"  value="<?php echo $Zip; ?>" id="Zip" maxlength="6" >
                <input type="text" class="form-control inputborder fg-gt" name="resizipcode" value="<?php echo $TownCityDistrict[2]; ?>" id="NewZip"  style="display: none;" maxlength="7" onKeyDown="upperCaseF(this)">
                <label id="ZipError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="foreigncountryrsdDiv" style="display:none;" >
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <p class="para" for="first">Country</p>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <select class="form-control inputborder fg-gt" name="foreigncountryrsd" id="foreigncountryrsd">
                <option value="">Select</option>
                <?php
$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
$CountryJson = json_decode($CountryJson,true);
foreach($CountryJson['List'] as $CountryData){
?>
                <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$TownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                <?php } ?>
              </select>
              <label id="StateUnionError" style="display:none; color: red;"></label>
            </div>
          </div>
          <!--  col-md-6   -->
        </div>
      </div>
      <script>
function funcChangeStateRes(stateid,COMADDRESSTYPE){
var indianOther = COMADDRESSTYPE;
var isForeignFlag = $("input:radio[name=isotherresi]:checked").val();
if(stateid=='99' && isForeignFlag=='N'){
$('#Zip').val("888888");
}
}
funcChangeStateRes('<?php echo $StateUnion; ?>','<?php echo $COMADDRESSTYPE; ?>');

function funcIsForeignAddRes(COMADDRESSTYPE){

var isForeign = $("input:radio[name=isotherresi]:checked").val();

if(isForeign=='Y'){
$('#foreigncountryrsdDiv').css('display','block');
$('#NewZip').css('display','block');
$('#Zip').css('display','none');
$('#Zip').val("999999");
$("#StateUnion").val('99').change();
$("#StateUnion").attr('disabled',true);
}else{
$('#foreigncountryrsdDiv').css('display','none');
$('#NewZip').css('display','none');
$('#Zip').css('display','block');
$('#Zip').val("<?php echo $Zip; ?>");
<?php if($Zip!='888888'){ ?>
$("#StateUnion").val('<?php echo $StateUnion;  ?>').change();
<?php } ?>
$("#StateUnion").removeAttr('disabled');
}
}
funcIsForeignAddRes('<?php echo $COMADDRESSTYPE; ?>');
function funcGetResStateVal(sid){
var sidn = $('#StateUnion').val();
$('#hiddenresistatecode').val(sidn);
}
funcGetResStateVal(<?php echo $StateUnion;  ?>);
</script>
      <div id="OfficeAddress" style="" class="OfficeAddress">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <h5 class="para br-ffr" style="text-decoration:underline;" for="first">Address</h5>
                <!-- <input class="jiy" type="checkbox" name="OffDetails" id="OffDetails" value="1" onClick="CheckOfficeDetails();" <?php if($OFlatDoorBlock!=''){ echo 'checked'; } ?> > -->
              </div>
            </div>
            <div class="col-md-7">
              <div id="isForeignDivOff" style="margin-bottom: 20px;">
                <div class="col-md-5" style="max-width: 32%;">
                  <p class="para" for="first">Is Foreign Address </p>
                </div>
                <div class="col-md-7">
                  <input type="radio" class="js-trek" name="isotheroffce" <?php if($isOffceForeign=='Y'){ echo 'Checked'; }  ?>  value="Y" onChange="funcIsForeignAddOff('<?php echo $COMADDRESSTYPE; ?>');"  >
                  Y
                  &nbsp;&nbsp;&nbsp;
                  <input type="radio" class="js-trek"  name="isotheroffce" <?php if($isOffceForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddOff('<?php echo $COMADDRESSTYPE; ?>');"     >
                  N </div>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Name of office</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr" name="OFFICENAME"  value="<?php if($NameOffice!=''){ echo trim($NameOffice); } ?>" id="NameOffice" maxlength="75">
              </div>
              <label id="NameOfficeError" style="display:none; color: red;"></label>
            </div>
            <!--col-md-6 -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> Flat/Room/Door/Block No.</p>
                <label id="FieldError" style="display:none; color: red;"></label>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr field notEqualToClass" name="officeflatorblock" value="<?php if($OFlatDoorBlock!=''){ echo trim($OFlatDoorBlock); } ?>"  id="OFlatDoorBlock" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="OFlatDoorBlockError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> Name of Premises/Building/Village</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr field notEqualToClass" name="officebuildingorvillage"  value="<?php if($OBuildingPremises!=''){ echo trim($OBuildingPremises); } ?>"  id="OBuildingPremises" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="OBuildingPremisesError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> Road/Street/Lane/Post office</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr field notEqualToClass" name="officestreeorpostoffice" value="<?php if($ORoadStreetLane!=''){ echo trim($ORoadStreetLane); } ?>"  id="ORoadStreetLane" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="ORoadStreetLaneError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> Area/Locality/Taluka/Sub-Division</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr field notEqualToClass" name="officeareaorsubdivision" value="<?php if($OAreaLocalityTaluka!=''){ echo trim($OAreaLocalityTaluka); } ?>"  id="OAreaLocalityTaluka" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="OAreaLocalityTalukaError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> Town/City/District</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr" name="officetownorcontry" id="OTownCityDistrict"  value="<?php if($OTownCityDistrict!=''){ echo trim($OTownCityDistrict[0]); } ?>" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="OTownCityDistrictError" style="display:none; color: red;"></label>
                <input type="hidden" name="" value="<?php if($OTownCityDistrict!=''){ echo trim($data['recordlist']['officetownorcontry']); } ?>">
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> State Union Territory</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <select class="form-control inputborder inputtyodr" name="officestatecode" id="OStateUnion"  onChange="funcChangeStateOff(this.value,'<?php echo $COMADDRESSTYPE; ?>');funcGetOfsStateVal(this.value);">
                  <option value="">Select</option>
                  <?php
$OStateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$OStateJson = json_decode($OStateJson,true);
foreach($OStateJson['List'] as $OStateData){

if($OStateData['Code']!='99'){
?>
                  <option value="<?php echo $OStateData['Code']; ?>" <?php if($OStateData['Code']==$OStateUnion){ echo 'selected'; }?> ><?php echo $OStateData['Name']; ?></option>
                  <?php } } ?>
                  <option value="99" <?php if($OZip==999999){ echo 'selected'; } ?>  >FOREIGN ADDRESS</option>
                  <option value="99" <?php if($OZip==888888){ echo 'selected'; } ?>  >ADDRESS OF DEFENCE EMPLOYEES</option>
                </select>
                <input type="hidden" name="officestatecode" id="hiddenofficestatecode" value="" >
                <label id="OStateUnionError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> PIN/ZIP Code</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control inputborder inputtyodr fg-gt " name="officepincode"  value="<?php echo $OZip; ?>" id="OZip" maxlength="6" >
                <input type="text" class="form-control inputborder" name="officezipcode" value="<?php echo $OTownCityDistrict[2]; ?>" id="NewOZip"  style="display: none;" maxlength="7" onKeyDown="upperCaseF(this)">
                <label id="OZipError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
        </div>
        <div id="foreigncountryofsDiv" style="display:none;" >
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first">Country</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <select class="form-control inputborder fg-gt" name="foreigncountryofs" id="foreigncountryofs">
                  <option value="">Select</option>
                  <?php
$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
$CountryJson = json_decode($CountryJson,true);
foreach($CountryJson['List'] as $CountryData){
?>
                  <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$OTownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                  <?php } ?>
                </select>
                <label id="StateUnionError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
        </div>
      </div>
      <script>
function funcChangeStateOff(stateid,COMADDRESSTYPE){
var indianOther = COMADDRESSTYPE;
var isForeignof = $("input:radio[name=isotheroffce]:checked").val();
if(stateid=='99' && isForeignof=='N'){
$('#OZip').val("888888");
}
}
funcChangeStateOff('<?php echo $OStateUnion; ?>','<?php echo $COMADDRESSTYPE; ?>');

function funcIsForeignAddOff(COMADDRESSTYPE){
var isForeign = $("input:radio[name=isotheroffce]:checked").val();
if(isForeign=='Y'){

$('#foreigncountryofsDiv').css('display','block');
$('#NewOZip').css('display','block');
$('#OZip').css('display','none');
$('#OZip').val("999999");
$("#OStateUnion").val('99').change();
$("#OStateUnion").attr('disabled',true);

}else{
$('#foreigncountryofsDiv').css('display','none');
$('#NewOZip').css('display','none');
$('#OZip').css('display','block');
$('#OZip').val("<?php echo $OZip; ?>");
<?php if($OZip!='888888'){ ?>
$("#OStateUnion").val('<?php echo $OStateUnion; ?>').change();
<?php } ?>
$("#OStateUnion").removeAttr('disabled');
}
}

funcIsForeignAddOff('<?php echo $COMADDRESSTYPE; ?>');


function funcGetOfsStateVal(sid){
var sidd = $('#OStateUnion').val();
$('#hiddenofficestatecode').val(sidd);
}
funcGetOfsStateVal(<?php echo $OStateUnion;  ?>);

</script>
      <h5 class="para br-ffr" for="first"><span class="numHead">8.</span>&nbsp;Address for Other
        <input class="jiy" type="checkbox" name="isanotheraddressupdate" id="isanotheraddressupdate" value="Y" <?php if($isanotheraddressupdate=='Y'){ echo 'checked'; } ?> onClick="checkcommunication();" onKeyDown="upperCaseF(this)">
      </h5>
      <div id="cloneadd"></div>
      <div id="repDetailsDiv" style="display:none;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <p class="para" for="first"> Is&nbsp;Foreign&nbsp;Address</p>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="radio" class="jiy" name="isotherrep" <?php if($isRepForeign=='Y'){ echo 'Checked'; }  ?> value="Y" onChange="funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');"   >
                Y
                &nbsp;&nbsp;&nbsp;
                <input type="radio" class="jiy"  name="isotherrep"  <?php if($isRepForeign=='N'){ echo 'Checked'; }  ?> value="N" onChange="funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');" >
                N </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div  id="Roffice">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <p class="para" for="first">Office Name</p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control inputborder field" name="RNameOffice"  value="<?php if($RNameOffice!=''){ echo trim($RNameOffice); } ?>" id="RNameOffice" maxlength="75" >
                  <label id="RNameOfficeError" style="display:none; color: red;"></label>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Flat/Room/Door/Block No.</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder field notEqualToClass" name="raflatorblock" value="<?php if($RFlatDoorBlock!=''){ echo trim($RFlatDoorBlock); } ?>"  id="RFlatDoorBlock" maxlength="25"  onKeyDown="upperCaseF(this)">
                <label id="RFlatDoorBlockError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Name of Premises/Building/Village</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder field notEqualToClass" name="rabuildingorvillage"  value="<?php if($RBuildingPremises!=''){ echo trim($RBuildingPremises); } ?>" id="RBuildingPremises" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="RBuildingPremisesError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Road/Street/Lane/Post office</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder field notEqualToClass" name="streetorpostoffice" value="<?php if($RRoadStreetLane!=''){ echo trim($RRoadStreetLane); } ?>" id="RRoadStreetLane" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="RRoadStreetLaneError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Area/Locality/Taluka/Sub-Division</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder field notEqualToClass" name="raareasubdivision" value="<?php if($RAreaLocalityTaluka!=''){ echo trim($RAreaLocalityTaluka); } ?>" id="RAreaLocalityTaluka" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="RAreaLocalityTalukaError" style="display:none; color: red;"></label>
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Town/City/District</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder" name="ratownorcountry" id="RTownCityDistrict"  value="<?php if($RTownCityDistrict!=''){ echo trim($RTownCityDistrict[0]); } ?>" maxlength="25" onKeyDown="upperCaseF(this)">
                <label id="RTownCityDistrictError" style="display:none; color: red;"></label>
                <input type="hidden" name="" value="<?php if($RTownCityDistrict!=''){ echo trim($data['recordlist']['ratownorcountry']); } ?>">
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">State Union Territory</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control inputborder" name="rastatecode" id="RStateUnion" onChange="funcChangeStateRep(this.value,'<?php echo $COMADDRESSTYPE; ?>');funcGetRepStateVal(this.value);">
                  <option value="">Select</option>
                  <?php
$RStateJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/stateMaster_pan.json");
$RStateJson = json_decode($RStateJson,true);
foreach($RStateJson['List'] as $RStateData){
if($RStateData['Code']!='99'){
?>
                  <option value="<?php echo $RStateData['Code']; ?>" <?php if($RStateData['Code']==$RStateUnion){ echo 'selected'; }?> ><?php echo $RStateData['Name']; ?></option>
                  <?php }  } ?>
                  <option value="99" <?php if($RZip==999999){ echo 'selected'; } ?>  >FOREIGN ADDRESS</option>
                  <option value="99" <?php if($RZip==888888){ echo 'selected'; } ?>  >ADDRESS OF DEFENCE EMPLOYEES</option>
                </select>
                <input type="hidden" name="rastatecode" id="hiddenrastatecode" value="" >
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">PIN/Zip Code</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="number" class="form-control inputborder" name="rapincoe"  value="<?php echo $RZip; ?>" id="RZip" maxlength="6" >
                <label id="RZipError" style="display:none; color: red;"></label>
                <input type="text" class="form-control inputborder fg-gt" name="razipcode" value="<?php echo $RTownCityDistrict[2]; ?>" id="RepZip"  maxlength="7" style="display: none;" onKeyDown="upperCaseF(this)">
              </div>
            </div>
            <!--  col-md-6   -->
          </div>
          <div id="foreigncountryrepDiv" style="display:none;" >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <p class="para" for="first">Country</p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <select class="form-control inputborder" name="foreigncountryrep" id="foreigncountryrep">
                    <option value="">Select</option>
                    <?php
$CountryJson = file_get_contents($serverurlapi."Dashboards/masterscache/countryMaster_pan.json");
$CountryJson = json_decode($CountryJson,true);
foreach($CountryJson['List'] as $CountryData){
?>
                    <option value="<?php echo $CountryData['Code']; ?>" <?php if($CountryData['Code']==$RTownCityDistrict[1]){ echo 'selected'; }?> ><?php echo $CountryData['Name']; ?></option>
                    <?php } ?>
                  </select>
                  <label id="countryError" style="display:none; color: red;"></label>
                </div>
              </div>
              <!--  col-md-6   -->
            </div>
          </div>
        </div>
      </div>
      <script>
function funcChangeStateRep(stateid,COMADDRESSTYPE){
var indianOther = COMADDRESSTYPE;
var isForeign = $("input:radio[name=isotherrep]:checked").val();
if(stateid=='99' && isForeign=='N'){
$('#RZip').val("888888");
}
}
funcChangeStateRep('<?php echo $RStateUnion; ?>','<?php echo $COMADDRESSTYPE; ?>');

function funcIsForeignAddRep(COMADDRESSTYPE){
//var isForeign = $('#ratitlecode').val();
//isForeign = $.trim(isForeign);
var isForeign = $("input:radio[name=isotherrep]:checked").val();
var isMinor = "<?php echo $isminor;  ?>";
if((isMinor=='' && isForeign=='Y') ||  (isMinor=='M' && isForeign=='Y')){
$('#foreigncountryrepDiv').css('display','block');
$('#RepZip').css('display','block');
$('#RZip').css('display','none');
$('#RZip').val("999999");
$("#RStateUnion").val('99').change();
$("#RStateUnion").attr('disabled',true);
}else{
$('#foreigncountryrepDiv').css('display','none');
$('#RepZip').css('display','none');
$('#RZip').css('display','block');
$('#RZip').val("<?php echo $RZip; ?>");
<?php if($RZip!='888888'){ ?>
$("#RStateUnion").val('<?php echo $RStateUnion; ?>').change();
<?php } ?>
$("#RStateUnion").removeAttr('disabled');
}
}
funcIsForeignAddRep('<?php echo $COMADDRESSTYPE; ?>');
function funcGetRepStateVal(sid){
var sidd1 = $('#RStateUnion').val();
$('#hiddenrastatecode').val(sidd1);
}
funcGetRepStateVal(<?php echo $RStateUnion;  ?>);

</script>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <p class="para" for="first"><span class="numHead">9.</span>&nbsp;Mobile/Telephone
                <input class="jiy" type="checkbox" name="istelephoneemailupdate" id="istelephoneemailupdate" value="Y" <?php if($istelephoneemailupdate=='Y'){ echo 'checked'; } ?> onClick="funcCheckDetails('istelephoneemailupdate');">
              </p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <select name="countryisd" id="CountryCode" class="form-control inputborder inputtyodr">
                <option value="91">+91</option>
                <?php
$CountryCodeJosn = file_get_contents("".$serverurlapi."Dashboards/masterscache/ISDcodeMaster_pan.json");
$CountryCodeJosn = json_decode($CountryCodeJosn,true);
foreach($CountryCodeJosn['List'] as $CountryCodeData){
?>
                <option value="<?php echo $CountryCodeData['Code']; ?>" <?php if($CountryCodeData['ISDcode']==$CountryCode){ echo 'selected'; }?> ><?php echo '+'.$CountryCodeData['ISDcode']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="number" name="STDCODE" id="StdCode" class="form-control inputborder inputtyodr " value="<?php  if($StdCode!='' && $StdCode!=0){ echo $StdCode; } ?>" placeholder="Std Code" onKeyDown="upperCaseF(this)" onBlur="return validateForm9();" >
              <label id="" style="display:none; color: red;"></label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="number" name="TELPHONE" id="MobileNumber" class="form-control inputborder inputtyodr " value="<?php  echo $MobileNumber; ?>" placeholder="Enter Number" onBlur="return validateForm9();" >
              <label id="MobileNumberError" style="display:none; color: red;"></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <p class="para" for="first">Email</p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="email" name="EMAIL" id="Email" class="form-control inputborder yter " value="<?php echo $Email; ?>" style="width: 100%;" onKeyDown="upperCaseF(this)" onBlur="return validateForm9email();">
              <label id="EmailError" style="display:none; color: red;"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead">10.</span>Aadhar No</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder" name="ADHARNUM" value="<?php echo $Aadhar; ?>" id="AadhaarNumber"  maxlength="12" onKeyDown="upperCaseF(this)"  readonly >
                <label id="AadhaarNumberError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Aadhar Flag</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <select name="adharflag" class="form-control inputborder" id="AadharVarification"  disabled style="color:#747676;border-color: #b8b8bd;" >
                  <option value="">Select</option>
                  <option value="0" <?php if($AadharVarification=='0'){ echo 'selected'; } ?>>Not Mentined in application</option>
                  <option value="1" <?php if($AadharVarification=='1'){ echo 'selected'; } ?>>Mentioned But Not successful</option>
                  <option value="2" <?php if($AadharVarification=='2'){ echo 'selected'; } ?>>Verified with UID databases</option>
                  <option value="3" <?php if($AadharVarification=='3'){ echo 'selected'; } ?>>Verified with UID databases</option>
                  <option value="4" <?php if($AadharVarification=='4'){ echo 'selected'; } ?>>Biometric Authentication</option>
                  <option value="5" <?php if($AadharVarification=='5'){ echo 'selected'; } ?>>OTP based authentication</option>
                  <option value="6" <?php if($AadharVarification=='6'){ echo 'selected'; } ?>>66% matching </option>
                  <option value="7" <?php if($AadharVarification=='7'){ echo 'selected'; } ?>>100% partial metching</option>
                  <option value="8" <?php if($AadharVarification=='8'){ echo 'selected'; } ?>>100</option>
                  <option value="9" <?php if($AadharVarification=='9'){ echo 'selected'; } ?>>Single Fingerprint</option>
                </select>
                <input type="hidden" name="adharflag" id="AadharVarification" value="<?php echo $AadharVarification; ?>" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Aadhar Enrollment</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder" name="adharenrolmentid" value="<?php echo $EnrolmentId; ?>"  id="AadhaarEnrolment" onKeyDown="upperCaseF(this)" readonly="readonly">
                <label id="AadhaarEnrolmentError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group" >
                <p class="para" for="first">Name as per aadhar</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control inputborder" name="nameasadhar" value="<?php echo $AadharName; ?>" id="AadhaarName" maxlength="100" onKeyDown="upperCaseF(this)">
                <label id="AadhaarNameError" style="display:none; color: red;"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <h4 class="para br-ffr" style="font-size: 15px" for="first"><span class="numHead">11.</span>&nbsp;Mention other Permanent Account Number (PANs) alloted to you</h4>
      <div class="form-group panclass">
        <div class="grid-box">
          <div class="">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;1</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan1" value="<?php echo $Pan1; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
          <div class="">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;2</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan2" value="<?php echo $Pan2; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
          <div class="">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;3</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan3" value="<?php echo $Pan3; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
          <div class="">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;4</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan4" value="<?php echo $Pan4; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
        </div>
      </div>
      <div class="form-group" style="margin-top: 10px; display:none;">
        <div class="grid-box">
          <div class="">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;5</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan5" value="<?php echo $Pan5; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
          <div class="" style="display:none;">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;6</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan6" value="<?php echo $Pan6; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
          <div class="" style="display:none;">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;7</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan7" value="<?php echo $Pan7; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
          <div class="" style="display:none;">
            <div class="flex">
              <p class="para rew" for="first">PAN&nbsp;8</p>
              <input type="text" class="form-control inputborder " placeholder="" name="oldpan8" value="<?php echo $Pan8; ?>" maxlength="10" onKeyDown="upperCaseF(this)">
            </div>
          </div>
        </div>
      </div>
      <div style="margin-top: 17px !important;">
        <div class="col-md-12">
          <div class="row hy-bg">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first"><span class="numHead">12.</span>Proof&nbsp;of&nbsp;Identity&nbsp;Type&nbsp;*</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control inputborder " name="POI" id="IdentityProof"  required>
                  <option value="">Select</option>
                  <?php
$IdentityProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/correctionPOI_pan.json");
$IdentityProofJsonDec = json_decode($IdentityProofJson,true);
foreach($IdentityProofJsonDec['ApplicationStatus'] as $IdentityProofJson){
if($Revised == "CR"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
if($ApplicationStatus=="P"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
$ApplicationStatusnew = "49AA";
}

}
if($IdentityProofJson['Category']==$ApplicationStatusnew){
foreach($IdentityProofJson['List'] as $IdentityProofData){
if($IdentityProofData['Name']!=''){
?>
                  <option value="<?php echo $IdentityProofData['Status']; ?>" <?php if($IdentityProofData['Status']==$POI){ echo 'selected'; }?> ><?php echo $IdentityProofData['Name']; ?></option>
                  <?php } } } } ?>
                </select>
                <label id="IdentityProofError" style="color: red; display: none;"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-12 ">
          <div class="row hy-bg">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Proof&nbsp;of&nbsp;Address&nbsp;Type&nbsp;*</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control inputborder" name="POA" id="AddressProof"  required >
                  <option value="">Select</option>
                  <?php
$AddressProofJson = file_get_contents($serverurlapi."Dashboards/masterscache/correctionPOA_pan.json");
$AddressProofJsonDec = json_decode($AddressProofJson,true);
foreach($AddressProofJsonDec['ApplicationStatus'] as $AddressProofJson){
if($Revised == "CR"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
if($ApplicationStatus=="P"){
$ApplicationStatusnew = $ApplicationStatus;
}else{
$ApplicationStatusnew = "49AA";
}
}
if($AddressProofJson['Category']==$ApplicationStatusnew){
foreach($AddressProofJson['List'] as $AddressProofData){
if($AddressProofData['Name']!=''){
?>
                  <option value="<?php echo $AddressProofData['Code']; ?>" <?php if($AddressProofData['Code']==$POA){ echo 'selected'; }?> ><?php echo $AddressProofData['Name']; ?></option>
                  <?php } }  } } ?>
                </select>
                <label id="AddressProofError" style="color: red; display: none;"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-12 ">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Proof&nbsp;of&nbsp;DOB&nbsp;Type&nbsp;*</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control inputborder" name="dobdocumentcode" id="ProofDOB" <?php  if($ApplicationStatus=="P" || $ApplicationStatus=="H"){ ?> required <?php }?> >
                  <option value="">Select</option>
                  <?php
$ProofDOBJson = file_get_contents($serverurlapi."Dashboards/masterscache/PODB_pan_49A_P.json");
$ProofDOBJsonDec = json_decode($ProofDOBJson,true);
foreach($ProofDOBJsonDec['ApplicationStatus'] as $ProofDOBJson){
if($ProofDOBJson['Category']==$ApplicationStatus){
foreach($ProofDOBJson['List'] as $ProofDOBData){
?>
                  <option value="<?php echo $ProofDOBData['Code']; ?>" <?php if($ProofDOBData['Code']==$ProofDob){ echo 'selected'; }?> ><?php echo $ProofDOBData['Name']; ?></option>
                  <?php  } } } ?>
                </select>
                <label id="ProofDOBError" style="color: red; display: none;"></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="" style=" <?php if(substr($Stage,2,3)=="QCP" || substr($Stage,2,3)=='QCF'){ ?> display:block; <?php }else{ ?> display:none; <?php  } ?>">
        <div class="col-md-12 ">
          <div class="row hy-bg">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Old&nbsp;Acknowledgment#</p>
              </div>
            </div>
            <div class="col-md-12">
              <input type="text" class="form-control inputborder " placeholder="" name="oldacknwoledmentnum" value="<?php echo $oldacknwoledmentnum; ?>" onKeyDown="upperCaseF(this)">
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Reupload&nbsp;to&nbsp;NSDL</p>
              </div>
            </div>
            <div class="col-md-12">
              <select name="reuploadedtonsdl" class="form-control inputborder" id="reuploadedtonsdl"  >
                <option value="">Select</option>
                <option value="Y" <?php if($reuploadedtonsdl=='Y'){ echo 'selected'; } ?>>Yes</option>
                <option value="N" <?php if($reuploadedtonsdl=='N'){ echo 'selected'; } ?>>No</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-12 ">
          <div class="row hy-bg">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Pan&nbsp;Proof&nbsp;Given</p>
              </div>
            </div>
            <div class="col-md-12">
              <select name="ispanproofgiven" class="form-control inputborder"   id="ispanproofgiven"  >
                <option value="">Select</option>
                <option value="C" <?php if($ispanproofgiven=='C'){ echo 'selected'; } ?>>COPY OF PAN CARD</option>
                <option value="L" <?php if($ispanproofgiven=='L'){ echo 'selected'; } ?>>LETTER OF PAN ALLOTMENT</option>
                <option value="G" <?php if($ispanproofgiven=='G'){ echo 'selected'; } ?>>GOOD EFFORT BASIS</option>
              </select>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <p class="para " for="first">Reprint&nbsp;Request</p>
              </div>
            </div>
            <div class="col-md-12">
              <select name="isreprintrequest" class="form-control inputborder"   id="isreprintrequest"  >
                <option value="Y" <?php if($isreprintrequest=='Y'){ echo 'selected'; } ?>>Yes</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-12 ">
          <div class="row hy-bg">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para " for="first">Applicant Minor/Deceased</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <select name="isminor" class="form-control inputborder" id="isminor">
                  <option value="">Select</option>
                  <option value="M" <?php if($isminor=='M'){ echo 'selected'; } ?>>Minor</option>
                  <option value="D" <?php if($isminor=='D'){ echo 'selected'; } ?>>Deceased</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <p class="para " for="first">Ack.&nbsp;Date</p>
              </div>
            </div>
            <div class="col-md-12">
              <?php
/*$date = substr($AcknowledgementDate,0,2).'-';
$month = substr($AcknowledgementDate,2,2).'-';
$year = substr($AcknowledgementDate,4,5);
$AcknowledgementDate = $date.$month.$year;*/
?>
              <div class="form-group">
                <input type="text" name="acknwoledmentdate" value="<?php echo dateFormat($AcknowledgementDate); ?>" id="acknwoledmentdate" class="form-control  inputborder " <?php if($AcknowledgementDate!=''){ ?>style="pointer-events: none;"<?php } ?>  maxlength="10" readonly="readonly">
              </div>
            </div>
            <!-- <div class="col-md-2">
<div class="form-group ks-trek">
<p class="para " for="first">Discrepancy TIN-FC&nbsp;Level</p>
</div>
</div>
<div class="col-md-3">
<select name="isdiscreattinfclevel" class="form-control inputborder chosen" id="isdiscreattinfclevel"  >
<option value="">Select</option>
<option value="Y" <?php if($isdiscreattinfclevel=='Y'){ echo 'selected'; } ?>>Yes</option>
<option value="N" <?php if($isdiscreattinfclevel=='N'){ echo 'selected'; } ?>>No</option>
</select>
</div> -->
          </div>
        </div>
      </div>
      <input type="hidden" name="isdiscreattinfclevel" value="<?php echo $isdiscreattinfclevel; ?>" />
      <?php if(($isdiscreattinfclevel=='Y' || $isdiscreattinfclevel=='1') && $_SESSION['Type']=='HOUSER'){ ?>
      <div class="">
        <div class="col-md-12 ">
          <div class="row hy-bg">
            <div class="col-md-12">
              <div class="form-group">
                <p class="para" for="first">Date of Discrepancy&nbsp;Resolution</p>
              </div>
            </div>
            <div class="col-md-12">
              <input type="text" class="form-control inputborder datepicker" name="dateofdescreresolution" value="<?php if($dateofdescreresolution!=''){ echo date('d-m-Y',strtotime($dateofdescreresolution)); } ?>" id="dateofdescreresolution" maxlength="10">
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <h4 class="para br-ffr vtd" for="first">Verification</h4>
      <div class="col-md-12 ">
        <div class="form-group verification">
          <p class="para rew" for="first">I/We</p>
          <input type="text" class="form-control" placeholder="" name="verifiername" id="VerifierName" value="<?php echo $verifiername; ?>" onKeyDown="upperCaseF(this)">
          <label id="VerifierNameError" style="color: red; display: none;"></label>
          <p class="para rew" for="first">,the&nbsp;applicant&nbsp;in&nbsp;the&nbsp;capacity&nbsp;of</p>
          <select class="form-control inputborder" name="verifiercapcitycode" id="CVerifier"  required>
            <option value="">Select</option>
            <?php
$CVerifierJson = file_get_contents("".$serverurlapi."Dashboards/masterscache/verifierMaster_pan.json");
$CVerifierJsondec = json_decode($CVerifierJson,true);
foreach($CVerifierJsondec['ApplicationStatus'] as $CVerifierJson){

if($CVerifierJson['Category']==$ApplicationStatus){
foreach($CVerifierJson['List'] as $CVerifierData){
?>
            <option value="<?php echo $CVerifierData['Code']; ?>" <?php if($CVerifierData['Code']==$verifiercapcitycode){ echo 'selected'; }?> ><?php echo $CVerifierData['Name']; ?></option>
            <?php } } } ?>
          </select>
          <label id="CVerifierError" style="color: red; display: none;"></label>
          <p class="para rew" for="first">do&nbsp;hereby declare that what is stated above is true to the best of my/our information and belief.</p>
        </div>
        <div class="form-group">
          <p class="para rew" style="display: flex;" for="first">I/We&nbsp;have&nbsp;enclosed&nbsp;&nbsp;
            <input type="text" class="form-control  cx-jh" placeholder="" name="numofsupporteddoc" id="Enclosed" value="<?php echo $Enclosed; ?>" onKeyDown="upperCaseF(this)">
            &nbsp;&nbsp;(number of document) in support of proposed changes/corrections</p>
        </div>
      </div>
      <div class="">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first" style="margin-left: 20px">Place</p>
              </div>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control " placeholder="" name="verificationplace" id="VerifierPlace" value="<?php echo $verificationplace; ?>" onKeyDown="upperCaseF(this)">
              <label id="VerifierPlaceError" style="color: red; display: none;"></label>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <p class="para" for="first" style="margin-left: 20px">Date of Verification </p>
              </div>
            </div>
            <?php
/*if($verificationdate!=''){
$date = substr($verificationdate,0,2).'-';
$month = substr($verificationdate,2,2).'-';
$year = substr($verificationdate,4,5);
$verificationdate = $date.$month.$year;
}*/

?>
            <div class="col-md-9">
              <p class="para" for="first">
                <input type="text" name="verificationdate" value="<?php echo dateFormat($verificationdate); ?>" id="verificationdate" class="form-control datepicker inputborder datepicker"  maxlength="10" >
              </p>
            </div>
          </div>
        </div>
      </div>

      <input type="hidden" name="action" value="dataentryformcr">
      <input type="hidden" name="AcknowledgementNumber" value="<?php echo $AcknowledgementNumber; ?>">
      <input type="hidden" name="formtype" value="<?php echo $Revised; ?>">
      <input type="hidden" name="ApplicationStatus" id="ApplicationStatus" value="<?php echo $ApplicationStatus; ?>">
      <input type="hidden" name="modeofapplication" value="T">
      <input type="hidden" name="VID" value="">
      <input type="hidden" name="uidtocken" value="">
      <input type="hidden" name="adharref" value="">
      <div class="nxrt" style="width: fit-content; display:none; "><a href="#" class="previous"><i class="fa fa-angle-left" ></i> Back</a>
        <button type="submit" id="formsubmit" class="next"> Save and move to next section <i class="fa fa-angle-right" ></i></button>
      </div>
    </form>
 	 </div>
  </section>
</div>
</div>
</div>
</div>
</div>
<!--<script src="js/cr-validation.js"></script>-->
<script type="text/javascript">
$('#dataentry1').submit(function() {
	//var dateofdescreresolution = $('#dateofdescreresolution').val();
	var isdiscreattinfclevel = '<?php echo $isdiscreattinfclevel; ?>';
	if(isdiscreattinfclevel=='1' || isdiscreattinfclevel=='Y'){
	//return confirm('Are you sure you want to add descreresolution date?');
   var status = confirm("Are you sure you want to add descreresolution date?");
   if(status == false){
   return false;
   }
   else{
   return true;
   }
}
  });
</script>
<script>
$( function() {
$( ".datepicker" ).datepicker({
dateFormat: 'dd-mm-yy',
maxDate: 0
});
} );

</script>
<script>
if($('#ApplicationStatus').val()!='P'){
	$('#MiddleName').attr('readonly', true);
	$('#FirstName').attr('readonly', true);
	$('#ApplicantFatherLastName').attr('readonly', true);
	$('#ApplicantFatherFirstName').attr('readonly', true);
	$('#ApplicantFatherMiddleName').attr('readonly', true);
	$('#ApplicantMotherLastName').attr('readonly', true);
	$('#ApplicantMotherFirstName').attr('readonly', true);
	$('#ApplicantMotherMiddleName').attr('readonly', true);
}

/*$('#AadhaarEnrolment').on('keypress',function(){
var mobNum = $(this).val();
var filter = /^\d*(?:\.\d{1,2})?$/;

if (filter.test(mobNum)) {
if(mobNum.length==14){
$('#AadhaarEnrolmentError').hide();
} else {

$('#AadhaarEnrolmentError').show();
$('#AadhaarEnrolmentError').text('Please put 14  digit mobile number');
return false;
}

}
else {

$('#AadhaarEnrolmentError').show();
$('#AadhaarEnrolmentError').text('Not a valid number');
return false;

}

}*/

</script>
<?php include 'footer.php'; ?>
<script src="js/document_cr_validateform.js"></script>
<script type="text/javascript">
$(".chosen").chosen();
</script>
<script>
$(document).ready(function(){
	$('input').focus(function(){
		$(this).attr('autocomplete', 'nope');
	});
});
</script>
<script type="text/javascript">
function getval(value){
//var addrval = value;
if(value=='R'){
$("#ResidenceAddress").css('display','block');
$("#OfficeAddress").css('display','none');
$("#Roffice").css('display','block');
}else if(value=='O'){
$("#OfficeAddress").css('display','block');
$("#ResidenceAddress").css('display','none');
$("#Roffice").css('display','none');
}else{
$("#ResidenceAddress").css('display','none');
$("#OfficeAddress").css('display','none');
}
}
getval('<?php echo $AddressType; ?>');

function checkcommunication(){
var checkValue1 = $('#isanotheraddressupdate').is(':checked');
if(checkValue1==true){
$("#repDetailsDiv").css('display','block');
}
else{
$("#repDetailsDiv").css('display','none');
}
}
checkcommunication();

var ApplicationStatus = '<?= $ApplicationStatus; ?>';
if(ApplicationStatus=='C' || ApplicationStatus=='F' || ApplicationStatus=='E' || ApplicationStatus=='T' || ApplicationStatus=='L' || ApplicationStatus=='G' ){
$('#isanotheraddressupdate').attr('disabled', true);

}
/*if(ApplicationStatus=='P' || ApplicationStatus=='A' || ApplicationStatus=='H' || ApplicationStatus=='B' || ApplicationStatus=='J'){
$("#AddressType").val('R').change();
$("#ResidenceAddress").css('display','block');
$("#OfficeAddress").css('display','none');

var isanotheraddressupdate = '<?= $isanotheraddressupdate; ?>';
if(isanotheraddressupdate=='Y'){
//$('#OfficeAddress').css('display','block');
}
}
else if(ApplicationStatus=='F' || ApplicationStatus=='E' || ApplicationStatus=='C' || ApplicationStatus=='L' || ApplicationStatus=='G' || ApplicationStatus=='T'){
$("#AddressType").val('O').change();
$("#ResidenceAddress").css('display','none');
$("#OfficeAddress").css('display','block');
}*/

var isnamecr= '<?= $isnamecr; ?>';
var isfathernamecr= '<?= $isfathernamecr; ?>';
var ismothernamecr= '<?= $ismothernamecr; ?>';
var isdobupdateflag= '<?= $isdobupdateflag; ?>';
var iscommaddressupdate= '<?= $iscommaddressupdate; ?>';
var istelephoneemailupdate= '<?= $istelephoneemailupdate; ?>';

/*if(isnamecr=='Y'){
$('.isnamecrCls').removeAttr('readonly','readonly');
}
else{
$('.isnamecrCls').attr('readonly','readonly');
}
if(ismothernamecr=='Y'){
$('.isfathernamecrCls').removeAttr('readonly','readonly');
}
else{
$('.isfathernamecrCls').attr('readonly','readonly');
}
if(isfathernamecr=='Y'){
$('.ismothernamecrCls').removeAttr('readonly','readonly');
}
else{
$('.ismothernamecrCls').attr('readonly','readonly');
}
if(isdobupdateflag=='Y'){
$('.isdobupdateflagCls').removeAttr('readonly','readonly');
}
else{
$('.isdobupdateflagCls').attr('readonly','readonly');
}
if(istelephoneemailupdate=='Y'){
$('.').removeAttr('readonly','readonly');
}
else{
$('.istelephoneemailupdateCls').attr('readonly','readonly');
}
if(iscommaddressupdate=='Y'){
$('.iscommaddressupdateCls').removeAttr('readonly','readonly');
}
else{
$('.iscommaddressupdateCls').attr('readonly','readonly');
}
$('.isdobupdateflagCls').css('pointer-events','none');
*/

function funcCheckDetails(id){
/*var checkValue = $('#'+id).is(':checked');
if(checkValue==true){
$('.'+id+'Cls').removeAttr('readonly','readonly');
$('.isdobupdateflagCls').css('pointer-events','');
}else{
$('.'+id+'Cls').attr('readonly','readonly');
$('.isdobupdateflagCls').css('pointer-events','none');
}*/
}
</script>
</body>
</html>
