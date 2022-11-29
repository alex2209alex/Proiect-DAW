<?php
require_once dirname(__FILE__) . "/../../domain/User.php";
require_once dirname(__FILE__) . "/AccountConfirmationUC.php";

$errEmailMsg = null;
$errMsg = null;

$user = new User('', '', '', '', '');

$email = null;
$activationCode = null;

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: makeProgramationPage.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $activationCode = trim($_POST['activationCode']);

    $user = new User($email, '', '', '', '');
    $user->setActivationCode($activationCode);

    if ($user->isNotValidEmail()) {
        $errEmailMsg = "Acest camp este obligatorie. Introduceti o adresa de email valida";
    }

    try {
        $accountConfirmationUC = new AccountConfirmationUC();
        $accountConfirmationUC->confirmUser($user);
        header("location: loginPage.php");
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}
