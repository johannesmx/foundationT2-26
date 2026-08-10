<?php
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";
// check the category requested
if( isset($_GET['category'])) {
    $category = $_GET['category'];
}
else {
    die("No category selected");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>

<body>
    <?php include "fragment/header.php"; ?>
    <main class="content">
        <div class="products">
            <?php
            $query = "SELECT id,name,brand,image FROM productdata WHERE category=?";
            // statement
            $statement = $connection->prepare($query);
            // insert category into the query
            $statement -> bind_param("i", $category );
            $statement->execute();
            $products = array();
            $result = $statement->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($products, $row);
            }
            // output products into page as html
            foreach ($products as $item) {
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