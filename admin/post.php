<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">Bejegyzések:</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">új hír</a>
              </div>
              <div class="col-md-12">
                  
              
  <?php 
      include "config.php";
      

      
      
      
      $limit = 4;

      if(isset($_GET['page'])) {

        $page_number = $_GET['page'];

      } else {

        $page_number = 1;
      }
      
      
     
      $offset = ($page_number - 1) * $limit;

      if ($_SESSION['user_role'] == '1') {
        $query = "SELECT post.post_id, post.title, post.description, post.post_date, post.category, category.category_name, user.username FROM post 
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN user ON post.author = user.user_id
        ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

       
      } elseif ($_SESSION['user_role'] == '0') {
        $query = "SELECT post.post_id, post.title, post.description, post.post_date,post.category, category.category_name, user.username FROM post 
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN user ON post.author = user.user_id
  --      WHERE post.author = {$_SESSION['user_id']}     
        ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
          
      }

      $result = mysqli_query($connection,$query) or die("failed");
      $count = mysqli_num_rows($result);

      if ($count > 0 ) {

    
      
?>
              
              
              
              
              
              
              
              
              
              
              <table class="content-table">
                      <thead>
                          <th>NO</th>
                          <th>Bejegyzés címe</th>
                          <th>Kategória</th>
                          <th>Dátum</th>
                          <th>Szerző</th>
                          <th>Szerkesztés</th>
                          <th>Eltávolítás</th>
                      </thead>
                      <tbody>

   <?php
$serial_number = 0;
while ($row = mysqli_fetch_assoc($result)) {




?>


                          <tr>
                              <td class='id'><?php echo $serial_number ++ ?></td>
                              <td><?php echo $row['title'] ?></td>
                              <td><?php echo $row['category_name'] ?></td>
                              <td><?php echo $row['post_date'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id'] ?> &catid=<?php echo $row['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?> 
                      </tbody>
                      <?php } ?> 
                  </table>
        <?php

include 'config.php';
$query2 = "SELECT * FROM post";
$result2 = mysqli_query($connection,$query2) or die("fail");

if (mysqli_num_rows($result2)) {

$total_records = mysqli_num_rows($result2);
$total_page = ceil($total_records/$limit);


 echo " <ul class='pagination admin-pagination'>";

if ($page_number > 1) {
 echo '<li><a href="post.php?page='.($page_number-1).'">prev</a></li>';
}
for ($i = 1; $i <= $total_page; $i++) {

  if($i == $page_number) {

    $active = "active";

  } else {

   $active = "";

  }
  
    echo   '<li class='.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
   


}

if ($total_page > $page_number){

echo '<li><a href="post.php?page='.($page_number+1).'">next</a></li>';

}
echo "</ul>";

}

?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
