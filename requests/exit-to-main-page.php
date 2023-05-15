<?php
	session_start();
    unset($_SESSION["current_client"]);
    unset($_SESSION["current_operation"]);
    unset($_SESSION["current_visit"]);
    unset($_SESSION["invoice_to_open"]);
    header("Location: ../php/main-page.php");
?>