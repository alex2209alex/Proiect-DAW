<?php

class Database
{
    private string $host;
    private string $databaseName;
    private string $username;
    private string $password;
    private bool $isLocalHost = FALSE;
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
        if ($this->isLocalHost()) {
            $this->setLocalHost();
        } else {
            $this->setHerokuHost();
        }
    }

    public function createConnection(): void
    {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->databaseName, $this->username, $this->password);
        $this->conn->exec("set names utf8");
    }

    public function setLocalHost(): void
    {
        $this->setHost("127.0.0.1");
        $this->setDatabaseName("proiectdaw");
        $this->setUsername("root");
        $this->setPassword("Ap1!Ap2@Ap3#");
    }

    public function setHerokuHost(): void
    {
        $this->setHost("eu-cdbr-west-03.cleardb.net");
        $this->setDatabaseName("heroku_8b0d555a41199d4");
        $this->setUsername("bbf1143d911a17");
        $this->setPassword("5c36c669");
    }

    public function closeConnection(): void
    {
        $this->conn = null;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    public function setDatabaseName(string $databaseName): void
    {
        $this->databaseName = $databaseName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getConn(): ?PDO
    {
        return $this->conn;
    }

    public function setConn(?PDO $conn): void
    {
        $this->conn = $conn;
    }

    public function isLocalHost(): bool
    {
        return $this->isLocalHost;
    }

    public function setIsLocalHost(bool $isLocalHost): void
    {
        $this->isLocalHost = $isLocalHost;
    }
}