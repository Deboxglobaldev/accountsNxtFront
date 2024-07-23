$(document).ready(function(){
    $("#branchform").validate({
							  onfocusout: function(element) {
           this.element(element);
        },
		rules :{
			name: "required",
			AddressOne: "required",
			City: "required",
			PinCode: {
				required: true,
				minlength:6,
				maxlength:6
			},
			State: "required",
			PrimaryPhone: {
				required: true,
				minlength:10,
				maxlength:10
			},
			SecondaryPhone: {
				minlength:10,
				maxlength:10
			},
			PrimaryEmail: {
				required: true,
				email: true
			},
			ContactPerson: "required",
			AgentNumber: "required",
			Region: "required",
			PanNumber: "required",
			BranchCode: "required",
			FinancialCode: "required",
			BankName: "required",
			AccountNumber: "required",
			IfscCode: "required",
			BranchName: "required",
			BankName: "required",
			ActivationDate: {
				required: true,
				minlength:10,
				maxlength:10
			},
			FranchCode: {
				required: true
			},
			TrainingDate: {
				minlength:10,
				maxlength:10
			},
			ClosureDate: {
				minlength:10,
				maxlength:10
			}
		},
		messages :{
		   
		},
		submitHandler: function(form) {
		  form.submit();
		}
	});
});