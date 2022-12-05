<?php
require_once dirname(__FILE__) . "/../../domain/ConsultationInterval.php";
require_once dirname(__FILE__) . "/AddProgramationUC.php";

session_start();

if (!isset($_SESSION["tip"]) || $_SESSION["tip"] != 'P') {
    header("location: ../index.php");
    exit;
}

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("location: loginPage.php");
    exit;
}

$errDataProgramariiMsg = null;
$errMsg = null;

$dataProgramarii = null;

$addProgramationUC = new AddProgramationUC();

$intervalsArray = $addProgramationUC->getAllConsultationIntervals();

$medicsArray = $addProgramationUC->getAllMedics();
