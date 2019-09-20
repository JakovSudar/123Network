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
        <meta http-equiv="Cache-control" content="no-cache">
        <link rel="icon" href="../images/tab.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="../css/start.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="scripts/jquery.cookie.js"></script>
        <title>Home</title>
    </head>

<!-- LAJKOVI  -->
    <script>
        function updateLike(postID) {
            var str1 = "likesof";
            var str2 = postID;
            var ID = str1.concat(str2); //Spaja stringove
            console.log(ID);

            if (document.getElementById('likeBtn' + postID)) {
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(ID).innerHTML = this.responseText;
                    }
                };
                $('#likeBtn' + postID).val('Unlike');
                document.getElementById('likeBtn' + postID).id = 'unlikeBtn' + postID;
                xml.open("POST", "includes/liker.inc.php?postID=" + postID, true);
                xml.send();
            }else {
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(ID).innerHTML = this.responseText;
                    }
                };
                $('#unlikeBtn' + postID).val('Like');
                document.getElementById('unlikeBtn' + postID).id = 'likeBtn' + postID;
                xml.open("POST", "includes/liker.inc.php?delpostID=" + postID, true);
                xml.send();
            }
            console.log('likeBtn' + postID);
        }
    </script>

    <body>
        <div class="welcomeContainer" id="welcomeContainer">
            <div id="welcomescreen" class="welcomescreen">
                <p class="welcome">Welcome
                    <?php print($_SESSION['username']);?>
                </p>
                <a href="#" class="welcomeBtn">
                        E N T E R
                </a>
            </div>
        </div>
        <div>
            <header>
                <nav>
                    <div class="logo">
                        123NETWORK
                    </div>
                    <div>
                        <ul>
                            <?php if($_SESSION['ID']==11) echo '<li><a href="admin.php">Admin</a></li>'
                            ?>
                            <li class="showing"><a href="start.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="forum.php">Forum</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="?logOut">Log out</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>

        <div class="wrapper">
            <div class="header" id="start">
                <H3>Share your passion</H3>
            </div>

            <div class="sidebar" id="getFixed">
                <li><a> Links:</a></li>
                <li>
                    <a href="https://www.youtube.com/"> <img src="http://localhost/123forum/images/youtube.png">Youtube</a>
                </li>
                <li>
                    <a href="https://www.facebook.com/"> <img src="http://localhost/123forum/images/facebook1.png">Facebook</a>
                </li>
                <li>
                    <a href="https://www.w3schools.com/"> <img src="http://localhost/123forum/images/w3.png">W3schools</a>
                </li>
                <li>
                    <a href="https://stackoverflow.com/"><img src="http://localhost/123forum/images/stack.png">StackOverflow</a>
                </li>
                <li>
                    <a href="https://github.com/"><img src="http://localhost/123forum/images/git.png">GitHub</a>
                </li>
            </div>

            <div class="content">
                <div class="upload">
                    <form action="includes/insertPost.inc.php" method="POST" enctype="multipart/form-data">                        
                        <textarea name="image_text" id="image_text" cols="100" rows="3" placeholder="Enter your status"></textarea>
                        <br>
                        <input type="file" name="image">
                        <button type="submit" name="upload" class="myButton" id="post">POST</button>
                    </form>
                </div>

                <?php
                include_once 'includes/connect.inc.php';
                $id = $_SESSION['ID'];
                $result = mysqli_query($db, "SELECT * FROM posts ORDER by postID desc");

                while ($row = mysqli_fetch_array($result)) {
                    $postID=$row['postID'];
                    echo "<div class=\"postContainer\">";
                    echo "<div>";
                        echo "<div class=\"name\">";
                        echo "<p class=\"username\">".$row['username']."</p>";
                        echo "<p class=\"postID\">".$row['postID']."</p>";

                        if($row['ID']==$id || $id==11) echo'<button type="button" class="deleteBtn" />delete</button>'; 
                        echo" </div>";                          
                        echo "<p class=\"status\">".$row['tekst']."</p>";
                       
                    echo "</div>";
                        if($row['image']!==""){
                        echo "<img  src='../images/uploads/".$row['image']."' >";
                        }   
                       $sqll ="SELECT count(*) as BrojLajkova, postID from likes 
                        WHERE postID = $postID
                        group by postID";
                       $resultt = mysqli_query($db,$sqll);
                       $roww = mysqli_fetch_array($resultt);
                       if($roww['BrojLajkova']==1){
                        echo"<p class=\"likenum\" id=likesof".$row['postID'].">".                         
                       $roww['BrojLajkova'].                        
                        " Like</p>";
                       }elseif($roww['BrojLajkova']>1){
                       echo"<p class=\"likenum\" id=likesof".$row['postID'].">".                         
                       $roww['BrojLajkova'].                        
                        " Likes</p>";
                       }
                       else{
                       echo"<p class=\"likenum\" id=likesof".$row['postID'].">0 Likes</p>";                                                                                            
                       }
                       $sql = "SELECT * from likes where uID=$id AND postID=$postID";
                       $likedResult = mysqli_query($db, $sql);
                       $likedCheck = mysqli_num_rows($likedResult);
                       if($likedCheck==0){     
                            echo "<input type=\"button\"  class=\"liked\" id =\"likeBtn".$postID."\"onclick=\"updateLike(".$row['postID'].")\" value=Like>";                               
                        }else{
                            echo "<input type=\"button\"  class=\"liked\" id =\"unlikeBtn".$postID."\"onclick=\"updateLike(".$row['postID'].")\" value=Unlike>";          
                        }
                    echo "</div>";}
            ?>
            </div>
            <div class="right">
                <iframe width="100%" height="200" src="https://www.youtube.com/embed/00bTXH18lOg" allowfullscreen>
        </iframe>
                <iframe width="100%" height="200" src="https://www.youtube.com/embed/VwgsxC95QFM" allowfullscreen>
        </iframe>
                <iframe width="100%" height="200" src="https://www.youtube.com/embed/DW_y4EdqYpw" allowfullscreen>
        </iframe>
            </div>
            <div class="footer">All rights reserved: Jakov Sudar FERIT 2018/2019 </div>
        </div>
    </body>




    <script>
        $(".deleteBtn").click(function() {
            var $row = $(this).prev();
            var postID = parseInt($row.text());
            window.location.href = "includes/deletePost.inc.php?postID=" + postID;
        });
    </script>

    <script>
        var fixmeTop = $('#getFixed').offset().top - 80;
        $(window).scroll(function() {
            var currentScroll = $(window).scrollTop();
            if (currentScroll >= fixmeTop) {
                $('#getFixed').css({
                    position: 'fixed',
                    top: '80px',
                    width: '15vw'
                });
            } else {
                $('#getFixed').css({
                    position: 'static'
                });
            }
        });
    </script>


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
        $('.welcomeBtn').click(function() {
            $('html').css({
                overflow: 'auto'
            });
            $(document.getElementById('welcomeContainer')).fadeOut(300);
            $('html, body').delay(500).animate({
                scrollTop: $('#start').offset().top - 80
            }, 2000);

        });
    </script>

    <script>
    document.getElementById('welcomeContainer').style.display = 'block';
    $('#welcomeContainer').style.display = 'block';
    $('html').css({
        overflow: 'hidden';
    });
    function scroller() {
        document.getElementById('welcomeCotainer').style.display = 'block';
        $('html').css(@
        {


        })
    }

    
    </script>

    <script>
        function showWelcome() {
            document.getElementById('welcomeContainer').style.display = 'block';
            $('html').css({
                overflow: 'hidden'
            });
        }

        function scroller() {
            $('html, body').delay(300).animate({
                scrollTop: $('#start').offset().top - 80
            }, 900);
            console.log('scroler');
        }
    </script>

    <?php
if (isset($_GET["login"])) {        
    echo '<script type="text/javascript">',
    'showWelcome();',
    '</script>';
} else{echo '<script type="text/javascript">',
    '$(document).ready(scroller());',
    '</script>';
}
?>

</html>