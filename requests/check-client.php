<?php
    include "../dao/ClientDAO.php";
    session_start();

    $phoneNumber = $_GET["clientPhoneNumber"];
    $fullName = $_GET["clientFullName"];

    $clientDAO = new ClientDAO();
    $client = $clientDAO->selectByPhoneNumber($phoneNumber);
    $responce = false;
    if($client != null)
        if($client->getFullName() == $fullName && $client->getPhoneNumber() == $phoneNumber)
            $responce = true;
        
    echo $responce;
?>