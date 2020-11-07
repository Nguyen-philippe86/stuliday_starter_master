<?php

require 'includes/header.php';

// Bloque l'acces du visiteur a cette page
if ('POST' != $_SERVER['REQUEST_METHOD']) {
    echo "<div class='alert alert-danger'> La page à laquelle vous tentez d'accéder n'existe pas </div>";
// 1er elseif pour l'ajout d'annonce
} elseif (isset($_POST['newadd_submit'])) {
    if (!empty($_POST['title']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['address']) && !empty($_POST['city'])) {
        $title = strip_tags($_POST['title']);
        $price = intval(strip_tags($_POST['price']));
        $description = strip_tags($_POST['description']);
        $address = strip_tags($_POST['address']);
        $city = strip_tags($_POST['city']);
        $author = $_SESSION['id'];

        ajoutAnnonce($title, $price, $description, $address, $city, $author);
    } else {
        echo "<div class='alert alert-danger'>Error</div>";
    }
}

require 'includes/footer.php';
