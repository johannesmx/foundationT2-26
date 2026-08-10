<?php
include "includes/session.php";
include "includes/shopping_cart.php";
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
    productdata.id AS pid,
    productdata.name AS pname,
    productdata.description AS description,
    price,
    category AS cid,
    brand,
    image,
    category.name AS cname
    FROM productdata 
    INNER JOIN category
    ON productdata.category = category.id
    WHERE productdata.id = ?";
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
    $id = $product[0]['pid'];
    $name = $product[0]['pname'];
    $description = $product[0]['description'];
    $price = $product[0]['price'];
    $category = $product[0]['cname'];
    $brand = $product[0]['brand'];
    $image = $product[0]['image'];
    $categoryid = $product[0]['cid'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "fragment/head.php"; ?>
    <body>
        <?php include "fragment/header.php"; ?>
        <main class="content detail">
            <div class="product-detail">
                <img class="product-image" src="ProductImages/<?php echo $image; ?>" >
                <div>
                    <h2 class="name"><?php echo $name; ?></h2>
                    <?php 
                        echo "<p class='description'>$description</p>";
                        echo "<p>Brand <span class='brand'>$brand</span></p>";
                        echo "<p class='category-name'>$category</p>";
                        echo "<p class='price'>$price</p>";
                        echo "
                        <form action='addtocart.php' method='post'>
                            <input name='price' readonly type='hidden' value='$price'>
                            <input name='id' readonly type='hidden' value='$id'>
                            <div class='detail-group'>
                                <input name='quantity' type='number' value='1' min='1' step='1'>
                                <button type='submit' class='cart-button'>
                                    Add to cart
                                </button>
                            </div>
                        </form>";
                    ?>
                </div>
            </div>
            
        </main>
        <?php include "fragment/footer.php"; ?>
    </body>
</html>