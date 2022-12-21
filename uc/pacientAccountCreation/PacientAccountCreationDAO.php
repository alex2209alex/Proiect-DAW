<?php
require_once dirname(__FILE__) . '/../../config/Database.php';

class PacientAccountCreationDAO
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isEmailUnique(string $email): bool
    {
        $conn = $this->database->getConnection();
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

    public function createPacientAccount(Pacient $pacient): int
    {
        $conn = $this->database->getConnection();
        $idPacient = -1;
        try {
            $conn->beginTransaction();
            $sqlQuery = "INSERT INTO utilizator(email, parola, nume, prenume, cod_activare, este_activ) VALUES(:email, :password, :lastName, :firstName, :activationCode, :isActive)";
            $stmt = $conn->prepare($sqlQuery);
            $email = htmlspecialchars(strip_tags($pacient->getEmail()));
            $password = htmlspecialchars(strip_tags($pacient->getPassword()));
            $password = password_hash($password, PASSWORD_DEFAULT);
            $lastName = htmlspecialchars(strip_tags($pacient->getLastName()));
            $firstName = htmlspecialchars(strip_tags($pacient->getFirstName()));
            $activationCode = htmlspecialchars(strip_tags($pacient->getActivationCode()));
            $isActive = htmlspecialchars(strip_tags($pacient->isActive()));
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":lastName", $lastName);
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":activationCode", $activationCode);
            $stmt->bindParam(":isActive", $isActive);
            $stmt->execute();
            $idPacient = $conn->lastInsertId();

            $sqlQuery = "INSERT INTO pacient(id_utilizator, cnp) VALUES(:idUser, :cnp)";
            $stmt = $conn->prepare($sqlQuery);
            $idPacient = htmlspecialchars(strip_tags($idPacient));
            $cnp = htmlspecialchars(strip_tags($pacient->getCnp()));
            $stmt->bindParam(":idUser", $idPacient);
            $stmt->bindParam(":cnp", $cnp);
            $stmt->execute();
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
        $this->database->closeConnection();
        return $idPacient;
    }
}