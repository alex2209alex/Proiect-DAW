<?php
require_once dirname(__FILE__) . "/../../domain/ConsultationInterval.php";
require_once dirname(__FILE__) . "/../../domain/Consultation.php";
require_once dirname(__FILE__) . "/AddConsultationUC.php";
require_once dirname(__FILE__) . "/../RandomStringUtils.php";


$errConsultationDateMsg = null;
$errIdMedicMsg = null;
$errIdIntervalMsg = null;
$idMedic = null;
$idInterval = null;
$errMsg = null;

$addProgramationUC = new AddConsultationUC();
$intervalsArray = $addProgramationUC->getAllConsultationIntervals();
$medicsArray = $addProgramationUC->getAllMedics();

$consultation = new Consultation(-1, -1, -1, '');

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
    $idInterval = intval(trim($_POST['idInterval']));
    $idPacient = intval(trim($_SESSION["id"]));
    $idMedic = intval(trim($_POST['idMedic']));
    $consultationDate = trim($_POST['consultationDate']);
    $consultation = new Consultation($idInterval, $idPacient, $idMedic, $consultationDate);

    if ($consultation->isNotValidConsultationDate()) {
        $errConsultationDateMsg = "Acest camp este obligatorie. Introduceti o data incepand cu ziua de maine";
    }

    if ($consultation->isNotValidIdMedic()) {
        $errIdMedicMsg = "Acest camp este obligatorie";
    }

    if ($consultation->isNotValidIdInterval()) {
        $errIdIntervalMsg = "Acest camp este obligatorie";
    }

    try {
        if($_SESSION["csfrToken"] != trim($_POST['csfrToken'])) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        $addConsultationUC = new AddConsultationUC();
        $addConsultationUC->addConsultation($consultation);
        header("location: pacientConsultationsListPage.php");
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}
