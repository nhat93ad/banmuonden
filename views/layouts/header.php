<!DOCTYPE html>
<html>
    <head>
        <title>Những điểm đến đẹp nhất ở Việt Nam</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/banmuonden/web/css/style.css">
    </head>
    <body>
        <?php require __DIR__ . '/../../modules/connect.php'; ?>
        <div class="header">
            <div class="top">
                <p><a href="/banmuonden" title="Những điểm đến đẹp nhất ở Việt Nam">Banmuonden.net</a></p>
            </div>
            <div class="list">
                <button onclick="myFunction()">Menu</button>
                <div class="list-phone" id="menu" style="display: none">
                    <ul>
                        <li><a href="/banmuonden">Trang chủ</a></li>
                        <?php
                        $conn = connect();
                        $sql = "SELECT * FROM category";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo nl2br("<li><a href = \"/banmuonden/article/index.php?id={$row['id']}\">{$row["name"]}</a></li>");
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </ul>
                </div>
                <script>
                    function myFunction() {
                        var e = document.getElementById("menu");
                        console.log(e.style);
                        if (e.style.display === "none") {
                            e.style.display = "block";
                        } else {
                            e.style.display = "none";
                        }
                    }
                </script>
                <ul>
                    <li><a href="/banmuonden">Trang chủ</a></li>
                    <?php
                    $conn = connect();
                    $sql = "SELECT * FROM category";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo nl2br("<li><a href = \"/banmuonden/article/index.php?id={$row['id']}\">{$row["name"]}</a></li>");
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                </ul>
                <div class="clearfix"></div>
            </div>
            <img src="http://escapesfromthelittlereddot.com/wp-content/uploads/2013/11/Halong-Bay-Pano-from-Titop.jpg"
                 alt="Banmuonden.net">
        </div>