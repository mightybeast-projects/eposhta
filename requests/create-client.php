<?php
    include "../dao/ClientDAO.php";
    session_start();

    $phoneNumber = $_POST["clientPhoneNumber"];
    $fullName = $_POST["clientFullName"];

    $clientDAO = new ClientDAO();
    $client = new Client(0, $fullName, $phoneNumber);
    $clientDAO->insert($client);
    $_SESSION["current_client"] = $client;

    echo $client;
?>