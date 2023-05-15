<?php
	session_start();
	$_SESSION["current_operation"] = "cancelled_accept";
	header("Location: ../php/visit-page.php");
?>