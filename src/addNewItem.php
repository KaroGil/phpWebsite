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
?>

<!DOCTYPE html>
<html>
  <head>
    <title>To do list</title>
    <meta charset="utf-8"> 
    <link rel="stylesheet" type="text/css"  href="create.css">
    <link rel="icon"       type="image/png" href="media/lgog.png">
  </head>
  <body>
  <?php
        require "nav.html"; 
        require "header.html";
      ?>
<main>
  <h1 id="ch1">Add new task to the to do list </h1>
  <p>Here you can write a new task and add it to the to do list</p>
    <form id="one" action="add.php" method="post"> <!-- TODO:  Make the add php file for adding purposes!-->

        <lable for="name">Name <br></lable>
        <input type="text" name="name"><br>   
        <lable for="priority">Priority <br></lable>
        <input type="text" name="priority"><br>  
        <!-- <lable for="fullfield">fullfield?<br></lable>
        <input type="text" -->

        <input type="submit" value="Add">
    </form>

</main>
  </body>
</html>
<?php 
// Close connection
 mysqli_close( $conn ); 
?>