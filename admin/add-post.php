<?php include "header.php"; 



?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Bejegyzés létrehozása:</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Cím</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Leírás</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Kategória</label>
                          <select name="category" class="form-control">
                              
                          <option disabled selected>Válasz kategóriát</option>
                             
                          <?php    
                          
                          include "config.php";
                          
                          $query = "SELECT * FROM category";
                          $result = mysqli_query($connection,$query) or die ("fail");

                          if (mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_assoc($result)) {

                                echo "<option value='{$row['category_id']}'> {$row['category_name']}</option>";

                            }

                          } 
                          
                          ?>
                              
                              
                          
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Fejléc képe</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Mentés" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>




<?php include "footer.php"; ?>
