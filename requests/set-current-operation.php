<?php
    session_start();
    
    $currentOperation = $_POST["operation"];

    $_SESSION["current_operation"] = $currentOperation;
    echo $_SESSION["current_operation"];
?>