//////////////Only for alphabet//////////////////////////////////
jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");
//////////////Only for alphabet End//////////////////////////////////

//////////////notEqualToGroup Address//////////////////////////////////
jQuery.validator.addMethod("notEqualToGroup", function (value, element, options) {
    // get all the elements passed here with the same class
    var elems = $(element).parents('form').find(options[0]);
    // the value of the current element
    var valueToCompare = value;
    // count
    var matchesFound = 0;
    // loop each element and compare its value with the current value
    // and increase the count every time we find one
    jQuery.each(elems, function () {
        thisVal = $(this).val();
        if (thisVal == valueToCompare) {
            matchesFound++;
        }
    });
    // count should be either 0 or 1 max
    if (this.optional(element) || matchesFound <= 1) {
        //elems.removeClass('error');
        return true;
    } else {
        //elems.addClass('error');
    }
}, "Please do not repeat same information");
////////////////////////////////////////////////////////////////////////////

//////////////Date Format//////////////////////////////////
jQuery.validator.addMethod(
    "dateFormat",
    function(value, element) {
        var check = false;
        var re = /^\d{1,2}\-\d{1,2}\-\d{4}$/;
            if( re.test(value)){
                var adata = value.split('-');
                var dd = parseInt(adata[0],10);
                var mm = parseInt(adata[1],10);
                var yyyy = parseInt(adata[2],10);
                var xdata = new Date(yyyy,mm-1,dd);
                if ( ( xdata.getFullYear() === yyyy ) && ( xdata.getMonth () === mm - 1 ) && ( xdata.getDate() === dd ) ) {
                check = true;
            }
            else {
                check = false;
            }
        } else {
       		 check = false;
        }
        return this.optional(element) || check;
    },
    "Wrong date format"
);
///////////////////////////////////////////////////////////


//////////////Date greaterThan//////////////////////////////////
jQuery.validator.addMethod("greaterThan", 
function(value, element, params) {
	if (!/Invalid|NaN/.test(new Date(value))) {
		return new Date(value) <= new Date($(params).val());
	}
	
	return isNaN(value) && isNaN($(params).val()) 
		|| (Number(value) <= Number($(params).val())); 
},'Date must less then or equal to receipt date');
/////////////////////////////////////////////////////////////////

//////////////numberNotStartWithZero//////////////////////////////////
jQuery.validator.addMethod("numberNotStartWithZero", function(value, element) {
    return this.optional(element) || /^[1-9][0-9]+$/i.test(value);
}, "Please enter a valid number. (Do not start with zero)");
/////////////////////////////////////////////////////////////////////

///////////////////////////////////////Validation Starts///////////////////////////////////
$("#dataentry1").validate({
	rules: {
		APPLTITLE: "required",
		applicantlastname: "required",
		applicationfirstname: {
					required: function(){
						return $('#MiddleName').val()!= "";
					},
					lettersonly: true
		},
		applicantmiddlename: {
					lettersonly: true
		},
		NAMETOBEPRINTED: {
					required: true
		},
		fatherlastname: {
				required: function(){
					
						if($('#ApplicationStatus').val()=="P"){
							return true;
						}else{
							return false;
						}
				}
		},
		fatherfirstname: {
				required: function(){
						if($('#ApplicationStatus').val()=="P"){
							return $('#ApplicantFatherMiddleName').val().trim()!= "";	
						}else{
							return false;
						}
				},
				lettersonly: true
		},
		fathermiddlename: {
				lettersonly: true
		},
		motherlastename: {
				lettersonly: true
		},
		motherfirstname: {
				required: function(){
						if($('#ApplicationStatus').val()=="P"){
							return $('#ApplicantMotherMiddleName').val()!= "";	
						}else{
							return false;
						}
				},
				lettersonly: true
		},
		mothermiddlename: {
				lettersonly: true
		},
		fatherormothernameoncard: {
				required: function(){
						if($('#ApplicationStatus').val()=="P"){
							return true;
						}else{
							return false;
						}
				}	
		},
		DOB: {
			dateFormat: true
		},
		SEX: {
				required: function(){
						if($('#ApplicationStatus').val()=="P"){
							return true;
						}else{
							return false;
						}
				}	
		},
		resitownorcountry: {
				required: function(){
						if($('#AddressType').val()=="R"){
							return true;
						}else{
							return false;
						}
				}	
		},
		resiflatorblockno: {
			required: function(){
						if($('#AddressType').val()=="R"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		resibuildingorvillage: {
			required: function(){
						if($('#AddressType').val()=="R"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		resipostoffice: {
            notEqualToGroup: ['.notEqualToClass']
        },
		resiareasubdivision: {
            notEqualToGroup: ['.notEqualToClass']
        },
		resistatecode: {
			required: function(){
           				if($('#AddressType').val()=="R"){
							return true;
						}else{
							return false;
						}
			}
        },
		resizipcode: {
            required: function(){
						if($("input[name=isotherresi]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		resipincode: {
            required: function(){
						if($("input[name=isotherresi]:checked").val()=="N"){
							return true;
						}else{
							return false;
						}
			},
			digits: true,
			minlength: 6
        },
		foreigncountryrsd: {
            required: function(){
						if($("input[name=isotherresi]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		OFFICENAME: {
				required: function(){
						if($('#AddressType').val()=="O"){
							return true;
						}else{
							return false;
						}
				}	
		},
		officeflatorblock: {
			required: function(){
						if($('#AddressType').val()=="O"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		officebuildingorvillage: {
			required: function(){
						if($('#AddressType').val()=="O"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		officestreeorpostoffice: {
            notEqualToGroup: ['.notEqualToClass']
        },
		officeareaorsubdivision: {
            notEqualToGroup: ['.notEqualToClass']
        },
		officetownorcontry: {
				required: function(){
						if($('#AddressType').val()=="O"){
							return true;
						}else{
							return false;
						}
				}	
		},
		officestatecode: {
			required: function(){
           				if($('#AddressType').val()=="O"){
							return true;
						}else{
							return false;
						}
			}
        },
		officezipcode: {
            required: function(){
						if($("input[name=isotheroffce]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		officepincode: {
            required: function(){
						if($("input[name=isotheroffce]:checked").val()=="N"){
							return true;
						}else{
							return false;
						}
			},
			digits: true,
			minlength: 6
        },
		foreigncountryofs: {
            required: function(){
						if($("input[name=isotheroffce]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		RNameOffice: {
				required: function(){
						if($("input[name=isanotheraddressupdate]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
				}	
		},
		raflatorblock: {
			required: function(){
						if($("input[name=isanotheraddressupdate]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		rabuildingorvillage: {
			required: function(){
						if($("input[name=isanotheraddressupdate]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		streetorpostoffice: {
            notEqualToGroup: ['.notEqualToClass']
        },
		raareasubdivision: {
            notEqualToGroup: ['.notEqualToClass']
        },
		ratownorcountry: {
				required: function(){
						if($("input[name=isanotheraddressupdate]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
				}	
		},
		rastatecode: {
			required: function(){
           				if($("input[name=isanotheraddressupdate]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		razipcode: {
            required: function(){
						if($("input[name=isotherrep]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		rapincoe: {
            required: function(){
						if($("input[name=isotherrep]:checked").val()=="N"){
							return true;
						}else{
							return false;
						}
			},
			digits: true,
			minlength: 6
        },
		foreigncountryrep: {
            required: function(){
						if($("input[name=isotherrep]:checked").val()=="Y"){
							return true;
						}else{
							return false;
						}
			}
        },
		verificationplace: "required",
		verifiername: "required",
		verificationdate: {
			required: true,
			dateFormat: true,
			greaterThan: "#acknwoledmentdate"
		},
		acknwoledmentdate: {
			dateFormat: true
		},
		dateofdescreresolution: {
			dateFormat: true
		},
		STDCODE: {
            required: function(){
						if($("#MobileNumber").val()!=""){
							return true;
						}else{
							return false;
						}
			},
			digits: true
        },
		TELPHONE: {
            required: function(){
						if($("#StdCode").val()!=""){
							return true;
						}else{
							return false;
						}
			},
			digits: true,
			numberNotStartWithZero:true
        },
		EMAIL: {
            required: function(){
						if($("#MobileNumber").val()==""){
							return true;
						}else{
							return false;
						}
			}
        },
		REGNUM: {
            required: function(){
						if($('#ApplicationStatus').val()=="C"){
							return true;
						}else{
							return false;
						}
			}
        },
		
		
	},
	messages: {
		applicationfirstname: {
			required: "Required (If Middle name is Enter)",
			lettersonly: "Only alphabetical characters"
		},
		NAMETOBEPRINTED: {
			required: "Required (Name to be printed on card as last name)",
		},
		fatherfirstname: {
			required: "Required (If  Middle name is Enter)",
			lettersonly: "Only alphabetical characters"
		},
		motherfirstname: {
			required: "Required (If  Middle name is Enter)",
			lettersonly: "Only alphabetical characters"
		}
	}
});

