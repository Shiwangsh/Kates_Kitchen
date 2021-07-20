<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
require_once 'DatabaseTable.php';
?>
<section class="right">

    <?php

    if (isset($_SESSION['user'])) {
        //create object of DatabaseTable classs
        $userTable = new DatabaseTable($pdo, 'users');
        if (isset($_POST['submit'])) {
            $valid = true;
            //error checks
            if ($_POST['username'] == '') {
                $valid = false;
            }
            if ($_POST['password'] == '') {
                $valid = false;
            }
            if ($valid) {
                $currentPassword = $_POST['password'];
                //hash password
                $hashed_password = password_hash($currentPassword, PASSWORD_BCRYPT);
                $updatedUser = [
                    'username' => $_POST['username'],
                    'password' => $hashed_password,
                    'is_admin' => (bool)$_POST['is_admin'],
                    'id' => $_POST['id']
                ];
                //update users table
                $userTable->update($updatedUser, 'id');
                echo "user updated";
            } else {
                echo 'Please fill in all the fields correctly';
            }
        } else {
            //query users table
            foreach ($userTable->select('id', $_GET['id']) as $record) {
    ?>


                <h2>Edit User</h2>

                <form action="editUser.php" method="POST">

                    <input type="hidden" name="id" value="<?php echo $record['id']; ?>" />

                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $record['username']; ?>" />

                    <label>New Password</label>
                    <input type="password" name="password" value="" />

                    <label>Give Admin Access</label>
                    <select name='is_admin'>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <input type="submit" name="submit" value="Edit" />
                </form>
    <?php
            }
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