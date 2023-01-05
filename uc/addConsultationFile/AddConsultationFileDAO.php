<?php
require_once dirname(__FILE__) . '/../../config/Database.php';
require_once dirname(__FILE__) . '/../../domain/ConsultationFile.php';

class AddConsultationFileDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getConsultationPacientAndMedic($idConsultation): ConsultationFile
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT u.nume p_nume, u.prenume p_prenume, p.cnp, u2.nume, u2.prenume, m.id_utilizator FROM programare_consultatie pc JOIN pacient p on pc.id_pacient = p.id_utilizator JOIN utilizator u on p.id_utilizator = u.id_utilizator JOIN medic m on pc.id_medic = m.id_utilizator JOIN utilizator u2 ON u2.id_utilizator = m.id_utilizator WHERE pc.id_programare = :idConsultation";
            $stmt = $conn->prepare($sqlQuery);
            $idConsultation = htmlspecialchars(strip_tags($idConsultation));
            $stmt->bindParam(":idConsultation", $idConsultation);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $pacientName = $row['p_nume'] . ' ' . $row['p_prenume'];
                $cnp = $row['cnp'];
                $medicName = $row['nume'] . ' ' . $row['prenume'];
                $medicId = $row['id_utilizator'];
                $consultationFile = new ConsultationFile($pacientName, $cnp, $medicName, $medicId);
            }
            $conn->commit();
            $this->database->closeConnection();
            return $consultationFile;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function getConsultationFileIdUnique($consultationFile): int
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT COUNT(*) FROM fisa_consultatie fc WHERE fc.id_programare = :idConsultation";
            $stmt = $conn->prepare($sqlQuery);
            // sanitize
            // htmlspecialchars — Convert special characters to HTML entities
            // strip_tags — Strip HTML and PHP tags from a string
            $idConsultation = htmlspecialchars(strip_tags($consultationFile->getIdConsultation()));
            $stmt->bindParam(":idConsultation", $idConsultation);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if($count == 0) {
                $conn->commit();
                $this->database->closeConnection();
                return 0;
            }
            $sqlQuery = "SELECT id_fisa FROM fisa_consultatie fc WHERE fc.id_programare = :idConsultation";
            $stmt = $conn->prepare($sqlQuery);
            // sanitize
            // htmlspecialchars — Convert special characters to HTML entities
            // strip_tags — Strip HTML and PHP tags from a string
            $idConsultation = htmlspecialchars(strip_tags($consultationFile->getIdConsultation()));
            $stmt->bindParam(":idConsultation", $idConsultation);
            $stmt->execute();
            $fileId = $stmt->fetchColumn();
            $conn->commit();
            $this->database->closeConnection();
            return $fileId;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function addConsultationFile($consultationFile)
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "INSERT INTO fisa_consultatie(id_programare, diagnostic, analize_recomandate, tratament_medicamentos_recomandat) VALUES(:consultationId, :diagnostic, :recomendedAnalyses, :recomendedTreatement)";
            $stmt = $conn->prepare($sqlQuery);
            $consultationId = htmlspecialchars(strip_tags($consultationFile->getConsultationId()));
            $diagnostic = htmlspecialchars(strip_tags($consultationFile->getDiagnostic()));
            $recomendedAnalyses = htmlspecialchars(strip_tags($consultationFile->getRecomendedAnalyses()));
            $recomendedTreatement = htmlspecialchars(strip_tags($consultationFile->getRecomendedTreatement()));
            $stmt->bindParam(":consultationId", $consultationId);
            $stmt->bindParam(":diagnostic", $diagnostic);
            $stmt->bindParam(":recomendedAnalyses", $recomendedAnalyses);
            $stmt->bindParam(":recomendedTreatement", $recomendedTreatement);
            $stmt->execute();
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
        $this->database->closeConnection();
    }

    public function updateConsultationFile($consultationFile, $fileId)
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "UPDATE fisa_consultatie SET id_programare = :consultationId, diagnostic = :diagnostic, analize_recomandate = :recomendedAnalyses, tratament_medicamentos_recomandat = :recomendedTreatement WHERE id_fisa = :fileId";
            $stmt = $conn->prepare($sqlQuery);
            $consultationId = htmlspecialchars(strip_tags($consultationFile->getConsultationId()));
            $diagnostic = htmlspecialchars(strip_tags($consultationFile->getDiagnostic()));
            $recomendedAnalyses = htmlspecialchars(strip_tags($consultationFile->getRecomendedAnalyses()));
            $recomendedTreatement = htmlspecialchars(strip_tags($consultationFile->getRecomendedTreatement()));
            $fileId = htmlspecialchars(strip_tags($fileId));
            $stmt->bindParam(":consultationId", $consultationId);
            $stmt->bindParam(":diagnostic", $diagnostic);
            $stmt->bindParam(":recomendedAnalyses", $recomendedAnalyses);
            $stmt->bindParam(":recomendedTreatement", $recomendedTreatement);
            $stmt->bindParam(":fileId", $fileId);
            $stmt->execute();
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
        $this->database->closeConnection();
    }
}