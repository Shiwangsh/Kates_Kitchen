<?php
include 'app/header.php';
require_once('admin/DatabaseTable.php');
if (isset($_SESSION['user'])) {
    include 'app/sidebar-admin.php';
} else {
    include 'app/sidebar-user.php';
}
?>
<section class="right">

    <?php
    //create object of DatabaseTable class
    $menuTable = new DatabaseTable($pdo, 'menu');
    $menu_id = $_GET['menu_id'];
    //query contents of menu table
    foreach ($menuTable->select('id', $menu_id) as $menu) {
        if ($menu["hidden"] == false) {
            echo '<h1>' . $menu["name"] . '</h1>';

            echo '<ul class="listing">';
            echo '<li>';

            echo '<div class="details">';
            echo '<h2>£' . $menu['price'] . '</h2>';
            echo '<h2>' . $menu['description'] . '</h2>';
            echo '<div class = "img_div">';
            echo "<img src = 'images/" . $menu['image_dir']  . "'>";
            echo '</div>';
            echo '</div>';
            echo '</li>';
            echo '</ul>';
            require "app/addReviewForm.php";
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Name</th>';
            echo '<th>Comment</th>';
            echo '<th>Ratings</th>';
            echo '</tr>';
        } else {
            echo " 404 not found ";
        }
    }
    //session check 
    if (isset($_SESSION['user'])) {
        $reviewTable = new DatabaseTable($pdo, 'reviews');
        //query contents of review table 
        foreach ($reviewTable->select('menu_id', $menu_id) as $review) {
            echo '<tr>';
            echo '<td>' . $review['name'] . '</td>';
            echo '<td>' . $review['content'] . '</td>';
            echo '<td>' . $review['rating'] . '</td>';
            echo '<td><a href="functions/deleteComment.php?comment_id=' . $review['id'] . '&menu_id=' . $menu_id . '">Delete</a></td>';
            if ($review['approved'] == true) {
                echo "";
            } else {
                echo '<td><a href="functions/approveComment.php?comment_id=' . $review["id"] . '&menu_id=' . $menu_id . '">Approve</a></td>';
            }
            echo '</tr>';
        }
    } else {
        $reviewTable = new DatabaseTable($pdo, 'reviews');
        //query contents of review table and display if approved
        foreach ($reviewTable->select('menu_id',  $menu_id) as $review) {

            if ($review['approved'] == true) {
                echo '<tr>';
                echo '<td>' . $review['name'] . '</td>';
                echo '<td>' . $review['content'] . '</td>';
                echo '<td>' . $review['rating'] . '</td>';
            }
        }
    }
    ?>