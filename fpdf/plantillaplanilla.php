<?php

require_once 'fpdf/fpdf.php';
require_once "model.php";

//date_default_timezone_set("America/Caracas");
//setlocale(LC_TIME, 'es_VE.UTF-8','esp');

$idexposicion1 = $_POST['idexposicion'];
$nroexpo1= $_POST['nroexpo'];
$tipoexpo= $_POST['tipoexposicion'];
$organiza1= $_POST['organiza'];
$fecha1 = new DateTime($_POST['fechaexpo']);
$juez1= $_POST['nombrejuez'];
$lugar1= $_POST['lugar'];
$ayudante=$_POST['ayudante'];

//$marca = strtotime($fecha1['fechaexpo']);
class PDF extends FPDF
{
    function Header()
    {
        global $idexposicion1;
        global $nroexpo1;
        global $tipoexpo;
        global $organiza1;
        global $juez1;
        global $lugar1;
        global $fecha1;
        
        $this->Image("images/logo.jpg", 10, 5, 30);
        //$this->Image("images/logocoapa.jpg", 170, 5, 30);

        $this->Ln(25);
        $this->SetFont("Arial","B",16);
        $this->Cell(1,0);
        $this->Cell(185,5, "".$nroexpo1." EXPOSICION ".$tipoexpo,0,1,"R",0);
        $this->Ln(2);
        $this->SetFont("Arial","",16);
        $this->Cell(185,5, "".$organiza1, 0, 1,"R", 0);
        $this->SetFont("Arial","",8);
        $this->Cell(1,0);
        $this->Cell(185,5, "Juez: ".$juez1, 0, 1,"R", 0);
        $this->Cell(1,0);
        $this->Cell(185,5, "Lugar: ".$lugar1,0,1,"R",0);
        $this->Cell(1,0);
        $this->Cell(185,5, "Fecha: ".$fecha1->format(' D j M Y'),0,1,"R",0);
        //$this->Cell(185,5, "Fecha: ".strftime('%x', $marca),0,1,"R",0);
        $this->Ln(15);

    }

    function Footer()
    {
        global $juez1;
        global $ayudante;

        $this->Image("images/lineas.jpg", 159, 250, 50);
        $this->Line(42,200,82,200);
        $this->Line(138,200,178,200);
        $this->SetY(200); //Posicion en la pagina del Juez y Ayudante de Juez
        $this->SetFont("Arial","",8);
        $this->Cell(33,1);
        $this->Cell(1,5, "".$ayudante, 0, 0,"L",0);
        $this->Cell(95,1);
        $this->Cell(1,5, "".$juez1, 0, 1,"L",0);
        $this->Ln(-1);
        $this->Cell(92,1);
        $this->Cell(1,5, "Ayudante de Juez                                                                                                        Juez",0,0,"C",0);

        $this->SetY(-15);
        $this->SetFont("Arial","I",8);
        $this->Cell(0,5, mb_convert_encoding("website: www.apppa.com.pe  |  email: apppa@apppa.com.pe  |  Dirección: Av. San Borja Norte 160 Departamento 202 - San Borja - Lima", 'ISO-8859-1', 'UTF-8'),0,1,"C",1);
        $this->Cell(0, 10, "Pagina ".$this->PageNo()."/{nb}", 0, 0, 'C' );
    }

}

?>
