<?php
include "includes/database.php";
if( $_GET['id'] ) {
    $id = $_GET['id'];
    // echo "Detail page for $id";
    // get the product details from database
    $query = "
    SELECT 
    id,
    name,
    description,
    price,
    category,
    brand,
    image 
    FROM productdata WHERE id = ?";
    // send the query to the database
    $statement = $connection -> prepare($query);
    // bind the product id to the query
    $statement -> bind_param("i", $id );
    $statement -> execute();
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "fragment/head.php"; ?>
    <body>
        <?php include "fragment/header.php"; ?>
    </body>
</html>