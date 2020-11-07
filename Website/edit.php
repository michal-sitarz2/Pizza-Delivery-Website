<?php
    $staff = $link->query("SELECT * FROM Person AS t1 INNER JOIN Staff AS t2 ON t1.ID = t2.Staff_ID INNER JOIN Working_Day AS t3 ON t1.ID = t3.Worker_ID INNER JOIN $_GET[Position] AS t4 ON t1.ID = t4.Staff_ID WHERE t1.ID=$_GET[Staff_ID]");
    
    $days_sql = $link->query("SELECT Day FROM Working_Day WHERE Worker_ID=$_GET[Staff_ID]");
        
    $row = $staff->fetch_assoc();
    $days;
    $i=0;
    while($rows = $days_sql->fetch_assoc()){
        $days[$i] = $rows['Day'];
        $i += 1;
    }

    function checkSelected($day, $days){
        if(in_array($day, $days)){
            echo "checked";
        }
    }
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=staff&Staff_ID=$_GET[Staff_ID]&Position=$_GET[Position]&edit=done";?>" method="POST">
    Email: <input type="email" name="email" value="<?php echo $row['Email']; ?>"><br>
    Telephone: <input type="text" name="telephone" value="<?php echo $row['Telephone']; ?>"><br>
    Start Time: <input type="time" name="start_time" value="<?php echo $row['Start_Time'];?>">
    End Time: <input type="time" name="end_time" value="<?php echo $row['End_Time'];?>"><br>
    Salary: <input type="number" min="0" name="salary" value="<?php echo $row['Salary'];?>"> <br><br>
    Working Days: <br>
        <input type="checkbox" name="days[]" value="Monday" <?php checkSelected("Monday", $days);?>>Monday<br>
        <input type="checkbox" name="days[]" value="Tuesday" <?php checkSelected("Tuesday", $days);?>>Tuesday<br>    
        <input type="checkbox" name="days[]" value="Wednesday" <?php checkSelected("Wednesday", $days);?>>Wednesday<br>    
        <input type="checkbox" name="days[]" value="Thursday" <?php checkSelected("Thursday", $days);?>>Thursday<br>    
        <input type="checkbox" name="days[]" value="Friday" <?php checkSelected("Friday", $days);?>>Friday<br>    
        <input type="checkbox" name="days[]" value="Saturday" <?php checkSelected("Saturday", $days);?>>Saturday<br>    
        <input type="checkbox" name="days[]" value="Sunday" <?php checkSelected("Sunday", $days);?>>Sunday<br><br>
    <?php if($_GET['Position'] == "Delivery_Person"){?>
        Vehicle: <br> 
        <select name="vehicle">
            <option value="Honda Civic Coupe 5th Generation" <?php if($row['Vehicle'] == "Honda Civic Coupe 5th Generation"){echo "selected";}?>> Honda Civic Coupe 5th Generation</option>
            <option value="Roketa 150cc 06" <?php if($row['Vehicle'] == "Roketa 150cc 06"){echo "selected";}?>> Roketa 150cc 06</option>
            <option value="Keeway Kee 125 E3" <?php if($row['Vehicle'] == "Keeway Kee 125 E3"){echo "selected";}?>> Keeway Kee 125 E3 </option>
        </select>
    <?php } ?> <br><br>
    <input type="submit" name="submit">
</form>

<?php
    mysqli_free_result($days_sql);
    mysqli_free_result($staff);
    mysqli_close($link);  
?>