<html>
<head>
<meta charset="utf-8">
<title>Liste des infractions</title>
<link rel="stylesheet" href="../vue//styles/style3.css">
</head>
<body>
<?php require_once('../vue/header.php'); ?>

<section>
    <label></label>
    <h1>Liste des infractions</h1>
</section>

<section>
    <label></label> 
    <table border="1" class='table_salle'>
    <tr>
    <th>Numéro infraction</th>
    <th>No Immatriculation</th>
    <th>Date Infraction</th>
    <th>No Permis</th>
        <th>Action</th>
        <th>Action</th>
        <th>Action</th>
    </tr>

    <?php
    foreach($lignes as $ligne) {
        echo $ligne; // tableau de lignes à créer dans /controleur/salles.php
    }
    ?>

    <tr><td colspan="7"><?php $montant ?></td></tr>
    <tr>
     <td colspan="" style="text-align:left" ><a onclick="<?php session_unset(); session_destroy();?>" href="../controleur/login.php" class="deconnect">Deconnexion</a></td>
    <td colspan="7" style="text-align:right" ><a href="../controleur/editInfraction.php?op=a" class="ajout">Ajout infraction</a></td>
    </tr>


    </table>
</section>

<script>
       
        function confirmerAvantEffacer() {
            res = confirm('Voulez-Vous Vraiment Supprimer  Cette Infraction ?')
            if (res === false) {
                document.getElementById('supp').href = ""
                header("Refresh:0");
            } else header("Refresh:0");
        }
       
    </script>
</body>
</html>