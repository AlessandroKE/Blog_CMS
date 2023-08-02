<?php require '../layout/header.php'; ?>   
<?php require '../../config/config.php'; ?> 

    <?php

    $conn = getConn($host, $db_name, $user, $password);

    
    $stmt = $conn->prepare("SELECT * FROM categories LIMIT 7");
    $stmt->execute();

    $rows = $stmt->fetchALL(PDO::FETCH_OBJ);



    ?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.html" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row ) :?>
                  <tr>
                    <th scope="row"><?php echo $row->id; ?></th>
                    <td><?php echo $row->name; ?></td>
                    <td><a  href="update-category.html" class="btn btn-warning text-white text-center ">Update Categories</a></td>
                    <td><a href="delete-category.html" class="btn btn-danger  text-center ">Delete Categories</a></td>
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
  <?php require '../layout/footer.php'; ?> 
 