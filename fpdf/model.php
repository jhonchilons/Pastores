<?php 
require_once('conexion.php'); 

class BDConsultas extends Database
{
	public function getExposicionxId(int $idexposicion)
	{
        $query = $this->pdo->query('SELECT fechaexpo, nroexpo, tipoexposicion, organiza, ciudad, lugar, jueces.nombrejuez as nombrejuez
                                     FROM exposiciones inner join ciudades on exposiciones.idciudad=ciudades.idciudad 
                                          inner join jueces on exposiciones.idjuez=jueces.idjuez 
                                     WHERE idexposicion= '.$idexposicion);
		return $query->fetch();
	}

    public function getEjemplarxId(int $idejemplar)
	{
        $query = $this->pdo->query('SELECT nombredog, fechanac, sexo, libro, nroregistro, tipopelo, tatuaje, microchip, codoeh, caderahd,
                                            padre, madre, bh, cabda, igp, seleccion
                                     FROM ejemplar  
                                     WHERE idejemplar= '.$idejemplar);
		return $query->fetch();
	}

    public function getInscricionEjemplar(int $idexposicion, int $idejemplar)
	{
		$query = $this->pdo->query("SELECT exposiciones.fechaexpo AS fechaexpo, exposiciones.nroexpo AS nroexpo,  exposiciones.tipoexposicion AS tipoexposicion,
        ejemplar.nombredog AS nombredog, ejemplar.sexo AS sexo, ciudades.Ciudad AS ciudad, exposiciones.organiza AS organiza,
        exposiciones.idjuez AS idjuez, exposiciones.lugar AS lugar, ejemplar.fechanac as fechanac, ejemplar.sexo, ejemplar.tipopelo, ejemplar.libro,
        ejemplar.nroregistro AS nroreg, ejemplar.tatuaje, ejemplar.microchip, ejemplar.codoeh as codo, ejemplar.caderahd as cadera, ejemplar.dna,
        ejemplar.bh, ejemplar.cabda, ejemplar.igp, ejemplar.seleccion, ejemplar.padre, ejemplar.madre, ejemplar.criador, ejemplar.propietario,
        inscripciones.contacto, inscripciones.correo, inscripciones.celular,inscripciones.fechareg, inscripciones.fotovoucher, jueces.nombrejuez as nombrejuez,
        inscripciones.tipoins
        FROM
        ((((`inscripciones`
        JOIN `ejemplar` ON ((`inscripciones`.`idejemplar` = `ejemplar`.`idejemplar`)))
        JOIN `exposiciones` ON ((`inscripciones`.`idexposicion` = `exposiciones`.`idexposicion`)))
        JOIN `ciudades` ON ((`exposiciones`.`idciudad` = `ciudades`.`idciudad`)))
        JOIN `jueces` ON ((`exposiciones`.`idjuez` = `jueces`.`idjuez`)))
        WHERE (exposiciones.idexposicion LIKE '$idexposicion' AND ejemplar.idejemplar LIKE '$idejemplar')
        GROUP BY exposiciones.fechaexpo , exposiciones.nroexpo, exposiciones.nroexpo,ejemplar.nombredog");
		return $query->fetchAll();
	}

    public function getExpoxEjemplar(int $idejemplar)
	{
		$query = $this->pdo->query("SELECT exposiciones.fechaexpo AS fechaexpo, exposiciones.nroexpo AS nroexpo,  exposiciones.tipoexposicion AS tipoexposicion,
        ejemplar.nombredog AS nombredog, ejemplar.sexo AS sexo, ciudades.Ciudad AS ciudad, exposiciones.organiza AS organiza,
        exposiciones.idjuez AS idjuez, exposiciones.lugar AS lugar, ejemplar.fechanac, ejemplar.sexo, ejemplar.tipopelo, ejemplar.libro,
        ejemplar.nroregistro AS nroreg, ejemplar.tatuaje, ejemplar.microchip, ejemplar.codoeh as codos, ejemplar.caderahd as caderas, ejemplar.dna,
        ejemplar.bh, ejemplar.cabda, ejemplar.igp, ejemplar.seleccion, ejemplar.padre, ejemplar.madre, ejemplar.criador, ejemplar.propietario,
        inscripciones.contacto, inscripciones.correo, inscripciones.celular,inscripciones.fechareg, inscripciones.fotovoucher, jueces.nombrejuez as nombrejuez,
        inscripciones.tipoins
        FROM
        ((((`inscripciones`
        JOIN `ejemplar` ON ((`inscripciones`.`idejemplar` = `ejemplar`.`idejemplar`)))
        JOIN `exposiciones` ON ((`inscripciones`.`idexposicion` = `exposiciones`.`idexposicion`)))
        JOIN `ciudades` ON ((`exposiciones`.`idciudad` = `ciudades`.`idciudad`)))
        JOIN `jueces` ON ((`exposiciones`.`idjuez` = `jueces`.`idjuez`)))
        WHERE (inscripciones.idejemplar LIKE '$idejemplar')
        GROUP BY exposiciones.fechaexpo , exposiciones.nroexpo, exposiciones.nroexpo,ejemplar.nombredog");
		return $query->fetchAll();
	}

	public function getDetalleInscritosxExpo(int $idexposicion)
	{
		$query = $this->pdo->query( "SELECT exposiciones.fechaexpo AS fechaexpo, exposiciones.nroexpo AS nroexpo,  exposiciones.tipoexposicion AS tipoexposicion,
        ejemplar.nombredog AS nombredog, ejemplar.sexo AS sexo, ciudades.Ciudad AS ciudad, exposiciones.organiza AS organiza,
        exposiciones.idjuez AS idjuez, exposiciones.lugar AS lugar, ejemplar.fechanac, ejemplar.sexo, ejemplar.tipopelo, ejemplar.libro,
        ejemplar.nroregistro AS nroreg, ejemplar.tatuaje, ejemplar.microchip, ejemplar.codoeh, ejemplar.caderahd, ejemplar.dna as adn,
        ejemplar.bh, ejemplar.cabda, ejemplar.igp, ejemplar.seleccion, ejemplar.padre, ejemplar.madre, ejemplar.criador, ejemplar.propietario,
        inscripciones.contacto, inscripciones.correo, inscripciones.celular,inscripciones.fechareg, inscripciones.fotovoucher, jueces.nombrejuez as nombrejuez,
        inscripciones.tipoins
        FROM
        ((((`inscripciones`
        JOIN `ejemplar` ON ((`inscripciones`.`idejemplar` = `ejemplar`.`idejemplar`)))
        JOIN `exposiciones` ON ((`inscripciones`.`idexposicion` = `exposiciones`.`idexposicion`)))
        JOIN `ciudades` ON ((`exposiciones`.`idciudad` = `ciudades`.`idciudad`)))
        JOIN `jueces` ON ((`exposiciones`.`idjuez` = `jueces`.`idjuez`)))
        WHERE (exposiciones.idexposicion LIKE '$idexposicion')
        GROUP BY exposiciones.fechaexpo , exposiciones.nroexpo, exposiciones.nroexpo, ejemplar.nombredog, adn
        ORDER BY nombredog asc, ejemplar.sexo asc");

    return $query->fetchAll();
	}

    public function getlistadoEjemplares()
	{
		$query = $this->pdo->query(" SELECT 
        `h`.`idejemplar` AS `idejemplar`, `h`.`nombredog` AS `nombredog`, `h`.`sexo` AS `sexo`, `h`.`libro` AS `libro`,
        `h`.`nroregistro` AS `nroregistro`, `h`.`fechanac` AS `fechanac`,
        (SELECT `p`.`nombredog` FROM `ejemplar` `p` WHERE (`p`.`idejemplar` = `h`.`padre`)) AS `padre`,
        (SELECT `p`.`nombredog` FROM `ejemplar` `p` WHERE (`p`.`idejemplar` = `h`.`madre`)) AS `madre`,
        `h`.`codoeh` AS `codoeh`, `h`.`caderahd` AS `caderahd`, `h`.`tatuaje` AS `tatuaje`, `h`.`microchip` AS `microchip`,
        `h`.`dna` AS `dna`, `h`.`picture` AS `picture`, `h`.`bh` AS `bh`, `h`.`cabda` AS `cabda`, `h`.`seleccion` AS `seleccion`,
        `h`.`igp` AS `igp`, `h`.`iduser` AS `iduser`, `h`.`criador` AS `criador`, `h`.`propietario` AS `propietario`
        FROM `ejemplar` `h`
        ORDER BY `h`.`nombredog` asc");
		return $query->fetchAll();
	}

    public function CantRegistros(int $idexposicion)
	{
		$query = $this->pdo->query( "SELECT count(*) 
        FROM inscripciones
        WHERE (inscripciones.idexposicion LIKE '$idexposicion')");

    return $query->fetchAll();
	}

    public function CantRegistrosxEjemplar(int $idejemplar)
	{
		$query = $this->pdo->query( "SELECT count(*) 
        FROM inscripciones
        WHERE (inscripciones.idejemplar LIKE '$idejemplar')");

    return $query->fetchAll();
	}
}
?>