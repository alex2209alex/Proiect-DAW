<?php
require_once dirname(__FILE__) . "/PacientConsultationsListDAO.php";

class PacientConsultationsListUC
{
    private PacientConsultationsListDAO $pacientConsultationsListDAO;

    public function __construct()
    {
        $this->pacientConsultationsListDAO = new PacientConsultationsListDAO();
    }

    public function getAllPacientConsultations($idPacient): array
    {
        return $this->pacientConsultationsListDAO->getAllPacientConsultations($idPacient);
    }

    public function deleteConsultation(int $idConsultation)
    {
        $this->pacientConsultationsListDAO->deleteConsultation($idConsultation);
    }
}