
<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "Xin chao {$_SESSION['username']}";
    echo "<a href=\"log-out.php\">Đăng xuất </a>";
    
} else {
    ?>
    <meta charset="utf-8">
<style>
    * {
        position: relative;
        padding: 0px;
        margin: 0px;
    }
    .login {
        background: #1ad;
        width: 100%;
        max-width: 400px;
        margin: auto;
        margin-top: calc(50vh - 200px);
    }
    form {
        width: 100%;
        padding: 2em;
        box-sizing: border-box;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
  
    input:not([type="submit"]) {
        width: 100%;
    }
    input {
        margin-top: 1em;
        line-height: 2em;
        padding: 1em 2em;
    }
    input[type="submit"] {
        margin: 0 auto;
        margin-top: 1em;
        background: #6b2;
        border: 3px solid #ddd;
        border-radius: 3px;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        display: table;
    }
    h3 {
        margin-top: 2%;
        text-align: center;
    }
</style>
  
<div class="login">

    <form action="" method="post">
        <input type="text" name="user" placeholder="username"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="submit" name="submit" value="Log In" >
    </form>
</div>

    <?php
    $servername = 'localhost';
    $database = 'banmuonden';
    $username = 'root';
    $passworddb = '';

// Create connection
    $conn = new mysqli($servername, $username, $passworddb, $database);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['user'], $_POST['password'])) {
        $check = TRUE;
        $message = '';

        $user = $_POST['user'];
        $password = $_POST['password'];
        $now = time();


        if ($user == '') {
            $check = FALSE;
            $message .= '<p>Vui lòng nhập tài khoản</p>';
        }

        if ($password == '') {
            $check = FALSE;
            $message .= '<p>Vui lòng nhập mật khẩu</p>';
        }

        $sql = "SELECT username, password_hash FROM user WHERE username='$user' limit 1";

        $result = $conn->query($sql);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (md5($password) == $row['password_hash']) {
                $_SESSION['username'] = $user;
//                echo 'Bạn đã đăng nhập thành công';
                header('location:/banmuonden/backend');
            } else {
                echo "<h3>Mật khẩu của bạn không đúng, vui lòng thử lại</h3>";
            }
                
        } else {
            echo "<h3>Bạn chưa đăng kí tài khoản này. Vui lòng bấm vào"
            . "<a href='sign-up.php'>đây</a>để đăng kí</h3>";
        }
   }
}
?>


