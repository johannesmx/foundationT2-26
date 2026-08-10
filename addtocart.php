<?php
include  "includes/session.php";
include  "includes/shopping_cart.php";
include "includes/database.php";
$source_page = $_SERVER['HTTP_REFERER'];
// get cart data
$id = $_POST['id'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$product = array("id" => $id, "price" => $price, "quantity" => $quantity);
array_push($_SESSION['cart'], $product);
header("location:" . $source_page );
?>