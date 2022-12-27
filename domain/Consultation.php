<?php

class Consultation
{
    private int $idInterval;
    private int $idPacient;
    private int $idMedic;
    private string $consultationDate;

    public function __construct(int $idInterval, int $idPacient, int $idMedic, string $consultationDate)
    {
        $this->idInterval = $idInterval;
        $this->idPacient = $idPacient;
        $this->idMedic = $idMedic;
        $this->consultationDate = $consultationDate;
    }

    public function isNotValid(): bool
    {
        return $this->isNotValidConsultationDate() || $this->isNotValidIdInterval() || $this->isNotValidIdMedic();
    }

    public function isNotValidIdMedic(): bool
    {
        return empty($this->idMedic);
    }

    public function isNotValidIdInterval(): bool
    {
        return empty($this->idInterval);
    }

    public function isNotValidConsultationDate(): bool
    {
        if(empty($this->consultationDate)) {
            return true;
        }
        $date = strtotime(date('Y-m-d', strtotime($this->consultationDate)));
        $currentDate = strtotime(date('Y-m-d'));
        if ($date <= $currentDate) {
            return true;
        }
        return false;
    }

    public function getIdInterval(): int
    {
        return $this->idInterval;
    }

    public function getIdPacient(): int
    {
        return $this->idPacient;
    }

    public function getIdMedic(): int
    {
        return $this->idMedic;
    }

    public function getConsultationDate(): string
    {
        return $this->consultationDate;
    }
}