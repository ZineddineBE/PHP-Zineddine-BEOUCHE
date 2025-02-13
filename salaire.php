<?php

// Une entreprise souhaite automatiser le calcul du salaire de ses employés en fonction de plusieurs critères :
// Poste de l’employé (géré avec un switch) :
// "Développeur" → Salaire de base : 3000€
// "Designer" → Salaire de base : 2800€
// "Manager" → Salaire de base : 4000€
// "Stagiaire" → Salaire de base : 1200€
// Ancienneté (gérée avec un if/else) :
// Si l’employé a plus de 5 ans d’ancienneté → +10% de prime
// Si l’employé a plus de 10 ans d’ancienneté → +20% de prime
// Heures supplémentaires :
// Chaque heure supplémentaire est payée 25€.
// Retard / Absence non justifiée :
// Pour chaque jour d’absence injustifiée, -50€ sont déduits.

// Variables
$poste = "Manager";
$anciennete = 12;
$heure_supplementaire = 14;
$jours_absences_injustifiees = 1;

// Détermination de la paye supplémentaire en fonction des heures supplémentaires
$paye_supplementaire = $heure_supplementaire * 25;
    
// Détermination de la paye retirée en fonction des absences injustifiées
$paye_retiree = $jours_absences_injustifiees * 50;

// Détermination du salaire en fonction du poste de l'employé
switch($poste){
    case "Stagiaire":
        $salaire = 1200;
        break;
    case "Designer":
        $salaire = 2800;
        break;
    case "Développeur":
        $salaire = 3000;
        break;
    case "Manager":
        $salaire = 4000;
        break;
    default:
        echo "Poste inconnu";
        exit;
}

// Détermination de la prime de l'employé
if ($anciennete >=10) {
    $prime = 1.20;
} elseif ($anciennete >=5){
    $prime = 1.10;
} else {
    $prime = 1;
}

// Détermination de la prime de l'employé
$salaire_total = ($salaire*$prime) + $paye_supplementaire - $paye_retiree;

echo "Poste de l'employé : $poste <br>";
echo "Salaire de base : " . number_format($salaire, 2) . "€ <br>";
echo "Prime d'ancienneté de l'employé : ". ($prime-1)*100 ."%<br>";
echo "Salaire avec prime : " . number_format($salaire*$prime, 2) . "€ <br><br>";

echo "Montant de la paye supplémentaire liée aux heures supplémentaires : $paye_supplementaire <br>";
echo "Montant de la paye retirée liée aux absences injustifiées : $paye_retiree <br><br>";

echo "Salaire total : " . number_format($salaire_total, 2) . "€ <br>";