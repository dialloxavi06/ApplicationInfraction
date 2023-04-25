<html>
<head>
<meta charset="utf-8">
<title>Liste des infractions</title>
<link rel="stylesheet" href="../vue/styles/style3.css">
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
    <th>N°</th>
    <th>Véhicule</th>
    <th>Date</th>
    <th>Conducteur</th>
        <th>Montant</th>
        <th>Action</th>

    </tr>

    <?php
    foreach($lignes as $ligne) {
        echo $ligne; // tableau de lignes à créer dans /controleur/salles.php
    }
    ?>

    <tr><td colspan="7"></td></tr>
    <tr><td colspan="7" style="text-align:left" ><a href="../controleur/login.php" class="ajout">log out</a></td></tr>

    </table>
</section>

</body>
</html>