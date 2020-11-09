<?php

$title = 'Profil page - Stuliday';
require 'includes/header.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '{$user_id}'";
$res = $conn->query($sql);
$user = $res->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
    <div class="columns">
        <div class="column">
            <h3>Welcome <?php echo $_SESSION['email']; ?>
            </h3>
            <h5>Your adverts :</h5>
            <div class="row">
                <div class="col-8">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Address</th>
                                <th scope="col">Price</th>
                                <th scope="col">City</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    affichageAdvertsByUser($user_id);
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'includes/footer.php';
