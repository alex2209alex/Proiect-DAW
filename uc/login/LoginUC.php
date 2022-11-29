<?php
require_once dirname(__FILE__) . "/LoginDAO.php";

class LoginUC
{
    private LoginDAO $loginDAO;

    public function __construct()
    {
        $this->loginDAO = new LoginDAO();
    }

    public function loginPacient(string $email, string $parola): int
    {
        $id = $this->loginDAO->getIdPacientByEmailAndPassword($email, $parola);
        if ($id == -1) {
            throw new Exception("Utilizator sau parola invalide");
        }
        return $id;
    }
}