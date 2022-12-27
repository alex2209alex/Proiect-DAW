<?php
require_once dirname(__FILE__) . "/../domain/User.php";

class Medic extends User
{
    private string $specialization;
    private int $id;

    public function __construct(string $specialization, string $email, string $password, string $passwordConfirmation, string $firstName, string $lastName)
    {
        parent::__construct($email, $password, $passwordConfirmation, $firstName, $lastName);
        $this->specialization = $specialization;
    }

    public function isNotValid(): bool
    {
        return parent::isNotValid() || $this->isNotValidSpecialization();
    }

    public function isNotValidSpecialization(): bool
    {
        return empty($this->specialization);
    }

    public function getLabel(): string
    {
        return $this->getFirstName() . " " . $this->getLastName() . " - " . $this->specialization;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}