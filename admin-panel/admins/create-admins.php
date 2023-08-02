<?php require '../layout/header.php'; ?>   
<?php require '../../config/config.php'; ?> 

    <?php

    $conn = getConn($host, $db_name, $user, $password);
    $errors = array();
    
      /* if(isset ($_SESSION['adminname'])){
        header("location: http://localhost/Blog_CMS/index.php");
      } */

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $email = $_POST['email'];
        $adminname = $_POST['adminname'];
        //hashing  the password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (empty($email)) {
            $errors[] = "Please enter your email.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (empty($adminname)) {
            $errors[] = "Please enter your adminname.";
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
            if ($conn) {
                // SQL Query to insert users data into the database
                $sql = "INSERT INTO admins (email, adminname, password) VALUES (:email, :adminname, :password)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':adminname', $adminname, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);

                if ($stmt->execute()) {
                  header("location: http://localhost/Blog_CMS/admin-panel/admins/admins.php");
                } else {
                    echo "Registration failed.";
                }
            }
        }
      }


    ?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="adminname" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  <?php require '../layout/footer.php'; ?> 