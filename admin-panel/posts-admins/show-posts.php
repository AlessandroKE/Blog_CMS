
<?php require '../layout/header.php'; ?>   
<?php require '../../config/config.php'; ?> 

    <?php

    $conn = getConn($host, $db_name, $user, $password);
       /*
      categories is the first table.
      posts is the second table.
      JOIN is used to combine the two tables based on a condition.
      ON categories.id = posts.category_id is the condition for the join. 
      It's saying to join rows where the value in the id column of the categories table matches the value in the category_id column of the posts table. 
      This is likely a way to associate posts with their corresponding categories 
      */
    $stmt = $conn->prepare("SELECT posts.id AS id, posts.title AS title, posts.username AS username, categories.name As name,
    FROM categories JOIN posts ON categories.id = posts.category_id");
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
                     <td><a href="http://localhost/Blog_CMS/admin-panel/posts-admins/delete-posts.php?del_id=<?php echo $row->id ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                <?php endforeach ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
  <?php require '../layout/footer.php'; ?>  