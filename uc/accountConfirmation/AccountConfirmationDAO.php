<?php
require_once dirname(__FILE__) . '/../../config/Database.php';

class AccountConfirmationDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function setUserActiveByEmail(string $email): void
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "UPDATE utilizator SET este_activ = TRUE WHERE email = :email";
            $stmt = $conn->prepare($sqlQuery);
            $email = htmlspecialchars(strip_tags($email));
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $conn->commit();
            $this->database->closeConnection();
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function findInactiveUsersByEmailAndActivationCode(string $email, string $activationCode): int
    {
        $conn = $this->database->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT COUNT(*) FROM utilizator WHERE email = :email AND cod_activare = :activationCode AND este_activ = FALSE";
            $stmt = $conn->prepare($sqlQuery);
            $email = htmlspecialchars(strip_tags($email));
            $stmt->bindParam(":email", $email);
            $activationCode = htmlspecialchars(strip_tags($activationCode));
            $stmt->bindParam(":activationCode", $activationCode);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $conn->commit();
            $this->database->closeConnection();
            return $count;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }
}