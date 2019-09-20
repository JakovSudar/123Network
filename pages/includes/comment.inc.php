<?php

session_start();


if (isset($_POST['submit'])){   
        include_once 'connect.inc.php';

        $comment = mysqli_real_escape_string($db,$_POST['comment']);
        $id = $_SESSION['ID'];
        $username =  $_SESSION['username'];
        $t = date('Y-d-m H:i:s',time());

        $sql= "INSERT INTO comments (ID, comm, username, dat) VALUES ('$id', '$comment', '$username', '$t')";

        if($comment!=null){
            mysqli_query($db, $sql);
                header("Location: ../forum.php");
                exit(); 
        }


}

