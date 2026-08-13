<?php
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";

// process cart update and delete
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) ) {
    // the action to be performed, read from the button value ie remove/update
    $action = $_POST['action'];
    // get the id of the item to be removed
    $id = $_POST['id'];
    
    if( $action == 'update') {
        $index = 0;
        foreach( $_SESSION['cart'] as $item ) {
            if($item['id'] === $id ) {
                $_SESSION['cart'][$index]['quantity'] = $_POST['quantity'];
            }
        }
    }
    // foreach( $_SESSION['cart'] as $index => $cart_item ) {
    //     if( $cart_item['id'] == $id && $action == 'remove') {
    //         //unset( $_SESSION['cart'][$index]);
            
    //     }
    //     else if( $cart_item['id'] == $id && $action == 'update') {
    //         $_SESSION['cart'][$index]['quantity'] = $_POST['quantity'];
            
    //     }
    // }
    //array_values($_SESSION['cart']);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>

<body>
    <?php include "fragment/header.php"; ?>
    <main class="content">
        <div class="cart-items">
            <?php
            // function sortCartItemsById($a,$b) {
            //     if($a['id'] > $b['id']) {
            //         return 1;
            //     }
            //     else {
            //         return 0;
            //     }
            // }
            // when there's more than 0 items
            if (count($_SESSION['cart']) > 0) {
                // sort the array
                // usort( $_SESSION['cart'], 'sortCartItemsById');
                // print_r( $_SESSION['cart']);
                // iterate through the item ids and get the details from database
                $item_ids = array();
                foreach ($_SESSION['cart'] as $item) {
                    array_push($item_ids, $item['id']);
                }
                //print_r($item_ids);
                //create a parameter argument for database query
                $params = array();
                foreach ($item_ids as $id) {
                    array_push($params, "?");
                }
                $query_params = implode(",", $params);

                // create a query to select items from database
                $query = "
                    SELECT 
                    id,name,price,image
                    FROM productdata WHERE id IN (" . $query_params . ")
                    ";
                $result = $connection -> execute_query($query, $item_ids);
                $result_items = array();
                foreach( $result as $index => $row ) {
                    // modify $row to include quantity from cart in session
                    $row['quantity'] = $_SESSION['cart'][$index]['quantity'];
                    // echo "index: $index";
                    array_push($result_items,$row);
                }
                // print the html to show the user
                foreach( $result_items as $item ) {
                    $id = $item['id'];
                    $name = $item['name'];
                    $price = $item['price'];
                    $quantity = $item['quantity'];
                    $image = $item['image'];
                    // output rows for products
                    echo 
                    "
                    <div class='cart-item-row'>
                        <a href='detail.php?id=$id'>
                        <img class='cart-item-image' src='ProductImages/$image'>
                        </a>
                        <div>
                            <h4 class='cart-item-name'>$name</h4>
                            <p class='cart-item-price'>$price</p>
                        </div>
                        <form method='post' action='cart.php' class='cart-item-form'>
                            <span>Quantity</span>
                            <input name='id' type='hidden' value='$id'>
                            <input name='quantity' type='number' value='$quantity' min='1' max='99'>
                            <button name='action' type='submit' value='update'>&#8635;</button>
                            <button name='action' type='submit' value='remove'>&times;</button>
                        </form>
                    </div>
                    <hr class='cart-item-divider'>
                    ";
                }
                
            }
            else {
                // print the empty cart message
                echo "
                <div class='cart-empty'>
                    <h2>You have no items in your cart. <a href='index.php'>Go shopping?</a></h2>
                </div>";
            }
            ?>
            <div class="checkout">
                <form id="checkout-form" method="post" action="checkout.php">
                    <?php 
                    $total = 0;
                    foreach( $result_items as $item ) {
                        $id = $item['id'];
                        $quantity = $item['quantity'];
                        $price = $item['price'];
                        $name = $item['name'];
                        $total = $total + $price * $quantity;
                        echo "
                        <input name='id[]' value='$id' type='hidden'>
                        <input name='name[]' value='$name' type='hidden'>
                        <input name='quantity[]' value='$quantity' type='hidden'>
                        <input name='price[]' value='$price' type='hidden'>
                        ";
                    }
                    ?>
                    <div class="checkout-grid">
                        <div class="checkout-group">
                            <label for="customer-name">Your Name</label>
                            <input type="text" name="customer_name" placeholder="Your Name" required>
                        </div>
                        <div class="checkout-group">
                            <label for="customer-name">Your Email</label>
                            <input type="text" name="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="checkout-btn-group">
                        <div>Total <span class="price checkout-total"><?php echo $total; ?></span></div>
                        <button class="checkout-button" type="submit" name="action" value="checkout">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include "fragment/footer.php"; ?>
</body>

</html>