<?php

//if(count($_POST)>0){  

    //$registro = InscripcionData::getById($_REQUEST['id']);

    require_once "plantillareporteinscritos.php";
    require_once "conexion.php";
    require_once "model.php";
    require "calculatiempo.php";
    
    $nw = new BDConsultas();

    $idexposicion = $_POST['idexposicion'];
    $pdf=new PDF();
    
    //echo print_r($idexposicion);

    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",8);
    $pdf->SetFillColor(232,232,232);
    $order = $nw->getExposicionxId($idexposicion);
    $detinscritos = $nw->getDetalleInscritosxExpo($idexposicion);
    $cont_rows=$nw->CantRegistros($idexposicion);

        /*LINEAS-*/
    $pdf->Line(10,52,200,52);
    $pdf->Line(10,57,200,57);
    $pdf->Line(10,82,200,82);
    $pdf->Line(10,87,200,87);
    $pdf->Cell(20,0);
    $pdf->Cell(8,0,"DATOS DE LA EXPOSICION",0,1,"C",0);
    $pdf->Cell(20,0);
    $pdf->Cell(10,59,"DETALLE DE INSCRIPCIONES",0,0,"C",0);

    if (!empty($order->picture)) {
        $pdf->Image($order->picture, 150 ,185, 35 , 38,'JPG');
    }
        
        //$pdf->Cell(1,5);

    $pdf->ln(5);

    $pdf->Cell(2,0);
    $pdf->Cell(22,5,'Fecha Expo:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->fechaexpo,0,0,"L",0);

    $pdf->Cell(27,0);
    $pdf->Cell(22,5,'Nro Expo:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->nroexpo,0,0,"L",0);

    $pdf->Cell(6,0);
    $pdf->Cell(22,5,'Tipo Expo:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->tipoexposicion,0,1,"L",0);
    $pdf->Ln(2);

    $pdf->Cell(2,0);
    $pdf->Cell(22,5,'Organizador:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->organiza,0,0,"L",0);
    
    $pdf->Cell(27,0);
    $pdf->Cell(22,5,'Ciudad:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->ciudad,0,0,"L",0);

    $pdf->Cell(6,0);
    $pdf->Cell(22,5,'Juez:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->nombrejuez,0,1,"L",0);
    $pdf->Ln(2);

    $pdf->Cell(2,0);
    $pdf->Cell(22,5,'Lugar:',0,0,"C",1);
    $pdf->Cell(22,5, "".$order->lugar,0,1,"L",0);
    $pdf->Ln(10);

    //while($row1 = mysql_fetch_assoc($detinscritos))
    //for ($i=1; $i <=$cont_rows ; $i++) { 

    $i=1;        
    if ($i <=$cont_rows) {

    $est=0;
/*************************************INSCRIPCION DENTRO DE LA FECHA *************************************** */
        foreach($detinscritos as $row)
        {
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);

            //if ($row->categoria=="6ta Categoria" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal") {
            if ($datosCat=="6TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
                if ($est==0) {
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA MACHOS", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;             
            }   
            $pdf->Ln(0);
        }

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);          
            /*$date1 = new DateTime($order->fechaexpo);
            $date2 = new DateTime($row->fechanac);
            $diff = $date1->diff($date2);    */

                if ($datosCat=="5TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
                    if ($est == "0") {
                        $pdf->Ln(2);
                        $pdf->SetFont('Arial','B',10);
                        $pdf->Cell(1,0);
                        $pdf->Cell(185, 5, "5TA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                        $pdf->Ln(3);
                        $est=1;    
                    }

                    if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                    $pdf->Ln(1);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(1,0);
                    $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                    $pdf->Cell(4,0);
                    $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                    $pdf->SetFont('Arial','',8 );
                    $pdf->Cell(50,0);
                    $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                    $pdf->Ln(4);
                    $pdf->Cell(4,0);
                    $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                    $pdf->Ln(4);
                    $pdf->Cell(4,0);
                    $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                    $pdf->Ln(4);     
                    $i=$i+1;
                //   }
                }  
            $pdf->Ln(0);
        }

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);           
            if ($datosCat=="5TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "5TA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;           
            }   
            $pdf->Ln(0);
        }

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="5TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "5TA CATEGORIA MACHOS", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;         
            }   
            $pdf->Ln(0);
        }    

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="5TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "5TA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;             
            }   
            $pdf->Ln(0);
        }  

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="4TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185,5, "4TA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }

                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185,5, "4TA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "4TA CATEGORIA MACHOS", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "4TA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(3, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;               
                }   
            $pdf->Ln(0);
        }

        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
            if ($datosCat=="3RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "3RA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
                if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
                if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}

                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, " Padre ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $i=$i+1;    
                }   
            $pdf->Ln(0);  
        }
        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
            if ($datosCat=="3RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "3RA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
                if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
                if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}

                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.", CHIP".$row->microchip.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, " Padre: ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $i=$i+1;                  
                }   
            $pdf->Ln(0);    
        }
    $pdf->Ln(2);

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "3RA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}

            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, " Padre: ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                   
            }   
        $pdf->Ln(0);     
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "3RA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(14, 0, " Padre: ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0);   
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA HEMBRAS", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;               
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA HEMBRAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0);  
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA MACHOS", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA MACHOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0); 
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="NO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS N/S", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;
            }   
        $pdf->Ln(0);    
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="NO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS N/S PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;               
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="NO" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS N/S", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;               
            }   
        $pdf->Ln(0);    
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="NO" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS N/S PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);    
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="SI" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS SELECCIONADAS", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="SI" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS SELECCIONADAS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                
            }   
        $pdf->Ln(0);    
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="SI" and $row->tipopelo=="Normal" and $row->tipoins=="NORMAL"){
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS SELECCIONADOS", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);  
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="SI" and $row->tipopelo=="Largo" and $row->tipoins=="NORMAL"){
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS SELECCIONADOS PELO LARGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);    
    }
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(185, 6, "* FUERA CATALOGO *", 0, 1, 'C', 1);
        $pdf->Ln(10);
/*************************************INSCRIPCION DENTRO DE LA FECHA *************************************** */
        foreach($detinscritos as $row)
        {
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);

            if ($datosCat=="6TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA HEMBRAS - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
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
            if ($datosCat=="6TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA HEMBRAS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;
            }
            $pdf->Ln(0);
        }
    

        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);          
            if ($datosCat=="6TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA MACHOS - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;             
            }   
            $pdf->Ln(0);
        }

        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);          
            if ($datosCat=="6TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "6TA CATEGORIA MACHOS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(3,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;             
            }   
            $pdf->Ln(0);
        }

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);          

                if ($datosCat=="5TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                    if ($est == "0") {
                        $pdf->Ln(2);
                        $pdf->SetFont('Arial','B',10);
                        $pdf->Cell(1,0);
                        $pdf->Cell(185, 5, "5TA CATEGORIA HEMBRAS - FUERA CATALOGO", 0, 1, 'L', 1);
                        $pdf->Ln(3);
                        $est=1;    
                    }

                    if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                    $pdf->Ln(1);
                    $pdf->SetFont('Arial','B',8);
                    $pdf->Cell(1,0);
                    $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                    $pdf->Cell(4,0);
                    $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                    $pdf->SetFont('Arial','',8 );
                    $pdf->Cell(50,0);
                    $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                    $pdf->Ln(4);
                    $pdf->Cell(4,0);
                    $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                    $pdf->Ln(4);
                    $pdf->Cell(4,0);
                    $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                    $pdf->Ln(4);     
                    $i=$i+1;
                //   }
                }  
            $pdf->Ln(0);
        }

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);           
            if ($datosCat=="5TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "5TA CATEGORIA HEMBRAS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;           
            }   
            $pdf->Ln(0);
        }

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="5TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "5TA CATEGORIA MACHOS - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;         
            }   
            $pdf->Ln(0);
        }    

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="5TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "5TA CATEGORIA MACHOS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;             
            }   
            $pdf->Ln(0);
        }  

        $est = 0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="4TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185,5, "4TA CATEGORIA HEMBRAS - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est = 1;
                }

                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;              
            }   
            $pdf->Ln(0);
        }
        
        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="4TA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est == 0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185,5, "4TA CATEGORIA HEMBRAS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;           
            }   
            $pdf->Ln(0);
        }

        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="4TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "4TA CATEGORIA MACHOS - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;             
            }  
            $pdf->Ln(0);
        }

        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]);   
            if ($datosCat=="4TA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "4TA CATEGORIA MACHOS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, ", F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(3, 0, "Padre: ".$row->padre."       Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);     
                $i=$i+1;               
                }   
            $pdf->Ln(0);
        }

        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
            if ($datosCat=="3RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "3RA CATEGORIA HEMBRAS - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
                if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
                if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}

                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, " Padre ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $i=$i+1;    
                }   
            $pdf->Ln(0);  
        }
        $est=0;
        foreach($detinscritos as $row){
            global $EdadM;
            $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
            $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
            if ($datosCat=="3RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
                if ($est==0) {
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(1,0);
                    $pdf->Cell(185, 5, "3RA CATEGORIA HEMBRAS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                    $pdf->Ln(3);
                    $est=1;
                }

                if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
                if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
                if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
                if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}

                $pdf->Ln(1);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(1,0);
                $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
                $pdf->SetFont('Arial','',8 );
                $pdf->Cell(50,0);
                $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.", CHIP".$row->microchip.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, " Padre: ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $pdf->Cell(4,0);
                $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
                $pdf->Ln(4);
                $i=$i+1;                  
                }   
            $pdf->Ln(0);    
        }
    $pdf->Ln(2);

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "3RA CATEGORIA MACHOS - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}

            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, " Padre: ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                   
            }   
        $pdf->Ln(0);     
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="3RA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "3RA CATEGORIA MACHOS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(14, 0, " Padre: ".$row->padre."    Madre: ".$row->madre, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0);   
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA HEMBRAS - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;               
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="HEMBRA" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA HEMBRAS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0);  
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA MACHOS - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="2DA CATEGORIA" and $row->sexo=="MACHO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "2DA CATEGORIA MACHOS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                  
            }   
        $pdf->Ln(0); 
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="NO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS N/S - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;
            }   
        $pdf->Ln(0);    
    }
    
    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="NO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS N/S PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;               
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="NO" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS N/S - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;               
            }   
        $pdf->Ln(0);    
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="NO" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS N/S PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);    
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="SI" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS SELECCIONADAS - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);   
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="HEMBRA" and $row->seleccion=="SI" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA") {
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA HEMBRAS SELECCIONADAS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                
            }   
        $pdf->Ln(0);    
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="SI" and $row->tipopelo=="Normal" and $row->tipoins=="FUERA CATA"){
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS SELECCIONADOS - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);  
    }

    $est=0;
    foreach($detinscritos as $row){
        global $EdadM;
        $datosEC = calculaEdad($row->fechanac, $row->fechaexpo);
        $datosCat = CalculaCategoria($datosEC[0], $datosEC[1], $datosEC[2]); 
        if ($datosCat=="1RA CATEGORIA" and $row->sexo=="MACHO" and $row->seleccion=="SI" and $row->tipopelo=="Largo" and $row->tipoins=="FUERA CATA"){
            if ($est==0) {
                $pdf->Ln(2);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(1,0);
                $pdf->Cell(185, 5, "1RA CATEGORIA MACHOS SELECCIONADOS PELO LARGO - FUERA CATALOGO", 0, 1, 'L', 1);
                $pdf->Ln(3);
                $est=1;
            }
            if ($row->bh=="SI") {$bhh=", BH";}if ($row->bh!="SI") {$bhh="";}
            if ($row->cabda=="SI") {$cab="CABDA";}if ($row->cabda!="SI") {$cab="";}
            if ($row->igp=="IGP1") {$igpp=", IGP1";}if ($row->igp=="IGP2") {$igpp=", IGP2";} if ($row->igp=="IGP3") {$igpp=", IGP3";} if ($row->igp=="Sin IGP") {$igpp="";} if ($row->igp=="") {$igpp="";}
            if ($row->microchip!="") {$micro=", CHIP: ".$row->microchip;}if ($row->microchip=="") {$micro="";}
            $pdf->Ln(1);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(1,0);
            $pdf->Cell(1, 1, "".$i.". ", 0, 0, 'L', 0);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 1, "".$row->nombredog, 0, 0, 'L', 0);
            $pdf->SetFont('Arial','',8 );
            $pdf->Cell(50,0);;
            $pdf->Cell(1, 1, "F.N. ".$row->fechanac.", ".$row->libro." ".$row->nroreg.",  ".$row->tatuaje.$micro.", ADN: ".$row->adn.", ED: ".substr($row->codoeh,0,3).", HD: ".substr($row->caderahd,0,3), 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Padre: ".$row->padre."       Madre: ".$row->madre."  //  ".$cab.$bhh.$igpp, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $pdf->Cell(4,0);
            $pdf->Cell(1, 0, "Criador: ".$row->criador."     Propietario: ".$row->propietario, 0, 1, 'L', 0);
            $pdf->Ln(4);
            $i=$i+1;                 
            }   
        $pdf->Ln(0);    
    }    


}
    $pdf->Ln(8);
    $pdf->Cell(2,40);
    //$pdf->Cell(0,0,"* Participar en las exposiciones es la mejor manera de mostrar los avances en la crianza de nuestros ejemplares *",0,0,"C",0);
    $pdf->Ln(8);
    
    $pdf->Output('', 'Inscripciones'.$order->nroexpo.'.pdf');
    
//} 
?>
