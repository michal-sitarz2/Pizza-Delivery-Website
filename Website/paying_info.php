<?php
    include("connection.php");

    if(isset($_POST['submit'])){
        
        $card_length = strlen((string)$_POST['card_number']);
        echo $card_length;
        if($card_length == 16){
          $customer_add = "INSERT INTO Customer VALUES($_GET[Customer_ID], '$_POST[address]', $_POST[card_number], '$_POST[card_type]')";
    
            mysqli_query($link, $customer_add);
        
            header("Location:website.php?page=paying_info&Customer_ID=$_GET[Customer_ID]&edit=true");  
        } else {
            echo "The card number has to be 16 digits exactly";
        }
        
        
        
    }

    if(!isset($_GET['edit'])){ ?>
        <form action="website.php? <?php echo "page=paying_info&Customer_ID=$_GET[Customer_ID]"; ?>" method="POST">
            Address: <input type="text" name="address"><br>
            Credit Card Number: <input type="number" name="card_number" min="0" required><br>
            Credit Card Type: <br>
            <input type="radio" name="card_type" value="Visa"> Visa<br> 
            <input type="radio" name="card_type" value="Mastercard">Mastercard<br>
            <input type="radio" name="card_type" value="Discover">Discover<br>
            <input type="radio" name="card_type" value="American Express">American Express<br>
            <input type="submit" name="submit">
        </form>

    <?php } else {
        date_timezone_set('Europe/London');
        $time = date("H:i");
        $customer_order = "INSERT INTO Customer_Order (Order_Size, Time_Ordered, Total_Price, Customer) VALUES ($_SESSION[counter], '$time:00', $_SESSION[total_price], 
        $_GET[Customer_ID]);";
        
        mysqli_query($link, $customer_order);
        
        
        $order = $link->query("SELECT Order_Number FROM Customer_Order ORDER BY Order_Number DESC LIMIT 1");
        $row = $order->fetch_assoc();
        
        
        foreach($_SESSION['order'] as $item => $quantity){
            
            
            $item_ordered = "INSERT INTO Item_Order VALUES ('$item', $row[Order_Number], $quantity)";
             
            mysqli_query($link, $item_ordered);
        
        }
        
        session_unset();
        session_destroy();
        
        
        mysqli_free_result($order);
        mysqli_close($link);
        
        header("Location:firstPage.html");
    }

?>