<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main page</title>
	<meta http-equiv="Content-Type" content="text/html;charset=windows_1251">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/handle-keys.js"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script type="text/javascript" src="../js/client-controller.js"></script>
	<script type="text/javascript" src="../js/invoice-controller.js"></script>
</head>
<body style="font-family: Verdana;">
	<header>
		<div id="header-outer-div">
			<div id="header-inner-div">
				<div id="logo-div">
					<table>
						<tr>
							<td>
								<img src="../img/logo.png" width="32" height="32">
							</td>
							<td>
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


	<div id="operations-div">
		<div class="float-left operation-div" id="accept-operation-div" onclick="location.href='../requests/accept-package.php';">
			<img class="operation-img" src="../img/download.png">
			<p class="label-22 operation-label">Прийняти відправлення</p>
			<div class="key-label">
				<p class="label-16">F1</p>
			</div>
		</div>
		<div class="float-left operation-div" id="give-operation-div" onclick="location.href='../requests/give-package.php';">
			<img class="operation-img" src="../img/upload.png">
			<p class="label-22 operation-label">Видати відправлення</p>
			<div class="key-label">
				<p class="label-16">F2</p>
			</div>
		</div>
		<div class="float-left operation-div" id="sell-wrapping-operation-div" onclick="location.href='../php/visit-page.php';">
			<img class="operation-img" src="../img/box.png">
			<p class="label-22 operation-label">Продати пакування</p>
			<div class="key-label">
				<p class="label-16">F3</p>
			</div>
		</div>
		<div class="float-left operation-div" id="" onclick="location.href='../php/visit-page.php';">
			<img class="operation-img" src="../img/money.png">
			<p class="label-22 operation-label">Грошові перекази</p>
			<div class="key-label">
				<p class="label-16">F4</p>
			</div>
		</div>
	</div>

	<div id="visits-div">
		<div class="scrolling-wrapper" id="inner-visits-div">
			
		</div>
	</div>
	</div>

	<footer>
		<p id="footer-text" class="label-20">2020 @All rights reserved</p>
	</footer>

	<script>
	$(function() {
		$.ajax({
				type: "GET",
				url: "../requests/get-all-visits.php",
				success: function(responce) {
					console.log(responce);
					var visits = JSON.parse(responce);
					visits.reverse().forEach(function(visit){
					var imgStr = (visit.lastOperation == "accept")? "download" : "upload";
					var visitNumber = visit.number;
					var clientLastName = visit.client.fullName.split(" ")[0];
					var clientName = visit.client.fullName.split(" ")[1];
					var clientMiddleName = visit.client.fullName.split(" ")[2];
					var visitDate = visit.date;
					
					$(".scrolling-wrapper").append(
						`<div id="first-visit-div" class="visit-div card">
							<img style="height: 100%; float: right; z-index: 0; position: relative;" src="../img/`+ imgStr + `.png">
							<div class="inner-visit-div">
								<p class="label-18 visit-header">Візит `+ visitNumber +`
								<p class="label-16">`+ clientLastName +`
								<p class="label-16">`+ clientName + " " + clientMiddleName +`
								<p class="label-16 date-label">`+ visitDate +`
							</div>
						</div>`
					);
				});
				}
			});
		});
	</script>
</body>
</html>