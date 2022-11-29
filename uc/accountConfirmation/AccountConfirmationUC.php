<?php
require_once dirname(__FILE__) . "/AccountConfirmationDAO.php";
require_once dirname(__FILE__) . "/../../domain/User.php";

class AccountConfirmationUC
{
    private AccountConfirmationDAO $accountConfirmationDAO;

    public function __construct()
    {
        $this->accountConfirmationDAO = new AccountConfirmationDAO();
    }

    public function confirmUser(User $user): bool
    {
        if ($user->isNotValidEmail() || $this->accountConfirmationDAO->findInactiveUsersByEmailAndActivationCode($user->getEmail(), $user->getactivationCode()) == 0) {
            throw new Exception("Datele introduse nu sunt valide");
        }
        $this->accountConfirmationDAO->setUserActiveByEmail($user->getEmail());
        return true;
    }
}