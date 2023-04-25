<?php

require_once('../modele/infractionDAO.php');
require_once('../modele/delitDAO.php');
session_start();
$infractionDAO = new InfractionDAO();
$delitDAO = new DelitDAO();
$lesInfractions = $infractionDAO->getNomPermis($_SESSION['login']);
$lignes	= [];
foreach($lesInfractions as $uneInfraction)
{
	$montantInf = 0;
	$dataInf = $delitDAO->getByNumInf($uneInfraction->getId());
	foreach($dataInf as $delit) {
		$montantInf += $delit->getMontant();
	}
	$ch = '';

	$ch .='<td>' .$uneInfraction->getId() . '</td>';
	$ch .='<td>' .$uneInfraction->getImmatricul() . '</td>';
	$ch .='<td>' .$uneInfraction->getDateinfract() . '</td>';
	$ch .='<td>' .$uneInfraction->getNopermis() . '</td>';
	$ch .='<td>' .$montantInf ."€".  '</td>';
	$ch .='<td><a href="infractionDelit.php?op=d&id='
	.urlencode($uneInfraction->getId()) .'&montant='.$montantInf.
	'"><img src="../vue/style/visu.png"></a></td>'; ///*

	$lignes[] = "<tr>$ch</tr>";
}

unset($lesInfractions);

require_once('../vue/infract.user.view.php');

