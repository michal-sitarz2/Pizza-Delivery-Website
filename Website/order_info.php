<hr>
<?php
    include("connection.php");

    if(isset($_POST['submit1'])){
        
        $order_edit = "UPDATE Customer_Order SET Delivery_ID=$_POST[delivery], Order_Status='Being Delivered' WHERE Customer=$_GET[Customer]";
            
        $link->query($order_edit);
        
        header("Location: admin.php");
    }

    if(isset($_GET['order'])){
       $status_edit = "UPDATE Customer_Order SET Order_Status='Done' WHERE Customer=$_GET[Customer]";
            
        $link->query($status_edit);
        
        header("Location: admin.php");
    }

    $customer = $link->query("SELECT Forename, Surname, ID FROM PERSON WHERE ID=$_GET[Customer]");
        
    $customer_row = $customer->fetch_assoc();

    echo "<h3>$customer_row[Forename] $customer_row[Surname] (ID: $customer_row[ID])</h3>";
    
    $customer_orders = $link->query("SELECT * FROM Customer AS t1 INNER JOIN Customer_Order AS t2 ON t1.Customer_ID=t2.Customer INNER JOIN Person AS t3 ON t1.Customer_ID=t3.ID WHERE Customer_ID=$_GET[Customer]");


    while($order_rows = $customer_orders->fetch_assoc()){
        
            echo "Pending orders:<br>(Order Number: $order_rows[Order_Number]) Customer: $order_rows[Forename] $order_rows[Surname], Telephone: $order_rows[Telephone], Email: $order_rows[Email] , Size of the order: $order_rows[Order_Size], Total Price: $order_rows[Total_Price], Address: $order_rows[Address], Time Ordered: $order_rows[Time_Ordered]";
    
            echo "<br><strong>Items Ordered: </strong><br>";
            
            $items_ordered = $link->query("SELECT Item_Name, Quantity FROM Item_Order WHERE Order_Number=$order_rows[Order_Number]");
            
            while($row_item = $items_ordered->fetch_assoc()){
                echo "<li>$row_item[Item_Name] (Quantity: $row_item[Quantity])</li>";
            }
            
            echo "<br><br>";
            
        if($order_rows['Order_Status'] == "Being Prepared in the Kitchen"){
            echo "<form action='admin.php?page=order_info&Customer=$_GET[Customer]' method='POST'><select name='delivery'>"; 
            
            $delivery_people = $link->query('SELECT ID, Forename, Surname FROM Person WHERE ID LIKE \'1%\' AND ID<2000');
            
            while($row = $delivery_people->fetch_assoc()){
                echo "<option value=\"$row[ID]\">$row[Forename] $row[Surname]</option>";
            }
            echo "</select><input type='submit' name='submit1'><br></form>"; 
        }
        else if($order_rows['Order_Status'] == "Being Delivered"){
            echo "<a href='admin.php?page=order_info&Customer=$_GET[Customer]&order=delivered'><button>Delivered!</button></a>";
        } 
       
    }

    mysqli_free_result($delivery_people);
    mysqli_free_result($customer);
    mysqli_free_result($customer_orders);
    mysqli_free_result($items_ordered);
    mysqli_close($link);  
?>

<a href="admin.php?page=manage_orders"><button>Back</button></a>
    
