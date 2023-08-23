<?php require 'includes/header.php'; ?>
<?php
require 'config/config.php';
$conn = getConn($host, $db_name, $user, $password);


//$sql = "SELECT * FROM posts";



$stmt = $conn->prepare("SELECT * FROM posts /* WHERE  status = 1  */ LIMIT 5");
$stmt->execute();

$rows = $stmt->fetchALL(PDO::FETCH_OBJ);


$categories = $conn->prepare("SELECT * FROM categories");
$categories->execute();

$category = $categories->fetchALL(PDO::FETCH_OBJ);

?>


        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                        <?php
                        //echo 'Hello ' . $_SESSION['username'] . '!';
                        ?>
                
                    <?php foreach($rows as $row): ?>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="http://localhost/Blog_CMS/posts/post.php?post_id=<?php echo $row->id ?>">
                            <h2 class="post-title"><?php echo $row->title ?></h2>
                            <h3 class="post-subtitle"><?php echo $row->subtitle ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $row->username ?></a>
                            <?php echo date('M', strtotime($row->created_at)) . ', ' . date('d', strtotime($row->created_at)) . ', ' . date('Y', strtotime($row->created_at)); ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />

                    <?php
                    endforeach; 
                    ?>
                 
                    
                </div>
            </div>
        </div>

      <!--   <div class="container px-4 px-lg-5"> -->
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php foreach ($category as $cat) :?>
                <div class = "col-md-5" >
                <div class="alert alert-dark" role="alert" style="margin: 1rem 0; padding: 1rem 1.5rem; border-radius: 0.25rem; background-color: #fff; color: #343a40;">
                    <a href="http://localhost/Blog_CMS/categories/category.php?cat_id=<?php echo $cat->id ?>"><?php  echo $cat->name; ?></a>
                    </div>
                </div>
                <?php endforeach; ?>

            <div>
         </div>
        <?php require 'includes/footer.php'; ?>