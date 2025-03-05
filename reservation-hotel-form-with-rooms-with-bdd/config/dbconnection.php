<?php

// Connexion à la base de données avec PDO
$db = new PDO('mysql:host=localhost;dbname=hotel', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active les erreurs PDO

function addUser($db, $email, $password, $role, $has_fidelity) {
    try {
        $sql = "INSERT INTO user (email, password, role, has_fidelity) VALUES (:email, :password, :role, :has_fidelity)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT), // Sécuriser le mot de passe
            ':role' => $role,
            ':has_fidelity' => $has_fidelity
        ]);
        return $db->lastInsertId(); // Retourne l'ID de l'utilisateur inséré
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

function addBooking($db, $begin_date, $end_date, $nb_rooms, $id_user) {
    try {
        // Vérifier que l'utilisateur existe
        $checkUser = $db->prepare("SELECT id_user FROM user WHERE id_user = :id_user");
        $checkUser->execute([':id_user' => $id_user]);
        if ($checkUser->rowCount() == 0) {
            echo "Erreur : l'utilisateur avec id_user = $id_user n'existe pas.";
            return false;
        }

        // Insérer la réservation (prix temporairement à 0)
        $sql = "INSERT INTO booking (begin_date, end_date, nb_rooms, price, id_user)
                VALUES (:begin_date, :end_date, :nb_rooms, 0, :id_user)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':begin_date' => $begin_date,
            ':end_date' => $end_date,
            ':nb_rooms' => $nb_rooms,
            ':id_user' => $id_user
        ]);
        return $db->lastInsertId(); // Retourne l'ID de la réservation
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la réservation : " . $e->getMessage();
        return false;
    }
}

function addRoomBooking($db, $id_booking, $rooms, $quantities) {
    try {
        // Vérifier que la réservation existe
        $checkBooking = $db->prepare("SELECT id_booking FROM booking WHERE id_booking = :id_booking");
        $checkBooking->execute([':id_booking' => $id_booking]);
        if ($checkBooking->rowCount() == 0) {
            echo "Erreur : la réservation avec id_booking = $id_booking n'existe pas.";
            return false;
        }

        // Initialiser le prix total
        $total_price = 0;

        // Insérer les chambres réservées
        $stmt = $db->prepare("INSERT INTO booking_room (id_booking, id_room, quantity) VALUES (:id_booking, :id_room, :quantity)");
        $priceStmt = $db->prepare("SELECT price FROM room WHERE id_room = :id_room");

        foreach ($rooms as $index => $id_room) {
            $quantity = (int) $quantities[$index];

            // Récupérer le prix de la chambre
            $priceStmt->execute([':id_room' => $id_room]);
            $room = $priceStmt->fetch(PDO::FETCH_ASSOC);

            if ($room) {
                $room_price = $room['price'] * $quantity;
                $total_price += $room_price;

                // Insérer la chambre dans booking_room
                $stmt->execute([
                    ':id_booking' => $id_booking,
                    ':id_room' => $id_room,
                    ':quantity' => $quantity
                ]);
            } else {
                echo "Erreur : la chambre avec id_room = $id_room n'existe pas.";
                return false;
            }
        }

        // Mettre à jour le prix total dans la réservation
        $updatePrice = $db->prepare("UPDATE booking SET price = :price WHERE id_booking = :id_booking");
        $updatePrice->execute([
            ':price' => $total_price,
            ':id_booking' => $id_booking
        ]);

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout des chambres : " . $e->getMessage();
        return false;
    }
}

function addBookingOptions($db, $id_booking, $options, $quantities) {
    try {
        // Vérifier que la réservation existe
        $checkBooking = $db->prepare("SELECT id_booking FROM booking WHERE id_booking = :id_booking");
        $checkBooking->execute([':id_booking' => $id_booking]);
        if ($checkBooking->rowCount() == 0) {
            echo "Erreur : la réservation avec id_booking = $id_booking n'existe pas.";
            return false;
        }

        // Insérer les options pour la réservation
        $stmt = $db->prepare("INSERT INTO booking_option (id_booking, id_option, quantity) VALUES (:id_booking, :id_option, :quantity)");

        foreach ($options as $index => $id_option) {
            $quantity = (int) $quantities[$index];

            // Insérer l'option dans la table booking_option
            $stmt->execute([
                ':id_booking' => $id_booking,
                ':id_option' => $id_option,
                ':quantity' => $quantity
            ]);
        }

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout des options : " . $e->getMessage();
        return false;
    }
}

// Ajouter un utilisateur
$id_user = addUser($db, "zb@gmail.com", "1234", "admin", 1);

if ($id_user) {
    // Ajouter une réservation pour cet utilisateur
    $id_booking = addBooking($db, "2025-02-25 14:00:00", "2025-02-27 10:00:00", 1, $id_user);

    if ($id_booking) {
        // Ajouter des chambres pour la réservation (ex: chambre Standard (id=1), Deluxe (id=3))
        addRoomBooking($db, $id_booking, [1, 3], [1, 1]);

        // Ajouter des options à la réservation (par exemple, option id=2 et id=4 avec des quantités respectives)
        addBookingOptions($db, $id_booking, [2, 4], [2, 1]);
    }
}

?>
