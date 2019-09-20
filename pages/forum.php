<!DOCTYPE html>
<html lang="en">
<?php  
    session_start();  
    if(!isset($_SESSION['ID'])){
    header("Location: index.php");
    exit();
}
?>
<?php
    if(isset($_GET['logOut'])){
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
?>
<head>
    <link rel="icon" href="../images/tab.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/forum.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Forum</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <div class="logo">
                    123 FORUM
                </div>
                <div class="menu">
                    <ul>
                    <?php if($_SESSION['ID']==11) echo '<li><a href="admin.php">Admin</a></li>'
                            ?>
                        <li><a href="start.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li class="showing"><a href="forum.php">Forum</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="?logOut">Log out</a></li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

<main>
    <form action="includes/comment.inc.php" method="POST">
        <div class="comment">
            <p>Leave comment:</p>
            <textarea name="comment" id="comm" cols="50" rows="4"></textarea>
            <button type="submit" class="myButton" name="submit">Comment</button>
    </form>
    </div>       
        <table>
            <tr>
                <th>User </th>
                <th>Comment</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php                
            include_once 'includes/connect.inc.php';
            $sql = "SELECT * from comments";
            $results = mysqli_query($db,$sql);
            while($row=mysqli_fetch_array($results)){?>
            <tr>
                <td>
                    <?php echo $row['username']?><br><br>Posted:
                    <?php echo $row['dat']?>
                </td>
                <td>
                    <?php echo $row['comm']?>
                    <td>
                        <td class="commid">
                            <?php echo $row['comid']?>
                            <td>
                                <?php $id = $_SESSION['ID']; if($row['ID']==$id || $id==11) echo'<td> <button type="button" class="deleteBtn" />delete </td>'; else  echo'<td></td>'?>
            </tr>
            <?php         
            }
            ?>
        </table>      
</main>

</body>


    <script>
        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })
    </script>

    <script>
        $(".deleteBtn").click(function() {
            var $row = $(this).closest("tr");
            var commid = parseInt($row.find(".commid").text());            
            window.location.href = "includes/deleteComment.inc.php?commid=" + commid;             
        });
    </script>



</html>