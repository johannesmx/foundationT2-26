<?php
include "includes/session.php";
include "includes/shopping_cart.php";
// handle adding of product to the cart
// get the data for the item to add
if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    // product id
    $id = $_POST['id'];
    // product price
    $price = $_POST['price'];
    // product quantity
    $quantity = $_POST['quantity'];
    // product as an object
    $product = array(
        "id" => $id,
        "price" => $price,
        "quantity" => $quantity
    );
    // add the product to cart
    array_push( $_SESSION['cart'], $product );
    // get the previous url (where the user came from)
    $source_page = $_SERVER['HTTP_REFERER'];
    // send the user back to source page
    header("location:".$source_page );
}
?>