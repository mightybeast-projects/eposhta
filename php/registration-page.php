<!DOCTYPE html>
<html>
<head>
	<title>Registration page</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" title="Default Styles" media="screen">
</head>
<body>

	<div id="registration-div">

		<p class="label-20" align="center" style="margin-top: 10px;">Register new user :</p>

		<form method="post" action="../requests/register-new-user.php">
			<table id="registration-table">
				<tr>
					<td><p class="label-18">Input full name :</p></td>
				</tr>
				<tr>
					<td>
						<input class="default-input" name="full-name-field">
					</td>
				</tr>
				<tr>
					<td><p class="label-18">Input username :</p></td>
				</tr>
				<tr>
					<td>
						<input class="default-input" name="username-field">
					</td>
				</tr>
				<tr>
					<td>
						<p class="label-18">Input password :</p>
					</td>
				</tr>
				<tr>
					<td>
						<input class="default-input" name="password-field">
					</td>
				</tr>
				<tr>
					<td>
						<p class="label-18">Choose position :</p>
					</td>
				</tr>
				<tr>
					<td>
						<select id="position-select" name="position-select">
							<option>Operator</option>
							<option>Acceptor</option>
							<option>Executive</option>
							<option>Department manager</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p class="label-18">Input department number :</p>
					</td>
				</tr>
				<tr>
					<td>
						<input class="default-input" name="department-field">
					</td>
				</tr>
				<tr>
					<td align="right">
						<button id="login-button" type="submit">Register</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

    <div style="
                height: 320px;
                margin: 0;
                position: absolute;
                top: 37%;
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
	
</body>
</html>