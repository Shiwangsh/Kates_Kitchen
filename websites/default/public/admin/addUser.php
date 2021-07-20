<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
require_once('DatabaseTable.php')
?>

<section class="right">

    <?php

    if (isset($_SESSION['user'])) {

        if (isset($_POST['submit'])) {
            $valid = true;
            if ($_POST['username'] == '') {
                $valid = false;
            }
            if ($_POST['password'] == '') {
                $valid = false;
            }
            if ($valid) {
                $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $newUser = [
                    'username' => $_POST['username'],
                    'password' => $hashed_password,
                    'is_admin' => (bool)$_POST['is_admin']
                ];
                $userTable = new DatabaseTable($pdo, 'users');
                $userTable->insert($newUser);
                echo 'User Added';
            } else {
                echo 'Please fill in the form correctly';
            }
        } else {

    ?>


            <h2>Add User</h2>

            <form action="addUser.php" method="POST">
                <label>Username</label>
                <input type="text" name="username" />

                <label>Password</label>
                <input type="password" name="password" />

                <label>Admin</label>
                <select name='is_admin'>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <input type="submit" name="submit" value="Add" />
            </form>
    <?php
        }
    } else {
        header('location: ../login.php');
    }
    ?>

</section>
</main>
<?php
include '../app/footer.php';
?>