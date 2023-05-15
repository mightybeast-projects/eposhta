<?php
    include "../dao/ClientDAO.php";
    session_start();
    
    $phoneNumber = $_POST["clientPhoneNumber"];

    $clientDAO = new ClientDAO();
    $client = $clientDAO->selectByPhoneNumber($phoneNumber);
    $_SESSION["current_client"] = $client;
    echo $_SESSION["current_client"];
?>