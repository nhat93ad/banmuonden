<?php
require 'E:web/banmuonden/views/layouts/header.php';
$conn = connect();
?>
<style>
    .list-content img{
        max-width: none;
        max-height: none;
    }
</style>
<div class="content">
    <div class="container">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM article where id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); {
                echo nl2br("<div class=\"list-content\"> <h3>{$row["name"]}</h3>"
                        . "<img src=\"{$row['images_path']}{$row['images']}\">"
                        . "<p>{$row["content"]}</p> </div>");
            }
        } else {
            echo "0 results";
        }
        ?>
        <div class="global col-1">
            <h4>Địa điểm mới nhất</h4>
            <?php
            $sql = "SELECT * FROM article where id != $id order by created_at DESC limit 5 offset 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo nl2br("<div class=\"list-content\"><h5><a href = \"/banmuonden/article/detail.php?id={$row['id']}\">{$row["name"]}</a></h5></div>");
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
        <div class="global col-2">
            <h4>Địa điểm Hot nhất</h4>
            <?php
            $sql = "SELECT * FROM article where id != $id order by views DESC limit 5 offset 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo nl2br("<div class=\"list-content\"><h5><a href = \"/banmuonden/article/detail.php?id={$row['id']}\">{$row["name"]}</a></h5></div>");
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
        <div class="clearfix"></div>
<?php
require 'E:web/banmuonden/views/layouts/footer.php';
?>
    </div>
</div>
