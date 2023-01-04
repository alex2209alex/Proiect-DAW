<?php

class MedicConsultation
{
    private string $consultationDate;
    private string $consultationInterval;
    private string $lastName;
    private string $firstName;
    private string $cnp;

    public function __construct(string $consultationDate, string $consultationInterval, string $lastName, string $firstName, string $cnp)
    {
        $this->consultationDate = $consultationDate;
        $this->consultationInterval = $consultationInterval;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->cnp = $cnp;
    }

    public function getLabel(): string
    {
        return $this->lastName . " " . $this->firstName;
    }

    public function getConsultationDate(): string
    {
        return $this->consultationDate;
    }

    public function getConsultationInterval(): string
    {
        return $this->consultationInterval;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getCnp(): string
    {
        return $this->cnp;
    }


}