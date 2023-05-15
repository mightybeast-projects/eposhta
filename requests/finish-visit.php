<?php
    include "../dao/VisitDAO.php";
    session_start();

    $currentOperation = $_SESSION["current_operation"];
    $user = $_SESSION["user"];
    $client = $_SESSION["current_client"];

    $visitDAO = new VisitDAO();

    if(isset($_SESSION["current_visit"])){
        $visit = $_SESSION["current_visit"];
        $user->addVisitsCounter();
        $visit->setNumber($user->getVisitsCounter());

        if($currentOperation == "accepted"){
            $_SESSION["current_operation"] = "accept";
            $visitDAO->insert($visit);
            $visitDAO->sentPackages($visit->getClient()->getId());
        }

        if($currentOperation == "give"){
            $visitDAO->insert($visit);
            $visitDAO->receivedPackages($visit->getClient()->getId());
        }

    }
?>