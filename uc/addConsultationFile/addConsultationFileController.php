<?php
require_once dirname(__FILE__) . "/../../domain/ConsultationFile.php";
require_once dirname(__FILE__) . "/AddConsultationFileUC.php";

$errMsg = null;
$errDiagnosticMsg = null;

$addConsultationFileUC = new AddConsultationFileUC();

session_start();

if (!isset($_SESSION["tip"]) || $_SESSION["tip"] != 'M') {
    header("location: /index.php");
    exit;
}

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
    header("location: /index.php");
    exit;
}

$url = basename($_SERVER['REQUEST_URI']);
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$consultationId = $params['id'];

$consultationFile = $addConsultationFileUC->getConsultationPacientAndMedic($consultationId);

if (!isset($_SESSION["id"]) || $_SESSION["id"] != $consultationFile->getMedicId()) {
    header("location: /index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diagnostic = trim($_POST['diagnostic']);
    $recomendedAnalyses = trim($_POST['recomendedAnalyses']);
    $recomendedTreatement = trim($_POST['recomendedTreatement']);
    $consultationFile->setDiagnostic($diagnostic);
    $consultationFile->setRecomendedAnalyses($recomendedAnalyses);
    $consultationFile->setRecomendedTreatement($recomendedTreatement);
    $consultationFile->setConsultationId($consultationId);

    if($consultationFile->isNotValidDiagnostic()) {
        $errDiagnosticMsg = "Acest camp este obligatoriu";
    }

    try {
        $addConsultationFileUC = new AddConsultationFileUC();
        $addConsultationFileUC->addOrUpdateConsultationFile($consultationFile);
        header("location: medicConsultationsListPage.php");
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}