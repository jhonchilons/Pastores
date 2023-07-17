
<?php

    function CalculaCategoria ($Dat0, $Dat1, $Dat2){

        if ($Dat0==0) {
            //  CONSULTA PARA SEXTA CATEGORIA *****************************************
            if ($Dat1>=4 and $Dat1<=5 )  {
                if ($Dat1>=4 and $Dat2>=1)  {
                    $Cat = "6TA CATEGORIA";
                    return $Cat;
                }
            }

            if ($Dat1>=4 and ($Dat1<=6 and $Dat2==0)) {
                if ($Dat1>=4 and $Dat2>=1)  {
                    $Cat = "6TA CATEGORIA";
                    return $Cat;
                }
                if ($Dat1==6 and $Dat2==0)  {
                    $Cat = "6TA CATEGORIA";
                    return $Cat;
                }

            }
        
            //  CONSULTA PARA QUINTA CATEGORIA ****************************************
            if ($Dat1>=6 and $Dat1<=8 )  {
                if ($Dat1>=6 and $Dat2>=1)  {
                    $Cat = "5TA CATEGORIA";
                    return $Cat;
                }
            }

            if ($Dat1>=6 and ($Dat1<=9 and $Dat2==0))  {

                if ($Dat1>=6 and $Dat2>=1)  {
                    $Cat = "5TA CATEGORIA";
                    return $Cat;
                }
                for ($i=7; $i <=9 ; $i++) { 
                    if ($Dat1==$i and $Dat2==0)  {
                        $Cat = "5TA CATEGORIA";
                        return $Cat;
                    }                
                }                   
            }

            //  CONSULTA PARA CUARTA CATEGORIA *****************************************
            if ($Dat1>=9 and $Dat1<=11)  {
                if ($Dat1>=9 and $Dat2>=1)  {
                    $Cat = "4TA CATEGORIA";
                    return $Cat;
                }
            }
            
            if ($Dat1>=9 and ($Dat1<=12 and $Dat2==0))  {

                if ($Dat1>=9 and $Dat2>=1)  {
                    $Cat = "4TA CATEGORIA";
                    return $Cat;
                }
                for ($i=10; $i <=11 ; $i++) { 
                    if ($Dat1==$i and $Dat2==0)  {
                        $Cat = "4TA CATEGORIA";
                        return $Cat;
                    }                
                }        
            }
        }

        if ($Dat0==1) {
            //  CONSULTA PARA TERCERA CATEGORIA *****************************************
            if ($Dat1==0 and $Dat2==0)  {
                $Cat = "4TA CATEGORIA";
                return $Cat;
            }
            if ($Dat1>=0 and $Dat1<=5)  {
                if ($Dat1>=0 and $Dat2>=1)  {
                    $Cat = "3RA CATEGORIA";
                    return $Cat;
                }
            }
            
            if ($Dat1>=0 and ($Dat1<=6 and $Dat2==0))  {

                if ($Dat1>=0 and $Dat2>=1)  {
                    $Cat = "3RA CATEGORIA";
                    return $Cat;
                }
                for ($i=1; $i <=6 ; $i++) { 
                    if ($Dat1==$i and $Dat2==0)  {
                        $Cat = "3RA CATEGORIA";
                        return $Cat;
                    }                
                }        
            }    
            //  CONSULTA 2DA CATEGORIA **************************************************
            if ($Dat1>=6 and $Dat1<=11)  {
                if ($Dat1>=6 and $Dat2>=1)  {
                    $Cat = "2DA CATEGORIA";
                    return $Cat;
                }
            }
            
            if ($Dat1>=6 and ($Dat1<=12 and $Dat2==0))  {

                if ($Dat1>=6 and $Dat2>=1)  {
                    $Cat = "2DA CATEGORIA";
                    return $Cat;
                }
                for ($i=7; $i <=11 ; $i++) { 
                    if ($Dat1==$i and $Dat2==0)  {
                        $Cat = "2DA CATEGORIA";
                        return $Cat;    
                    }                
                }
            }        
        }
        //  CONSULTA 1RA CATEGORIA **************************************************
        if ($Dat0>=2) {
            if ($Dat1==0 and $Dat2==0)  {
                $Cat = "2DA CATEGORIA";
                return $Cat;
            }
            if ($Dat1>=0 and $Dat1<=11)  {
                if ($Dat1>=0 and $Dat2>=1)  {
                    $Cat = "1RA CATEGORIA";
                    return $Cat;
                }

                for ($i=1; $i <=50 ; $i++) { 
                    if ($Dat1==$i and $Dat2==0)  {
                        $Cat = "1RA CATEGORIA";
                        return $Cat;    
                    }                
                }
            }
        }
    }

    function calculaEdad($fechaInicio, $fechaFin){
        $date1 = date_create($fechaInicio);
        $date2 = date_create($fechaFin);
        $interval = $date1->diff($date2);

        $tiempo=array();
        foreach ($interval as $valor) {
            $tiempo[]=$valor;
        }
        
        return $tiempo;
    }
//}
?>