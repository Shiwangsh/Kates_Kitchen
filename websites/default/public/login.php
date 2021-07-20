<?php
include 'app/header.php';
if (isset($_SESSION['user'])) {
    include 'app/sidebar-admin.php';
} else {
    include 'app/sidebar-user.php';
}
?>
<h2>Log in</h2>

<form action="/functions/login.functions.php" method="post" style="padding: 40px">

    <label for="username">Enter Username</label>
    <input type="text" name="username">
    <label for="password">Enter password</label>
    <input type="password" name="password" />
    <input type="submit" name="submit" value="Log In" />
</form>

</main>

<?php
include 'app/footer.php';
?>