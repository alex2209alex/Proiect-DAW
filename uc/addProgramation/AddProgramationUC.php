<?php
require_once dirname(__FILE__) . "/AddProgramationDAO.php";

class AddProgramationUC
{
    private AddProgramationDAO $addProgramationDAO;

    public function __construct()
    {
        $this->addProgramationDAO = new AddProgramationDAO();
    }

    public function getAllConsultationIntervals(): array
    {
        return $this->addProgramationDAO->getAllConsultationIntervals();
    }
}