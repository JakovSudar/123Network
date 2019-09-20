<?php


if(isset($_POST['submit'])||(isset($_POST['terms']))){
    include_once 'connect.inc.php';

    $username = mysqli_real_escape_string($db, $_POST['Username']);
    $email = mysqli_real_escape_string($db, $_POST['E-mail']);
    $gender = mysqli_real_escape_string($db, $_POST['Gender']);
    $password = mysqli_real_escape_string($db, $_POST['Password']);
    $repeatedpwd= mysqli_real_escape_string($db,$_POST['RePassword']);
    //je li prihvatio termse?
    if ($_POST['terms'] != 'y'){
        header("Location: ../registration.php?singup=terms");
        exit();
    }
    //jesu li passwordi isti
    if($password!=$repeatedpwd){
        header("Location: ../registration.php?singup=password");
        exit();
    }
    //U slučaju praznih polja
    if(empty($username)||empty($email)||empty($gender)||empty($password)){
        header("Location: ../registration.php?singup=empty");
        exit();

    }        
     //else {
       // if(!fiter_var($email, FILTER_VALIDATE_EMAIL)){
         //   header("Location: registration.php?singup=email");
           // exit();
        //} 
        else{           
            //jednaki username 
            $sql= "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($db, $sql);
            $resultCheck= mysqli_num_rows($result);

            if($resultCheck>0){
                header("Location: ../registration.php?singup=username");
                exit();

            } else {
                $hashedPass = password_hash($password,PASSWORD_DEFAULT);
               // print("<br>E-mail:  $email  Username : $username");
               // print_r($_POST);  
               $sql = "INSERT INTO users (email, username, gender, pwd) VALUES ('$email', '$username', '$gender', '$hashedPass')";
             

                mysqli_query($db, $sql);
                header("Location: ../index.php?singup=success");
                exit();            
            }
        }   
  //  }
    
} else {
    header("Location: ../registration.php");
    exit();
}