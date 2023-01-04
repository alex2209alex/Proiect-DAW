<?php
require_once dirname(__FILE__) . '/../../config/Database.php';
require_once dirname(__FILE__) . '/../../domain/PacientConsultation.php';


class PacientConsultationsListDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllPacientConsultations($idPacient): array
    {
        $conn = $this->database->getConnection();
        $responseArray = array();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT pc.data_programare, interval_orar, u.nume, u.prenume, m.specializare FROM programare_consultatie pc JOIN intervale_de_consultatie ic ON ic.id_interval = pc.id_interval JOIN utilizator u on pc.id_medic = u.id_utilizator JOIN medic m on pc.id_medic = m.id_utilizator WHERE pc.id_pacient = :idPacient AND pc.data_programare >= CURRENT_DATE ORDER BY pc.data_programare, pc.id_interval";
            $stmt = $conn->prepare($sqlQuery);
            $idPacient = htmlspecialchars(strip_tags($idPacient));
            $stmt->bindParam(":idPacient", $idPacient);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $consultationDate = $row['data_programare'];
                $consultationInterval = $row['interval_orar'];
                $lastName = $row['nume'];
                $firstName = $row['prenume'];
                $specialization = $row['specializare'];
                $pacientConsultation = new PacientConsultation($consultationDate, $consultationInterval, $lastName, $firstName, $specialization);
                $responseArray[] = $pacientConsultation;
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