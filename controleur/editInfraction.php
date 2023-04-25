<?php
$op 	= (isset($_GET['op'])?$_GET['op']:null);
$ajout 	= ($op == 'a');
$modif 	= ($op == 'm');
$suppr 	= ($op == 's');
//$num = (isset($_GET['num'])?$_GET['num']:null);
$num 	= (isset($_GET['num'])?$_GET['num']:null);
$editNum= $ajout;

$tableauIdDelitAAjouter=[];  
for ($i =1; $i<=6; $i++){
	if(isset($_POST[strval($i)])){
		echo $_POST[strval($i)];
		$tableauIdDelitAAjouter[] = $i;}
}
if(count($tableauIdDelitAAjouter)>0){
require_once('../modele/infractionBydelitDAO.php');
$delitByInfractionDAO = new delitByInfractionDAO();
$delitByInfractionDAO->insertDelitInfraction( $_POST['num'] ,$tableauIdDelitAAjouter);
}

// accès à la page uniquement si un numéro de salle et statut opération sont passés en paramètre
if ( ($num!=null && $ajout) || (($num==null) && $modif || $suppr) ) {
	header("location: ../controleur/infractionAdmin.php");
} 

require_once('../modele/infractionDAO.php');
$infractionDAO = new InfractionDAO();

// gestion des zones non modifiables en mode "modif"
$valeurs['num'] = null;
if ($modif)	{
	$valeurs['num'] = $num;
	$uneInfraction = $infractionDAO->getById($valeurs['num']);
}
if ($editNum) {
	$valeurs['num'] = (isset($_POST['num'])?trim($_POST['num']):$valeurs['num']);
}

$titre = (($ajout)?'Nouvelle Infraction':(($modif)?"Infraction - édition des informations":null));

$erreurs = ['num'=>"", 'matricule'=>'', 'date'=>"", 'permis'=>""];
$valeurs['matricule'] = (isset($_POST['matricule'])?trim($_POST['matricule']):null);
$valeurs['date'] = (isset($_POST['date'])?trim($_POST['date']):null);
$valeurs['permis'] = (isset($_POST['permis'])?trim($_POST['permis']):null);
$retour = false;
if (isset($_POST['valider'])) {
	if (!isset($valeurs['num']) or strlen($valeurs['num'])==0) 	{ $erreurs['num']	= 'saisie obligatoire du numéro';	}
	else if ($editNum and $infractionDAO->existe($valeurs['num'])) 	{ $erreurs['num'] 	= 'Numéro infraction déjà existant.';	}

 	$nbErreurs = 0;
 	foreach ($erreurs as $erreur){
 		if ($erreur != "") $nbErreurs++;
 	}
	 require_once('../modele/infractionBydelitDAO.php');

 	if ($nbErreurs == 0){
		$uneInfraction = new Infraction($valeurs['num'],$valeurs['matricule'], $valeurs['date'],$valeurs['permis']);
		$retour = true;

		if ($ajout)	{
			$infractionDAO->insert($uneInfraction);
		}	
		else {			
			$infractionDAO->update($uneInfraction);
		}
	}
}
else if (isset($_POST['annuler']))	{
	$retour = true;
}
else if ($suppr) {
// suppression
	$infractionDAO->delete($num);
	$retour = true;
}
if (isset($modif)) {
    require_once '../modele/infractionDAO.php'; // inclure le fichier qui contient la définition de la classe InfractionDAO
    $InfractionDAO = new InfractionDAO(); // initialiser la variable $InfractionDAO avec une instance de la classe InfractionDAO
    $uneInfraction = $InfractionDAO->getById($num);
    if ($uneInfraction === null) { // vérifier si la valeur renvoyée par la méthode getById() n'est pas null
     $valeurs['num'] = $uneInfraction->getId();
        $valeurs['no_immat'] = $uneInfraction->getImmatricul();
        $valeurs['date_inf'] = $uneInfraction->getDateinfract();
        $valeurs['no_permis'] = $uneInfraction->getNopermis();
    }
}
if ($retour)
{
	header("location: infractionAdmin.php");
} 	

require_once("../vue/edit.view.infraction.php");
?>