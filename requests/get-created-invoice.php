<?php
    include "../dao/InvoiceDAO.php";
    include "../dao/ClientDAO.php";
    
    session_start();

    $invoiceNumber = $_POST["invoiceNumber"];
    $clientDAO = new ClientDAO();
    $invoiceDAO = new InvoiceDAO();
    
    $invoice = $invoiceDAO->selectByNumber($invoiceNumber);
    $invoice->setSender($clientDAO->selectById($invoice->getSenderId()));
    $invoice->setReceiver($clientDAO->selectById($invoice->getReceiverId()));

    echo json_encode($invoice);
    $_SESSION["invoice_to_open"] = $invoice;
?>