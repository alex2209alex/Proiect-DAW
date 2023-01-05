<?php
require_once dirname(__FILE__) . '/../../config/Database.php';
require_once dirname(__FILE__) . '/../../domain/MedicConsultation.php';


class MedicConsultationsListDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllMedicConsultations($idMedic): array
    {
        $conn = $this->database->getConnection();
        $responseArray = array();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT pc.id_programare, pc.data_programare, interval_orar, u.nume, u.prenume, p.cnp FROM programare_consultatie pc JOIN intervale_de_consultatie ic ON ic.id_interval = pc.id_interval JOIN utilizator u on pc.id_pacient = u.id_utilizator JOIN pacient p on pc.id_pacient = p.id_utilizator WHERE pc.id_medic = :idMedic AND pc.data_programare >= CURRENT_DATE ORDER BY pc.data_programare, pc.id_interval";
            $stmt = $conn->prepare($sqlQuery);
            $idMedic = htmlspecialchars(strip_tags($idMedic));
            $stmt->bindParam(":idMedic", $idMedic);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $idConsultation = $row['id_programare'];
                $consultationDate = $row['data_programare'];
                $consultationInterval = $row['interval_orar'];
                $lastName = $row['nume'];
                $firstName = $row['prenume'];
                $cnp = $row['cnp'];
                $medicConsultation = new MedicConsultation($idConsultation, $consultationDate, $consultationInterval, $lastName, $firstName, $cnp);
                $responseArray[] = $medicConsultation;
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