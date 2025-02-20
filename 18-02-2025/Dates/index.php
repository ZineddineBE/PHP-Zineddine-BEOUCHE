<?php

// Afficher pour chaque événement :
//      Son nom
//      Sa date au format d/m/Y
//      Le jour de la semaine en français
//      Indiquer si l'événement est passé, aujourd’hui ou à venir
//      Ajouter une fonctionnalité pour calculer combien de jours restent avant chaque événement.

require_once("events.php");

usort($evenements, function($a, $b){
    return strtotime($a['date']) - strtotime($b['date']);
});

// sort($evenements);

function displayEventsDetails($evenements){
    foreach($evenements as $evenement){
        $date = new DateTime($evenement["date"]);

        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, null, null, 'EEEE');
        $formattedDate = $formatter->format($date);

        $dateToday = new DateTime();

        $passed = "";
        if (strtotime($evenement["date"]) === strtotime($dateToday->format("Y-m-d"))){
            $passed = "Aujourd'hui";
            $reste = "";
        }elseif ($date<$dateToday){
            $passed = "Oui";
            $reste = "";
        }else{
            $passed = "Non";
            $diff = $date->diff($dateToday);
            $reste = "Il reste " . $diff->days . " jours avant cette évenement <br>";
        }
        
        echo "Nom : " . $evenement["nom"] . "<br>
              Date : " . $date->format('d-m-Y') . "<br>
              Jour : " .  ucfirst($formattedDate) . "<br>
              Passé : " . $passed . "<br>" .
              $reste . "
              ---------------------------------------------------------------<br><br>";
    }
}

displayEventsDetails($evenements);
