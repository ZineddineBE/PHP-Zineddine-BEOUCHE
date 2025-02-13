<?php

$users = [
    [
        "nom" => "Jose",
        "age" => 41
    ],
    [
        "nom" => "Florian",
         "age" => 36
    ],
    [
        "nom" => "Zineddine",
        "age" => 26
    ],
    [
        "nom" => "Lilian",
        "age" => 12
    ],
    [
        "nom" => "Lea",
        "age" => 29
    ]
];

function cmp($a, $b){
    return $a["age"] - $b["age"];
}

usort($users, "cmp");

foreach ($users as $user){
    if ($user["age"] >=18){
        echo "Prénom : <b>". $user["nom"]."</b> / Age : ".$user["age"]." (majeur)<br>";
    }else {
        echo "Prénom : ". $user["nom"]." / Age : ".$user["age"]." (mineur)<br>";
    }
}

