<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
require_once('DatabaseTable.php');
?>

<section class="right">

	<?php
	//session check
	if (isset($_SESSION['user'])) {
		//create object of DatabaseTable classs
		$categoryTable = new DatabaseTable($pdo, 'category');
		if (isset($_POST['submit'])) {
			$valid = true;
			//error check
			if ($_POST['name'] == '') {
				$valid = false;
			}
			if ($valid) {
				$updatedCategory = [
					'name' => $_POST['name'],
					'id' => $_POST['id']
				];
				//update category table
				$categoryTable->update($updatedCategory, 'id');
				echo 'Category Saved';
			} else {
				echo 'Please enter category name';
			}
		} else {
			//query category table
			foreach ($categoryTable->select('id', $_GET['id']) as $currentCategory) {
	?>
				<h2>Edit Category</h2>

				<form action="editcategory.php" method="POST">

					<input type="hidden" name="id" value="<?php echo $currentCategory['id']; ?>" />
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $currentCategory['name']; ?>" />


					<input type="submit" name="submit" value="Save Category" />

				</form>


	<?php

			}
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

</html>