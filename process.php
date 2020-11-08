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
    //MODIFICATION DE L'ANNONCE
} elseif (isset($_POST['product_edit'])) {
    // Si oui -> Est-ce que TOUS les champs d'édition ont été renseignés ?
    if (!empty($_POST['title']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['address']) && !empty(['city']) && !empty(['author'])) {
        //Si oui -> création des variables avec les données entrées dans le formulaire
        $title = strip_tags($_POST['title']);
        $price = strip_tags($_POST['price']);
        $description = intval(strip_tags($_POST['description']));
        $address = strip_tags($_POST['address']);
        $city = strip_tags($_POST['city']);
        $author = $_SESSION(['id']);
        // Assigne la variable user_id à partir du token de session
        $user_id = $_SESSION['id']; // Seule la variable user_id correspond à l'ID de la session en cours (donc de l'utilisateur connecté qui crée l'annonce)
        $id = strip_tags($_POST['ad_id']);

        modifProduits($title, $price, $description, $address, $city, $author);
    }
} elseif (isset($_POST['adverts_delete'])) {
    // echo "<div class='alert alert-danger'> Vous tentez de supprimer l'article n°".$_POST['product_id'].'</div>';
    $adverts = $_POST['ad_id'];
    $ad_id = $_SESSION['id'];

    suppProduits($ad_id, $adverts);
}

require 'includes/footer.php';
