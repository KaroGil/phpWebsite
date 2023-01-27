<?php

//server settings
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "todolist";

//create connection and set character encoding
$conn = mysqli_connect($servername,$username,$password,$dbname);
mysqli_set_charset($conn, "utf8");

//check connection
if( !$conn ){
    die("Connection failed: " . mysqli_connect_error());
}


//hent ut 
$sql = "SELECT * FROM tasks ORDER BY name LIMIT 7";
$result = mysqli_query( $conn, $sql );

?>

<!DOCTYPE html>
<html>
 <head>
    <title>To do list</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="style.css">
    <link rel="icon"       type="image/png" href="favicon.png">
 </head> 
 <body> 
    <?php
        require  "nav.html";
        require "header.html";

        while($row = mysqli_fetch_assoc($result)){
            $name = $row["name"];
            echo "<section>";
            echo "<ul>";
            echo "<li>" . $name . "</li>";
            echo "</ul>";
            echo "</section>";

        }
    ?>

 </body> 
</html>

<?php 
    mysqli_close( $conn );
?>
