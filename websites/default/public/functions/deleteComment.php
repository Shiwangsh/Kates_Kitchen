<?php
//connect to database
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION]);
session_start();
require_once("../admin/DatabaseTable.php");

if (isset($_SESSION['user']) && $_SESSION['user'] == true) {
    //create DatabaseTable class object
    $reviewTable = new DatabaseTable($pdo, 'reviews');
    $comment_ID = $_GET["comment_id"];
    $menu_id = $_GET["menu_id"];
    //delete from reviews table
    $reviewTable->delete('id', $_GET["comment_id"]);
}
header('Location: ../menu.php?menu_id=' . $menu_id);
