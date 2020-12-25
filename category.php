<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Találatok:</h2>





                  <?php 
      include "admin/config.php";
      
    $rcv_cid = $_GET['cid'];
      
      
      
      $limit = 3;

      if(isset($_GET['page'])) {

        $page_number = $_GET['page'];

      } else {

        $page_number = 1;
      }
      
      
     
      $offset = ($page_number - 1) * $limit;

        $query = "SELECT post.post_id, post.title, post.description, post.post_date, post.category,post.post_img, category.category_name, user.username FROM post 
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN user ON post.author = user.user_id WHERE post.category = {$rcv_cid}
        ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

       


      $result = mysqli_query($connection,$query) or die("failed");
      $count = mysqli_num_rows($result);

      if ($count > 0 ) {

        while ($row = mysqli_fetch_assoc($result)) {

    
      
?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php'><?php echo $row['username'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'] ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,180). "..." ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>megtekintés</a>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    <?php } 
      }else {

        echo "Nem található bejegyzés";
      }


      $query2 = "SELECT * FROM post WHERE post.category={$rcv_cid}";
      $result2 = mysqli_query($connection,$query2) or die("fail");
      
      if (mysqli_num_rows($result2)) {
      
      $total_records = mysqli_num_rows($result2);
      $total_page = ceil($total_records/$limit);
      
      
       echo " <ul class='pagination admin-pagination'>";
      
      if ($page_number > 1) {
       echo '<li><a href="category.php?page='.($page_number-1).'">prev</a></li>';
      }
      for ($i = 1; $i <= $total_page; $i++) {
      
        if($i == $page_number) {
      
          $active = "active";
      
        } else {
      
         $active = "";
      
        }
        
          echo   '<li class='.$active.'><a href="category.php?page='.$i.'">'.$i.'</a></li>';
         
      
      
      }
      
      if ($total_page > $page_number){
      
      echo '<li><a href="category.php?page='.($page_number+1).'">next</a></li>';
      
      }
      echo "</ul>";
      
      }
      
    







                    ?>     
                   
                  
         











                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
