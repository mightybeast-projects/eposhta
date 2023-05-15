<?php
    include "../dao/ClientDAO.php";

    $phoneNumber = $_GET["clientPhoneNumber"];
    
    $clientDAO = new ClientDAO();
    $clients = $clientDAO->selectAllByPhoneNumber($phoneNumber);
    if($clients != null){
        echo "[";
        foreach($clients as $client){
            echo "{\"label\": \"".$client->getPhoneNumber()." ".$client->getFullName()."\", \"value\": \"".$client->getPhoneNumber()."\"}";
            if(next( $clients)){
                echo ", ";
            }
        }
        echo "]";
    }
?>