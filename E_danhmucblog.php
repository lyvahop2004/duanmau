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
        margin-left: 30px;
    }
</style>

<?php
include('./connect.php');
if (isset($_GET['id']) ) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM blog_categories WHERE category_blog_id = $id";

    $query = mysqli_query($mysqli,$sql);

    $data = mysqli_fetch_array($query);
}

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    if($name == ""){
        echo"Vui lòng nhập tên cần sửa";
    }
    else{
        $sql1 = "UPDATE blog_categories SET category_blog_name = '$name' WHERE category_blog_id = $id";
        $query1 = mysqli_query($mysqli,$sql1);
        header('Location:themblog.php');
    }
}

?>

<div class="container">
    <div class="row">
        <?php
        include('./layout/nav-cate.php');
        ?>
        <div class="col col-lg-4">
            <h3>Edit Category</h3>
            <form class="category form-inline" action="" method="POST">
                <div class="form-group mb-2">
                    <input type="text" class="form-control" name="name" value="<?php echo$data['category_blog_name'];?>">
                </div>
                <button type="submit" class="btn btn-success form-group mb-2" name="edit">Edit</button>
            </form>
        </div>
</div>