<?php
    include("connection.php");
    
    if(isset($_POST['submit'])){
        $customer = $link->query("SELECT ID FROM Person WHERE Forename='$_POST[name]' AND Surname='$_POST[surname]' AND DOB='$_POST[dob]' AND Email='$_POST[email]' AND Telephone='$_POST[telephone]'"); 
        
        if($customer->num_rows > 0){

            header("Location:website.php?page=paying_info&Customer_ID=$row[ID]&edit=true"); 
                 
        } else {
            
            $customers = $link->query("SELECT ID FROM Person WHERE ID>9100 AND ID LIKE '1%' ORDER BY ID DESC LIMIT 1");
            
            if($customers->num_rows > 0){
                $row1_customers = $customers->fetch_assoc();
                $next_id = $row1_customers['ID'] + 1;
            } else {
                $next_id= 10000;
            }
           
            $insert_sql = "INSERT INTO Person VALUES ($next_id, '$_POST[name]', '$_POST[surname]', '$_POST[dob]', '$_POST[telephone]', '$_POST[email]')";
            
             if ($link->query($insert_sql) === TRUE) {
                mysqli_free_result($customers);
                mysqli_free_result($customer);
                mysqli_close($link);    
                header("Location:website.php?page=paying_info&Customer_ID=$next_id");
                    
            } else {
                    echo "Error updating record: " . $link->error;
            }       
        }
    }
    
?>

<div class="confirmation_form">
    <form action="website.php?page=confirm" method="POST">
        Name: <input type="text" name="name"><br>
        Surname: <input type="text" name="surname"><br>
        DOB: <input type="date" name="dob"><br>
        Email: <input type="email" name="email"><br>
        Telephone: <input type="text" name="telephone"><br>
        <input type="submit" name="submit">
    </form>
</div>