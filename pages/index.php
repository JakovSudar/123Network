<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../images/tab.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>123forum</title>
</head>

<body>

    <h1>Login page</h1>

    
    <form class="login" action="includes/login.inc.php" method="POST">
        <label for="user"> <b> Username:</b></label> <br> <input type="text" id="user" placeholder="Enter username" name="Username" autocomplete="off">
        <br> <label for="pass"><b>Password:</b></label> <br> <input type="password" id="pass" placeholder="Enter password" name="Password" class="margina">
        <br>
        <br>
        <button type="submit" class="button" name="submit">Login</button>
        </form>
    
    <p class="notReg">
        Not registred? Click <a href="registration.php">here</a>
    </p>
    <span class="bottomleft">Jakov Sudar</span>
    <span class="bottomright">FERIT 2018</span>

<script>

$("input").focus(function(){
    $(this).css("background-color", "#00bfff");
});
$("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    });

</script>
</body>



</html>