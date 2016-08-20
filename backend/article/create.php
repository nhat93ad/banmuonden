<?php
require 'E:web/banmuonden/modules/upload.php';
require 'E:web/banmuonden/backend/header.php';
?>
    <style>
        input{
            padding: 0.7em;
            display: block;
        }
        textarea {
            padding: 2em;
            margin-top: 1em;
            width: 100%;
            height: 150px;
            display: block;
        }
        textarea:last-child{
            width: 50%;
        }
    </style>
    
    <div class="container">
        <div class="wrap">

    <form method="post" action="#" enctype="multipart/form-data">
        <label>Tiêu đề</label>
        <input type="text" name="name">
        <br>
        <label>Mô tả</label>
        <textarea name="description"></textarea>
        <br>
        <label>Nội dung</label>
        <textarea name="content"></textarea>
        <label>Danh mục</label>
        <textarea name="category_id"></textarea>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <button type="submit" name="submit"> Gửi </button>
    </form>

    <?php
    session_start();

    require 'E:web/banmuonden/modules/connect.php';
$conn=  connect();
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
        
        $upload_result = uploadImage($_FILES['fileToUpload']);
        
        $image = $upload_result['image'];
        $image_path = $upload_result['image_path'];
        
        $sql = "INSERT INTO article (created_by, name, description , content, category, created_at, images, images_path)
            VALUES ('{$_SESSION['username']}', '{$_POST['name']}', '{$_POST['description']}', '{$_POST['content']}', '{$_POST['category_id']}', '$now', '$image', '$image_path')";

        $result = $conn->query($sql);

        if ($result === true) {
            $message = 'Thành công mẹ nó rồi';
        }
    }

    echo $message;

    $conn->close();
    ?>