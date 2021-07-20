<?php
//connect to database using pdo
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION]);
require_once('../admin/DatabaseTable.php');
//create DatabaseTable class object
$reviewTable = new DatabaseTable($pdo, 'reviews');
$menu_id = $_POST["id"];
$valid = true;
//error check
if ($_POST['name'] == '') {
  $valid = false;
}
if ($_POST['content'] == '') {
  $valid = false;
}
if ($valid) {
  $newReview = [
    'name' => $_POST["name"],
    'content' => $_POST["content"],
    'rating' => $_POST["rating"],
    'menu_id' => $menu_id,
    'approved' => false

  ];
  //insert into reviews table
  $reviewTable->insert($newReview);
} else {
  echo 'Please enter all fields';
}
$url = '../menu.php?menu_id=' . $menu_id;
header('Location: ' . $url);
