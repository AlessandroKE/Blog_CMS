<?php require 'layout/header.php'; ?>   
<?php require '../config/config.php'; ?> 
    <?php 

    
  if(!isset($_SESSION['adminname'])){
    // echo "Logged in sucessfully";
    header("Location: http://localhost/Blog_CMS/admin-panel/admins/login-admins.php");
  }
  $conn = getConn($host, $db_name, $user, $password);

    //Number of admins
    $sql = "SELECT COUNT(*) AS admins_number FROM  admins";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $admins = $stmt->fetch(PDO::FETCH_OBJ);

    // Number of categories
    $sql = "SELECT COUNT(*) AS categories_number FROM  categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetch(PDO::FETCH_OBJ);

    // Number of posts
    $sql = "SELECT COUNT(*) AS posts_number FROM  posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $posts = $stmt->fetch(PDO::FETCH_OBJ);

    ?>  
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Posts</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of posts: <?php echo $posts->posts_number ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $categories->categories_number ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $admins->admins_number; ?></p>
              
            </div>
          </div>
        </div>
      </div>

<?php require 'layout/footer.php'; ?>     