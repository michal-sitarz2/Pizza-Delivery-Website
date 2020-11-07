<?php
    include("connection.php");

    $profession = $_GET['Profession'];
    $staff_id = $_GET['Staff_ID'];

?>
<html>
    <head>
        <title>Information about Staff</title>
    </head>
    
    <body>
        <header>
            <h2>Add Staff Member</h2>
        </header>
        
        <?php
            
        if(isset($_POST['submit'])){
            
            if($_POST[salary] > 10000 && $_POST[salary]<100000){
                $sql_staff = "INSERT INTO Staff VALUES($staff_id, '$_POST[start_time]:00', '$_POST[end_time]:00', $_POST[salary])";
            
                if(mysqli_query($link, $sql_staff)){
                    echo "New staff member added<br>";
                } else {
                    echo "Error: " . $sql_staff . "<br>" . $link->error;
                }    

                if($profession == "Cook"){
                    $sql_worker = "INSERT INTO Cook (Staff_ID) VALUES($staff_id)";
                } else {
                    $sql_worker = "INSERT INTO Delivery_Person VALUES($staff_id, '$_POST[vehicle]')";
                }

                if(mysqli_query($link, $sql_worker)){
                    echo "New staff member added<br>";
                } else {
                    echo "Error: " . $sql_worker . "<br>" . $link->error;
                }    


                foreach($_POST['days'] as $day){
                    $sql_day = "INSERT INTO Working_Day VALUES ($staff_id, '$day')";

                    if(mysqli_query($link, $sql_day)){
                        echo "Added Successfully<br>";
                    } else {
                        echo "Error: " . $sql_day . "<br>" . $link->error;
                    }       
                }
                
                mysqli_close($link);
                header("Location:admin.php");

                
                
            } else { 
                
                echo "The salary is not within given range";
                
            }
            
                
    } 
    ?>
    
        <br>
        <div class="add_form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?Profession=$_GET[Profession]&Staff_ID=$_GET[Staff_ID]"; ?>" method="post">
            Salary(£): <input type="number" name="salary" min="0" required><br>
            Start Hour: <input type="time" name="start_time" required><br>
            End Hour: <input type="time" name="end_time" required><br>
            Working Days: <br>
            <input type="checkbox" name="days[]" value="Monday">Monday<br>
            <input type="checkbox" name="days[]" value="Tuesday">Tuesday<br>    
            <input type="checkbox" name="days[]" value="Wednesday">Wednesday<br>    
            <input type="checkbox" name="days[]" value="Thursday">Thursday<br>    
            <input type="checkbox" name="days[]" value="Friday">Friday<br>    
            <input type="checkbox" name="days[]" value="Saturday">Saturday<br>    
            <input type="checkbox" name="days[]" value="Sunday">Sunday<br><br>
            <?php if($profession == "Delivery Person"){?>
                    Vehicle: <br> 
                    <input type="radio" name="vehicle" value="Honda Civic Coupe 5th Generation"> Honda Civic Coupe 5th Generation<br>
                    <input type="radio" name="vehicle" value="Roketa 150cc 06"> Roketa 150cc 06<br>
                    <input type="radio" name="vehicle" value="Keeway Kee 125 E3"> Keeway Kee 125 E3
            <?php } ?>
            <br><br>
            <input type="submit" name="submit">
        </form>
        </div>
    </body>
</html>