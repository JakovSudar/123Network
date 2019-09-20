<!DOCTYPE html>
<html lang="en">
<?php  
    session_start();  
    if(!isset($_SESSION['ID'])){
    header("Location: index.php");
    exit();
}

?>

<head>
    <link rel="icon" href="../images/tab.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/contact.css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Contact</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <div class="logo">
                    123 FORUM
                </div>
                <div class="menu">
                    <ul>
                    <?php if($_SESSION['ID']==11) echo '<li><a href="admin.php">Admin</a></li>'
                            ?>
                        <li><a href="start.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="forum.php">Forum</a></li>
                        <li class="showing"><a href="contact.php">Contact</a></li>
                        <li><a href="?logOut">Log out</a></li>

                    </ul>
                </div>
            </nav>
        </header>

        <form action="includes/sendMail.inc.php" method="POST">
            <div class="centriraj">
                <img src="../images/contact-us.png" class="slika">
                <div class="content">
                    <p class="email">Enter your mail:</p>
                    <textarea name="mail" id="cont" cols="27" rows="1"></textarea>


                    <p class="email">Enter your message:</p>
                    <textarea name="content" id="cont" cols="35" rows="7"></textarea>

                    <button type="submit" class="myButton" name="submit">Send</button>

                </div>
        </form>
        </div>

</body>

<?php
    if(isset($_GET['logOut'])){
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
?>
    <script>
        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })
    </script>

</html>