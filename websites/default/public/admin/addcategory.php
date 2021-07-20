<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
require_once('DatabaseTable.php')
?>
<section class="right">

	<?php

	if (isset($_SESSION['user'])) {
		if (isset($_POST['submit'])) {
			$valid = true;
			if ($_POST['name'] == '') {
				$valid = false;
			}
			if ($valid) {
				$categoryTable = new DatabaseTable($pdo, 'category');
				$newCategory = [
					'name' => $_POST["name"]
				];
				$categoryTable->insert($newCategory);
				echo 'Category Added';
			} else {
				echo 'Please enter the name of category';
			}
		} else {
	?>


			<h2>Add Category</h2>

			<form action="" method="POST">
				<label>Name</label>
				<input type="text" name="name" />


				<input type="submit" name="submit" value="Add Category" />

			</form>


	<?php
		}
	} else {
		header('location: ../login.php');
	}
	?>

</section>
</main>

<?php
include '../app/footer.php';
?>