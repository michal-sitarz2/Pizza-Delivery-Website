<hr>
<h3>Orders</h3>

<?php
    include("connection.php");

    $orders = $link->query("SELECT * FROM Customer AS t1 INNER JOIN Customer_Order AS t2 ON t1.Customer_ID=t2.Customer INNER JOIN Person AS t3 ON t1.Customer_ID=t3.ID WHERE t2.Order_Status='Being Prepared in the Kitchen'");

    echo "<h3>In the Kitchen</h3>";
    if($orders->num_rows > 0){
        while($row = $orders->fetch_assoc()){
            echo "<li><a href='admin.php?page=order_info&Customer=$row[Customer_ID]'>($row[Order_Number])</a> $row[Forename] $row[Surname] to  '$row[Address]'</li>";
        } 
    } else {
        echo "There are no orders";
    }


    $orders = $link->query("SELECT * FROM Customer AS t1 INNER JOIN Customer_Order AS t2 ON t1.Customer_ID=t2.Customer INNER JOIN Person AS t3 ON t1.Customer_ID=t3.ID WHERE t2.Order_Status='Being Delivered'");

    echo "<h3>Being Delivered</h3>";
    if($orders->num_rows > 0){
        while($row = $orders->fetch_assoc()){
            echo "<li><a href='admin.php?page=order_info&Customer=$row[Customer_ID]'>($row[Order_Number])</a> $row[Forename] $row[Surname] to  '$row[Address]'</li>";
        } 
    } else {
        echo "There are no orders";
    }
    

    $orders = $link->query("SELECT * FROM Customer AS t1 INNER JOIN Customer_Order AS t2 ON t1.Customer_ID=t2.Customer INNER JOIN Person AS t3 ON t1.Customer_ID=t3.ID WHERE t2.Order_Status='Done'");
    echo "<h3>Order History:</h3>";
    if($orders->num_rows > 0){
        while($row = $orders->fetch_assoc()){
            echo "<li><a href='admin.php?page=order_info&Customer=$row[Customer_ID]'>($row[Order_Number])</a> $row[Forename] $row[Surname] to '$row[Address]'</li>";
        } 
    } else {
        echo "There are no orders";
    }

    mysqli_free_result($orders);

?>