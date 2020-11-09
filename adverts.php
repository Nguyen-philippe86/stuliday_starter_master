<?php

$title = 'Adverts - Stuliday';
require 'includes/header.php';

if (isset($_POST['search_form'])) {
    $search_text = strip_tags($_POST['search_text']);

    $sql2 = "SELECT * FROM adverts WHERE title LIKE '%{$search_text}%'";
    $res2 = $conn->query($sql2);
    $search = $res2->fetchAll();
}
?>

<div class="container">
    <div class="columns">
        <div class="column">
            <h2 class="title is-3">Adverts</h2>
            <?php
            if (isset($search)) {
                foreach ($search as $adverts) {?>
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
                    <a href="#?id=<?php echo $adverts['ad_id']; ?>"
                        class="card-link btn btn-info">Afficher article</a>
                </div>
            </div>
            <?php
                }
            } else {
                affichageAdverts();
            }
            ?>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php';
