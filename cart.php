<?php
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";

$items = array();
if( isset($_SESSION['cart']) ) {
    $items = $_SESSION['cart'];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>
<body>
   <?php include "fragment/header.php"; ?>
   <main class="content">
    <?php 
        // iterate through the item ids and get the details from database
        $item_ids = array();
        foreach( $items as $item ) {
            array_push( $item_ids, $item['id']);
        }
        // create a query to select items from database
        $query = "
        SELECT 
        id,name,price,image
        FROM productdata WHERE id IN (?)";
        // send the query to the database
        $statement = $connection -> prepare($query);
        $ids = implode("," , $item_ids );
        $statement -> bind_param("s", $ids );
        $statement -> execute();
        $cart_items = array();
        $result = $statement -> get_result();
        while( $row = $result -> fetch_assoc() ) {
            array_push( $cart_items, $row );
        }
        print_r($cart_items);
        // show products on the page
        foreach( $cart_items as $item ) {
            $id = $item['id'];
            $name = $item['name'];
            $price = $item['price'];
            $image = $item['image'];

            echo "
            <div>
                <h4>$name</h4>
            </div>
            ";
        }
    ?>
   </main>
    <?php include "fragment/footer.php"; ?>
</body>
</html>