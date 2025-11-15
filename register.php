<?php
session_start();
require __DIR__ . '/../config/db.php';
if (isset($_SESSION['user_id'])) { header('Location: ../index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password_raw = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    if ($username === '' || $password_raw === '') {
        $error = 'Vui lòng nhập tên đăng nhập và mật khẩu.';
    } elseif ($password_raw !== $password_confirm) {
        $error = 'Mật khẩu và xác nhận mật khẩu không khớp.';
    } else {
        $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        try {
            $stmt->execute([$username, $email ?: null, $password_hashed]);
            $_SESSION['success'] = 'Đăng ký thành công. Mời bạn đăng nhập.';
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Tên đăng nhập hoặc email đã tồn tại.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Đăng ký - ToDo App</title>
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
        <h3>Đăng ký tài khoản</h3>
        <p style="margin:0 0 12px 0; color:#456;">Tạo tài khoản để quản lý công việc cá nhân.</p>
        <?php if($error): ?><div style="color:#8b0000; margin-bottom:8px;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post" novalidate>
          <div class="input"><label>Tên đăng nhập</label><input name="username" required></div>
          <div class="input"><label>Email (tùy chọn)</label><input name="email" type="email"></div>
          <div class="input"><label>Mật khẩu</label><input name="password" type="password" required></div>
          <div class="input"><label>Xác nhận mật khẩu</label><input name="password_confirm" type="password" required></div>
          <div style="display:flex; gap:8px; margin-top:8px;">
            <button class="btn btn-primary" type="submit">Đăng ký</button>
            <a class="btn btn-ghost" href="login.php">Đã có tài khoản? Đăng nhập</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
