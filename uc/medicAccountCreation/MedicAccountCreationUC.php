<?php
require_once dirname(__FILE__) . "/MedicAccountCreationDAO.php";
require_once dirname(__FILE__) . "/../../domain/Medic.php";

class MedicAccountCreationUC
{
    private MedicAccountCreationDAO $accountCreationDAO;

    public function __construct()
    {
        $this->accountCreationDAO = new MedicAccountCreationDAO();
    }

    public function addMedic(Medic $medic): int
    {
        if ($medic->isNotValid()) {
            throw new Exception("Datele introduse nu sunt valide");
        }
        if (!$this->accountCreationDAO->isEmailUnique($medic->getEmail())) {
            throw new Exception("Exista un cont cu acelasi email");
        }
        $medic->setactivationCode($medic->generateActivationCode());
        $medic->setIsActive(true);
        return $this->accountCreationDAO->createMedicAccount($medic);
    }
}