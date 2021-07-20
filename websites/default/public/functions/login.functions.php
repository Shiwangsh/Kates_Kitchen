<?php
//connect to database
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION]);
session_start();
require_once('../admin/DatabaseTable.php');

if (!isset($_SESSION["user"])) {
    if (isset($_POST["submit"])) {
        if (!empty($_POST["username"]) && !empty($_POST["password"])) {
            $userTable = new DatabaseTable($pdo, 'users');
            $username = $_POST["username"];
            $password = $_POST["password"];
            foreach ($userTable->select('username', $_POST['username']) as $user) {
                $verified = password_verify($password, $user["password"]);
                if ($verified) {
                    $_SESSION["user"] = [
                        "username" => $username,
                        "is_admin" => $user['is_admin']
                    ];
                    header('Location: ../admin/index.php');
                } else {
                    echo "username or password incorrect";
                }
            }
        } else {
            echo '<p> Username or password empty</p>';
        }
    } else {
        echo "Login to continue";
    }
} else {
    header("location:../admin/index.php");
}
