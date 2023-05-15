<?php
	include "../dao/UserDAO.php";

	$username = $_POST["username-field"];
	$password = $_POST["password-field"];

	$userDao = new UserDAO();
	$user = $userDao->selectByUsername($username);
	if(is_null($user) || $password != $user->getPassword())
		header("Location: ../php/index.php");
	else{
		session_start();
		$_SESSION["user"] = $user;
		header("Location: ../php/main-page.php");
	}
?>