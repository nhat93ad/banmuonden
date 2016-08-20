
<?php
require 'E:/web/banmuonden/modules/connect.php';
require 'E:/web/banmuonden/backend/header.php';
$conn= connect();
?>
<div class="container">
    <div class="wrap">
<?php
$sql = "Select id, name From category";
$result = $conn->query($sql);
if($result->num_rows > 0)
    while ($item = $result -> fetch_assoc() ){
    ?>
    <p>
        <a href="update.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
    </p>
    <?php
    }
?>
</div>
</div>
