<?php
    $link = mysqli_connect("localhost", "root", "", "delivery_system_cw");
        
    if ($link->connect_error){
        die("Connection Failed: " . $conn-> connect_error);
    }

?>