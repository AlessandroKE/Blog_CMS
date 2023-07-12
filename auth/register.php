<?php require '../includes/header.php'; ?>


  <?php
  require '../config/config.php';
//database connection
  $conn = getConn($host, $db_name, $user, $password);
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($email)) {
        $errors[] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($username)) {
        $errors[] = "Please enter your username.";
    }

    if (empty($password)) {
        $errors[] = "Please enter your password.";
    }

    if (count($errors) > 0) {
        // Display all error messages
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Form validation successful, proceed with registration logic
        // ...
    }
}

  if($conn){

    //SQL Query to insert users data into the database

    $sql = "INSERT INTO users (email, username, password) values (?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam("sss", $email, $username,$password);

    if($stmt->execute()){

      echo "Registration is successful";

    }else{

    }


 }


    ?>


            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>

<?php require '../includes/footer.php'; ?>
        