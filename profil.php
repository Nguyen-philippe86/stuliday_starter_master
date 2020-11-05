<?php

$title = 'Page de profil - Stuliday';
require 'includes/header.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '{$user_id}'";
$res = $conn->query($sql);
$user = $res->fetch(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-8">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    affichageProduitsByUser($user_id);
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-3 offset-1">
        <h4>Bienvenue <?php echo $user['username']; ?>
        </h4>

        <form action="process.php" method="post">
            <div class="form-group">
                <label for="InputPhone1">Votre numéro de téléphone</label>
                <input class="form-control" type="tel" name="user_phone" id="InputPhone1"
                    value="<?php echo $user['phone']; ?>"
                    pattern="[0-9]{10,}" title="Un numéro de téléphone à 9 chiffres minimum sans indicatif">
            </div>
            <input type="hidden" name="user_id"
                value="<?php echo $user['id']; ?>">
            <input type="submit" class="btn btn-success" name="user_edit" value="Mettre à jour">
        </form>
    </div>
</div>

<?php
require 'includes/footer.php';
