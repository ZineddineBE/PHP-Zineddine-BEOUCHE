<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>

<?php

    include 'product.php';

    $p1 = new Product("Xiaomi 15", "Nouveau téléphone, présenté le 02 mars 2025", 999.99, 2500000);

    $p1->displayProduct();
    $p1->setName("Xiaomi 16");

    echo $p1->getName();

    $p1->addStock(5);

    echo $p1->getStock();

    $p1->removeStock(500);

    echo $p1->getStock();


    // $p1->setStock(2499999);
    // echo "Nouveau stock : " . $p1->getStock() . "<br>";

    // $p1->addStock(25);
    // echo "Nouveau stock : " . $p1->getStock() . "<br>";

    // $p1->removeStock(2500000);
    // echo "Nouveau stock : " . $p1->getStock() . "<br>";

    // $p1->removeStock(2500000);
    // echo "Nouveau stock : " . $p1->getStock() . "<br>";

?>
    
</body>
</html>

