<?php
require_once dirname(__FILE__) . "/../../domain/Medic.php";
require_once dirname(__FILE__) . "/MedicAccountCreationUC.php";

$errFirstNameMsg = null;
$errLastNameMsg = null;
$errEmailMsg = null;
$errPasswordMsg = null;
$errPasswordConfirmationMsg = null;
$errSpecializationMsg = null;
$errMsg = null;

$medic = new Medic('', '', '', '', '', '');

session_start();

if (!isset($_SESSION["tip"]) || $_SESSION["tip"] != 'A') {
    header("location: /index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $randomStringUtils = new RandomStringUtils();
    $csfrToken = $randomStringUtils->generateString();
    $_SESSION["csfrToken"] = $csfrToken;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirmation']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $specialization = trim($_POST['specialization']);
    $medic = new Medic($specialization, $email, $password, $passwordConfirmation, $firstName, $lastName);

    if ($medic->isNotValidEmail()) {
        $errEmailMsg = "Acest camp este obligatorie. Introduceti o adresa de email valida";
    }

    if ($medic->isNotValidFirstName()) {
        $errFirstNameMsg = "Acest camp este obligatoriu";
    }

    if ($medic->isNotValidLastName()) {
        $errLastNameMsg = "Acest camp este obligatoriu";
    }

    if ($medic->isNotValidPassword()) {
        $errPasswordMsg = "Acest camp este obligatoriu";
    }

    if ($medic->isNotValidPasswordConfirmation()) {
        $errPasswordConfirmationMsg = "Acest camp este obligatoriu";
    }

    if ($medic->passwordsNotEqual()) {
        $errPasswordMsg = "Parola si confirmare parola trebuie sa coincida";
        $errPasswordConfirmationMsg = "Parola si confirmare parola trebuie sa coincida";
    }

    if ($medic->isNotValidSpecialization()) {
        $errSpecializationMsg = "Acest camp este obligatoriu";
    }

    try {
        if($_SESSION["csfrToken"] != trim($_POST['csfrToken'])) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        $accountCreationUC = new MedicAccountCreationUC();
        $accountCreationUC->addMedic($medic);
        header("location: /index.php");
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}