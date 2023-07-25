
<?php require '../includes/header.php'; ?>

<?php
require '../config/config.php';
$conn = getConn($host, $db_name, $user, $password);

// Check if the 'upd_id' parameter is set in the URL
if (isset($_GET['prof_id'])) {
    $id = $_GET['prof_id'];
// Prepare and execute a SELECT query to fetch data for the specified post ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

// Fetch the result as an object and store it in the $rows variable
    $rows = $stmt->fetch(PDO::FETCH_OBJ);

//Enhancing security 
    if($_SESSION['user_id'] !== $rows->user_id){

      header("Location: http://localhost/Blog_CMS/index.php");
      
    } 
    if(isset($_POST['submit'])){
        if($_POST['email'] == '' OR $_POST['username'] == ''){
            echo "One or more fields is missing";
        } else{
            $email = $_POST['email'];
            $username = $_POST['username'];
            
        }
        // Saving the data in the database: 
       $query = "UPDATE users set email = :email, username = :username where user_id = $id";
       $stmt = $conn->prepare($query);
       $stmt->bindParam(':email', $email, PDO::PARAM_STR);
       $stmt->bindParam(':username', $username, PDO::PARAM_STR);
       
      

       if ($stmt->execute()) {
        header("Location: http://localhost/Blog_CMS/users/profile.php?prof_id=".$_SESSION['user_id'].'');
       } else {
           echo "Failed to insert data.";
       }
    }

}else{
    header("Location:http://localhost/Blog_CMS/404.php");
}

?>
<form method="POST" action="profile.php?prof_id=<?php echo $id; ?>">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="email" value="<?php echo isset($rows) ? $rows->email : ''; ?>" id="form2Example1" class="form-control" placeholder="email" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="username" value="<?php echo isset($rows) ? $rows->username : ''; ?>" id="form2Example1" class="form-control" placeholder="username" />
    </div>

    
    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
</form>

<?php require '../includes/footer.php'; ?>
