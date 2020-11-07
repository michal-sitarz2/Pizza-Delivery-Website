<?php
    include("connection.php");
?>
<html>
    <head>
        <title>Add Staff</title>
    </head>
    
    <body>
    
        <haeder>
            <h2>Add Staff Member</h2>
            <p>Please enter all the correct information (some of this information will not be available for change)</p>
        </haeder>
        
        <?php
        if(isset($_POST['submit'])){
            if($_POST['position'] == "cook"){
                $result = $link->query("SELECT ID FROM Person WHERE ID LIKE \"2%\" ORDER BY ID DESC LIMIT 1");
                $profession = "Cook";
            } else {
                $result = $link->query("SELECT ID FROM Person WHERE ID LIKE \"1%\" ORDER BY ID DESC LIMIT 1");
                $profession = "Delivery Person";
            }
            
            $row = $result->fetch_assoc();
            $id_number = $row['ID']+1;
            
            $sql = "INSERT INTO Person VALUES($id_number,'$_POST[forename]', '$_POST[surname]', '$_POST[dob]', '$_POST[telephone]', '$_POST[email]')";
            
            if(mysqli_query($link, $sql)){
                mysqli_free_result($result);
                mysqli_close($link);
                echo "New worker added successfully";
                header("Location:worker_info.php?Profession=$profession&Staff_ID=$id_number");
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
            
        } 
        
        ?>
        
        <div class="add_form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            Forename: <input type="text" name="forename" required><br>
            Surname: <input type="text" name="surname" required><br>
            Email: <input type="email" name="email" required><br>
            Telephone: <input type="text" name="telephone" required><br>
            DOB: <input type="date" name="dob" required><br>
            Position: <br>
            <input type="radio" name="position" value="cook"> Cook <br>
            <input type="radio" name="position" value="delivery"> Delivery Person <br>
            <input type="submit" name="submit">
            <input type="reset" name="reset">
            
        </form>
            <a href="admin.php"><button name="back">Back</button></a>
        </div>
        
    </body>
</html>