<?php
require_once dirname(__FILE__) . "/../../domain/MedicConsultation.php";
require_once dirname(__FILE__) . "/MedicConsultationsListUC.php";

$errMsg = null;

$medicConsultationsListUC = new MedicConsultationsListUC();

session_start();

if (!isset($_SESSION["tip"]) || $_SESSION["tip"] != 'M') {
    header("location: /index.php");
    exit;
}

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("location: /index.php");
    exit;
}

$idMedic = intval(trim($_SESSION["id"]));
$medicConsultationsArray = array();
try {
    $medicConsultationsArray = $medicConsultationsListUC->getAllMedicConsultations($idMedic);
} catch (Exception $e) {
    $errMsg = $e->getMessage();
}
