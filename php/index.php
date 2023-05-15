<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" title="Default Styles" media="screen">
</head>
<body>
	<div id="login-div">
		<form method="post" action="../requests/log-in-user.php">
			<table id="login-table">
				<tr><td><p class="label-20">Username:</p></td></tr>
				<tr><td><input class="default-input" id="username-field" type="text" name="username-field" align="center"></td></tr>
				<tr><td><p class="label-20">Password:</p></td></tr>
				<tr><td><input class="default-input" id="password-field" type="password" name="password-field"></td></tr>
				<tr><td align="right">
					<button id="login-button" type="submit">Login</button>
				</td></tr>
			</table>
		</form>
	</div>

	<div style="
				height: 320px;
				margin: 0;
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);">
		<table>
			<tr>
				<td>
					<img src="../img/logo.png" width="32" height="32">
				</td>
				<td>
					<p class="label-20" id="logo-text">
						<a id="logo-link" href="index.php" style="
									color: #FF9A00;
									">EPoshta</a> 
					</p>
				</td>
			</tr>
		</table>
	</div>
	
	<a id="registration-link" href="registration-page.php">Register new user</a>
</body>
</html>