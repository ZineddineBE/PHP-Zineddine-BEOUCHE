<?php

require_once("functions.php");

$prixNuit = 72;
$numeroReservation = rand(1000, 10000);
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$jourArrive = $_POST["start"];
$jourDepart = $_POST["end"];
$nombreNuits = ((strtotime($jourDepart) - strtotime($jourArrive)) / 3600) / 24;
$nombrePersonnes = $_POST["nombresPersonnes"];

$reduction = reductionReservation($jourArrive, $jourDepart, $nombreNuits);
$surcharge = surchargeReservation($jourArrive, $jourDepart, $nombreNuits);

if (isset($_POST["options"]) && !empty($_POST["options"])){
    $options = $_POST["options"];
}else{
    $options = [];
}

$calculOptions = calculOptionsReservation($options, $nombreNuits, $nombrePersonnes);
$montantTotal = (($prixNuit*$nombreNuits + $calculOptions["montant"])*$surcharge)*$reduction;

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
    <p><?php echo "Date début : " . ucfirst($formatter->format(new DateTime($jourArrive))) ?></p>
    <p><?php echo "Date fin : " . ucfirst($formatter->format(new DateTime($jourDepart))) ?></p>
    <p><?php echo "Nombre jours : " . $nombreNuits ?></p>
    <p><?php echo "Réduction : " . (1-$reduction)*100 . "%" ?></p>
    <p><?php echo "Surcharge : " . ($surcharge-1)*100 . "%" ?></p>
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
    <p><strong><?php echo "Montant totale : " . number_format((float)$montantTotal, 2, '.', '') . "€"?></strong></p>
    <hr>
        
</body>
</html>
