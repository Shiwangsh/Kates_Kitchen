<!-- sidebar for when a user logs into the website -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="../admin/menu.php">Menu</a></li>
            <li><a href="../admin/categories.php">Categories</a></li>
            <?php
            $admin = $_SESSION['user']['is_admin'];
            if ($admin == true) {
                echo '<li><a href="../admin/user.php">Users</a></li>';
            }
            ?>

        </ul>
    </section>