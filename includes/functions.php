<?php

require 'includes/config.php';

// FONCTION D'INSCRIPTION
function inscription($email, $motDePasse, $motDePasse2)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();

    if (!$count) {
        if ($motDePasse === $motDePasse2) {
            try {
                $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
                $sth = $conn->prepare('INSERT INTO users (email,password) VALUES (:email, :password)');
                $sth->bindValue('email', $email);
                $sth->bindValue('password', $motDePasse);
                $sth->execute();
                echo '<div class="notification is-succes is-light">
                <button class="delete"></button>
                L\'utilisateur a bien été enregistré ! 
                </div>';
            } catch (PDOException $e) {
                echo 'Error'.$e->getMessage();
            }
        } else {
            echo '<div class="notification is-danger is-light">
            <button class="delete"></button>
            Les mots de passe ne concordent pas ! 
            </div>';
        }
    } elseif ($count > 0) {
        echo '<div class="notification is-danger is-light"
        <button class="delete"></button>
        Cette adresse existe déjà !
        </div>';
    }
}
// FONCTION CONNEXION
function connexion($email_login, $pass_login)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '{$email_login}'";
    $res = $conn->query($sql);
    $user = $res->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $db_pass = $user['password'];
        if (password_verify($pass_login, $db_pass)) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            header('Location: index.php?');
        } else {
            echo '<div class="notification is-danger is-light"
        <button class="delete"></button>
        Mot de passe erroné
        </div>';
        }
    } else {
        echo '<div class="notification is-danger is-light"
        <button class="delete"></button>
        Cet utilisateur n\'existe pas
        </div>';
    }
}
// FONCTION AJOUT D'ANNONCE
function ajoutAnnonce($title, $price, $description, $address, $city, $author)
{
    global $conn;
    // Vérification du prix (doit être un entier, et inférieur à 1 million d'euros)
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // Utilisation du try/catch pour capturer les erreurs PDO/SQL
        try {
            // Création de la requête avec tous les champs du formulaire
            $sth = $conn->prepare('INSERT INTO adverts (title,description,price,city,address,author) VALUES (:title, :description, :price, :city, :address, :author)');
            $sth->bindValue(':title', $title, PDO::PARAM_STR);
            $sth->bindValue(':price', $price, PDO::PARAM_INT);
            $sth->bindValue(':description', $description, PDO::PARAM_STR);
            $sth->bindValue(':address', $address, PDO::PARAM_STR);
            $sth->bindValue(':city', $city, PDO::PARAM_STR);
            $sth->bindValue(':author', $author, PDO::PARAM_INT);

            // Affichage conditionnel du message de réussite
            if ($sth->execute()) {
                echo "<div class='alert alert-success'> Votre article a été ajouté à la base de données </div>";
                header('Location: index.php?id='.$conn->lastInsertId());
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}
// AFFICHAGE ANNONCE
function affichageAdverts()
{
    global $conn;
    $sth = $conn->prepare('SELECT p.*,c.categories_name,u.username FROM products AS p LEFT JOIN categories AS c ON p.category_id = c.categories_id LEFT JOIN users AS u ON p.user_id = u.id');
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $adverts) {
        ?>
<div class="card mx-2" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?php echo $adverts['title']; ?>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $adverts['description']; ?>
        </h6>
        <p class="card-text"><?php echo $adverts['address']; ?>
        </p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $adverts['price']; ?>
                €</li>
            <li class="list-group-item"><?php echo $adverts['city']; ?>
            </li>
        </ul>
        <a href="product.php?id=<?php echo $adverts['id']; ?>"
            class="card-link btn btn-primary">Afficher article</a>
    </div>
</div>
<?php
    }
}
