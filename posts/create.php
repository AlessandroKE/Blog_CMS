<?php require '../includes/header.php'; ?>


<?php
    require '../config/config.php';
    $conn = getConn($host, $db_name, $user, $password);
    $errors = array();

            
        $categories = $conn->prepare("SELECT * FROM categories");
        $categories->execute();

        $category = $categories->fetchALL(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
        if($_POST['title'] == '' OR $_POST['subtitle'] == '' OR $_POST['body'] == '' OR $_POST['category_id'] == ''){
            echo "One or more fields is missing";
        } else{
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
            $category_id = $_POST['category_id'];
           $user_id = $_SESSION['user_id'];
           $username =$_SESSION['username'];


            // Check if an image file was uploaded
        if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
            $img = $_FILES['img'];

            // Validate image format
            $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
            $fileExtension = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedFormats)) {
                echo "Invalid image format. Only JPG, JPEG, PNG, and GIF formats are allowed.";
                exit;
            }

                    // Process the uploaded image
            $imgName = $img['name'];
            $imgTmp = $img['tmp_name'];

            // Sanitizing the filename to remove any unwanted characters
            $imgName = basename($imgName); // Getting  the basename of the filename
            //$imgName = preg_replace("/[^a-zA-Z0-9\_\-\.]/", "_", $imgName); // Replacing  special characters with underscores

            $imgPath = 'images/' . $imgName;

            if (!move_uploaded_file($imgTmp, $imgPath)) {
                echo "Failed to upload the image.";
                exit;
            }
        } else {
            echo "No image file was uploaded.";
            exit;
        }
        //$user_id = $_SESSION['id'];

        // Saving the data in the database: 
        $query = "INSERT INTO posts (title, subtitle, body, category_id, img, user_id, username) VALUES (:title, :subtitle, :body, :category_id, :image, :user_id , :username)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
        $stmt->bindParam(':body', $body, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':image', $imgName, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            header("Location: http://localhost/Blog_CMS/index.php");
        } else {
            echo "Failed to insert data.";
        }

        
    }
}
?>



            <form method="POST" action="create.php" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
            </div>

            <div class="form-outline mb-4">
             <select name = "category_id"class="form-select" aria-label="Default select example">
                <option selected>Select Category</option>

                <?php foreach ($category as $cat):?>
                <option value="<?php echo $cat->id ?>"><?php echo $cat->name ?></option>
                <?php endforeach; ?>
            </select>
             </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>

     <?php require '../includes/footer.php'; ?>
      