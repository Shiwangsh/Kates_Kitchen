<?php

include 'app/header.php';
?>
<main class="home">
	<p>Welcome to Kate's Kitchen, we're a family run resturaunt in northampton. Take a look around our site to see our menu!</a></p>

	<h2>Take a look at our menu:</h2>

	<?php
	$stmt = $pdo->prepare('SELECT * FROM category');

	$stmt->execute();
	foreach ($stmt as $record) {
		echo '<li><a href="category.php?category_id=' . $record["id"] . '&category_name=' . $record["name"] . '">' . $record["name"] . '</a></li>';
	}


	?>

</main>

<?php
include 'app/footer.php';
?>