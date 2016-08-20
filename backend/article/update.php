<?php
session_start();
require 'E:\web\banmuonden/modules/connect.php';
require_once 'E:\web\banmuonden/modules/upload.php';
require 'E:web/banmuonden/backend/header.php';

$conn = connect();

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $query = $conn->query("SELECT * FROM article WHERE id = $article_id LIMIT 1");
    $article = $query->fetch_assoc();

    if (!$article) {
        die('Không có bài viết nào tương ứng với id bạn đưa ra');
    }
    $article = (object) $article;
}
?>

    <style>
        input{
            padding: 0.7em;
            display: block;
        }
        textarea {
            padding: 1em;
            margin-top: 1em;
            width: 100%;
            height: 190px;
            display: block;
            font-family: arial;
            line-height: 2em;
            border: solid 1px #004f8b;
            background: #fff;
        }
        .img-wrap img{
            width: 150px;
        }
        
    </style>
    <div class="container">
        <div class="wrap">

    
<?php

$category_query = $conn->query('SELECT * FROM category');
        
?>
    
    <form method="post" action="#" enctype="multipart/form-data">
        <label>Tiêu đề</label>
        <input type="text" name="name" value="<?= $article->name ?>">
        <br>
        <label>Mô tả</label>
        <textarea name="description"><?= $article->description ?></textarea>
        <br>
        <label>Nội dung</label>
        <textarea name="content"><?= $article->content ?></textarea>
        <label>Danh mục</label>
        <textarea name="category_id"><?= $article->category?></textarea>
        <div class="img-wrap">
            <img src="<?= $article->images_path . $article->images ?>">
        </div>
        <input type="file" name="image">
        <button type="submit" name="submit"> Gửi </button>
    </form>

    <?php
    

    $now = time();

    $message = '';
    $check = true;

    if (!isset($_SESSION['username']) or $_SESSION['username'] == '') {
        $check = false;
        $message = 'Bạn chưa đăng nhập';
    }
    if (!isset($_POST['name']) or $_POST['name'] == '') {
        $check = false;
        $message .= "<br>" . 'Bạn chưa điền tên bài viêt';
    }
    if (!isset($_POST['description']) or $_POST['description'] == '') {
        $check = false;
        $message .= "<br>" . 'Bạn chưa điền đoạn mô tả bài viết';
    }
    if (!isset($_POST['content']) or $_POST['content'] == '') {
        $check = false;
        $message .= "<br>" . 'Bạn chưa điền nội dung bài viết';
    }
    if (!isset($_POST['category_id']) or $_POST['category_id'] == '') {
        $check = false;
        $message .= "<br>" . 'Bạn chưa điền danh mục cho bài viết';
    }
    
    if ($check) {
        
        
        $upload_result = uploadImage($_FILES['image']);
        
        $image = $upload_result['image'];
        $image_path = $upload_result['image_path'];
        
        if ($image != '' && $image_path != '') {
            $img_sql = ", images =  '$image', images_path = '$image_path'";
        } else {
            $img_sql = '';
        }
        
        $sql = "UPDATE article SET name = '{$_POST['name']}',"
        . " description = '{$_POST['description']}',"
        . " content = '{$_POST['content']}',"
        . " category = '{$_POST['category_id']}'"
        . $img_sql
        . " WHERE id = $article_id";
        $result = $conn->query($sql);

        if ($result === true) {
            $message = 'Thành công mẹ nó rồi';
        }
    }

    echo $message;

    $conn->close();
    ?>
    </div>
</div>