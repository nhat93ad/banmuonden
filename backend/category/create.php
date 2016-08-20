

<?php
require 'E:web/banmuonden/backend/header.php';
?>
<div class="container">
    <div class="wrap">
        <form method="post" action="#">
            <label>Danh mục</label>
            <input type="text" name="name">
            <br>
            <button type="submit">Tạo</button>
        </form>

        <?php
        require 'E:web/banmuonden/modules/connect.php';
        $conn = connect();
        $now = time();
        $message = '';
        $check = true;

        if (!isset($_POST['name']) or $_POST['name'] == '') {
            $check = false;
            $message = 'Bạn chưa điền tên danh mục';
        }
        if ($check) {
            $sql = "INSERT INTO category ( name)
        VALUES ('{$_POST['name']}')";

            $result = $conn->query($sql);

            if ($result === true) {
                $message = 'Thành công mẹ nó rồi';
            }
        }
        echo $message;
        ?>
    </div>
</div>