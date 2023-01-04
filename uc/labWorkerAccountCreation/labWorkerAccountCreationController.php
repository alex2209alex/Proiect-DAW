<?php
require_once dirname(__FILE__) . "/../../domain/LabWorker.php";
require_once dirname(__FILE__) . "/LabWorkerAccountCreationUC.php";

$errFirstNameMsg = null;
$errLastNameMsg = null;
$errEmailMsg = null;
$errPasswordMsg = null;
$errPasswordConfirmationMsg = null;
$errSpecializationMsg = null;
$errMsg = null;

$labWorker = new LabWorker('', '', '', '', '', '');

session_start();

if (!isset($_SESSION["tip"]) || $_SESSION["tip"] != 'A') {
    header("location: /index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirmation']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $specialization = trim($_POST['specialization']);
    $labWorker = new LabWorker($specialization, $email, $password, $passwordConfirmation, $firstName, $lastName);

    if ($labWorker->isNotValidEmail()) {
        $errEmailMsg = "Acest camp este obligatorie. Introduceti o adresa de email valida";
    }

    if ($labWorker->isNotValidFirstName()) {
        $errFirstNameMsg = "Acest camp este obligatoriu";
    }

    if ($labWorker->isNotValidLastName()) {
        $errLastNameMsg = "Acest camp este obligatoriu";
    }

    if ($labWorker->isNotValidPassword()) {
        $errPasswordMsg = "Acest camp este obligatoriu";
    }

    if ($labWorker->isNotValidPasswordConfirmation()) {
        $errPasswordConfirmationMsg = "Acest camp este obligatoriu";
    }

    if ($labWorker->passwordsNotEqual()) {
        $errPasswordMsg = "Parola si confirmare parola trebuie sa coincida";
        $errPasswordConfirmationMsg = "Parola si confirmare parola trebuie sa coincida";
    }

    if ($labWorker->isNotValidSpecialization()) {
        $errSpecializationMsg = "Acest camp este obligatoriu";
    }

    try {
        $accountCreationUC = new LabWorkerAccountCreationUC();
        $accountCreationUC->addLabWorker($labWorker);
        header("location: /index.php");
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}