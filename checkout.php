<?php
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";

if( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'checkout' ) {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>

<body>
    <?php include "fragment/header.php"; ?>
    <main class="content">
        </main>
    <?php include "fragment/footer.php"; ?>
</body>

</html>