<?php 
 session_start();
 require_once('../vue/header.php');
 if (isset($_SESSION['login'])) { 
    if ($_SESSION['login'] === 'root') {
      header('location: ../controleur/infractionAdmin.php');
    }else {
     header('location: ../controleur/infractionUtilisateur.php');
    }

   }
	else header('location: login.php');  

?>
