<?php
// create the shopping cart if it does not exist
if( !isset($_SESSION['cart'] ) ) {
    $_SESSION['cart'] = array();
}
?>