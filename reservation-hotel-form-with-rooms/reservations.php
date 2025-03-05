<?php

require_once("functions.php");

$chambres = [
    ["type" => "Chambre individuelle", "prix" => 35, "nombreChambre" => "5"],
    ["type" => "Chambre double", "prix" => 45, "nombreChambre" => "4"],
    ["type" => "Chambre triple", "prix" => 55, "nombreChambre" => "3"],
    ["type" => "Chambre familiale", "prix" => 75, "nombreChambre" => "2"],
    ["type" => "Suite", "prix" => 100, "nombreChambre" => "1",]
];

$taxe = 1.05;
$fraisService = 20;
$numeroReservation = rand(1000, 10000);
$nombreReservation = rand(1, 15);
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$jourArrive = $_POST["start"];
$jourDepart = $_POST["end"];
$nombreNuits = ((strtotime($jourDepart) - strtotime($jourArrive)) / 3600) / 24;
$nombrePersonnes = $_POST["nombrePersonnes"];
$typeChambre = $_POST["rooms"];
$nombreChambres = $_POST["nombreChambres"];

$reductionClientFidele = reductionClientFidele($nombreReservation);
$majorationHauteSaisonReservation = majorationHauteSaisonReservation($jourArrive, $jourDepart);
$reductionBasseSaisonReservation = reductionBasseSaisonReservation($jourArrive, $jourDepart);

$reduction = reductionReservation($jourArrive, $jourDepart, $nombreNuits);
$surcharge = surchargeReservation($jourArrive, $jourDepart, $nombreNuits);

$errorMessage = "";
$prixNuit = prixNuit($chambres, $typeChambre, $nombreChambres);

if (!empty($errorMessage)){
    echo $errorMessage;
    die;
}

if (isset($_POST["options"]) && !empty($_POST["options"])){
    $options = $_POST["options"];
}else{
    $options = [];
}

$calculOptions = calculOptionsReservation($options, $nombreNuits, $nombrePersonnes);
$montantTotal = ((($prixNuit * $nombreNuits + $calculOptions["montant"])
                    * $majorationHauteSaisonReservation
                    * $surcharge)
                    * $reduction
                    * $reductionClientFidele
                    * $reductionBasseSaisonReservation)
                    * 1.05 + $fraisService;

if ($jourDepart<$jourArrive){
    echo "La date d'arrivée doit être antérieure à la date de départ !";
    die;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reservation-style.css">
    <title>Réservation #<?php echo $numeroReservation?></title>
</head>

<body>

    <h2><?php echo "Numéro de réservation : #" . $numeroReservation ?></h2>
    <p><?php echo "Nombre de réservation : " . $nombreReservation ?></p>
    <br>
    <p><?php echo "Date début : " . ucfirst($formatter->format(new DateTime($jourArrive))) ?></p>
    <p><?php echo "Date fin : " . ucfirst($formatter->format(new DateTime($jourDepart))) ?></p>
    <br>
    <p><?php echo "Nombre jours : " . $nombreNuits ?></p>
    <p><?php echo "Nombre personnes : " . $nombrePersonnes ?></p>
    <p><?php echo "Nombre chambres : " . $nombreChambres ?></p>
    <br>
    <p><?php echo "Réduction : " . (1-$reduction)*100 . "%" ?></p>
    <p><?php echo "Surcharge : " . ($surcharge-1)*100 . "%" ?></p>
    <p><?php echo "Réduction fidélité : " . (1-$reductionClientFidele)*100 . "%" ?></p>
    <p><?php echo "Majoration Haute saison : " . ($majorationHauteSaisonReservation-1)*100 . "%" ?></p>
    <p><?php echo "Réduction basse saison : " . (1-$reductionBasseSaisonReservation)*100 . "%" ?></p>
    <br>
    <p><?php echo "Taxe : " . ($taxe-1)*100 . "%" ?></p>
    <p><?php echo "Frais de service : " . $fraisService . "€" ?></p>

    <br>
    <h3>Type de chambre :</h3>
    <p><?php echo $typeChambre ?></p>
    <br>
    <?php if(!empty($options)){?>
    <h3>Options :</h3>
    <ul>
        <?php 
        
        foreach($options as $optionReservation){?>
            <li><?php echo $optionReservation?></li>
        <?php }
        ?>
        
    </ul>
        
    <p><?php echo "Montant options : " . $calculOptions["montant"] . "€"?></p>
    <?php } ?>
    <br>
    <br>
    <p><strong><?php echo "Montant totale : " . number_format((float)$montantTotal, 2, '.', '') . "€"?></strong></p>
    <hr>
        
</body>
</html>
