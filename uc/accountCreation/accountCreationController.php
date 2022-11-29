<?php
require_once dirname(__FILE__) . "/../../domain/User.php";
require_once dirname(__FILE__) . "/AccountCreationUC.php";

$errFirstNameMsg = null;
$errLastNameMsg = null;
$errEmailMsg = null;
$errPasswordMsg = null;
$errPasswordConfirmationMsg = null;
$errMsg = null;

$user = new User('', '', '', '', '');

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: programationsListPage.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirmation']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);

    $user = new User($email, $password, $passwordConfirmation, $firstName, $lastName);

    if ($user->isNotValidEmail()) {
        $errEmailMsg = "Acest camp este obligatorie. Introduceti o adresa de email valida";
    }

    if ($user->isNotValidFirstName()) {
        $errFirstNameMsg = "Acest camp este obligatoriu";
    }

    if ($user->isNotValidLastName()) {
        $errLastNameMsg = "Acest camp este obligatoriu";
    }

    if ($user->isNotValidPassword()) {
        $errPasswordMsg = "Acest camp este obligatoriu";
    }

    if ($user->isNotValidPasswordConfirmation()) {
        $errPasswordConfirmationMsg = "Acest camp este obligatoriu";
    }

    if ($user->passwordsNotEqual()) {
        $errPasswordMsg = "Parola si confirmare parola trebuie sa coincida";
        $errPasswordConfirmationMsg = "Parola si confirmare parola trebuie sa coincida";
    }

    try {
        $accountCreationUC = new AccountCreationUC();
        $accountCreationUC->addUser($user);

        header("location: accountConfirmationPage.php");
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}
