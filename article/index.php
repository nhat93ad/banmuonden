<?php
require 'E:web/banmuonden/views/layouts/header.php';
?>
<div class="content">
    <div class="container">
       <?php
       $conn=  connect();
       $id = $_GET['id'];
            $sql = "SELECT * FROM category where id = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    echo "<h3>&lt;{$row["name"]}&gt;</h3>";
                }
            } else {
                echo "0 results";
            }
       ?>
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
            $id = $_GET['id'];
            $sql = "SELECT * FROM article where category = $id Order by created_at DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo nl2br("<div class=\"list-content\">"
                            . "<h4><a href = \"/banmuonden/article/detail.php?id={$row['id']}\">{$row["name"]}</a></h4>"
                            . "<a href = \"/banmuonden/article/detail.php?id={$row['id']}\"><img src=\"{$row['images_path']}{$row['images']}\"></a>"
                            . "<p>"
                            . character_limiter($row['description'], 300)
                            . "</p></div>");
                }
            } else {
                echo "0 results";
            }
            ?>
<?php
require 'E:web/banmuonden/views/layouts/footer.php';
?>