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
        echo "<section id=\"navigation\">";
        require  "nav.html";
        echo "</section>";
        echo "<section id=\"heading\">";
        require "header.html";
        echo "</section>";

        while($row = mysqli_fetch_assoc($result)){
            // $sqlupdate1 = "UPDATE tasks SET fullfield=1 WHERE ID={$rows['ID']} ";
            $name = $row["name"];
            echo "<section id=\"list\">";
            echo "<ul>";
            echo "<li>" . $name . "</li>";
            echo "<a href=\"index.php?del_task=" . $row['ID'] . "\"> X </a>";
            echo "</ul>";
            echo "</section>";

        }

        if (isset($_GET['del_task'])) {
            $id = $_GET['del_task'];
        
            mysqli_query($db, "UPDATE tasks SET fullfield=1 WHERE id=".$id);
            header('location: index.php');
        }
        
    ?>

 </body> 
</html>

<?php 
    mysqli_close( $conn );
?>
