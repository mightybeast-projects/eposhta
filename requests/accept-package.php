<?php
	session_start();
	$_SESSION["current_operation"] = "accept";
	if(!isset($_SESSION["current_client"]))
		$_SESSION["current_client"] = null;
	header("Location: ../php/visit-page.php");
?>