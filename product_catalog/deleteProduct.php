<?php

include("config/db.php");

if (isset($_GET["id"])) {
   $id = htmlspecialchars($_GET["id"]);

   $sql = "DELETE FROM produit WHERE id_produit = $id";
   $db->query($sql);
}

header("location: index.php");
exit;
