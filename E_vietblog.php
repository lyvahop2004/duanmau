<?php
session_start();
include('./connect.php');
// $user=[];
//giải thích nếu có $_SESSION['user'] thì sẽ gán $user = $_SESSION['user'] còn không có thì bằng rỗng
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
// $user = $_SESSION['user'];
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="./css/style.css">
<style>
    .category {
        display: flex;
        justify-content: start;
    }

    .category button {
        margin-left: 0px;
    }
</style>

<?php
include('./connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM blogs WHERE blog_id = $id";

    $query = mysqli_query($mysqli, $sql);

    $data = mysqli_fetch_array($query);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $name=$_POST['name'];
    $image1 = basename($_FILES['image1']['name']);


    if (trim($title) == "" || trim($content) == "" || trim($name) == "" || $image1 == "") {
        echo "Vui lòng nhập đầy đủ thông tin <a href='javascript: history.go(-1)'>Trở lại</a>";
        return;
    }



    $sql = "UPDATE blogs SET blog_title= '$title', blog_content = '$content',blog_name='$name', blog_image = '$image1'  WHERE blog_id = $id";
    
    $query = mysqli_query($mysqli, $sql);

if ($query) {
    echo "sửa thành công !";
    header('Location:vietblog.php');
} else {
    echo "sửa thất bại !";
}
}

?>



    <div class="container">
    <div class="row">
        <?php
        include('./layout/nav-dash.php');
        $sqlCate = "SELECT * FROM blog_categories";
        $queryCate = mysqli_query($mysqli, $sqlCate);
        ?>





        <?php

        ?>
        <div class="col col-lg-3">
            <h3 id="header">Thêm bài viết mới</h3>
            <form class="category form-inline" action=" " method="POST" enctype="multipart/form-data">
                <div class="form-group mb-2">
              
                    <input type="text" class="form-control" name="title" value="<?php echo $data['blog_title']; ?>"><br>
                    <input type="file" class="form-control" name="image1" value="<?php echo $data['blog_image']; ?>"><br>
                    <input type="text" class="form-control" name="name" value="<?php echo $data['blog_name']; ?>"><br>
                    <!-- <input type="text" class="form-control" name="content" placeholder="Enter your quantity product"><br> -->
                        
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Nội dung</label>
                        <textarea class="form-control" id="content" rows="3" name="content" value="<?php echo $data['blog_content']; ?>"></textarea>
                    </div>


                    <label class="khoangCach" for="category">Danh mục:</label>
                    <select name="categoryID" id="categoryID">
                        <? foreach ($queryCate as $key => $value) { ?>
                            <option value="<?php echo $value['category_blog_id']; ?>">
                                <? echo $value['category_blog_name']; ?>
                            </option>
                            <!-- Thêm các tùy chọn category khác nếu cần -->
                        <? } ?>
                    </select><br><br>
                    <button type="submit" class="btn btn-success form-group mb-2" name="submit">Create</button>
                </div>

            </form>
        </div>