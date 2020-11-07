<?php
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $salary = $_POST['salary'];
        $start_time = $_POST['start_time'] . ":00";
        $end_time = $_POST['end_time'] . ":00";
        
        
        if($_GET['Position'] == "Delivery_Person"){
            $vehicle = $_POST['vehicle'];
            
            $vehicle_edit = "UPDATE Delivery_Person SET Vehicle='$vehicle' WHERE Staff_ID=$_GET[Staff_ID]";
            
            if ($link->query($vehicle_edit) === TRUE) {
                echo "Vehicle Changed<br>";
            } else {
                echo "Error updating record: " . $link->error;
            }
        }
        
        $person_edit = "UPDATE Person SET Email='$email', Telephone='$telephone' WHERE ID=$_GET[Staff_ID]";
        
        if ($link->query($person_edit) === TRUE) {
            echo "Person Changed<br>";
        } else {
            echo "Error updating record: " . $link->error;
        }
        
        
        $staff_edit = "UPDATE Staff SET Start_Time='$start_time', End_Time='$end_time', Salary=$salary WHERE Staff_ID= $_GET[Staff_ID]";
        
        if ($link->query($staff_edit) === TRUE) {
                echo "Staff Changed<br>";
            } else {
                echo "Error updating record: " . $link->error;
        }
        
        if(count($_POST['days']) > 0){
            $stmt = $link->prepare('SET foreign_key_checks = 0');
            $stmt->execute();
            $stmt->close();
            $delete = "DELETE FROM Working_Day WHERE Worker_ID=$_GET[Staff_ID]";
        
            if($link->query($delete) == TRUE){
                echo "Staff member deleted succesfully";
            } else {
                echo "Error deleting record: $link->error";
            }
            
            $stmt = $link->prepare('SET foreign_key_checks = 1');
            $stmt->execute();
            $stmt->close(); 
            
            foreach($_POST['days'] as $day){
                $day_edit = "INSERT INTO Working_Day VALUES($_GET[Staff_ID], '$day')";
                
                $link->query($day_edit);
                
            }
            
            header("Location:admin.php");
            
        }
        
?>
        
    