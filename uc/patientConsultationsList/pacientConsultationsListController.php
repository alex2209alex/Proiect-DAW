<?php
require_once dirname(__FILE__) . "/../../domain/PacientConsultation.php";
require_once dirname(__FILE__) . "/PacientConsultationsListUC.php";
require_once dirname(__FILE__) . "/../RandomStringUtils.php";

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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $randomStringUtils = new RandomStringUtils();
    $csfrToken = $randomStringUtils->generateString();
    $_SESSION["csfrToken"] = $csfrToken;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idConsultation = intval(trim($_POST["idConsultation"]));
    try {
        if($_SESSION["csfrToken"] != trim($_POST['csfrToken'])) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        $pacientConsultationsListUC->deleteConsultation($idConsultation);
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
    header("location: /pages/pacientConsultationsListPage.php");
}

$idPacient = intval(trim($_SESSION["id"]));
$pacientConsultationsArray = array();
try {
    $pacientConsultationsArray = $pacientConsultationsListUC->getAllPacientConsultations($idPacient);
} catch (Exception $e) {
    $errMsg = $e->getMessage();
}
