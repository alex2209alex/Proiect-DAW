<?php
require_once dirname(__FILE__) . "/AddConsultationDAO.php";
require_once dirname(__FILE__) . "/../../domain/Consultation.php";


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
        if (!$this->addConsultationDAO->isConsultationUnique($consultation->getIdInterval(), $consultation->getIdMedic(), $consultation->getConsultationDate())) {
            throw new Exception("Doctorul are deja programare la data si ora selectate");
        }
        return $this->addConsultationDAO->createConsultation($consultation);
    }
}