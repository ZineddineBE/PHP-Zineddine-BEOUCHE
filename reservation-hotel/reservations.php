<?php

require_once("functions.php");

// Création du tableau d'événements
// options : 1 = Petit-déjeuner / 2 = Spa / 3 = Vue sur mer

$reservations = [
    ["number" => "#" . rand(1000, 10000), "start" => "2024-12-25", "end" => "2025-01-06", "nombresPersonnes" => 2, "options" => [1, 3]],
    ["number" => "#" . rand(1000, 10000), "start" => "2025-01-01", "end" => "2025-01-05", "nombresPersonnes" => 1, "options" => [1, 2]],
    ["number" => "#" . rand(1000, 10000), "start" => "2025-02-10", "end" => "2025-02-15", "nombresPersonnes" => 3, "options" => [2, 3]],
    ["number" => "#" . rand(1000, 10000), "start" => "2025-03-05", "end" => "2025-03-12", "nombresPersonnes" => 4, "options" => [1, 2, 3]],
    ["number" => "#" . rand(1000, 10000), "start" => "2025-04-20", "end" => "2025-05-15", "nombresPersonnes" => 2, "options" => [3]]
];

$prixNuit = 72;

foreach($reservations as $reservation){
    $reduction = reductionReservation($reservation);
    $surcharge = surchargeReservation($reservation);
    $nombreJours = ((strtotime($reservation["end"]) - strtotime($reservation["start"])) / 3600) /24;
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $options = calculOptionsReservation($reservation, $nombreJours);
    $montantTotal = (($prixNuit*$nombreJours + $options["montant"])*$surcharge)*$reduction;?>

    <h2><?php echo "Numéro de réservation : " . $reservation["number"] ?></h2>

    <p><?php echo "Date début : " . ucfirst($formatter->format(new DateTime($reservation["start"]))) ?></p>
    <p><?php echo "Date fin : " . ucfirst($formatter->format(new DateTime($reservation["end"]))) ?></p>
    <p><?php echo "Nombre jours : " . $nombreJours ?></p>
    <p><?php echo "Réduction : " . (1-$reduction)*100 . "%" ?></p>
    <p><?php echo "Surcharge : " . ($surcharge-1)*100 . "%" ?></p>
    
        
    <h3>Options :</h3>

    <ul>
        <?php foreach($options["options"] as $optionReservation){?>

            <li><?php echo $optionReservation?></li>
        <?php } ?>
    </ul>
        
    <p><?php echo "Montant options : " . $options["montant"] . "€"?></p>
    <br>
    <p><strong><?php echo "Montant totale : " . number_format((float)$montantTotal, 2, '.', '') . "€"?></strong></p>
    <hr>
<?php }

?>

