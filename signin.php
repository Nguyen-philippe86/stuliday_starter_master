<?php
require 'includes/header.php';

if (!empty($_POST['submit_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login'])) {
    $pass_login = htmlspecialchars($_POST['password_login']);
    $email_login = htmlspecialchars($_POST['email_login']);
    connexion($email_login, $pass_login);
}
// password_verify($pass_login, $db_pass);
?>

<div class="container">
    <div class="columns">
        <div class="column">
            <h2 class="title is-3">Sign In</h2>
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Type your e-mail" value="" name="email_login">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Type your password" value=""
                            name="password_login">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Sign in" name="submit_login" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php';
