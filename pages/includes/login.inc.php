<?php

session_start();

if (isset($_POST['submit'])){
    include_once 'connect.inc.php';

    $username = mysqli_real_escape_string($db,$_POST['Username']);
    $password = mysqli_real_escape_string($db,$_POST['Password']);  
    

    if(empty($username)||empty($password)){
        header("Location: ../index.php?singup=empty");
        exit();
    }else{
        $hashedPass = password_hash($password,PASSWORD_DEFAULT);
        $sql= "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($db, $sql);  
        $resultCheck= mysqli_num_rows($result);
        if($resultCheck<1){
            header("Location: ../index.php?login=username");
            exit();
        } else {
        if($row=mysqli_fetch_assoc($result)){
            //Usporedba hashiranih pwd
            $hashedPwdCheck = password_verify($password, $row['pwd']);
            if($hashedPwdCheck==false){
                header("Location: ../index.php?login=pwd");
                exit(); 
            } elseif($hashedPwdCheck==true){
                //Logiranje
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['FirstTime']= 1;                                            
                header("Location: ../start.php?login=success");
                exit();
            }
        }
        }
    }
}
else{
    header("Location: ../index.php");
    exit();
}