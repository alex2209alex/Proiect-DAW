<?php
require_once dirname(__FILE__) . "/MedicConsultationsListDAO.php";


class MedicConsultationsListUC
{
    private MedicConsultationsListDAO $medicConsultationsListDAO;

    public function __construct()
    {
        $this->medicConsultationsListDAO = new MedicConsultationsListDAO();
    }

    public function getAllMedicConsultations($idMedic): array
    {
        return $this->medicConsultationsListDAO->getAllMedicConsultations($idMedic);
    }
}