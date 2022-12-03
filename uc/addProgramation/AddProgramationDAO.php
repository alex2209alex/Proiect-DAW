<?php
require_once dirname(__FILE__) . '/../../config/Database.php';
require_once dirname(__FILE__) . '/../../domain/Medic.php';

class AddProgramationDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
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
                $medic = new Medic($id, $firstName, $lastName, $specialization);
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
}