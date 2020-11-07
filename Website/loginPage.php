<?php
    include("connection.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="delivery_system_cw_1.css">
        <title>Welcome to Mr. Tomato Sauce</title>
    </head>
    
    <body>
        <header>
            <h1>Welcome Admin</h1>
            <p>Please enter valid information</p>
        </header>
        
        <?php   
            $result = $link->query("SELECT * FROM Person WHERE ID=9100");
            
            $row=$result->fetch_assoc();

            if(!empty($_POST['id']) && !empty($_POST['date']) && !empty($_POST['email']) && isset($_POST['login'])){
                if($_POST['id'] == $row['ID'] &&
                   $_POST['date'] == $row['DOB'] &&
                   $_POST['email'] == $row['Email']) {
                        $_SESSION['valid'] = true;
                        $_SESSION['timeout'] = time();
                        mysqli_free_result($result);
                        mysqli_close($link);
                        echo 'You have entered valid information';
                        header("Location: admin.php");
                }
                else {
                    echo "<strong>Incorrect Information</strong><br><br>";
                }
                   
            
            }
            
            
            
        
        ?> 
        
        <div class = "form_container">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                Email: <input type="email" name="email" required><br>
                DOB: <input type="date" name="date" required><br>
                Password: <input type="password" name="id" required><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </body>    

</html>

