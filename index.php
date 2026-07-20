<?php
include "includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progear Hub Home Page</title>
    <link href="styles.css" rel="stylesheet">
    <link href="ProgearHub_Logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</head>
<body>
    <header class="header">
        <img class="logo" src="ProgearHub_Logo.png">
        <form class="search" method="get" action="search">
            <input type="search" placeholder="search for a product">
        </form>
        <nav class="user-nav">
            <a href="favourites.html">
                <i class="fa-solid fa-heart"></i>
            </a>
            <a href="cart.html">
                <i class="fa-solid fa-bag-shopping"></i>
            </a>
        </nav>
        <nav class="navigation">
            <a href="men.html">Men</a>
            <a href="women.html">Women</a>
            <a href="kids.html">Kids</a>
            <a href="accessories.html">Accessories</a>
        </nav>
    </header>
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
                    <img class='product-image' src='ProductImages/$image'>
                    <h4 class='product-name'>$name</h4>
                    <p class='product-brand'>$brand</p>
                    <a href='detail.php?id=$id'>Read More</a>
                </div>";
            }
            ?>
        </div>
    </main>
</body>
</html>