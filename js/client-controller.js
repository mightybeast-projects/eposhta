//TODO
var clientsAutocomplete = [];

function findClient(){
	availablePhones = [];
	var phoneNumber = $("#clientPhoneNumber").val();
	var foundClient = false;

	$.ajax({
		type: "GET",
		data:{
			clientPhoneNumber: phoneNumber
		},
		url: "../requests/find-client.php",
		success: function(string){
			if(string != ""){
				var jsonObject = JSON.parse(string);
				clientsAutocomplete = jsonObject;
			}
		}
	});

	$("#clientPhoneNumber").autocomplete({
		source: clientsAutocomplete,
		minLength: 10,
		focus: function( event, ui ) {
			$(this).val(ui.item.label.substr(0, 18));
		},
		select: function( event, ui ) {
			$("#clientFullName").val(ui.item.label.substr(19, ui.item.label.length - 1));
			$("#clientFullName").prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: "../requests/set-client.php",
				data:{
					clientPhoneNumber: $("#clientPhoneNumber").val()
				},
				success: function(responce){
					console.log(responce);
				}
			});

			foundClient = true;
			createNewVisit();
		},
		results: function( amount ) {
			return amount + ( amount > 1 ? " results were" : " result was" ) + " found.";
		}
	});

	return foundClient;
}

function findReceiver(){
	availablePhones = [];
	var phoneNumber = $("#receiverPhoneNumber").val();

	$.ajax({
		type: "GET",
		data:{
			clientPhoneNumber: phoneNumber
		},
		url: "../requests/find-client.php",
		success: function(string){
			if(string != ""){
				var jsonObject = JSON.parse(string);
				clientsAutocomplete = jsonObject;
			}
		}
	});

	$("#receiverPhoneNumber").autocomplete({
		source: clientsAutocomplete,
		minLength: 10,
		focus: function( event, ui ) {
			$(this).val(ui.item.label.substr(0, 18));
		},
		select: function( event, ui ) {
			$("#receiverFullName").val(ui.item.label.substr(19, ui.item.label.length - 1));
			$("#receiverFullName").prop('disabled', true);
		},
		results: function( amount ) {
			return amount + ( amount > 1 ? " results were" : " result was" ) + " found.";
		}
	});
}

function createClient(){
	if($("#clientPhoneNumber").val() != ""){
		var phoneNumber = $("#clientPhoneNumber").val();
		if($("#clientFullName").val() != ""){
			var fullName = $("#clientFullName").val();
			console.log(phoneNumber, fullName);

			//Check if already exists
			$.ajax({
				type: "GET",
				data:{
					clientPhoneNumber: phoneNumber,
					clientFullName: fullName
				},
				url: "../requests/check-client.php",

				success: function(responce){
					//If database doesn't have this client
					if(!responce){
						//Create new client
						$.ajax({
							type: "POST",
							data:{
								clientPhoneNumber: phoneNumber,
								clientFullName: fullName
							},
							url: "../requests/create-client.php"
						});
					}
				}
			});
		}
	}

	createNewVisit();
}

function createNewVisit(){
	setTimeout(function(){
		$.ajax({
			type: "POST",
			url: "../requests/create-new-visit.php",
			success: function(responce){
				console.log(responce);

				$.ajax({
					type: "POST",
					url: "../requests/get-current-mode.php",
					success: function(responce){
						console.log(responce);

						if(responce == "give"){
							var phoneNumber = $("#clientPhoneNumber").val();
							var fullName = $("#clientFullName").val();
							var clientType = "receiver";
							$.ajax({
								type: "POST",
								url: "../requests/get-client-invoices.php",
								data:{
									clientPhoneNumber: phoneNumber,
									clientFullName: fullName,
									clientType: clientType
								},
								success: function(responce){
									console.log(responce);
									var array = JSON.parse(responce);
									appendClientInvoices(array, clientType);
								}
							});							
						}
					}
				});
				
			}
		});
	}, 100);
}