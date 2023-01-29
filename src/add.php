<?php
// Server settings 
$servername = "localhost:3306";
$username   = "root"; 
$password   = "";
$dbname     = "todolist";
// Create connection and set character encoding
$conn = mysqli_connect( $servername, $username, $password, $dbname );
 mysqli_set_charset( $conn, "utf8" );
// Check connection
if ( !$conn ) { 
      die( "Connection failed: " . mysqli_connect_error() ); 
}


//from form
$name= $_POST["name"];
$priority= $_POST["priority"];

//insert
$sql = "INSERT INTO tasks (name, priority, fullfield) VALUES (\"$name\", \"$priority\", 0)";
$result = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM tasks WHERE name = \"$name\"";
$result1 = mysqli_query($conn, $sql1 );


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add - to do list</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css"  href="style.css">
    <link rel="icon"       type="image/png" href="favicon.png">
  </head>
  <body>
  <?php
        echo "<section id=\"navigation\">";
        require  "nav.html";
        echo "</section>";
        
        $row = mysqli_fetch_assoc($result1);
        $id = $row["ID"];
        $displayName = $row["name"];

        echo "<h3> Sucess in adding " . $displayName . " to the database! </h3>"; 

        header('location: index.php');

    ?>  
    
  </body>
</html>
<?php 
// Close connection
 mysqli_close( $conn ); 
?>