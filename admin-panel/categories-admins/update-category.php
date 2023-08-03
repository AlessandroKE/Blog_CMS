<?php require '../layout/header.php'; ?>

<?php
require '../../config/config.php';
$conn = getConn($host, $db_name, $user, $password);

// Check if the 'upd_id' parameter is set in the URL
if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];
    // Prepare and execute a SELECT query to fetch data for the specified post ID
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result as an object and store it in the $rows variable
    $rows = $stmt->fetch(PDO::FETCH_OBJ);

    // Enhancing security
    /* if($_SESSION['user_id'] !== $rows->user_id) {
        header("Location: http://localhost/Blog_CMS/index.php");
        exit;
    } */

    if (isset($_POST['submit'])) {
        if ($_POST['name'] == '') {
            echo "fields are missing";
        } else {
            $name = $_POST['name'];

            // Check if an image file was uploaded
        }
        /* else {
            echo "error 404";
            exit;
        } */

        // Saving the data in the database:
        $query = "UPDATE categories set name = :name where id = $id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        $stmt->execute();
    } 
    }else {
      // Handle the case where the 'submit' button is not clicked
      header("Location:http://localhost/Blog_CMS/404.php");
}

    /* header("location: http://localhost/Blog_CMS/admin-panel/categories-admins/show-categories.php");
    } else {
        echo "Failed to insert data.";
    } */


?>


<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                <form method="POST" action="update-category.php?upd_id=<?php echo $id; ?>" enctype="multipart/form-data">

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" value="<?php echo isset($rows) ? $rows->name : ''; ?>" id="form2Example1" class="form-control" placeholder="name" />
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                </form>

            </div>
        </div>
    </div>
</div>

<?php require '../layout/footer.php'; ?>
