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

$limit = 10;

//get the data from the database
$sql = "SELECT * FROM tasks WHERE fullfield=0 ORDER BY priority LIMIT " . $limit;
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
       

        echo "<ul class=\"list\">";
        while($row = mysqli_fetch_assoc($result)){
            $name = $row["name"];
            echo "<section class=\"listItem\">";
            echo "<li>" . $name . "</li>";
            echo "<a href=\"index.php?complete_task=" . $row['ID'] . "\"> X </a>";
            echo "</section>";
        }
        echo "</ul>";

        // echo "<a href=\"index.php?len=" . $limit*2 . "\"> Show more</a>";

        if (isset($_GET['complete_task'])) {
            $id = $_GET['complete_task'];

            $sql = "UPDATE tasks SET fullfield=1 WHERE ID=" . $id;  
            mysqli_query($conn, $sql);
            header('location: index.php');
        }

    ?>

 </body> 
</html>

<?php 
    mysqli_close( $conn );
?>
