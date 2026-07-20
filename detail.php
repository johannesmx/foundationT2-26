<?php
include "includes/database.php";
if( !isset($_GET['id'] ) ) {
    echo "Product id is required. Go to <a href='/'>Home</a> and select a product";
    die();
}
else {
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
    // get the result from the query
    $result = $statement -> get_result();
    $product = array();
    $row = $result -> fetch_assoc();
    array_push( $product, $row );
    $id = $product[0]['id'];
    $name = $product[0]['name'];
    $description = $product[0]['description'];
    $price = $product[0]['price'];
    $category = $product[0]['category'];
    $brand = $product[0]['brand'];
    $image = $product[0]['image'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "fragment/head.php"; ?>
    <body>
        <?php include "fragment/header.php"; ?>
        <main class="content">
            <div class="product-detail">
                <img class="product-image" src="ProductImages/<?php echo $image; ?>" >
                <div>
                    <h2 class="name"><?php echo $name; ?></h2>
                    <?php 
                        echo "<p class='description'>$description</p>";
                        echo "<p>Brand <span class='brand'>$brand</span></p>";
                        echo "<p>$category</p>";
                        echo "<p class='price'>$price</p>";
                        echo "
                        <form>
                            <input readonly type='hidden' value='$price'>
                            <input type='number' value='1' min='1' step='1'>
                            <button class='cart-button'>
                                Add to cart
                            </button>
                        </form>";
                    ?>
                </div>
            </div>
            
        </main>
    </body>
</html>