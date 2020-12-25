<?php include "header.php"; 

if ($_SESSION['user_role'] == '0') {

    header("location:post.php");
  }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Új szerkesztő létrehozása:</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                <?php

if(isset($_POST['submit'])) {

include 'config.php';
$fname = mysqli_real_escape_string($connection,$_POST['fname']);
$lname = mysqli_real_escape_string($connection,$_POST['lname']);
$user = mysqli_real_escape_string($connection,$_POST['user']);
$password = mysqli_real_escape_string($connection,md5($_POST['password']));
$role = mysqli_real_escape_string($connection,$_POST['role']);

$query = "SELECT username FROM user WHERE username='$user'";
$result = mysqli_query($connection,$query) or die("Query failed");

$count = mysqli_num_rows($result);
if ($count > 0) {

    echo "Username alredy exist";
} {
    $query1 = "INSERT INTO user (first_name,last_name,username,password,role) 
    VALUE ('$fname','$lname','$user','$password','$role')";
    $result = mysqli_query($connection,$query1) or die("Query failed");

    if($result) {

        header("location: users.php");
    }

}

echo $fname;
}

                ?>


                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Vezetéknév</label>
                          <input type="text" name="fname" class="form-control" placeholder="" required>
                      </div>
                          <div class="form-group">
                          <label>Keresztnév</label>
                          <input type="text" name="lname" class="form-control" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Felhasználónév</label>
                          <input type="text" name="user" class="form-control" placeholder="" required>
                      </div>

                      <div class="form-group">
                          <label>Jelszó</label>
                          <input type="password" name="password" class="form-control" placeholder=""  required>
                      </div>
                      <div class="form-group">
                          <label>Rang</label>
                          <select class="form-control" name="role" >
                              <option value="0">Moderátor</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="submit" class="btn btn-primary" value="Létrehozás" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
