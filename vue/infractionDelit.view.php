<html>

<head>
    <meta charset="utf-8">
    <title>site infraction</title>
    <link rel="stylesheet" href="../vue/style/style3.css">
</head>

<body>
    <?php 
    require_once('../vue/header.php');
     ?>
    <section>
        <label></label>
        <h1> Détail de l'Infraction : <?= $titre ?></h1>
    </section>
    <section>
    <?php
    if(isset($infractionInfo[0]["véhicule"])) {
        echo "<pre>";
        print_r($infractionInfo[0]["véhicule"]);
        echo "</pre>";
    } else {
        echo "Aucune donnée de véhicule disponible.";
    }
    
    if(isset($infractionInfo[0]["propriétaire"])) {
        echo "<pre>";
        print_r($infractionInfo[0]["propriétaire"]);
        echo "</pre>";
    } else {
        echo "Aucune donnée de propriétaire disponible.";
    }
    
    if(isset($infractionInfo[0]["conducteur"])) {
        echo "<pre>";
        print_r($infractionInfo[0]["conducteur"]);
        echo "</pre>";
    } else {
        echo "Aucune donnée de conducteur disponible.";
    }
    ?>
</section>


    <section>
        <?php

        ?>
        <label></label>
        <table border="1" class="table_salle_equipt">
            <tr>
                <th>Numéro</th>
                <th>Nature</th>
                <th>Montant</th>
                <th>Action</th>

            </tr>

            <?php

            foreach ($lignes as $ligne) {
                echo $ligne; // tableau de lignes à créer dans /controleur/salles.php
            }
            ?>

            <tr>
                <td colspan="5"></td>
                
            </tr>
            <tr></tr>
            <tr>
                <td colspan="2" id="montantTotal"> Total  </td>
                <td id="montantTotal"> <?php if (isset($montant)){echo $montant."€" ;
                }else echo $montantInfraction."€" ?></td> 
                 <?php
                  if ($detaille && !empty($id) && isset($montant)) : ?>
                    <td style="text-align:right"><a href="../controleur/infractionUtilisateur.php" class='ajout'>Retour</a></td>
                <?php elseif ($detaille): ?>
                 <td style="text-align:right"><a href="../controleur/infractionAdmin.php" class='ajout'>Retour</a></td>
                 <?php endif; ?>
            </tr>
        </table>
    </section>

    <script>
        
        function confirmerAvantEffacer() {
            res = confirm('Voulez-Vous Vraiment Supprimer Ce Delit ?')
            if (res === false) {
                document.getElementById('supp').href = ""
                header("Refresh:0");
            } else header("Refresh:0");
        }
        
    </script>
</body>

</html>