<?php
	include "../entities/User.php";
	include "../entities/Client.php";
	include "../entities/Visit.php";
    include "../entities/Invoice.php";
	session_start();
	header('Content-Type: text/html; charset=windows_1251');

	if(isset($_SESSION["current_operation"]) && $_SESSION["current_operation"] == "accept")
		header("Location: ../php/new-package-page.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Visit page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script type="text/javascript" src="../js/format-phone-number.js"></script>
        <script type="text/javascript" src="../js/client-controller.js"></script>
		<script type="text/javascript" src="../js/handle-keys.js"></script>
		<script type="text/javascript" src="../js/enable-input.js"></script>
		<script type="text/javascript" src="../js/visit-controller.js"></script>
		<script type="text/javascript" src="../js/invoice-controller.js"></script>
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
								<td style="vertical-align: center;">
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
							<p id="visit-label" class="label-20">Візит 1</p>
						</td>
						<td align="right">
							<button id="create-new-invoice-button" onclick="window.location.href = `../requests/exit-to-main-page.php`">
								Створити нову ЕН
                                <div class="button-key-label" style="background-color: #bdbdbd;">
                                    <p class="label-14">F1</p>
                                </div>
                            </button>
                            <button id="exit-button" onclick="window.location.href = `../requests/exit-to-main-page.php`">
                                Вихід
                                <div class="button-key-label">
                                    <p class="label-14">Esc</p>
                                </div>
                            </button>
						</td>
					</tr>
				</table>
			</div>

            <ul id="visit-page-content-ul">
                <li id="client-div-li" style="width: 24%;">
                    <div id="client-div">
                        <div id="client-inputs-div">
							<p class="label-18">Номер телефону</p>
							<input id="clientPhoneNumber" class="default-input form-input phone-input" maxlength="18" spellcheck="false" 
								oninput="
									findClient();
									enableInput($(clientFullName))">
                            <p class="label-18">ПІБ</p>
                            <input id="clientFullName" class="default-input form-input" spellcheck="false" onblur="createClient()">
                        </div>
                        <div id="attention-div">
                            <p class="label-20">Отримання за документами</p>
                        </div>
                    </div>
                </li>
                <li id="information-div-li" style="width: 50%;">
                    <div id="information-div">
						<div id="information-inner-div">
							<!--INVOICES GOES HERE-->
						</div>
                    </div>
                </li>
                <li id="price-div-li" style="width: 24%;">
                    <div id="price-div">
						<div id="inner-price-div">
							<table>
								<tr>
									<td>
										<p class="label-18">До сплати:<p>
									</td>
									<td align="right">
										<p id="price-label" class="label-18">0&#8372<p>
									</td>
								</tr>
							</table>
						</div>
                    </div>
                </li>
            </ul>

			<button id="close-visit-button" class="float-right" onclick="finishVisit()">
                Завершити візит
            </button>
		</div>

		<footer>
			<p id="footer-text" class="label-20">2020 @All rights reserved</p>
		</footer>
		
		<script>
			$(function() {
				showClientInvoices();
			});
		</script>
	</body>
</html>