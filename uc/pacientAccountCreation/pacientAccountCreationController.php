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

    $captcha = $_POST['g-recaptcha-response'];
    if (!$captcha) {
        $errMsg = "Nu ati verificat faptul ca nu sunteti un robot";
    } else {
        $secretKey = "SECRET-KEY";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if ($responseKeys["success"]) {
            try {
                $accountCreationUC = new PacientAccountCreationUC();
                $accountCreationUC->addPacient($pacient);
                header("location: accountConfirmationPage.php");
            } catch (Exception $e) {
                $errMsg = $e->getMessage();
            }
        } else {
            echo '<h2>Esti un robot</h2>';
        }
    }
}
