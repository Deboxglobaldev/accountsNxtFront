function funcCardName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var LastName = $('#LastName').val();
	var checkName = fieldVal.search(LastName);
	if(fieldVal!=""){
		if(ApplicationStatus=='P'){
			if(checkName==-1){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter last name also');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			if(fieldVal!=LastName){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Name to be printed on card as last name');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}
	}else{
		$('#'+ErrorId).show();
		$('#'+ErrorId).text('Required*');
		return false;
	}
}

function funcCheckLastName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	if(fieldVal!=''){
		if(ApplicationStatus=='P'){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,75}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 75 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}
	}else{
		$('#'+ErrorId).show();
		$('#'+ErrorId).text('Required*');
		return false;
	}
	
}

function funcCheckFirstName(fieldVal,ErrorId){
	var MiddleName = $('#MiddleName').val();
	if(fieldVal!=''){
		if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
			return false;
		}else{
			$('#'+ErrorId).hide();
		}
	}else if(MiddleName!=''){
		if(fieldVal!=''){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Required*');
			return false;
		}
	}else{
		$('#'+ErrorId).hide();
	}
}

function funcCheckMiddleName(fieldVal,ErrorId){
	var FirstName = $('#FirstName').val();
	if(fieldVal!=''){
		if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
			return false;
		}else{
			$('#'+ErrorId).hide();
		}
	}else{
		$('#'+ErrorId).hide();
	}
	
	funcCheckFirstName(FirstName,'FirstNameError');
}

function funcCheckFatherLastName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
		if(ApplicationStatus=='P'){
			if(fieldVal!=''){
				if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
					$('#'+ErrorId).show();
					$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
					return false;
				}else{
					$('#'+ErrorId).hide();
				}
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			$('#'+ErrorId).hide();
		}
}

function funcCheckFatherFirstName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var MiddleNameOther = $('#ApplicantFatherMiddleName').val();
	if(ApplicationStatus=='P'){
		if(fieldVal!=''){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else if(MiddleNameOther!=''){
			if(fieldVal!=''){
				if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
					$('#'+ErrorId).show();
					$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
					return false;
				}else{
					$('#'+ErrorId).hide();
				}
			}else{
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Required*');
				return false;
			}
		}else{
			$('#'+ErrorId).hide();
		}
	}else{
		$('#'+ErrorId).hide();
	}
	
}

function funcCheckFatherMiddleName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var FirstNameOther = $('#ApplicantFatherFirstName').val();
	if(ApplicationStatus=='P'){
		if(fieldVal!=''){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			$('#'+ErrorId).hide();
		}
		
		funcCheckFatherFirstName(FirstNameOther,'ApplicantFatherFirstNameError');
	}else{
		$('#'+ErrorId).hide();
	}
}

function funcCheckMotherLastName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
		if(ApplicationStatus=='P'){
			if(fieldVal!=''){
				if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
					$('#'+ErrorId).show();
					$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
					return false;
				}else{
					$('#'+ErrorId).hide();
				}
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			$('#'+ErrorId).hide();
		}
}

function funcCheckMotherFirstName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var MiddleNameOther = $('#ApplicantMotherMiddleName').val();
	if(ApplicationStatus=='P'){
		if(fieldVal!=''){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else if(MiddleNameOther!=''){
			if(fieldVal!=''){
				if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
					$('#'+ErrorId).show();
					$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
					return false;
				}else{
					$('#'+ErrorId).hide();
				}
			}else{
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Required*');
				return false;
			}
		}else{
			$('#'+ErrorId).hide();
		}
	}else{
		$('#'+ErrorId).hide();
	}
	
}

function funcCheckFatherMiddleName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var FirstNameOther = $('#ApplicantMotherFirstName').val();
	if(ApplicationStatus=='P'){
		if(fieldVal!=''){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			$('#'+ErrorId).hide();
		}
		
		funcCheckMotherFirstName(FirstNameOther,'ApplicantMotherFirstNameError');
	}else{
		$('#'+ErrorId).hide();
	}
}

function funcCheckRepLastName(fieldVal,ErrorId){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var ratitlecode = $('#ratitlecode').val().trim();
	if(ratitlecode!=''){
		if(fieldVal!=''){
			if(ApplicationStatus=='P'){
				if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
					$('#'+ErrorId).show();
					$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
					return false;
				}else{
					$('#'+ErrorId).hide();
				}
			}else{
				if(!fieldVal.match(/^[a-zA-Z\ \']{0,75}$/)){
					$('#'+ErrorId).show();
					$('#'+ErrorId).text('Please enter A-Z with 75 chracter only.');
					return false;
				}else{
					$('#'+ErrorId).hide();
				}
			}
		}else{
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Required*');
			return false;
		}
	}else{
		$('#'+ErrorId).hide();
	}
	
}

function funcCheckRepFirstName(fieldVal,ErrorId){
	var MiddleName = $('#ramiddlename').val();
	if(fieldVal!=''){
		if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
			return false;
		}else{
			$('#'+ErrorId).hide();
		}
	}else if(MiddleName!=''){
		if(fieldVal!=''){
			if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
				$('#'+ErrorId).show();
				$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
				return false;
			}else{
				$('#'+ErrorId).hide();
			}
		}else{
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Required*');
			return false;
		}
	}else{
		$('#'+ErrorId).hide();
	}
}

function funcCheckRepMiddleName(fieldVal,ErrorId){
	var FirstName = $('#rafistname').val();
	if(fieldVal!=''){
		if(!fieldVal.match(/^[a-zA-Z\ \']{0,25}$/)){
			$('#'+ErrorId).show();
			$('#'+ErrorId).text('Please enter A-Z with 25 chracter only.');
			return false;
		}else{
			$('#'+ErrorId).hide();
		}
	}else{
		$('#'+ErrorId).hide();
	}
	
	funcCheckRepFirstName(FirstName,'rafistnameError');
}

function funcVerifierName(){
	var VerifierName = $('#VerifierName').val();
	if(VerifierName==''){
		$('#VerifierNameError').show();
		$('#VerifierNameError').text('Required*');
		return false;
	}else{
		$('#VerifierNameError').hide();
	}
	if(VerifierName!=''){
		if(!VerifierName.match(/^[a-zA-Z'. ]+$/)){
			$('#VerifierNameError').show();
			$('#VerifierNameError').text('Characters must be alphabet.');
			return false;
		}else{
			$('#VerifierNameError').hide();
		}
	}else{
		$('#VerifierNameError').hide();
	}
	
	if(VerifierName!=''){
		if(VerifierName.length>75){
			$('#VerifierNameError').show();
			$('#VerifierNameError').text('Name should be 75 digit long.');	
		}
		else{
			$('#VerifierNameError').hide();
		}
	}else{
		$('#VerifierNameError').hide();
	}
}

function funcVerifierPlace(){
	var VerifierPlace = $('#VerifierPlace').val();
	if(VerifierPlace==''){
		$('#VerifierPlaceError').show();
		$('#VerifierPlaceError').text('Required*');
		return false;
	}else{
		$('#VerifierPlaceError').hide();
	}
	
	if(VerifierPlace!=''){
		if(!VerifierPlace.match(/^[a-zA-Z ]+$/)){
			$('#VerifierPlaceError').show();
			$('#VerifierPlaceError').text('Please enter A-Z chracter only.');
			return false;
		}else{
			$('#VerifierPlaceError').hide();
		}
	}else{
		$('#VerifierPlaceError').hide();
	}
	
	if(VerifierPlace!=''){
		if(VerifierPlace.length>30){
			$('#VerifierPlaceError').show();
			$('#VerifierPlaceError').text('Name should be 25 digit long.');
			return false;
		}else{
			$('#VerifierPlaceError').hide();
		}
	}else{
		$('#VerifierPlaceError').hide();
	}
}

function validateForm(){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var AcknowledgementNumber = $('#AcknowledgementNumber').val();
	var AddressType = $('#AddressType').val();
	
	var FlatDoorBlock = $('#FlatDoorBlock').val();
	var BuildingPremises = $('#BuildingPremises').val();
	var RoadStreetLane = $('#RoadStreetLane').val();
	var AreaLocalityTaluka = $('#AreaLocalityTaluka').val();
	var TownCityDistrict = $('#TownCityDistrict').val();
	var StateUnion = $('#StateUnion').val();
	var Zip = $('#Zip').val();
	var NewZip = $('#NewZip').val();
	
	var NameOffice = $('#NameOffice').val();
	var OFlatDoorBlock = $('#OFlatDoorBlock').val();
	var OBuildingPremises = $('#OBuildingPremises').val();
	var ORoadStreetLane = $('#ORoadStreetLane').val();
	var OAreaLocalityTaluka = $('#OAreaLocalityTaluka').val();
	var OTownCityDistrict = $('#OTownCityDistrict').val();
	var OStateUnion = $('#OStateUnion').val();
	var OZip = $('#OZip').val();
	var NewOZip = $('#NewOZip').val();
	
	var RFlatDoorBlock = $('#RFlatDoorBlock').val();
	var RBuildingPremises = $('#RBuildingPremises').val();
	var RRoadStreetLane = $('#RRoadStreetLane').val();
	var RAreaLocalityTaluka = $('#RAreaLocalityTaluka').val();
	var RTownCityDistrict = $('#RTownCityDistrict').val();
	var RStateUnion = $('#RStateUnion').val();
	var RZip = $('#RZip').val();
	var RepZip = $('#RepZip').val();
	
	var IdentityProof = $('#IdentityProof').val();
	var AddressProof = $('#AddressProof').val();
	var ProofDOB = $('#ProofDOB').val();
	var VerifierName = $('#VerifierName').val();
	var CVerifier = $('#CVerifier').val();
	var VerifierPlace = $('#VerifierPlace').val();
	
	if(ApplicationStatus!='P'){
		$('#MiddleName').attr('readonly', true);
		$('#FirstName').attr('readonly', true);
		$('#ApplicantFatherLastName').attr('readonly', true);
		$('#ApplicantFatherFirstName').attr('readonly', true);
		$('#ApplicantFatherMiddleName').attr('readonly', true);
		$('#ApplicantMotherLastName').attr('readonly', true);
		$('#ApplicantMotherFirstName').attr('readonly', true);
		$('#ApplicantMotherMiddleName').attr('readonly', true);
	}else{
		$('#MiddleName').attr('readonly', false);
		$('#FirstName').attr('readonly', false);
		$('#ApplicantFatherLastName').attr('readonly', false);
		$('#ApplicantFatherFirstName').attr('readonly', false);
		$('#ApplicantFatherMiddleName').attr('readonly', false);
		$('#ApplicantMotherLastName').attr('readonly', false);
		$('#ApplicantMotherFirstName').attr('readonly', false);
		$('#ApplicantMotherMiddleName').attr('readonly', false);
	}
	
	if(AddressType==''){
		$('#AddressTypeError').show();
		$('#AddressTypeError').text('Required*');
		return false;
	}else{
		$('#AddressTypeError').hide();
	}
	
	if(FlatDoorBlock!=''){
		if(FlatDoorBlock.length>25){
			$('#FlatDoorBlockError').show();
			$('#FlatDoorBlockError').text('Length should be 25 chracter only.');
			return false;
		}else{
			$('#FlatDoorBlockError').hide();
		}
	}else{
		$('#FlatDoorBlockError').hide();
	}
	
	if(BuildingPremises!=''){
		if(BuildingPremises.length>25){
			$('#BuildingPremisesError').show();
			$('#BuildingPremisesError').text('Length should be 25 chracter only.');
			return false;
		}else{
			$('#BuildingPremisesError').hide();
		}
	}else{
		$('#BuildingPremisesError').hide();
	}
	
	if(RoadStreetLane!=''){
		if(RoadStreetLane.length>25){
			$('#RoadStreetLaneError').show();
			$('#RoadStreetLaneError').text('Length should be 25 chracter only.');
			return false;
		}else{
			$('#RoadStreetLaneError').hide();
		}
	}else{
		$('#RoadStreetLaneError').hide();
	}
	
	if(AreaLocalityTaluka!=''){
		if(AreaLocalityTaluka.length>25){
			$('#AreaLocalityTalukaError').show();
			$('#AreaLocalityTalukaError').text('Length should be 25 chracter only.');
			return false;
		}else{
			$('#AreaLocalityTalukaError').hide();
		}
	}else{
		$('#AreaLocalityTalukaError').hide();
	}
	
	if(TownCityDistrict!=''){
		if(TownCityDistrict.length>25){
			$('#TownCityDistrictError').show();
			$('#TownCityDistrictError').text('Length should be 25 chracter only.');
			return false;
		}else{
			$('#TownCityDistrictError').hide();
		}
	}else{
		$('#TownCityDistrictError').hide();
	}
	
	if(Zip!=''){
		if(Zip.length>6 || Zip.length<6){
			$('#ZipError').show();
			$('#ZipError').text('Length should be 6 digit.');
			return false;
		}else{
			$('#ZipError').hide();
		}
	}else{
		$('#ZipError').hide();
	}
	
	if(NewZip!=''){
		if(NewZip.length>7){
			$('#ZipError').show();
			$('#ZipError').text('Length should be 7 digit.');
			return false;
		}else{
			$('#ZipError').hide();
		}
	}else{
		$('#ZipError').hide();
	}
	
	if(NameOffice!=''){
		if(NameOffice.length>75){
			$('#NameOfficeError').show();
			$('#NameOfficeError').text('Name Of Office should be 75 digit long');
			return false;
		}
		else{
			$('#NameOfficeError').hide();	
		}
	}else{
		$('#NameOfficeError').hide();	
	}
	
	if(OFlatDoorBlock!=''){
		if(OFlatDoorBlock.length>25){
			$('#OFlatDoorBlockError').show();
			$('#OFlatDoorBlockError').text('Name should be 25 digit long');
			return false;
		}
		else{
			$('#OFlatDoorBlockError').hide();	
		}
	}else{
		$('#OFlatDoorBlockError').hide();	
	}
	
	if(OBuildingPremises!=''){
		if(OBuildingPremises.length>25){
			$('#OBuildingPremisesError').show();
			$('#OBuildingPremisesError').text('Name should be 25 digit long');
			return false;
		}
		else{
			$('#OBuildingPremisesError').hide();	
		}
	}else{
		$('#OBuildingPremisesError').hide();	
	}
	
	if(ORoadStreetLane!=''){
		if(ORoadStreetLane.length>25){
			$('#ORoadStreetLaneError').show();
			$('#ORoadStreetLaneError').text('Name should be 25 digit long');
			return false;
		}
		else{
			$('#ORoadStreetLaneError').hide();	
		}
	}else{
		$('#ORoadStreetLaneError').hide();	
	}
	
	if(OAreaLocalityTaluka!=''){
		if(OAreaLocalityTaluka.length>25){
			$('#OAreaLocalityTalukaError').show();
			$('#OAreaLocalityTalukaError').text('Name should be 25 digit long');
		}
		else{
			$('#OAreaLocalityTalukaError').hide();	
		}
	}else{
		$('#OAreaLocalityTalukaError').hide();	
	}
	
	if(OTownCityDistrict!=''){
		if(OTownCityDistrict.length>25){
			$('#OTownCityDistrictError').show();
			$('#OTownCityDistrictError').text('Name should be 25 digit long');
		}
		else{
			$('#OTownCityDistrictError').hide();	
		}
	}else{
		$('#OTownCityDistrictError').hide();	
	}
	
	if(OZip!=''){
		if(OZip.length>6 || OZip.length<6){
			$('#OZipError').show();
			$('#OZipError').text('Length should be 6 digit.');
			return false;
		}else{
			$('#OZipError').hide();
		}
	}else{
		$('#ZipError').hide();
	}
	
	if(NewOZip!=''){
		if(NewOZip.length>7){
			$('#OZipError').show();
			$('#OZipError').text('Length should be 7 digit.');
			return false;
		}else{
			$('#OZipError').hide();
		}
	}else{
		$('#ZipError').hide();
	}
	
	if(RFlatDoorBlock!=''){
		if(RFlatDoorBlock.length>25){
			$('#RFlatDoorBlockError').show();
			$('#RFlatDoorBlockError').text('Length should be 25 digit.');
			return false;	
		}
		else{
			$('#RFlatDoorBlockError').hide();	
		}
	}else{
		$('#RFlatDoorBlockError').hide();	
	}
	
	if(RBuildingPremises!=''){
		if(RBuildingPremises.length>25){
			$('#RBuildingPremisesError').show();
			$('#RBuildingPremisesError').text('Length should be 25 digit.');
			return false;	
		}
		else{
			$('#RBuildingPremisesError').hide();	
		}
	}else{
		$('#RBuildingPremisesError').hide();	
	}
	
	if(RRoadStreetLane!=''){
		if(RRoadStreetLane.length>25){
			$('#RRoadStreetLaneError').show();
			$('#RRoadStreetLaneError').text('Length should be 25 digit.');
			return false;	
		}else{
			$('#RRoadStreetLaneError').hide();	
		}
	}else{
		$('#RRoadStreetLaneError').hide();	
	}
	
	if(RAreaLocalityTaluka!=''){
		if(RAreaLocalityTaluka.length>25){
			$('#RAreaLocalityTalukaError').show();
			$('#RAreaLocalityTalukaError').text('Length should be 25 digit.');
			return false;	
		}else{
			$('#RAreaLocalityTalukaError').hide();	
		}
	}else{
		$('#RAreaLocalityTalukaError').hide();	
	}
	
	if(RTownCityDistrict!=''){
		if(RTownCityDistrict.length>25){
			$('#RTownCityDistrictError').show();
			$('#RTownCityDistrictError').text('Name should be 25 digit.');
			return false;	
		}
		else{
			$('#RTownCityDistrictError').hide();	
		}
	}else{
		$('#RTownCityDistrictError').hide();	
	}
	
	if(RZip!=''){
		if(RZip.length>6 || RZip.length<6){
			$('#RZipError').show();
			$('#RZipError').text('Length should be 6 digit.');
			return false;
		}else{
			$('#RZipError').hide();
		}
	}else{
		$('#RZipError').hide();
	}
	
	if(RepZip!=''){
		if(RepZip.length>7){
			$('#RZipError').show();
			$('#RZipError').text('Length should be 7 digit.');
			return false;
		}else{
			$('#RZipError').hide();
		}
	}else{
		$('#RZipError').hide();
	}
	
	if(IdentityProof==''){
		$('#IdentityProofError').show();
		$('#IdentityProofError').text('Required*');
		return false;
	}else{
		$('#IdentityProofError').hide();
	}
	
	if(AddressProof==''){
		$('#AddressProofError').show();
		$('#AddressProofError').text('Required*');
		return false;
	}else{
		$('#AddressProofError').hide();
	}
	
	
	if(CVerifier==''){
		$('#CVerifierError').show();
		$('#CVerifierError').text('Required*');
		return false;
	}else{
		$('#CVerifierError').hide();
	}
	
	


}

function validateForm9(){
	var StdCode = $('#StdCode').val();
	var MobileNumber = $('#MobileNumber').val();
	if(MobileNumber!=''){
		if(StdCode==''){
			$('#StdCodeError').show();
			$('#StdCodeError').text('Required*');
			return false;
		}
		else{
			if(StdCode.length>7){
				$('#StdCodeError').show();
				$('#StdCodeError').text('Length should be 7 digit.');
				return false;
			}else{
				$('#StdCodeError').hide();
			}
		}
	}
	else{
		$('#StdCodeError').hide();
	}
	
	if(StdCode!=''){
		if(MobileNumber==''){
			$('#MobileNumberError').show();
			$('#MobileNumberError').text('Required*');
			return false;
		}else{
			if(MobileNumber.length>13 || MobileNumber.length<10){
				$('#MobileNumberError').show();
				$('#MobileNumberError').text('Length should be 13 digit.');
				return false;
			}else{
				$('#MobileNumberError').hide();
			}
			
			if(!MobileNumber.match(/^[0-9][0-9]/)){
				$('#MobileNumberError').show();
				$('#MobileNumberError').text('Mobile number can not start with zero.');
				return false;
			}
			else{
				$('#MobileNumberError').hide();
			}
		}
	}else{
		$('#MobileNumberError').hide();
	}

}

function validateForm9email(){
	var Email = $('#Email').val();
	var MobileNumber = $('#MobileNumber').val();
	if(MobileNumber==""){
		$('#EmailError').show();
		$('#EmailError').text('Required*');
		return false;
	}else{
		if(Email!=''){
			if(!Email.match(/^[a-zA-Z][a-zA-Z0-9_.]*(\.[a-zA-Z][a-zA-Z0-9_.]*)?@[a-zA-Z][a-zA-Z-0-9]*\.[a-zA-Z]+(\.[a-zA-Z]+)?$/)){
				$('#EmailError').show();
				$('#EmailError').text('Required* In Proper Format');
				return false;
			}
			else{
				$('#EmailError').hide();
			}
		}else{
			$('#EmailError').hide();
		}
		
	}
	
}
