<?php

    $name = "Zineddine";
    $lastname = "BEOUCHE";
    $age = 26;

    echo "<h1>Bienvenue ". $name ." !</h1>";

    if ($name == "Zineddine") {
        echo "Utilisateur enregistré<br>";
    } else {
        echo "Utilisateur inconnu<br>";
        die;
    }

    $jour = date("l");

    switch($jour) {
        case "Monday":
            $jour = "Lundi";
            echo "$jour : Début de la semaine";
            break;
        case "Tuesday":
            $jour = "Mardi";
            echo "$jour : Deuxième jour de la semaine";
            break;
        case "Wednesday":
            $jour = "Mercredi";
            echo "$jour : Milieu de la semaine";
            break;
        case "Thursday":
            $jour = "Jeudi";
            echo "$jour : Presque le week-end";
            break;
        case "Friday":
            $jour = "Vendredi";
            echo "$jour : Dernier jour de la semaine";
            break;
        case "Saturday":
        case "Sunday":
            if ($jour == "Saturday") {
                $jour = "Samedi";
            } else {
                $jour = "Dimanche";
            }
            echo "$jour : Week-end";
            break;
        default:
            echo "$jour : Jour inconnu";
            break;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<form action="" method="get" class="form-example">
    <div class="form-example">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" required value=<?php echo $name?>>
    </div>
    <div class="form-example">
        <label for="lastname">Email: </label>
        <input type="text" name="lastname" id="lastname" required value=<?php echo $lastname?>>
    </div>

    <div class="form-example">
        <label for="age">Age: </label>
        <input type="number" name="age" id="age" required value=<?php echo $age?>>
    </div>
    <div class="form-example">
        <input type="submit" value="Submit" />
    </div>
</form>

    
