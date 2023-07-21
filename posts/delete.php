<?php

 require '../config/config.php';
 $conn = getConn($host, $db_name, $user, $password);

if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];

   // Prepare an SQL query to select all columns from the 'posts' table where 'id' matches the value of $id
   $select = $conn->prepare("SELECT * FROM posts WHERE id = $id");

   // Execute the prepared SELECT query
   $select->execute();

   // Fetch the post data that matches the provided 'id' as an object
   $post = $select->fetch(PDO::FETCH_OBJ);

   // Construct the file path for the image associated with the post
   $imageFilePath = "images/" . $post->img . "";

   // Attempt to delete the image file from the server's file system
   unlink($imageFilePath);



    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id); // Bind the ID parameter
        $stmt->execute();

        header("location: http://localhost/Blog_CMS/index.php");
}else {
    echo "An error occurred while deleting post";
}



?>