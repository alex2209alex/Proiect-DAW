<?php

class Database
{
    private string $host;
    private string $databaseName;
    private string $username;
    private string $password;
    private bool $isLocalHost = TRUE;
    private ?PDO $conn;

    public function getConnection(): ?PDO
    {
        $this->conn = null;
        $this->setConnectionData();
        try {
            $this->createConnection();
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function setConnectionData(): void
    {
        if ($this->isLocalHost) {
            $this->setLocalHost();
        } else {
            $this->setHerokuHost();
        }
    }

    public function setLocalHost(): void
    {
        $this->host = "127.0.0.1";
        $this->databaseName = "proiectdaw";
        $this->username = "root";
        $this->password = "Ap1!Ap2@Ap3#";
    }

    public function setHerokuHost(): void
    {
        $this->host = "eu-cdbr-west-03.cleardb.net";
        $this->databaseName = "heroku_8b0d555a41199d4";
        $this->username = "bbf1143d911a17";
        $this->password = "5c36c669";
    }

    public function createConnection(): void
    {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->databaseName, $this->username, $this->password);
        $this->conn->exec("set names utf8");
    }

    public function closeConnection(): void
    {
        $this->conn = null;
    }
}