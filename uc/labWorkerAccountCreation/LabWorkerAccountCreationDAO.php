<?php
require_once dirname(__FILE__) . '/../../config/Database.php';

class LabWorkerAccountCreationDAO
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

    public function createLabWorkerAccount(LabWorker $labWorker): int
    {
        $conn = $this->database->getConnection();
        $idLabWorker = -1;
        try {
            $conn->beginTransaction();
            $sqlQuery = "INSERT INTO utilizator(email, parola, nume, prenume, cod_activare, este_activ) VALUES(:email, :password, :lastName, :firstName, :activationCode, :isActive)";
            $stmt = $conn->prepare($sqlQuery);
            $email = htmlspecialchars(strip_tags($labWorker->getEmail()));
            $password = htmlspecialchars(strip_tags($labWorker->getPassword()));
            $password = password_hash($password, PASSWORD_DEFAULT);
            $lastName = htmlspecialchars(strip_tags($labWorker->getLastName()));
            $firstName = htmlspecialchars(strip_tags($labWorker->getFirstName()));
            $activationCode = htmlspecialchars(strip_tags($labWorker->getActivationCode()));
            $isActive = htmlspecialchars(strip_tags($labWorker->isActive()));
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":lastName", $lastName);
            $stmt->bindParam(":firstName", $firstName);
            $stmt->bindParam(":activationCode", $activationCode);
            $stmt->bindParam(":isActive", $isActive);
            $stmt->execute();
            $idLabWorker = $conn->lastInsertId();

            $sqlQuery = "INSERT INTO laborant(id_utilizator, specializare) VALUES(:idUser, :specialization)";
            $stmt = $conn->prepare($sqlQuery);
            $idLabWorker = htmlspecialchars(strip_tags($idLabWorker));
            $specialization = htmlspecialchars(strip_tags($labWorker->getSpecialization()));
            $stmt->bindParam(":idUser", $idLabWorker);
            $stmt->bindParam(":specialization", $specialization);
            $stmt->execute();
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
        $this->database->closeConnection();
        return $idLabWorker;
    }
}