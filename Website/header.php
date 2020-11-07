<?php
    
    include("connection.php");
    $categories = $link->query("SELECT DISTINCT Category FROM Item");

?>

<header>
    <div class="title">
        <h1 class="title">MR. Tomato Sauce</h1>
    </div>
    
    <div class="links">
        <?php
        if($categories->num_rows > 0){
            while($row = $categories->fetch_assoc()){
                echo "<a href=website.php?page=menu&Category=$row[Category]>$row[Category]</a> | ";
                    
            }
        } else {
            echo "0 results";
        }
            
        mysqli_free_result($categories);
        mysqli_close($link);
    ?>
    <a href=firstPage.html>Back</a>
    </div>
    
</header>


    <div id="shopping_cart_title">
        <p>
            <a href="website.php?page=cart">Shopping Cart [<?php echo $_SESSION['counter']; ?>]</a>
        </p>
    </div>