<?php

session_start();

        include_once 'connect.inc.php';

        
        $postID = $_GET['postID'];

        $sql = "DELETE from posts where postID= $postID";
       

        mysqli_query($db, $sql);
        header("Location: ../start.php");
        exit();







