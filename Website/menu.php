<?php
    
    
    if(!isset($_GET['Category'])){
        header("Location:website.php");
    }
    
    include("connection.php");

    $items = $link->query("SELECT * FROM Item WHERE Category='$_GET[Category]'");
    
    if($items->num_rows > 0){
        while($row = $items->fetch_assoc()){ 
            $item = $row["Name"];
            $ingredients = $link->query("SELECT Ingredient FROM Ingredient WHERE Item_Name=\"$item\"");
    ?>
<div id="menu_items">
    <?php echo "<strong>$row[Name]</strong><br>";?>
    <p id="items">
    (
    <?php
            $i = 0;
            if($ingredients->num_rows > 0){
                while($row2 = $ingredients->fetch_assoc()){
                    if($i == 0){
                        echo "$row2[Ingredient]";
                    } else {
                        echo ", $row2[Ingredient]";
                    }
                    $i++;  
                }
            }
            else{
                echo "No ingredients were added.";    
            }?>
    )
    </p>
    <p class="price">
        <?php echo "£$row[Price]";?>
    </p>

    
    
    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?page=menu&Category=$_GET[Category]&Item=$row[Name]"; ?>"><button class="order">Add to cart</button></a>
    <?php
            
        echo "<br><br>"; 
    }
    }
    else {
        echo "We are out of Food";
    }
    ?>
</div>
<?php
    mysqli_free_result($items);
    mysqli_free_result($ingredients);
    mysqli_close($link);
?>

    

