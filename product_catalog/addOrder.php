<?php

include("header.php");
require 'config/db.php';

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID du produit manquant.");
}

$id_produit = htmlspecialchars($_GET["id"]);

$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

$query = $db->prepare('SELECT * FROM produit WHERE id_produit = :id');
$query->bindParam(':id', $id_produit);
$query->execute();
$produit = $query->fetch();

$insert_commande = $db->prepare('INSERT INTO commande (prix_total, date) VALUES (:prix_total, :date)');
$insert_commande->bindParam(':prix_total', $produit['prix']);
$insert_commande->bindParam(':date', $date);
$insert_commande->execute();

$id_commande = $db->lastInsertId();

$insert_produit_commande = $db->prepare('INSERT INTO produit_commande (id_produit, id_commande) VALUES (:id_produit, :id_commande)');
$insert_produit_commande->bindParam(':id_produit', $id_produit);
$insert_produit_commande->bindParam(':id_commande', $id_commande);
$insert_produit_commande->execute();

$query = $db->prepare('SELECT * FROM commande WHERE id_commande = :id');
$query->bindParam(':id', $id_commande);
$query->execute();
$commande = $query->fetchAll();

if (!$produit) {
    die("Produit introuvable.");
}

?>

<body>

        <div class="mt-3 px-3">
            <a href="index.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left pe-2"></i>Retour à l'accueil</a>
        </div>

        <div class="container mt-5">
            <h1 class="text-center mb-4">Commande n° <?= htmlspecialchars($id_commande); ?></h1>

            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Id commande</th>
                        <th>Image produit</th>
                        <th>Nom produit</th>
                        <th>Prix (€)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($commande) { ?>
                    <?php foreach ($commande as $article) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($article['id_commande']); ?></td>
                            <td><img src="<?php echo $produit['image']?>" alt="Image de <?php echo htmlspecialchars($produit['nom']); ?>" width="80"></td>
                            <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                            <td><?php echo htmlspecialchars($article['prix_total']); ?></td>
                            <td><?php echo $date; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr><td colspan="6" class="text-center text-danger">Aucun produit trouvé.</td></tr>
                <?php } ?>
                </tbody>
            </table>



