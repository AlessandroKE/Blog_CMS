<?php require '../layout/header.php'; ?>

<?php
require '../../config/config.php';
$conn = getConn($host, $db_name, $user, $password);

// Check if the 'id' and 'status' parameters are set in the URL
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = intval($_GET['status']); // Convert status to an integer

    if ($status == 0) {
        // Set status to 1 (activated) in the database
        $query = "UPDATE posts SET status = 1 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);

        // Redirect back to the show-posts.php page
        header("location: http://localhost/Blog_CMS/admin-panel/posts-admins/show-posts.php");
    } else {
        // Set status to 0 (deactivated) in the database
        $query = "UPDATE posts SET status = 0 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);

        // Redirect back to the show-posts.php page
        header("location: http://localhost/Blog_CMS/admin-panel/posts-admins/show-posts.php");
    }
}

// If 'id' or 'status' parameters are not set, handle the case or show an error
/* else {
    // Handle the case where the 'submit' button is not clicked
    header("Location:http://localhost/Blog_CMS/404.php");
} */

/* header("location: http://localhost/Blog_CMS/admin-panel/categories-admins/show-categories.php");
} else {
    echo "Failed to insert data.";
} */

?>
