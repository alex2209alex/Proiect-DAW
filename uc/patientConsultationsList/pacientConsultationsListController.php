<?php
require_once dirname(__FILE__) . "/../../domain/PacientConsultation.php";
require_once dirname(__FILE__) . "/PacientConsultationsListUC.php";

$errMsg = null;

$pacientConsultationsListUC = new PacientConsultationsListUC();

session_start();

if (!isset($_SESSION["tip"]) || $_SESSION["tip"] != 'P') {
    header("location: /index.php");
    exit;
}

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("location: /index.php");
    exit;
}

$idPacient = intval(trim($_SESSION["id"]));
$pacientConsultationsArray = array();
try {
    $pacientConsultationsArray = $pacientConsultationsListUC->getAllPacientConsultations($idPacient);
} catch (Exception $e) {
    $errMsg = $e->getMessage();
}
