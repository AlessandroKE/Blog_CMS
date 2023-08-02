<?php require '../layout/header.php'; ?>   
<?php require '../../config/config.php'; ?> 

    <?php

    $conn = getConn($host, $db_name, $user, $password);

    if(isset($_POST['submit'])){

      $name = $_POST['name'];

    $sql = "INSERT INTO categories(name) VALUES (:name)";
    $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            if ($stmt->execute()) {
              header("location: http://localhost/Blog_CMS/admin-panel/categories-admins/show-categories.php");
           } else {
               echo "failed.";
           }
    }

    ?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  <?php require '../layout/footer.php'; ?> 