<?php
require_once dirname(__FILE__) . '/../../config/Database.php';
require_once dirname(__FILE__) . '/../../domain/Medic.php';
require_once dirname(__FILE__) . '/../../domain/ConsultationInterval.php';
require_once dirname(__FILE__) . '/../../domain/Consultation.php';


class AddConsultationDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isConsultationUnique(int $idInterval, int $idMedic, string $consultationDate): bool
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT COUNT(*) FROM programare_consultatie WHERE id_interval = :idInterval AND id_medic = :idMedic AND data_programare = :consultationDate";
            $stmt = $conn->prepare($sqlQuery);
            $idInterval = htmlspecialchars(strip_tags($idInterval));
            $idMedic = htmlspecialchars(strip_tags($idMedic));
            $consultationDate = htmlspecialchars(strip_tags($consultationDate));
            $stmt->bindParam(":idInterval", $idInterval);
            $stmt->bindParam(":idMedic", $idMedic);
            $stmt->bindParam(":consultationDate", $consultationDate);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $conn->commit();
            $this->database->closeConnection();
            return $count == 0;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function getAllConsultationIntervals(): array
    {
        $conn = $this->database->getConnection();
        $responseArray = array();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT * FROM intervale_de_consultatie";
            $stmt = $conn->prepare($sqlQuery);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $id =  $row['id_interval'];
                $label = $row['interval_orar'];
                $consultationInterval = new ConsultationInterval($id, $label);
                $responseArray[] = $consultationInterval;
            }
            $conn->commit();
            $this->database->closeConnection();
            return $responseArray;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function getAllMedics(): array
    {
        $conn = $this->database->getConnection();
        $responseArray = array();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT utilizator.id_utilizator, utilizator.nume, utilizator.prenume, m.specializare FROM utilizator INNER JOIN medic m on utilizator.id_utilizator = m.id_utilizator WHERE utilizator.este_activ = TRUE";
            $stmt = $conn->prepare($sqlQuery);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $id =  $row['id_utilizator'];
                $firstName = $row['prenume'];
                $lastName = $row['nume'];
                $specialization = $row['specializare'];
                $medic = new Medic($specialization, '', '', '', $firstName, $lastName);
                $medic->setId($id);
                $responseArray[] = $medic;
            }
            $conn->commit();
            $this->database->closeConnection();
            return $responseArray;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function createConsultation(Consultation $consultation): int
    {
        $conn = $this->database->getConnection();
        $idConsultation = -1;
        try {
            $conn->beginTransaction();
            $sqlQuery = "INSERT INTO programare_consultatie(id_interval, id_medic, id_pacient, data_programare) VALUES(:idInterval, :idMedic, :idPacient, :consultationDate)";
            $stmt = $conn->prepare($sqlQuery);
            $idInterval = htmlspecialchars(strip_tags($consultation->getIdInterval()));
            $idMedic = htmlspecialchars(strip_tags($consultation->getIdMedic()));
            $idPacient = htmlspecialchars(strip_tags($consultation->getIdPacient()));
            $consultationDate = htmlspecialchars(strip_tags($consultation->getConsultationDate()));
            $stmt->bindParam(":idInterval", $idInterval);
            $stmt->bindParam(":idMedic", $idMedic);
            $stmt->bindParam(":idPacient", $idPacient);
            $stmt->bindParam(":consultationDate", $consultationDate);
            $stmt->execute();
            $conn->commit();
            $idConsultation = $conn->lastInsertId();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
        $this->database->closeConnection();
        return $idConsultation;
    }
}