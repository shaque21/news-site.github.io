<?php

  include "config.php";

  if(empty($_FILES['new-image']['name'])){
    $file_name = $_POST['old-image'];
  }
  else {
    $errors= array();
    $file_name = $_FILES['new-image']['name'];
    $file_size =$_FILES['new-image']['size'];
    $file_tmp =$_FILES['new-image']['tmp_name'];
    $file_type=$_FILES['new-image']['type'];
    $file_name = strtolower($file_name);
    $file_ext=explode('.',$file_name);
    $file_ext = end($file_ext);
    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors) == true){
       move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
       print_r($errors);
       die();
    }
  }

  $post_id = $_POST['post_id'];
  $post_title = $_POST['post_title'];
  $post_description = trim($_POST['postdesc']);
  $category = $_POST['category'];


  $queryOfCategory = "SELECT category FROM post WHERE post_id = {$post_id}";

  $resultOfCat = mysqli_query($connect,$queryOfCategory) or die('Hi');
  while($row = (mysqli_fetch_assoc($resultOfCat))){
    $prev_cat_id = $row['category'];
  }


  $q = "UPDATE post SET title = '{$post_title}', description = '{$post_description}',category = {$category}, post_img = '{$file_name}'
  WHERE post_id = {$post_id}";
  $updatePost=mysqli_query($connect,$q);
  
  //echo $resultOfUpdatePost;die();
  //Update total number of post on each category
  if($prev_cat_id != $category){

    $queryOfUpdateCat = "UPDATE category SET post = post + 1 WHERE category_id = {$category};";
    $queryOfUpdateCat .= "UPDATE category SET post = post - 1 WHERE category_id = {$prev_cat_id}";

    mysqli_multi_query($connect, $queryOfUpdateCat);

  }

  

  if($updatePost){
    header("Location: http://localhost/news-site/admin/post.php");
  }
  else{
    echo "query unsuccessful.";
  }

 ?>
