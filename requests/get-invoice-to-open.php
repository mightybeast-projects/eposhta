<?php
    include "../dao/InvoiceDAO.php";
    include "../entities/Client.php";
    
    session_start();

    echo json_encode($_SESSION["invoice_to_open"]);
?>