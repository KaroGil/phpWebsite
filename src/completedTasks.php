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


//get data out of database
$sql = "SELECT * FROM tasks WHERE fullfield=1 ORDER BY priority";
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
        //add navigation bar and header
        echo "<section id=\"navigation\">";
        require  "nav.html";
        echo "</section>";
       

        //header for completed tasks
        echo "<h2>Completed tasks</h2>";

        //looping through results and printing them out
        echo "<ul class=\"list\">";
        while($row = mysqli_fetch_assoc($result)){
            $name = $row["name"];
            echo "<section class=\"listItem\">";
            echo "<li>" . $name . "</li>";
            echo "<a href=\"completedTasks.php?reverse_task=" . $row['ID'] . "\"> Reverse </a>";    //reverse button to add task back to to do li
            echo "</section>";
        }

        //reverse task action if statement, updates fullfilment column
        if (isset($_GET['reverse_task'])) {
            $id = $_GET['reverse_task'];

            $sql = "UPDATE tasks SET fullfield=0 WHERE ID=" . $id;
            mysqli_query($conn, $sql);
            header('location: index.php');
        }
        
    ?>

 </body> 
</html>

<?php 
    mysqli_close( $conn );
?>
