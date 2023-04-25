<?php
$op 	= (isset($_GET['op'])?$_GET['op']:null);
$supprInf 	= ($op == 'sI');
$supprDel 	= ($op == 'sD');
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


require_once('../modele/delitDAO.php');
$delitDAO = new DelitDAO();
$uneDelit = $delitDAO->getById($id);


require_once('../modele/infractionBydelitDAO.php');
$delitByInfractionDAO = new delitByInfractionDAO();


if ($supprDel){
$delitDAO->deleteDelitDuneInfraction($id,$idd);
$montant = $infractionDAO->getTotalMontantInfractionByTd($id);
if($montant!=null){
header("location:infractionDelitAdmin.php?op=d&id=".$id);
} else if($montant===null){
$infractionDAO->delete($id);
    header("location:infractionAdmin.php");}
}