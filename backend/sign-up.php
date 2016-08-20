<style>
    * {
        position: relative;
        padding: 0px;
        margin: 0px;
    }
    .sig-up {
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
    input {
       margin-top: 1em;
       margin-left: auto;
       margin-right: auto;
        line-height: 2em;
        padding: 1em 2em;
        display: block;
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
</style>
<meta charset="utf-8">
<div class="sig-up">
<form action="" method="post">
<input type="text" name="user" placeholder="User"><br>
<input type="password" name="password" placeholder="password"><br>
<input type="password" name="re_password" placeholder="re-password"><br>
<input type="submit" name="gg" value="Sign Up" >
</form>
</div>
    
 <?php
$servername = 'localhost';
$database = 'banmuonden';
$username = 'root';
$password = '';
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['user'], $_POST['password'])) {
    $check = TRUE;
    $message = '';
    $user_name = $_POST['user'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $now = time();
    if ($user_name == '') {
        $check = FALSE;
        $message .= '<p>Vui lòng nhập tài khoản</p>';
    }

    if ($password == '') {
        $check = FALSE;
        $message .= '<p>Vui lòng nhập mật khẩu</p>';
    }
    
    if ($password != $re_password) {
        $check = FALSE;
        $message .= '<p>Mật khẩu không khớp</p>';
    }
    
    $password = md5($password);
    
    if ($check) {
        $sql = "INSERT INTO user (username, password_hash, created_at)
            VALUES ('$user_name', '$password', $now)";
        $result = $conn->query($sql);
        if ($result === true) {
            echo 'Bạn đã đăng kí thành công';
            header("location:/banmuonden/backend/log-in.php");
        } else {
            echo $conn->error;
        }
    } else {
        echo $message;
    }
}