<?php

  //$hostname = "http://localhost/news-site";

  $hostname = "localhost";
  $username = "root";
  $password = "shrosh@n";
  $databaseName = "news-site";

  // connect to mysql database using mysqli
  $connect = mysqli_connect($hostname, $username, $password, $databaseName) or die("Connection failed." . mysqli_connect_error());
 ?>
