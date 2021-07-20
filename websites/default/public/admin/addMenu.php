<?php
include '../app/header.php';
include '../app/sidebar-admin.php';
require_once('DatabaseTable.php');
?>
<section class="right">

	<?php
	if (isset($_SESSION['user'])) {

		if (isset($_POST['submit'])) {
			$valid = true;
			if ($_POST['name'] == '') {
				$valid = false;
			}
			if ($_POST['description'] == '') {
				$valid = false;
			}
			if ($_POST['price'] == '') {
				$valid = false;
			}
			if ($_FILES['image']['size'] == 0) {
				$valid = false;
			}
			if ($valid) {
				$menuTable = new DatabaseTable($pdo, 'menu');
				$fileDestination = $menuTable->imageCheck('image');
				$newMenu = [
					'name' => $_POST['name'],
					'description' => $_POST['description'],
					'price' => $_POST['price'],
					'categoryId' => $_POST['categoryId'],
					'image_dir' => $fileDestination
				];
				$menuTable->insert($newMenu);
				echo 'Menu Added';
			} else {
				echo 'Please fill in all the fields';
			}
		} else {

	?>


			<h2>Add Dish</h2>

			<form action="addMenu.php" method="POST" enctype="multipart/form-data">
				<label>Name</label>
				<input type="text" name="name" placeholder="Name of the dish" />

				<label>Description</label>
				<textarea name="description" placeholder="Write something about the dish"></textarea>

				<label>Price</label>
				<input type="text" name="price" placeholder="Price of the dish" />

				<label>Image</label>
				<input type="file" name="image" />

				<label>Category</label>

				<select name="categoryId">
					<?php
					$stmt = $pdo->prepare('SELECT * FROM category');
					$stmt->execute();

					foreach ($stmt as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}

					?>

				</select>

				<input type="submit" name="submit" value="Add" />

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