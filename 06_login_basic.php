<?php
// Bài 6: Đăng nhập cơ bản
$msg = "";
if(isset($_POST['user']) && isset($_POST['pass'])){
    $u = $_POST['user'];
    $p = $_POST['pass'];
    if($u == "admin" && $p == "123"){
        $msg = "<span style='color:green'>Đăng nhập thành công!</span>";
    } else {
        $msg = "<span style='color:red'>Sai tài khoản hoặc mật khẩu!</span>";
    }
}
?>
<form method="post">
    Username: <input type="text" name="user"><br><br>
    Password: <input type="password" name="pass"><br><br>
    <button>Đăng nhập</button>
</form>
<h3><?php echo $msg; ?></h3>
