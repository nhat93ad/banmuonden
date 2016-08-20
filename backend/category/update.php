<?php
require '../../modules/connect.php';
require '../header.php';

$conn = connect();

if(isset($_GET['id'])){
    $category_id = $_GET['id'];
$query = $conn->query("select * from category where id = $category_id limit 1");
$category = $query->fetch_assoc();
if(!$category){
    die ('Không có danh mục nào');
}
    
$category = (object) $category;
}
?>
<div class="container">
    <div class="wrap">
<meta charset="utf-8">
<form method="post" action="#">
    <label>Danh mục</label>
    <br>
    <input type="text" name="name" value="<?= $category->name ?>">
    <br>
    <button type="submit">Thay đổi</button>
</form>
<?php
$now = time();
$message = '';
$check = true;


if (!isset($_POST['name']) or $_POST['name'] == '') {
    $check = false;
    $message = 'Bạn chưa điền tên danh mục';
}
if($check){
$sql = "Update category Set name = '{$_POST['name']}' Where id = $category_id";
$result = $conn->query($sql);

        if ($result === true) {
            $message = 'Thành công mẹ nó rồi';
        }
    }

    echo $message;

    $conn->close();
    ?>
