<?php include "header.php";
  $check_user = $_SESSION['user_role'];

?>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">

                <?php

                  include "config.php";
                  // mysql query to insert data

                  $limit = 3;
                  //$page = $_GET['page'];
                  if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                  } else {
                    $page = 1;
                  }

                  $offset = ($page - 1) * $limit;

                  if($_SESSION['user_role'] == '1'){
                    $query = "SELECT post.post_id,post.title, post.description, post.post_date,
                              category.category_name, user.username, post.category, post.author,user.role FROM post
                              LEFT JOIN  category ON post.category = category.category_id
                              LEFT JOIN  user ON post.author = user.user_id
                              ORDER BY post.post_id DESC LIMIT {$offset} , {$limit}";

                  }elseif ($_SESSION['user_role'] == '0') {
                    $query = "SELECT post.post_id,post.title, post.description, post.post_date,
                              category.category_name, user.username, post.category, post.author,user.role FROM post
                              LEFT JOIN  category ON post.category = category.category_id
                              LEFT JOIN  user ON post.author = user.user_id
                              WHERE post.author = {$_SESSION['user_id']}
                              ORDER BY post.post_id DESC LIMIT {$offset} , {$limit}";
                  }
                  $result = mysqli_query($connect,$query) or die("Query unsuccessful.");
                  //Check records are added or not from db

                  if(mysqli_num_rows($result) > 0){

                 ?>

                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php

                          while($row = (mysqli_fetch_assoc($result))){
                         ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <?php
                                // echo $row['author'];
                                // echo $row['role'];
                                if($_SESSION['user_role'] == $row['role']){
                              ?>

                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>

                            <?php }
                            else{
                              echo"<td class='edit'><a href='post.php'></a></td>";
                            } ?>

                            <td class='delete'><a href="delete-post.php?id=<?php echo $row['post_id']; ?>& cat_id=<?php echo $row['category'];?>" onclick="return checkDelete()" ><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                <?php }
                //pagination starts for admin's post file
                if($_SESSION['user_role'] == '1'){
                $query1 = "SELECT * FROM post";
                $result1 = mysqli_query($connect,$query1) or die("Query unsuccessful.");

                if(mysqli_num_rows($result1) > 0){
                  $total_records = mysqli_num_rows($result1);

                  $total_page = ceil($total_records/$limit);

                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1){
                    echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>';
                  }
                  for ($i=1; $i <= $total_page; $i++) {
                    if($page == $i){
                      $active = "active";
                    }else{
                      $active = "";
                    }

                    echo '<li class = '.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){
                    echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                  }
                  echo "</ul>";
                }

              }
              //pagination starts for user's post file
              else {
                  $query2 = "SELECT * FROM post WHERE post.author = {$_SESSION['user_id']} ";
                  $result2 = mysqli_query($connect,$query2) or die("Query unsuccessful.");

                  if(mysqli_num_rows($result2) > 0){
                    $total_records = mysqli_num_rows($result2);

                    $total_page = ceil($total_records/$limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if($page > 1){
                      echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>';
                    }
                    for ($i=1; $i <= $total_page; $i++) {
                      if($page == $i){
                        $active = "active";
                      }else{
                        $active = "";
                      }

                      echo '<li class = '.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($total_page > $page){
                      echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                    }
                    echo "</ul>";
                  }
                }

                //   echo "<ul class='pagination admin-pagination'>";
                //   if($page > 1){
                //     echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>';
                //   }
                //   for ($i=1; $i <= $total_page; $i++) {
                //     if($page == $i){
                //       $active = "active";
                //     }else{
                //       $active = "";
                //     }
                //
                //     echo '<li class = '.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                //   }
                //   if($total_page > $page){
                //     echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                //   }
                //   echo "</ul>";
                // }

                 ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
