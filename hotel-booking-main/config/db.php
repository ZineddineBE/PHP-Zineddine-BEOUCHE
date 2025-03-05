<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=hotel', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
