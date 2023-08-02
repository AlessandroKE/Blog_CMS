<?php require '../layout/header.php'; ?>   
<?php require '../../config/config.php'; ?> 


  <?php 

        $conn = getConn($host, $db_name, $user, $password);

        //$sql = "SELECT * FROM posts"
        $stmt = $conn->prepare("SELECT * FROM admins LIMIT 5");
        $stmt->execute();

        $rows = $stmt->fetchALL(PDO::FETCH_OBJ);

  ?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="http://localhost/Blog_CMS/admin-panel/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($rows as $row ) : ?>
                  <tr>
                    <th scope="row"><?php echo $row->id; ?></th>
                    <td><?php echo $row->adminname; ?></td>
                    <td><?php echo $row->email; ?></td>
                   
                  </tr>

                  <?php endforeach; ?>
                  
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
    </div>

      <?php require '../layout/footer.php'; ?>   
