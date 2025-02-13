<?php

$cars = [
    [
        "marque" => "BMW",
        "modele" => "M4 GTS",
        "couleur" => "Orange",
        "prix" => 255500.0
    ],
    [
        "marque" => "Mercedes",
        "modele" => "AMG GT Black Series",
        "couleur" => "Noir",
        "prix" => 350000.0
    ],
    [
        "marque" => "Porsche",
        "modele" => "911 GT3 RS",
        "couleur" => "Bleu",
        "prix" => 250000.0
    ],
    [
        "marque" => "Ferrari",
        "modele" => "F8 Tributo",
        "couleur" => "Rouge",
        "prix" => 300000.0
    ],
    [
        "marque" => "Lamborghini",
        "modele" => "Huracán STO",
        "couleur" => "Vert",
        "prix" => 320000.0
    ]
];

$somme_prix = 0;

function cmp($a, $b){
    return $a["prix"] - $b["prix"];
}

usort($cars, "cmp");

echo "<table>
        <caption>
          Les meilleures voitures de 2025
        </caption>
        <thead>
          <tr>
            <th scope='col'>Marque</th>
            <th scope='col'>Modèle</th>
            <th scope='col'>Couleur</th>
            <th scope='col'>Prix</th>
          </tr>
        </thead>
        <tbody>";

foreach ($cars as $car){
    
    echo "<tr>
            <th>".$car["marque"]."</th>
            <td>".$car["modele"]."</td>
            <td>".$car["couleur"]."</td>
            <td>".number_format($car["prix"])."€</td>
          </tr>";
    $somme_prix += $car["prix"];
}

echo "</tbody>
      <tfoot>
        <tr>
          <th scope='row' colspan='3'>Prix moyen</th>
          <td>". number_format($somme_prix/count($cars), 2)."€</td>
        </tr>
      </tfoot>
    </table>";


?>

<style>
    table {
  border-collapse: collapse;
  border: 2px solid rgb(140 140 140);
  font-family: sans-serif;
  font-size: 0.8rem;
  letter-spacing: 1px;
}

caption {
  caption-side: bottom;
  padding: 10px;
  font-weight: bold;
}

thead,
tfoot {
  background-color: rgb(228 240 245);
}

th,
td {
  border: 1px solid rgb(160 160 160);
  padding: 8px 10px;
}

td:last-of-type {
  text-align: center;
}
</style>
