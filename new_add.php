<?php
require 'includes/header.php';

?>
<div class="container">
    <h2 class="title is-3">New add</h2>
    <form action="process.php" method="POST">

        <div class="field">
            <label class="label">Title</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="title" placeholder="Title" value="" name="title">
            </div>
        </div>

        <div class="field">
            <label class="label">Price</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="price" placeholder="Price" value="" name="price">
            </div>
        </div>

        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea class="textarea" name="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="file">
            <label class="file-label">
                <input class="file-input" type="file" name="resume">
                <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Choose a file…
                    </span>
                </span>
            </label>
        </div>

        <div class="field">
            <label class="label">Adresse</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="adresse" placeholder="Adresse" value="" name="address">
            </div>
        </div>

        <div class="field">
            <label class="label">City</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="city" placeholder="City" value="" name="city">
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox">
                        I agree to the <a href="#">terms and conditions</a>
                    </label>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" name="newadd_submit">Submit</button>
                </div>
                <div class="control">
                    <button class="button is-link is-light">Cancel</button>
                </div>
            </div>
    </form>
</div>

<?php
require 'includes/footer.php';
