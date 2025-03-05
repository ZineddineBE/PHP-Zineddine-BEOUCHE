<?php

function prixNuit($chambres, $typeChambre, $nombreChambres){
    foreach ($chambres as $chambre) {
        if ($chambre["type"] === $typeChambre) {
            $prixNuit = $chambre["prix"];
            if ($nombreChambres > $chambre["nombreChambre"]) {
                $errorMessage = "Il n'y a pas assez de " . $typeChambre . " disponibles. Seulement " . $chambre["nombreChambre"] . " restante(s).";
            }
            break;
        }
    }
    return $prixNuit;
}

function reductionClientFidele($nombreReservation){
    $reductionNombreReservations = 1;
    if($nombreReservation > 5){
        $reductionNombreReservations = 0.9;
    }

    return $reductionNombreReservations;

}

function majorationHauteSaisonReservation($jourArrive, $jourDepart){
    $majorationHauteSaison = 1;

    $moisArrive = date("m",strtotime($jourArrive,));
    $moisDepart = date("m",strtotime($jourDepart,));

    if(($moisArrive >= "06" && $moisArrive <= "08" || $moisArrive == "12") || ($moisDepart >= "06" && $moisDepart <= "08" || $moisDepart == "12")){
        $majorationHauteSaison = 1.25;
    }

    return $majorationHauteSaison;

}

function reductionBasseSaisonReservation($jourArrive, $jourDepart){
    $reductionBasseSaison = 1;

    $moisArrive = date("m",strtotime($jourArrive,));
    $moisDepart = date("m",strtotime($jourDepart,));

    if(($moisArrive >= "01" && $moisArrive <= "02" || $moisArrive == "11") || ($moisDepart >= "01" && $moisDepart <= "02" || $moisDepart == "11")){
        $reductionBasseSaison = 0.85;
    }

    return $reductionBasseSaison;

}

function reductionReservation($jourArrive, $jourDepart, $nombreNuits){
    $reduction = 1;

    if($nombreNuits >= 7){
        $reduction = 0.90;
    }

    return $reduction;

}

function surchargeReservation($jourArrive, $jourDepart, $nombreNuits){
    $dateDebut = new DateTime($jourArrive);
    $dayOfWeekDateDebut = $dateDebut->format("N");
    $surcharge = 1;
    if($nombreNuits >= 6){
        $surcharge = 1.20;
    }elseif($dayOfWeekDateDebut + $nombreNuits >= 6){
        $surcharge = 1.20;
    }

    return $surcharge;
}

function calculOptionsReservation($options, $nombreNuits, $nombresPersonnes){
    $montantOptions = 0;
    foreach($options as $option){
        switch ($option){
            case "Petit-Déjeuner":
                $montantOptions += (10*$nombreNuits)*$nombresPersonnes;
                break;
            case "Spa":
                $montantOptions += 30;
                break;
            case "Vue sur mer":
                $montantOptions += (20*$nombreNuits);
                break;
        }
    }

    return [
        "options" => $options,
        "montant" => number_format((float)$montantOptions, 2, '.', '')
    ];
    
}

?>