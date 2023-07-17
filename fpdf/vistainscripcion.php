<?php

if(count($_POST)>0){ 

    require "plantillainscripcion.php";
    require "conexion.php";
    require "model.php";
    require "calculatiempo.php";

    $nw = new BDConsultas();

    $idexposicion = $_POST['idexposicion'];
    $idejemplar = $_POST['idejemplar'];

    $pdf=new PDF();
    
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",8);
    $pdf->SetFillColor(232,232,232);
    $detinscripcion = $nw->getInscricionEjemplar($idexposicion, $idejemplar);

        /*LINEAS-*/
    $pdf->Line(10,52,200,52);
    $pdf->Line(10,57,200,57);
    $pdf->Line(10,88,200,88);
    $pdf->Line(10,93,200,93);
    $pdf->Line(10,160,200,160);
    $pdf->Line(10,165,200,165);
    $pdf->Cell(20,0);
    $pdf->Cell(10,0,"DATOS DE LA EXPOSICION",0,1,"C",1);

   
   foreach($detinscripcion as $row)
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

        $pdf->ln(5);
        $pdf->Cell(10,0);
        $pdf->Cell(22,5,"Fecha Expo",0,0,"C",1);
        $pdf->Cell(1,0);
        $pdf->Cell(22, 5, $row->fechaexpo, 0, 0, 'L', 0);
        $pdf->Cell(4,10);
        $pdf->Cell(20,5,"Nro Expo",0,0,"C",1);
        $pdf->Cell(1,10);
        $pdf->Cell(20, 5, $row->nroexpo, 0, 0, 'L', 0);
        $pdf->Cell(21,20);
        $pdf->Cell(20,5,"Ciudad",0,0,"C",1);
        $pdf->Cell(1,40);
        $pdf->Cell(25, 5, $row->ciudad, 0, 1, 'L', 0);
        $pdf->ln(3);

        //********************************************** */
        $pdf->Cell(10,0);
        $pdf->Cell(22,5,"Tipo Expo",0,0,"C",1);
        $pdf->Cell(1,0);
        $pdf->Cell(22, 5, $row->tipoexposicion, 0, 0, 'L', 0);
        $pdf->Cell(4,10);
        $pdf->Cell(20,5,"Organiza",0,0,"C",1);
        $pdf->Cell(1,40);
        $pdf->Cell(22, 5, $row->organiza, 0, 0, 'L', 0);
        $pdf->Cell(19,20);
        $pdf->Cell(20,5,"Juez",0,0,"C",1);
        $pdf->Cell(1,80);
        $pdf->Cell(20, 5, $row->nombrejuez, 0, 1, 'L', 0);
        $pdf->ln(3);
        //********************************************** */
        $pdf->Cell(10,120);
        $pdf->Cell(22,5,"Lugar",0,0,"C",1);
        $pdf->Cell(1,1);
        $pdf->Cell(22, 5, $row->lugar, 0, 1, 'L', 0);
        $pdf->Ln(10);

        //********************************************** */
        $pdf->Cell(18,0);
        $pdf->Cell(10,0,"DATOS DEL EJEMPLAR",0,1,"C",1);
        $pdf->Ln(6);
        //********************************************** */
        $pdf->Cell(80,5,"Ejemplar",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Fecha Nac.",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Sexo",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Tipo Pelo",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Edad",0,1,"C",1);
        $pdf->Ln(2);
        
        $pdf->Cell(2,40);
        $pdf->Cell(80, 5, $row->nombredog, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $row->fechanac, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $row->sexo, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $row->tipopelo, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $EdadM." Meses ".$datosEC[2]." dias", 0, 1, 'C', 0);
        $pdf->Ln(4);
//********************************************** */
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Libro",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Nro Registro",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(20,5,"Tatuaje",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(25,5,"Microchip",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(32,5,"Examenes Codo",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(32,5,"Examenes Cadera",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(15,5,"ADN",0,1,"C",1);
        $pdf->Ln(2);

        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $row->libro, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $row->nroreg, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(20, 5, $row->tatuaje, 0, 0, 'L', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(25, 5, $row->microchip, 0, 0, 'L', 0);
        //if ($row->edad<=12) {$codoo="";}if ($row->edad>12) {$codoo=$row->codo;}
        if ($EdadM<=12) {$codoo="";}if ($EdadM>12) {$codoo=$row->codo;}
        $pdf->Cell(2,40);
        $pdf->Cell(32, 5, $codoo, 0, 0, 'C', 0);
        //if ($row->edad<=12) {$caderaa="";}if ($row->edad>12) {$caderaa=$row->cadera;}
        if ($EdadM<=12) {$caderaa="";}if ($EdadM>12) {$caderaa=$row->cadera;}
        $pdf->Cell(2,40);
        $pdf->Cell(32, 5, $caderaa, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(15, 5, $row->dna, 0, 1, 'C', 0);
        $pdf->Ln(4);
//********************************************** */
        $pdf->Cell(2,40);
        $pdf->Cell(15,5,"BH",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(15,5,"CABDA",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(20,5,"IGP",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(20,5,utf8_decode("Selección"),0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(53,5,"Padre",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(53,5,"Madre",0,1,"C",1);
        $pdf->Ln(2);
        $pdf->Cell(2,40);
        $pdf->Cell(15, 5, $row->bh, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(15, 5, $row->cabda, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(20, 5, $row->igp, 0, 0, 'C', 0);
        if ($EdadM<=18) {$selec="";}if ($EdadM>18) {$selec=$row->seleccion;}
        $pdf->Cell(2,40);
        $pdf->Cell(20, 5, $selec, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(53, 5, $row->padre, 0, 0, 'L', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(53, 5, $row->madre, 0, 1, 'L', 0);

        $pdf->Ln(4);
        
        //********************************************** */
        
        $pdf->Cell(2,40);
        $pdf->Cell(50,5,"Criador",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(50,5,"Propietario",0,0,"C",1);
        $pdf->Cell(35,40);
        $pdf->Cell(50,5,"Categoria a Participar",0,1,"C",1);
        $pdf->Ln(2);

        $pdf->Cell(2,40);
        $pdf->Cell(50, 5, $row->criador, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(50, 5, $row->propietario, 0, 0, 'C', 0);
        $pdf->Cell(35,40);
        $pdf->SetTextColor(177,61,36);
        if ($datosCat=="1RA CATEGORIA") {
            if ($selec=="SI") {
                $pdf->Cell(50, 5, $datosCat." ".$row->sexo." SEL", 0, 1, 'C', 0);    
            }else {
                $pdf->Cell(50, 5, $datosCat." ".$row->sexo." NS", 0, 1, 'C', 0);    
            }
        }else {
            $pdf->Cell(50, 5, $datosCat." ".$row->sexo, 0, 1, 'C', 0);
        }
        
        $pdf->Ln(6);
        
        //******DATOS DEL CONTACTO *************************** */
        //********************************************** */
        $pdf->Cell(18,0);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(10,0,"DATOS DEL CONTACTO",0,1,"C",1);
        $pdf->Ln(6);
        //********************************************** */
        
        $pdf->Cell(2,40);
        $pdf->Cell(50,5,"Contacto",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(50,5,"Correo",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(50,5,"Celular",0,0,"C",1);
        $pdf->Cell(2,40);
        $pdf->Cell(28,5,"Fecha Reg.",0,1,"C",1);

        $pdf->Ln(2);

        $pdf->Cell(2,40);
        $pdf->Cell(53, 5, $row->contacto, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(50, 5, $row->correo, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(50, 5, $row->celular, 0, 0, 'C', 0);
        $pdf->Cell(2,40);
        $pdf->Cell(28, 5, $row->fechareg, 0, 1, 'C', 0);
        if (!empty($row->fotovoucher)) {
            $pdf->Image($row->fotovoucher, 150 ,185, 35 , 38,'JPG');
        }

    }
    $pdf->Ln(15);

    $pdf->Multicell(450,4, "Categorias de: 
    ".mb_convert_encoding(
    "* (4-6 meses)     6ta. Categoría Hembras y Machos 
    * (6-9 meses)     5ta. Categoría Hembras y Machos 
    * (9-12 meses)   4ta. Categoría Hembras y Machos 
    * (12-18 meses) 3ra. Categoría Hembras y Machos 
    * (18-24 meses) 2da. Categoría Hembras y Machos 
    * (+ 24 meses)   1ra. Categoría Hembras y Machos", 'ISO-8859-1', 'UTF-8'));
    $pdf->Ln(8);
    $pdf->Cell(2,40);
    $pdf->Cell(0,0,"* Participar en las exposiciones es la mejor manera de mostrar los avances en la crianza de nuestros ejemplares *",0,0,"C",0);
    $pdf->Ln(8);
    
    $pdf->Output('Constancia_'.$row->nroexpo.'_'.$row->nombredog.".pdf",'I');
}

?>
