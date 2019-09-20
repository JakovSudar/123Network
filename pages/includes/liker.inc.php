<?php
session_start();
 include_once 'connect.inc.php';

 
 $uid = $_SESSION['ID'];
   
   if (isset($_GET['postID'])) {      
      $postID = $_GET['postID'];     
      $sql = "INSERT INTO likes (postID, uID) VALUES ('$postID', '$uid')";      
      mysqli_query($db, $sql);           
   }
   else{
        $postID = $_GET['delpostID'];
        $sql = "DELETE FROM likes where postID = $postID && uID=$uid";
        mysqli_query($db,$sql);
   }

   $sql ="SELECT count(*) as BrojLajkova, postID from likes 
   WHERE postID = $postID
   group by postID";   
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result);
   $num = $row['BrojLajkova'];
   
   if($num>1){
      echo $row['BrojLajkova']." Likes";
   }
   elseif($num==1){
      echo $row['BrojLajkova']." Like";
   }
   else{
      echo "0 Likes";
   }
   exit(); 
?>