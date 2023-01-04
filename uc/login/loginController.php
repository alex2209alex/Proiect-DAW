<?php
require_once dirname(__FILE__) . "/../../domain/User.php";
require_once dirname(__FILE__) . "/LoginUC.php";

$errEmailMsg = null;
$errPasswordMsg = null;
$errMsg = null;

$password = '';
$email = '';
$tip = '';

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("location: /index.php");
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
                $loginUC = new LoginUC();
                if ($tip == 'P') {
                    $id = $loginUC->loginPacient($email, $password);
                    if ($id != -1) {
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $email;
                        $_SESSION["tip"] = 'P';
                        header("location: /index.php");
                    }
                } else if ($tip == 'M') {
                    $id = $loginUC->loginMedic($email, $password);
                    if ($id != -1) {
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $email;
                        $_SESSION["tip"] = 'M';
                        header("location: /index.php");
                    }
                } else if ($tip == 'L') {
                    $id = $loginUC->loginLaborant($email, $password);
                    if ($id != -1) {
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $email;
                        $_SESSION["tip"] = 'L';
                        header("location: /index.php");
                    }
                } else if ($tip == 'A') {
                    $id = $loginUC->loginAdmin($email, $password);
                    if ($id != -1) {
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $email;
                        $_SESSION["tip"] = 'A';
                        header("location: /index.php");
                    }
                }
            } catch (Exception $e) {
                $errMsg = $e->getMessage();
            }
        } else {
            echo '<h2>Esti un robot</h2>';
        }
    }
}