<?php
require_once dirname(__FILE__) . '/../../config/Database.php';

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
}