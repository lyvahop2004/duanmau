<?php
session_start();
include('./connect.php');
// $user=[];
//giải thích nếu có $_SESSION['user'] thì sẽ gán $user = $_SESSION['user'] còn không có thì bằng rỗng
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
// $user = $_SESSION['user'];

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $name=$_POST['name'];
    $image1 = basename($_FILES['image1']['name']);


    if (trim($title) == "" || trim($content) == ""|| trim($name)=="" || $image1 == "") {
        echo "Vui lòng nhập đầy đủ thông tin <a href='javascript: history.go(-1)'>Trở lại</a>";
        return;
    }




    $sql = "INSERT INTO blogs (blog_title, blog_content,blog_name, blog_image )
    VALUES ('{$title}', '{$content}','{$name}','{$image1}')";
    $query = mysqli_query($mysqli, $sql);

    if ($query) {
        echo "Thêm thành công !";
    } else {
        echo "Thất bại !";
    }
}






$sql1 = "SELECT * FROM blogs";
$data = mysqli_query($mysqli, $sql1);
?>
<script src="https://kit.fontawesome.com/91ad5c6d6a.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="./css/style.css">

<style>
    .category {
        display: flex;
        justify-content: start;
    }

    .category button {
        margin-left: 0px;
    }

    .btn-go {
        font-size: 18px;
        display: inline-block;
        outline: 0;
        border: 0;
        cursor: pointer;
        will-change: box-shadow, transform;
        background: aqua;
        padding: 0 2em;
        border-radius: 0.3em;
        color: #fff;
        height: 2.6em;
        transition: box-shadow 0.15s ease, transform 0.15s ease;
    }

    .btn-go {
        position: fixed;
        right: 0;
        top: 90%;
        transform: translate(-50%, -50%);
    }
</style>


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
                    <input type="text" class="form-control" name="title" placeholder="article title"><br>
                    <input type="file" class="form-control" name="image1" placeholder="Choose your image"><br>
                    <!-- <input type="text" class="form-control" name="content" placeholder="Enter your quantity product"><br> -->
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên"><br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Nội dung</label>
                        <textarea class="form-control" id="content" rows="3" name="content"></textarea>
                    </div>


                    <label class="khoangCach" for="category">Danh mục:</label>
                    <select name="categoryID" id="categoryID">
                        <? foreach ($queryCate as $key => $value) { ?>
                            <option value="<?php echo $value['category_blog_id']; ?>">
                                <? echo $value['category_blog_name']; ?>
                            </option>
                            <!-- Thêm các tùy chọn  khác nếu cần -->
                        <? } ?>
                    </select><br><br>
                    <button type="submit" class="btn btn-success form-group mb-2" name="submit">Create</button>
                </div>

            </form>
        </div>

        <div class="col col-lg-9">
            <table class="table">
                <thead>
                    <h3>Danh sách các bài viết</h3>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">content</th>
                        <th scope="col">Tác giả</th>
                        <!-- <th scope="col">blog_created_at</th>
                        <th scope="col">Blog_update_at</th>
                        <th scope="col">user_id</th>
                        <th scope="col">category_blog_id</th> -->
                        <th scope="col">image</th>
                        <th scope="col">Chỉnh sửa</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Truy vấn cơ sở dữ liệu để lấy danh sách blog  trong blog_categories
                    $sql2 = "SELECT * FROM blogs INNER JOIN blog_categories ON blogs.category_blog_id = blog_categories.category_blog_id";


                    // Thực thi truy vấn
                    $data1 = mysqli_query($mysqli, $sql2);
                    foreach ($data as $key => $value):
                        ?>
                        <tr class="justify-content-center">

                            <td>
                                <?php echo $value['blog_id'] ?>
                            </td>
                            <td>
                                <?php echo $value['blog_title'] ?>
                            </td>
                            
                            <td>
                                <?php echo $value['blog_content'] ?>
                            </td>
                            <td>
                                <?php echo $value['blog_name'] ?>
                            </td>
                            <td>
                                <?php echo "<img src='./uploads/" . $value['blog_image'] . "'width='100'>"; ?>
                            </td>

                            <td>
                                <a class="btn btn-danger"
                                    href="D_vietblog.php?id=<?php echo $value['blog_id'] ?>">Delete</a>
                                <a class="btn btn-primary" href="E_vietblog.php?id=<?php echo $value['blog_id'] ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>



            </table>
            <a href="#header" class="btn-go"><i class="fa-solid fa-arrow-up" style="margin-top:15px"></i></a>

        </div>
        <script src="script.js"></script>


    </div>
</div>



<?php


//upload file

$target_dir = "uploads/";
$target_file = $target_dir . ($image1);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//Kiểm tra file có phải là hình ảnh không hay là file khác
$check = getimagesize($_FILES["image1"]["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Kiểm tra file đã tồn tại hay chưa
if (file_exists($target_file)) {
    echo "File đã tồn tại ! <a href='javascript: history.go(-1)'>Trở lại</a>";
    $uploadOk = 0;
    return;
}

// // Kiểm tra khối lượng của file
// if ($_FILES["image1"]["size"] > 500000) {
//     echo "File quá lớn ! <a href='javascript: history.go(-1)'>Trở lại</a>";
//     $uploadOk = 0;
//     return;
// }

// kiểm tra đuôi file
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "file không đúng định dạng sau JPG, JPEG, PNG & GIF <a href='javascript: history.go(-1)'>Trở lại</a>";
    $uploadOk = 0;
    return;
}

//upload file
if ($uploadOk == 0) {
    echo "file của bạn không được upload ! <a href='javascript: history.go(-1)'>Trở lại</a>";
    // nếu mọi thứ vẫn ổn, bắt đầu tạo file
} else {
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
    } else {
        echo "Đã xảy ra lỗi khi tải ảnh của bạn <a href='javascript: history.go(-1)'>Trở lại</a>";
    }
}

?>