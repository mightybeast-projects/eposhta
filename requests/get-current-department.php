<?php
    include "../dao/DepartmentDAO.php";
    include "../entities/User.php";

    header('Content-Type: text/html; charset=utf-8');

    session_start();
    $departmentDAO = new DepartmentDAO();
    echo $departmentDAO->getDepartmentNumber($_SESSION["user"]->getDepartmentId());
?>