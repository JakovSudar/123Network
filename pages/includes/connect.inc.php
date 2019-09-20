<?php
$servername = "localhost";
$username = "root";
$password = "";
$name = "portfolio";


// Create connection
$db = mysqli_connect($servername, $username, $password,$name);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>