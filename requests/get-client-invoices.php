<?php
    include "../dao/ClientDAO.php";
    include "../dao/InvoiceDAO.php";
    include "../entities/Visit.php";
    session_start();

    $clientPhone = $_POST["clientPhoneNumber"];
    $clientFullName = $_POST["clientFullName"];
    $clientType = $_POST["clientType"];
    $clientDAO = new ClientDAO();
    $client = $clientDAO->selectByPhoneAndName($clientPhone, $clientFullName);

    $invoiceDAO = new InvoiceDAO();
    $invoices = array();

    if($clientType == "receiver")
        $invoices = $invoiceDAO->getAllByReceiverId($client->getId());
    if($clientType == "sender")
        $invoices = $invoiceDAO->getAllBySenderId($client->getId());

    foreach($invoices as $invoice){
        $packageDAO = $invoiceDAO->packageDAO;
        $package = $packageDAO->select($invoice->getPackageId());
        $invoice->setPackage($package);
    }

    $visit = $_SESSION["current_visit"];
    $visit->setInvoices($invoices);
    echo json_encode($invoices);
    
?>