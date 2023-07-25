
<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>


<?php

        $conn = getConn($host, $db_name, $user, $password);
        //$sql = "SELECT * FROM categories JOIN post ON categories.id = post.category_id WHERE categories.id = $id";

        if(isset($_GET['cat_id'])){
            $id = $_GET['cat_id'];
        $sql = "SELECT posts.id AS id, posts.title AS title, posts.subtitle AS subtitle, posts.username AS username,
        posts.created_at AS created_at, posts.category_id AS category_id FROM categories
        JOIN posts ON categories.id = posts.category_id WHERE posts.category_id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchALL(PDO::FETCH_OBJ);
        } else {
            echo "404";
        }

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



<?php require '../includes/footer.php'; ?>