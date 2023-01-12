<?php

require_once dirname(__FILE__) . "/../fpdf/fpdf.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = trim($_POST['date']);
    $medicName = trim($_POST['medicName']);
    $specialization = trim($_POST['specialization']);
    $pacientName = trim($_POST['pacientName']);
    $cnp = trim($_POST['cnp']);
    $diagnostic = trim($_POST['diagnostic']);
    $recomendedTreatment = trim($_POST['recomendedTreatment']);
    $recomendedAnalyses = trim($_POST['recomendedAnalyses']);
} else {
    header("location: /index.php");
    exit;
}

$pdf = new FPDF;

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 19);

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(130, 5);
$pdf->Cell(25, 5, "Data");
$pdf->SetFont('Arial', '', 19);
$pdf->Cell(35, 5, $date);

$pdf->Cell(190, 10, '', 0, 1); // Line break

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(190, 10, 'Fisa numarul_____________', 0, 1, 'C');

$pdf->Cell(190, 10, '', 0, 1); // Line break

$pdf->Cell(190, 10, "Informatii medic", 1,1, 'C');

$pdf->Cell(50, 10, "Nume", 1, 0);
$pdf->SetFont('Arial', '', 19);
$pdf->Cell(140, 10, $medicName, 1, 1);

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(50, 10, "Specializare", 1, 0);
$pdf->SetFont('Arial', '', 19);
$pdf->Cell(140, 10, $specialization, 1, 1);

$pdf->Cell(190, 15, '', 0, 1); // Line break

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(190, 10, "Informatii pacient", 1,1, 'C');

$pdf->Cell(50, 10, "Nume", 1, 0);
$pdf->SetFont('Arial', '', 19);
$pdf->Cell(140, 10, $pacientName, 1, 1);

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(50, 10, "CNP", 1, 0);
$pdf->SetFont('Arial', '', 19);
$pdf->Cell(140, 10, $cnp, 1, 1);

$pdf->Cell(190, 15, '', 0, 1); // Line break

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(190, 10, "Diagnostic", 1,1, 'C');

$pdf->SetFont('Arial', '', 19);
$pdf->MuLTICell(190, 10, $diagnostic, 1,'L');

$pdf->Cell(190, 15, '', 0, 1); // Line break

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(190, 10, "Tratament recomandat", 1,1, 'C');

$pdf->SetFont('Arial', '', 19);
$pdf->MuLTICell(190, 10, $recomendedTreatment, 1,'L');

$pdf->Cell(190, 15, '', 0, 1); // Line break

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(190, 10, "Analize recomandate", 1,1, 'C');

$pdf->SetFont('Arial', '', 19);
$pdf->MuLTICell(190, 10, $recomendedAnalyses, 1,'L');

$pdf->Cell(190, 15, '', 0, 1); // Line break


$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(180, 10, "Semnatura medic", 0,1, 'R');

$pdf->Cell(190, 5, '', 0, 1); // Line break

$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(180, 10, "______________", 0,1, 'R');

$pdf->Output();
