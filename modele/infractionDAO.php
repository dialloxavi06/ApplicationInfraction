<?php
require_once("delit.class.php");
require_once("connexion.php");
require_once("infraction.class.php");
class InfractionDAO
{
	private $bd;
	private $select;

	function __construct()
	{
		$this->bd = new Connexion();
		$this->select = 'SELECT id_inf, no_immat, date_inf, no_permis FROM infraction ORDER BY id_inf';
	}

	function insert(Infraction $Infraction): void
	{
		$this->bd->execSQL(
			"INSERT INTO infraction (id_inf,no_immat, no_permis, date_inf)
            VALUES (:id_inf,:noImmat, :noPermis, :dateInf)",
			[':id_inf' => $Infraction->getId(),
			':noImmat' => $Infraction->getImmatricul(), 
			':noPermis' => $Infraction->getNopermis(), 
			'dateInf' => $Infraction->getDateinfract()]
		);
	}

	function delete(string $idInfract): void
	{
		$this->bd->execSQL(
			"DELETE FROM infraction WHERE id_inf = :idInfract",
			[':idInfract' => $idInfract]
		);
	}

	function update(Infraction $Infraction): void
	{
		$this->bd->execSQL(
			"UPDATE infraction SET  no_immat=:noImmat, no_permis=:noPermis, date_inf=:dateInf WHERE id_inf=:id_inf",
			[
				':id_inf' => $Infraction->getId(),
				':noImmat' => $Infraction->getImmatricul(), 
				':noPermis' => $Infraction->getNopermis(),
				 ':dateInf' => $Infraction->getDateinfract()
			]
		);
	}

	private function loadQuery(array $result): array
	{
		$Infractions = [];
		foreach ($result as $row) {
			$Infraction = new Infraction();
			$Infraction->setId($row['id_inf']);
			$Infraction->setImmatricul($row['no_immat']);
			$Infraction->setNopermis($row['no_permis']);
			$Infraction->setDateinfract($row['date_inf']);
			$Infractions[] = $Infraction;
		}
		return $Infractions;
	}

	function getAll(): array
	{
		return ($this->loadQuery($this->bd->execSQL($this->select)));
	}

	function getById($id): Infraction
	{
		$uneInfraction = new Infraction();

		$lesInfractions = $this->loadQuery($this->bd->execSQL("SELECT id_inf, no_immat, date_inf, no_permis FROM infraction WHERE
		 id_inf= :id", [
			":id" => $id]));
		if (count($lesInfractions) > 0) {
			$uneInfraction = $lesInfractions[0];
		}
		return $uneInfraction;
	}

	function existe(string $id): bool | null
	{
		$req 	= "SELECT *  FROM  infraction
					WHERE id_inf = :id";
		$res 	= ($this->loadQuery($this->bd->execSQL($req, [':id' => $id])));
		return ($res != []);
	}

	function getNomPermis($noPermis)
	{
		return ($this->loadQuery($this->bd->execSQL(" SELECT id_inf, no_immat, date_inf, no_permis FROM infraction
			WHERE no_permis = :noPermis  ", [':noPermis' => $noPermis])));
	}

	// function prend id de une infraction et return tous les infromations sur le
	//véhicule et le conducteur et le propriétaire de véhicule
	function InfoCnducteurVéhicule(string $id)
	{
		return ($this->bd->execSQL("SELECT concat('   Infraction: ',id_inf ,'  du : ',date_format( date_inf , '%d/%d/%Y')
		,'    véhicule : ' ,v.no_immat ,'   ',   v.marque ,' ' , v.modele ,'   imatriculé  le : ' 
		,date_format( v.date_immat  , '%d/%d/%Y') ) as véhicule 

		, concat('   Propriétaire:  ' ,co.nom ,'  ' , co.prenom , '   N° premis : ',co.no_permis, '  obtenu le : ' 
		,date_format( co.date_permis , '%d/%d/%Y') ) as propriétaire ,

		concat ('   Conducteur : ' , c.nom ,'  ' , c.prenom , ' N° premis : ',c.no_permis, ' obtenu le : '
		,date_format( c.date_permis , '%d/%d/%Y')) as conducteur
		
		FROM  infraction i 
        	inner join  vehicule v  on i.no_immat = v.no_immat 
			inner join  conducteur c on c.no_permis = i.no_permis
			inner join  conducteur co on v.no_permis =co.no_permis 
			where id_inf = :id ", [':id' => $id]));
	}



	function getTotalMontantInfractionByTd(string $id): int|null
	{
		$res = $this->bd->execSQL("SELECT SUM(montant) as total FROM comprend, infraction, delit
		WHERE infraction.id_inf = comprend.id_inf
					AND delit.id_delit = comprend.id_delit 
					AND infraction.id_inf = :id", [':id' => $id]);
		return $res[0]['total'];
	}
}
