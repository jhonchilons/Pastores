<?php
//if($GLOBALS["u"]->is_admin > 0){

        require "plantilla.php";
        require "conexion.php";
        //require 'fpdf/fpdf.php';
    
    $nroexpo = $_POST['nroexpo'];
    $query= "SELECT exposiciones.fechaexpo AS fechaexpo, exposiciones.nroexpo AS nroexpo,  exposiciones.tipoexposicion AS tipoexposicion,
                ejemplar.nombredog AS nrombredog, ejemplar.sexo AS sexo, ciudades.Ciudad AS ciudad,
                TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) AS edad,
                if(TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) between 4 and 5,'6ta Categoria',
                if(TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) between 6 and 8,'5ta Categoria',
                if(TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) between 9 and 11,'4ta Categoria',
                if(TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) between 12 and 17,'3ra Categoria',
                if(TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) between 18 and 23,'2da Categoria',
                if(TIMESTAMPDIFF(MONTH, ejemplar.fechanac, exposiciones.fechaexpo) between 24 and 100,'1ra Categoria','')))))) as categotia,
                FROM
                    (((ejemplar
                    JOIN inscripciones ON ((ejemplar.idejemplar = inscripciones.idejemplar)))
                    JOIN exposiciones ON ((inscripciones.idexposicion = exposiciones.idexposicion)))
                    JOIN ciudades ON ((exposiciones.idciudad = ciudades.IdCiudad)))
                    WHERE exposiciones.nroexpo LIKE '$nroexpo'
                GROUP BY exposiciones.fechaexpo , exposiciones.nroexpo, exposiciones.nroexpo,ejemplar.nombredog";
                $resultado = $mysqli->query($query);

    $pdf=new PDF();
    
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",8);
    $pdf->SetFillColor(232,232,232);

    
    $pdf->Cell(20,5,"Fecha Expo",1,0,"C",1);
    $pdf->Cell(15,5,"Nro Expo",1,0,"C",1);
    $pdf->Cell(25,5,"Tipo Expo",1,0,"C",1);
    $pdf->Cell(25,5,"Ciudad",1,0,"C",1);
    $pdf->Cell(55,5,"Ejemplar",1,0,"C",1);
    $pdf->Cell(25,5,"Sexo",1,0,"C",1);
    $pdf->Cell(25,5,"Edad",1,0,"C",1);

    while($row = $resultado->fetch_assoc())
    {
        //$pdf->Cell(25,6,utf8_decode($row['fechaexpo']),1,0,'C');
        $pdf->Cell(20, 5, $row["fechaexpo"], 1, 0, "C");
        $pdf->Cell(15, 5, $row["nroexpo"],1, 0, "C");
        $pdf->Cell(25, 5, $row["tipoexposicion"], 1, 0, "C");
        $pdf->Cell(25, 5, $row["ciudad"], 1, 0, "C");
        $pdf->Cell(55, 5, $row["nrombredog"],1, 0, "L");
        $pdf->Cell(25, 5, $row["sexo"], 1, 0, "C");
        $pdf->Cell(20, 5, $row["edad"],1, 1, "C");

    }

    $pdf->Output();

//} 
?>
