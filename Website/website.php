<?php

    session_start();
    
    if(!isset($_GET['page'])){
        $_SESSION['counter'] = 0;
        $_SESSION['order'] = array();
    }    

    if(isset($_GET['Item'])){
        
        if(array_key_exists("$_GET[Item]", $_SESSION['order'])){
            $_SESSION['order']["$_GET[Item]"] += 1;
        } else {
            $_SESSION['order']["$_GET[Item]"] = 1;
        }
        $_SESSION['counter'] += 1;
        
        }

    
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Mr. Tomato Sauce - Delivery System</title>
    </head>
    
    <body>
       
        <?php
            include("header.php");
        ?>
        
        <div class="menu">
            <p>
            <?php
                if(!isset($_GET['page'])){
                    echo "Home Page";
                }
                else {
                    $page = $_GET['page'];
                    include("$page.php");
                }
            ?>
            </p>
            
        </div>
        
        <?php
            include("footer.php");
        ?>
    
    </body>    

</html>

