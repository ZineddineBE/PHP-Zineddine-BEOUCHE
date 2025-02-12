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

    $reduction = 0;
    $reduction_jour = 0;
    $reduction_montant = 0;
    $total = 0;
    $statut = "";
    $nb_commande = 15;
    $montant = 2500;
    $jour = "mercredi";

    switch($nb_commande){
        case $nb_commande >= 10 && $montant >= 1000:
            $statut = "VIP";
            break;
        case $nb_commande >= 5:
            $statut = "Régulier";
            break;
        default:
            $statut = "Nouveau client";
            break;
    }

    if ($montant > 200){
        $reduction_montant = 0.05;
    }

    
    
    switch($statut){
        case "Nouveau client":
            $reduction = 0;
            $total = $montant;
            break;
        case "Régulier":
            $reduction = 0.95 - $reduction_montant - $reduction_jour;
            $total = $montant * $reduction;
            break;
        case "VIP":
            if (strtolower($jour) == "mercredi"){
                $reduction_jour = 0.05;
            }
            $reduction = 0.90 - $reduction_montant - $reduction_jour;
            $total = $montant * $reduction;
            break;
    }

    echo "Statut : ".$statut."<br>";
    echo "Réduction montant : ".$reduction_montant."<br>";
    echo "Réduction jour : ".$reduction_jour."<br>";
    echo "Réduction total : ".$reduction."<br>";

    echo "<br>";

    echo "Montant total de la commande : ".$total. "€";


    
