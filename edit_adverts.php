<?php

$title = 'Modification - Stuliday';
require 'includes/header.php';

$id = $_GET['id'];
$sql1 = 'SELECT * FROM adverts';
$res1 = $conn->query($sql1);
$adverts = $res1->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
    <div class="columns">
        <div class="column">
            <div class="row">
                <div class="col-12">
                    <form action="process.php" method="POST">
                        <div class="form-group">
                            <label for="InputTitle">Title</label>
                            <input type="text" class="form-control" id="InputTitle"
                                value="<?php echo $adverts['title']; ?>"
                                name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="InputPrice">Price</label>
                            <input type="number" max="999999" class="form-control" id="InputPrice"
                                value="<?php echo $adverts['price']; ?>"
                                name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="InputDescription">Description</label>
                            <textarea class="form-control" id="InputDescription" rows="3" name="description"
                                required><?php echo $adverts['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="InputAddress">Address</label>
                            <textarea class="form-control" id="InputAddress" rows="3" name="address"
                                required><?php echo $adverts['address']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="InputCity">City</label>
                            <input type="text" class="form-control" id="InputCity"
                                value="<?php echo $adverts['city']; ?>"
                                name="city" required>
                        </div>
                        <input type="hidden" name="ad_id"
                            value="<?php echo $adverts['ad_id']; ?>" />
                        <button type="submit" class="btn btn-success" name="product_edit">Edit adverts</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require 'includes/footer.php';
