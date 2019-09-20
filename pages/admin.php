<?php
    session_start();   
    
    if(!$_SESSION['ID']==11){
        header("Location: index.php");
    exit();
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Admin settings</title>
    </head>

    <body>
    <div class="grid">
        <div class="item1">
            
                <ul>
                    <li><a href="admin.php">Admin</a></li>
                    <li class="showing"><a href="start.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="?logOut">Log out</a></li>
                </ul>
            
        </div>
        
        <div class="item2">
            <p>USERS:</p>
            <table>
                <?php                
                include_once 'includes/connect.inc.php';
                $sql = "SELECT * from users";
                $results = mysqli_query($db,$sql);
                while($row=mysqli_fetch_array($results)){?>
                <tr>
                    <?php if($row['username']!=="Admin"){ echo '<td class="user">'; echo $row['username']; echo'</td> ';} ?>
                    <?php if($row['username']!=="Admin")echo'<td> <button type="button" class="deleteBtn" />delete </td>'?>                    
                </tr>
                <?php         
                }
                ?>
            </table>
        </div>
        
        <div class="item3">
            <div id="chart"></div>
        </div>     
        <div class="item4">
            <div> Last Registred:
                <?php
                    $sql = "SELECT * FROM users ORDER BY ID DESC LIMIT 1";
                    $result = mysqli_query($db,$sql);
                    $row=mysqli_fetch_array($result);
                    $user = $row['username'];
                    echo  $user; ?> 
                    <br>                   
                <?php
                    $sql = "SELECT ID,
                    COUNT(ID) as num
                    FROM     comments
                    GROUP BY ID
                    ORDER BY count(*) DESC
                    LIMIT    1;";
                    $result = mysqli_query($db,$sql);
                    $row=mysqli_fetch_array($result);
                    $uid = $row['ID'];
                    $number = $row['num'];
                    $sql="SELECT username from users where ID = $uid";
                    $result = mysqli_query($db,$sql);
                    $row=mysqli_fetch_array($result);
                    $user = $row['username']; 
                    echo  sprintf("<br>Most active: %s <br> 
                    with %s comments", $user, $number);
                                       
                     ?> 
                    <br>                            
            </div>
        </div>
        </div>
    </body>


<script>
            $(".deleteBtn").click(function() {
                var $row = $(this).closest("tr");
                var username = $row.find(".user").text(); 
                           
                window.location.href = "includes/deleteUser.inc.php?user=" + username;             
            });
    </script>
        


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Count'],
                ['Males', <?php 
                $sql = "SELECT * from users where gender='M'";
                $result = mysqli_query($db,$sql);
                $rows= mysqli_num_rows($result);
                
                echo $rows;
                ?>],
                ['Females', <?php 
                $sql = "SELECT * from users where gender='F'";
                $result = mysqli_query($db,$sql);
                $rows= mysqli_num_rows($result);
                
                echo $rows;
                ?>],
            ]);
            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Statistic',
                'width': 550,
                'height': 400
            };
            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('chart'));
            chart.draw(data, options);
        }
    </script>
<?php
    if(isset($_GET)){
        echo "<script>
        alert('User"?> <?php echo $_GET['deletedUser']?> <?php echo " is deleted') 
        </script>";        
    }
  ?> 

    </html>