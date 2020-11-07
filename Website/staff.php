<?php
    
    include("connection.php");

    
    if(isset($_GET['delete'])) {
            $stmt = $link->prepare('SET foreign_key_checks = 0');
           
            $stmt->execute();
            $stmt->close();
            
            
            $sql = "DELETE t1, t2, t3, t4 FROM Person AS t1 INNER JOIN Staff AS t2 ON t1.ID = t2.Staff_ID INNER JOIN Working_Day AS t3 ON t1.ID = t3.Worker_ID INNER JOIN $_GET[Position] AS t4 ON t1.ID = t4.Staff_ID WHERE t1.ID=$_GET[Staff_ID]";
        
            if($link->query($sql) == TRUE){
                echo "Staff member deleted succesfully";
            } else {
                echo "Error deleting record: $link->error";
            }
            
            $stmt = $link->prepare('SET foreign_key_checks = 1');
            
            $stmt->execute();
            $stmt->close();
            
            mysqli_free_result($delivery_person);
            mysqli_close($link); 
            
            header("Location: admin.php");
    }

?>

<hr>
<div class="staff_info">
<?php

    if(!isset($_GET['Staff_ID'])){
        header("Location:admin.php");
    }
    
    if($_GET['Position'] == "Delivery_Person"){
        
        $delivery_person = $link->query("SELECT * FROM Delivery_Person WHERE Staff_ID=$_GET[Staff_ID]");
        
        $row3 = $delivery_person->fetch_assoc();
    }


    $staff = $link->query("SELECT * FROM Person JOIN Staff ON Person.ID=Staff.Staff_ID WHERE ID=$_GET[Staff_ID]");
      
    $working_days = $link->query(" SELECT * FROM Staff JOIN Working_Day ON Staff.Staff_ID=Working_Day.Worker_ID WHERE Staff.Staff_ID=$_GET[Staff_ID]");
 
    $row = $staff->fetch_assoc();
   
    echo "<h3>$row[Forename] $row[Surname] (ID: $row[ID])</h3>";
    if($_GET['Position']=="Delivery_Person"){
        echo "<strong>Position</strong>: Delivery Person";
        echo "<br><strong>Vehicle</strong>: $row3[Vehicle]";
    }
    else {
        echo "<strong>Position</strong>: Cook";
    }
    
    echo "<br><strong>Salary</strong>: £$row[Salary] p.a.";
    
    
    echo "<br><strong>Working Days</strong>:";
    ?>
    <ul class="working_days">
    <?php
    while($row2 = $working_days->fetch_assoc()){
        echo "<li>$row2[Day]</li>";
    }
    ?>
    </ul>    
    <?php
        echo "Working from $row[Start_Time] to $row[End_Time]<br><br><strong>Date of Birth</strong>: $row[DOB]";
    ?>
    <p class="contact_title">
        <em>Contact</em>
    </p>
    <?php
        echo "<strong>Phone</strong>: $row[Telephone]<br><strong>Email</strong>: $row[Email]<br>";
    ?>
    <br>
    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=staff&Staff_ID=$_GET[Staff_ID]&Position=$_GET[Position]&edit=true"; ?>"><button>Edit</button></a> 
    
    <form action="admin.php?page=staff&Position=<?php echo $_GET['Position']; ?>&Staff_ID=<?php echo $_GET['Staff_ID']; ?>&delete=true" method="POST" onsubmit="return confirm('Are you sure you want to delete case?');">
        <!-- <input type="hidden" name="_METHOD" value="DELETE">
        <input type="hidden" name="id" value="<?php //echo $_GET[Staff_ID] ?>"> -->
        <button type="submit">Delete Case</button>
    </form>
    
    <br>
    
</div>
<?php
 
    mysqli_free_result($staff);
    mysqli_free_result($working_days);        
?>

<hr>
