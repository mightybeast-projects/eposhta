<?php
	include "../entities/User.php";
	include "../entities/Client.php";
	include "../entities/Visit.php";
	include "../dao/InvoiceDAO.php";
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	$invoiceDAO = new InvoiceDAO();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accept package</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script type="text/javascript" src="../js/format-phone-number.js"></script>
	<script type="text/javascript" src="../js/client-controller.js"></script>
	<script type="text/javascript" src="../js/invoice-controller.js"></script>
	<script type="text/javascript" src="../js/handle-keys.js"></script>
	<script type="text/javascript" src="../js/enable-input.js"></script>
	<script type="text/javascript" src="../js/fill-department-input.js"></script>

</head>
<body>
	<header>
		<div id="header-outer-div">
			<div id="header-inner-div">
				<div id="logo-div">
					<table>
						<tr>
							<td>
								<img src="../img/logo.png" width="32" height="32">
							</td>
							<td style="vertical-align: none;">
								<p class="label-20" id="logo-text">
									<a id="logo-link" href="../requests/exit-to-main-page.php">EPoshta</a> 
								</p>
							</td>
						</tr>
					</table>
				</div>

				<a href="index.php"><i class="fas fa-sign-out-alt" id="logout-icon"></i></a>
			</div>
		</div>
	</header>

	<input id="search-input" class="default-input" placeholder="Номер накладної" oninput="completeInvoiceInput()">
		
	<div class="content-div">
		<div id="visit-information-div">
			<table width="100%">
				<tr>
					<td>
						<p id="visit-label" class="label-20">Номер накладної: 
							<?php echo $invoiceDAO->getLastNumber() + 1 ?>
						</p>
					</td>
					<td align="right">
						<button id="exit-button" onclick="window.location.href = `../requests/give-package.php`">
							Вихід
							<div class="button-key-label">
								<p class="label-14">Esc</p>
							</div>
						</button>
					</td>
				</tr>
			</table>
		</div>

		<ul id="accept-package-content-ul">
			<li>
				<div class="inputs-div">
					<p class="label-18 div-header">Відправник</p>
					<div class="inputs-inner-div">
						<p class="label-18">Номер телефону</p>
						<input id="clientPhoneNumber" class="default-input form-input phone-input" maxlength="18" spellcheck="false" 
							oninput="findClient(); enableInput($(clientFullName))">
						<p class="label-18">ПІБ</p>
						<input id="clientFullName" class="default-input form-input" spellcheck="false" onblur="createClient()">
						<p class="label-18">Номер відділення</p>
						<input id="sender-department-number" class="default-input form-input department-input" spellcheck="false">
					</div>
				</div>
			</li>
			<li>
				<div class="inputs-div">
					<p class="label-18 div-header">Посилка</p>
					<div class="inputs-inner-div">
						<p class="label-18">Тип відправлення</p>
						<input id="package-type" class="default-input form-input" spellcheck="false">
						<p class="label-18">Опис відправлення</p>
						<input id="package-description" class="default-input form-input" spellcheck="false">
						<table id="package-table" border="0px" style="width: 100%;">
							<tr>
								<td>
									<p class="label-18">Вага</p>
								</td>
								<td align="right" colspan="2">
									<p class="label-18">Оголошена вартість</p>
								</td>
							</tr>
							<tr>
								<td>
									<input id="weight-input" class="default-input form-input">
								</td>
								<td align="right" colspan="2">
									<input id="price-input" class="default-input form-input">
								</td>
							</tr>
							<tr>
								<td>
									<p class="label-18">Ширина</p>
								</td>
								<td align="center">
									<p class="label-18">Довжина</p>
								</td>
								<td align="right">
									<p class="label-18">Висота</p>
								</td>
							</tr>
							<tr>
								<td>
									<input id="width-input" class="default-input form-input">
								</td>
								<td align="center">
									<input id="depth-input" class="default-input form-input">
								</td>
								<td align="right">
									<input id="height-input" class="default-input form-input">
								</td>
							</tr>
						</table>
						<button id="add-package-button" class="float-left">Додати пакування</button>
						<p id="volumetric-weight-label" class="label-14 float-left">Об'ємна вага :</p>
					</div>
				</div>
			</li>
			<li>
				<div class="inputs-div">
					<p class="label-18 div-header">Отримувач</p>
					<div class="inputs-inner-div">
						<p class="label-18">Номер телефону</p>
						<input id="receiverPhoneNumber" class="default-input form-input phone-input" maxlength="18" spellcheck="false"
							oninput="findReceiver(); enableInput($(receiverFullName))">
						<p class="label-18">ПІБ</p>
						<input id="receiverFullName" class="default-input form-input" spellcheck="false">
						<p class="label-18">Номер відділення</p>
						<input id="receiver-department-number" class="default-input form-input department-input" spellcheck="false">
					</div>
				</div>
			</li>
			<li>
				<div class="inputs-div" style="margin-right: 0;">
					<p class="label-18 div-header">Вартість</p>
					<div class="inputs-inner-div">
						<table id="price-table" style="width: 100%; height: 40%;">
							<tr>
								<td><p class="label-18">Перевезення :</p></td>
								<td align="right"><p id="delivery-price" class="label-18 float-right">100&#8372</p></td>
							</tr>
							<tr>
								<td><p class="label-18">Пакування :</p></td>
								<td align="right"><p id="wrapping-price" class="label-18 float-right">0&#8372</p></td>
							</tr>
							<tr>
								<td><p class="label-18">Грошовий переказ :</p></td>
								<td align="right"><p id="money-transaction" class="label-18 float-right">0&#8372</p></td>
							</tr>
							<tr>
								<td><p class="label-18">Зберігання :</p></td>
								<td align="right"><p id="keeping-price" class="label-18 float-right">0&#8372</p></td>
							</tr>
						</table>
						<div id="total-prive-div">
							<p class="label-20 float-left attention-label">Сума до сплати :</p>
							<p id="total-label" class="label-20 float-right attention-label">
								<script>
									var totalPriceStr = parseInt($("#delivery-price").html().slice(0, -1)) + parseInt($("#wrapping-price").html().slice(0, -1))
														+ parseInt($("#money-transaction").html().slice(0, -1)) + parseInt($("#keeping-price").html().slice(0, -1));
									$("#total-label").html(totalPriceStr + "&#8372");
								</script>
							</p>
						</div>
						<div id="payment-div">
							<p class="label-18">Сплачує :</p><br>
							<ul id="payment-ul">
								<li style=" float: right;
											width: 50%;
											font-size: 16px;
											outline: unset;">
									<input class="payment-input" type="radio" value="receiver" name="payment">Отримувач
								</li>
								<li style=" float: right;
											width: 50%;
											font-size: 16px;
											outline: unset;">
									<input class="payment-input" type="radio" value="sender" name="payment" checked>Відправник
								</li>
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
		
		<button id="create-invoice-button" class="float-right" onclick="createInvoice();">Створити ЕН</button>
		<button onclick="fillInputs();">Заповнити поля</button>
	</div>

	<footer>
		<p id="footer-text" class="label-20">2020 @All rights reserved</p>
	</footer>	

	<script>
			$(function() {
				var packageTypes = [
					"Документи",
					"Посилка",
					"Вантаж",
					"Шини, диски",
					"Палета"
				];

				$("#package-type").autocomplete({
					source: packageTypes
				});

				$.ajax({
					type: "GET",
					url: "../requests/get-current-client.php",
					success: function(responce) {
						console.log(responce);
						if(responce != null || responce != " "){
							var jsonObject = JSON.parse(responce);
							$("#clientPhoneNumber").val(jsonObject["phoneNumber"]);
							$("#clientFullName").val(jsonObject["fullName"]);
						}
					}
				});
			});
	</script>
</body>
</html>