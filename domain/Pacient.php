<?php
require_once dirname(__FILE__) . "/../domain/User.php";

class Pacient extends User
{
    private string $cnp;

    public function __construct(string $cnp, string $email, string $password, string $passwordConfirmation, string $firstName, string $lastName)
    {
        parent::__construct($email, $password, $passwordConfirmation, $firstName, $lastName);
        $this->cnp = $cnp;
    }

    public function isNotValidCnp(): bool
    {
        return empty($this->cnp) || !is_numeric($this->cnp) || strlen($this->cnp) != 13;
    }

    public function isNotValid(): bool
    {
        return parent::isNotValid() || $this->isNotValidCnp();
    }

    public function getCnp(): string
    {
        return $this->cnp;
    }

    public function setCnp(string $cnp): void
    {
        $this->cnp = $cnp;
    }


}