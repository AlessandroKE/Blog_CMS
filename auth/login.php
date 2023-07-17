<?php require '../includes/header.php'; ?>


<?php
require '../config/config.php';
$conn = getConn($host, $db_name, $user, $password);
$errors = array();

if(isset ($_SESSION['username'])){
  header("location: http://localhost/Blog_CMS/index.php");
}

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
    $sql = "SELECT * FROM users WHERE email = '$email'";
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

               <form method="POST" action="login.php">
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

                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
                    

                   
                  </div>
                </form>

           
<?php require '../includes/footer.php'; ?>

 