var autocompleteInvoices = [];

function createInvoice(){
    var senderPhone = $("#clientPhoneNumber").val();
    var senderFullName = $("#clientFullName").val();
    var senderDepartmentNumber = $("#sender-department-number").val();
    var packageType = $("#package-type").val();
    var packageDescription = $("#package-description").val(); 
    var weight = $("#weight-input").val();
    var packagePrice = $("#price-input").val();
    var width = $("#width-input").val();
    var depth = $("#depth-input").val();
    var height = $("#height-input").val();
    var receiverPhone = $("#receiverPhoneNumber").val();
    var receiverFullName = $("#receiverFullName").val();
    var receiverDepartmentNumber = $("#receiver-department-number").val();
    var payedBy = document.querySelector('input[name="payment"]:checked').value;

    /*console.log(senderPhone, senderFullName, senderDepartmentNumber, packageType,
        packageDescription, weight, packagePrice, width, depth, height,
        receiverPhone, receiverFullName, receiverDepartmentNumber, payedBy);*/

    $.ajax({
        type: "POST",
        url: "../requests/create-new-invoice.php",
        data: {
            senderPhone: senderPhone,
            senderFullName: senderFullName,
            senderDepartmentNumber: senderDepartmentNumber,
            packageType: packageType,
            packageDescription: packageDescription,
            packagePrice: packagePrice,
            width: width,
            weight: weight,
            depth: depth,
            height: height,
            receiverPhone: receiverPhone,
            receiverFullName: receiverFullName,
            receiverDepartmentNumber: receiverDepartmentNumber,
            payedBy: payedBy
        },
        success: function (response) {

            window.location.href = `../php/visit-page.php`;
            console.log(response);
        }
    });
}

function fillInputs(){
    $("#clientPhoneNumber").val("+38(067)-107-82-34");
    $("#clientFullName").val("Єфремов Євгеній Олексійович");
    $("#sender-department-number").val("100");
    $("#package-type").val("Документи");
    $("#package-description").val("Документи"); 
    $("#weight-input").val("0.1");
    $("#price-input").val("200");
    $("#width-input").val("10");
    $("#depth-input").val("20");
    $("#height-input").val("30");
    $("#receiverPhoneNumber").val("+38(098)-107-82-34");
    $("#receiverFullName").val("Іванов Іван Іванович");
    $("#receiver-department-number").val("101");
}

function showClientInvoices(){
    $.ajax({
        type: "GET",
        url: "../requests/get-current-client.php",
        success: function(responce) {
            if(responce != ""){
                var jsonObject = JSON.parse(responce);
                $("#clientPhoneNumber").val(jsonObject["phoneNumber"]);
                $("#clientFullName").val(jsonObject["fullName"]);

                $.ajax({
                    type: "POST",
                    url: "../requests/get-current-mode.php",
                    success: function(responce){
                        console.log(responce);

                        if(responce == "accepted"){
                            $.ajax({
                                type: "POST",
                                url: "../requests/create-new-visit.php",
                                success: function(responce) {
                                    console.log(responce);
                                }
                            });

                            var phoneNumber = $("#clientPhoneNumber").val();
                            var fullName = $("#clientFullName").val();

                            $.ajax({
                                type: "POST",
                                url: "../requests/get-client-invoices.php",
                                data:{
                                    clientPhoneNumber: phoneNumber,
                                    clientFullName: fullName,
                                    clientType: "sender"
                                },
                                success: function(responce){
                                    console.log(responce);
                                    var array = JSON.parse(responce);
                                    appendClientInvoices(array, "sender");
                                }
                            });							
                        }

                        else if(responce == "cancelled_accept"){
                            var phoneNumber = $("#clientPhoneNumber").val();
                            var fullName = $("#clientFullName").val();

                            $.ajax({
                                type: "POST",
                                url: "../requests/get-client-invoices.php",
                                data:{
                                    clientPhoneNumber: phoneNumber,
                                    clientFullName: fullName,
                                    clientType: "sender"
                                },
                                success: function(responce){
                                    console.log(responce);
                                    var array = JSON.parse(responce);
                                    appendClientInvoices(array, "sender");
                                }
                            });					
                        }
                        
                        else if(responce == "give"){
                            var phoneNumber = $("#clientPhoneNumber").val();
                            var fullName = $("#clientFullName").val();

                            $.ajax({
                                type: "POST",
                                url: "../requests/get-client-invoices.php",
                                data:{
                                    clientPhoneNumber: phoneNumber,
                                    clientFullName: fullName,
                                    clientType: "receiver"
                                },
                                success: function(responce){
                                    console.log(responce);
                                    var array = JSON.parse(responce);
                                    appendClientInvoices(array, "receiver");
                                }
                            });					
                        }
                    }
                });
            }
        }
    });
}

function appendClientInvoices(invoices, clientType){
    $("#information-inner-div").empty();

	var totalPrice = 0;
	invoices.forEach(function(invoice){
		var invoiceNumber = invoice["number"];
		var deliveryPrice = invoice["deliveryPrice"];
		var payedBy = invoice["payedBy"];
		var package = invoice["package"];
		var packageType = package["type"];
		var packageWeight = package["weight"];
		var packageCell = "A01";
		if(clientType == "sender")
			packageCell = "";
		if(payedBy == "sender" && clientType == "receiver")
			deliveryPrice = 0;
		if(payedBy == "receiver" && clientType == "sender")
			deliveryPrice = 0;
		$("#information-inner-div").append(
			`<div class="invoice-container" onclick="openCreatedInvoice($(this))">
				<table>
					<tr>
						<td align="left" width: 10%>
							<p class="label-18">`+ invoiceNumber +`</p>
						</td>
						<td align="center" style="width: 10%">
							<p class="package-cell">`+ packageCell +`</p>
						</td>
						<td align="center" style="width: 40%">
							<p class="label-16">`+ packageType +`</p>
						</td>
						<td align="center" style="width: 20%">
							<p class="label-16">`+ packageWeight +`кг</p>
						</td>
						<td align="right" style="width: 20%">
							<p class="label-18">`+ deliveryPrice +`&#8372</p>
						</td>
					</tr>
				</table>
			</div>`
		);
		if(payedBy == "receiver" && clientType == "receiver")
			totalPrice += parseInt(deliveryPrice);
		if(payedBy == "sender" && clientType == "sender")
			totalPrice += parseInt(deliveryPrice);
	});

	$("#price-label").text(totalPrice + "₴");
	if(totalPrice > 0)
		$("#close-visit-button").text("Сплатити");
}

function openCreatedInvoice(div){
    var invoiceNumber = div.find("p").first().text();
    $.ajax({
        type: "POST",
        url: "../requests/get-created-invoice.php",
        data: {
            invoiceNumber: invoiceNumber
        },
        success: function (response) {
            console.log(response);
            window.location.href = '../php/created-invoice-page.php';
        }
    });
}

function showInvoiceInfo(){
    $("input").prop("disabled", true);
    $("#add-package-button").prop("disabled", true);
    $("#search-input").prop("disabled", false);

    $.ajax({
        type: "GET",
        url: "../requests/get-invoice-to-open.php",
        success: function (responce) {
            console.log(responce);
            invoice = JSON.parse(responce);

            $("#visit-label").text("Номер накладної: " + invoice.number);
            $("#clientPhoneNumber").val(invoice.sender.phoneNumber);
            $("#clientFullName").val(invoice.sender.fullName);
            $("#sender-department-number").val(invoice.sendDepartment);

            $("#package-type").val(invoice.package.type);
            $("#package-description").val(invoice.package.description);
            $("#weight-input").val(invoice.package.weight);
            $("#price-input").val(invoice.package.price);
            var dimensions = invoice.package.dimensions.split(" ");
            $("#width-input").val(dimensions[0]);
            $("#depth-input").val(dimensions[1]);
            $("#height-input").val(dimensions[2]);

            $("#receiverPhoneNumber").val(invoice.receiver.phoneNumber);
            $("#receiverFullName").val(invoice.receiver.fullName);
            $("#receiver-department-number").val(invoice.deliverDepartment);

            var payedBy = invoice.payedBy;
            $("input[name='payment'][value='" + payedBy + "']").prop('checked', true);
        }
    });
}

function completeInvoiceInput(){
    autocompleteInvoices = [];
    var invoice = null;
    var invoiceNumber = $("#search-input").val();

    $.ajax({
        type: "POST",
        url: "../requests/get-created-invoice.php",
        data:{
            invoiceNumber: invoiceNumber
        },
        success: function (responce) {
            console.log(responce);
            invoice = JSON.parse(responce);
            if(invoice.received != 1)
                autocompleteInvoices[0] = "ЕН: " + invoice.number + ", Отримувач : " + invoice.receiver.fullName;
        }
    });
    
    $("#search-input").autocomplete({
		source: autocompleteInvoices,
		select: function(event, ui) {
			$.ajax({
                type: "POST",
                url: "../requests/set-client.php",
                data:{
                    clientPhoneNumber: invoice.receiver.phoneNumber
                },
                success: function (responce) {
                    console.log(responce);

                    $.ajax({
                        type: "POST",
                        url: "../requests/create-new-visit.php",
                        data:{
                            operation: "give"
                        },
                        success: function (responce) {
                            console.log(responce);
                            $.ajax({
                                type: "POST",
                                url: "../requests/set-current-operation.php",
                                data:{
                                    operation: "give"
                                },
                                success: function (responce) {
                                    console.log(responce);
                                    location.href = "../php/visit-page.php";
                                }
                            });
                        }
                    });
                }
            });
        }
	});
}