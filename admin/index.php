<?php

  session_start();
  if(isset($_SESSION['user_name'])){
    header("Location: http://localhost/news-site/admin/post.php");
  }

 ?>

<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body style="background-color: #1e90ff;">
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                      <?php
                        include "config.php";

                        $sql_setting = "SELECT * FROM settings";

                        $result_setting = mysqli_query($connect, $sql_setting) or die("Query Failed.");
                        if(mysqli_num_rows($result_setting) > 0){
                          while($row_setting = mysqli_fetch_assoc($result_setting)) {
                              if($row_setting['logo'] == ""){
                                  echo '<a href="index.php" id="logo">'.$row_setting['websitename'].'</a>';
                              }
                              else{
                                  echo '<a href="index.php" id="logo"><img src="images/'.$row_setting['logo'].'"></a>';
                              }
                      
                           }
                       }
                   ?>
                        <!-- <img class="logo" src="images/news.jpg"> -->
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->

                        <?php

                          if(isset($_POST['login'])){

                            include "config.php";
                            $username = mysqli_real_escape_string($connect,$_POST['username']);
                            $password = md5($_POST['password']);

                            $query = "SELECT user_id, username, role FROM user
                            WHERE username = '{$username}' AND password = '{$password}'";
                            $result = mysqli_query($connect,$query) or die("Query unsuccessful");
                            if(mysqli_num_rows($result) > 0){
                              while ($row = mysqli_fetch_assoc($result)) {
                                session_start();
                                  $_SESSION['user_id'] = $row['user_id'];
                                  $_SESSION['user_name'] = $row['username'];
                                  $_SESSION['user_role'] = $row['role'];
                                header("Location: http://localhost/news-site/admin/../index.php");
                              }
                            }else{
                              echo '<div class="alert alert-danger">username and password are not matched.</div>';
                            }
                            mysqli_close();
                          }

                         ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
