<!-- sidebar for when no one is logged into the website -->
<main class="sidebar">
    <section class="left">
        <ul>

            <?php
            //connect to database
            $pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
            //query category table from database
            $stmt = $pdo->prepare('SELECT * FROM category');

            $stmt->execute();
            foreach ($stmt as $record) {
                echo ' <li><a href="category.php?category_id=' . $record["id"] . '&category_name=' . $record["name"] . '">' . $record["name"] . '</a></li>';
            }
            ?>
        </ul>

    </section>