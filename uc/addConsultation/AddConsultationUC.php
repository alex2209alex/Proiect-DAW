<?php
require_once dirname(__FILE__) . "/AddConsultationDAO.php";
require_once dirname(__FILE__) . "/../../domain/Consultation.php";
require_once dirname(__FILE__) . "/../../mailer/class.phpmailer.php";
require_once dirname(__FILE__) . "/../../mailer/mail_config.php";

class AddConsultationUC
{
    private AddConsultationDAO $addConsultationDAO;

    public function __construct()
    {
        $this->addConsultationDAO = new AddConsultationDAO();
    }

    public function getAllConsultationIntervals(): array
    {
        return $this->addConsultationDAO->getAllConsultationIntervals();
    }

    public function getAllMedics(): array
    {
        return $this->addConsultationDAO->getAllMedics();
    }

    public function addConsultation(Consultation $consultation): int
    {
        if($consultation->isNotValid()) {
            throw new Exception("Datele introduse nu sunt valide");
        }
        if (!$this->addConsultationDAO->isConsultationUniqueForPacient($consultation->getIdPacient(), $consultation->getConsultationDate())) {
            throw new Exception("Aveti deja o programare la data selectata");
        }
        if (!$this->addConsultationDAO->isConsultationUniqueForMedic($consultation->getIdInterval(), $consultation->getIdMedic(), $consultation->getConsultationDate())) {
            throw new Exception("Doctorul are deja programare la data si ora selectate");
        }
        $pacient = $this->addConsultationDAO->getEmailAndPacientName($consultation->getIdPacient());
        $this->sendEmail($pacient->getFirstName(), $pacient->getLastName(), $pacient->getEmail(), $consultation->getConsultationDate());
        return $this->addConsultationDAO->createConsultation($consultation);
    }

    public function sendEmail(string $firstName, string $lastName, string $email, string $consultationDate): void
    {
        // Mesajul
        $message = "Ati facut o programare pe data de " . $consultationDate . ". O puteti vedea in lista dumneavoastra de programari";
        // În caz că vre-un rând depășește N caractere, trebuie să utilizăm
        // wordwrap()
        $message = wordwrap($message, 100, "<br/>\n");
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
            $mail->Subject = 'Confirmare programare';
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