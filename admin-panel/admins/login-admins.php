<?php require '../layout/header.php'; ?>
<?php require '../../config/config.php'; ?>



<?php  
$conn = getConn($host, $db_name, $user, $password);
$errors = array();

/* if(isset ($_SESSION['username'])){
  header("location: http://localhost/Blog_CMS/index.php");
} */

if(isset($_POST['submit'])){
  $email = $_POST['email'];
   // $username = $_POST['username'];
    //hashing  the password
    $password = $_POST['password'];
    if (empty($email)) {
        $errors[] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Please enter your password.";
    }
    if (count($errors) > 0) {
      // Display all error messages
      foreach ($errors as $error) {
          echo $error . "<br>";
      }
    } else{
  if($conn){
    $sql = "SELECT * FROM admins WHERE email = '$email'";
    $stmt = $conn->prepare($sql);
    $stmt ->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
      if(password_verify($password, $row['password'])){

        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];


       // echo "Logged in sucessfully";
       header("Location: http://localhost/Blog_CMS/index.php");

      }else{
        echo "wrong password";
      }

    }else{
      echo "user not found";
    }
  }  
}



}

?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
<!-- </div> -->
<?php require '../layout/footer.php'; ?>