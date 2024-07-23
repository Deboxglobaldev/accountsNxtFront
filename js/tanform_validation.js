function funcCardName(LastName,CardName,ApplicationStatus){
	var checkName = CardName.search(LastName);
	if(ApplicationStatus=='P'){
		if(checkName==-1){
			$('#CardNameError').show();
        	$('#CardNameError').text('Please enter last name also');
        	return false;
		}else{
			$('#CardNameError').hide();
		}
	}else{
		if(CardName!=LastName){
			$('#CardNameError').show();
        	$('#CardNameError').text('Name to be printed on card as last name');
        	return false;
		}else{
			$('#CardNameError').hide();
		}
	}
}

function funcCheckMiddleName(MiddleNameVal,FirstNameVal,ErrorId){
	if(MiddleNameVal!='' && FirstNameVal==''){
		$('#'+ErrorId).show();
    $('#'+ErrorId).text('This is required field');
    return false;
  }else{
  	$('#'+ErrorId).hide();
  }
}

function validateForm(){
	
	var ApplicationStatus = $('#ApplicationStatus').val();
	var AcknowledgementNumber = $('#AcknowledgementNumber').val();
	var CardName = $('#CardName').val();
	var MiddleName = $('#MiddleName').val();
	var FirstName = $('#FirstName').val();
	var LastName = $('#LastName').val();
	var KnownByOther = $('#KnownByOther').val();
	var MiddleNameOther = $('#MiddleNameOther').val();
	var FirstNameOther = $('#FirstNameOther').val();
	var LastNameOther = $('#LastNameOther').val();
	var ApplicantFatherLastName = $('#ApplicantFatherLastName').val();
	var ApplicantFatherMiddleName = $('#ApplicantFatherMiddleName').val();
	var ApplicantFatherFirstName = $('#ApplicantFatherFirstName').val();
	var ApplicantMotherLastName = $('#ApplicantMotherLastName').val();
	var ApplicantMotherFirstName = $('#ApplicantMotherFirstName').val();
	var ApplicantMotherMiddleName = $('#ApplicantMotherMiddleName').val();
	var NameOffice = $('#NameOffice').val();
	var FlatDoorBlock = $('#FlatDoorBlock').val();
	var BuildingPremises = $('#BuildingPremises').val();
	var RoadStreetLane = $('#RoadStreetLane').val();
	var AreaLocalityTaluka = $('#AreaLocalityTaluka').val();
	var TownCityDistrict = $('#TownCityDistrict').val();
	var ApplicationStatus = $('#ApplicationStatus').val();
	var StateUnion = $('#StateUnion').val();
	var Zip = $('#Zip').val();
	var OFlatDoorBlock = $('#OFlatDoorBlock').val();
	var OBuildingPremises = $('#OBuildingPremises').val();
	var ORoadStreetLane = $('#ORoadStreetLane').val();
	var OAreaLocalityTaluka = $('#OAreaLocalityTaluka').val();
	var OTownCityDistrict = $('#OTownCityDistrict').val();
	var OApplicationStatus = $('#OApplicationStatus').val();
	var OStateUnion = $('#OStateUnion').val();
	var OZip = $('#OZip').val();
	var StdCode = $('#StdCode').val();
	var MobileNumber = $('#MobileNumber').val();
	var Email = $('#Email').val();
	var RegistrationNumberFirm = $('#RegistrationNumberFirm').val();
	var IncomeFromSalary = $('#IncomeFromSalary').is(':checked');
  var BusinessProfessional = $('#BusinessProfessional').val();


   if (ApplicationStatus == "") {
    $("#ApplicationStatusError").show();
    $("#ApplicationStatusError").text('This is required');
    return false;
  }else{
  	$("#ApplicationStatusError").hide();
  }

  if(AcknowledgementNumber==''){
  			$("#AcknowledgementNumberError").show();
    		$("#AcknowledgementNumberError").text('This is required');
        return false;
  }else{
  	$("#ApplicationStatusError").hide();

  	if(AcknowledgementNumber.length >15 || AcknowledgementNumber.length<15) {
	    $("#AcknowledgementNumberError").show();
			$("#AcknowledgementNumberError").text('Length should be 15 number');
    return false;
 		}else{
 			$("#AcknowledgementNumberError").hide();
 		}
  }

  if(CardName=="") {
    $("#CardNameError").show();
    $("#CardNameError").text('This is required');
    return false;
  }else{
  	$("#CardNameError").hide();

  	 funcCardName(LastName,CardName,ApplicationStatus);
	}

	if(ApplicationStatus!='P'){
  	$('#MiddleName').attr('readonly', true);
  	$('#FirstName').attr('readonly', true);
  	$('#MiddleNameOther').attr('readonly', true);
  	$('#FirstNameOther').attr('readonly', true);
  	$('#ApplicantFatherLastName').attr('readonly', true);
  	$('#ApplicantFatherFirstName').attr('readonly', true);
  	$('#ApplicantFatherMiddleName').attr('readonly', true);
  	$('#ApplicantMotherLastName').attr('readonly', true);
  	$('#ApplicantMotherFirstName').attr('readonly', true);
  	$('#ApplicantMotherMiddleName').attr('readonly', true);

  }else{
  	$('#MiddleName').attr('readonly', false);
  	$('#FirstName').attr('readonly', false);
  	$('#MiddleNameOther').attr('readonly', false);
  	$('#FirstNameOther').attr('readonly', false);
  	$('#ApplicantFatherLastName').attr('readonly', false);
  	$('#ApplicantFatherFirstName').attr('readonly', false);
  	$('#ApplicantFatherMiddleName').attr('readonly', false);
  	$('#ApplicantMotherLastName').attr('readonly', false);
  	$('#ApplicantMotherFirstName').attr('readonly', false);
  	$('#ApplicantMotherMiddleName').attr('readonly', false);
  	
  	if(LastName==''){
  		$('#LastNameError').show();
      $('#LastNameError').text('This is required field');
      return false;
  	}else{
  		$('#LastNameError').hide();
			funcCheckMiddleName(MiddleName,FirstName,'FirstNameError');
  	}

  	if(KnownByOther=='Y'){
  		if(LastNameOther==''){
	  		$('#LastNameOtherError').show();
	      $('#LastNameOtherError').text('This is required field');
      	return false;
	  	}else{
	  		$('#LastNameOtherError').hide();
				funcCheckMiddleName(MiddleNameOther,FirstNameOther,'FirstNameOtherError');
		  }
  	}

  	if(ApplicantFatherLastName==''){
 	  	$('#ApplicantFatherLastNameError').show();
      $('#ApplicantFatherLastNameError').text('This is required field');
      return false;
 	  }else{
 	  	$('#ApplicantFatherLastNameError').hide();
			funcCheckMiddleName(ApplicantFatherMiddleName,ApplicantFatherFirstName,"ApplicantFatherFirstNameError");
		}


  }

  

	 

   if(ApplicationStatus=='P' || ApplicationStatus=='A' || ApplicationStatus=='H'
    || ApplicationStatus=='B' || ApplicationStatus=='J'){
	   	if(FlatDoorBlock==''){
		 	$('#FlatDoorBlockError').show();
			$('#FlatDoorBlockError').text('This is required field');
			return false;
		 }else{
		 	$('#FlatDoorBlockError').hide();
		 }

		 if(RoadStreetLane==''){
		 	$('#RoadStreetLaneError').show();
			$('#RoadStreetLaneError').text('This is required field');
			return false;
		 }else{
		 	$('#RoadStreetLaneError').hide();
		 }
	  
		 if(TownCityDistrict==''){
		 	$('#TownCityDistrictError').show();
			$('#TownCityDistrictError').text('This is required field');
			return false;
		 }else{
		 	$('#TownCityDistrictError').hide();
		 	if(TownCityDistrict.length>14){
			 	$('#TownCityDistrictError').show();
				$('#TownCityDistrictError').text('Max Length should be 14 character');
				return false;
		  }else{
		  	$('#TownCityDistrictError').hide();
		  }
		 }

		 if(StateUnion==''){
   	$('#StateUnionError').show();
		$('#StateUnionError').text('This is required field');
		return false;
   }else{
   	$('#StateUnionError').hide();
   }

   if(Zip==''){
   		$('#ZipError').show();
		$('#ZipError').text('Required: Numeric value allowed');
		return false;
   }else{
   	$('#ZipError').hide();
   	if(Zip.length>6 || Zip.length<6){
   		$('#ZipError').show();
			$('#ZipError').text('Zip Code should be 6 digit');
			return false;
   	}else{
   		$('#ZipError').hide();
   	}
   }

   if(StateUnion=='99' && Zip=='999999'){
		$('#TownCityDistrictError').show();
		$('#TownCityDistrictError').text('This field should be (City Name~Country Code~Zip Code)');
		
   }else{
   	$('#TownCityDistrictError').hide();
   }

   $('.fieldAddress').each(function(){
        if ($(this).val() == $('.fieldAddress').val() && $(this).attr('id') != $('.fieldAddress').attr('id'))
        {
          $('#addFieldError').show();
          $('#addFieldError').text('Do not use same value in address fileds.');
          return false;
        }else{
        	$('#addFieldError').hide();
        }

   });

  }else if(ApplicationStatus=='F' || ApplicationStatus=='E' || ApplicationStatus=='C'
   || ApplicationStatus=='L' || ApplicationStatus=='G'){
   	if(OFlatDoorBlock==''){
		 	$('#OFlatDoorBlockError').show();
			$('#OFlatDoorBlockError').text('This is required field');
			return false;
		 }else{
		 	$('#OFlatDoorBlockError').hide();
		 }

		 if(ORoadStreetLane==''){
		 	$('#ORoadStreetLaneError').show();
			$('#ORoadStreetLaneError').text('This is required field');
			return false;
		 }else{
		 	$('#ORoadStreetLaneError').hide();
		 }
	  
		 if(OTownCityDistrict==''){
		 	$('#OTownCityDistrictError').show();
			$('#OTownCityDistrictError').text('This is required field');
			return false;
		 }else{
		 	$('#OTownCityDistrictError').hide();
		 	if(OTownCityDistrict.length>14){
			 	$('#OTownCityDistrictError').show();
				$('#OTownCityDistrictError').text('Max Length should be 14 character');
				return false;
		  }else{
		  	$('#OTownCityDistrictError').hide();
		  }
		 }

		 if(OStateUnion==''){
   	$('#OStateUnionError').show();
		$('#OStateUnionError').text('This is required field');
		return false;
   }else{
   	$('#OStateUnionError').hide();
   }

   if(OZip==''){
   	$('#OZipError').show();
		$('#OZipError').text('This is required field');
		return false;
   }else{
   	$('#OZipError').hide();
   	if(OZip.length>6 || OZip.length<6){
   		$('#OZipError').show();
			$('#OZipError').text('Zip Code should be 6 digit');
			return false;
   	}else{
   		$('#OZipError').hide();
   	}
   }

   if(OStateUnion=='99' && OZip=='999999'){
		$('#OTownCityDistrictError').show();
		$('#OTownCityDistrictError').text('This field should be (City Name~Country Code~Zip Code)');
		
   }else{
   	$('#OTownCityDistrictError').hide();
   }

  }
   

   if(MobileNumber!='' || Email!=''){

   		if(StdCode!='' && MobileNumber==''){
	  		$('#MobileNumberError').show();
	      $('#MobileNumberError').text('This is required field');
	      return false;
	  	}else{
	  		$('#MobileNumberError').hide();
	  	}
  		$('#EmailError').hide();
  	}else{
  		$('#EmailError').show();
      $('#EmailError').text('This is required field');
      return false;
  	}

  	if(ApplicationStatus=='C'){
  		if(RegistrationNumberFirm==''){
		   	$('#RegistrationNumberFirmError').show();
				$('#RegistrationNumberFirmError').text('This is required field');
				return false;
		   }else{
		   	$('#RegistrationNumberFirmError').hide();
		   }

  	}


}

function validateForm2(){
	var ApplicationStatus = $('#ApplicationStatus').val();
	var AcknowledgementNumber = $('#AcknowledgementNumber').val();
	var IdentityProof = $('#IdentityProof').val();
	var AddressProof = $('#AddressProof').val();
	var ProofDOB = $('#ProofDOB').val();
	var VerifierName = $('#VerifierName').val();
	var CVerifier = $('#CVerifier').val();
	var VerifierPlace = $('#VerifierPlace').val();




	if(IdentityProof==''){
		$('#IdentityProofError').show();
		$('#IdentityProofError').text('This is required field');
		return false;
	}else{
		$('#IdentityProofError').hide();
	}

	if(AddressProof==''){
		$('#AddressProofError').show();
		$('#AddressProofError').text('This is required field');
		return false;
	}else{
		$('#AddressProofError').hide();
	}

	if(ProofDOB==''){
		$('#ProofDOBError').show();
		$('#ProofDOBError').text('This is required field');
		return false;
	}else{
		$('#ProofDOBError').hide();
	}

	if(VerifierName==''){
		$('#VerifierNameError').show();
		$('#VerifierNameError').text('This is required field');
		return false;
	}else{
		$('#VerifierNameError').hide();
	}

	if(CVerifier==''){
		$('#CVerifierError').show();
		$('#CVerifierError').text('This is required field');
		return false;
	}else{
		$('#CVerifierError').hide();
	}

	if(VerifierPlace==''){
		$('#VerifierPlaceError').show();
		$('#VerifierPlaceError').text('This is required field');
		return false;
	}else{
		$('#VerifierPlaceError').hide();
	}

}