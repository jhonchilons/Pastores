<?php

//if(count($_POST)>0){  

    //$registro = InscripcionData::getById($_REQUEST['id']);

    require_once "plantillaplanilla.php";
    require_once "conexion.php";
    require_once "model.php";
    require "calculatiempo.php";

    $nw = new BDConsultas();

    $idexposicion = $_POST['idexposicion'];
    $pdf=new PDF();
    
    //echo print_r($idexposicion);

    $pdf->AliasNbPages();
    $pdf->SetMargins(9, 10, 10);
    $pdf->SetFont("Arial","B",8);
    $pdf->SetFillColor(232,232,232);
    $order = $nw->getExposicionxId($idexposicion);
    $detinscritos = $nw->getDetalleInscritosxExpo($idexposicion);
    $cont_rows=$nw->CantRegistros($idexposicion);
    $espdet='-4'; //Espacio entre la cabera y el detalle
    $tt='9'; //tamaño de letra del titulo de categoria
    //echo 'Registro => ' .print_r ($detinscritos);

    $i=1; 

    if ($i <=$cont_rows) {
    $est=0;
    foreach($detinscritos as $row)
    {
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="6TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "6TA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);   
            $i=$i+1;
        }
        $pdf->Ln(0);
    }


    $est=0;
    foreach($detinscritos as $row)
    {
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="6TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();

                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "6TA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',$tt);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);   
            $i=$i+1;
        }
        $pdf->Ln(0);
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="6TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "6TA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);
            $i=$i+1;
        }
        $pdf->Ln(0);
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="6TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ( $est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "6TA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="5TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "5TA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }

            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="5TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "5TA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }

            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="5TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "5TA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="5TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "5TA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="4TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184,5, "4TA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="4TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184,5, "4TA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="4TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "4TA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="4TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(184, 5, "4TA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
                $pdf->Cell(70, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(15, 10, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(20, 10, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(10);
                $est=1;
            }
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(15, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(70, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(50, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "", 1, 1, 'L', 0);  
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
/*********** MEJOR CACHORRO Y CACHORRA   ************************************************ */
    $est=0;
    if ($est==0) {
        $pdf->AddPage();
        $pdf->Ln($espdet);
        $pdf->SetFont('Arial','B',$tt);
        $pdf->Cell(1,0);
        $pdf->Cell(184, 5, "MEJOR CACHORRO HEMBRA", 0, 1, 'C', 1);
        $pdf->Ln(5);

        $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
        $pdf->Cell(105, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
        $pdf->Cell(15, 10, "CATG.", 1, 0, "C",0);
        $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
        $pdf->Ln(10);
        $est=1;

        $pdf->SetFont('Arial','',8);
        $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
        $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(50, 6, "", 1, 1, 'L', 0);

        $pdf->SetFont('Arial','',8);
        $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
        $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(50, 6, "", 1, 1, 'L', 0);

        $pdf->SetFont('Arial','',8);
        $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
        $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(50, 6, "", 1, 1, 'L', 0);
        $pdf->Ln(16);
        //$pdf->Ln($espdet);
        $pdf->SetFont('Arial','B',$tt);
        $pdf->Cell(1,0);
        $pdf->Cell(184, 5, "MEJOR CACHORRO MACHO", 0, 1, 'C', 1);
        $pdf->Ln(5);

        $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
        $pdf->Cell(105, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
        $pdf->Cell(15, 10, "CATG.", 1, 0, "C",0);
        $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
        $pdf->Ln(10);
        $est=1;

        $pdf->SetFont('Arial','',8);
        $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
        $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(50, 6, "", 1, 1, 'L', 0);

        $pdf->SetFont('Arial','',8);
        $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
        $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(50, 6, "", 1, 1, 'L', 0);

        $pdf->SetFont('Arial','',8);
        $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
        $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
        $pdf->Cell(50, 6, "", 1, 0, 'L', 0);

    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "3RA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                $pdf->Ln(5);
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);            
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "3RA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }


    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ( $est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "3RA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }


    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "3RA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0); 
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "2DA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "2DA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "2DA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==1) {$EdadM=$datosEC[1] + 12;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "2DA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }

/************ MEJOR JOVEN MACHO Y HEMBRA ************************************* */
$est=0;
if ($est==0) {
    $pdf->AddPage();
    $pdf->Ln($espdet);
    $pdf->SetFont('Arial','B',$tt);
    $pdf->Cell(1,0);
    $pdf->Cell(184, 5, "MEJOR JOVEN HEMBRA", 0, 1, 'C', 1);
    $pdf->Ln(5);

    $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
    $pdf->Cell(105, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
    $pdf->Cell(15, 10, "CATG.", 1, 0, "C",0);
    $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
    $pdf->Ln(10);
    $est=1;

    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
    $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(50, 6, "", 1, 1, 'L', 0);

    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
    $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(50, 6, "", 1, 1, 'L', 0);
    $pdf->Ln(16);
    //$pdf->Ln($espdet);
    $pdf->SetFont('Arial','B',$tt);
    $pdf->Cell(1,0);
    $pdf->Cell(184, 5, "MEJOR JOVEN MACHO", 0, 1, 'C', 1);
    $pdf->Ln(5);

    $pdf->Cell(15, 10, "NRO", 1, 0, "C",0);
    $pdf->Cell(105, 10, "NOMBRE EJEMPLAR", 1, 0, "C",0);
    $pdf->Cell(15, 10, "CATG.", 1, 0, "C",0);
    $pdf->Cell(50, 10, "OBSERVACIONES", 1, 0, "C",0);
    $pdf->Ln(10);
    $est=1;

    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
    $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(50, 6, "", 1, 1, 'L', 0);

    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15, 6, "", 1, 0, 'C', 0);
    $pdf->Cell(105, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(15, 6, "", 1, 0, 'L', 0);
    $pdf->Cell(50, 6, "", 1, 0, 'L', 0);

}

/**************************************************************************************** */    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="NO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);   
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA HEMBRAS N/S", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="NO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA HEMBRAS N/S PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="NO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "CATEGORIA: 1RA CATEGORIA MACHOS N/S", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="NO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA MACHOS N/S PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="SI" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA HEMBRAS SELECCIONADAS", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="SI" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA HEMBRAS SELECCIONADAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
            
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="SI" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL"){
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA MACHOS SELECCIONADOS", 0, 1, 'L', 1);
                $pdf->Ln(5);

                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
    

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        if ( $datosEC[0]==2) {$EdadM=$datosEC[1] + 24;}
        if ( $datosEC[0]==3) {$EdadM=$datosEC[1] + 36;}
        if ( $datosEC[0]==4) {$EdadM=$datosEC[1] + 48;}
        if ( $datosEC[0]==5) {$EdadM=$datosEC[1] + 60;}
        if ( $datosEC[0]==6) {$EdadM=$datosEC[1] + 72;}
        if ( $datosEC[0]==7) {$EdadM=$datosEC[1] + 84;}
        if ( $datosEC[0]==8) {$EdadM=$datosEC[1] + 96;}
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="SI" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL" ){
            if ($est==0) {
                $pdf->AddPage();
                $pdf->Ln($espdet);
                $pdf->SetFont('Arial','B',$tt);
                $pdf->Cell(1,0);
                $pdf->Cell(193, 5, "1RA CATEGORIA MACHOS SELECCIONADOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(5);
                $pdf->SetFont("Arial","B",8);
                    
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(8, 8, "NRO", 1, 0, "C",0);
                $pdf->Cell(55, 8, "NOMBRE EJEMPLAR", 1, 0, "C",0);
                $pdf->Cell(8, 8, "Edad", 1, 0, "C",0);
                $pdf->Cell(7, 8, "ADN", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CODO", 1, 0, "C",0);
                $pdf->Cell(12, 8, "CADERA", 1, 0, "C",0);
                $pdf->Cell(20, 8, "GRAD. ADIES.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CLASIF.", 1, 0, "C",0);
                $pdf->Cell(10, 8, "CALIF.", 1, 0, "C",0);
                $pdf->Cell(40, 8, "OBSERVACIONES", 1, 0, "C",0);
                $pdf->Cell(12, 8, "PROTEC.", 1, 0, "C",0);
                $pdf->Ln(8);
                $est=1;
            }
            if($row->igp==""){$igpp="";} if($row->igp=="Sin IGP"){$igpp="";}if ($row->igp=="IGP1" or $row->igp=="IGP2"or $row->igp=="IGP3"){$igpp=$row->igp;}
            if ($row->bh==""){$bhh="";}if ($row->bh=="SI"){$bhh="BH";}
            if ($row->cabda==""){$cabdaa="";}if ($row->cabda=="SI"){$cabdaa="CBD";}
            if ($row->seleccion==""){$selecc="";}if ($row->seleccion=="SI"){ $selecc="SEL";}if ($row->seleccion=="NO"){$selecc="";}
            if ($row->codoeh==""){$codoo="No Tiene";}if ($row->codoeh=="No Tiene"){ $codoo="No Tiene";}if ($row->codoeh=="(A) Normal"){$codoo=$row->codoeh;}
            if ($row->codoeh=="(A) Casi Normal"){$codoo="(A) CN";}if ($row->codoeh=="(A) Todavia Permitido"){$codoo="(A) TP";}
            if ($row->caderahd==""){$caderaa="No Tiene";}if ($row->caderahd=="No Tiene"){ $caderaa="No Tiene";}if ($row->caderahd=="(A) Normal"){$caderaa=$row->caderahd;}
            if ($row->caderahd=="(A) Casi Normal"){$caderaa="(A) CN";}if ($row->caderahd=="(A) Todavia Permitido"){$caderaa="(A) TP";}
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(8, 6, "".$i.". ", 1, 0, 'C', 0);
            $pdf->Cell(55, 6, "".$row->nombredog, 1, 0, 'L', 0);
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(8, 6, "".$EdadM." M", 1, 0, 'L', 0);
            $pdf->Cell(7, 6, "".$row->adn, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$codoo, 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "".$caderaa, 1, 0, 'L', 0);
            $pdf->Cell(20, 6, "".$bhh." ".$cabdaa." ".$igpp." ".$selecc, 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(10, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(40, 6, "", 1, 0, 'L', 0);
            $pdf->Cell(12, 6, "", 1, 1, 'L', 0);
            $igpp="";  
            $bhh="";
            $i=$i+1;
        }
        $pdf->Ln(0);
    }
}

    $pdf->Ln(8);
    $pdf->Cell(2,40);
    //$pdf->Cell(0,0,"* Participar en las exposiciones es la mejor manera de mostrar los avances en la crianza de nuestros ejemplares *",0,0,"C",0);
    $pdf->Ln(8);
    
    $pdf->Output('', 'Planilla'.$order->nroexpo.".pdf");
    
//} 
?>
