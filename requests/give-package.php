<?php
	session_start();
	$_SESSION["current_operation"] = "give";
	header("Location: ../php/visit-page.php");
?>