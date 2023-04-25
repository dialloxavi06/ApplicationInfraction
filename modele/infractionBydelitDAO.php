<?php
require_once("connexion.php");
require_once("infractionBydelit.class.php");
require_once("infractionDAO.php");
class delitByInfractionDAO
{
	private $bd;
	private $select;

	function __construct()
	{
		$this->bd = new Connexion();
		$this->select = 'SELECT id_delit, id_inf
							FROM comprend';
	}
	function insert(InfractionBydelit $delitByinfraction): void
	{
		$this->bd->execSQL(
			"INSERT INTO comprend (id_delit, id_inf)
                                        VALUES (:idDelit, :idInf)",
			[
				':idDelit' => $delitByinfraction->getDelit()->getId_delit(), ':idInf' => $delitByinfraction->getInf()->getId()
			]
		);
	}
	///////////////////////////////////////////** */
	
	function insertDelitInfraction(int $idInf, array $idDelits)////*
	{
		foreach ($idDelits as $IdDelit) {
			$this->bd->execSQL(
				"INSERT INTO comprend ( id_inf ,id_delit)
	VALUES ( :idInf, :idDelit)",
				[
					':idInf' => $idInf, ':idDelit' => $IdDelit,
					]
				);
			}
		}
		
		//////////////////////////////////**** */






	function deleteByNumDelitByIdInfract(string $numDelit, string $idInfract): void
	{
		$this->bd->execSQL(
			"DELETE FROM comprend WHERE id_delit = :numDelit AND id_inf=:idInfract",
			[':numDelit' => $numDelit, ':idInfract' => $idInfract]
		);
	}

	function deleteByNumDelit(string $numDelit): void
	{
		$this->bd->execSQL(
			"DELETE FROM comprend WHERE id_delit = :numDelit",
			[':numSalle' => $numDelit]
		);
	}
	function deleteByIdInfract(string $idInfract): void
	{
		$this->bd->execSQL(
			"DELETE FROM comprend WHERE id_delit = :idInfract",
			[':idInfract' => $idInfract]
		);
	}

	private function loadQuery(array $result): array
	{
		$infractionDAO = new InfractionDAO();
		$lesInfractionByDelit = [];
		foreach ($result as $row) {
			$infraction = $infractionDAO->getById($row['id_delit']);
			$lesInfractionByDelit[] = new InfractionBydelit($row['id_inf'], $infraction);
		}
		return $lesInfractionByDelit;
	}

	function getAll(): array
	{
		return ($this->loadQuery($this->bd->execSQL($this->select)));
	}

	function getByNumDelit(string $numDelit): array
	{
		return ($this->loadQuery($this->bd->execSQL($this->select . " WHERE id_delit=:numDelit", [':numDelit' => $numDelit])));
	}

	function getByDelitByIdInfract(string $numDelit, string $idInfract): InfractionBydelit
	{
		return ($this->loadQuery($this->bd->execSQL(
			$this->select . " AND id_delit=:numDelit AND id_inf=:idInfract",
			[':numSalle' => $numDelit, ':idInfract' => $idInfract]
		)))[0];
	}
	// function prend id de infraction et return la nature
	// et montant de tous les delits de cette infraction 
	function getLesDelitById_inf($id)
	{
		return ($this->bd->execSQL(" SELECT d.id_delit , d.nature , d.montant 
			from  comprend 
			inner join  infraction on infraction.id_inf = comprend.id_inf
			inner join delit  d on comprend.id_delit = d.id_delit
			where infraction.id_inf = :id ", [':id' => $id]));
	}
}
