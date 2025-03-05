<?php

// Connexion à la base de données avec PDO
$db = new PDO('mysql:host=localhost;dbname=product_catalog', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active les erreurs PDO


?>
