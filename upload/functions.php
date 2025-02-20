<?php

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