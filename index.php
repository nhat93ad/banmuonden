<?php
require '/views/layouts/header.php';
?>
<div class="content">
    <div class="container">
        <p>
            Chào mừng các bạn đến với 
            <a href="." title="Những điểm đến đẹp nhất ở Việt Nam">Banmuonden.net</a>
            và cùng chúng tôi khám phá những địa điểm du lịch đáng đến nhất ở Việt Nam, một 
            đất nước vô cùng xinh đẹp với hàng ngàn danh nam thắng cảnh nổi tiếng, bên cạnh
            đó là một danh sách các món ăn ngon đầy hấp dẫn, phải làm siêu lòng bất cứ thực khách
            nào.
        </p>
        <img src="http://cdn.tugo.com.vn/wp-content/uploads/du-lich-nha-trang-1.jpg">
        <div class="global col-1">
            <p><a href="">Các điểm du lịch mới nhất</a></p>
            <?php

            function character_limiter($str, $n = 500, $end_char = '&#8230;') {
                if (strlen($str) < $n) {
                    return $str;
                }

                $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

                if (strlen($str) <= $n) {
                    return $str;
                }

                $out = "";
                foreach (explode(' ', trim($str)) as $val) {
                    $out .= $val . ' ';

                    if (strlen($out) >= $n) {
                        $out = trim($out);
                        return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
                    }
                }
            }
            ?>
            <?php
            $conn = connect();
            $sql = "SELECT * FROM article where category = 1 Order by created_at DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo nl2br("<div class=\"list-content\">"
                            . "<h4><a href = \"/banmuonden/article/detail.php?id={$row['id']}\">{$row["name"]}</a></h4>"
                            . "<a href = \"/banmuonden/article/detail.php?id={$row['id']}\"><img src=\"{$row['images_path']}{$row['images']}\"></a>"
                            . "<p>"
                            . character_limiter($row['description'], 240)
                            . "</p></div>");
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
        <div class="global col-2">
            <p><a href="">Các điểm du lịch hot nhất</a></p>
            <?php
            $sql = "SELECT * FROM article where category = 1 order by views DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo nl2br("<div class=\"list-content\"> "
                            . "<h4><a href = \"/banmuonden/article/detail.php?id={$row['id']}\">{$row["name"]}</a></h4>"
                            . "<a href = \"/banmuonden/article/detail.php?id={$row['id']}\"><img src=\"{$row['images_path']}{$row['images']}\"></a>"
                            . "<p>"
                            . character_limiter($row['description'], 240)
                            . "</p></div>");
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
</body>
</html>
