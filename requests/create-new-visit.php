<?php
    include "../entities/Visit.php";
    include "../entities/User.php";
    include "../entities/Client.php";
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    if(!isset($_SESSION["current_visit"])){
        $visit = new Visit($_SESSION["current_client"], $_SESSION["user"]);
        $_SESSION["current_visit"] = $visit;
    }
    echo $_SESSION["current_visit"];
?>