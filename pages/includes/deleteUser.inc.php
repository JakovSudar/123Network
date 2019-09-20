<?php

session_start();

        include_once 'connect.inc.php';

        
        $username = $_GET['user'];
        echo $username;
        $sql = "DELETE from users where username = '$username'";     
        
        mysqli_query($db, $sql);       
        echo "done";
        header(sprintf("Location: ../admin.php?deletedUser=%s",$username));
     
        exit();







