<?php require '../includes/header.php'; ?>

<?php
require '../config/config.php';
$conn = getConn($host, $db_name, $user, $password);

// Check if the 'upd_id' parameter is set in the URL
if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];
// Prepare and execute a SELECT query to fetch data for the specified post ID
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

// Fetch the result as an object and store it in the $rows variable
    $rows = $stmt->fetch(PDO::FETCH_OBJ);


    
}
?>

<form method="POST" action="update.php?upd_id=<?php echo $id; ?>">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" value="<?php echo isset($rows) ? $rows->title : ''; ?>" id="form2Example1" class="form-control" placeholder="title" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" value="<?php echo isset($rows) ? $rows->subtitle : ''; ?>" id="form2Example1" class="form-control" placeholder="subtitle" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="body" value="<?php echo isset($rows) ? $rows->body : ''; ?>" id="form2Example1" class="form-control" placeholder="body" />
    </div>

    <div class="form-outline mb-4">
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
        <!-- Note: You cannot pre-fill a file input field due to security reasons -->
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
</form>

<?php require '../includes/footer.php'; ?>
