<?php
require_once dirname(__FILE__) . "/LabWorkerAccountCreationDAO.php";
require_once dirname(__FILE__) . "/../../domain/LabWorker.php";

class LabWorkerAccountCreationUC
{
    private LabWorkerAccountCreationDAO $accountCreationDAO;

    public function __construct()
    {
        $this->accountCreationDAO = new LabWorkerAccountCreationDAO();
    }

    public function addLabWorker(LabWorker $labWorker): int
    {
        if ($labWorker->isNotValid()) {
            throw new Exception("Datele introduse nu sunt valide");
        }
        if (!$this->accountCreationDAO->isEmailUnique($labWorker->getEmail())) {
            throw new Exception("Exista un cont cu acelasi email");
        }
        $labWorker->setactivationCode($labWorker->generateActivationCode());
        $labWorker->setIsActive(true);
        return $this->accountCreationDAO->createLabWorkerAccount($labWorker);
    }
}