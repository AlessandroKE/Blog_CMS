<?php

 require '../config/config.php';
 $conn = getConn($host, $db_name, $user, $password);

if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];

    $sql = "DELETE FROM posts WHERE id = :id";

    $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id); // Bind the ID parameter
        $stmt->execute();

        header("location: http://localhost/Blog_CMS/index.php");
}else {
    echo "An error occurred while deleting post";
}



?>