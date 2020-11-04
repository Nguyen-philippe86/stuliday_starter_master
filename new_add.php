<?php
require 'includes/header.php';

?>
<div class="container">
    <h2 class="title is-3">New add</h2>
    <form action="" method="POST">

        <div class="field">
            <label class="label">Title</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="title" placeholder="Title" value="" name="title">
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label">Price</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="price" placeholder="Price" value="" name="price">
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea class="textarea" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="file is-info has-name">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Insert file…
                        </span>
                    </span>
                    <span class="file-name">
                        Screen Shot 2017-07-29 at 15.54.25.png
                    </span>
                </label>
            </div>
        </div>

        <div class="field">
            <label class="label">Adresse</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="adresse" placeholder="Adresse" value="" name="adresse">
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label">City</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" type="city" placeholder="City" value="" name="city">
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
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
                <button class="button is-link">Submit</button>
            </div>
            <div class="control">
                <button class="button is-link is-light">Cancel</button>
            </div>
        </div>
    </form>
</div>

<?php
require 'includes/footer.php';
