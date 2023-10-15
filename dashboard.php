<?php
session_start();
include('./connect.php');
// $user=[];
//giải thích nếu có $_SESSION['user'] thì sẽ gán $user = $_SESSION['user'] còn không có thì bằng rỗng
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
// $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .link1 {
            color: gray;
            text-decoration: none;
            font-size: 1.1rem;
        }
        .link1:hover{
            color: #F11A7B;
            border-bottom: 1px black solid;
            
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            include('./layout/nav-dash.php');
            ?>
            <div class="col col-lg-3">
                <ul class="list-group">
                    <li class="list-group-item"><a class="link1" href="./account.php">Users</li>
                    <li class="list-group-item"><a class="link1" href="./categories.php">Categories</a></li>
                    <li class="list-group-item"><a class="link1" href="./product.php">Products</li>
                    <li class="list-group-item"><a class="link1" href="./product.php">Variants</li>
                    <li class="list-group-item"><a class="link1" href="./vietblog.php">blog</li>
                </ul>
            </div>
        </div>
    </div>
    <a href="#header" class="btn-go"><i class="fa-solid fa-arrow-up" style="margin-top:250px"></i></a>
    <div class="container">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script> -->
</body>

</html>