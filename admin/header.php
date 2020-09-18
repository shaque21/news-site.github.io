<?php

  session_start();
  if(!isset($_SESSION['user_name'])){
    header("Location: http://localhost/news-site/admin/");
  }

 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
        
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <?php
                          include "config.php";

                          $sql_setting = "SELECT * FROM settings";

                          $result_setting = mysqli_query($connect, $sql_setting) or die("Query Failed.");
                          if(mysqli_num_rows($result_setting) > 0){
                            while($row_setting = mysqli_fetch_assoc($result_setting)) {
                                if($row_setting['logo'] == ""){
                                    echo '<a href="../index.php" id="logo">'.$row_setting['websitename'].'</a>';
                                }
                                else{
                                    echo '<a href="../index.php" id="logo"><img src="images/'.$row_setting['logo'].'"></a>';
                                }
                        
                             }
                         }
                     ?>
<!--                         <a href="post.php"><img class="logo" src="images/news.jpg"></a>
 -->                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-3">
                        <a href="logout.php" class="admin-logout" style="font-size: 16px;
                        text-decoration: none;" > Hello <?php echo $_SESSION['user_name']; ?>, logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li>
                                <a href="../index.php">Home</a>
                            </li>
                            <li>
                                <a href="post.php">Post</a>
                            </li>
                            <?php
                              if($_SESSION['user_role'] == '1'){
                             ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="settings.php">Settings</a>
                            </li>
                          <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->
