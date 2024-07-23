jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");

jQuery.validator.addMethod("singleApostrophy", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only single occurrence of apostrophe");

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

jQuery.validator.addMethod("greaterThan", 
function(value, element, params) {
	if (!/Invalid|NaN/.test(new Date(value))) {
		return new Date(value) <= new Date($(params).val());
	}
	
	return isNaN(value) && isNaN($(params).val()) 
		|| (Number(value) <= Number($(params).val())); 
},'Date must less then or equal to receipt date');

jQuery.validator.addMethod("numberNotStartWithZero", function(value, element) {
    return this.optional(element) || /^[1-9][0-9]+$/i.test(value);
}, "Please enter a valid number. (Do not start with zero)");


///////////////////////////////////////Validation Starts///////////////////////////////////
$("#dataentry1").validate({
	rules: {
		applicanttitlecode: "required",
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
		APPOTITLE: {
				required: function(){
						if($('#KnownByOther').val()=="Y"){
							return true;
						}else{
							return false;
						}
				},	
		},
		APPOLNAME: {
				required: function(){
						if($('#KnownByOther').val()=="Y"){
							return true;
						}else{
							return false;
						}
				},	
		},
		APPOFNAME: {
				required: function(){
						return $('#MiddleNameOther').val()!= "";
				},
				lettersonly: true
		},
		APPOMNAME: {
				lettersonly: true
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
		DOB: {
			dateFormat: true
		},
		fatherlastname: {
				required: function(){
						if($('#ApplicationStatus').val()=="P"){
							if($('#NamePrintedCard').val()=="F"){
								return true;
							}else if($('#NamePrintedCard').val()=="S"){
								return false;
							}else{
								return false;
							}
						}else{
							return false;
						}
				},
				lettersonly: true
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
		resitownorcountry: {
				required: function(){
						if($('#ApplicationStatus').val()=="P" || $('#ApplicationStatus').val()=="H" || $('#ApplicationStatus').val()=="A" || $('#ApplicationStatus').val()=="B" || $('#ApplicationStatus').val()=="J"){
							return true;
						}else{
							return false;
						}
				}	
		},
		resiflatorblockno: {
			required: function(){
						if($('#ApplicationStatus').val()=="P" || $('#ApplicationStatus').val()=="H" || $('#ApplicationStatus').val()=="A" || $('#ApplicationStatus').val()=="B" || $('#ApplicationStatus').val()=="J"){
							return true;
						}else{
							return false;
						}
			},
            notEqualToGroup: ['.notEqualToClass']
        },
		resibuildingorvillage: {
			required: function(){
						if($('#ApplicationStatus').val()=="P" || $('#ApplicationStatus').val()=="H" || $('#ApplicationStatus').val()=="A" || $('#ApplicationStatus').val()=="B" || $('#ApplicationStatus').val()=="J"){
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
           				if($('#ApplicationStatus').val()=="P" || $('#ApplicationStatus').val()=="H" || $('#ApplicationStatus').val()=="A" || $('#ApplicationStatus').val()=="B" || $('#ApplicationStatus').val()=="J"){
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
        }
		
	},
	messages: {
		applicationfirstname: {
			required: "Required (If Middle name is Enter)",
			lettersonly: "Only alphabetical characters"
		},
		NAMETOBEPRINTED: {
			required: "Required (Name to be printed on card as last name)",
		},
		APPOFNAME: {
			required: "Required (If  Middle name is Enter)",
			lettersonly: "Only alphabetical characters"
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

