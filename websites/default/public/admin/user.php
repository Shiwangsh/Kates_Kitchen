<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
echo '<section class="right">';
require_once("DatabaseTable.php");
//session check
if (isset($_SESSION['user'])) {
    if (isset($_POST['submit'])) {
        //create object of DatabaseTable class
        $userTable = new DatabaseTable($pdo, 'users');
        //delete from users table
        $userTable->delete('id', $_POST['id']);
    }
?>
    <h2>Users</h2>

    <a class="new" href="adduser.php">Add new user</a>

<?php

    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Username</th>';
    echo '<th>Admin</th>';
    echo '</tr>';
    //query users table
    $users = $pdo->query('SELECT * FROM  users ');

    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['username'] . '</td>';
        if ($user['is_admin'] == 0) {
            echo '<td>User is not an admin</td>';
        } else {
            echo '<td>User is an admin</td>';
        }
        echo '<td><a style="float: right" href="editUser.php?id=' . $user['id'] . '">Edit</a></td>';
        echo '<td><form method="post" action="user.php">
				<input type="hidden" name="id" value="' . $user['id'] . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
        echo '</tr>';
    }

    echo '</thead>';
    echo '</table>';
} else {
    header('location: ../login.php');
}

?>
</section>
</main>

<?php
include '../app/footer.php';
?>