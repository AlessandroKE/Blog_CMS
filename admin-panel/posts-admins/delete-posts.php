<?php

 require '../../config/config.php';
 $conn = getConn($host, $db_name, $user, $password);

   
 if(!isset($_SESSION['adminname'])){
    // echo "Logged in sucessfully";
    header("Location: http://localhost/Blog_CMS/admin-panel/admins/login-admins.php");
  }

if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];

    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id); // Bind the ID parameter
        
        
        if($stmt->execute()){

        header("location: http://localhost/Blog_CMS/admin-panel/posts-admins/show-posts.php");
        }

}else {
    header("Location:http://localhost/Blog_CMS/404.php");
}



?>