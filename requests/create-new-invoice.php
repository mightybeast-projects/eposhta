<?php
    include "../dao/DepartmentDAO.php";
    include "../dao/ClientDAO.php";
    include "../dao/InvoiceDAO.php";
    include "../entities/Visit.php";
    include "../entities/User.php";

    session_start();
    header('Content-Type: text/html; charset=utf-8');

    $senderPhone = $_POST["senderPhone"];
    $senderFullName = $_POST["senderFullName"];
    $senderDepartmentNumber = $_POST["senderDepartmentNumber"];
    $packageType = $_POST["packageType"];
    $packageDescription = $_POST["packageDescription"];
    $packagePrice = $_POST["packagePrice"];
    $weight = $_POST["weight"];
    $width = $_POST["width"];
    $depth = $_POST["depth"];
    $height = $_POST["height"];
    $receiverPhone = $_POST["receiverPhone"];
    $receiverFullName = $_POST["receiverFullName"];
    $receiverDepartmentNumber = $_POST["receiverDepartmentNumber"];
    $payedBy = $_POST["payedBy"];

    $packageId;

    //Create package
    $packageDAO = new PackageDAO();
    $package = new Package(0, $packageType, $packageDescription, $packagePrice, $width." ".$depth." ".$height, $weight, 1);
    $packageDAO->insert($package);
    $packageId = mysqli_insert_id($packageDAO->getConnection());

    //Get attributes for invoice
    $departmentDAO = new DepartmentDAO();
    $senderAddr = $departmentDAO->getDepartmentAddrByNumber($senderDepartmentNumber);
    $receiverAddr = $departmentDAO->getDepartmentAddrByNumber($receiverDepartmentNumber);

    $clientDAO = new ClientDAO();
    $sender = $clientDAO->selectByPhoneAndName($senderPhone, $senderFullName);
    $receiver = $clientDAO->selectByPhoneAndName($receiverPhone, $receiverFullName);

    //Create invoice
    $invoiceDAO = new InvoiceDAO();
    $invoice = new Invoice(0, $invoiceDAO->getLastNumber() + 1, $senderAddr, $receiverAddr, 100, $payedBy, false, false, false, $sender->getId(), 
                            $receiver->getId(), date("Y-m-d"), date("Y-m-d"), $senderDepartmentNumber, $receiverDepartmentNumber, $packageId);
    $invoiceDAO->insert($invoice);

    if(!isset($_SESSION["current_client"]))
        $_SESSION["current_client"] = $sender;
    if(!isset($_SESSION["current_visit"])){
        $visit = new Visit($_SESSION["current_client"], $_SESSION["user"]);
        $_SESSION["current_visit"] = $visit;
    }
    echo $_SESSION["current_visit"];

    $_SESSION["current_visit"]->addInvoice($invoice);
    $_SESSION["current_operation"] = "accepted";

    echo $_SESSION["current_visit"];

    header("Location: ../php/visit-page.php");
?>