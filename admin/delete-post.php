<?php

  include 'config.php';

  $post_id = $_GET['id'];
  $cat = $_GET['cat_id'];

  $query_of_delete_img = "SELECT * FROM post WHERE post_id = {$post_id}";
  $result_of_del_img = mysqli_query($connect,$query_of_delete_img);
  $row_of_del_img = mysqli_fetch_assoc($result_of_del_img);

  unlink("upload/".$row_of_del_img['post_img']);

  //sql query for delete post from post.
  $query_of_delete_post = "DELETE FROM post WHERE post_id = {$post_id};";
  $query_of_delete_post .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat}";

  $result_of_post = mysqli_multi_query($connect,$query_of_delete_post);
  if($result_of_post){
    header("Location: http://localhost/news-site/admin/post.php");
  }else{
    echo "Query Failed";
  }
  die();

  $query_of_post_delete = "DELETE FROM post WHERE post_id = {$post_id}";

  $query_of_category = "SELECT category FROM post WHERE post_id = {$post_id}";
  $result_of_cat = mysqli_query($connect,$query_of_category);
  if(mysqli_num_rows($result_of_cat) > 0){
    while ($row = mysqli_fetch_assoc($result_of_cat)) {
      $cat_id = $row['category'];
    }
  }
  $query_of_cat_update = "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";
  mysqli_query($connect,$query_of_cat_update);
  $result_of_post = mysqli_query($connect,$query_of_post_delete) or die("query Unsuccessful.");
  if($result_of_post){
    header("Location: http://localhost/news-site/admin/post.php");
  }else{
    echo "Query Failed";
  }

 ?>
