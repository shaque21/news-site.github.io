<?php

  include "config.php";

  $user_id = $_GET['id'];

  $query = "DELETE FROM user WHERE user_id = {$user_id}";
  $result = mysqli_query($connect,$query) or die("Query unsuccessful.");
  if($result){
    header("Location: http://localhost/news-site/admin/users.php");
  }
  else {
    echo "<p style = 'color:red; text-align:center; margin:10px 0px;'>This record is not deleted.</p>";
  }

  mysqli_close($connect);

 ?>
