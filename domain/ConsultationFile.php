<?php

class ConsultationFile
{
    private int $consultationId;
    private string $pacientName;
    private string $cnp;
    private string $medicName;
    private int $medicId;
    private string $diagnostic;
    private string $recomendedAnalyses;
    private string $recomendedTreatement;

    public function __construct(string $pacientName, string $cnp, string $medicName, $medicId)
    {
        $this->pacientName = $pacientName;
        $this->cnp = $cnp;
        $this->medicName = $medicName;
        $this->medicId = $medicId;
    }

    public function isNotValid(): bool
    {
        return $this->isNotValidDiagnostic();
    }

    public function isNotValidDiagnostic(): bool
    {
        return empty($this->diagnostic);
    }

    public function getConsultationId(): int
    {
        return $this->consultationId;
    }

    public function setConsultationId(int $consultationId): void
    {
        $this->consultationId = $consultationId;
    }

    public function getPacientName(): string
    {
        return $this->pacientName;
    }

    public function getCnp(): string
    {
        return $this->cnp;
    }

    public function getMedicName(): string
    {
        return $this->medicName;
    }

    public function getMedicId(): int
    {
        return $this->medicId;
    }

    public function getDiagnostic(): string
    {
        return $this->diagnostic;
    }

    public function getRecomendedAnalyses(): string
    {
        return $this->recomendedAnalyses;
    }

    public function getRecomendedTreatement(): string
    {
        return $this->recomendedTreatement;
    }

    public function setDiagnostic(string $diagnostic): void
    {
        $this->diagnostic = $diagnostic;
    }

    public function setRecomendedAnalyses(string $recomendedAnalyses): void
    {
        $this->recomendedAnalyses = $recomendedAnalyses;
    }

    public function setRecomendedTreatement(string $recomendedTreatement): void
    {
        $this->recomendedTreatement = $recomendedTreatement;
    }
}