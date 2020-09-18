<?php include "header.php";
if($_SESSION['user_role'] == '0'){
  header("Location: http://localhost/news-site/admin/post.php");
}
if(isset($_POST['submit'])){
  include "config.php";
  //take the input value from the form.
  $category_id = mysqli_real_escape_string($connect,$_POST['cat_id']);
  $category_name = mysqli_real_escape_string($connect,$_POST['cat_name']);

  // mysql query to update data

  $query = "UPDATE category SET category_name = '{$category_name}' WHERE category_id = {$category_id}";
  $result = mysqli_query($connect,$query) or die("Query unsuccessful.");

  header("Location: http://localhost/news-site/admin/category.php");
  mysqli_close();
}

 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

                <?php

                  include "config.php";
                  $category_id = $_GET['id'];

                  // mysql query to insert data

                  $query = "SELECT * FROM category WHERE category_id = {$category_id}";
                  $result = mysqli_query($connect,$query) or die("Query unsuccessful.");
                  //Check records are added or not from db

                  if(mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)) {

                 ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                    }
                  }

                   ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
