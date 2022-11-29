<?php
require_once dirname(__FILE__) . '/../../config/Database.php';

class AccountCreationDAO
{
    private Database $database;

    public function __construct()
    {
        $this->setDatabase(new Database());
    }

    public function isEmailUnique(string $email): bool
    {
        $conn = $this->getDatabase()->getConnection();
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT COUNT(*) FROM utilizator WHERE email = :email";
            $stmt = $conn->prepare($sqlQuery);
            // sanitize
            // htmlspecialchars — Convert special characters to HTML entities
            // strip_tags — Strip HTML and PHP tags from a string
            $email = htmlspecialchars(strip_tags($email));
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $conn->commit();
            $this->database->closeConnection();
            return $count == 0;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function createAccount(User $user): int
    {
        $conn = $this->getDatabase()->getConnection();
        $idUser = -1;
        try {
            $conn->beginTransaction();
            $sqlQuery = "INSERT INTO utilizator(email, parola, nume, prenume, cod_activare, este_activ) VALUES(:email, :password, :lastName, :firstName, :activationCode, :isActive)";
            $stmt = $conn->prepare($sqlQuery);
            $email = htmlspecialchars(strip_tags($user->getEmail()));
            $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $lastName = htmlspecialchars(strip_tags($user->getLastName()));
            $firstName = htmlspecialchars(strip_tags($user->getFirstName()));
            $activationCode = htmlspecialchars(strip_tags($user->getActivationCode()));
            $isActive = htmlspecialchars(strip_tags($user->isActive()));
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":lastName", $lastName);
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":activationCode", $activationCode);
            $stmt->bindParam(":isActive", $isActive);
            $stmt->execute();
            $idUser = $conn->lastInsertId();

            $sqlQuery = "INSERT INTO pacient(id_utilizator) VALUES(:idUser)";
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindParam(":idUser", $idUser);
            $stmt->execute();
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
        $this->database->closeConnection();
        return $idUser;
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }
}