<?php require '../includes/header.php'; ?>


<?php
    require '../config/config.php';
    $conn = getConn($host, $db_name, $user, $password);
    $errors = array();

    if(isset($_POST['submit'])){
        if($_POST['title'] == '' OR $_POST['subtitle'] == '' OR $_POST['body'] == ''){
            echo "One or more fields is missing";
        } else{
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
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
        $query = "INSERT INTO posts (title, subtitle, body, img, user_id, username) VALUES (:title, :subtitle, :body, :image, :user_id , :username)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
        $stmt->bindParam(':body', $body, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imgPath, PDO::PARAM_LOB);
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
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>

     <?php require '../includes/footer.php'; ?>
      