<?php
session_start();
require 'E:web/banmuonden/backend/header.php';
?>


<div class="container">
    <div class="wrap">
        <?php
        require 'E:\web\banmuonden/modules/connect.php';
        $conn = connect();
        $sql = "Select * From article";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            while ($item = $result->fetch_assoc()) {
                ?>
                <p>
                    <a href="update.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                </p>
                <?php
            }
        ?>
    </div>
</div>