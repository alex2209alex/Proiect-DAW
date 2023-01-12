<?php

class MedicConsultation
{
    private int $idConsultation;
    private string $consultationDate;
    private string $consultationInterval;
    private string $lastName;
    private string $firstName;
    private string $cnp;
    private string $specialization;
    private string $lastNameMedic;
    private string $firstNameMedic;
    private string $diagnostic;
    private string $recomendedTreatment;
    private string $recomendedAnalyses;

    public function __construct(int $idConsultation, string $consultationDate, string $consultationInterval, string $lastName, string $firstName, string $cnp, string $specialization, string $lastNameMedic, string $firstNameMedic, string $diagnostic, string $recomendedTreatment, string $recomendedAnalyses)
    {
        $this->idConsultation = $idConsultation;
        $this->consultationDate = $consultationDate;
        $this->consultationInterval = $consultationInterval;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->cnp = $cnp;
        $this->specialization = $specialization;
        $this->lastNameMedic = $lastNameMedic;
        $this->firstNameMedic = $firstNameMedic;
        $this->diagnostic = $diagnostic;
        $this->recomendedTreatment = $recomendedTreatment;
        $this->recomendedAnalyses = $recomendedAnalyses;
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

    public function getIdConsultation(): int
    {
        return $this->idConsultation;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    public function getLastNameMedic(): string
    {
        return $this->lastNameMedic;
    }

    public function getFirstNameMedic(): string
    {
        return $this->firstNameMedic;
    }

    public function getDiagnostic(): string
    {
        return $this->diagnostic;
    }

    public function getRecomendedTreatment(): string
    {
        return $this->recomendedTreatment;
    }

    public function getRecomendedAnalyses(): string
    {
        return $this->recomendedAnalyses;
    }
}