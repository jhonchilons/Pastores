<?php

if(count($_POST)>0){ 

    require "plantillaejemplares.php";
    require "conexion.php";
    require "model.php";
    //require "calculatiempo.php";

    $nw = new BDConsultas();

    //$idexposicion = $_POST['idexposicion'];
    //$idejemplar = $_POST['idejemplar'];

    $pdf=new PDF();
    
    $pdf->AliasNbPages();
    $pdf->SetMargins(5, 10, 10);
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",8);
    $pdf->SetFillColor(232,232,232);
    $detejemplares = $nw->getlistadoEjemplares();

        /*LINEAS-*/
    $pdf->Line(10,40,200,40);
    //$pdf->Line(10,57,200,57);

    $pdf->ln(1);
    $pdf->Cell(1,0);
    $pdf->Cell(6,5,"Item",0,0,"C",1);
    $pdf->Cell(1,0);
    $pdf->Cell(55,5,"NOMBRE EJEMPLAR",0,0,"C",1);
    $pdf->Cell(1,0);
    $pdf->Cell(16,5,"SEXO",0,0,"C",1);
    $pdf->Cell(1,10);
    $pdf->Cell(20,5,"FECHA NAC.",0,0,"C",1);
    $pdf->Cell(1,10);
    $pdf->Cell(55,5,"PADRE.",0,0,"C",1);
    $pdf->Cell(1,10);
    $pdf->Cell(55,5,"MADRE.",0,0,"C",1);
    $pdf->ln(5);
    $i=1;
   foreach($detejemplares as $row)
    {
        $pdf->Cell(1,0);
        $pdf->Cell(6, 5, $i.".", 0, 0, 'L', 0);
        $pdf->Cell(1,0);
        $pdf->Cell(55, 5, $row->nombredog, 0, 0, 'L', 0);
        $pdf->Cell(1,0);
        $pdf->Cell(16, 5, $row->sexo, 0, 0, 'L', 0);
        $pdf->Cell(1,10);
        $pdf->Cell(20, 5, $row->fechanac, 0, 0, 'C', 0);
        $pdf->Cell(1,0);
        $pdf->Cell(55, 5, $row->padre, 0, 0, 'L', 0);
        $pdf->Cell(1,0);
        $pdf->Cell(55, 5, $row->madre, 0, 1, 'L', 0);
        //$pdf->ln(1);
        $i=$i + 1;
    }
    
    $pdf->Output('ListadoEjemplares'.".pdf",'I');
}

?>