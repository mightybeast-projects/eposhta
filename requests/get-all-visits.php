<?php
    include "../dao/VisitDAO.php";
    session_start();

    $user = $_SESSION["user"];
    //echo $user;
    $visitDAO = new VisitDAO();
    $visits = $visitDAO->selectAllByUserId($user->getId());

    echo json_encode($visits);

    //header("Location: ../php/visit-page.php");
?>