<?php

function reductionReservation($reservation){
    $reduction = 1;

    $nombreNuits = (strtotime($reservation["end"]) - strtotime($reservation["start"])) / 3600;
    if($nombreNuits >= 168){
        $reduction = 0.90;
    }

    return $reduction;

}

function surchargeReservation($reservation){
    $dateDebut = new DateTime($reservation["start"]);
    $dayOfWeekDateDebut = $dateDebut->format("N");
    $surcharge = 1;
    $nombreNuits = ((strtotime($reservation["end"]) - strtotime($reservation["start"])) / 3600) / 24;
    if($nombreNuits >= 6){
        $surcharge = 1.20;
    }elseif($dayOfWeekDateDebut + $nombreNuits >= 6){
        $surcharge = 1.20;
    }

    return $surcharge;

}

function calculOptionsReservation($reservation, $nombreJours){
    $options = [];
    $montantOptions = 0;
    foreach($reservation["options"] as $option){
        switch ($option){
            case 1:
                $options[] = "Petit-Déjeuner";
                $montantOptions += (10*$nombreJours)*$reservation["nombresPersonnes"];
                break;
            case 2:
                $options[] = "Spa";
                $montantOptions += 30;
                break;
            case 3:
                $options[] = "Vue sur mer";
                $montantOptions += (20*$nombreJours);
                break;
        }
    }

    return [
        "options" => $options,
        "montant" => number_format((float)$montantOptions, 2, '.', '')
    ];
    
}

?>