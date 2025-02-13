<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        font-size: 0.9rem;
    }

    caption {
        caption-side: bottom;
        padding: 12px;
        font-weight: bold;
        font-size: 1.1rem;
        color: #444;
    }

    thead {
        background-color: #2c3e50;
        color: white;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #e0e0e0;
    }

    tfoot {
        background-color: #ecf0f1;
        font-weight: bold;
    }
</style>

<?php

$cars = [
    ["identifiant" => random_int(1, 100), "marque" => "BMW", "modele" => "M4 GTS", "couleur" => "Orange", "prix" => 255500.0],
    ["identifiant" => random_int(1, 100), "marque" => "Mercedes", "modele" => "AMG GT Black Series", "couleur" => "Black", "prix" => 350000.0],
    ["identifiant" => random_int(1, 100), "marque" => "Porsche", "modele" => "911 GT3 RS", "couleur" => "Blue", "prix" => 250000.0],
    ["identifiant" => random_int(1, 100), "marque" => "Ferrari", "modele" => "F8 Tributo", "couleur" => "Red", "prix" => 300000.0],
    ["identifiant" => random_int(1, 100), "marque" => "Lamborghini", "modele" => "Huracán STO", "couleur" => "Green", "prix" => 320000.0]
];

$cars2 = [
    ["identifiant" => random_int(1, 100), "marque" => "Audi", "modele" => "R8 V10 Performance", "couleur" => "Gray", "prix" => 230000.0],
    ["identifiant" => random_int(1, 100), "marque" => "McLaren", "modele" => "720S", "couleur" => "Orange", "prix" => 310000.0],
    ["identifiant" => random_int(1, 100), "marque" => "Bugatti", "modele" => "Chiron Pur Sport", "couleur" => "Blue", "prix" => 3500000.0],
    ["identifiant" => random_int(1, 100), "marque" => "Aston Martin", "modele" => "Vantage F1 Edition", "couleur" => "Green", "prix" => 200000.0],
    ["identifiant" => random_int(1, 100), "marque" => "Koenigsegg", "modele" => "Jesko", "couleur" => "White", "prix" => 2800000.0]
];

$cars = array_merge($cars, $cars2);

$somme_prix = 0;

function cmp($a, $b) {
    return $a["prix"] - $b["prix"];
}

usort($cars, "cmp");

echo "<table>
        <caption>Les meilleures voitures de 2025</caption>
        <thead>
            <tr>
                <th>Id</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Couleur</th>
                <th>Prix (€)</th>
            </tr>
        </thead>
        <tbody>";

foreach ($cars as $car) {
    $somme_prix += $car["prix"];
    if($car["couleur"] == "White"){
        $style = " text-shadow: 2px 0 black, -2px 0 black, 0 2px black, 0 -2px black,
               1px 1px black, -1px -1px black, 1px -1px black, -1px 1px black;";
    } else{
        $style = "";
    }
    echo "<tr>
            <td>" . $car["identifiant"] . "</td>
            <td><strong>" . strtoupper($car["marque"]) . "</strong></td>
            <td>" . $car["modele"] . "</td>
            <td style='color: " . strtolower($car["couleur"]) . "; font-weight: bold; $style;'>" . $car["couleur"] . "</td>
            <td>" . number_format($car["prix"], 0, ',', ' ') . " €</td>
          </tr>";
}

$prix_moyen = $somme_prix / count($cars);

echo "</tbody>
      <tfoot>
        <tr>
          <td colspan='4'>Prix moyen</td>
          <td>" . number_format($prix_moyen, 2, ',', ' ') . " €</td>
        </tr>
      </tfoot>
    </table>";

?>
