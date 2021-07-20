<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
echo '<section class="right">';
require_once("DatabaseTable.php");


if (isset($_SESSION['user'])) {
	if (isset($_POST['submit'])) {
		$categoryTable = new DatabaseTable($pdo, 'category');
		$categoryTable->delete('id', $_POST['id']);
	}
?>


	<h2>Categories</h2>

	<a class="new" href="addcategory.php">Add new category</a>

<?php
	echo '<table>';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Name</th>';
	echo '<th style="width: 5%">&nbsp;</th>';
	echo '<th style="width: 5%">&nbsp;</th>';
	echo '</tr>';

	$categories = $pdo->query('SELECT * FROM category');

	foreach ($categories as $category) {
		echo '<tr>';
		echo '<td>' . $category['name'] . '</td>';
		echo '<td><a style="float: right" href="editcategory.php?id=' . $category['id'] . '">Edit</a></td>';
		echo '<td><form method="post" action="categories.php">
				<input type="hidden" name="id" value="' . $category['id'] . '" />
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