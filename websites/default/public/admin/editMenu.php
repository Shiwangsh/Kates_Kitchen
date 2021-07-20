<?php
include  '../app/header.php';
include '../app/sidebar-admin.php';
require_once('DatabaseTable.php');
?>
<section class="right">
	<?php
	if (isset($_SESSION['user'])) {
		//create object of DatabaseTable class
		$menuTable = new DatabaseTable($pdo, 'menu');

		if (isset($_POST['submit'])) {
			$valid = true;
			//error checks
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
				//insert image to local folder
				$fileDestination = $menuTable->imageCheck('image');
				$editedMenu = [
					'name' => $_POST['name'],
					'description' => $_POST['description'],
					'price' => $_POST['price'],
					'categoryId' => $_POST['categoryId'],
					'id' => $_POST['id'],
					'image_dir' => $fileDestination
				];
				//update menu table
				$menuTable->update($editedMenu, 'id');
				echo 'Dish saved';
			} else {
				echo 'Please fill in all the fields correctly';
			}
		} else {
	?>

			<h2>Edit Dish</h2>
			<?php
			foreach ($menuTable->select('id', $_GET["menu_id"]) as $record) {
			?>
				<form action="editMenu.php" method="POST" enctype="multipart/form-data">

					<input type="hidden" name="id" value="<?php echo $record['id']; ?>" />
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $record['name']; ?>" />

					<label>Description</label>
					<textarea name="description"><?php echo $record['description']; ?></textarea>

					<label>Price</label>
					<input type="text" name="price" value="<?php echo $record['price']; ?>" />
					<label>Image</label>
					<input type="file" name="image" />

					<label>Category</label>

					<select name="categoryId" value=''>
						<?php
						//query category table
						$stmt = $pdo->prepare('SELECT * FROM category');
						$stmt->execute();
						foreach ($stmt as $category) {
							if ($record['categoryId'] == $category['id']) {
								echo '<option selected="selected" value="' . $category['id'] . '">' . $category['name'] . '</option>';
							} else {
								echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
							}
						}

						?>
					</select>
					<input type="submit" name="submit" value="Save" />
				</form>
	<?php
			}
		}
	} else {
		echo header('location: ../login.php');
	} ?>
</section>
</main>
<?php
include '../app/footer.php';
