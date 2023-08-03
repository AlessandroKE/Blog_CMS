
<?php require '../layout/header.php'; ?>   
<?php require '../../config/config.php'; ?> 

    <?php

    $conn = getConn($host, $db_name, $user, $password);

    
    $stmt = $conn->prepare("SELECT * FROM posts LIMIT 7");
    $stmt->execute();

    $rows = $stmt->fetchALL(PDO::FETCH_OBJ);



    ?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Posts</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">category</th>
                    <th scope="col">user</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php  foreach($rows as $row) :?>
                  <tr>
                    <th scope="row"><?php echo $row->id; ?></th>
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->category_id; ?></td>
                    <td><?php echo $row->user_id; ?></td>
                     <td><a href="delete-posts.html" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                <?php endforeach ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
  <?php require '../layout/footer.php'; ?>  