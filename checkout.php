<?php
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";
//print_r($_POST);
if( $_SERVER['REQUEST_METHOD'] == 'POST'  ) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $product_name = $_POST['name'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    // construct query to insert orders
    $query = "
    INSERT INTO orders (customer_name,email,product_id,product_name,quantity,price)
    VALUES (?,?,?,?,?,?)";
    $statement = $connection -> prepare($query);
    $values = array();
    foreach( $id as $index => $product_id ) {
       $statement -> bind_param("ssisid",$customer_name,$email,$product_id,$product_name[$index],$quantity[$index],$price[$index] );
       $statement -> execute();
    }
    // empty the cart
    unset( $_SESSION['cart']);

}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>

<body>
    <?php include "fragment/header.php"; ?>
    <main class="content checkout-page">
        <h2>Thank you for your order</h2>
    </main>
    <?php include "fragment/footer.php"; ?>
</body>

</html>