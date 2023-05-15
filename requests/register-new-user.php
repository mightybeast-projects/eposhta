<?php
	include "../dao/UserDAO.php";

	$fullName = $_POST["full-name-field"];
	$username = $_POST["username-field"];
	$password = $_POST["password-field"];
	$position = $_POST["position-select"];
	$department = $_POST["department-field"];

	$userDao = new UserDAO();
	$user = new User(1, $fullName, $username, $password, $position, $department);
	$userDao->insert($user);

	header("Location: ../php/index.php");
?>