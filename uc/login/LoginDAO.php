<?php
require_once dirname(__FILE__) . '/../../config/Database.php';

class LoginDAO
{
    private Database $database;

    public function __construct()
    {
        $this->setDatabase(new Database());
    }

    public function getIdPacientByEmailAndPassword(string $email, string $parola): int
    {
        $conn = $this->getDatabase()->getConnection();
        $id = -1;
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT utilizator.id_utilizator, utilizator.parola FROM pacient INNER JOIN utilizator on utilizator.id_utilizator = pacient.id_utilizator WHERE utilizator.este_activ = 1 AND utilizator.email = :email";
            $stmt = $conn->prepare($sqlQuery);
            // sanitize
            // htmlspecialchars — Convert special characters to HTML entities
            // strip_tags — Strip HTML and PHP tags from a string
            $email = htmlspecialchars(strip_tags($email));
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $hashedPassword = $row['parola'];
                if (password_verify($parola, $hashedPassword)) {
                    $id = $row['id_utilizator'];
                }
            }
            $conn->commit();
            return $id;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
    }

    public function getIdMedicByEmailAndPassword(string $email, string $parola): int
    {
        $conn = $this->getDatabase()->getConnection();
        $id = -1;
        try {
            $conn->beginTransaction();
            $sqlQuery = "SELECT utilizator.id_utilizator, utilizator.parola FROM medic INNER JOIN utilizator on utilizator.id_utilizator = medic.id_utilizator WHERE utilizator.este_activ = 1 AND utilizator.email = :email";
            $stmt = $conn->prepare($sqlQuery);
            // sanitize
            // htmlspecialchars — Convert special characters to HTML entities
            // strip_tags — Strip HTML and PHP tags from a string
            $email = htmlspecialchars(strip_tags($email));
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $hashedPassword = $row['parola'];
                if (password_verify($parola, $hashedPassword)) {
                    $id = $row['id_utilizator'];
                }
            }
            $conn->commit();
            return $id;
        } catch (Exception $e) {
            $conn->rollback();
            $this->database->closeConnection();
            throw $e;
        }
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