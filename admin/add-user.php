<?php include "header.php";
if($_SESSION['user_role'] == '0'){
  header("Location: http://localhost/news-site/admin/post.php");
}
  if(isset($_POST['save'])){
    include "config.php";
    //take the input value from the form.
    $fname = mysqli_real_escape_string($connect,$_POST['fname']);
    $lname = mysqli_real_escape_string($connect,$_POST['lname']);
    $user = mysqli_real_escape_string($connect,$_POST['user']);
    $password = mysqli_real_escape_string($connect,md5($_POST['password']));
    $role = mysqli_real_escape_string($connect,$_POST['role']);
    // mysql query to insert data

    $query = "SELECT username FROM user WHERE username = '{$user}'";
    $result = mysqli_query($connect,$query) or die("Query unsuccessful.");
    if(mysqli_num_rows($result) > 0){
      echo "<p style = 'color:red; text-align:center; margin:10px 0px;'>This username alreay exist.</p>";
    }else {
      $query1 = "INSERT INTO user(first_name, last_name, username, password, role)
      VALUES ('{$fname}', '{$lname}', '{$user}', '{$password}','{$role}')";
      $result1 = mysqli_query($connect,$query1) or die("Query unsuccessful.");

      if($result1){
        header("Location: http://localhost/news-site/admin/users.php");
      }
      mysqli_close();

    }
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
