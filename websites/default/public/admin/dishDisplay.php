<?php
include '../app/header.php';
require_once("DatabaseTable.php");
//session check
if (isset($_SESSION['user'])) {
    $menuTable = new DatabaseTable($pdo, 'menu');
    $x =  (int)$_GET["id"];
    $y = (int)$_GET["hidden"];
    $displaySwitch = !$y;
    echo $displaySwitch;
    // $stmt = $pdo->prepare('UPDATE menu SET hidden = (:hidden) WHERE id =(:id)');
    $menu = [
        'hidden' => $displaySwitch, 'id' => $x
    ];
    //update menu table
    $menuTable->update($menu, 'id');

    // $stmt->execute($criteria);
    header('Location: menu.php');
}
