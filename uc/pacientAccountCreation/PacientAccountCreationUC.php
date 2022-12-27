<?php
require_once dirname(__FILE__) . "/PacientAccountCreationDAO.php";
require_once dirname(__FILE__) . "/../../domain/Pacient.php";
require_once dirname(__FILE__) . "/../../mailer/class.phpmailer.php";
require_once dirname(__FILE__) . "/../../mailer/mail_config.php";

class PacientAccountCreationUC
{
    private PacientAccountCreationDAO $accountCreationDAO;

    public function __construct()
    {
        $this->accountCreationDAO = new PacientAccountCreationDAO();
    }

    public function addPacient(Pacient $pacient): int
    {
        if ($pacient->isNotValid()) {
            throw new Exception("Datele introduse nu sunt valide");
        }
        if (!$this->accountCreationDAO->isEmailUnique($pacient->getEmail())) {
            throw new Exception("Exista un cont cu acelasi email");
        }
        $pacient->setactivationCode($pacient->generateActivationCode());
        $pacient->setIsActive(false);
        $this->sendEmail($pacient->getEmail(), $pacient->getFirstName(), $pacient->getLastName(), $pacient->getActivationCode());
        return $this->accountCreationDAO->createPacientAccount($pacient);
    }

    public function sendEmail(string $email, string $firstName, string $lastName, string $activationCode): void
    {
        // Mesajul
        $message = "Codul dumneavoastra de validare este " . $activationCode;
        // În caz că vre-un rând depășește N caractere, trebuie să utilizăm
        // wordwrap()
        $message = wordwrap($message, 20, "<br/>\n");
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try {
            $mail->SMTPDebug = 3;
            $mail->SMTPAuth = true;
            $to = $email;
            $nume = $firstName . " " . $lastName;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->Username = 'phpproiectdaw@gmail.com'; // GMAIL username
            $mail->Password = 'jtgaqvzekdzdwgfi'; // GMAIL password
            $mail->AddAddress($to, $nume);
            $mail->SetFrom('phpproiectdaw@gmail.com', 'Pavel Alexandru');
            $mail->Subject = 'Cod validare';
            $mail->AltBody = 'To view this post you need a compatible HTML viewer!';
            $mail->MsgHTML($message);
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //error from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //error from anything else!
        }
    }
}