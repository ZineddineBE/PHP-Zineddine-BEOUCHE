<!-- Exercice : Gestion des Commandes d’un Magasin en Ligne
Contexte

Vous devez développer un programme en PHP pour gérer les commandes d’un magasin en ligne. Chaque commande contient plusieurs articles avec leur prix et leur quantité.
Calculer le total de chaque commande.
Appliquer des réductions selon certaines conditions.
Déterminer si la commande est éligible à la livraison gratuite.
Classer les commandes en fonction de leur montant total (petite, moyenne, grande commande).
Règles de réduction et de livraison
Réduction de 10% si le total dépasse 200€.
Réduction de 20% si le total dépasse 500€.
Livraison gratuite si le total (après réduction) dépasse 100€.
Classification des commandes :
Petite commande : Moins de 100€.
Commande moyenne : Entre 100€ et 500€.
Grande commande : Plus de 500€. -->

<?php

$commandes = [
    [
        "id" => 1,
        "articles" => [
            ["nom" => "Smartphone", "prix" => 300, "quantite" => 1],
            ["nom" => "Coque de protection", "prix" => 20, "quantite" => 2]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    [
        "id" => 2,
        "articles" => [
            ["nom" => "Ordinateur portable", "prix" => 800, "quantite" => 1],
            ["nom" => "Souris sans fil", "prix" => 50, "quantite" => 1]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    [
        "id" => 3,
        "articles" => [
            ["nom" => "Casque audio", "prix" => 150, "quantite" => 1],
            ["nom" => "Chargeur USB", "prix" => 25, "quantite" => 2]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    [
        "id" => 4,
        "articles" => [
            ["nom" => "Tablette", "prix" => 250, "quantite" => 1],
            ["nom" => "Clavier Bluetooth", "prix" => 80, "quantite" => 1]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    [
        "id" => 5,
        "articles" => [
            ["nom" => "Montre connectée", "prix" => 180, "quantite" => 1],
            ["nom" => "Batterie externe", "prix" => 50, "quantite" => 1]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    // Nouvelle commande avec un total inférieur à 100€
    [
        "id" => 6,
        "articles" => [
            ["nom" => "Stylo", "prix" => 1.50, "quantite" => 10],
            ["nom" => "Bloc-notes", "prix" => 4.00, "quantite" => 5]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    [
        "id" => 7,
        "articles" => [
            ["nom" => "Clé USB", "prix" => 8, "quantite" => 2],
            ["nom" => "Chargeur secteur", "prix" => 12, "quantite" => 3]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ],
    [
        "id" => 8,
        "articles" => [
            ["nom" => "Porte-clés", "prix" => 2.5, "quantite" => 8],
            ["nom" => "Câble micro-USB", "prix" => 4, "quantite" => 5]
        ],
        "montant_total" => NULL,
        "livraison" => NULL,
        "taille" => NULL
    ]
];

function reductionCommande($commande){
    $reduction = 1;
    $prix_apres_reduction = $commande["montant_total"];
    if($commande["montant_total"] > 500){
        $reduction = 0.80;
    }elseif($commande["montant_total"] > 200){
        $reduction = 0.90;
    }
    return $reduction;
}

function eligibleLivraison($commande){
    $livraison = False;
    if($commande["montant_total"] > 100){
        $livraison = True;
    }else{
        $livraison = false;
    }
    return $livraison;
}

function classerCommande($commande){
    $taille = NULL;
    if($commande["montant_total"] > 500){
        $taille = "Grande commande";
    }elseif($commande["montant_total"] > 100){
        $taille = "Moyenne commande";
    }else{
        $taille = "Petite commande";
    }
    return $taille;
}


function afficherCommande($commandes) {
    foreach ($commandes as &$commande) {
        $total_commande = 0;

        echo "<h3>Commande n°" . $commande["id"] . "</h3>";

        echo "<ul>";
        foreach ($commande["articles"] as $article) {
            $sous_total = $article["prix"] * $article["quantite"];
            $total_commande += $sous_total;
            $commande["montant_total"] = $total_commande;

            echo "<li>" . $article["nom"] . 
                 " - Prix : " . number_format($article["prix"], 2, ',', ' ') . "€" . 
                 " - Quantité : " . $article["quantite"] . 
                 " - Sous-total : " . number_format($sous_total, 2, ',', ' ') . "€</li>";
        }
        echo "</ul>";

        // Mise à jour du montant total dans le tableau après réduction
        $reduction = reductionCommande($commande);

        $taille = classerCommande($commande);
        if (!empty($taille)) {
            echo "Taille : " . $taille . "<br>";
        } else {
            echo "Taille : Non spécifiée<br>";
        }

        // Affichage du montant total
        echo "Sous-total de la commande : " . number_format($commande["montant_total"], 2, ',', ' ') . "€<br>";
        echo "Réduction appliquée : ". (1-$reduction)*100 . "%<br>";
        echo "Sous-total de la commande après réduction : " . number_format($commande["montant_total"]*$reduction, 2, ',', ' ') . "€<br>";

        // Vérification et affichage de la livraison et de la taille si renseignées
        $livraison = eligibleLivraison($commande);
        if ($livraison) {
            echo "Livraison gratuite : ✅ <br>";
            echo "<strong>Total de la commande après réduction : " . number_format($commande["montant_total"]*$reduction+4.99 , 2, ',', ' ') . "€</strong><br>";
        } else {
            echo "Livraison : 4,99€<br>";
            echo "<strong>Total de la commande après réduction (fdp inclus) : " . number_format($commande["montant_total"]*$reduction+4.99 , 2, ',', ' ') . "€</strong><br>";
        }
        

        echo "<hr>"; // Séparation entre commandes
    }
}

afficherCommande($commandes);












