<?php

session_start();

        include_once 'connect.inc.php';

        
        $commid = $_GET['commid'];

        $sql = "DELETE from comments where comid= $commid";
       

        mysqli_query($db, $sql);
        header("Location: ../forum.php");
        exit();







