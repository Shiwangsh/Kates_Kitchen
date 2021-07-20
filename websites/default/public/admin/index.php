<?php
include '../app/header.php';

?>
<main class="sidebar">



	<?php
	if (isset($_POST['submit'])) {
		if ($_POST['password'] == 'letmein') {
			$_SESSION['user'] = true;
		}
	}


	if (isset($_SESSION['user'])) {
		include '../app/sidebar-admin.php';
	?>



		<section class="right">
			<h2>You are now logged in</h2>
			<a href="logout.php">Log out</a>
		</section>
	<?php
	} else {
	?>
		<h2>Log in</h2>

		<form action="index.php" method="post" style="padding: 40px">

			<label for="username">Enter Username</label>
			<input type="text" name="Username">
			<label for="password">Enter password</label>
			<input type="password" name="password" />

			<input type="submit" name="submit" value="Log In" />
		</form>
	<?php
	}
	?>


</main>

<?php
include '../app/footer.php';
?>