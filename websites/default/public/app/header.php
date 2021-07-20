<?php
//connect to database
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
session_start();

echo '<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../styles/styles.css" />
    <link rel="stylesheet" href="../styles/review.css" />
    <title>Kate\'s Kitchen - Home</title>
</head>

<body>
    <header>
        <section>
            <aside>
                <h3>Opening times:</h3>
                <p>Sun-Thu: 12:00-22:00</p>
                <p>Fri-Sat: 12:00-23:30</p>
            </aside>
            <h1>Kate\'s Kitchen</h1>

        </section>
    </header>
    <nav>
    <ul>
    <li><a href="/">Home</a></li>
     <li>Menu
     <ul>
    ';
//query category table from database
$stmt = $pdo->prepare('SELECT * FROM category');

$stmt->execute();
foreach ($stmt as $record) {
    echo ' <li><a href="../category.php?category_id=' . $record["id"] . '&category_name=' . $record["name"] . '">' . $record["name"] . '</a></li>';
}
echo '<li><a href="../faq.php">FAQs</a></li>';
echo '</ul>';

echo '</li>';
echo '<li><a href="../about.php">About Us</a></li>';
//session check
if (isset($_SESSION['user'])) {
    echo '<li><a href="../admin/logout.php">Logout</a></li>';
} else {
    echo '<li><a href="../login.php">Login</a></li>';
}
echo  '</ul>';

echo   '</nav>';
echo '<img src="../images/randombanner.php" />';
