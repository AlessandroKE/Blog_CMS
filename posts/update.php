<?php require '../includes/header.php'; ?>

<?php
require '../config/config.php';
$conn = getConn($host, $db_name, $user, $password);

// Check if the 'upd_id' parameter is set in the URL
if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];
// Prepare and execute a SELECT query to fetch data for the specified post ID
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

// Fetch the result as an object and store it in the $rows variable
    $rows = $stmt->fetch(PDO::FETCH_OBJ);

//Enhancing security 
    /* if($_SESSION['user_id'] !== $rows->user_id){

      header("Location: http://localhost/Blog_CMS/index.php");
      
    } */
    if(isset($_POST['submit'])){
      if($_POST['title'] == '' OR $_POST['subtitle'] == '' OR $_POST['body'] == ''){
          echo "One or more fields is missing";
      } else{
          $title = $_POST['title'];
          $subtitle = $_POST['subtitle'];
          $body = $_POST['body'];

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
      //$user_id = $_SESSION[
      }
    
       // Saving the data in the database: 
       $query = "UPDATE posts set title = :title, subtitle = :subtitle, body = :body, img = :image where id = $id";
       $stmt = $conn->prepare($query);
       $stmt->bindParam(':title', $title, PDO::PARAM_STR);
       $stmt->bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
       $stmt->bindParam(':body', $body, PDO::PARAM_STR);
       $stmt->bindParam(':image', $imgName, PDO::PARAM_STR);
      

       if ($stmt->execute()) {
           header("Location: http://localhost/Blog_CMS/index.php");
       } else {
           echo "Failed to insert data.";
       }
    }
}
?>

<form method="POST" action="update.php?upd_id=<?php echo $id; ?>" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" value="<?php echo isset($rows) ? $rows->title : ''; ?>" id="form2Example1" class="form-control" placeholder="title" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" value="<?php echo isset($rows) ? $rows->subtitle : ''; ?>" id="form2Example1" class="form-control" placeholder="subtitle" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="body" value="<?php echo isset($rows) ? $rows->body : ''; ?>" id="form2Example1" class="form-control" placeholder="body" />
    </div>

    <?php echo "<img src = 'images/" . $rows->img . "' style='max-width: 500px; max-height: 500px;' />"; ?>


    <div class="form-outline mb-4">
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
        <!-- Note: You cannot pre-fill a file input field due to security reasons -->
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
</form>

<?php require '../includes/footer.php'; ?>
