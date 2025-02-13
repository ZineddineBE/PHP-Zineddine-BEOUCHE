<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Les Meilleures Voitures de 2025</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        table {
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .caption-top {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .highlight {
            background-color: #ffc107 !important;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">🚗 Les Meilleures Voitures de 2025 🚗</h1>
    
    <table class="table table-striped table-bordered shadow-lg">
        <caption class="caption-top text-center">Classement des voitures par prix croissant</caption>
        <thead class="table-dark">
            <tr>
                <th scope="col">Marque</th>
                <th scope="col">Modèle</th>
                <th scope="col">Couleur</th>
                <th scope="col">Prix</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $cars = [
            ["marque" => "BMW", "modele" => "M4 GTS", "couleur" => "Orange", "prix" => 255500.0],
            ["marque" => "Mercedes", "modele" => "AMG GT Black Series", "couleur" => "Noir", "prix" => 350000.0],
            ["marque" => "Porsche", "modele" => "911 GT3 RS", "couleur" => "Bleu", "prix" => 250000.0],
            ["marque" => "Ferrari", "modele" => "F8 Tributo", "couleur" => "Rouge", "prix" => 300000.0],
            ["marque" => "Lamborghini", "modele" => "Huracán STO", "couleur" => "Vert", "prix" => 320000.0]
        ];

        $carsSorted = [];

        foreach ($cars as $car) {
            $temp = [];
            $added = false;

            foreach ($carsSorted as $sortedCar) {
                if (!$added && $car["prix"] < $sortedCar["prix"]) {
                    $temp[] = $car;
                    $added = true;
                }
                $temp[] = $sortedCar;
            }

            if (!$added) {
                $temp[] = $car;
            }

            $carsSorted = $temp;
        }

        $somme_prix = 0;
        foreach ($carsSorted as $car){
            echo "<tr>
                    <th scope='row'>".$car["marque"]."</th>
                    <td>".$car["modele"]."</td>
                    <td>".$car["couleur"]."</td>
                    <td>".number_format($car["prix"], 0, ',', ' ')."€</td>
                  </tr>";
            $somme_prix += $car["prix"];
        }
        ?>
        </tbody>
        <tfoot>
            <tr class="highlight">
                <th scope="row" colspan="3">Prix moyen</th>
                <td><?= number_format($somme_prix/count($cars), 2, ',', ' '); ?>€</td>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>
