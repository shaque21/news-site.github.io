<?php include "header.php";
if($_SESSION['user_role'] == '0'){
  header("Location: http://localhost/news-site/admin/post.php");
}
  if(isset($_POST['save'])){
    include "config.php";
    //take the input value from the form like catagory name.
    $_catname = mysqli_real_escape_string($connect,$_POST['cat']);

    // mysql query to insert data

    $query = "SELECT category_name FROM category WHERE category_name = '{$_catname}'";
    $result = mysqli_query($connect,$query) or die("Query unsuccessful.");
    if(mysqli_num_rows($result) > 0){
      echo "<p style = 'color:red; text-align:center; margin:10px 0px;'>This category name alreay exist.</p>";
    }else {
      $query1 = "INSERT INTO category(category_name) VALUES ('{$_catname}')";
      $result1 = mysqli_query($connect,$query1) or die("Query unsuccessful.");

      if($result1){
        header("Location: http://localhost/news-site/admin/category.php");
      }
      mysqli_close();

    }
  }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
