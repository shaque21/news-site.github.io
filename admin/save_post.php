<?php
  session_start();
  include "config.php";

  if(isset($_FILES['fileToUpload'])){
      $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size =$_FILES['fileToUpload']['size'];
      $file_tmp =$_FILES['fileToUpload']['tmp_name'];
      $file_type=$_FILES['fileToUpload']['type'];
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

  $title =  mysqli_real_escape_string($connect,$_POST['post_title']);
  $description =  mysqli_real_escape_string($connect,$_POST['postdesc']);
  $category =  mysqli_real_escape_string($connect,$_POST['category']);
  $date =  date("d M, Y");
  $author = $_SESSION['user_id'];

  $query = "INSERT INTO post(title, description, category, post_date, author, post_img)
            VALUES('{$title}', '{$description}', {$category}, '{$date}', {$author}, '{$file_name}');";
  $query .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

  if(mysqli_multi_query($connect, $query)){
    header("Location: http://localhost/news-site/admin/post.php");
  }
  else {
    echo '<div class="alert alert-danger">Query Unsuccessful.</div>';
  }

 ?>
