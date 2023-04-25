<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="../vue/styles/style2.css">
</head>

<body>
    <?php require_once '../vue/header.php'; ?>

    <section>
        <h1><?= $titre ?></h1>
    </section>

    <form name="add" action="" method="post">
        <section>
            <label for="num">Numéro</label>
            <div>
                <?php if ($editNum) : ?>
                    <input id="num" name="num" type="text" size="5" maxlength="5" value="<?= htmlentities($valeurs['num'] ?? '') ?>" />
                    <br />
                    <span class="erreur"><?= $erreurs['num'] ?? '' ?></span>
                <?php else : ?>
                    <?= $valeurs['num'] ?? '' ?>
                <?php endif; ?>
            </div>
        </section>

        <section>
            <label for="date">Date</label>
            <div>
                <input id="date" name="date" type="text" size="30" maxlength="30" placeholder="AAAA-MM-JJ" value="<?= htmlentities($valeurs['date'] ?? '') ?>" />
                <br />
                <span class="erreur"><?= $erreurs['date'] ?? '' ?></span>
            </div>
        </section>

        <section>
            <label for="matricule">Immatriculation</label>
            <div>
                <input id="matricule" name="matricule" type="text" size="30" maxlength="30" value="<?= htmlentities($valeurs['matricule'] ?? '') ?>">
                <br />
                <span class="erreur"><?= $erreurs['matricule'] ?? '' ?></span>
            </div>
        </section>

        <section>
            <label for="permis">Numéro de permis</label>
            <div>
                <input id="permis" name="permis" type="text" size="30" maxlength="30" value="<?= htmlentities($valeurs['permis'] ?? '') ?>">
                <br />
                <span class="erreur"><?= $erreurs['permis'] ?? '' ?></span>
            </div>
        </section>
       
        <section>
            
          
        <?php if ($editNum) : ?>
            <h2>Choix des Delits</h2>
            <div>
            <pre>
        <label for="1">Excès de vitesse</label>
        <input id="1" type="checkbox" name="1" value=1><pre>
        <label for="2">Outrage à agent</label>
        <input id="2" type="checkbox" name="2" value=2><pre>
        <label for="3">Feu rouge grillé</label>
        <input id="3" type="checkbox" name="3" value=3><pre>
        <label for="4">Conduite en état d'ivresse</label>
        <input id="4" type="checkbox" name="4" value=4><pre>
        <label for="5">Delit de fuite</label>
        <input id="5" type="checkbox" name="5" value=5><pre>
        <label for="6">refus de priorité</label>
        <input id="6" type="checkbox" name="6" value=6><pre>
            </div>
            <?php else : ?>
                   
            <?php endif; ?>
            <span class="erreur"><?= $erreurs['permis'] ?></span>

        </section>


        <section>
            <label>&nbsp;</label>
            <div>
                <input type="submit" id="valider" name="valider" value="Valider" />
                &emsp;
                <input type="submit" id="annuler" name="annuler" value="Annuler" />
            </div>
        </section>

    </form>
  

</body>

</html>