<?php 
    session_start();
    include "config.php";
    $page = basename($_SERVER['PHP_SELF']);

    switch ($page) {
        case "single.php":
            if(isset($_GET['id'])){
                $query_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
                $result_title = mysqli_query($connect, $query_title) or die("Query Failed:single");
                $row_title = mysqli_fetch_assoc($result_title);
                $title_name = $row_title['title'];
            }
            else{
                $title_name = "Result not found";
            }
            break;

        case "category.php":
            if(isset($_GET['cid'])){
                $query_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
                $result_title = mysqli_query($connect, $query_title) or die("Query Failed:single");
                $row_title = mysqli_fetch_assoc($result_title);
                $title_name = $row_title['category_name'] . " " . "News";
            }
            else{
                $title_name = "Result not found";
            }
            break;

        case "search.php":
            if(isset($_GET['search'])){
               $title_name = $_GET['search']; 
            }
            else{
               $title_name = "Search item not found"; 
            }
            break;

        case "author.php":
            if(isset($_GET['aid'])){
                $query_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
                $result_title = mysqli_query($connect, $query_title) or die("Query Failed:single");
                $row_title = mysqli_fetch_assoc($result_title);
                $title_name = "News By " . $row_title['first_name'] . " " . $row_title['last_name'];
            }
            else{
                $title_name = "Result not found";
            }
            break;    
        default:
            $title_name = "News Site";
            break;
    }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title_name; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->

            <div class=" col-md-3">

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
                            echo '<a href="index.php" id="logo"><img src="admin/images/'.$row_setting['logo'].'"></a>';
                        }
                
                     }
                 }
             ?>

            </div>
            <div class="col-md-offset-9  col-md-3 "style="text-transform: uppercase;font-weight: 800;">
                <?php 

                    if(isset($_SESSION['user_name'])){
                 ?>
                <a href="admin/post.php" class="admin-logout" style="font-size: 16px;
                        text-decoration: none; color: #ffff;"> <?php echo $_SESSION['user_name']; ?> <i style="color:#ffff;font-size: 18px;" class="fa fa-users" aria-hidden="true"></i></a>
                <?php } ?>
            </div>

            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 

                include "config.php";

                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }
                // query for show category name which contain at least one value.

                $query_of_cat_name = "SELECT * FROM category WHERE post > 0";

                $result_of_cat_name = mysqli_query($connect,$query_of_cat_name) or die("query failed:category_name");
                if(mysqli_num_rows($result_of_cat_name) > 0){

                    $active = "";
                 ?>
                <ul class='menu'>
                    <li><a href="http://localhost/news-site/index.php">Home</a></li>
                    <?php while ($row = mysqli_fetch_assoc($result_of_cat_name )) {
                        if(isset($_GET['cid'])){
                            if($row['category_id'] == $cat_id){
                                $active = "active";
                            }
                            else {
                                $active = "";
                            }
                        }
                     ?>
                     
                    <li><a class ="<?php echo $active; ?>" href='category.php?cid=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a></li>
                <?php } ?>
                </ul>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
