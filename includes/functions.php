<?php

require 'includes/config.php';

// INSCRIPTION
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
// CONNEXION
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
// AJOUT ANNONCE
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
                echo "<div class='alert alert-success'> Votre annonce a été ajouté</div>";
                header('Location: profil.php?id='.$conn->lastInsertId());
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}
// AFFICHAGE ANNONCES
function affichageAdverts()
{
    global $conn;
    $sth = $conn->prepare('SELECT * FROM adverts');
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $adverts) {
        ?>
<div class="column is-two-fifths is offset-1">
    <div class="card border-info mb-3" style="max-width: 18rem;">
        <div class="card-header"></div>
        <div class="card-body">
            <h5 class="card-title text-info"><?php echo $adverts['title']; ?>
            </h5>
            <h6 class="card-text"><?php echo $adverts['description']; ?>
            </h6>
            <p class="card-text"><?php echo $adverts['address']; ?>
            </p>
            <p class="card-text"><?php echo $adverts['price']; ?>€</p>
            <p class="card-text"><?php echo $adverts['city']; ?>
            </p>
            <a href="#?id=<?php echo $adverts['id']; ?>"
                class="card-link btn btn-info">Afficher article</a>
        </div>
    </div>
</div>
<?php
    }
}
function affichageAdvert($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT * FROM adverts WHERE ad_id={$id}");
    $sth->execute();

    $adverts = $sth->fetch(PDO::FETCH_ASSOC); ?>
<div class="column is-two-fifths is offset-1">
    <div class="card border-info mb-3" style="max-width: 18rem;">
        <div class="card-header"></div>
        <div class="card-body">
            <h5 class="card-title text-info"><?php echo $adverts['title']; ?>
            </h5>
            <h6 class="card-text"><?php echo $adverts['description']; ?>
            </h6>
            <p class="card-text"><?php echo $adverts['address']; ?>
            </p>

            <p class="card-text"><?php echo $adverts['price']; ?>
                €</p>
            <p class="card-text"><?php echo $adverts['city']; ?>

            </p>
            <a href="#?id=<?php echo $adverts['id']; ?>"
                class="card-link btn btn-info">Afficher article</a>
        </div>
    </div>
</div>
<?php
}

// AFFICHAGE ANNONCE BY USER
function affichageAdvertsByUser($author)
{
    global $conn;
    $sth = $conn->prepare("SELECT * FROM adverts INNER JOIN users ON adverts.author = users.id WHERE author = {$author}");
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $advert) {
        ?>
<tr>
    <th scope="row"><?php echo $advert['title']; ?>
    </th>
    <td><?php echo $advert['description']; ?>
    </td>
    <td><?php echo $advert['address']; ?>
    </td>
    <td><?php echo $advert['price']; ?> $
    </td>
    <td><?php echo $advert['city']; ?>
    </td>
    <td> <a href="product.php?id=<?php echo $advert['ad_id']; ?>"
            class="fa btn btn-outline-primary"><i class="fas fa-eye"></i></a>
    </td>
    <td> <a href="edit_adverts.php?id=<?php echo $advert['ad_id']; ?>"
            class="fa btn btn-outline-warning"><i class="fas fa-pen"></i></a>
    </td>
    <td>
        <form action="process.php" method="POST">
            <input type="hidden" name="ad_id"
                value="<?php echo $advert['ad_id']; ?>">
            <input type="submit" name="adverts_delete" class="fa btn btn-outline-danger" value="&#xf2ed;"></input>
        </form>
    </td>
</tr>
<?php
    }
}
// MODIFICATION ANNONCE
function editAdverts($title, $price, $description, $address, $city, $author, $id)
{
    global $conn;
    if (is_int($price) && $price > 0 && $price < 1000000) {
        try {
            $sth = $conn->prepare('UPDATE adverts SET title=:title, price=:price, description=:description, address=:address,city=:city WHERE ad_id=:ad_id AND author=:author');
            $sth->bindValue(':title', $title);
            $sth->bindValue(':price', $price);
            $sth->bindValue(':description', $description);
            $sth->bindValue(':address', $address);
            $sth->bindValue(':city', $city);
            $sth->bindValue(':author', $author);
            $sth->bindValue(':ad_id', $id);

            if ($sth->execute()) {
                echo "<div class='alert alert-success'> Votre modification a bien été prise en compte </div>";
                header("Location: product.php?id={$id}");
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}
// SUPPRESSION ANNONCE
function suppAdverts($ad_id, $author)
{
    global $conn;

    try {
        $sth = $conn->prepare('DELETE FROM adverts WHERE ad_id =:ad_id AND author =:author');
        $sth->bindValue(':ad_id', $ad_id);
        $sth->bindValue(':author', $author);
        if ($sth->execute()) {
            header('Location:profil.php?s');
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}
