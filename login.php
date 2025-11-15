<?php
session_start();
require __DIR__ . '/../config/db.php';
if (isset($_SESSION['user_id'])) { header('Location: ../index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') { $error = 'Vui lòng nhập tên đăng nhập và mật khẩu.'; }
    else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ../index.php');
            exit;
        } else { $error = 'Sai tên đăng nhập hoặc mật khẩu.'; }
    }
}
$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);
?>
<!doctype html>
<html>
head>
<meta charset="utf-8">
<title>Đăng nhập - ToDo App</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
  <div class="card hero">
    <div class="illustration">
      <?php readfile(__DIR__ . '/../assets/illustration.svg'); ?>
    </div>
    <div class="form-box">
      <div class="form-card">
        <h3>Đăng nhập</h3>
        <?php if($success): ?><div style="color:green; margin-bottom:8px;"><?= htmlspecialchars($success) ?></div><?php endif; ?>
        <?php if($error): ?><div style="color:#8b0000; margin-bottom:8px;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post" novalidate>
          <div class="input"><label>Tên đăng nhập</label><input name="username" required></div>
          <div class="input"><label>Mật khẩu</label><input name="password" type="password" required></div>
          <div style="display:flex; gap:8px; margin-top:8px;">
            <button class="btn btn-primary" type="submit">Đăng nhập</button>
            <a class="btn btn-ghost" href="register.php">Chưa có tài khoản? Đăng ký</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
