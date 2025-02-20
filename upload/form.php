<?php

include("header.php");
?>

<body>
    
    <h1>Formulaire de Réservation - Zéphyr Hôtel & Spa</h1>    

    <form action="reservations.php" method="post">
        
        <label for="start">Date de début :</label>
        <input type="date" id="start" name="start" min="<?php echo (new DateTime())->format('Y-m-d'); ?>" required>

        <label for="end">Date de fin :</label>
        <input type="date" id="end" name="end" min="<?php echo (new DateTime())->modify('+1 days')->format('Y-m-d'); ?>" required>
        
        <label for="nombresPersonnes">Nombre de personnes :</label>
        <input type="number" id="nombresPersonnes" name="nombresPersonnes" min="1" max="10" value="1" required>

        <fieldset>
            <legend>Options :</legend>
            <label><input type="checkbox" name="options[]" value="Petit-Déjeuner"> Petit-Déjeuner</label>
            <label><input type="checkbox" name="options[]" value="Spa"> Spa</label>
            <label><input type="checkbox" name="options[]" value="Vue sur mer"> Vue sur mer</label>
        </fieldset>
        
        <button type="submit">Réserver</button>

    </form>

</body>

<?php
include("footer.php");

?>