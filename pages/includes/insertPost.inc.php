<?php
session_start();
 include_once 'connect.inc.php';

    $msg = "";
    $id=$_SESSION['ID'];
    $user = $_SESSION['username'];
   
   if (isset($_POST['upload'])) {            
       $image = $_FILES['image']['name'];          
       $image_text = mysqli_real_escape_string($db, $_POST['image_text']);
 
       //putanja do slike na posluzitelju
       $target = "../../images/uploads/".basename($image);
 
       $sql = "INSERT INTO posts (image, ID, tekst, username) VALUES ('$image', '$id','$image_text','$user')";      
       mysqli_query($db, $sql);

       move_uploaded_file($_FILES['image']['tmp_name'], $target);       
   }
    header("Location: ../start.php");
    exit(); 
?>