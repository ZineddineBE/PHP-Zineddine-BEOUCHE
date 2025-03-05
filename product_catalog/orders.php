<?php
include("header.php");
require 'config/db.php';

$rows = $db->prepare('SELECT * FROM commande');
$rows->execute();
$commandes = $rows->fetchAll();



?>
    <body>

        <div class="mt-3 px-3">
            <a href="index.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left pe-2"></i>Retour à l'accueil</a>
        </div>

        <div class="container mt-5">
            <h1 class="text-center mb-4">Liste des commandes</h1>

            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Id commande</th>
                        <th>Image</th>
                        <th>Détails</th>
                        <th>Prix total (€)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($commandes) { ?>
                    <?php foreach ($commandes as $commande) { ?>
                        <?php 
                            $stmt = $db->prepare("SELECT * FROM produit 
                                                    INNER JOIN produit_commande 
                                                    ON produit.id_produit = produit_commande.id_produit 
                                                    WHERE produit_commande.id_commande = :id_commande"
                            );
                            $stmt->execute(['id_commande' => $commande["id_commande"]]);
                            $details = $stmt->fetchAll();
                        ?>

                        <tr>
                            <td><?php echo htmlspecialchars($commande['id_commande']); ?></td>
                            <?php foreach ($details as $detail) { ?>
                            <td><img src="<?php echo $detail['image']?>" alt="Image de <?php echo htmlspecialchars($detail['nom']); ?>" width="80"></td>d
                            <td><?php echo htmlspecialchars($detail['nom']) . " - " . htmlspecialchars($detail['prix']) . "€"; ?></td>
                            <td><?php echo htmlspecialchars($commande['prix_total']); ?>€</td>
                            <td><?php echo htmlspecialchars($commande['date']); ?></td>
                        </tr>
                    <?php }} ?>
                <?php } else { ?>
                    <tr><td colspan="6" class="text-center text-danger">Aucun produit trouvé.</td></tr>
                <?php } ?>
                </tbody>
            </table>
                
        </div>
                
        <?php include("footer.php"); ?>
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
