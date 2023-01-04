<?php
require_once dirname(__FILE__) . "/../../domain/User.php";
require_once dirname(__FILE__) . "/AccountConfirmationUC.php";

$errEmailMsg = null;
$errActivationCodeMsg = null;
$errMsg = null;

$user = new User('', '', '', '', '');

$email = null;
$activationCode = null;

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: /index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $activationCode = trim($_POST['activationCode']);

    $user = new User($email, '', '', '', '');
    $user->setActivationCode($activationCode);

    if ($user->isNotValidEmail()) {
        $errEmailMsg = "Acest camp este obligatoriu. Introduceti o adresa de email valida";
    }

    if ($user->isNotValidActivationCode()) {
        $errActivationCodeMsg = "Acest camp este obligatoriu. Introduceti codul de activare";
    }

    $captcha = $_POST['g-recaptcha-response'];
    if (!$captcha) {
        $errMsg = "Nu ati verificat faptul ca nu sunteti un robot";
    } else {
        $secretKey = "6LcnIs0jAAAAACK_rLi4zjy-P-9RfcXttMdlo3Lh";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha) . '&ip=' . urlencode($ip);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if ($responseKeys["success"]) {
            try {
                $accountConfirmationUC = new AccountConfirmationUC();
                $accountConfirmationUC->confirmUser($user);
                header("location: loginPage.php");
            } catch (Exception $e) {
                $errMsg = $e->getMessage();
            }
        } else {
            echo '<h2>Esti un robot</h2>';
        }
    }
}
