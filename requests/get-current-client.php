<?php
    include "../entities/Client.php";
    header('Content-Type: text/html; charset=utf-8');

    session_start();
    if(isset($_SESSION["current_client"])){
        $client = $_SESSION["current_client"];
        echo "{\"fullName\": \"".$client->getFullName()."\", \"phoneNumber\": \"".$client->getPhoneNumber()."\"}";
    }
?>