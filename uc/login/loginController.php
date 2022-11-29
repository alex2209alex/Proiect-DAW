<?php
require_once dirname(__FILE__) . "/../../domain/User.php";
require_once dirname(__FILE__) . "/LoginUC.php";

$errEmailMsg = null;
$errPasswordMsg = null;
$errMsg = null;

$password = '';
$email = '';
$tip = 'P';

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: makeProgramationPage.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $tip = trim($_POST['tip']);

    $user = new User($email, $password, '', '', '');

    if ($user->isNotValidEmail()) {
        $errEmailMsg = "Acest camp este obligatorie. Introduceti o adresa de email valida";
    }

    if ($user->isNotValidPassword()) {
        $errPasswordMsg = "Acest camp este obligatoriu";
    }

    try {
        $loginUC = new LoginUC();
        if ($tip == 'P') {
            $id = $loginUC->loginPacient($email, $password);
            if ($id != -1) {
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $email;
                $_SESSION["tip"] = 'P';

                header("location: makeProgramationPage.php");
            }
        }
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
    }
}