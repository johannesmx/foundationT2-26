<?php
include "includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>
<body>
   <?php include "fragment/header.php"; ?>
    <!-- carousel -->
    <div class="slideshow" data-flickity='{"cellAlign":"left","contain":true}'>
        <div class="slide">One</div>
        <div class="slide">Two</div>
        <div class="slide">Three</div>
        <div class="slide">Four</div>
        <div class="slide">Five</div>
    </div>
    <main class="content">
        <div class="products">
            <?php 
            $query = "SELECT id,name,brand,image FROM productdata";
            // statement
            $statement = $connection -> prepare($query);
            $statement -> execute();
            $products = array();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $products, $row );
            }
            // output products into page as html
            foreach( $products as $item ) {
                $id = $item['id'];
                $name = $item['name'];
                $brand = $item['brand'];
                $image = $item['image'];
                echo 
                "<div class='card'>
                    <a href='detail.php?id=$id'>
                        <img class='product-image' src='ProductImages/$image'>
                    </a>
                    <h4 class='product-name'>$name</h4>
                    <p class='product-brand'>$brand</p>
                    <a class='product-button' href='detail.php?id=$id'>
                        View Details
                    </a>
                </div>";
            }
            ?>
        </div>
    </main>
   <?php include "fragment/footer.php"; ?>
</body>
</html>