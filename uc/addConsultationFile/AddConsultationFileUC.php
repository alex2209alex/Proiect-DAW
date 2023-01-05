<?php
require_once dirname(__FILE__) . "/AddConsultationFileDAO.php";

class AddConsultationFileUC
{
    private AddConsultationFileDAO $addConsultationFileDAO;

    public function __construct()
    {
        $this->addConsultationFileDAO = new AddConsultationFileDAO();
    }

    public function getConsultationPacientAndMedic($idConsultation): ConsultationFile
    {
        return $this->addConsultationFileDAO->getConsultationPacientAndMedic($idConsultation);
    }

    public function addOrUpdateConsultationFile($consultationFile)
    {
        if ($consultationFile->isNotValid()) {
            throw new Exception("Datele introduse nu sunt valide");
        }
        $fileId = $this->addConsultationFileDAO->getConsultationFileIdUnique($consultationFile);
        if (!$fileId) {
            $this->addConsultationFileDAO->addConsultationFile($consultationFile);
        } else {
            $this->addConsultationFileDAO->updateConsultationFile($consultationFile, $fileId);
        }
    }
}