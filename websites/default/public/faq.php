<?php
include 'app/header.php';
//session check
if (isset($_SESSION['user'])) {
    include 'app/sidebar-admin.php';
} else {
    include 'app/sidebar-user.php';
}
?>

<h1>FAQs COMING SOON</h1>
</section>
</main>
<?php
include 'app/footer.php';
?>