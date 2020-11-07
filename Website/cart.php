<?php
    include("connection.php");
?>
<div class="order_info">
    <?php
        $total_price = 0;
    
        
        foreach($_SESSION['order'] as $item => $quantity){
            $items = $link->query("SELECT * FROM Item WHERE Name='$item'");
            $order = $items->fetch_assoc();
            $price = $order['Price'] * $quantity;
            echo "<p class='items_ordered'>$item ($order[Category]) --> £$price (Quantity = $quantity)</p>";
            $total_price += $price;
            mysqli_free_result($items);
        }
    ?>
    <p class="final_order_price">
        <?php echo "Total Price : £" . $total_price; ?>
    </p>
    
    <?php
        $_SESSION['total_price'] = $total_price;
    ?>
    
    <a href="website.php?page=confirm"><button onClick="return confirm('Do you wish to confirm the order?')">Confirm Order</button></a>
</div>

<?php
    
    mysqli_close($link);
?>

