<?php
require('fpdf.php');
session_start();


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
  $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(80,10,'Contrat de location N: '.$_SESSION['contrat']['id'],1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

/// corps de contrat /////
		// information sur le client /////
		
$pdf->Cell(40,6,'LOCATAIRE 		: ');
$pdf->Cell(40,6,$_SESSION['client']['nom']." ".$_SESSION['client']['prenom']);
$pdf->Ln();

$pdf->Cell(40,6,'CIN		: ');
$pdf->Cell(40,6,$_SESSION['client']['cin']);
$pdf->Ln();

$pdf->Cell(40,6,'permit de conduire		: ');
$pdf->Cell(40,6,$_SESSION['client']['n_permis']);
$pdf->Ln();

$pdf->Cell(40,6,'N'.strip_tags(html_entity_decode('&eacute;')) .' le	: ');
$pdf->Cell(40,6,$_SESSION['client']['Date_naissance']);
$pdf->Ln();

$pdf->Cell(40,6,'contrat 		: ');
$pdf->Cell(40,6,$_SESSION['contrat']['id']);
$pdf->Ln();


$pdf->Cell(40,6,'modele de vhicule 	: ');
$pdf->Cell(40,6,$_SESSION['voiture']['modele']);
$pdf->Ln();
$pdf->Cell(40,6,'matricule	: ');
$pdf->Cell(40,6,$_SESSION['voiture']['matricule']);
$pdf->Ln();
$pdf->Cell(40,6,'Date debut 	: ');
$pdf->Cell(40,6,$_SESSION['contrat']['date_debut']);
//$pdf->Ln();
$pdf->Cell(40,6,'Date  fin prevu		: ');
$pdf->Cell(40,6,$_SESSION['contrat']['date_fin']);
$pdf->Ln();
$pdf->Cell(40,6,'nombre de jour		: ');
$pdf->SetTextColor(220,50,50);
$pdf->Cell(40,6,$_SESSION['contrat']['nb_jour']);
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,6,'Le prix 		: ');
$pdf->SetTextColor(220,50,50);
$pdf->Cell(40,6,$_SESSION['contrat']['prix'].' DH');
$pdf->Ln();

$pdf->Output();

?>
