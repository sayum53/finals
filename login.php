<?php

require 'includes/url.php';
require 'classes/User.php';
require 'classes/Database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database();
    $conn = $db->getConn();

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {

        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        redirect('/');

    } else {

        $error = "login incorrect";

    }
}

?>
<?php require 'includes/header.php'; ?>
<style><?php include 'test.css'; ?></style>




<?php if (! empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post">


    <div class="form-group">
        <label for="username">Username</label>
        <input name="username" id="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <button class="btn">Log in</button>

</form>


<?php require 'includes/footer.php'; ?>
