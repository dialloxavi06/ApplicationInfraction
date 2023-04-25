<?php
require_once('../modele/infractionDAO.php');

$infractionDAO = new InfractionDAO();

$lesInfractions = $infractionDAO->getAll();

$lignes	= [];
foreach($lesInfractions as $uneInfraction)
{
	$ch = '';

	$ch .='<td>' .$uneInfraction->getId() . '</td>';
	$ch .='<td>' .$uneInfraction->getImmatricul() . '</td>';
	$ch .='<td>' .$uneInfraction->getDateinfract() . '</td>';
	$ch .='<td>' .$uneInfraction->getNopermis() . '</td>';
	$ch .='<td><a href="../controleur/editInfraction.php?op=m&num=' .urlencode($uneInfraction->getId()) .'"><img src="../vue/style/modification.png"></a></td>';
////////////////////////////////13/4
$ch .='<td  onclick="confirmerAvantEffacer()"><a id="supp" href="../controleur/editInfraction.php?op=s&num=' 
.urlencode($uneInfraction->getId())
.'" ><img src="../vue/style/corbeille.png"></a></td>';
////////////////////////////////13/4	
$ch .='<td><a href="infractionDelitAdmin.php?op=d&id='.urlencode($uneInfraction->getId()) .'"><img src="../vue/style/visu.png"></a></td>';

	$lignes[] = "<tr>$ch</tr>";
}

unset($lesInfractions);

require_once('../vue/infractions.view.php');
