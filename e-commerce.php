<!-- Un site e-commerce souhaite mettre en place un programme de fidélité pour ses clients.
Le montant de réduction appliqué dépend de plusieurs conditions :
Statut du client :
"Nouveau client" → Pas de réduction
"Régulier" (au moins 5 commandes passées) → 5% de réduction
"VIP" (au moins 10 commandes passées et plus de 1000€ dépensés au total) → 10% de réduction
Montant de la commande :
Si la commande dépasse 200€, une réduction supplémentaire de 5% est appliquée.
Jour de la semaine :
Si c’est mercredi, tous les clients VIP ont 5% de réduction supplémentaire. -->

<?php

    $nb_commande = 15;
    $montant_commande = 2500;
    $total_depense = 1250;
    $jour = "Mercredi";

    if ($montant_commande > 200){
        $reduction_montant = 0.05;
    }

    switch($nb_commande){
        case $nb_commande >= 10 && $total_depense >= 1000:
            $statut = "VIP";
            if ($jour == "Mercredi"){
                $reduction_jour = 0.05;
            }
            $reduction = 0.90 - $reduction_montant - $reduction_jour;
            $total = $montant_commande * $reduction;
            break;
        case $nb_commande >= 5:
            $statut = "Régulier";
            $reduction = 0.95 - $reduction_montant;
            $total = $montant_commande * $reduction;
            break;
        default:
            $statut = "Nouveau client";
            $reduction = 0;
            $total = $montant_commande;
            break;
    }

    echo "Statut : ".$statut."<br>";
    echo "Réduction montant : ".$reduction_montant."<br>";

    if ($statut == "VIP"){
        echo "Réduction jour (reservée au VIP): ".$reduction_jour."<br>";
    }
    echo "Réduction total : ".$reduction."<br>";

    echo "<br>";

    echo "Montant total de la commande : ".number_format($total, 2). "€";


// --------------------------------------- CORRECTION ----------------------------------------------
    

//     // Variables
//     $nbCommandes = 12;
//     $totalDepense = 1500;
//     $montantCommande = 250;
//     $jour = "mercredi";
    
//     // Détermination du statut du client
//     if ($nbCommandes >= 10 && $totalDepense > 1000) {
//     $statut = "VIP";
//     $reduction = 10;
//     } elseif ($nbCommandes >= 5) {
//     $statut = "Régulier";
//     $reduction = 5;
//     } else {
//     $statut = "Nouveau client";
//     $reduction = 0;
//     }
    
//     // Réduction supplémentaire si la commande dépasse 200€
//     if ($montantCommande > 200) {
//     $reduction += 5;
//     }
    
//     // Réduction spéciale le mercredi pour les VIP
//     if ($statut === "VIP" && $jour === "mercredi") {
//     $reduction += 5;
//     }
    
//     // Calcul du montant final
//     $montantFinal = $montantCommande - ($montantCommande * $reduction / 100);
    
//     // Affichage du résultat
//     echo "Statut du client : $statut <br>";
//     echo "Réduction appliquée : $reduction <br>";
//     echo "Montant final à payer : " . number_format($montantFinal, 2) . "€ <br>";