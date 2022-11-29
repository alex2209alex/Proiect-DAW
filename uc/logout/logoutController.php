<?php

session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("location: loginPage.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
    header("location: loginPage.php");
    exit;
}