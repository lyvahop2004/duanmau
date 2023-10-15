<?php

    include('./connect.php');
    if (isset($_GET['id']) ) {
        $id = $_GET['id'];
    
        $sql = "DELETE FROM blogs WHERE blog_id = $id";
    
        $query = mysqli_query($mysqli,$sql);
    
        header('Location:vietblog.php');
    }

?>