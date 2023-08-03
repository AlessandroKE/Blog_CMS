<?php require '../layout/header.php'; ?>

<?php
require '../../config/config.php';
$conn = getConn($host, $db_name, $user, $password);

// Check if the 'upd_id' parameter is set in the URL
if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];
// Prepare and execute a SELECT query to fetch data for the specified post ID
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

// Fetch the result as an object and store it in the $rows variable
    $rows = $stmt->fetch(PDO::FETCH_OBJ);

//Enhancing security 
    /* if($_SESSION['user_id'] !== $rows->user_id){

      header("Location: http://localhost/Blog_CMS/index.php");
      
    } */
    if(isset($_POST['submit'])){
      if($_POST['name'] == ''){
          echo "fields is missing";
      } else{
          $name = $_POST['name'];
          
          // Check if an image file was uploaded
      
      } /* else {
          echo "error 404";
          exit;
      } */
      //$user_id = $_SESSION[
      }
    
       // Saving the data in the database: 
       $query = "UPDATE categories set name = :name where id = $id";
       $stmt = $conn->prepare($query);
       $stmt->bindParam(':name', $name, PDO::PARAM_STR);
       
      

       if ($stmt->execute()) {
        header("location: http://localhost/Blog_CMS/admin-panel/categories-admins/show-categories.php");
       } else {
           echo "Failed to insert data.";
       }
    }

?>

<form method="POST" action="update.php?upd_id=<?php echo $id; ?>" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="name" value="<?php echo isset($rows) ? $rows->name : ''; ?>" id="form2Example1" class="form-control" placeholder="name" />
    </div>

    

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
</form>

<?php require '../layout/footer.php'; ?>
