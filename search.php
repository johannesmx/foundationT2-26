<?php
// echo "search";
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";

if( isset( $_GET['query'] ) ) {
    $search_query = $_GET['query'];
}
else {
    die("Search query needed");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>
<body>
   <?php include "fragment/header.php"; ?>
   <main class="content">
        <?php
            $query = "
            SELECT 
            id,name,brand,image 
            FROM productdata 
            WHERE name LIKE ?";
            $statement = $connection -> prepare($query);
            $param = "%".$search_query."%";
            $statement -> bind_param("s", $param);
            $statement -> execute();
            $result = $statement -> get_result();
            $search_result = array();
            while( $row = $result -> fetch_assoc() ) {
                array_push($search_result,$row);
            }
            // output as HTML
            foreach( $search_result as $item ) {
                $id = $item['id'];
                $name = $item['name'];
                $brand = $item['brand'];
                $image = $item['image'];
                echo "  <div class='search-row'>
                            <img class='search-image' src='ProductImages/$image'>
                            <div>
                                <h4 class='search-title'>$name</h4>
                                <p class='search-brand'>$brand</p>
                                <a class='search-link' href='detail.php?id=$id'>View Detail</a>
                            </div>
                        </div>";
            }
        ?>
   </main>
   <?php include "fragment/footer.php"; ?>
</body>
</html>