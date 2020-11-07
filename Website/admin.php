<?php

    include("connection.php");
    
    $admin = $link->query("SELECT Forename FROM Person WHERE ID=9100");

    $row = $admin->fetch_assoc();
    $forename = $row['Forename'];

    $delivery_people = $link->query("SELECT * FROM PERSON WHERE EXISTS (SELECT * FROM STAFF WHERE Person.ID = Staff.Staff_ID) and ID LIKE '1%'"); 

    $cooks = $link->query("SELECT * FROM PERSON WHERE EXISTS (SELECT * FROM STAFF WHERE Person.ID = Staff.Staff_ID) and ID LIKE '2%'");
    
    if(isset($_GET['edit'])){
        if($_GET['edit']=="done"){
            include("editor.php");
        }
    }
    
?>

<html>
    <head>
        <title>Admin</title>
    </head>
    
    <body>

        <h1>Welcome <?php echo $forename?></h1>

        <a href="admin.php?page=manage_orders"><button>Manage Orders</button></a>
        
        <a href="add_staff.php"><button>Add Staff</button></a>
        
        <a href="firstPage.html"><button onclick="return confirm('Do you wish to confirm the order?')">Log Out</button></a>
        
        <h3>Delivery People</h3>
        <div class="workers_table">
            <table class="delivery_people_table">
            <tr>
                <th>Name</th> 
                <th>Surname</th> 
                <th>ID</th>
            </tr>
            <?php
            if($delivery_people->num_rows > 0){
                while($row = $delivery_people->fetch_assoc()){ 
                    
                    echo "<tr><td><a href=\"admin.php?page=staff&Staff_ID=$row[ID]&Position=Delivery_Person\">$row[Forename]</a></td><td>$row[Surname]</td><td>$row[ID]</td></tr>";
                }
            } else {
                echo "0 workers at the moment";
            }
            ?>
            </table>
            
            <h3>Cooks</h3>
            <table class="cooks_table">
            <tr>
                <th>Name</th> 
                <th>Surname</th> 
                <th>ID</th>
            </tr>
            <?php
            if($cooks->num_rows > 0){
                while($row = $cooks->fetch_assoc()){ 
                      echo "<tr><td><a href=\"admin.php?page=staff&Staff_ID=$row[ID]&Position=Cook\">$row[Forename]</a></td><td>$row[Surname]</td><td>$row[ID]</td></tr>";
                }
            } else {
                echo "0 workers at the moment";
            }
            ?>
            </table>
        </div>
        
        <div>
            <p>
            <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    include("$page.php");
                }
            ?>
            </p>
        </div>
        
        <br>
        <div class="worker_profile_edit">
            <p>
            <?php
                if(isset($_GET['edit'])){
                    include("edit.php");
                }
            ?>
            </p>
        </div>
    </body>
    <?php
        mysqli_free_result($admin);
        mysqli_free_result($cooks);
    ?>
</html>