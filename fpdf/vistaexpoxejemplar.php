<?php

//if(count($_POST)>0){  

    //$registro = InscripcionData::getById($_REQUEST['id']);

    require_once "plantillaexpoxejemplar.php";
    require_once "conexion.php";
    require_once "model.php";
    require "calculatiempo.php";
    
    $nw = new BDConsultas();

    $idejemplar = $_POST['idejemplar'];
    $pdf=new PDF();
    
    //echo print_r($idexposicion);

    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",8);
    $pdf->SetFillColor(232,232,232);
    $ejemplar = $nw->getEjemplarxId($idejemplar);
    $detexpo = $nw->getExpoxEjemplar($idejemplar);
    $cont_rows=$nw->CantRegistrosxEjemplar($idejemplar);

        /*LINEAS-*/
    $pdf->Line(10,50,200,50);
    //$pdf->Line(10,57,200,57);
    //$pdf->Line(10,82,200,82);
    //$pdf->Line(10,87,200,87);
    $pdf->Cell(-1,0);
    $pdf->Cell(193,5,"DATOS DEL EJEMPLAR",0,1,"L",1);

    /*if (!empty($order->picture)) {
        $pdf->Image($order->picture, 150 ,185, 35 , 38,'JPG');
    }*/
        
        //$pdf->Cell(1,5);

    $pdf->ln(5);

    $pdf->Cell(-1,0);
    $pdf->Cell(22,5,'Ejemplar:',0,0,"C",1);
    $pdf->Cell(25,5, "".$ejemplar->nombredog,0,0,"L",0);

    $pdf->Cell(36,0);
    $pdf->Cell(22,5,'Fecha Nac:',0,0,"C",1);
    $pdf->Cell(1,5, "".$ejemplar->fechanac,0,0,"L",0);

    $pdf->Cell(20,0);
    $pdf->Cell(15,5,'Sexo:',0,0,"C",1);
    $pdf->Cell(20,5, "".$ejemplar->sexo,0,0,"L",0);
    
    $pdf->Cell(-5,0);
    $pdf->Cell(20,5,'Tipo Pelo:',0,0,"C",1);
    $pdf->Cell(20,5, "".$ejemplar->tipopelo,0,1,"L",0);
    $pdf->Ln(2);

    $pdf->Cell(-1,0);
    $pdf->Cell(22,5,'Libro:',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->libro,0,0,"L",0);
    
    $pdf->Cell(1,0);
    $pdf->Cell(22,5,'Nro Registro:',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->nroregistro,0,0,"L",0);

    $pdf->Cell(-6,0);
    $pdf->Cell(22,5,'Tatuaje',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->tatuaje,0,0,"L",0);

    $pdf->Cell(-1,0);
    $pdf->Cell(15,5,'Chip',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->microchip,0,1,"L",0);
    $pdf->Ln(2);

    $pdf->Cell(-1,0);
    $pdf->Cell(22,5,'Codo (ED):',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->codoeh,0,0,"L",0);

    $pdf->Cell(1,0);
    $pdf->Cell(22,5,'Cadera (HD):',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->caderahd,0,0,"L",0);
    
    if ($ejemplar->bh=="") {$bhh="";}if ($ejemplar->bh=="NO") {$bhh="";}if ($ejemplar->bh=="SI") {$bhh="BH ";}
    if ($ejemplar->cabda=="") {$cabb="";}if ($ejemplar->cabda=="NO") {$cabb="";}if ($ejemplar->cabda=="SI") {$cabb="CBD";}
    if ($ejemplar->igp=="") {$igpp="";}if ($ejemplar->igp=="Sin IGP") {$igpp="";}if ($ejemplar->igp=="IGP1") {$igpp=$ejemplar->igp;}if ($ejemplar->igp=="IGP2") {$igpp=$ejemplar->igp;}if ($ejemplar->igp=="IGP3") {$igpp=$ejemplar->igp;}
    if ($ejemplar->seleccion=="") {$sell="";}if ($ejemplar->seleccion=="NO") {$sell="";}if ($ejemplar->seleccion=="SI") {$sell="SEL ";}

    $pdf->Cell(-6,0);
    $pdf->Cell(22,5,'Grad. Adiest:',0,0,"C",1);
    $pdf->Cell(22,5, "".$bhh." ".$cabb." ".$igpp." ".$sell,0,1,"L",0);
    $pdf->Ln(2);

    $pdf->Cell(-1,0);
    $pdf->Cell(22,5,'Padre/Madre:',0,0,"C",1);
    $pdf->Cell(22,5, "".$ejemplar->padre." / ".$ejemplar->madre,0,0,"L",0);

    $pdf->Ln(8);
    $pdf->Cell(-1,50);
    $pdf->Cell(193,5,"DETALLE DE PARTICIPACIONES",0,0,"C",1);

    $pdf->Ln(10);

   //while($row = $detinscritos->fetch_assoc())

    //for ($i=1; $i <=$cont_rows ; $i++) { 
    $i=1;        
    if ($i <=$cont_rows) {
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(-2,0);
    $pdf->Cell(8, 7, "Item", 1, 0, 'C', 0);
    $pdf->Cell(100, 7, "DETALLE DE EXPOSICIONES", 1, 0, 'C', 0);
    $pdf->Cell(9, 7, "Cat", 1, 0, 'C', 0);
    $pdf->Cell(12, 7, "Edad", 1, 0, 'C', 0);
    $pdf->Cell(11, 7, "Clasf.", 1, 0, 'C', 0);
    $pdf->Cell(12, 7, "Calif.", 1, 0, 'C', 0);
    $pdf->Cell(12, 7, "Punt.", 1, 0, 'C', 0);
    $pdf->Cell(30, 7, "Observacion", 1, 1, 'C', 0);
    foreach($detexpo as $row)
    {
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==0) {$EdadM=$datosEC[1];}
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);

            if ($datosCat=="6TA CATEGORIA") {$catt="6ta";} if ($datosCat=="5TA CATEGORIA") {$catt="5ta";}
            if ($datosCat=="4TA CATEGORIA") {$catt="4ta";} if ($datosCat=="3RA CATEGORIA") {$catt="3ra";}
            if ($datosCat=="2DA CATEGORIA") {$catt="2da";} if ($datosCat=="1RA CATEGORIA") {$catt="1ra";}
            //$pdf->Ln(10);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(-2,0);
            $pdf->Cell(8, 7, "".$i, 1, 0, 'C', 0);
            $pdf->Cell(100, 7, "".$row->nroexpo." ".$row->tipoexposicion." ".$row->ciudad." ".$row->fechaexpo." ".$row->organiza, 1, 0, 'L', 0);
            $pdf->Cell(9, 7, "".$catt, 1, 0, 'C', 0);
            $pdf->Cell(12, 7, "".$EdadM."M ".$datosEC[2]."D", 1, 0, 'C', 0);
            $pdf->Cell(11, 7, "", 1, 0, 'C', 0);
            $pdf->Cell(12, 7, "", 1, 0, 'C', 0);
            $pdf->Cell(12, 7, "", 1, 0, 'C', 0);
            $pdf->Cell(30, 7, "", 1, 1, 'C', 0);
            $pdf->Ln(0);
            //$pdf->Cell(4,0);
            //$pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);    
            $i=$i+1;
            $pdf->Ln(0);
    }
}

    $pdf->Ln(8);
    $pdf->Cell(2,40);
    //$pdf->Cell(0,0,"* Participar en las exposiciones es la mejor manera de mostrar los avances en la crianza de nuestros ejemplares *",0,0,"C",0);
    $pdf->Ln(8);
    
    $pdf->Output('', 'Exposiciones '.$ejemplar->nombredog.'.pdf');
    
//} 
?>
