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
		AREACODE: "required",
		AOTYPE: "required",
		RANGECODE: "required",
		AONO: "required",
		catofdeductor: "required",
		companyname: {
				required: function(){
						if($('#catofdeductor').val()=="c" || $('#catofdeductor').val()=="d"){
							return true;
						}else{
							return false;
						}
				}	
		},
		office_name: {
				required: function(){
						if($('#catofdeductor').val()=="a" || $('#catofdeductor').val()=="b"){
							return true;
						}else{
							return false;
						}
				}	
		},
		desigpersonforpayment: {
				required: function(){
						if($('#catofdeductor').val()=="a" || $('#catofdeductor').val()=="b" || $('#catofdeductor').val()=="c" || $('#catofdeductor').val()=="d"){
							return true;
						}else{
							return false;
						}
				}	
		},
		namelocbranch: {
				required: function(){
						if($('#catofdeductor').val()=="f" || $('#catofdeductor').val()=="h"){
							return true;
						}else{
							return false;
						}
				}	
		},
		firstname: {
				required: function(){
						if($('#catofdeductor').val()=="e" || $('#catofdeductor').val()=="f"){
							return true;
						}else{
							return false;
						}
				}	
		},
		firmassocname: {
				required: function(){
						if($('#catofdeductor').val()=="g" || $('#catofdeductor').val()=="h"){
							return true;
						}else{
							return false;
						}
				}	
		},
		addrtownorcountry: {
					required: true
		},
		addrflatorblockno: {
					required: true
		},
		addrbuildingorvillage: {
					required: true
		},
		addrstatecode: {
					required: true
		},
		addrpincode: {
					required: true,
					digits: true,
					minlength: 6
		},
		STDCODE: {
				required: function(){
						if($('#MobileNumber').val()!=""){
							return true;
						}else{
							return false;
						}
				},
				digits: true,
				numberNotStartWithZero:true
		},
		TELEPHONE: {
		required: function(){
						if($('#email1').val()=="" || $('#email2').val()==""){
							return true;
						}else{
							return false;
						}
				},
				digits: true,
				numberNotStartWithZero:true
		},
		email1: {
		required: function(){
						if($('#MobileNumber').val()=="" || $('#email2').val()==""){
							return true;
						}else{
							return false;
						}
				}
		},
		email2: {
		required: function(){
						if($('#email1').val()=="" || $('#MobileNumber').val()==""){
							return true;
						}else{
							return false;
						}
				}
		},
		NATIONALITY: "required",
		panapplicant:{
					minlength: 10,
					maxlength:10
		},
		verifiername: "required",
		verifiercapacitycode: "required",
		applicationdate: {
			required: true,
			dateFormat: true,
			greaterThan: "#acknwoledmentdate"
		},
		verificationdate: {
			required: true,
			dateFormat: true,
			greaterThan: "#acknwoledmentdate"
		}
		
	},
	messages: {
		applicationdate: {
			greaterThan: "Should be less than or equal to Date of Acknowledgement."
		},
		verificationdate: {
			greaterThan: "Should be less than or equal to Date of Acknowledgement."
		}
	}
});

