<?php

require_once 'fpdf/fpdf.php';
require_once "model.php";

$idexposicion1 = $_POST['idexposicion'];
$nroexpo1= $_POST['nroexpo'];
$tipoexpo= $_POST['tipoexposicion'];
$organiza1= $_POST['organiza'];
$fecha1 = new DateTime($_POST['fechaexpo']);
$juez1= $_POST['nombrejuez'];
$lugar1= $_POST['lugar'];
$ayudante="ALDO HUAMAN CORRALES";
//$ayudante=$_POST['ayudante'];

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
        $this->Image("images/logocoapa.jpg", 170, 5, 30);
        
        /*FECHA-*/
        
        $this->SetFont("Arial", "", 9);
        //$this->Cell(25,50);
        $this->Cell(100, 35, "Fecha: " . date("d/m/Y"), 0, 1, "C");

        /* TITULO-*/
        $this->SetFont("Arial","B",12);
        $this->Cell(30,10);
        $this->Cell(120, 0,  mb_convert_encoding(" INSCRIPCIONES DE LA ".$nroexpo1." EXPOSICION ".$tipoexpo, 'ISO-8859-1', 'UTF-8'), 0, 0, "C");
        
        // Salto de línea
        $this->Ln(10);

    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial","I",8);
        $this->Cell(0,5, mb_convert_encoding("website: www.apppa.com.pe  |  email: apppa@apppa.com.pe  |  Dirección: Av. San Borja Norte 160 Departamento 202 - San Borja - Lima", 'ISO-8859-1', 'UTF-8'),0,1,"C",1);
        $this->Cell(0, 10, "Pagina ".$this->PageNo()."/{nb}", 0, 0, 'C' );
    }

}

?>
