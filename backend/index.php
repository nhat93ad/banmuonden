
<?php require '../backend/header.php';?>
<div class="container">
    <div class="wrap">
<?php
session_start();
if($_SESSION['username']){
?>
<p>Bài viết</p>
<ul>
    <li><a href="/banmuonden/backend/article/create.php">Thêm bài viết</a></li>
    <li><a href="/banmuonden/backend/article/list-update.php">Chỉnh sửa bài viết</a></li>
</ul>
<p>Danh mục</p>
<ul>
    <li><a href="/banmuonden/backend/category/create.php">Thêm danh mục</a></li>
    <li><a href="/banmuonden/backend/category/list-update.php">Chỉnh sửa danh mục</a></li>
</ul>

<?php
}else{
    header('location:/banmuonden/backend/log-in.php');
}
?>
    </div>
</div>