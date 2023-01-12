<?php

class PacientConsultation
{
    private int $idConsultation;
    private string $consultationDate;
    private string $consultationInterval;
    private string $lastName;
    private string $firstName;
    private string $specialization;

    public function __construct(string $consultationDate, string $consultationInterval, string $lastName, string $firstName, string $specialization)
    {
        $this->consultationDate = $consultationDate;
        $this->consultationInterval = $consultationInterval;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->specialization = $specialization;
    }

    public function getIdConsultation(): int
    {
        return $this->idConsultation;
    }

    public function setIdConsultation(int $idConsultation): void
    {
        $this->idConsultation = $idConsultation;
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

    public function getSpecialization(): string
    {
        return $this->specialization;
    }
}