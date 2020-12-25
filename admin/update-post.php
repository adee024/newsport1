<?php include "header.php"; 
      if ($_SESSION['user_role'] == '0') {

        header("location:post.php");
      }

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Bejegyzés szerkesztése:</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
      <?php

include 'config.php';

$post_id = $_GET['id'];

$query = "SELECT post.post_id, post.title, post.post_img, post.category, post.description, post.post_date, category.category_name, user.username FROM post 
LEFT JOIN category ON post.category = category.category_id
LEFT JOIN user ON post.author = user.user_id
      WHERE post.post_id = {$post_id}";
      
      $result = mysqli_query($connection,$query) OR die("Failed");
      $count = mysqli_num_rows($result);

      if($count > 0) {


        while($row = mysqli_fetch_assoc($result)) {

        ?>





      

      
      
      
      
        <form action="save-updated-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
                    
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Cím</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Leírás</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                "<?php echo $row['description']; ?>"
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Kategória</label>
                <select class="form-control" name="category">
                <option disabled selected>Kategória választása</option>
                             
                             <?php    
                             // 47video - 20p // nem megy, updatenal megjelenjen a mar kivalszott kategoria
                             include "config.php";
                             
                             $query1 = "SELECT * FROM category";
                             $result1 = mysqli_query($connection,$query1) or die ("fail");
   
                             if (mysqli_num_rows($result1) > 0) {
   
                               while($row1 = mysqli_fetch_assoc($result1)) {

                                if($row['category'] == $row1['category_id']) {

                                    $selected = "selected";


                                } 
                                
                                else {

                                    $selected = "";
                                }
   
                                   echo "<option {$selected} value='{$row1['category_id']}'> {$row1['category_name']}</option>";
   
                               }
                            
   
                             } 
                             
                             ?>
                </select>
           
           <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">

  
           
            </div>

           

            <div class="form-group">
                <label for="">Fejléc képe</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px" >
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?> ">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Frissítés" />
       
        <?php } 
    } else {

        echo "Result not found";
    }
    
    ?>
      
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
