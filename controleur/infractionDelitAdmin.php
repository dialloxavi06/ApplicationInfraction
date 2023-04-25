<?php
$op 	= (isset($_GET['op'])?$_GET['op']:null);
$ajout 	= ($op == 'a');
$modif 	= ($op == 'm');
$supprInf 	= ($op == 'sI');
$supprDel 	= ($op == 'sD');
$detaille= ($op == 'd');
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$idd = (isset($_GET['idd']) ? $_GET['idd'] : null);
$montant = (isset($_GET['montant']) ? $_GET['montant'] : null);///*

// accès à la page uniquement si un numéro de salle est passé en paramètre
if ($id == null) {
    header("location: infractionUtilisateur.php");
}



require_once('../modele/infractionDAO.php');
$infractionDAO = new InfractionDAO();

$uneInfraction = $infractionDAO->getById($id);
$infractionInfo = $infractionDAO->InfoCnducteurVéhicule($id);
// calculer le montant totale d'une infraction aprtir de id infraction 
$montantInfraction=$infractionDAO->getTotalMontantInfractionByTd($id);


require_once('../modele/delitDAO.php');
$delitDAO = new DelitDAO();
$uneDelit = $delitDAO->getById($id);
$titre  = $id . ' ' . $uneDelit->getNature();


// liste des delits  de l'infaaction 
require_once('../modele/infractionBydelitDAO.php');
$delitByInfractionDAO = new delitByInfractionDAO();
$lesDelitByInfraction = $delitByInfractionDAO->getLesDelitById_inf($id);


$lignes    = [];

foreach ($lesDelitByInfraction as $unDelitByInfraction) {
    $ch = '';
    $ch .= '<td>' . $unDelitByInfraction["id_delit"] . '</td>';
    $ch .= '<td>' . $unDelitByInfraction["nature"] . '</td>';
    $ch .= '<td>' . $unDelitByInfraction["montant"] ."€". '</td>'; ///*

    
     /////////////////////////13/4
     $ch .= '<td onclick="confirmerAvantEffacer()" ><a id="supp" href="effacerDelit.php?op=sD&id='
     . urlencode($uneInfraction->getId()) . '&idd=' . $unDelitByInfraction["id_delit"]
     . '" ><img src="../vue/style/corbeille.png"></a></td>';
 /////////////////////////13/4

    $lignes[] = "<tr>$ch</tr>";
}

require_once('../vue/infractionDelit.view.php');