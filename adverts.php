<?php

$title = 'Adverts - Stuliday';
require 'includes/header.php';

if (isset($_POST['search_form'])) {
    $category = intval(strip_tags($_POST['product_category']));
    $search_text = strip_tags($_POST['search_text']);

    $sql2 = "SELECT * FROM adverts WHERE category_id = {$category} AND products_name LIKE '%{$search_text}%'";
    $res2 = $conn->query($sql2);
    $search = $res2->fetchAll();
}
?>

<form action="" method="POST">
    <div class="form-inline">
        <div class="form-group">
            <label for="InputCategory">Search by name</label>
            <input type="text" name="search_text" id="InputText" class="form-control mb-2 mx-2">
        </div>
        <div class="form-group">
            <label for="InputCategory">Filter by catégory</label>
            <select class="form-control mb-2 mx-2" id="InputCategory" name="product_category">
                <?php foreach ($categories as $category) { ?>
                <option
                    value="<?php echo $adverts['id']; ?>">
                    <?php echo $adverts['categories_name']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Recherche" name="search_form" class="btn btn-info">
    </div>
</form>

<div class="row">
    <?php
        if (isset($search)) {
            foreach ($search as $adverts) {?>
    <div class="card mx-2" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $adverts['title']; ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $product['description']; ?>
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
        } else {
            affichageAdverts();
        }
        ?>
</div>
<?php
require 'includes/footer.php';
