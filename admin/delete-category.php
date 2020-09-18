<?php

  include "config.php";

  $category_id = $_GET['id'];

  $query = "DELETE FROM category WHERE category_id = {$category_id}";
  $result = mysqli_query($connect,$query) or die("Query unsuccessful.");
  if($result){
    header("Location: http://localhost/news-site/admin/category.php");
  }
  else {
    echo "<p style = 'color:red; text-align:center; margin:10px 0px;'>This record is not deleted.</p>";
  }

  mysqli_close($connect);

 ?>
