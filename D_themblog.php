<?php

    include('./connect.php');
    if (isset($_GET['id']) ) {
        $id = $_GET['id'];
    
        $sql = "DELETE FROM blog_categories WHERE category_blog_id = $id";
    
        $query = mysqli_query($mysqli,$sql);
    
        header('Location:themblog.php');
    }

?>