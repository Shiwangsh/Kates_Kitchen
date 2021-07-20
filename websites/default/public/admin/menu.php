<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
echo '<section class="right">';
require_once("DatabaseTable.php");


if (isset($_SESSION['user'])) {
	if (isset($_POST['submit'])) {
		//create object of DatabaseTable classs
		$menuTable = new DatabaseTable($pdo, 'menu');
		//delete from menu table
		$menuTable->delete('id', $_POST['id']);
	}
?>

	<h2>Menu</h2>

	<a class="new" href="addMenu.php">Add new dish</a>

<?php
	echo '<table>';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Title</th>';
	echo '<th style="width: 15%">Price</th>';
	echo '<th style="width: 5%">&nbsp;</th>';
	echo '<th style="width: 15%">&nbsp;</th>';
	echo '<th style="width: 5%">&nbsp;</th>';
	echo '<th style="width: 5%">&nbsp;</th>';
	echo '</tr>';
	//query menu table
	$stmt = $pdo->query('SELECT * FROM menu');

	foreach ($stmt as $record) {
		echo '<tr>';
		echo '<td>' . $record['name'] . '</td>';
		echo '<td>' . $record['price'] . '</td>';
		echo '<td><a style="float: right" href="editMenu.php?menu_id=' . $record['id'] . '">Edit</a></td>';
		if ($record["hidden"] == 0) {
			echo '<td><a style="float: right" href="dishDisplay.php?id=' . $record['id'] . '&hidden=' . $record["hidden"] . '">Hide</a></td>';
		} else {
			echo '<td><a style="float: right" href="dishDisplay.php?id=' . $record['id'] . '&hidden=' . $record["hidden"] . '">Show</a></td>';
		}


		echo '<td><form method="post" action="menu.php">
				<input type="hidden" name="id" value="' . $record['id'] . '" />
				<input type="submit" name="submit" value="Delete" />
				</form></td>';
		echo '</tr>';
	}

	echo '</thead>';
	echo '</table>';
} else {
	header('location: ../login.php');
}


?>



</section>
</main>

<?php
include '../app/footer.php';
?>