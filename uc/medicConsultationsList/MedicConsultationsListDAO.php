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
            $sqlQuery = "SELECT pc.id_programare, pc.data_programare, interval_orar, u.nume, u.prenume, p.cnp, m.specializare, u2.nume as nume_medic, u2.prenume as prenume_medic, fc.diagnostic, fc.tratament_medicamentos_recomandat, fc.analize_recomandate FROM programare_consultatie pc LEFT JOIN fisa_consultatie fc on pc.id_programare = fc.id_programare JOIN intervale_de_consultatie ic ON ic.id_interval = pc.id_interval JOIN utilizator u on pc.id_pacient = u.id_utilizator JOIN pacient p on pc.id_pacient = p.id_utilizator JOIN medic m on pc.id_medic = m.id_utilizator JOIN utilizator u2 ON u2.id_utilizator = m.id_utilizator WHERE pc.id_medic = :idMedic AND pc.data_programare >= CURRENT_DATE ORDER BY pc.data_programare, pc.id_interval";
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
                $specialization = $row['specializare'];
                $lastNameMedic = $row['nume_medic'];
                $firstNameMedic = $row['prenume_medic'];
                $diagnostic = $row['diagnostic'];
                if (empty($diagnostic)){
                    $diagnostic = '';
                }
                $recomendedTreatment = $row['tratament_medicamentos_recomandat'];
                if (empty($recomendedTreatment)){
                    $recomendedTreatment = '';
                }
                $recomendedAnalyses = $row['analize_recomandate'];
                if (empty($recomendedAnalyses)){
                    $recomendedAnalyses = '';
                }
                $medicConsultation = new MedicConsultation($idConsultation, $consultationDate, $consultationInterval, $lastName, $firstName, $cnp, $specialization, $lastNameMedic, $firstNameMedic, $diagnostic, $recomendedTreatment, $recomendedAnalyses);
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