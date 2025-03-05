<?php

include("header.php");
?>

<body>

    <main>

        <h1>Formulaire de Réservation - Zéphyr Hôtel & Spa</h1>    

        <form action="reservations.php" method="post">

            <label for="start">Date de début :</label>
            <input type="date" id="start" name="start" min="<?php echo (new DateTime())->format('Y-m-d'); ?>" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required>

            <label for="end">Date de fin :</label>
            <input type="date" id="end" name="end" min="<?php echo (new DateTime())->modify('+1 days')->format('Y-m-d'); ?>" value="<?php echo (new DateTime())->modify('+1 days')->format('Y-m-d'); ?>"required>

            <label for="nombrePersonnes">Nombre de personnes :</label>
            <input type="number" id="nombrePersonnes" name="nombrePersonnes" min="1" max="10" value="1" required>

            <label for="nombreChambres">Nombre de chambre :</label>
            <input type="number" id="nombreChambres" name="nombreChambres" min="1" max="10" value="1" required>

            <label for="room-select">Chambre :</label>

            <select name="rooms" id="room-select">
              <option value="">--Choisissez une chambre--</option>
              <option value="Chambre individuelle">Chambre individuelle</option>
              <option value="Chambre double">Chambre double</option>
              <option value="Chambre triple">Chambre triple</option>
              <option value="Chambre familiale">Chambre familiale</option>
              <option value="Suite">Suite</option>
            </select>

            <fieldset>
                <legend>Options :</legend>
                <label><input type="checkbox" name="options[]" value="Petit-Déjeuner">Petit-Déjeuner</label>
                <label><input type="checkbox" name="options[]" value="Spa">Spa</label>
                <label><input type="checkbox" name="options[]" value="Vue sur mer">Vue sur mer</label>
            </fieldset>

            <button type="submit">Réserver</button>            

        </form>

    </main>    
    
    <?php
    include("footer.php");

    ?>

</body>

