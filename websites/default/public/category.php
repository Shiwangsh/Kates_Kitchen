<?php
require_once("admin/DatabaseTable.php");
include 'app/header.php';
if (isset($_SESSION['user'])) {
    include 'app/sidebar-admin.php';
} else {
    include 'app/sidebar-user.php';
}
?>
<section class="right">
    <?php
    echo '<h1>' . $_GET["category_name"] . '</h1>';
    echo '<ul class="listing">';
    //create object of DatabaseTable class
    $menus = new DatabaseTable($pdo, 'menu');
    //query all the contents of menu table
    foreach ($menus->select('categoryId',  $_GET["category_id"]) as $menu) {
        if ($menu['hidden'] == false) {
            echo '<li>';
            echo '<div class="details">';
            echo '<h3>£' . $menu['price'] . '</h3>';
            echo '<h2><a href="menu.php?menu_id=' . $menu['id']  . '">' . $menu['name']  . '</a></h2>';
            echo '<div class = "img_div">';
            echo "<img src = '../images/" . $menu['image_dir']  . "'>";
            echo '</div>';


            echo '<p>' . nl2br($menu['description']) . '</p>';


            echo '</div>';
            echo '</li>';
        }
    }

    ?>

    </ul>

</section>
</main>


<?php

include 'app/footer.php';
?>

</body>