<?php require '../includes/navbar.php'; ?>



<?php
    require '../config/config.php';
    $conn = getConn($host, $db_name, $user, $password);

    if(isset($_GET['post_id'])){
        $id = $_GET['post_id']; // Getting the id of a single post

        //$sql = "SELECT * FROM posts Where id = '$id'";

        $sql = "SELECT * FROM posts WHERE id = :id"; // Updated SQL query using parameter binding

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id); // Bind the ID parameter
        $stmt->execute();
    
        $post = $stmt->fetch(PDO::FETCH_OBJ); // Assign the fetched post object to the $post variable
    }else{
       // echo "Invalid post";
    } 

    /* if(isset($_GET['post_id'])) {
        $id = $_GET['post_id']; // Getting the id of a single post
    
        // Check if the $post variable is defined
        if (isset($post)) {
            echo "Post variable is defined";
        } else {
            // The $post variable is not defined
            $sql = "SELECT * FROM posts WHERE id = :id"; // Updated SQL query using parameter binding
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id); // Bind the ID parameter
            $stmt->execute();
    
            $post = $stmt->fetch(PDO::FETCH_OBJ); // Assign the fetched post object to the $post variable
        }
    } else {
        // The user did not pass a post_id parameter in the URL
        // Redirect the user to the homepage
        //header('Location: /');
        exit;
    }
     */
?>
        
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('images/<?php echo $post->img; ?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <?php if(isset($post)): ?> <!-- Add a check if $post is set -->
                                <h1><?php echo $post->title; ?></h1>
                                <h2 class="subheading"><?php echo $post->subtitle; ?></h2>
                                <span class="meta">
                                    Posted by
                                    <a href="#!"><?php echo $post->username ?></a>
                                    <?php echo date('M', strtotime($post->created_at)) . ', ' . date('d', strtotime($post->created_at)) . ', ' . date('Y', strtotime($post->created_at)); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                       
                        <p><?php echo $post->body; ?></p>
                        
                           
                       
                            <a href="http://localhost/Blog_CMS/posts/delete.php?del_id=<?php echo $post->id ?>" class ="btn btn-danger text-centre " >Delete</a>
                            <a href="update.php?upd_id=<?php echo $post->id ?>"class = "btn btn-warning text-centre">Update</a> 
                       
                    
                        </p>
                    </div>
                </div>
            </div>
        </article>
<?php require '../includes/footer.php'; ?>