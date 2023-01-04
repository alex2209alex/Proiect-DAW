<?php
require_once dirname(__FILE__) . "/../../domain/Pacient.php";
require_once dirname(__FILE__) . "/PacientAccountCreationUC.php";

$errFirstNameMsg = null;
$errLastNameMsg = null;
$errEmailMsg = null;
$errPasswordMsg = null;
$errPasswordConfirmationMsg = null;
$errCnpMsg = null;
$errMsg = null;

$pacient = new Pacient('', '', '', '', '', '');

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: /index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secret = "6LcnIs0jAAAAACK_rLi4zjy-P-9RfcXttMdlo3Lh";
    $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];

    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $resp = $recaptcha->setExpectedHostname('proiect-php.herokuapp.com')->verify($gRecaptchaResponse, $remoteIp);
    if ($resp->isSuccess()) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['passwordConfirmation']);
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $cnp = trim($_POST['cnp']);
        $pacient = new Pacient($cnp, $email, $password, $passwordConfirmation, $firstName, $lastName);

        if ($pacient->isNotValidEmail()) {
            $errEmailMsg = "Acest camp este obligatorie. Introduceti o adresa de email valida";
        }

        if ($pacient->isNotValidFirstName()) {
            $errFirstNameMsg = "Acest camp este obligatoriu";
        }

        if ($pacient->isNotValidLastName()) {
            $errLastNameMsg = "Acest camp este obligatoriu";
        }

        if ($pacient->isNotValidPassword()) {
            $errPasswordMsg = "Acest camp este obligatoriu";
        }

        if ($pacient->isNotValidPasswordConfirmation()) {
            $errPasswordConfirmationMsg = "Acest camp este obligatoriu";
        }

        if ($pacient->passwordsNotEqual()) {
            $errPasswordMsg = "Parola si confirmare parola trebuie sa coincida";
            $errPasswordConfirmationMsg = "Parola si confirmare parola trebuie sa coincida";
        }

        if ($pacient->isNotValidCnp()) {
            $errCnpMsg = "CNP-ul este obligatoriu si trebuie sa contina 13 cifre";
        }

        try {
            $accountCreationUC = new PacientAccountCreationUC();
            $accountCreationUC->addPacient($pacient);
            header("location: accountConfirmationPage.php");
        } catch (Exception $e) {
            $errMsg = $e->getMessage();
        }
    } else {
        $errMsg = $resp->getErrorCodes();
    }
}
